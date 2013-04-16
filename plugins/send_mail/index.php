<?php
	require_once("plugins/send_mail/config.php");
	function userRegistered(){
		$to  = $_POST['email'] ;
		
		global $site;
		
		$subject = "Регистрация на сайте $site";

		$message = "
		<html>
			<head>
				<title>Регистрация на сайте $site</title>
			</head>
			<body>
				<p>Поздравляем! Вы зарегистрировались на сайте!</p>
				<p>Ваш логин: {$_POST['username']}</p>
				<p>Ваш пароль: {$_POST['password']}</p>
				<p>Теперь Вы можете заполнить информацию о своей команде в своем профиле.<br>С Уважением Администрация $site!</p>
			</body>
		</html>";

		$headers  = "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "From: $site <неотвечать@$site>\r\n";

		mail($to, $subject, $message, $headers);
	}
	
	$events->register("user_registered","userRegistered"); 
?>
