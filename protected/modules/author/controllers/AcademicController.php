<?php

class AcademicController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'delete', 'admin'),
				'expression' => '$user->isAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Academic;
		
		if (Yii::app()->user->isAdmin()) {
			// Setting admin layout
			$this->layout = 'application.modules.admin.views.layouts.admin';

		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Academic']))
		{
			$model->attributes=$_POST['Academic'];
			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('AuthorModule.admin', 'Academic "%s" has been created', array('%s' => $model->name)));
                $this->redirect(array('admin'));
            }
		}

		$this->render('create',array(
			'model'=>$model,
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

		}
		
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Academic']))
		{
			$model->attributes=$_POST['Academic'];
			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('AuthorModule.admin', 'Academic "%s" has been updated', array('%s' => $model->name)));
				$this->redirect(array('admin'));
            }
		}

		$this->render('update',array(
			'model'=>$model,
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
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		if (Yii::app()->user->isAdmin()) {
			// Setting admin layout
			$this->layout = 'application.modules.admin.views.layouts.admin';

		}
		$model=new Academic('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Academic']))
			$model->attributes=$_GET['Academic'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Academic the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Academic::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Academic $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='academic-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
