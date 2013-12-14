<?php

	class BlocksController extends Controller
	{
		/**
		 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
		 * using two-column layout. See 'protected/views/layouts/column2.php'.
		 */
		public $layout = 'admin';

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
		 * Creates a new model.
		 * If creation is successful, the browser will be redirected to the 'view' page.
		 */
		public function actionCreate($root_id = -1, $lang = null)
		{
			$model = new Block;

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if (isset($_POST['Block'])) {
				$model->attributes = $_POST['Block'];
				$model->author = Yii::app()->user->id;
				$model->created = new CDbExpression('NOW()');
				$model->root_id = $root_id;
				$model->lang_id = $lang;

				if ($lang == null) {
					$model->lang_id = Language::defaultID();
				}

				if ($model->save()) {
					Yii::app()->user->setFlash('success', Yii::t('alerts', 'Block "%s" created', array('%s' => $model->title)));
					$this->redirect(array('admin'));
				}
			}

			$source = null;
			$t = false;
			if ($root_id != -1) {
				$source = Block::model()->findByPk($root_id);
				$model->name = $source->name;
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
				'translation' => $t
			));
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

			if (isset($_POST['Block'])) {
				$model->attributes = $_POST['Block'];

				$model->updater = Yii::app()->user->id;
				$model->updated = new CDbExpression('NOW()');

				if ($model->save()) {
					// Flushing cache
					Yii::app()->cache->delete("block_" . $model->name);

					Yii::app()->user->setFlash('success', Yii::t('alerts', 'Block "%s" updated', array('%s' => $model->title)));
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

		/**
		 * Manages all models.
		 */
		public function actionAdmin()
		{
			$model = new Block('search');
			$model->unsetAttributes(); // clear any default values
			if (isset($_GET['Block']))
				$model->attributes = $_GET['Block'];

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
			$model = Block::model()->findByPk($id);
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
			if (isset($_POST['ajax']) && $_POST['ajax'] === 'block-form') {
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}
		}

	}
