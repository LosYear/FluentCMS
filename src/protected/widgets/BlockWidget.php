<?php

    class BlockWidget extends CWidget{
        public $name;
        
        public function init(){
            $block = Block::model();
            $model = $block->find('name = :name', array(':name' => $this->name));
            
            $this->render('block', array('model'=>$model));
        }
    }
?>
