<?php
	//session_start();
	//		РљРѕРЅС„РёРіСѓСЂР°С†РёРѕРЅРЅС‹Р№ С„Р°Р№Р»
	$db_host="localhost";
	$db="fluentCMS";
	$db_user="root";
	$db_pass="";
	if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
	mysql_select_db($db);
	$sql="SET NAMES utf8";
	mysql_query($sql);
	$sql="SELECT * FROM `$db`.`settings` LIMIT 1;";
	$r=mysql_query($sql);
	$f=mysql_fetch_array($r);
	$site_name=$f['site_name']; //
	$site_describe=$f['site_describe']; //
	$copyright=$f['copyright']; //
	$site_url=$f['site_url']; //
	$site_s=$f['site_s']; //
	$theme_name=$f['theme_name']; //
	$language=$f['language']; //
	$path = "styles/$theme_name/";
	$cms_vers = "0.2a1";
	$powered_by = "Powered by Fluent CMS 0.2 pre-alpha";
?>
