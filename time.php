<?php
	$db_host = "localhost";
	$db = "fluentCMS";
	$db_user = "root";
	$db_pass = "";
	mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
	mysql_select_db($db);
	$sql = "SET NAMES utf8";
	mysql_query($sql);
	$sql = "SELECT NOW();";
	$r = mysql_query($sql);
	$f = mysql_fetch_array($r);
	//$nextWeek = time() + (7 * 24 * 60 * 60); 	// 7 days; 24 hours; 60 mins; 60secs
	//echo 'Now:       '. date('Y-m-d') ."<br/>";
	//echo 'Next Week: '. date('Y-m-d', $nextWeek) ."<br/>";		// or using strtotime():
	//echo 'Next Week: '. date('Y-m-d', strtotime('+1 week')) ."<br/><br/>";
	//echo strtotime("now"), "<br/>";
	//echo strtotime("now - 8 hours"), "<br/><br/>";
	
	echo 'Database time:&emsp;&emsp;'.date('j F Y h:i:s A', strtotime($f[0]))."<br/>";
	echo 'Database time:&emsp;&emsp;'.date('j F Y h:i:s A', strtotime($f[0]." - 11 hours - 10 minutes"))."<br/>";
	echo 'Server time:&emsp;&emsp;'.date('j F Y h:i:s A', strtotime("now"))."<br/>";
	echo 'Server time - 12 hours:&emsp;&emsp;'.date('j F Y h:i:s A', strtotime("now - 11 hours - 10 minutes"))."<br/>";
?> 
