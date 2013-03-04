<?php

class TestController extends Controller
{
    
        private function checkAnswer($tid, $qid, $ans, $session/*, $hn*/){
            // If it's not first question then we must check it
            //echo $qid; die;
            if ($qid > 1){
                $criteria = new CDbCriteria();
                $criteria->condition = '`tour_id` = :tour_id';
                $criteria->params = array(':tour_id' => $tid);
             //   $limit = ;
                $criteria->limit = "1";
                $criteria->offset = $qid-2;
                unset($limit);
                
                $res = Task::model()->findAll($criteria);
                $task = '';
                
                if (count($res) > 0){
                    foreach ($res as $value) {
                        $task = $value;
                    }
                    $test =  $session->get('test');
                    $test['answers'][$qid-1]['answer'] = $ans;
                    $test['requests']++;



                    $question = json_decode($task->advanced, true);
                 //   fwrite($hn, "Checking: {$task->task}");
                //    var_dump($question['right_answer']);
                    if ($question['right_answer'] == $ans){
                        $test['points'] += $question['points'];
                        $test['answers'][$qid - 1]['status'] = '+';

                    }
                    else{
                        $test['answers'][$qid - 1]['status'] = '-';
                    }
                    $session['test'] = $test;
                }
            }
            
            // Updating or creating tmp_result
            $criteria = new CDbCriteria();
            $criteria->condition = '`tour_id` = :tour_id AND `user_id` = :user_id';
            $criteria->params = array(':tour_id' => $_POST['tour_id'],
                                  ':user_id' => Yii::app()->user->id);
            
            $tempory = '';
            
            if(TmpResults::model()->count($criteria) > 0){
                $tempory = TmpResults::model()->find($criteria);
            }
            else{
                $tempory = new TmpResults;
            }
            
            $tempory->user_id = Yii::app()->user->id;
            $tempory->tour_id = $_POST['tour_id'];
            $tempory->json = json_encode($session->get('test'));
            if(!$tempory->save())
                print_r($tempory->errors);
        }
        
	public function actionIndex()
	{
            
           $hn =  fopen("output.txt","w");
            // Checking, if this tour is done, when return results
            
            $criteria = new CDbCriteria;
            $criteria->condition = '`tour_id` = :tour_id AND `user_id` = :user_id';
            $criteria->params = array(':tour_id' => $_POST['tour_id'],
                                      ':user_id' => Yii::app()->user->id);
            if (Results::model()->count($criteria) > 0){
                // User has done this tour before
                $result = Results::model()->find($criteria);
                
                $test = json_decode($result->json, true);
                
                $response['mode'] = 'result';

                $response['points'] = $test['points'];
                echo json_encode($response);
                
            }
            else{
                $session = Yii::app()->session;
                $session->open();

                unset($session['test']);
                
                if (!isset($session['test'])){
                    // Filling session with data. If normal data exists it will be loaded
                    $test['points'] = 0;
                    $test['requests'] = 0;
                    $test['current'] = 0;
                    
                    $session['test'] = $test;
                }
                
                // If we have tempory results then loading it to session
                $criteria = new CDbCriteria();
                $criteria->condition = '`tour_id` = :tour_id AND `user_id` = :user_id';
                $criteria->params = array(':tour_id' => $_POST['tour_id'],
                                      ':user_id' => Yii::app()->user->id);
                
                $tempory = Array();
                if(TmpResults::model()->count($criteria) > 0){
                    $tempory = TmpResults::model()->find($criteria);
                    //var_dump($tempory->json);
                    $session['test'] = json_decode($tempory->json, true);
                }
                
               // $session['test']['current']++;
                $test =  $session->get('test');
                $test['current']++;
                $session['test'] = $test;
           //     fwrite($hn, "Current quesion++: {$test['current']}\n");
                
                $this->checkAnswer($_POST['tour_id'], $test['current'], $_POST['answer'], $session/*, $hn*/);
                
                // If we still have questions then return it. Else return results
                $criteria = new CDbCriteria();
                $criteria->condition = '`tour_id` = :tour_id';
                $criteria->params = array(':tour_id' => $_POST['tour_id']);
                $test = $session->get('test');
                $qid = $test['current'];
                $criteria->limit = "1";
                $criteria->offset = $qid-1;
             //   fwrite($hn, "Offset: {$criteria->offset}\n");
                
                $res = Task::model()->findAll($criteria);
               // unset($qid);
                
                if(count($res) > 0){
                    // We have questions
                   // $res = Task::model()->findAll($criteria);
                    
                    $question = '';
                    
                    foreach($res as $val){
                        $question = $val;
                    }

                    $data = json_decode($question->advanced, true);
                    
                    $response['mode'] = 'test';
                    $response['question'] = $question['task'];
                    $response['timeout'] = $data['time'];
                    $response['answers'] = $data['answers'];
                    $response['qid'] = $qid;
                    
                    echo json_encode($response);
                    
                }
                else{
                    // Returning result
                    $test = $session->get('test');
                    
                    $result = new Results;
                    $result->user_id = Yii::app()->user->id;
                    $result->tour_id = $_POST['tour_id'];
                    $result->points = $test['points'];
                    $result->json = json_encode($test);
                    $result->save();
                    
                    $response['mode'] = 'result';

                    $response['points'] = $test['points'];
                    
                    echo json_encode($response);
                }
                
                
            }
            
         //   fclose($hn);
	}

	public function filters()
	{
                return array(
                    'ajaxOnly + index',
                );
	}

	/*public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}