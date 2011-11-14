<?php 
    require_once '../plugins/contest/lang.php';
    if ( $_POST['adminmode'] === true){
        $html = '';
        if (isset($_REQUEST['sub']) || isset($_REQUEST['step'])){
            if ( $_REQUEST['sub'] == 'add' && $_REQUEST['type'] == '1'){ // Subject
                if ($_REQUEST['step'] == '1'){
                    $html = "<form action=\"index.php?mod=apps&plugin=fl_concore&sub=add&step=2&type=1\" method=\"post\">";
                    	$html .= "<label for=\"name\">{$lang['name']}</label> <input type=\"text\" name=\"name\"/><br/>";
                    	$html .= "<label for=\"desc\">{$lang['desc']}</label> <input type=\"text\" name=\"desc\"/><br/>";
                    	$html .= "<input type=\"submit\" value=\"{$lang['create']}\"/> ";
					$html .= "</form>";
					require("../admin/styles/templates/empty.php");             	
                }
                else if( $_REQUEST['step'] == '2' ){
                    global $db_host, $db_user, $db_pass, $db;
		            if (!mysql_connect($db_host, $db_user, $db_pass))
		              die(mysql_error());
		            mysql_select_db($db);
		            
		            $query = "SELECT MAX(`id`) AS Number FROM `$db`.`contest`";
			        $res = mysql_query($query);
			        $row = mysql_fetch_assoc($res);
			        $id = $row['Number'] + 1;
		            
		            $sql = "INSERT INTO `contest` (
                        `id` ,
                        `type` ,
                        `name` ,
                        `desc` ,
                        `rootcat` ,
                        `subtype` ,
                        `from` ,
                        `till` 
                        )
                        VALUES (
                        '$id', '1', '{$_REQUEST['name']}', '{$_REQUEST['desc']}', '-1', '-1', NOW(),NOW()
                        );";
		            mysql_query($sql) or die($lang['something_went_wrong']);
		            $html .= $lang['created'];
		            $html .= "<br/><a href=\"index.php?mod=apps&plugin=fl_concore\">{$lang['back']}</a>";
		            require("../admin/styles/templates/empty.php"); 
                }                
            }
            elseif ($_REQUEST['sub'] == 'add' && $_REQUEST['type'] == '2' ){
                if ( $_REQUEST['step'] == '1'){
                     $html = "<form action=\"index.php?mod=apps&plugin=fl_concore&sub=add&step=2&type=2\" method=\"post\">";
                    	$html .= "<label for=\"name\">{$lang['name']}</label> <input type=\"text\" name=\"name\"/><br/>";
                    	$html .= "<label for=\"desc\">{$lang['desc']}</label> <input type=\"text\" name=\"desc\"/><br/>";
                    	$html .= "<label for=\"contest\">{$lang['type_1']}</label><select name=\"contest\">";
                    	
                    	global $db_host, $db_user, $db_pass, $db;
		                if (!mysql_connect($db_host, $db_user, $db_pass))
		                  die(mysql_error());
		                mysql_select_db($db);
		                $sql = "SELECT id, name FROM `contest` WHERE type=1;";
		                $result = mysql_query($sql);
		                for ($i = 0; $i < mysql_num_rows($result); $i++){   
			              $r = mysql_fetch_array($result);
			              $html .= "<option value=\"{$r['id']}\">{$r['name']}</option>";
			              
                          mysql_query($sql) or die(mysql_error());
		                }
		                $html .= "</select>";
		                
		                $html .= "<br/><label for=\"subtype\">{$lang['type']}</label>";
		                $html .= "<select name=\"subtype\">
		                			<option value=\"1\">{$lang['quick']}</option>
		                			<option value=\"2\">{$lang['full']}</option></select>";
		                $html .= "<br/><label>{$lang['date']}</label><br/><label>{$lang['from']}</label>";
		                $html .= "<input type=\"text\" name=\"from\"></input><br/>";
		                $html .= "<label>{$lang['till']}</label><input type=\"text\" name=\"till\" /><br/>";
		                $html .= "<input type=\"submit\" value=\"{$lang['create']}\"/> ";
					$html .= "</form>";
					require("../admin/styles/templates/empty.php"); 
                }
                else if( $_REQUEST['step'] == '2'){
                    global $db_host, $db_user, $db_pass, $db;
		            if (!mysql_connect($db_host, $db_user, $db_pass))
		              die(mysql_error());
		            mysql_select_db($db);
		            
		            $query = "SELECT MAX(`id`) AS Number FROM `$db`.`contest`";
			        $res = mysql_query($query);
			        $row = mysql_fetch_assoc($res);
			        $id = $row['Number'] + 1;
		            
		            $sql = "INSERT INTO `contest` (
                        `id` ,
                        `type` ,
                        `name` ,
                        `desc` ,
                        `rootcat` ,
                        `subtype` ,
                        `from` ,
                        `till` 
                        )
                        VALUES (
                        '$id', '2', '{$_REQUEST['name']}', '{$_REQUEST['desc']}', '{$_REQUEST['contest']}', '{$_REQUEST['subtype']}', '{$_REQUEST['from']}','{$_REQUEST['till']}'
                        );";
		            mysql_query($sql) or die($lang['something_went_wrong']);

		            $html .= $lang['created'];
		            $html .= "<br/><a href=\"index.php?mod=apps&plugin=fl_concore\">{$lang['back']}</a>";
		            require("../admin/styles/templates/empty.php"); 
                }
            }
            elseif ( $_REQUEST['sub'] == 'add' && $_REQUEST['type'] == '3' ){
                if ( $_REQUEST['step'] == '1'){
                    $html .= "<form action=\"index.php?mod=apps&plugin=fl_concore&sub=add&type=3&step=2\" method='post'>";
                    $html .= "<label for=\"contest\">{$lang['type_2']} </label><select name=\"contest\">";
                    	
                    global $db_host, $db_user, $db_pass, $db;
		            if (!mysql_connect($db_host, $db_user, $db_pass))
		              die(mysql_error());
		            mysql_select_db($db);
		            $sql = "SELECT id, name FROM `contest` WHERE type=2;";
		            $result = mysql_query($sql);
		            for ($i = 0; $i < mysql_num_rows($result); $i++){   
			          $r = mysql_fetch_array($result);
			          $html .= "<option value=\"{$r['id']}\">{$r['name']}</option>";
			           
                      mysql_query($sql) or die(mysql_error());
		            }
		            $html .= "</select><br/><input type=\"submit\"/ value=\"{$lang['next']}\">";
		            $html .= "</form>";
		            require("../admin/styles/templates/empty.php"); 
                }
                elseif ( $_REQUEST['step'] == '2'){
                    global $db_host, $db_user, $db_pass, $db;
		            if (!mysql_connect($db_host, $db_user, $db_pass))
		              die(mysql_error());
		            mysql_select_db($db);
		            
		            $sql = "SELECT id, name, subtype FROM `contest` WHERE id={$_REQUEST['contest']} LIMIT 1;";
	                $res = mysql_query($sql) or die(mysql_error());
	                $res = mysql_fetch_array($res);
	                
	                if ($res['subtype'] == '1'){ // quick
	                    $html .= "<form action=\"index.php?mod=apps&plugin=fl_concore&step=3&sub=add&type=3&p=1&contest={$_REQUEST['contest']}\" method='post'>";
	                        $html .= "<label for=\"question\">{$lang['question']}</label> <input type=\"text\" name=\"question\" /><br/>";
	                        $html .= "<label for=\"ans1\">{$lang['answer']}</label> <input type=\"text\" name=\"ans1\" /> <br/>"; 
	                        $html .= "<label for=\"ans2\">{$lang['answer']}</label> <input type=\"text\" name=\"ans2\" /> <br/>";
	                        $html .= "<label for=\"ans3\">{$lang['answer']}</label> <input type=\"text\" name=\"ans3\" /> <br/>";
	                        $html .= "<label for=\"ans4\">{$lang['answer']}</label> <input type=\"text\" name=\"ans4\" /> <br/>";
	                        $html .= "<label for=\"wr_ans\">{$lang['write_answer']}</label> <input type=\"text\" name=\"wr_ans\" /> <br/>";
	                        $html .= "<label for=\"point\">{$lang['point']}</label> <input type=\"text\" name=\"point\" /> <br/>";
							$html .= "<label for=\"time\">{$lang['time']}</label> <input type=\"text\" name=\"time\" /> <br/>";
	                        $html .= "<input type=\"submit\"/ value=\"{$lang['create']}\"> </form>";
	                        require("../admin/styles/templates/empty.php"); 
	                }
	                else { // full
	                    $html .= "<form enctype=\"multipart/form-data\" action=\"index.php?mod=apps&plugin=fl_concore&step=3&sub=add&type=3&p=2&contest={$_REQUEST['contest']}\" method='post'>";
                            $html .= "<label for=\"task\">{$lang['task']}</label><input type=\"file\" name=\"task\"/><br/>";
	                        $html .= "<input type=\"submit\"/ value=\"{$lang['create']}\"> </form>";
	                        require("../admin/styles/templates/empty.php"); 
	                }
                }
                elseif ( $_REQUEST['step'] == '3'){
                    if ( $_REQUEST['p'] == '1') {
                         global $db_host, $db_user, $db_pass, $db;
		                 if (!mysql_connect($db_host, $db_user, $db_pass))
		                  die(mysql_error());
		                mysql_select_db($db);
		                
		                $query = "SELECT MAX(`id`) AS Number FROM `$db`.`questions`";
			            $res = mysql_query($query);
			            $row = mysql_fetch_assoc($res);
			            $id = $row['Number'] + 1;
			        
		                $sql = "INSERT INTO `questions` (
                                `id` ,
                                `question` ,
                                `ans1` ,
                                `ans2` ,
                                `ans3` ,
                                `ans4` ,
                                `write_ans` ,
                                `tour_id` ,
                                `point`,
								`time`
                                )
                                VALUES (
                                '$id', '{$_REQUEST['question']}', '{$_REQUEST['ans1']}', '{$_REQUEST['ans2']}', '{$_REQUEST['ans3']}', '{$_REQUEST['ans4']}', '{$_REQUEST['wr_ans']}',
                                '{$_REQUEST['contest']}', '{$_REQUEST['point']}', {$_REQUEST['time']}
                                );";
		                mysql_query($sql) or die($lang['something_went_wrong']);
		                $html .= $lang['created'];
		                $html .= "<br/><a href=\"index.php?mod=apps&plugin=fl_concore\">{$lang['back']}</a>";
		                require("../admin/styles/templates/empty.php"); 
                    }
                    else {
                        global $db_host, $db_user, $db_pass, $db;
		                 if (!mysql_connect($db_host, $db_user, $db_pass))
		                  die(mysql_error());
		                mysql_select_db($db);
		                
		                $query = "SELECT MAX(`id`) AS Number FROM `$db`.`questions`";
			            $res = mysql_query($query);
			            $row = mysql_fetch_assoc($res);
			            $id = $row['Number'] + 1;
			            
			            require_once '../plugins/contest/classes/class.upload.php';
			            
			            $hphoto = new upload($_FILES['task']);
			            $filename = '';
			            $ext = '';
		                if ( $hphoto->uploaded ){
		                    $hphoto->file_new_name_body = "{$_REQUEST['contest']}";
		                    $hphoto->file_overwrite = true;
		                    $path = $_SERVER['DOCUMENT_ROOT'] . "/plugins/contest/data/";
		                    if ($hphoto->file_src_name_ext == 'docx' || $hphoto->file_src_name_ext == 'doc' || $hphoto->file_src_name_ext == 'rtf' ||
		                        $hphoto->file_src_name_ext == 'txt' || $hphoto->file_src_name_ext == 'odt'){
    		                    $ext = $hphoto->file_src_name_ext;
    		                    $filename = $hphoto->file_src_name_body;
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
		                $tmp = $_REQUEST['contest'].".".$ext;
		                $sql = "INSERT INTO `questions` (
                                `id` ,
                                `question` ,
                                `ans1` ,
                                `ans2` ,
                                `ans3` ,
                                `ans4` ,
                                `write_ans` ,
                                `tour_id` ,
                                `point`
                                )
                                VALUES (
                                '$id', '{$tmp}', '--', '--', '--', '--', '-1',
                                '{$_REQUEST['contest']}', '-1'
                                );";
                        mysql_query($sql) or die($lang['something_went_wrong'] . mysql_error());
		                $html .= $lang['created'];
		                $html .= "<br/><a href=\"index.php?mod=apps&plugin=fl_concore\">{$lang['back']}</a>";
		                require("../admin/styles/templates/empty.php"); 
                        
                    }
                }
            }
        }
        else {
            $html = '';
            function echoForm(){
                global $lang,$html;
                // adding buttons
                $html = "<a href=\"index.php?mod=apps&plugin=fl_concore&sub=add&step=1&type=1\">{$lang['add_type_1']}</a> ";
                $html .= "<a href=\"index.php?mod=apps&plugin=fl_concore&sub=add&step=1&type=2\">{$lang['add_type_2']}</a> ";
                $html .= " <a href=\"index.php?mod=apps&plugin=fl_concore&sub=add&step=1&type=3\">{$lang['add_type_3']}</a>";
                
                // echo type1
            }
            echoForm();
            require("../admin/styles/templates/empty.php"); 
            
        }
        
    }
    else {
        function controlPanelconcore(){
            echo "<tr><td>Марафон</td><td><a href=\"index.php?mod=apps&plugin=fl_concore\"><img src=\"../plugins/pages/imgs/manage.png\"></img></a></td></tr>";   
        }
        
        if(isset($events)){
            $events->register("fl_admin_apps","controlPanelconcore");
        }
    }
?>