<?php
	class msg {
		function __contruct(){ // Конструктор класса
		
		}
		
		function __destruct(){ // Деструктор класса
		
		}
		
		private function changeWrapper( $wrapper, $id ){
			 $result = str_replace("%id%",$id,$wrapper);
			 return $result;
		}
		
		public function sendMsg($title, $text, $to, $from){ // Отправка сообщения
			// Установим подключение к базе
			global $db_host, $db_user, $db_pass, $db;
			if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
			mysql_select_db($db);
			
			// Получим id
			$sql = "SELECT MAX(`id`) AS Number FROM `messages`";
            $res = mysql_query($sql);
            $row = mysql_fetch_assoc($res);
            $id = $row['Number'] + 1;
			
			// Формируем запрос
			$title = mysql_real_escape_string($title);
			$text = mysql_real_escape_string($text);
			
			$sql = "INSERT INTO `messages` (`id`, `from`, `to`, `title`, `text`, `date`, `state`, `hidden`)
			VALUES ('{$id}', '{$from}', '{$to}', '{$title}', '{$text}', CURRENT_TIMESTAMP, '1', '0');";
			
			mysql_query($sql) or die(mysql_error());
			mysql_close();
		
		}
		
		public function deleteMsg($id, $user_id){
			// Установим подключение к базе
			global $db_host, $db_user, $db_pass, $db;
			if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
			mysql_select_db($db);
			
			// Делаем выбор в базе с записью, для определения значения hiddne
			$sql = "SELECT * FROM `messages` WHERE `id`='{$id}' LIMIT 1;";
			$result = mysql_query($sql);
			$result = mysql_fetch_array($result);
			
			$val = $result['hidden'];
			$from = $result['from'];
			$to = $result['to'];
			$hidden = 0;
			
			if($val == '0'){ // Скрыть для одного из юзеров
				if( $user_id == $from ){
					$hidden = 1; // Пользователь - автор
				}
				else{
					// Пользователь - получатель
					$hidden = 2;
				}
			}
			else{ // Удаляем, после проверки, что нам не скормили того же пользователя
				if ( $val != $user_id ){ // Проверка
					$hidden = 3;
				}
			}
			
			if( $hidden !=3 ){
				// Составим запрос для изменения состояния
				
				$sql = "UPDATE `messages` SET `hidden` = '{$hidden}' WHERE `id` ='{$id}' LIMIT 1 ;";
				mysql_query($sql) or die(mysql_error());
			}
			else{
				// Удаляем сообщение из базы
				$sql = "DELETE FROM `messages` WHERE `id` = '{$id}' LIMIT 1;";
				mysql_query($sql) or die(mysql_error());
			}
			
			mysql_close();
		}
		
		public function printNew($user_id, $wrapper_pre, $wrapper_post){ // Возвращает строку с новыми сообщениями
			// Установим подключение к базе
			global $db_host, $db_user, $db_pass, $db;
			if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
			mysql_select_db($db);
			
			$sql = "SELECT * FROM `messages` WHERE `state`='1' AND `to`='{$user_id}' AND `hidden` != '2';";
			$result = mysql_query($sql) or die(mysql_error());
			
			
			
			$string = "";
			for ($i = 0; $i < mysql_num_rows($result); $i++){   
			  $r = mysql_fetch_array($result);
			  
			  $tmp_wrp_pre = $this->changeWrapper($wrapper_pre, $r['id']);
			  $tmp_wrp_post = $this->changeWrapper($wrapper_post, $r['id']);
			  
			  $string .=  $tmp_wrp_pre;
			  $string .= "<b>{$r['title']}</b><br />";
			  $string .= "<p>{$r['text']}</p><br />";
			  $string .= $tmp_wrp_post;
			   
			  mysql_query($sql) or die(mysql_error());
			}
			
			mysql_close();
			return $string;
		}

		public function printInbox($user_id, $wrapper_pre, $wrapper_post){ // Возвращает строку с сообщениями
			// Установим подключение к базе
			global $db_host, $db_user, $db_pass, $db;
			if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
			mysql_select_db($db);
			
			$sql = "SELECT * FROM `messages` WHERE `to`='{$user_id}'  AND `hidden` != '2';";
			$result = mysql_query($sql) or die(mysql_error());
			
			$string = "";
			for ($i = 0; $i < mysql_num_rows($result); $i++){   
			  $r = mysql_fetch_array($result);
			  
			  $tmp_wrp_pre = $this->changeWrapper($wrapper_pre, $r['id']);
			  $tmp_wrp_post = $this->changeWrapper($wrapper_post, $r['id']);
			  
			  $string .=  $tmp_wrp_pre;
			  $string .= "<b>{$r['title']}</b><br />";
			  $string .= "<p>{$r['text']}</p><br />";
			  $string .= $tmp_wrp_post;
			   
			  mysql_query($sql) or die(mysql_error());
			}
			
			mysql_close();
			return $string;
		}	
		
		public function printOutbox($user_id, $wrapper_pre, $wrapper_post){ // Возвращает строку с отправленными сообщениями
			// Установим подключение к базе
			global $db_host, $db_user, $db_pass, $db;
			if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
			mysql_select_db($db);
			
			$sql = "SELECT * FROM `messages` WHERE `from`='{$user_id}' AND `hidden` != '1';";
			$result = mysql_query($sql) or die(mysql_error());
			
			$string = "";
			for ($i = 0; $i < mysql_num_rows($result); $i++){   
			  $r = mysql_fetch_array($result);
			  
			  $tmp_wrp_pre = $this->changeWrapper($wrapper_pre, $r['id']);
			  $tmp_wrp_post = $this->changeWrapper($wrapper_post, $r['id']);
			  
			  $string .=  $tmp_wrp_pre;
			  $string .= "<b>{$r['title']}</b><br />";
			  $string .= "<p>{$r['text']}</p><br />";
			  $string .= $tmp_wrp_post;
			   
			  mysql_query($sql) or die(mysql_error());
			}
			
			mysql_close();
			return $string;
		}
		
		public function printMsg($id){ // Вывод конкретного сообщения
		// Установим подключение к базе
			global $db_host, $db_user, $db_pass, $db;
			if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
			mysql_select_db($db);
			
			$sql = "SELECT * FROM `messages` WHERE `id`='{$id}';";
			$result = mysql_query($sql) or die(mysql_error());
			
			$result = mysql_fetch_array($result);
			
			$string .= "<b>{$result['title']}</b><br />";
			$string .= "<p>{$result['text']}</p><br />";
			
			mysql_close();
			return $string;
		}
		
		public function changeStatus($id){ // Смена статуса сообщения
		// Установим подключение к базе
			global $db_host, $db_user, $db_pass, $db;
			if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
			mysql_select_db($db);
			
			$sql = "UPDATE `messages` SET `state` = '0' WHERE `id` ='{$id}' LIMIT 1 ;";
			mysql_query($sql) or die(mysql_error());
			
			mysql_close();
		}
		
		public function returnNew($user_id){ // Возвращает количество новых сообщений
		// Установим подключение к базе
			global $db_host, $db_user, $db_pass, $db;
			if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
			mysql_select_db($db);
			
			$sql = "SELECT * FROM `messages` WHERE `state` = '1' AND `to` = '{$user_id}';";
			$result = mysql_query($sql) or die(mysql_error());
			
			return mysql_num_rows($result);
			
			mysql_close();
		}
	}
	
	
	
	$msg_ex = new msg; // Создаем экземпляр.
?>