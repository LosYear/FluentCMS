<?php
  //    &#1043;&#1083;&#1072;&#1074;&#1085;&#1072;&#1103; &#1089;&#1090;&#1088;&#1072;&#1085;&#1080;&#1094;&#1072; &#1072;&#1076;&#1084;&#1080;&#1085;&#1087;&#1072;&#1085;&#1077;&#1083;&#1080; 
  session_start();
  //error_reporting(0);
  require_once("../config.php");
  if ($_SESSION['auth'] === true && $_SESSION['group'] == 1 && $_SESSION['admin_ses'] === 1)
    {
	  require_once("../includes/template.php");
      require_once("../includes/classes/fEvent.php");
      require_once("../includes/classes/xml.php"); 
      require_once '../includes/plugins.admin.php';
      if ($_REQUEST['mod'] === 'add')
		{
		  if ($_REQUEST['step'] === '2')
			{
			  if (!mysql_connect($db_host, $db_user, $db_pass))
			  die(mysql_error());
			  mysql_select_db($db);
			  $caption = $_REQUEST['caption'];
			  $text = $_REQUEST['spaw1'];
			  $isPage = $_REQUEST['isPage'];
			  $isHidden = $_REQUEST['isHidden'];
			  $author = $_SESSION['login'];
			  $sql = "SELECT * FROM `" . $db . "`.`texts`";
			  $r = mysql_query($sql);
			  $query = "SELECT MAX(`id`) AS Number FROM `$db`.`texts`";
			  $res = mysql_query($query);
			  $row = mysql_fetch_assoc($res);
			  $id = $row['Number'] + 1;
			  if ($isPage === null)
				{
				  $isPage = 0;
				}
			  else
				{
				  
				  $isPage = 1;
				}
				if ($isHidden === null)
				{
				  $isHidden= 0;
				}
			  else
				{
				  
				  $isHidden = 1;
				}
			  $sql = "INSERT INTO `$db`.`texts` (
	  `id` ,
	  `caption` ,
	  `text` ,
	  `author`,
	  `isPage`,
	  `isHidden`
	  )
	  VALUES (
	  '$id', '$caption', '$text' , '$author', '$isPage', '$isHidden'
	  );";
			  mysql_query($sql);
			  $url = 'index.php';
			  header("location: " . $url);
			}
		  elseif ($_REQUEST['step'] === '1')
			{
			  include('styles/templates/editor.php');
			}
		}
	  elseif ($_REQUEST['mod'] === 'news')
		{
		  $tpl->get_tpl("styles/templates/header.htm");
		  $tpl->tpl_parse();
		  $header = $tpl->html;
		  echo $header;
		  $tpl->get_tpl("styles/templates/menu.htm");
		  $tpl->set_value("THEME", $theme_name);
		  $tpl->tpl_parse();
		  $header = $tpl->html;
		  echo $header . "<br>";
		  $news = '';
		  if (!mysql_connect($db_host, $db_user, $db_pass))
			  die(mysql_error());
		  mysql_select_db($db);
		  $query = "SELECT * FROM `$db`.`texts` ORDER BY `data` DESC";
		  $result = mysql_query($query);
		  for ($i = 0; $i < mysql_num_rows($result); $i++)
			{
			  $r = mysql_fetch_array($result);
			  $caption = $r['caption'];
			  $author = $r['author'];
			  $data = $r['data'];
			  $id = $r['id'];
			  $news = $news . "<tr>
	  <td>
		<b><A href=../index.php?mod=shownews&p=$id>$caption</a></b></td>
	  <td>
		$author</td>
	  <td class=\"style2\">
		$data</td>
	  <td>
		<a href=index.php?mod=edit&p=$id><img src=styles/images/edit.png></img></a>
											<a href=index.php?mod=del&p=$id><img src=styles/images/del.png></img></a></td>
	  </tr>";
			  mysql_query($query) or die(mysql_error());
			}
		  $tpl->get_tpl("styles/templates/news.htm");
		  $tpl->set_value("NEWS", $news);
		  $tpl->tpl_parse();
		  $page = $tpl->html;
		  echo $page;
		}
	  elseif ($_REQUEST['mod'] === 'del')
		{
		  include_once("../config.php");
		  if (!mysql_connect($db_host, $db_user, $db_pass))
			  die(mysql_error());
		  mysql_select_db($db);
		  $id = $_REQUEST['p'];
		  $q = "SELECT * FROM `$db`.`texts` WHERE id='$id'";
		  $result = mysql_query($q);
		  $r = mysql_fetch_array($result);
		  $query = "DELETE FROM `$db`.`texts` WHERE `texts`.`id` = '" . $id . "' LIMIT 1";
		  mysql_query($query);
		  $url = 'index.php';
		  header("location: " . $url);
		}
	  elseif ($_REQUEST['mod'] === 'edit')
		{
		  include_once("../config.php");
		  if ($_REQUEST['step'] === '2')
			{
			  if (!mysql_connect($db_host, $db_user, $db_pass))
				  die(mysql_error());
			  mysql_select_db($db);
			  $id = $_REQUEST['p'];
			  $q = "SELECT * FROM `$db`.`texts` WHERE id='$id'";
			  $result = mysql_query($q);
			  $r = mysql_fetch_array($result);
			  $caption = $_REQUEST['caption'];
			  $text = $_REQUEST['spaw1'];
			  $text2 = $r['text'];
			  $data = $r['data'];
			  $isPage = $_REQUEST['isPage'];
			  if ($isPage === null)
				{
				  $isPage = 0;
				}
			  else
				{
				  
				  $isPage = 1;
				}
			  $author = $r['author'];
			  $query = "UPDATE `$db`.`texts` SET `caption` = '$caption',
		`text` = '{$_REQUEST['spaw1']}', isPage=$isPage WHERE `texts`.`id` = '$id' LIMIT 1";
			  mysql_query($query);
			  $url = 'index.php';
			  header("location: " . $url);
			}
		  else
			{
			  
			  require_once('styles/templates/editor.php');
			}
		}
	  elseif ($_REQUEST['mod'] === 'comments')
		{
		  //&#1059;&#1087;&#1088;&#1072;&#1074;&#1083;&#1077;&#1085;&#1080;&#1077; &#1082;&#1086;&#1084;&#1084;&#1077;&#1085;&#1090;&#1072;&#1088;&#1080;&#1103;&#1084;&#1080;
		  // &#1042;&#1099;&#1074;&#1086;&#1076; header'a &#1080; &#1084;&#1077;&#1085;&#1102;
		  $tpl->get_tpl("styles/templates/header.htm");
		  $tpl->set_value("THEME", $theme_name);
		  $tpl->tpl_parse();
		  $header = $tpl->html;
		  echo $header;
		  $tpl->get_tpl("styles/templates/menu.htm");
		  $tpl->set_value("THEME", $theme_name);
		  $tpl->tpl_parse();
		  $header = $tpl->html;
		  echo $header . "<br>";
		  // Main functions. CP of comments
		  if (!mysql_connect($db_host, $db_user, $db_pass))
			  die(mysql_error());
		  mysql_select_db($db);
		  $sql = "SELECT * FROM `$db`.`comments`";
		  $result = mysql_query($sql);
		  $comments = "";
		  for ($i = 0; $i < mysql_num_rows($result); $i++)
			{
			  // &#1060;&#1086;&#1088;&#1084;&#1080;&#1088;&#1086;&#1074;&#1072;&#1085;&#1080;&#1077; &#1089;&#1087;&#1080;&#1089;&#1082;&#1072;
			  $r = mysql_fetch_array($result);
			  // id &#1090;&#1077;&#1082;&#1089;&#1090;&#1072;
			  $id = $r['id'];
			  // &#1080;&#1084;&#1103; &#1072;&#1074;&#1090;&#1086;&#1088;&#1072;
			  $name = $r['name'];
			  // &#1090;&#1077;&#1082;&#1089;&#1090; &#1082;&#1086;&#1084;&#1084;&#1077;&#1085;&#1090;&#1072;&#1088;&#1080;&#1103;
			  $comment = $r['comment'];
			  // &#1076;&#1072;&#1090;&#1072; &#1076;&#1086;&#1073;&#1072;&#1074;&#1083;&#1077;&#1085;&#1080;&#1103;
			  $date_add = $r['date_add'];
			  // id &#1090;&#1077;&#1082;&#1089;&#1090;&#1072;
			  $text_id = $r['text_id'];
			  $comments .= "<tr>
			<td>
				$comment </td>
			<td>
			  $name</td>
			<td class=\"style2\">
			  $date_add </td>
			 <td>
			  $text_id </td>
			<td>
			  <a href=index.php?mod=comment_del&p=$id><img src=styles/images/del.png></img></a>
		  </tr>";
			  mysql_query($sql) or die(mysql_error());
			}
		  $tpl->get_tpl("styles/templates/comments.htm");
		  $tpl->set_value("COMMENTS", $comments);
		  $tpl->tpl_parse();
		  $page = $tpl->html;
		  echo $page;
		}
		else if($_REQUEST['mod']==='comment_del'){
			$id = $_REQUEST['p'];
			if (!mysql_connect($db_host, $db_user, $db_pass))
			  die(mysql_error());	
			mysql_select_db($db);
			$query = "DELETE FROM `$db`.`comments` WHERE `comments`.`id` = '" . $id . "' LIMIT 1";
			mysql_query($query);
			$url = 'index.php';
			header("location: " . $url);
		}
		else if($_REQUEST['mod']==='plugins'){
			if( $_REQUEST['m'] === 'install' ){
				if( $_REQUEST['step'] === '1' ){
					$tpl->get_tpl("styles/templates/header.htm");
					$tpl->tpl_parse();
					$header = $tpl->html;
					echo $header;
					$tpl->get_tpl("styles/templates/menu.htm");
					$tpl->set_value("THEME", $theme_name);
					$tpl->tpl_parse();
					$header = $tpl->html;
					echo $header . "<br>";
					require_once("styles/templates/install.php");
				}
				else if ( $_REQUEST['step'] === '2' ){
					$folder = $_REQUEST['plugin_folder'];
					$xml = join('', file("../plugins/$folder/install.xml")); // РџРѕР»СѓС‡Р°РµРј СѓСЃС‚Р°РЅРѕРІРѕС‡РЅС‹Рµ РґР°РЅРЅС‹Рµ
					require_once("../includes/classes/xml.php");
					$data = new MiniXMLDoc();
					$data->fromString($xml);
					$name = $data->getElement("name");
					$name = $name->getValue();
					
					$author = $data->getElement("author");
					$author = $author->getValue();
					
					$title = $data->getElement("title");
					$title = $title->getValue();
					
					$description = $data->getElement("description");
					$description = $description->getValue();
					
					$version = $data->getElement("version");
					$version = $version->getValue();
					
					$min = $data->getElement("min");
					$min = $min->getValue();
					$max = $data->getElement("max");
					$max = $max->getValue();
					
					$contacts = $data->getElement("email");
					$contacts = "E-Mail : ".$contacts->getValue();
					$tmp = $data->getElement("site");
					$contacts = $contacts . " www : ". $tmp->getValue();
					
					$mainfile = $data->getElement("main");
					$mainfile = $mainfile->getValue();
					
					if ( $name != '' && $min != '' && $max != '' && $mainfile != ''){
						if (!mysql_connect($db_host, $db_user, $db_pass))
						die(mysql_error());
						mysql_select_db($db);
						$sql="SET NAMES utf8";
						mysql_query($sql);
						$query = "SELECT MAX(`id`) AS Number FROM `$db`.`modules`";
						$result = mysql_query($query);
						$row = mysql_fetch_assoc($result);
						$id = $row['Number'] + 1;
						$query = "INSERT INTO `$db`.`modules` (
								`id` ,
								`name` ,
								`author` ,
								`folder` ,
								`title` ,
								`description` ,
								`version` ,
								`cms_version_min` ,
								`cms_version_max` ,
								`is_active` ,
								`main_filename` ,
								`contacts` 
								)
								VALUES (
								'$id', '$name', '$author', '$folder', '$title', '$description', '$version', '$min', '$max', '0', '$mainfile', '$contacts'
								);";
						mysql_query($query);
						require_once("styles/templates/install.php");
					}
					else
					{
						die("Plugin format is uncorrect");
					}
					
					
				}
				
			}
			else if ( $_REQUEST['m'] === 'state' ){
				// Р�Р·РјРµРЅРµРЅРёРµ СЃРѕСЃС‚РѕСЏРЅРёСЏ РїР»Р°РіРёРЅР°
				if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
					$pid = $_POST[id];
					$state = $_POST[state];
					if (!mysql_connect($db_host, $db_user, $db_pass))
						die(mysql_error());
					mysql_select_db($db);
					if($state == 'true'){
						$state = 1;
					}
					else{
						$state = 0;
					}
					$sql = "UPDATE `$db`.`modules` SET is_active=$state WHERE id=$pid";
					mysql_query($sql);
					
				}
			}
			else if( $_REQUEST['m'] === 'del' ){
				// РЈРґР°Р»РµРЅРёРµ РїР»Р°РіРёРЅР° РёР· Р±Р°Р·С‹ РґР°РЅРЅС‹С…
				$id = $_REQUEST['p'];
				if (!mysql_connect($db_host, $db_user, $db_pass))
					die(mysql_error());	
				mysql_select_db($db);
				$query = "DELETE FROM `$db`.`modules` WHERE `modules`.`id` = '" . $id . "' LIMIT 1";
				mysql_query($query);
				$url = 'index.php?mod=plugins';
				header("location: " . $url);
			}
			else {
				$tpl->get_tpl("styles/templates/header.htm");
				$tpl->tpl_parse();
				$header = $tpl->html;
				echo $header;
				$tpl->get_tpl("styles/templates/menu.htm");
				$tpl->set_value("THEME", $theme_name);
				$tpl->tpl_parse();
				$header = $tpl->html;
				echo $header;
				if (!mysql_connect($db_host, $db_user, $db_pass))
					die(mysql_error());
				mysql_select_db($db);
				$sql = "SELECT id,title,description,contacts,is_active FROM `$db`.`modules`;";
				$result = mysql_query($sql);
				$plugins_list = "";
				for( $i = 0; $i < mysql_num_rows($result); $i++ ){
					$r = mysql_fetch_array($result);
					
					//РџРѕР»СѓС‡РµРЅРёРµ РґР°РЅРЅС‹С…
					$id = $r['id'];
					$title = $r['title'];
					$description = $r['description'];
					$contacts = $r['contacts'];
					$is_active = $r['is_active'];
					
					//Р¤РѕСЂРјРёСЂРѕРІР°РЅРёРµ СЃРїРёСЃРєР°
					$plugins_list.="<tr>";
					$plugins_list.="<td>$title</td>";
					$plugins_list.="<td>$description</td>";
					$plugins_list.="<td>$contacts</td>";
					$plugins_list.="<td><input type=\"checkbox\" id=\"is_active\" name=\"is_active\" plugin_id=\"$id\" data-on=\"ВКЛ\" data-off=\"ВЫКЛ\"";
					if($is_active == 1){
						$plugins_list.=" checked ";
					}
					$plugins_list.="/></td>";
					$plugins_list.="<td><a href=index.php?mod=plugins&m=del&p=$id><img src=styles/images/del.png></img></a></td>";
					$plugins_list.="</tr>";
					
					mysql_query($sql) or die(mysql_error());
				}
				//Р’С‹РІРѕРґ РїР°РЅРµР»Рё
				require_once("styles/templates/plugins.php");
			}
			
		}
		else if ( $_REQUEST['mod'] === 'siteedit' ){
			// Р РµРґР°РєС‚РёСЂРѕРІР°РЅРёРµ РёРЅС„РѕСЂРјР°С†РёРё Рѕ СЃР°Р№С‚Рµ
			if ( $_REQUEST['step'] === '2' ) {
				// РћР±СЂР°Р±РѕС‚РєР° РґР°РЅРЅС‹С…
				
				if (!mysql_connect($db_host, $db_user, $db_pass)) // РџРѕРґРєР»СЋС‡Р°РµРјСЃСЏ Рє Р±Р°Р·Рµ
					die(mysql_error());	
				mysql_select_db($db);
				
				$new_site_name = $_REQUEST['sitename']; // РџРѕР»СѓС‡Р°РµРј Р·РЅР°С‡РµРЅРёСЏ
				$new_site_desc = $_REQUEST['sitedesc']; 
				$new_copyright = $_REQUEST['copyright'];
				
				$sql = "UPDATE `$db`.`settings` SET site_name='$new_site_name', site_describe='$new_site_desc', copyright='$new_copyright' WHERE 
				id=0 LIMIT 1;"; // Р’С‹РїРѕР»РЅСЏРµРј Р·Р°РїСЂРѕСЃ
				$result = mysql_query($sql) or die(mysql_error());
				
				header( "Location:index.php" );
				
			}
			else {
				// Р’С‹РІРѕРґ С„РѕСЂРјС‹
				
				$tpl->get_tpl("styles/templates/header.htm");
				$tpl->tpl_parse();
				$header = $tpl->html;
				echo $header;
				
				$tpl->get_tpl("styles/templates/menu.htm");
				$tpl->set_value("THEME", $theme_name);
				$tpl->tpl_parse();
				$header = $tpl->html;
				echo $header;
				
				require_once("styles/templates/siteconfig.php");
			}
		
		}
		else if($_REQUEST['mod'] === 'apps'){
		    if ( isset($_REQUEST['plugin'])) {
		        if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
			    mysql_select_db($db);
			    $SQL = "SELECT id,folder FROM modules WHERE name='{$_REQUEST['plugin']}' LIMIT 1;";
			    $result = mysql_query($SQL);
			    $f = mysql_fetch_array($result);
                $_POST['adminmode'] = true;
                $_POST['folder'] = $f['folder'];               
                require "../plugins/{$f['folder']}/admin.php";
		    }
		    else {
		        $tpl->get_tpl("styles/templates/header.htm");
        		$tpl->tpl_parse();
        		$header = $tpl->html;
        		echo $header;
        		$tpl->get_tpl("styles/templates/menu.htm");
        		$tpl->set_value("THEME", $theme_name);
        		$tpl->tpl_parse();
        		$header = $tpl->html;
        		echo $header . "<br>";
			    require_once("styles/templates/apps.php");
		    }
		}
		else if( $_REQUEST['mod'] === 'users' ) { // Users admin
		    if ($_REQUEST['sub'] == 'edit'){ // Users edit
		        if ( $_REQUEST['step'] == 'submit'){
		            // DB connect
        		    if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
        		    mysql_select_db($db);
        		    $sql = "UPDATE `users` SET `id` = '{$_REQUEST['id']}',
                            `login` = '{$_REQUEST['login']}',
                            `email` = '{$_REQUEST['email']}',
                            `group` = '{$_REQUEST['group']}' WHERE `id`='{$_REQUEST['id']}' LIMIT 1;";
        		    mysql_query($sql) or die(mysql_error());
        		    $html .= "Изменено";
		            $html .= "<br/><a href=\"index.php?mod=apps&plugin=fl_concore\">Назад</a>";
		            require("/styles/templates/empty.php"); 
		        }
		        else {
    		        // DB connect
        		    if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
        		    mysql_select_db($db);
        		    $sql = "SELECT * FROM `users` WHERE id='{$_REQUEST['id']}' LIMIT 1;";
        		    $result = mysql_query($sql);
        		    $user = mysql_fetch_array($result);
    		        
    		        require_once 'styles/templates/user_edit.php';
		        }
		        
		    }
		    else if ( $_REQUEST['sub'] == 'del'){ // Delete user
		        
		    }
		    else {
    		    // DB connect
    		    if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
    		    mysql_select_db($db);
    			$sql = "SELECT * FROM `users`;";
    			$users = mysql_query($sql);
    			
    			$users_list = '';
    			// Printing users list
    		    for ($i = 0; $i < mysql_num_rows($users); $i++){   
                  $r = mysql_fetch_array($users);
    
                  // Item printing
                  $users_list .= '<tr>';
                  $users_list .= "<td>{$r['login']}</td>";
                  $users_list .= "<td>{$r['email']}</td>";
                  
                  if ($r['group'] == '1'){
                      $group = 'Администратор';
                  }
                  else if ( $r['group'] == '0'){
                      $group = "Пользователь";
                  }
                  else if ( $r['group'] == '2'){
                      $group = "Модератор";
                  }
                  
                  $action = "<a href=\"index.php?mod=users&sub=edit&id={$r['id']}\"><img src='styles/images/edit.png' /></a> ";
                  $action .= "<a href=\"index.php?mod=users&sub=del&id={$r['id']}\"><img src='styles/images/del.png' /></a> ";
                  
                  $users_list .= "<td>{$group}</td>";
                  $users_list .= "<td>{$action}</td>";
                  
                  mysql_query($sql) or die(mysql_error());
        	    }	
    			    
    		    require_once 'styles/templates/users.php';
		    }
		}
	  else
		{
		  
		  // &#1042;&#1099;&#1074;&#1086;&#1076; &#1075;&#1083;&#1072;&#1074;&#1085;&#1086;&#1081; &#1089;&#1090;&#1088;&#1072;&#1085;&#1080;&#1094;&#1099;
		  $tpl->get_tpl("styles/templates/header.htm");
		  $tpl->tpl_parse();
		  $header = $tpl->html;
		  echo $header;
		  $tpl->get_tpl("styles/templates/menu.htm");
		  $tpl->set_value("THEME", $theme_name);
		  $tpl->tpl_parse();
		  $header = $tpl->html;
		  echo $header . "<br>";
		  echo join('', file('styles/templates/index.htm'));
		}
	}
  else
    {
		//Р’С‹РІРѕРґРёРј СЌРєСЂР°РЅ РІС…РѕРґР°
		if( $_REQUEST['mod']==='login' ){
			if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
				$username = $_POST['username'];
				$password = $_POST['password'];
				if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
				  mysql_select_db($db);
				$r=mysql_query('
				SELECT * FROM `'.$db.'`.`users` WHERE login="'.$username.'"');
				$f=mysql_fetch_array($r);
				if ($f['pass']===md5($password) && $f['group'] == 1){
					$_SESSION['admin_ses']=1;
					$_SESSION['auth'] = true;
					$_SESSION['group'] = $f['group'];
					$_SESSION['login'] = $f['login'];
					$url='index.php';
					header("location: ".$url);
					fwrite($file,"A mi tuta");
				}
				else{
					exit ("WPL");
				}
			}
		}
		else{
			require_once("styles/templates/login_screen/screen.php");
		}
    }
?>
