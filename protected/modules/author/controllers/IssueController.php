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
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions' => array('create', 'update'),
					'users' => array('@'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
					'actions' => array('admin', 'delete'),
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
				if ($model->save())
					$this->redirect(array('view', 'id' => $model->id));
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
				if ($model->save())
					$this->redirect(array('view', 'id' => $model->id));
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
			$model = Issue::model();
			$criteria = new CDbCriteria;
			$criteria->condition = 'id=:id';
			$criteria->params = array(':id' => $id);
			$res = $model->find($criteria);


			$date = DateTime::createFromFormat("Y-m-d", $res->year);

			$new_issue['year'] = $date->format("Y");
			$new_issue['month'] = Yii::t('date', $date->format("F"));
			$new_issue['number'] = $res->number;
			$new_issue['date'] = $date->format("d.m.Y");

			$model = ArticleAdv::model();
			$criteria = new CDbCriteria;
			$criteria->condition = 'issue_id=:id';
			$criteria->params = array(':id' => $res->id);
			$new_issue['articles'] = $model->count($criteria);

			$issue_id = $res->id;

			$model = ArticleAdv::model();
			$criteria = new CDbCriteria;
			$criteria->condition = 'issue_id=:id';
			$criteria->params = array(':id' => $res->id);
			$articles = $model->findAll($criteria);

			$new_issue['content'] = array();
			$authors_amount = array();

			foreach ($articles as $element) {
				$model = Article::model();

				$criteria = new CDbCriteria;
				$criteria->condition = 'id = :id';
				$criteria->params = array(':id' => $element['node_id']);
				$result = $model->find($criteria);

				// Getting information about authors
				$authors = array();

				$criteria = new CDbCriteria();
				$criteria->condition = '`node_id` = :id';
				$criteria->params = array(':id' => $result->id);

				$all = ArticleAuthors::model()->findAll($criteria);

				foreach ($all as $one) {
					$info = array();
					$info['id'] = $one->author_id;

					$criteria = new  CDbCriteria();
					$criteria->condition = '`id` = :id';
					$criteria->params = array(':id' => $one->author_id);

					$author = Profile::model()->find($criteria);

					$info['name'] = $author->name;

					$authors[] = $info;

					$authors_amount[$one->author_id] = 1;
				}

				$new_issue['content'][] = array(
					'id' => $result['id'],
					'title' => $result['title'],
					'annotation' => $element->annotation_rus,
					'href' => $result['url'],
					'authors' => $authors,
				);
			}

			$new_issue['authors_amount'] = count($authors_amount);

			$model = Issue::model();
			/**
			 * TODO: Replace sql to active record
			 */
			$sql = "SELECT DISTINCT i.* FROM issue AS i INNER JOIN article AS a ON i.id=a.issue_id WHERE `year` > DATE('{$res->year}')";
			$issue = Yii::app()->db->createCommand($sql)->queryRow();

			if (is_array($issue)) {
				$new_issue['next_issue'] = $issue['id'];
			} else {
				$new_issue['next_issue'] = -1;
			}

			$sql = "SELECT DISTINCT i.* FROM issue AS i INNER JOIN article AS a ON i.id=a.issue_id WHERE `year` < DATE('{$res->year}')";
			$issue = Yii::app()->db->createCommand($sql)->queryRow();

			if (is_array($issue)) {
				$new_issue['previous_issue'] = $issue['id'];
			} else {
				$new_issue['previous_issue'] = -1;
			}

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

			// Themes
			/*$criteria = new CDbCriteria;
			$criteria->join = "LEFT JOIN `node` ON `node`.`id` = `t`.`node_id` AND `t`.`issue_id` = :id";
		  //  $criteria->condition = '';
			$criteria->params = array(":id" => $id);
			$criteria->limit = 5;
			$criteria->select = "*";
			$criteria->order = '`node`.`created` DESC';

			$model = ArticleAdv::model();
			$result = $model->findAll($criteria);
			$new_issue['topics'] = $result;*/
			$sql = "SELECT * FROM `article`, `node` WHERE `article`.`node_id` = `node`.`id` AND `article`.`issue_id` = $id
ORDER BY `node`.`created` DESC";
			$result = Yii::app()->db->createCommand($sql)->queryAll();
			$new_issue['topics'] = $result;

			return $new_issue;
		}

		/**
		 * Lists all models.
		 */
		public function actionIndex($id = '')
		{
			$dataProvider = new CActiveDataProvider('Issue');

			if ($id == '') {
				$model = Issue::model();
				$criteria = new CDbCriteria;
				$criteria->order = '`created` DESC';
				$res = $model->find($criteria);
				$id = $res->id;
			}

			$new_issue = $this->getDataForTemplate($id);


			$this->render('index', array(
				'dataProvider' => $dataProvider,
				'new_issue' => $new_issue,
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
