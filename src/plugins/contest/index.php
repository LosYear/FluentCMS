<?php
    require_once("plugins/contest/lang.php");
    
    function atPanelEcho_contest(){
		echo "<a href=\"index.php?plugin_control=cabinet\"><img title=\"Личный кабинет\" src=\"plugins/contest/imgs/panel.png\"></a><br/>";
	}
	
	function cabinet(){
	    global $lang;
	    echo "<a href=\"index.php?plugin_control=active_tours\">{$lang['active_tours']}</a>";
	}
	
	function active_tours(){
         global $db_host, $db_user, $db_pass, $db, $lang;
         if (!mysql_connect($db_host, $db_user, $db_pass))
          die(mysql_error());
        mysql_select_db($db);	
           
	    $sql = "SELECT * FROM `contest` WHERE `from` < NOW() AND `till` > NOW() AND `type` = 2;";
	    
	    $result = mysql_query($sql) or die($lang['something_went_wrong']);
	    echo "<h1>{$lang['active_tours']}</h1>";
    	for ($i = 0; $i < mysql_num_rows($result); $i++){   
          $r = mysql_fetch_array($result);
          echo "<a href=\"index.php?plugin_control=tour_show&id={$r['id']}\">{$r['name']}</a></br> ";
           
          mysql_query($sql) or die(mysql_error());
    	}	    
	}
    $events->register("login_panel_echo","atPanelEcho_contest"); 
    $events->register("cabinet","cabinet");
    $events->register("active_tours","active_tours");
?>
