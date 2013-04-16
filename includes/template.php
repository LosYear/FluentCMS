<?php
	//Класс шаблона
	class template_class{
		var $values	= array(); //Переменные шаблона
		var $html;
		// Функция загрузки шаблона
		function get_tpl($tpl_name){
			if(empty($tpl_name) || !file_exists($tpl_name)){
				return false;
			}
			else {
				$this->html = join('',file($tpl_name));
			}
		}
		// Функция установки значения
		function set_value($key,$var){
			$key='{'.$key.'}';
			$this->values[$key] = $var;
		}
		// Парсинг шаблона
		function tpl_parse(){
			foreach($this->values as $find => $replace){
				$this->html = str_replace($find, $replace, $this->html);
			}
		}
	}
	// Создание экземляра класса
	$tpl = new template_class;
?>