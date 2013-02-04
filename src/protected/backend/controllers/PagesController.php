<?php

class PagesController extends Controller
{
    public $defaultAction = 'admin';
    
    public $layout='//layouts/main';
    
    public function actionAdmin(){
        $model=new Page('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Page']))
                $model->attributes=$_GET['Page'];

        $this->render('admin',array(
                'model'=>$model,
        ));
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
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
            $model=Page::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
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

            if(isset($_POST['Page']))
            {
                    $model->attributes=$_POST['Page'];
                    $model->updated = new CDbExpression('NOW()');
                    $model->updater = Yii::app()->user->id;
                    
                    if($model->save())
                            $this->redirect(array('view','id'=>$model->id));
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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
            $model=new Page;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Page']))
            {
                    $model->attributes=$_POST['Page'];
                    
                    $model->author = Yii::app()->user->id;
                    $model->created = new CDbExpression('NOW()');
                    
                    if($model->save())
                            $this->redirect(array('view','id'=>$model->id));
            }

            $this->render('create',array(
                    'model'=>$model,
            ));
    }

    // Uncomment the following methods and override them if needed
    
    public function filters()
    {
        return array(
                'accessControl', // perform access control for CRUD operations
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
				'actions'=>array('admin','delete', 'update', 'view', 'create',),
                                'expression' => 'Yii::app()->user->isAdmin()'
                        ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
}