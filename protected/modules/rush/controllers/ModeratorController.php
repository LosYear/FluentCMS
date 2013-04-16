<?php

class ModeratorController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }
    
    /*
     * Action, which shows all results.
     */
    
    public function actionResults(){
       $model = new Results('search');
       $model->unsetAttributes();  // clear any default values
       if(isset($_GET['Results']))
                $model->attributes=$_GET['Results'];
       $model->points = '>-1';
        
       $this->render('results', array('model' => $model));
    }
    
    /**
     * View results of test tour
     */
    
    public function actionViewResult($id){
       $criteria = new CDbCriteria();
       $criteria->condition = '`id` = :id';
       $criteria->params = array(':id' => $id);
       
       $data = Results::model()->find($criteria);
       $advanced = json_decode($data->json, true);
       $_answers = $advanced['answers'];
       
       $answers = array();
       
       foreach ($_answers as $key => $value){
           $answers[] = array('id' => $key, 'answer' => $value['answer'], 'status' => $value['status']);
       }
       
       //print_r($answers); die;
       
       $this->render('viewresults', array('data' => $data, 'advanced' => $advanced, 'answers' => $answers));
    }
    
    /**
     * Shows all solves
     */
    
    public function actionSolves(){
       $criteria = new CDbCriteria();
       $criteria->join = 'LEFT JOIN `tour` ON `tour_id` = `tour`.`id`';
       $criteria->condition = '`tour`.`type` = "full"';
        
        // Create filter model and set properties
        $filtersForm=new FiltersForm;
        if (isset($_GET['FiltersForm'])){
            $filtersForm->filters=$_REQUEST['FiltersForm'];      
        }
        

        // Get rawData and create dataProvider
        $rawData=Results::model()->findAll($criteria);
        $dataProvider=new CArrayDataProvider($rawData, array(
            'sort' => array(
                'attributes' => array(
                    'id',
                    'points',
                ),
            ),
        ));

        // Render
        $this->render('solves', array(
            'filtersForm' => $filtersForm,
            'dataProvider' => $filtersForm->filter($dataProvider),
        ));
        
    //  $this->render('solves', array('model' => $res));
    }
    
    /**
     * Dowloads solve
     */
    
    public function actionGetSolve($id){
            $solve = Results::model()->findByPk($id);
            
            $tmp = json_decode($solve->json, true);
            
            $filename = Yii::getPathOfAlias('application.modules.rush.data').'/'.$tmp['file'];
            //die($filename);
            
            Yii::app()->getRequest()->sendFile(YumUser::getUsernameById($solve->user_id).'_'.$solve->tour_id, file_get_contents($filename), NULL, false);
    }
    
    /**
     * Action allows to edit points
     */
    
    public function actionCheck($id){
        $model = Results::model()->findByPk($id);
        
        if(isset($_POST['Results']))
        {
            $model->attributes=$_POST['Results'];

            if($model->save())
                    $this->redirect(array('solves'));
        }
        
        $this->render('check', array('model' => $model));
    }
    
    /**
     * Certificate upload form
     */
    
    public function actionAddCertificate(){
        $model=new Certificate;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Certificate']))
        {
                $model->attributes=$_POST['Certificate'];

                $model->file_name = CUploadedFile::getInstance($model,'file_name');

                $ext = $model->file_name->extensionName;
                
                //$model->file_name->name = 'certificate_'.$model->user_id.'_'.rand();

                $file_name =  'certificate_'.$model->user_id.'_'.rand() .'.'.$ext;
                
                $file = $model->file_name;
                $model->file_name = $file_name;

                if($model->save()){       

                    $file->saveAs(Yii::getPathOfAlias('application.modules.rush.data').'/'.$file_name);

                    $this->redirect(array('admin'));
                }
        }

        $this->render('upload',array(
                'model'=>$model,
        ));
    }
    
    /**
     * Certificates managing
     */
    
    public function actionCertificates(){
        $model=new Certificate('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Certificate']))
                $model->attributes=$_GET['Certificate'];

        $this->render('certificates',array(
                'model'=>$model,
        ));
    }

    /**
     * Deletes certificate from database
     */
    
    public function actionDeleteCertificate($id){
        Certificate::model()->findByPk($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('certificates'));
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
				'actions'=>array('results', 'index', 'viewresult', 'solves', 'getsolve', 'check',
                                    'addcertificate', 'certificates', 'deletecertificate'),
				'expression' => 'Yii::app()->user->hasRole("Moderator")',
			),
                        array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('results', 'index', 'viewresult', 'solves', 'getsolve', 'check',
                                    'addcertificate', 'certificates', 'deletecertificate'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
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
} ?>