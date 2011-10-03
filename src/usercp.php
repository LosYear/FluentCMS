<?php
	session_start();
        require_once 'config.php';
        require_once "langs/".$language.".php";
        require_once 'includes/functions.php';
	if($_REQUEST['mod']==='logout'){
			session_unregister("auth");
			session_unregister("login");
			session_unregister("admin_ses");
			session_unregister("group");
			session_destroy();
			$url="index.php";
			header("location: ".$url);
	}
	else if($_REQUEST['mod']==='login'){
		require_once $path."login.php";
	}
	else if($_REQUEST['mod']==='login_true'){
		$err = array();
		// Сохраняем ошибку
		if(!$_POST['username'] || !$_POST['password']) // Обязательные данные не заданы
			$err[] = 'Все поля должны быть заполнены!';
		if(!count($err)) // Если ошибок нет
		{
			if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
			mysql_select_db($db);
			$login = $_POST['username'];
			$pass = md5( $_POST['password'] );
			$sql = "SELECT * FROM `$db`.`users` WHERE login='$login' AND pass='$pass';";
			$result = mysql_query( $sql );
			$row = mysql_fetch_assoc( $result );
			if($row['login'])
			{
				session_start();
				session_register("auth","login","group","admin_ses");
				$_SESSION['auth'] = true;
				$_SESSION['login'] = $login;
				$_SESSION['group'] = $row['group'];
				$_SESSION['id'] = $row['id'];
				$_SEESSON['admin_ses'] = 0;
			}
			else $err[]='Ошибочное имя пользователя или/и пароль!';
		}
		if($err)
		$_SESSION['msg']['login-err'] = implode('<br />',$err);
		// Сохраняем сообщение об ошибке в сессии
		header("Location: index.php");
		exit;
	}
	else if($_REQUEST['mod']==='register'){
		require_once $path."register.php";
	}
	else if($_REQUEST['mod']==='register_true'){
	   if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
	   mysql_select_db($db);
		if(strlen($_POST['username'])<4 || strlen($_POST['username'])>32)
		{
			$err[]='Имя пользователя должно быть длиной от 3 до 32 символов!';
		}
		if(preg_match('/[^a-z0-9\-\_\.]+/i',$_POST['username']))
		{
			$err[]='Имя пользователя содержит недопустимые символы!';
		}
		if(!is_email($_POST['email']))
		{
		$err[]='Ваш email адрес неправильный!';
		}
		if(!count($err))
		{
			// Если нет ошибок
			$login = $_POST['username'];
			$email = $_POST['email'];
			$pass = $_POST['password'];
			$pass2 = $_POST['password2'];
			if(!$pass === $pass2){
				$err[] = "Введенные пароли не совпадают";
				$_SESSION['msg']['reg-err'] = implode('<br />',$err);
				header("Location: index.php");
			}
			// подготавливаем данные
			$sql="SELECT * FROM `".$db."`.`users`";
			$r=mysql_query($sql);
			$id=mysql_num_rows($r)+1;		
			$pass = md5( $pass );
			$sql = "INSERT INTO `$db`.`users`(`id`,`login`,`pass`,`email`,`group`) VALUES('$id','$login','$pass','$email','0')" ;
			$link = mysql_query( $sql );
		}
		if(count($err))
		{
			$_SESSION['msg']['reg-err'] = implode('<br />',$err);
		}
		header("Location: index.php");
		exit;
				$script = '';
		if($_SESSION['auth'])
		{
			// Скрипт показывает выскальзывающую панель на странице загрузки
			$script = '
			<script type="text/javascript">
			$(function(){
			$("div#panel").show();
			$("#toggle a").toggle();
			});
			</script>';
		}

	}
	else if ( $_REQUEST['mod'] === 'passchange' ){
		$oldpass = md5($_REQUEST['oldpass']); // Получаем данные
		$newpass = md5($_REQUEST['newpass']);
		$newpass2 = md5($_REQUEST['newpass2']);
		
		$sql = "SELECT pass FROM `$db`.`users` WHERE login='{$_SESSION['login']}'"; // Получаем хэщ старого пароля
		$result = mysql_query($sql);
		$f = mysql_fetch_array($result);
		if ( $f['pass'] === $oldpass ) {
			if ( $newpass === $newpass2 ) {
				$sql = "UPDATE `$db`.`users` SET pass='$newpass' WHERE login='{$_SESSION['login']}' LIMIT 1;";
				mysql_query($sql) or die(mysql_error());
			}			
			else{
				die("Пароли не совпадают!");
			}
		}
		else{
			die ( "Неправильно введен старый пароль");
		}
		header("location:index.php");
	}
	else{
		require_once("styles/system/usercp.php");
	}
?>
