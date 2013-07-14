<?php

	class ArticleController extends Controller
	{
		/**
		 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
		 * using two-column layout. See 'protected/views/layouts/column2.php'.
		 */
		public $layout = '//layouts/column1';
		public $defaultAction = 'admin';

		/**
		 * @return array action filters
		 */
		public function filters()
		{
			return array(
				'accessControl', // perform access control for CRUD operations
				'postOnly + delete', // we only allow deletion via POST request
			);
		}

		/**
		 * Specifies the access control rules.
		 * This method is used by the 'accessControl' filter.
		 * @return array access control rules
		 */
		public function accessRules()
		{
			return array(
				array('allow', // allow all users to perform 'index' and 'view' actions
					'actions' => array('index', 'view', 'search'),
					'users' => array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions' => array('create', 'update', 'admin'),
					'users' => array('@'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
					'actions' => array('delete'),
					'users' => array('admin'),
				),
				array('deny', // deny all users
					'users' => array('*'),
				),
			);
		}

		/**
		 * Displays a particular model.
		 * @param integer $id the ID of the model to be displayed
		 */
		public function actionView($id)
		{
			// Getting information about authors
			$authors = array();

			$criteria = new CDbCriteria();
			$criteria->condition = '`node_id` = :id';
			$criteria->params = array(':id' => $id);

			$relations = ArticleAuthors::model()->findAll($criteria);

			foreach ($relations as $one) {
				$criteria = new CDbCriteria();
				$criteria->condition = '`id` = :id';
				$criteria->params = array(':id' => $one->author_id);

				$info['id'] = $one->author_id;

				$author = Profile::model()->find($criteria);

				$info['name'] = $author->name;
				$authors[] = $info;
			}

			$criteria = new CDbCriteria();
			$criteria->condition = '`node_id` = :id';
			$criteria->params = array(':id' => $id);

			$tags = ArticleTags::model()->findAll($criteria);

			$tags_rus = array();

			foreach ($tags as $tag){
				//echo $tag->info->tag." ";
				if($tag->info->lang == 'ru'){
					$tags_rus[] = $tag;
				}
			}

			// Loading aditional information
			$advModel = ArticleAdv::model()->findByPk($id);

			// Incrementing views
			$advModel->views++;
			$advModel->save();

			$this->render('view', array(
				'model' => $this->loadModel($id),
				'advModel' => $advModel,
				'authors' => $authors,
				'tags_rus' => $tags_rus,
			));
		}

		/**
		 * Creates relation between tag and article
		 * @param mixed $tag
		 * @param int $id
		 * @param string $lang
		 */

		private function addTag($tag, $id, $lang)
		{
			if (!is_int($tag)) {
				// Add tag into database then create relation

				$model = new Tag();
				$model->tag = $tag;
				$model->lang = $lang;

				$model->save();
				$tag = $model->id;
			}

			// Creating relation between article and tag
			$model = new ArticleTags();
			$model->node_id = $id;
			$model->tag_id = $tag;
			$model->save();
		}

		/**
		 * Creates relation between author and article
		 * @param mixed $id id or name of author
		 * @param id $article_id id of article
		 */
		private function addAuthor($id, $article_id)
		{
			if (is_int($id)) {
				// Author exists
				$relation = new ArticleAuthors;
				$relation->node_id = $article_id;
				$relation->author_id = $id;
				$relation->save() or die($relation->author_id);
			} else {
				// Author doesn't exist

				// Create new profile without user
				$profile = new Profile;
				$profile->user_id = -1;
				$profile->email = '-1';
				$profile->academic = '-1';
				$profile->name = $id;

				$profile->save() or die ("PROFILE 1");

				// Now, author exists. We can create relations
				$relation = new ArticleAuthors;
				$relation->node_id = $article_id;
				$relation->author_id = $profile->id;
				$relation->save() or die($profile->name);
			}
		}

		/**
		 * Creates a new model.
		 * If creation is successful, the browser will be redirected to the 'view' page.
		 */
		public function actionCreate()
		{
			if (Yii::app()->user->isAdmin()) {
				// Setting admin layout
				$this->layout = 'application.modules.admin.views.layouts.admin';
			} else {
				$this->layout = '/layouts/cabinet';
			}

			$model = new Article;
			$advModel = new ArticleAdv;

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if (isset($_POST['Article'])) {
				$model->attributes = $_POST['Article'];
				$model->author = Yii::app()->user->id;
				$model->created = new CDbExpression('NOW()');

				$advModel->attributes = $_POST['ArticleAdv'];
				$advModel->node_id = 0;
				$advModel->views = 0;
				$advModel->likes = 0;
				if (!Yii::app()->user->isAdmin()) {
					$model->status = 2;
					$model->url = '_';
					$advModel->issue_id = -1;
				}

				if ($model->validate() && $advModel->validate()) {
					$model->save();
					$advModel->node_id = $model->id;
					$advModel->save();

					// Inserting authors
					$authors = json_decode($advModel->aditional_authors, true);

					foreach ($authors as $key => $value) {
						if ($value == 1) {
							// Author will be added to database
							$this->addAuthor($key, $model->id);
						}
					}

					// Inserting russian tags
					$tags = json_decode($advModel->tags_rus, true);

					foreach ($tags as $key => $value) {
						if ($value == 1) {
							$this->addTag($key, $model->id, "ru");
						}
					}

					// Inserting english tags
					$tags = json_decode($advModel->tags_eng, true);

					foreach ($tags as $key => $value) {
						if ($value == 1) {
							$this->addTag($key, $model->id, "eng");
						}
					}

					$this->redirect(array('article/admin'));
				}
			}

			$this->render('create', array(
				'model' => $model,
				'advModel' => $advModel,
			));
		}

		/**
		 * Updates a particular model.
		 * If update is successful, the browser will be redirected to the 'view' page.
		 * @param integer $id the ID of the model to be updated
		 */
		public function actionUpdate($id)
		{
			if (Yii::app()->user->isAdmin()) {
				// Setting admin layout
				$this->layout = 'application.modules.admin.views.layouts.admin';
			} else {
				$this->layout = '/layouts/cabinet';
			}

			$model = $this->loadModel($id);
			$advModel = ArticleAdv::model()->find('node_id = :id', array(':id' => $id));

			// Getting info about aditional authors
			$criteria = new CDbCriteria();
			$criteria->condition = '`node_id` = :id';
			$criteria->params = array(':id' => $id);

			$relation = ArticleAuthors::model();
			$authors = $relation->findAll($criteria);

			$relations = array();

			foreach ($authors as $element) {
				$author_id = $element->author_id;

				$criteria = new CDbCriteria();
				$criteria->condition = '`id` = :id';
				$criteria->params = array(':id' => $author_id);

				$profile = Profile::model()->find($criteria);

				$relations[$profile->id] = $profile->name;
			}

			$advModel->aditional_authors = json_encode($relations);

			// Getting information about tags
			$criteria = new CDbCriteria();
			$criteria->condition = '`node_id` = :id';
			$criteria->params = array(':id' => $id);

			$tags = ArticleTags::model()->findAll($criteria);

			$rus = array();
			$eng = array();

			foreach ($tags as $tag) {
				$criteria = new CDbCriteria();
				$criteria->condition = '`id` = :id';
				$criteria->params = array(':id' => $tag->tag_id);

				$info = Tag::model()->find($criteria);

				if($info->lang == 'ru'){
					$rus[$tag->tag_id] = $info->tag;
				}
				else{
					$eng[$tag->tag_id] = $info->tag;
				}
			}

			$advModel->tags_rus = json_encode($rus);
			$advModel->tags_eng = json_encode($eng);

			if (isset($_POST['Article'])) {
				$model->attributes = $_POST['Article'];
				$model->updated = new CDbExpression('NOW()');
				$model->updater = Yii::app()->user->id;

				$advModel->attributes = $_POST['ArticleAdv'];
				$advModel->node_id = 0;
				//die($advModel->aditional_authors);

				if ($model->validate() && $advModel->validate()) {
					$model->save();
					$advModel->node_id = $model->id;
					$advModel->save();

					// Save information about aditional authors
					$authors = json_decode($advModel->aditional_authors, true);

					foreach ($authors as $id => $value) {
						if ($value == 0) {
							// Author has been deleted.
							if (is_int($id)) {
								// Author exists in database and may be there is a relation

								$criteria = new CDbCriteria();
								$criteria->condition = '`author_id` = :id AND `node_id` = :node';
								$criteria->params = array(':id' => $id, ':node' => $model->id);

								$relation = ArticleAuthors::model();

								if ($relation->count($criteria) > 0) {
									// There is a relation. Delete it
									$relation->find($criteria)->delete();
								}
							}
							// Else, author doesn't exists. That means,
							// that there is no relations
						} elseif ($value == 1) {
							// Author has been added
							$this->addAuthor($id, $model->id);
						}
					}

					// Save information about russian tags
					$tags = json_decode($advModel->tags_rus, true);

					foreach ($tags as $id => $value) {
						if ($value == 0) {
							if (is_int($id)) {
								// Tag exists
								// Maybe there is a relation between tag and article

								$criteria = new CDbCriteria();
								$criteria->condition = '`node_id` = :id AND `tag_id` = :tag';
								$criteria->params = array(':id' => $model->id, ':tag' => $id);

								if (ArticleTags::model()->count($criteria) > 0) {
									// There is a relation and we must remove it
									ArticleTags::model()->find($criteria)->delete();
								}
							}

						} elseif ($value == 1) {
							$this->addTag($id, $model->id, "ru");
						}

					}

					// Saving information about english tags
					$tags = json_decode($advModel->tags_eng, true);

					foreach ($tags as $id => $value) {
						if ($value == 0) {
							if (is_int($id)) {
								// Tag exists
								// Maybe there is a relation between tag and article

								$criteria = new CDbCriteria();
								$criteria->condition = '`node_id` = :id AND `tag_id` = :tag';
								$criteria->params = array(':id' => $model->id, ':tag' => $id);

								if (ArticleTags::model()->count($criteria) > 0) {
									// There is a relation and we must remove it
									ArticleTags::model()->find($criteria)->delete();
								}
							}

						} elseif ($value == 1) {
							$this->addTag($id, $model->id, "eng");
						}

					}

					$this->redirect(array('article/admin'));
				}
			}

			$this->render('update', array(
				'model' => $model,
				'advModel' => $advModel
			));
		}

		/**
		 * Deletes a particular model.
		 * If deletion is successful, the browser will be redirected to the 'admin' page.
		 * @param integer $id the ID of the model to be deleted
		 */
		public function actionDelete($id)
		{
			// Deleting node
			$this->loadModel($id)->delete();

			// Removing additional information
			$criteria = new CDbCriteria();
			$criteria->condition = '`node_id` = :id';
			$criteria->params = array(':id' => $id);

			ArticleAdv::model()->find($criteria)->delete();

			// Removing tags
			ArticleTags::model()->deleteAll($criteria);

			// Removing authors
			ArticleAuthors::model()->deleteAll($criteria);


			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}

		/**
		 * Lists all models.
		 */
		public function actionIndex()
		{
			$dataProvider = new CActiveDataProvider('Article');
			$this->render('index', array(
				'dataProvider' => $dataProvider,
			));
		}

		/**
		 * Manages all models.
		 */
		public function actionAdmin()
		{
			if (Yii::app()->user->isAdmin()) {
				// Setting admin layout
				$this->layout = 'application.modules.admin.views.layouts.admin';
			} else {
				$this->layout = '/layouts/cabinet';
			}

			$model = new Article('search');
			$model->unsetAttributes(); // clear any default values
			if (isset($_GET['Article']))
				$model->attributes = $_GET['Article'];

			$this->render('admin', array(
				'model' => $model,
			));
		}

		/**
		 * Search action. Searches article by title or content
		 */
		public function actionSearch()
		{
			$result = array();
			if (isset($_POST['query'])) {
				$criteria = new CDbCriteria();

				$criteria->condition = "`type` = 'author/article' AND (`title` LIKE :query OR `content` LIKE :query2)";
				$criteria->params = array(
					':query' => '%' . addcslashes($_POST['query'], '%_') . '%',
					':query2' => '%' . addcslashes($_POST['query'], '%_') . '%',
				);
				$criteria->order = '`created` DESC';

				$model = Article::model();
				$model->type = '';
				$result = $model->with('advanced')->findAll($criteria);
			}
			$this->render('search', array('results' => $result));
		}

		/**
		 * Returns the data model based on the primary key given in the GET variable.
		 * If the data model is not found, an HTTP exception will be raised.
		 * @param integer the ID of the model to be loaded
		 */
		public function loadModel($id)
		{
			$model = Article::model()->findByPk($id);
			if ($model === null)
				throw new CHttpException(404, 'The requested page does not exist.');
			return $model;
		}

		/**
		 * Performs the AJAX validation.
		 * @param CModel the model to be validated
		 */
		protected function performAjaxValidation($model)
		{
			if (isset($_POST['ajax']) && $_POST['ajax'] === 'article-form') {
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}
		}
	}
