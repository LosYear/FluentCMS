<?php

class ProfileController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update', 'edit'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'/*,'delete'*/),
				'expression' => '$user->isAdmin()',
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
		$criteria = new CDbCriteria();
		$criteria->condition = '`id` = :id';
		$criteria->params = array(':id' => $id);
		$model = Profile::model()->find($criteria);

		// Recent articles
		$criteria = new CDbCriteria();
		$criteria->condition = '`author_id` = :id';
		$criteria->params = array(':id' => $id);

		$publications = ArticleAuthors::model()->findAll($criteria);
		
		$main_publications = array();
		if($model->user_id != -1){
			$criteria = new CDbCriteria();
			$criteria->condition = 'author = :id';
			$criteria->with = array('advanced' => array('select' => false,'condition' => 'advanced.is_author = 1'));
			$criteria->params = array(':id' => $model->user_id);
			
			$main_publications = Article::model()->findAll($criteria);
		}

		$this->render('view',array(
			'model'=>$model,
			'main_publications' => $main_publications,
			'publications' => $publications
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	/*public function actionCreate()
	{
		$model=new Profile;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profile']))
		{
			$model->attributes=$_POST['Profile'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->user_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEdit()
	{
		if(Yii::app()->user->isAdmin()){
			// Setting admin layout
			$this->layout = 'application.modules.admin.views.layouts.admin';
		}
		else{
			$this->layout = '/layouts/cabinet';
		}

        $id = Yii::app()->user->id;
		$criteria = new CDbCriteria();
		$criteria->condition = '`user_id` = :id';
		$criteria->params = array(':id' => $id);
		$model=Profile::model()->find($criteria);

		$new = false;

		if($model === null && !isset($_POST['profile_id'])){
			$model = new Profile;
			$new = true;
		}
		else if($model === null && isset($_POST['profile_id'])){
			$criteria = new CDbCriteria();
			$criteria->condition = '`id` = :id';
			$criteria->params = array(':id' => $_POST['profile_id']);
			$model=Profile::model()->find($criteria);
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profile']))
		{
			$model->attributes=$_POST['Profile'];
			$model->user_id = Yii::app()->user->id;
			if($model->save())
				$this->redirect(array('article/admin'));
		}

		$this->render('update',array(
			'model'=>$model,
			'new' => $new,
		));
	}
	
	public function actionUpdate($id)
	{
		if(Yii::app()->user->isAdmin()){
			// Setting admin layout
			$this->layout = 'application.modules.admin.views.layouts.admin';
		}

        $id = Yii::app()->user->id;
		$criteria = new CDbCriteria();
		$criteria->condition = '`user_id` = :id';
		$criteria->params = array(':id' => $id);
		$model=Profile::model()->find($criteria);

		$new = false;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profile']))
		{
			$model->attributes=$_POST['Profile'];
			$model->user_id = Yii::app()->user->id;
			if($model->save())
				$this->redirect(array('profile/admin'));
		}

		$this->render('update',array(
			'model'=>$model,
			'new' => $new,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		
		if($model->user_id != -1){
			YumUser::model()->findByPk($model->user_id)->delete();
		}
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	/*public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Profile');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}*/

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		if (Yii::app()->user->isAdmin()) {
			// Setting admin layout
			$this->layout = 'application.modules.admin.views.layouts.admin';

		}
		$model=new Profile('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Profile']))
			$model->attributes=$_GET['Profile'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = '`user_id` = :id';
		$criteria->params = array(':id' => $id);
		$model=Profile::model()->find($criteria);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
