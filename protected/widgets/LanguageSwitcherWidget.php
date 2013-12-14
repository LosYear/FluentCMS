<?php
	class LanguageSwitcherWidget extends CWidget
	{
		public function run()
		{
			$currentUrl = ltrim(Yii::app()->request->url, '/');
			$links = array();

			$all = MultilangHelper::suffixList();
			$end = end($all);

			foreach ($all as $suffix => $name){
				$url = '/' . ($suffix ? trim($suffix, '_') . '/' : '') . $currentUrl;
				echo CHtml::link($name, $url);

				if($name != $end){
					echo " | ";
				}
			}
		}
	}