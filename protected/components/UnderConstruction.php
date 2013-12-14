<?php
	class UnderConstruction extends CApplicationComponent{

		public $locked = false;
		public $type = 'constantly';
		public $until = '';
		public $view;

		public function init(){
			if(!isset(Yii::app()->session['locked'])){
				Yii::app()->session['locked'] = true;
			}
			if(isset($_GET['locked'])){
				Yii::app()->session['locked'] = $_GET['locked'];
			}
			$this->until = strtotime($this->until);

						if($this->locked && Yii::app()->session['locked']){
				if($this->type == 'constantly'){
					require(Yii::getPathOfAlias($this->view).'.php');
					Yii::app()->end();
				}
				elseif($this->type == 'until'){
					if($this->until > strtotime("now")){
						$diff = $this->until - strtotime("now");

						require(Yii::getPathOfAlias($this->view).'.php');
						Yii::app()->end();
					}
				}
			}
		}
	}
?>