<?php

class TourController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
        public $layout='//layouts/main';
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
				'actions'=>array('admin','delete', 'create', 'update'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Tour;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tour']))
		{
			$model->attributes=$_POST['Tour'];
                        
                       list($day, $month, $year, $hour, $time) = sscanf($model->from, '%02d.%02d.%04d %02d:%02d');
                       $dateTime = new DateTime("$year-$month-$day $hour:$time:00");
                       $model->from = $dateTime->format("Y-m-d G:i:00");
                        
                       list($day, $month, $year, $hour, $time) = sscanf($model->till, '%02d.%02d.%04d %02d:%02d');
                       $dateTime = new DateTime("$year-$month-$day $hour:$time:00");
                       $model->till = $dateTime->format("Y-m-d G:i:00");
                        
                        if($model->save()){
                                Yii::app()->user->setFlash('success', Yii::t('alerts', 'Tour "%s" created', array('%s' => $model->name)));
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tour']))
		{
                                        
			$model->attributes=$_POST['Tour'];
                        
                       list($day, $month, $year, $hour, $time) = sscanf($model->from, '%02d.%02d.%04d %02d:%02d');
                       $dateTime = new DateTime("$year-$month-$day $hour:$time:00");
                       $model->from = $dateTime->format("Y-m-d G:i:00");
                        
                       list($day, $month, $year, $hour, $time) = sscanf($model->till, '%02d.%02d.%04d %02d:%02d');
                       $dateTime = new DateTime("$year-$month-$day $hour:$time:00");
                       $model->till = $dateTime->format("Y-m-d G:i:00");
                        
                        if($model->save()){
                                Yii::app()->user->setFlash('success', Yii::t('alerts', 'Tour "%s" updated', array('%s' => $model->name)));
                                $this->redirect(array('admin'));
                        }
		}
                
                $date = new DateTime($model->from);
                $model->from = $date->format("d.m.Y G:i");

                $date = new DateTime($model->till);
                $model->till = $date->format("d.m.Y G:i");
                
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Tour');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Tour('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tour']))
			$model->attributes=$_GET['Tour'];
                
                

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Tour the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Tour::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Tour $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tour-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
