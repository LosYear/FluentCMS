<?php

class MainController extends Controller
{
        // Access setting
    	/*public function filters()
	{
		return array(
			'accessControl',
		);
	}	
        
        public function accessRules() {
            return array(
                array('allow',  'actions'=>array('index'),
                                'expression' => 'Yii::app()->user->isAdmin()'),
                array('deny', 'users' => array('*')),
            );
        }*/
        
    
        public function actionIndex()
	{
                if(Yii::app()->user->isGuest){
                    // User isn't logged into admin panel
                    $model = new YumUserLogin;
                    
                  //  $this->render('login', array('model' => $model));
                }
                else{
                    $this->layout='//layouts/main';
                    // User logged into admin panel and has permissions
                    if(Yii::app()->user->isAdmin() && !Yii::app()->user->isGuest){
                        $this->render('index');
                    }
                }
	}       
        
        public function actionError(){
            if (Yii::app()->errorHandler->error['code'] == 403){
                    $this->render('denied');
            }
        }
        

}