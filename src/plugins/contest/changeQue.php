<?php 
    session_start();
    if(!isset($_SESSION['points']))
        $_SESSION['points'] = 0;
    
    function Check_Answer($pid, $qid, $ans)
    {
        if($ans != 'undef')
	    {
	        $sql = "SELECT * FROM `questions` WHERE tour_id='{$pid}' LIMIT " . ($qid-2) . ", 1";
	        $res = mysql_query($sql) or die(mysql_error());
	        $r = mysql_fetch_array($res);
	        
	        if($r['write_ans'] == $ans)
	            $_SESSION['points'] += $r['point']; 
	    }
    }
    
    if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
        require_once '../../config.php';
        require_once("../../plugins/contest/lang.php");
        if (!mysql_connect($db_host, $db_user, $db_pass))
            die(mysql_error());
        mysql_select_db($db);
	    $pid = $_REQUEST['tour_id'];
	    $qid = $_REQUEST['question'];
	    $ans = $_REQUEST['ans'];
	    Check_Answer($pid, $qid, $ans);
	    $sql = "SELECT * FROM `questions` WHERE tour_id='{$pid}' LIMIT " . ($qid-1) . ", 1";
	    $res = mysql_query($sql) or die(mysql_error());
	    $r = mysql_fetch_array($res);
	    
		if($r != false){
    	    $response = 	"{\"mode\":\"quest\",
							\"que\":\"{$r['question']}\",
							\"answs\":[
							{\"ans\":\"{$r['ans1']}\"},
							{\"ans\":\"{$r['ans2']}\"},
							{\"ans\":\"{$r['ans3']}\"},
							{\"ans\":\"{$r['ans4']}\"}]}";
			echo $response;
	    }
        else{
            global $lang;
            $query = "SELECT MAX(`id`) AS Number FROM `$db`.`results`";
            $res = mysql_query($query);
            $row = mysql_fetch_assoc($res);
            $id = $row['Number'] + 1;
            
            $sql = "INSERT INTO `results` (`id`, `user_id`, `tour_id`, `points`, `state`, `adv`) VALUES ('$id', '{$_SESSION['id']}', '{$pid}',
             '{$_SESSION['points']}', '0', '--');";
            mysql_query($sql) or die(mysql_error());
			$response = 	"{\"mode\":\"result\",
							\"text\":\"{$lang['you_get']} {$_SESSION['points']} {$lang['points']}\"}";
			echo $response;
            unset($_SESSION['points']);
        }
    }
?>
