<?php

    Yii::import('zii.widgets.CMenu');

    class MenuWidget extends CMenu{
        public $name;
        
        private $_items;
        private $tmp;
        
		/**
		* Checking activity
		*/
		
		private function __active($url){
			$t = trim(Yii::app()->request->requestUri, '/');
			//echo $t.'__'.$url.'<br/>';
			return $t == $url;
		}
		
        /*  
         * Forming tree of elements.
         */
        
        private function formTree($parent_id) { 
            if (isset($this->_items[$parent_id])) { 
                foreach ($this->_items[$parent_id] as $value) {
                    if ($parent_id == 0){
                        $this->tmp[$value['id']] = array('label' => $value['title'], 'url' => Yii::app()->homeUrl.MultilangHelper::addLangToUrl($value['href']));
                    }
                    else{
                         $this->tmp[$parent_id]['items'][] =
	                         array('label' => $value['title'], 'active' =>$this->__active($value['href']), 'url' => Yii::app()->homeUrl.MultilangHelper::addLangToUrl($value['href']));
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
            $criteria->condition='menu_id=:id AND root_id = -1 AND status=1';
            $criteria->params=array(':id'=>$id);
            $criteria->order = '`order`';
            $elements=$menu_item->findAll($criteria);

	        $elements1 = array();
	        $transformation[0] = 0;
	        foreach($elements as $el){
		        $tmp = $el->getTranslation(Language::getCurrentID());
		        $elements1[] = $tmp;
		        $transformation[$el->id] = $tmp->id;
            }

	        $elements2 = array();
	        foreach($elements1 as $el){
		        $id = $el['parent_id'];
		        $el['parent_id'] = $transformation[$id];
		        $elements2[] = $el;
	        }

	        $elements = $elements2;

            $sorted = array();
            
            foreach ($elements as $el) {
                $sorted[$el['parent_id']][] = $el; 
            }
            
            $this->_items = $sorted;
                
            $this->tmp = array();
            $this->formTree(0);
			foreach($this->tmp as $key => $item){
				$t = Yii::app()->homeUrl . Yii::app()->request->requestUri;
				if($item['url'] == $t){
					$item['active'] = true;
					$this->tmp[$key] = $item;
				}
			}			
						
            $this->items = $this->tmp;
            
            parent::init();
        }
        
    }
?>
