<?php
    class BannerWidget extends CWidget{
        public $name;

        public function init(){
            $model = Banner::model()->find('`name` = :name', array(':name' => $this->name));

            if($model->status == 1){
                $model->incrementViews();

                if($model->type == 'image'){
                    $this->render('image', array('model'=>$model));
                }
                elseif($model->type == 'swf'){
                    $this->render('flash', array('model'=>$model));
                }
            }
        }
    }