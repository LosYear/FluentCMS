<?php

	class NewsController extends Controller
	{
		public $defaultAction = 'admin';
		public $layout = 'admin';


		/**
		 * Specifies the access control rules.
		 * This method is used by the 'accessControl' filter.
		 * @return array access control rules
		 */
		public function accessRules()
		{
			return array(
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
		 * @return array action filters
		 */
		public function filters()
		{
			return array(
				'accessControl', // perform access control for CRUD operations
				'postOnly + delete', // we only allow deletion via POST request
			);
		}

		public function actionAdmin()
		{
			$model = new News('search');
			$model->unsetAttributes(); // clear any default values
			if (isset($_GET['News']))
				$model->attributes = $_GET['News'];

			$this->render('admin', array(
				'model' => $model,
			));
		}

		/**
		 * Creates a new model.
		 * If creation is successful, the browser will be redirected to the 'view' page.
		 */
		public function actionCreate($root_id = -1, $lang = null)
		{
			$model = new News;

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if (isset($_POST['News'])) {
				$model->attributes = $_POST['News'];
				$model->author = Yii::app()->user->id;
				$model->created = new CDbExpression('NOW()');
				$model->root_id = $root_id;
				$model->lang_id = $lang;

				if ($lang == null) {
					$model->lang_id = Language::defaultID();
				}

				if ($model->save()) {
					Yii::app()->user->setFlash('success', Yii::t('alerts', 'News "%s" created', array('%s' => $model->title)));
					$this->redirect(array('admin'));
				}
			}
			$t = false;

			$source = null;
			if ($root_id != -1) {
				$source = News::model()->findByPk($root_id);
				$model->url = $source->url;
				$t = true;
			}
			$lang_info = null;
			if ($lang != null) {
				$lang_info = Language::model()->findByPk($lang);
			}

			$this->render('create', array(
				'model' => $model,
				'source' => $source,
				'lang' => $lang_info,
				'translation' => $t,
			));
		}

		/**
		 * Returns the data model based on the primary key given in the GET variable.
		 * If the data model is not found, an HTTP exception will be raised.
		 * @param integer the ID of the model to be loaded
		 */
		public function loadModel($id)
		{
			$model = News::model()->findByPk($id);
			if ($model === null)
				throw new CHttpException(404, 'The requested page does not exist.');
			return $model;
		}

		/**
		 * Updates a particular model.
		 * If update is successful, the browser will be redirected to the 'view' page.
		 * @param integer $id the ID of the model to be updated
		 */
		public function actionUpdate($id)
		{
			$model = $this->loadModel($id);

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if (isset($_POST['News'])) {
				$model->attributes = $_POST['News'];
				if ($model->save()) {
					Yii::app()->user->setFlash('success', Yii::t('alerts', 'News "%s" updated', array('%s' => $model->title)));

					// Flushing cache
					Yii::app()->cache->delete("news_" . $model->id);

					$this->redirect(array('admin'));
				}
			}

			$source = $model->getTranslation(Language::defaultID());
			$t = $model->id != $source->id;

			$this->render('update', array(
				'model' => $model,
				'source' => $source,
				'translation' => $t
			));
		}

		public function actionDelete($id)
		{
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
	}