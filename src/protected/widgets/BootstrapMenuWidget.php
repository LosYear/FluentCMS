<?php

    Yii::import('bootstrap.widgets.TbNavbar');

    class BootstrapMenuWidget extends TbNavbar{
        public $name;
        
        private $_items;
        private $tmp;
        
        /*  
         * Forming tree of elements.
         */
        
        private function formTree($parent_id) { 
            if (isset($this->_items[$parent_id])) { 
                foreach ($this->_items[$parent_id] as $value) {
                    $url ='';
                    if ($value['href'] == '/'){
                        $url = Yii::app()->homeUrl;
                    }
                    else{
                        $url = Yii::app()->baseUrl.'/'.$value['href'];
                    }
                    
                    if ($parent_id == 0){
                        $this->tmp[] = array('label' => $value['title'], 'url' => $url);
                    }
                    else{
                         $this->tmp[$parent_id]['items'][] = array('label' => $value['title'], 'url' => $url);
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
            
            $tmp1 = array(array(
                'class' => 'bootstrap.widgets.TbMenu',
                'items' => $this->tmp,
                ));
            
            $right = array(array(
                'class' => 'bootstrap.widgets.TbMenu',
                'htmlOptions'=>array('class'=>'pull-right'),
                'items' => array(
                    array('label' => 'Кабинет', 'url'=>Yii::app()->createUrl('rush/moderator'), 'visible'=>Yii::app()->user->hasRole("Moderator") || Yii::app()->user->isAdmin(), 'icon'=>'briefcase white'),
                    array('label' => 'Кабинет', 'url'=>Yii::app()->createUrl('rush/cabinet'), 'visible'=>!Yii::app()->user->hasRole("Moderator") &&
                        !Yii::app()->user->isGuest && !Yii::app()->user->isAdmin(), 'icon'=>'briefcase white'),
                    array('label' => 'Панель управления', 'url'=>Yii::app()->homeUrl.'/backend.php', 'visible'=>Yii::app()->user->isAdmin(), 'icon'=>'wrench white'),
                    array('label' => 'Сообщения', 'url'=>Yii::app()->createUrl('mailbox/message'), 'visible'=>!Yii::app()->user->isGuest, 'icon'=>'envelope white'),
                    array('label' => 'Выход', 'url'=>Yii::app()->createUrl('user/logout'), 'visible'=>!Yii::app()->user->isGuest, 'icon'=>'off white'),
                    array('label' => 'Вход', 'url'=>Yii::app()->createUrl('user/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label' => 'Регистрация', 'url'=>Yii::app()->createUrl('registration/registration'), 'visible'=>Yii::app()->user->isGuest),
                ),
            ));
            $this->items = array_merge($tmp1, $right);
            
            //print_r($this->items); die;
            
            return parent::init();
        }
        
    }
?>
