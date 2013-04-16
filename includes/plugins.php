<?php
	# Файл, отвечающий за подключение плагинов #
	session_start();
	if (!mysql_connect($db_host, $db_user, $db_pass))
		die(mysql_error());
	mysql_select_db($db);
	$sql = "SELECT id,name,folder,main_filename FROM `$db`.`modules` WHERE is_active=1;";
	$result = mysql_query($sql);
	$pid = 0;
	for( $i = 0; $i < mysql_num_rows($result); $i++ ){
		$r = mysql_fetch_array($result);
		$folder = $r['folder'];
		$main = $r['main_filename'];
		$pid = $r['id'];
		require_once('plugins/'.$folder.'/'.$main);
		mysql_query($sql) or die(mysql_error());
	}
    
?>
