<?php

class AjaxController extends Controller
{
	public function actionAutorsAutoComplete()
	{
		if(isset($_POST['query'])){
                    $author = Profile::model();
                    
                    $match = addcslashes($_POST['query'], '%_');
                    
                    $criteria = new CDbCriteria();
                    $criteria->condition = "name LIKE :name";
                    $criteria->params = array(':name' => "%$match%");
                    
                    $authors = $author->findAll($criteria);
                    
                    $all = array();
                    
                    foreach($authors as $el){
                        $tmp = array();
                        $tmp['label'] = $el->name;
                        $tmp['value'] = $el->id;
                        
                        $all[] = $tmp;
                    }
                    
                    $result['authors'] = $all;
                    
                    die(json_encode($result));
                }
                die('');
	}
}