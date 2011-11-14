<?php
    require_once 'plugins/messages/msg.class.php';


    // *** Main *** //
    function fl_msg_sidebar(){ // Printing "Messages" at sidebar
        echo "<hr /><a href='index.php?plugin_control=messages_index'>Messages</a><hr />";
    }
    
    // *** Mail screen *** //
    function messages_index(){ // Main page of mail cabinet
        global $msg_ex;
        echo "	<a href='index.php?plugin_control=messages_new'>Новые </a>
        	<a href='index.php?plugin_control=messages_inbox'>Полученные </a>
        	<a href='index.php?plugin_control=messages_outbox'>Отправленные </a>
        	| 
        	<a href='index.php?plugin_control=messages_send&step=1'><img src='plugins/messages/imgs/new.png' title='Новое сообщение' /></a><br />";  
        echo $msg_ex->printInbox($_SESSION['id'],"<div id='msg'><a href='index.php?mod=messages_read&id=%id%'>","</a></div>");
    }
    
    function messages_new(){
        global $msg_ex;
         echo "	<a href='index.php?plugin_control=messages_new'>Новые </a>
        	<a href='index.php?plugin_control=messages_inbox'>Полученные </a>
        	<a href='index.php?plugin_control=messages_outbox'>Отправленные </a>
        	| 
        	<a href='index.php?plugin_control=messages_send&step=1'><img src='plugins/messages/imgs/new.png' title='Новое сообщение' /></a><br />";  
         echo $msg_ex->printNew($_SESSION['id'],"<div id='msg'><a href='index.php?mod=messages_read&id=%id%'>","</a></div>");
    }
    
    function messages_inbox(){ // Main page of mail cabinet
        global $msg_ex;
        echo "	<a href='index.php?plugin_control=messages_new'>Новые </a>
        	<a href='index.php?plugin_control=messages_inbox'>Полученные </a>
        	<a href='index.php?plugin_control=messages_outbox'>Отправленные </a>
        	| 
        	<a href='index.php?plugin_control=messages_send&step=1'><img src='plugins/messages/imgs/new.png' title='Новое сообщение' /></a><br />";  
        echo $msg_ex->printInbox($_SESSION['id'],"<div id='msg'><a href='index.php?mod=messages_read&id=%id%'>","</a></div>");
    }
    
    function messages_outbox(){ // Main page of mail cabinet
        global $msg_ex;
        echo "	<a href='index.php?plugin_control=messages_new'>Новые </a>
        	<a href='index.php?plugin_control=messages_inbox'>Полученные </a>
        	<a href='index.php?plugin_control=messages_outbox'>Отправленные </a>
        	| 
        	<a href='index.php?plugin_control=messages_send&step=1'><img src='plugins/messages/imgs/new.png' title='Новое сообщение' /></a><br />";  
        echo $msg_ex->printOutbox($_SESSION['id'],"<div id='msg'><a href='index.php?mod=messages_read&id=%id%'>","</a></div>");
    }
    
    function messages_send(){
        global $msg_ex;
        if ( $_REQUEST['step'] == '1' ){ // Форма
                    echo "	<form method=\"post\" action=\"index.php?plugin_control=messages_send&step=2\">
                		<label for='user_id'>Пользователь<label><br />
                		<select name='user_id'>";
        			// Установим подключение к базе
    				global $db_host, $db_user, $db_pass, $db;
    				if(! mysql_connect($db_host, $db_user, $db_pass)) die(mysql_error());
    				mysql_select_db($db);
    				
    				$sql = "SELECT * FROM `users`;";
    				$result = mysql_query($sql);
    				$users = "";
    				for ($i = 0; $i < mysql_num_rows($result); $i++){   
    				  $r = mysql_fetch_array($result);
    				  
    				  $users .= "<option value='{$r['id']}'>{$r['login']}</option>";
    				  
    				  mysql_query($sql) or die(mysql_error());
    				}
    				echo $users."</select><br/>
                		<label for='title'>Тема</label><br/>
                		<input type='text' name='title' /><br/>
                		<label for='msg'>Сообщение</label><br/>
                		<textarea name='msg'></textarea><br/>
                		<input type='submit' value='Отправить' />
                		</form>";
    				mysql_close();
    			}
    			else{ // Обработка
    				$msg_ex->sendMsg($_REQUEST['title'], $_REQUEST['msg'], $_REQUEST['user_id'], $_SESSION['id']);
    			}
		}
    $events->register("fl_sidebar_print","fl_msg_sidebar");
    $events->register("messages_index","messages_index");
    $events->register("messages_new","messages_new");
    $events->register("messages_inbox","messages_inbox");
    $events->register("messages_outbox","messages_outbox");
    $events->register("messages_send","messages_send");
    
?>
