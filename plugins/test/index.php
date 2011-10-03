<?php
	# Тестовый плагин, выводящий что-нибудь вверху и внизу страницы

	class cClass{
		static function f(){
			echo "123";
		}
		static function f2(){
			echo "1235";
		}
	}
	$events->register('title_print_start','cClass::f');
	$events->register('title_print_start','cClass::f2');
?>
