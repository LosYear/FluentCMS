<?php

class PollController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'vote'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
                $model = $this->loadModel(Poll::getIdByNode($id));
                
                $now = new CDbExpression('NOW()');
                
                $state = 'active';
                
                if(Poll::model()->count('`id` = :id AND `till` < NOW()', array(':id' => Poll::getIdByNode($id))) > 0){
                    $state = 'ended';
                }
                elseif(Poll::model()->count('`id` = :id AND `from` > NOW()', array(':id' => Poll::getIdByNode($id))) > 0){
                    $state = 'future';
                }
                

		$this->render('view',array(
			'model'=>$model,
                        'node' => PollNode::model()->findByPk($id),
                        'variants' => PollVariant::model()->findAll('`poll_id` = :id', array(':id' => Poll::getIdByNode($id))),
                        'voted' => Votes::voted(Yii::app()->user->id, $model->id),
                        'data' => $this->getResults($model->id),
                        'state' => $state,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Poll;
                $node = new PollNode;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Poll']))
		{
			$model->attributes=$_POST['Poll'];
                        $node->attributes=$_POST['PollNode'];
                        
                        $node->author = Yii::app()->user->id;
                        $node->created = new CDbExpression('NOW()');
                        
                        $model->node_id = 0;
                        
                        $date = DateTime::createFromFormat("d.m.Y G:i", $model->from);
                        $model->from = $date->format("Y-m-d G:i:00");
                        
                        $date = DateTime::createFromFormat("d.m.Y G:i", $model->till);
                        $model->till = $date->format("Y-m-d G:i:00");
                        
                      /*  if($model->save())
				$this->redirect(array('view','id'=>$model->id));*/
                        if($model->validate() && $node->validate()){
                            $node->save();
                            
                            $model->node_id = $node->id;
                            $model->save();
                            
                            Yii::app()->user->setFlash('success', Yii::t('PollModule.alert', 'Poll "%s" created', array('%s' =>$node->title)));
                            
                            $this->redirect(array('admin'));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
                        'node' => $node,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
                $node = PollNode::model()->findByPk($id);
                $model= Poll::model()->find('`node_id` = :id', array(':id' => $node->id));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Poll']))
		{
			$model->attributes=$_POST['Poll'];
                        $node->attributes=$_POST['PollNode'];
                        
                        $date = DateTime::createFromFormat("d.m.Y G:i", $model->from);
                        $model->from = $date->format("Y-m-d G:i:00");
                        
                        $date = DateTime::createFromFormat("d.m.Y G:i", $model->till);
                        $model->till = $date->format("Y-m-d G:i:00");
                        
                        if($model->validate() && $node->validate()){
                            $node->save();
                            $model->save();
                            
                            Yii::app()->user->setFlash('success', Yii::t('PollModule.alert', 'Poll "%s" updated', array('%s' => $node->title)));
                            
                            $this->redirect(array('admin'));
                        }
		}
                
                $date = DateTime::createFromFormat("Y-m-d G:i:s", $model->from);
                $model->from = $date->format("d.m.Y G:i");

                $date = DateTime::createFromFormat("Y-m-d G:i:s", $model->till);
                $model->till = $date->format("d.m.Y G:i");

		$this->render('update',array(
			'model'=>$model,
                        'node' => $node,
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
		$dataProvider=new CActiveDataProvider('Poll');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PollNode('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Poll']))
			$model->attributes=$_GET['Poll'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Poll the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Poll::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Poll $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='poll-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        /**
         * Function provides AJAX voting
         */
        
        public function actionVote(){
            $answer = $_POST['id'];
            
            $poll_id = PollVariant::model()->find('`id` = :id', array(':id' => $answer))->poll_id;
            
            if (Votes::model()->count('`user_id` = :user AND `poll_id` = :poll', array(':user' => Yii::app()->user->id, ':poll'=>$poll_id)) <= 0){
                $model = new Votes;
                $model->poll_id = $poll_id;
                $model->vote_id = $answer;
                $model->user_id = Yii::app()->user->id;
                
                $model->save();
            }
            
            // Sending results
            
            $data = $this->getResults($poll_id);
           // print_r($data); die;
            $this->renderPartial('_results', array('data' => $data));

        }
        
        /**
         * Returns array with results. 
         * $[$id]['text'] - Text of ite,
         * $[$id]['percent'] - Percent
         * $[$id]['votes'] - Votes for current item
         */
        
        private function getResults($id){
            $result = array();
            
            $count = Votes::model()->count('`poll_id` = :id', array(':id' => $id));
            
            /*$votes = Votes::model()->findAll('`poll_id` = :id', array(':id' => $id));
            
            $number = array();
            $texts = array();
            
            foreach($votes as $vote){
                if(!isset($texts[$vote->vote_id])){
                    $texts[$vote->vote_id] = PollVariant::model()->find('`id` = :id', array(':id' => $vote->vote_id))->text;
                }
                
                if(isset($number[$vote->vote_id])){
                    $number[$vote->vote_id]++;
                }
                else{
                    $number[$vote->vote_id] = 1;
                }
            }
            
            foreach ($number as $key => $element){
                $tmp = array();
                $tmp['votes'] = $element;
                $tmp['text'] = $texts[$key];
                $tmp['percent'] = ($tmp['votes']/$count)*100;
                
                $result[] = $tmp;
            }*/
            
            $variants = PollVariant::model()->findAll('`poll_id` = :id', array(':id' => $id));
            
            foreach ($variants as $var){
                $tmp['votes'] = Votes::model()->count('`poll_id` = :id AND `vote_id` = :vote', array(':id' => $id, ':vote' => $var->id));
                $tmp['text'] = $var->text;
                $tmp['percent'] = ($tmp['votes']/$count)*100;
                
                $result[] = $tmp;
            }
            
            return $result;
        }
}
