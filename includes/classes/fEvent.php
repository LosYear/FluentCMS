<?php
/*
 * Класс для работы с событиями
 * Нужен для реализации системы расширений
*/
	class fEvent
	{
		public static $events = array();
		public static function fire($event, $args = array())
		{
			if(isset(self::$events[$event]))
			{
				foreach(self::$events[$event] as $func)
				{
					call_user_func($func, $args);
				}
			}
		}
		public static function register($event, $func)
		{
			if(is_callable($func,false,$callable_name)){
				self::$events[$event][] = $func;
			}
		}
	}
	$events = new fEvent();
?>
