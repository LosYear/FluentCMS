<?php
    require_once("plugins/contest/lang.php");
    session_start();
    
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
	
	function tour_show(){
	    if (isset($_REQUEST['id'])){
	        global $db_host, $db_user, $db_pass, $db, $lang;
            if (!mysql_connect($db_host, $db_user, $db_pass))
              die(mysql_error());
            mysql_select_db($db);
            
            $sql = "SELECT * FROM `contest` WHERE `id`='{$_REQUEST['id']}' LIMIT 1;";
            
            $result = mysql_query($sql) or die(mysql_error());
            $result = mysql_fetch_array($result);
            
            $sql = "SELECT * FROM `contest` WHERE `id`='{$result['rootcat']}' LIMIT 1;";
            $res = mysql_query($sql) or die(mysql_error());
            $res = mysql_fetch_array($res);
            
            echo "<h1>{$result['name']}</h1>";
            echo "<p>{$result['desc']}</p>";
            echo "<p>{$res['name']}</p>";
            echo "<p>{$lang['date']}<br>{$lang['from']} {$result['from']}<br>{$lang['till']} {$result['till']}</p>";
            if ($result['subtype'] == '1'){
                $sql = "SELECT * FROM `results` WHERE user_id='{$_SESSION['id']}' AND tour_id='{$_REQUEST['id']}' LIMIT 1;";
                $result2 = mysql_query($sql);
                if (mysql_num_rows($result2) < 1){
                    echo "<br><b><a href=\"index.php?plugin_control=take_part&id={$result['id']}&type={$result['subtype']}\">{$lang['take_part']}</a></b>";
                }
                else{
                    $result2 = mysql_fetch_array($result2);
                    echo "<br><b>{$lang['you_get']} {$result2['points']} {$lang['points']}</b>";
                }
            }
            else {
                 $sql = "SELECT * FROM `results` WHERE user_id='{$_SESSION['id']}' AND tour_id='{$_REQUEST['id']}' LIMIT 1;";
                 $result2 = mysql_query($sql);
                 if (mysql_num_rows($result2) < 1){
                     $sql = "SELECT * FROM `questions` WHERE tour_id='{$_REQUEST['id']}' LIMIT 1;";
                     $res = mysql_query($sql) or die($lang['something_went_wrong']);
                     $res = mysql_fetch_array($res);
                     $file = "/plugins/contest/data/".$res['question'];
                     
                     echo "<a href=\"$file\">{$lang['download']}</a>  ";
                     echo "<a href=\"index.php?plugin_control=take_part&type=2&tour={$_REQUEST['id']}\">{$lang['upload']}</a>";
                 }
                 else{
                   $result2 = mysql_fetch_array($result2);
                   if ($result2['points'] == '-1'){
                       echo "<br/><b>".$lang['not_checked']."</b>";
                   }
                 }
            }
	    }
	}
	
	function take_part(){
	    if ($_REQUEST['type'] == '1'){
	        global $db_host, $db_user, $db_pass, $db, $lang;
            if (!mysql_connect($db_host, $db_user, $db_pass))
              die(mysql_error());
            mysql_select_db($db);
            
	        /*echo "<form action=\"index.php?plugin_control=check&tour={$_REQUEST['id']}\" method=\"post\">";
	        $result = mysql_query($sql) or die(mysql_error());
            for ($i = 0; $i < mysql_num_rows($result); $i++){   
	          $r = mysql_fetch_array($result);
               echo "<label>{$r['question']}</label><br>";
               
               echo "<div><input type=\"radio\" value=\"1\" name=\"{$r['id']}\"/> {$r['ans1']}</div>";
               echo "<div><input type=\"radio\" value=\"2\" name=\"{$r['id']}\"/> {$r['ans2']}</div>";
               echo "<div><input type=\"radio\" value=\"3\" name=\"{$r['id']}\"/> {$r['ans3']}</div>";
               echo "<div><input type=\"radio\" value=\"4\" name=\"{$r['id']}\"/> {$r['ans4']}</div><br>";
	          
              mysql_query($sql) or die(mysql_error());
            }
            echo "<input type=\"submit\" value=\"{$lang['send']}\" />";
            echo "</form>";*/
	    }
	    else{
	         global $db_host, $db_user, $db_pass, $db, $lang;
             if (!mysql_connect($db_host, $db_user, $db_pass))
              die(mysql_error());
             mysql_select_db($db);
	         echo "<form enctype=\"multipart/form-data\" action=\"index.php?plugin_control=uploadAns&id={$_REQUEST['tour']}\" method='post'>";
             echo "<label for=\"file\">{$lang['uploadAns']}</label><input type=\"file\" name=\"file\"/><br/>";
	         echo "<input type=\"submit\"/ value=\"{$lang['send']}\"> </form>";
	    }
	}
	
	function check(){
	    global $db_host, $db_user, $db_pass, $db, $lang;
        if (!mysql_connect($db_host, $db_user, $db_pass))
            die(mysql_error());
        mysql_select_db($db);
        
        $sql = "SELECT * FROM `questions` WHERE tour_id = '{$_REQUEST['tour']}';";
        
	    $result = mysql_query($sql) or die(mysql_error());
	    $points = 0;
	    $maxpoints = 0;
        for ($i = 0; $i < mysql_num_rows($result); $i++){   
	        $r = mysql_fetch_array($result);

            if ($_REQUEST[$r['id']] == $r['write_ans']){
                $points += $r['point'];
            }
            $maxpoints += $r['point'];
	        
	        mysql_query($sql) or die(mysql_error());
        }
        
        $query = "SELECT MAX(`id`) AS Number FROM `$db`.`results`";
        $res = mysql_query($query);
        $row = mysql_fetch_assoc($res);
        $id = $row['Number'] + 1;
        
        $sql = "INSERT INTO `results` (`id`, `user_id`, `tour_id`, `points`, `state`, `adv`) VALUES ('$id', '{$_SESSION['id']}', '{$_REQUEST['tour']}',
         '$points', '0', '--');";
        mysql_query($sql) or die(mysql_error());
        echo "{$lang['you_get']} $points {$lang['from']} $maxpoints";
	}
	function uploadAns(){
	    global $db_host, $db_user, $db_pass, $db, $lang;
        if (!mysql_connect($db_host, $db_user, $db_pass))
            die(mysql_error());
        mysql_select_db($db);
        
	    if (!class_exists("upload")){
	        require_once 'plugins/contest/classes/class.upload.php';
	    }
        $hphoto = new upload($_FILES['file']);
        $filename = '';
        $ext = '';
        if ( $hphoto->uploaded ){
            $hphoto->file_new_name_body = $_SESSION['id']."_".$_REQUEST['id'];
            $hphoto->file_overwrite = true;
            $path = $_SERVER['DOCUMENT_ROOT'] . "/plugins/contest/data/";
            if ($hphoto->file_src_name_ext == 'docx' || $hphoto->file_src_name_ext == 'doc' || $hphoto->file_src_name_ext == 'rtf' ||
                $hphoto->file_src_name_ext == 'txt' || $hphoto->file_src_name_ext == 'odt'){
                $ext = $hphoto->file_src_name_ext;
                $filename = $_SESSION['id']."_".$_REQUEST['id'];
                $hphoto->process($path);
                if (!$hphoto->processed) {
                  echo $lang['something_went_wrong'] . $hphoto->error;
                }
                $hphoto->clean(); 
            }  
            else{
                die($lang['something_went_wrong']);
            }
        }
        else {
            die($hphoto->error);
        }
        
        // adding to results
        
        $query = "SELECT MAX(`id`) AS Number FROM `$db`.`results`";
        $res = mysql_query($query);
        $row = mysql_fetch_assoc($res);
        $id = $row['Number'] + 1;
        
        $tmp = $filename . "." . $ext;
        $sql = "INSERT INTO `results` (`id`, `user_id`, `tour_id`, `points`, `state`, `adv`) VALUES ('$id', '{$_SESSION['id']}', '{$_REQUEST['id']}',
         '-1', '0', '$tmp');";
        mysql_query($sql) or die(mysql_query);
        
        echo $lang['sended'];
        echo "<br/><a href=\"index.php\">{$lang['back']}</a>";
        
	}
	
	function  addScripts(){
	    if ($_REQUEST['plugin_control'] == 'take_part' && $_REQUEST['type'] == '1'){
	        echo "<script src=\"plugins/contest/js/main.js\" type=\"text/javascript\"></script>";
	    }
	}

	$events->register("login_panel_echo","atPanelEcho_contest"); 
    $events->register("cabinet","cabinet");
    $events->register("active_tours","active_tours");
    $events->register("tour_show","tour_show");
    $events->register("take_part","take_part");
    $events->register("check","check");
    $events->register("fl_head_add_script","addScripts");
    $events->register("uploadAns","uploadAns");
?>
