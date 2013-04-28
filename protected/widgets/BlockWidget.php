<?php

    class BlockWidget extends CWidget{
        public $name;
        
        public function init(){
            $model = Yii::app()->cache->get("block_".$this->name);
            
            if ($model === false){
                $block = Block::model();
                $model = $block->find('name = :name', array(':name' => $this->name));
                
                Yii::app()->cache->set("block_".$this->name, $model, Yii::app()->params['cacheDuration']);
            }
            
            $this->render('block', array('model'=>$model));
        }
    }
?>
