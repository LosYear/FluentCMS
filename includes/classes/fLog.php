<?php
/*
	Класс для ведения логов
*/

	class fLog {
		private $filename; // Имя файла, в котором ведется лог
		private $file;
		/* Конструкторы класса*/
		
		fLog() {  // Конструктор класса, без параметров
			$filename = "log.txt";
			$file = fopen( $filename , "w" );
		}
		fLog ( $log_filename ) { // Конструктор, если имя файла передано
			$filename = $log_filename;
			$file = fopen( $filename , "w" );
		}
		
		/* Деструктор класса */
		
		~fLog {
			$filename = 0 ;
			fclose( $file );
			$file = 0;
		}
		
		/* Функции класса */
		
		fWrite ( $event_name ){ // Запись текста в лог. В качестве параметра передается текст( событие )
			$tmp_str = time()." : ".$event_name;
			fwrite( $file , $tmp_str );
			$tmp_str = 0;
		}
		
	}
?>
