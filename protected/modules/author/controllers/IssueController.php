<?php

	class IssueController extends Controller
	{
		/**
		 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
		 * using two-column layout. See 'protected/views/layouts/column2.php'.
		 */
		public $layout = '//layouts/column1';

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
					'actions' => array('index', 'view'),
					'users' => array('*'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
					'actions' => array('admin', 'delete', 'create', 'update'),
					'expression' => '$user->isAdmin()',
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
			$this->render('view', array(
				'model' => $this->loadModel($id),
			));
		}

		/**
		 * Creates a new model.
		 * If creation is successful, the browser will be redirected to the 'view' page.
		 */
		public function actionCreate()
		{
			// Setting admin layout
			$this->layout = 'application.modules.admin.views.layouts.admin';

			$model = new Issue;

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if (isset($_POST['Issue'])) {
				$model->attributes = $_POST['Issue'];
				$model->created = new CDbExpression('NOW()');
				if ($model->save()){
					$this->redirect(array('admin'));
				}
			}

			$this->render('create', array(
				'model' => $model,
			));
		}

		/**
		 * Updates a particular model.
		 * If update is successful, the browser will be redirected to the 'view' page.
		 * @param integer $id the ID of the model to be updated
		 */
		public function actionUpdate($id)
		{
			// Setting admin layout
			$this->layout = 'application.modules.admin.views.layouts.admin';

			$model = $this->loadModel($id);

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if (isset($_POST['Issue'])) {
				$model->attributes = $_POST['Issue'];
				if ($model->save()){
					Yii::app()->cache->delete("issue_".$model->id);
					$this->redirect(array('admin'));
				}
			}

			$this->render('update', array(
				'model' => $model,
			));
		}

		/**
		 * Deletes a particular model.
		 * If deletion is successful, the browser will be redirected to the 'admin' page.
		 * @param integer $id the ID of the model to be deleted
		 */
		public function actionDelete($id)
		{
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}

		private function getDataForTemplate($id)
		{
			$new_issue = array();
			$issue = Issue::model()->findByPk($id);

			$date = DateTime::createFromFormat("Y-m-d", $issue->year);

			$new_issue['year'] = $date->format("Y");
			$new_issue['month'] = Yii::t('date', $date->format("F"));
			$new_issue['number'] = $issue->number;
			$new_issue['date'] = $date->format("d.m.Y");

			$new_issue['content'] = $issue->getArticles();
			$new_issue['articles'] = count($new_issue['content']);

			$new_issue['authors_amount'] = $issue->getAuthorsCount();

			// Archive
			$criteria = new CDbCriteria;
			$criteria->condition = 'YEAR(`year`) >= YEAR(NOW())-1 ';
			$criteria->order = '`year` DESC';
			$model = Issue::model();
			$sql = "SELECT DISTINCT i.* FROM issue AS i INNER JOIN article AS a ON i.id=a.issue_id WHERE YEAR(`year`) >= YEAR(NOW())-1";
			$result = Yii::app()->db->createCommand($sql)->queryAll();
			$new_issue['archive'] = array();

			foreach ($result as $element) {
				$criteria->condition = 'YEAR(`year`) = YEAR(:year)';
				$criteria->params = array(':year' => $element['year']);
				$criteria->order = '`year`';
				$array = $model->findAll($criteria);

				foreach ($array as $el) {
					$date = DateTime::createFromFormat("Y-m-d", $el->year);
					$new_issue['archive'][$date->format("Y")][Yii::t('date', $date->format("F"))][$el->number] = $el;
				}
			}

			return $new_issue;
		}

		/**
		 * Lists all models.
		 */
		public function actionIndex($id = '')
		{
			$dataProvider = new CActiveDataProvider('Issue');
			
			$res = '';
			if ($id == '') {
				$model = Issue::model();
				$criteria = new CDbCriteria;
				$criteria->condition = '`isOpened` = 1';
				$criteria->order = 'year DESC';
				$criteria->with = array('articles.article' => array('select' => false, 'condition' => 'article.status = 1'));
				$res = $model->find($criteria);
				$id = $res->id;
			}
			else{
				$criteria = new CDbCriteria;
				$criteria->condition = '`id` = :id';
				$criteria->params = array(':id'=>$id);
				
				$res = Issue::model()->find($criteria);
			}

			// Getting data about issue from cache
			$new_issue = Yii::app()->cache->get("issue_" . $id);

			if ($new_issue === false) {
				// If there is no data in cache put it there
				$new_issue = $this->getDataForTemplate($id);
				Yii::app()->cache->set("issue_" . $id, $new_issue, Yii::app()->params['cacheDuration']);
			}
			else{
				// Recounting popularity
				$content = array();
				foreach($new_issue['content'] as $article){
					$article['popularity'] = ArticleAdv::model()->findByPk($article['id'])->getPopularity();
					$content[] = $article;
				}
				$new_issue['content'] = $content;
			}
			
						$model = Issue::model();
			/**
			 * TODO: Replace sql to active record
			 */
			$criteria = new CDbCriteria;
			$criteria->order = 'year ASC';
			$criteria->with = array('articles.article' => array('select' => false, 'condition' => 'article.status = 1'));
			$criteria->condition = '`year` > DATE(:year) AND `isOpened` = 1';
			$criteria->params = array(':year' => $res->year);

			$issue = Issue::model()->find($criteria);

			if ($issue === null) {
				$new_issue['next_issue'] = -1;
			} else {
				$new_issue['next_issue'] = $issue['id'];
			}

			$criteria = new CDbCriteria;
			$criteria->order = 'year DESC';
			$criteria->with = array('articles.article' => array('select' => false, 'condition' => 'article.status = 1'));
			$criteria->condition = '`year` < DATE(:year) AND `isOpened` = 1';
			$criteria->params = array(':year' => $res->year);

			$issue = Issue::model()->find($criteria);

			if ($issue === null) {
				$new_issue['previous_issue'] = -1;
			} else {
				$new_issue['previous_issue'] = $issue['id'];
			}

			$criteria = new CDbCriteria();
			$criteria->condition = '`type` = "news"';
			$criteria->order = '`created` DESC';
			$last_news = News::model()->find($criteria);
			$news = array();

			if($last_news != null){
				$last_news = $last_news->getTranslation(Language::getCurrentID());
				$date = DateTime::createFromFormat("Y-m-d G:i:s", $last_news->created)->format("d.m.Y");
				$news = array('id' => $last_news->id, 'content' => $last_news->getPreview(),
					'title' => $last_news->title, 'date' => $date, 'href' => $last_news->url);
			}

			$this->render('index', array(
				'dataProvider' => $dataProvider,
				'new_issue' => $new_issue,
				'last_news' => $news,
			));
		}

		/**
		 * Manages all models.
		 */
		public function actionAdmin()
		{
			// Setting admin layout
			$this->layout = 'application.modules.admin.views.layouts.admin';

			$model = new Issue('search');
			$model->unsetAttributes(); // clear any default values
			if (isset($_GET['Issue']))
				$model->attributes = $_GET['Issue'];

			$this->render('admin', array(
				'model' => $model,
			));
		}


		/**
		 * Returns the data model based on the primary key given in the GET variable.
		 * If the data model is not found, an HTTP exception will be raised.
		 * @param integer the ID of the model to be loaded
		 */
		public function loadModel($id)
		{
			$model = Issue::model()->findByPk($id);
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
			if (isset($_POST['ajax']) && $_POST['ajax'] === 'issue-form') {
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}
		}
	}
