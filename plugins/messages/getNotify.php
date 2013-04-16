<?php
	session_start();
	
	if($_SESSION['auth'] == true){ // User logged in
		if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') { // We must know, that request was sent wrom AJAX
			require_once("../../config.php");
			require_once("msg.class.php");
			
			if (!mysql_connect($db_host, $db_user, $db_pass))
				die(mysql_error());
			mysql_select_db($db);
			
			$newMsg = $msg_ex->returnNew($_SESSION['id']);
			
			mysql_close();
			
			$response = "{\"newMsg\" : \"$newMsg\"}";
			echo $response;
		}
	}
	else{
		$response = "{\"newMsg\" : \"0\"}";
		echo $response;
	}

?>