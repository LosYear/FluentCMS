<?php

    Yii::import('zii.widgets.CMenu');

    class MenuWidget extends CMenu{
        public $name;
        
        private $_items;
        private $tmp;
        
        /*  
         * Forming tree of elements.
         */
        
        private function formTree($parent_id) { 
            if (isset($this->_items[$parent_id])) { 
                foreach ($this->_items[$parent_id] as $value) {
                    if ($parent_id == 0){
                        $this->tmp[$value['id']] = array('label' => $value['title'], 'url' => Yii::app()->homeUrl.'/'.$value['href']);
                    }
                    else{
                         $this->tmp[$parent_id]['items'][] =
	                         array('label' => $value['title'], 'url' => Yii::app()->homeUrl.'/'.$value['href']);
                    }
                    
                    $this->formTree($value->id); 
                } 
            } 
        } 
        
        public function init(){
            $menu = Menu::model();
            $menu_item = MenuItem::model();
            
            $model = $menu->find('name = :name', array(':name' => $this->name));
            $id = $model['id'];
            unset($model);
            
            
            $criteria=new CDbCriteria;
            $criteria->condition='menu_id=:id';
            $criteria->params=array(':id'=>$id);
            $criteria->order = '`order`';
            $elements=$menu_item->findAll($criteria); 
            
            $sorted = array();
            
            foreach ($elements as $el) {
                $sorted[$el['parent_id']][] = $el; 
            }
            
            $this->_items = $sorted;
                
            $this->tmp = array();
            $this->formTree(0);
            
            $this->items = $this->tmp;
            
            parent::init();
        }
        
    }
?>
