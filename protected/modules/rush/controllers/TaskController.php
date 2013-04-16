<?php

class TaskController extends Controller
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
                        array('allow', 'actions' => array('type'), 'users' =>array('*')),
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
		$model=new Task;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Task']))
		{
			$model->attributes=$_POST['Task'];
                        
                        if ($model->type == 'file'){
                            $file = CUploadedFile::getInstanceByName('task-file');
                            
                            $ext = $file->extensionName;
                            
                            if ($file->extensionName != 'txt' && $file->extensionName != 'doc'
                                    && $file->extensionName != 'docx'){
                                $ext = '_';
                            }
                            $file_name = 'task_'.$model->tour_id.'_'.rand().'.'.$ext;
                            
                            $model->task = $file_name;
                            
                            $adv = array('title' => $_POST['title']);
                            
                            $model->advanced = json_encode($adv);
                            
                            if($model->save()){       
   
                                $file->saveAs(Yii::getPathOfAlias('application.modules.rush.data').'/'.$file_name);
                                
                                Yii::app()->user->setFlash('success', Yii::t('alerts', 'Task created'));
				$this->redirect(array('admin'));
                            }
                        }
                        elseif ($model->type == 'question'){
                           // print_r($_POST);
                           // $model->advanced = $_POST['adv'];
                            $model->task = $_POST['task-text'];
                            
                            if($model->save()){  
                                Yii::app()->user->setFlash('success', Yii::t('alerts', 'Task created'));
                                $this->redirect(array('admin'));
                            
                            }
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

		if(isset($_POST['Task']))
		{
			$model->attributes=$_POST['Task'];
                        
                        if ($model->type == 'file'){
                            $file = CUploadedFile::getInstanceByName('task-file');
                            
                            $ext = $file->extensionName;
                            
                            if ($file->extensionName != 'txt' && $file->extensionName != 'doc'
                                    && $file->extensionName != 'docx'){
                                $ext = '_';
                            }
                            $file_name = 'task_'.$model->tour_id.'.'.$ext;
                            
                            $model->task = $file_name;
                            
                            $adv = array('title' => $_POST['title']);
                            
                            $model->advanced = json_encode($adv);
                            
                            if($model->save()){       
   
                                $file->saveAs(Yii::getPathOfAlias('application.modules.rush.data').'/'.$file_name);
                                
                                Yii::app()->user->setFlash('success', Yii::t('alerts', 'Task updated'));
				$this->redirect(array('admin'));
                            }
                        }
                        elseif ($model->type == 'question'){
                           // print_r($_POST);
                           // $model->advanced = $_POST['advanced'];
                            $model->task = $_POST['task-text'];
                            
                            if($model->save()){  
                                Yii::app()->user->setFlash('success', Yii::t('alerts', 'Task updated'));
                                $this->redirect(array('admin'));
                            
                            }
                        }
		}
                $adv = array();
                $adv = json_decode($model->advanced, true);

		$this->render('update',array(
			'model'=>$model,
                      //  'adv' => $adv,
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
		$dataProvider=new CActiveDataProvider('Task');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Task('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Task']))
			$model->attributes=$_GET['Task'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        /**
         * Ajax function. Returns tour type
         */
        
        public function actionType(){
            if (isset($_REQUEST['id'])){
                $model = Tour::model();
                $criteria = new CDbCriteria();
                
                $criteria->condition = '`id` = :id';
                $criteria->params = array(':id' => $_REQUEST['id']);
                
                die($model->find($criteria)->type);
            }
        }

        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Task the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Task::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Task $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='task-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
