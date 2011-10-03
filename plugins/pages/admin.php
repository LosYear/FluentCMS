<?php 
    require_once '../plugins/pages/lang.php';
    require_once("../includes/template.php");
    if ($_POST['adminmode']){
        require 'styles/templates/header.htm';
        $tpl->get_tpl("styles/templates/menu.htm");
		$tpl->set_value("THEME", $theme_name);
		$tpl->tpl_parse();
		$header = $tpl->html;
		echo $header . "<br>";
		echo "<xml:namespace ns=\"urn:schemas-microsoft-com:vml\" prefix=\"v\" />
		<v:roundrect arcsize=\".04\" fillcolor=\"#000\">
			<center>";
        // printing teams list
        if ( !isset($_REQUEST['id'])){
        	function teams_echo(){
        	    global $db_host, $db_user, $db_pass, $db, $lang;
        		if (!mysql_connect($db_host, $db_user, $db_pass))
        		  die(mysql_error());
        		mysql_select_db($db);
        		$sql = "SELECT id,name,photo FROM `pages`;";
        		$result = mysql_query($sql) or die($lang['something_went_wrong']);
        		echo "<h1>{$lang['profiles']}</h1>";
        		
        		for($i = 0; $i < mysql_num_rows($result); $i++){
        		    $r = mysql_fetch_array($result);
        		    $id = $r['id'];
        		    $name = $r['name'];
        		    $photo = $r['photo'];
            		if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/plugins/pages/data/{$photo}_mini.png")){
    		            $photo = 'unknown';
    		        }
		    
        		    echo "<div id=\"team\"><img src=\"http://{$_SERVER['SERVER_NAME']}/plugins/pages/data/{$photo}_mini.png\"><a href=\"index.php?mod=apps&plugin=fl_profiles&id=$id\">$name</a></div><hr/>";
        		}
    	    }
    	    teams_echo();
        }
        else {
            if ($_REQUEST['edit'] == 'true'){
                global $db_host, $db_user, $db_pass, $db, $lang;
        		if (!mysql_connect($db_host, $db_user, $db_pass))
        		  die(mysql_error());
        		mysql_select_db($db);
        		$name = $_REQUEST['name'];
        		$teacher = $_REQUEST['teacher'];
        		$school = $_REQUEST['school'];
        		$team = $_REQUEST['about_team'];
        		$photo = $_REQUEST['id'];
        		
        		require_once '../plugins/pages/classes/class.upload.php';
        		
                $hphoto = new upload($_FILES['photo']);
    		    if ( $hphoto->uploaded ){
        		    $hphoto->file_name_body_pre = "{$_REQUEST['id']}_";
        		    $hphoto->file_new_name_body = "full";
        		    $hphoto->file_overwrite = true;
        		    $hphoto->image_resize = true;
        		    $hphoto->image_ratio = true;
        		    $hphoto->image_y = 300;
        		    $hphoto->image_x = 300;
        		    $path = $_SERVER['DOCUMENT_ROOT'] . "/plugins/pages/data/";
        		    $hphoto->image_convert = 'png';
        		    $hphoto->process($path);
                    if (!$hphoto->processed) {
                      echo $lang['something_went_wrong'] . $hphoto->error;
                    }
                    
                    $hphoto->file_name_body_pre = "{$_REQUEST['id']}_";
                    $hphoto->file_new_name_body = "mini";
        		    $hphoto->file_overwrite = true;
        		    $hphoto->image_resize = true;
        		    $hphoto->image_ratio = true;
        		    $hphoto->image_y = 100;
        		    $hphoto->image_x = 100;
        		    $hphoto->image_convert = 'png';
        		    $hphoto->process($path);
        		    if (!$hphoto->processed) {
                      echo $lang['something_went_wrong'] . $hphoto->error;
                    }
        
        		    $hphoto->file_name_body_pre = "{$_REQUEST['id']}_";
        		    $hphoto->file_new_name_body = "origin";
        		    $hphoto->file_overwrite = true;
        		    $hphoto->image_resize = false;
        		    $hphoto->image_ratio = false;
        		    $hphoto->image_convert = 'png';
        		    $path = $_SERVER['DOCUMENT_ROOT'] . "/plugins/pages/data/";
        		    $hphoto->process($path);
                    if (!$hphoto->processed) {
                      echo $lang['something_went_wrong'] . $hphoto->error;
                    }
                
                    $hphoto->clean();
                
    		    }
		
        		$sql = "UPDATE `pages` SET `name`='{$name}', `teacher`='{$teacher}', `school`='{$school}', `about_team`='{$team}', `photo`='{$photo}'
        			WHERE `id`={$_REQUEST['id']} LIMIT 1;";
        		mysql_query($sql) or die($lang['something_went_wrong']);
        		echo $lang['profile_edited'];
            }
            else {        		
                function profile_edit(){
                    // Info printing
                    global $db_host, $db_user, $db_pass, $db, $lang;
        		    if (!mysql_connect($db_host, $db_user, $db_pass))
        		      die(mysql_error());
        		    mysql_select_db($db);
        		    if(isset($_REQUEST['id'])){
        		        $id = $_REQUEST['id'];
        		    }
        		    else{
        		        $id = $_SESSION['id'];
        		    }
        		    $sql = "SELECT * FROM `pages` WHERE id={$id}";
        		    $result = mysql_query($sql) or die($lang['something_went_wrong']);
        		    $result = mysql_fetch_array($result);
        		    
        		    $photo = $id;
                    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/plugins/pages/data/{$photo}_mini.png")){
		                $photo = 'unknown';
		            }
        		    echo "<h1>{$result['name']}</h1>";
        		    echo "<p><a href=\"http://{$_SERVER['SERVER_NAME']}/plugins/pages/data/{$photo}_origin.png\"><img src=\"http://{$_SERVER['SERVER_NAME']}/plugins/pages/data/{$photo}_full.png\"></a></p>"; /* Photo */
        		    echo "<p>{$result['about_team']}</p>";
        		    echo "<p>{$lang['teacher']} {$result['teacher']}</p>"; 
        		    echo "<p>{$lang['school']} {$result['school']}</p>";
        		    
        		    // Editing fields echo
        		    
        		    $sql = "SELECT * FROM `pages` WHERE id='{$id}'";
    		        $result = mysql_query($sql) or die($lang['something_went_wrong']);
    		        $result = mysql_fetch_array($result);
    		        echo "<form enctype=\"multipart/form-data\" action=\"index.php?mod=apps&plugin=fl_profiles&id=$id&edit=true\" method=\"post\">";
        			    echo "<hr/><label for=\"name\">{$lang['team_name']}</label><br/><input type=\"text\" name=\"name\" value=\"{$result['name']}\" /><br/>";
        			    echo "<label for=\"teacher\">{$lang['teacher']}</label><br/><input type=\"text\" name=\"teacher\" value=\"{$result['teacher']}\" /><br/>";
        			    echo "<label for=\"school\">{$lang['school']}</label><br/><input type=\"text\" name=\"school\" value=\"{$result['school']}\" /><br/>";
        			    echo "<label for=\"about_team\">{$lang['about_team']}</label><br/><textarea rows=\"5\" cols=\"30\" name=\"about_team\">{$result['about_team']}</textarea><br/>";
        			    echo "<img src=\"http://{$_SERVER['SERVER_NAME']}/plugins/pages/data/{$photo}_mini.png\"><br/>";
        			    echo "<label for=\"photo\">{$lang['photo']}</label><br/><input type=\"file\" name=\"photo\" ><br/>";
        			    echo "<input type=\"submit\" value=\"{$lang['edit']}\">";
    		        echo "</form>";	
                }
                profile_edit(); 
            }
        }
        echo "</center>
		</v:roundrect>";
    
    }
    else{
        function controlPanel(){
    	    echo "<tr><td>Команды</td><td><a href=\"index.php?mod=apps&plugin=fl_profiles\"><img src=\"../plugins/pages/imgs/manage.png\"></img></a></td></tr>";
        }
        if(isset($events)){
            $events->register("fl_admin_apps","controlPanel");
        }
    }
?>