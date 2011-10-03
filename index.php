<?php
	session_start();
	//error_reporting(0);
    require_once 'config.php';
	require_once 'includes/classes/fEvent.php'; 	 // Подключение системы событий
	require_once 'includes/plugins.php';
	require_once 'includes/functions.php';
	if( isset ($_REQUEST['plugin_control'])){
		require_once 'includes/plugin.control.php';
	}
	else{
		require_once $path."index.php";
	}
	//require_once 'includes/classes/fLog.php'; // Ведение логов
	
?>
