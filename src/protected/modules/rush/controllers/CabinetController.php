<?php

class CabinetController extends Controller
{
    
        public $defaultAction = 'index';
	
        public function actionIndex()
	{
		$this->render('index');
	}
        
        /**
         * Action, which shows all tours in database
         */
        public function actionAll(){                
                $dataProvider=new CActiveDataProvider('Tour');
		$this->render('all',array(
			'dataProvider'=>$dataProvider,
		));
        }
        
        /**
         * Shows all active tours
         */
        public function actionActive(){               
                
                $dataProvider=new CActiveDataProvider('Tour', array(
                    'criteria' => array(
                        'condition' => '`from` <= NOW() AND `till` > NOW()',
                    ),
                ));
		$this->render('active',array(
			'dataProvider'=>$dataProvider,
		));
            
        }
        
        /**
         * Shows defined tour. If it's active shows 'take part' buttons
         */
        public function actionView($id){
            $criteria = new CDbCriteria();
            $criteria->condition = '`id` = :id';
            $criteria->params = array(':id' => $id);
            
            $model = Tour::model();
            $data = $model->find($criteria);
            
            $this->render('view',array(
                'data'=>$data,
            ));
            
        }
        
        /**
         * Action allows to take part in tour
         */
        
        public function actionTakePart($id){
            $criteria = new CDbCriteria();
            $criteria->condition = '`id` = :id';
            $criteria->params = array(':id' => $id);
            $tour = Tour::model()->find($criteria);
            
            if ($tour->type == 'test'){
                // Ajax test
                
                $this->render('test',array(
                    'tour'=>$tour,
                 ));
            }
            elseif ($tour->type == 'full'){
                if(isset($_FILES['answer'])){
                    $file = CUploadedFile::getInstanceByName('answer');
                    
                    $ext = $file->extensionName;
                            
                    if ($file->extensionName != 'txt' && $file->extensionName != 'doc'
                            && $file->extensionName != 'docx'){
                        $ext = '_';
                    }
                    
                    $file_name = 'answer'.$id.'_'.Yii::app()->user->id.'.'.$ext;
                    
                    $result = new Results;
                    $result->points = -1;
                    $result->user_id = Yii::app()->user->id;
                    $result->tour_id = $id;
                    
                    $result->json = json_encode(array('file' => $file_name));
                    $result->save();
                    $file->saveAs(Yii::getPathOfAlias('application.modules.rush.data').'/'.$file_name);
                }
                // Uploading document to server

                $criteria = new CDbCriteria;
                $criteria->condition = '`tour_id` = :tour_id';
                $criteria->params = array(':tour_id' => $tour->id);

                //  $results = new Results();
                $tasks = new CActiveDataProvider('Task', array('criteria' => $criteria));
                $this->render('full',array(
                    'tour'=>$tour,
                    'tasks' => $tasks,
                ));
                
            }
        }
        
        /**
         * Action shows table where user can see his results
         */
        
        public function actionResults(){
            $criteria = new CDbCriteria;
            $criteria->condition = '`user_id` = :user_id';
            $criteria->params = array(':user_id' => Yii::app()->user->id);
            
          //  $results = new Results();
            $results = new CActiveDataProvider('Results', array('criteria' => $criteria));
            
            $this->render('results',array('dataProvider' => $results, 'c' => $criteria));
        }
        
        /**
         * Sends file to user
         */
        
        public function actionDownload($id){
            $task = Task::model()->findByPk($id);
            
            $filename = Yii::getPathOfAlias('application.modules.rush.data').'/'.$task->task;
            //die($filename);
            
            Yii::app()->getRequest()->sendFile(json_decode($task->advanced, true)["title"], file_get_contents($filename), NULL, false);
        }
        
        /**
         * User certificates
         */
        
        public function actionCertificates(){
            $criteria = new CDbCriteria;
            $criteria->condition = '`user_id` = :user_id';
            $criteria->params = array(':user_id' => Yii::app()->user->id);
            
          //  $results = new Results();
            $results = new CActiveDataProvider('Certificate', array('criteria' => $criteria));
            
            $this->render('certificates',array('dataProvider' => $results, 'c' => $criteria));
            
        }
        
        /**
         * Sends file to user
         */
        
        public function actionGetCertificate($id){
            $task = Certificate::model()->findByPk($id);
            
            $filename = Yii::getPathOfAlias('application.modules.rush.data').'/'.$task->file_name;
            //die($filename);
            
            Yii::app()->getRequest()->sendFile($task->title, file_get_contents($filename), NULL, false);
        }
    
        /**
        * Specifies the access control rules.
        * This method is used by the 'accessControl' filter.
        * @return array access control rules
        */
           public function accessRules()
           {
                   return array(
                           array('deny', // allow admin user to perform 'admin' and 'delete' actions
                                   'actions'=>array('index', 'all', 'active', 'view', 'takepart', 'results', 'download',
                                       'certificates', 'getcertificate'),
                                   'users'=>array('admin'),
                           ),
                           array('deny', // allow admin user to perform 'admin' and 'delete' actions
                                'actions'=>array('index', 'all', 'active', 'view', 'takepart', 'results', 'download',
                                       'certificates', 'getcertificate'),
                                'expression' => 'Yii::app()->user->hasRole("Moderator")',
                           ),
                           array('allow', // allow admin user to perform 'admin' and 'delete' actions
                                   'actions'=>array('index', 'all', 'active', 'view', 'takepart', 'results', 'download',
                                       'certificates', 'getcertificate'),
                                   'users' => array('@'),
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
}