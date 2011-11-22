<html>
	<title>
		Установка FluentCMS
	</title>
	<body>
		<center>
		<h1>Добро пожаловать в установщик FluentCMS !</h1>
		<form method=post action="install.php?step=2">
			<h2>База данных</h2>
			Имя базы данных : <input type=text name=db> <br>
			Имя пользователя базы данных : <input type=text name=db_user> <br>
			Пароль пользователя базы данных : <input type=text name=db_pass> <br>
			Хост сервера базы данных (обычно localhost) : <input type=text name=db_host> <br>
			<hr>
			<h2>Информация о сайте</h2>
			Имя сайта : <input type=text name=site_name> <br>
			Описание сайта : <input type=text name=site_describe> <br>
			Копирайты : <input type=text name=copyrights> <br>
			URL сайта : <input type=text name=url> <br>
			<hr>
			<h2>Информация об администраторе</h2>
			Логин : <input type=text name=admin_login> <br>
			Пароль (БУДТЕ ВНИМАТЕЛЬНЫ) : <input type=text name=admin_pass> <br>
			E-MAIL : <input type=text name=admin_mail> <br>
			<input type=submit value=OK>
		</form>
		</center>
	</body>
</html>
<?php
	 if($_REQUEST['step']==='2'){
	 	if(!mysql_connect($_REQUEST['db_host'], $_REQUEST['db_user'], $_REQUEST['db_pass'])) die(mysql_error());
		mysql_select_db($_REQUEST['db']);
		$sql = "SET SQL_MODE=\"NO_AUTO_VALUE_ON_ZERO\";";
		mysql_query($sql) or die(mysql_error());
		$sql = "
		
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `comment` text NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `text_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8; ";
		mysql_query($sql) or die(mysql_error());
		$sql = "

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL,
  `site_name` text NOT NULL,
  `site_describe` text NOT NULL,
  `copyright` text NOT NULL,
  `site_url` text NOT NULL,
  `site_s` text NOT NULL,
  `theme_name` text NOT NULL,
  `language` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
		mysql_query($sql) or die(mysql_error());
		$sql= "
CREATE TABLE IF NOT EXISTS `texts` (
  `id` text NOT NULL,
  `caption` text NOT NULL,
  `text` longtext NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author` text NOT NULL,
  `isPage` tinyint(1) NOT NULL,
  `isHidden` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8; ";
mysql_query($sql) or die(mysql_error());
	$sql = "
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `pass` longtext NOT NULL,
  `email` text NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
	mysql_query($sql) or die(mysql_error());
	$sql = "CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `author` text NOT NULL,
  `folder` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `version` text NOT NULL,
  `cms_version_min` text NOT NULL,
  `cms_version_max` text NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `main_filename` text NOT NULL,
  `contacts` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";	
	mysql_query($sql) or die(mysql_error());
	$sql = "INSERT INTO `".$_REQUEST['db']."`.`users` (`id`, `login`, `pass`, `email`, `group`) VALUES ('1', '".$_REQUEST['admin_login']."', '".md5($_REQUEST['admin_pass'])."', '".$_REQUEST['admin_mail']."', '1');";
	mysql_query($sql) or die(mysql_error());
	$sql = "INSERT INTO `".$_REQUEST['db']."`.`settings` (`site_name`, `site_describe`, `copyright`, `site_url`, `site_s`, `theme_name`, `language`) 
	VALUES ('".$_REQUEST['site_name']."', '".$_REQUEST['site_describe']."', '".$_REQUEST['copyrights']."', '".$_REQUEST['url']."', '/home/site', 'clouds', 'ru');";
	mysql_query($sql) or die(mysql_error());
	$hand = fopen("config.php", "w");
	fwrite($hand, '<?php
	session_start();
	//		РљРѕРЅС„РёРіСѓСЂР°С†РёРѕРЅРЅС‹Р№ С„Р°Р№Р»
	$db_host="'.$_REQUEST['db_host'].'";
	$db="'.$_REQUEST['db'].'";
	$db_user="'.$_REQUEST['db_user'].'";
	$db_pass="'.$_REQUEST['db_pass'].'";
	if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
	mysql_select_db($db);
	$sql="SET NAMES utf8";
	mysql_query($sql);
	$sql="SELECT * FROM `$db`.`settings` LIMIT 1;";
	$r=mysql_query($sql);
	$f=mysql_fetch_array($r);
	$site_name=$f[\'site_name\']; //
	$site_describe=$f[\'site_describe\']; //
	$copyright=$f[\'copyright\']; //
	$site_url=$f[\'site_url\']; //
	$site_s=$f[\'site_s\']; //
	$theme_name=$f[\'theme_name\']; //
	$language=$f[\'language\']; //
	$path = "styles/$theme_name/";
?>');
	echo "<h1>УДАЛИТЕ ФАЙЛ INSTALL.PHP</h1>";
	 }	
?> 
