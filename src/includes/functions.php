<?php
	include_once("./config.php");
	require_once("./includes/classes/fEvent.php");
	session_start();
	#-------------------Р В РЎвЂєР В РЎС›Р В РІР‚СњР В РІР‚СћР В РІР‚С”Р В Р’В¬Р В РЎСљР В Р’В«Р В РІР‚Сћ-Р В Р’В¤Р В Р в‚¬Р В РЎСљР В РЎв„ўР В Р’В¦Р В РїС—Р…Р В РїС—Р…--------------------------------
	function is_email($email){
		
		if (!eregi("^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-zA-Z]{2,4}$",$email)){
			return false;
		}
		else{
			return true;
		}
	}
	#------------------Р В Р’В¤Р В Р в‚¬Р В РЎСљР В РЎв„ўР В Р’В¦Р В РїС—Р…Р В РїС—Р…-Р В РІР‚СњР В РІР‚С”Р В Р вЂЎ-Р В РІР‚в„ўР В Р’В«Р В РІР‚в„ўР В РЎвЂєР В РІР‚СњР В РЎвЂ™-Р В Р РѓР В РЎвЂ™Р В РІР‚пїЅР В РІР‚С”Р В РЎвЂєР В РЎСљР В РЎвЂ™------------------------
	function fl_title(){
		global $events;
		$events->fire("title_print_start","");
		global $site_name;
		echo $site_name;
		$events->fire("title_print_end","");
	}

	function fl_desc(){
		global $events;
		$events->fire("desc_print_start","");
		global $site_describe;
		echo $site_describe;
		$events->fire("desc_print_end","");
	}
	
	function fl_mainp(){
		return $site_url;
	}
	
	function fl_userp(){
		if($_SESSION['auth']===true){
			return "usercp.php";
		}
		else{
			return "";
		}
	}
	
	function fl_adminp(){
		if($_SESSION['auth']===true &&  $_SESSION['group'] === '1' ){
			return "usercp.php";
		}
		else{
			return "";
		}
	}
	
	function fl_login_logout(){
		if ( $_SESSION['auth']===true){
			return $site_url."usercp.php?mod=logout";
	 }
		else {
			return $site_url."login.php";
		}
	}
	
	function fl_reg(){
		if ( $_SESSION['auth']===true){
			return "";
		}
		else {
		 return $site_url."register.php";
		}
	}	
	
	function fl_texts($template){
		global $events;
		$events->fire("content_print_start","");
        global $db_host, $db_user, $db_pass, $db;
        $base = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
		mysql_select_db($db);
		$sql="SET NAMES utf-8";
		mysql_query($sql);
		$query="SELECT * FROM `$db`.`texts` WHERE isPage=0 AND isHidden=0 ORDER BY `data` DESC";
		$result=mysql_query($query);
		global $language,$path;
        $str="langs/".$language.".php";
        require_once $str;
		for ($i=0; $i<mysql_num_rows($result);$i++)
		{
			$events->fire("article_print_start","");
			$r=mysql_fetch_array($result);
			$id=$r['id'];
			$id="$id";
            $m="<!-- more -->";
			if(!strstr($r['text'],$m)){ // Р В РІР‚СњР В Р’В»Р РЋР РЏ Р В РЎС™Р В РЎвЂєР В Р’В Р В РЎвЂ™
				$t2=$r['text'];
			}
			else{
				$t2=substr($r['text'],0,strpos($r['text'],$m));
				global $next;
				$t2=$t2."..."." "."<A href=index.php?mod=shownews&p=".$id.">".$next."</A>";
			}
			// Replacing variables in template
			
			$text = "";
			$text = str_replace("%id%",$id,$template);
			$text = str_replace("%title%",$r['caption'],$text);
			$text = str_replace("%author%",$r['author'],$text);
			$text = str_replace("%text%",$t2,$text);
			$text = str_replace("%date%",$r['data'],$text);			
			
			//echo "<A href=index.php?mod=shownews&p=".$id.">".$r['caption']."</A><br>".$t2."<br /><hr>";
			echo $text;
			mysql_query($query) or die(mysql_error());
			$events->fire("article_print_end","");
		}
		$events->fire("content_print_end","");
	}
	function fl_pages(){
		global $events;
		$events->fire("pages_items_print_start","");
        global $db_host, $db_user, $db_pass, $db;
        if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
		mysql_select_db($db);
		$query="SELECT * FROM `$db`.`texts` WHERE isPage=1 ORDER BY `data` DESC";
		$result=mysql_query($query);
		$text="";
		global $language,$path;
        $str='langs/'.$language.".php";
		require_once $str;
		for ($i=0; $i<mysql_num_rows($result);$i++)
		{
			$events->fire("page_item_print_start","");
			$r=mysql_fetch_array($result);
			$id=$r['id'];
			$id="$id";
			$text=$text." <A href=index.php?mod=shownews&p=".$id.">".$r['caption']."</A><br>  ";
			mysql_query($query) or die(mysql_error());
			$events->fire("page_item_print_end","");
		}
		echo $text;
		$events->fire("pages_items_print_end","");
	}	
	function fl_text($p, $template){
		global $events;
		$events->fire("farticle_print_start","");
        global $db_host, $db_user, $db_pass, $db;
        if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
		mysql_select_db($db);
		$query="SELECT * FROM `$db`.`texts` WHERE id=$p";	
		$result=mysql_query($query);	
		$r=mysql_fetch_array($result);
		$text = "";
		$text = str_replace("%id%",$id,$template);
		$text = str_replace("%title%",$r['caption'],$text);
		$text = str_replace("%author%",$r['author'],$text);
		$text = str_replace("%text%",$r['text'],$text);
		$text = str_replace("%date%",$r['data'],$text);	
		echo $text;
		$events->fire("farticle_print_end","");
	}
	
	function fl_menu_think(){
		global $events;
		$events->fire("menu_print_start");
		global $language;
		global $theme_name;
		$str='lang/'.$language.".php";
		fl_pages();
		$events->fire("menu_print_end");
	}
	function fl_logreg_panel(){
		require_once('styles/system/log_reg_panel.php');
	}
	function fl_copyright(){
		global $events;
		$events->fire("footer_print_start","");
		$events->fire("copyright_print_start","");
		global $copyright;
		global $powered_by;
		echo $copyright."<br>";
		echo "<b>".$powered_by."</b>";
		$events->fire("copyright_print_end","");
		$events->fire("footer_print_end","");
	}
	
	function fl_page_content_think($template, $full, $pre_empty, $post_empty){
		global $events;
		if($_REQUEST['mod']==='shownews'){
			fl_text($_REQUEST['p'], $full);
			echo "<BR/>" ;
			require_once ('includes/comments_index.php');
		}
		else if( isset($_POST['empty'])){
			echo $pre_empty;
			$events->fire($_POST['empty'],"");
			echo $post_empty;
		}
		else if($_REQUEST['mod']==''){
			fl_texts($template);
		}
		else{
			echo "Ooops.";
		}
	}
	
	function fl_sidebar_print(){
		global $events;
		$events->fire("fl_sidebar_print");
	}
?>
