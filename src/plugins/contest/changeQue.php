<?php 
    session_start();
    if(!isset($_SESSION['points']))
        $_SESSION['points'] = 0;
    
    function Check_Answer($pid, $qid, $ans)
    {
        if($ans != 'undefined')
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
        if (!mysql_connect($db_host, $db_user, $db_pass))
            die(mysql_error());
        mysql_select_db($db);
	    $pid = $_POST['id'];
	    $qid = $_POST['question'];
	    $ans = $_POST['ans'];
	    Check_Answer($pid, $qid, $ans);
	    $sql = "SELECT * FROM `questions` WHERE tour_id='{$pid}' LIMIT " . ($qid-1) . ", 1";
	    $res = mysql_query($sql) or die(mysql_error());
	    $r = mysql_fetch_array($res);
	    
	    if ($r != false){
    	    echo "<label>{$r['question']}</label><br>";
                   
            echo "<div><input type=\"radio\" value=\"1\" name=\"ans\"/> {$r['ans1']}</div>";
            echo "<div><input type=\"radio\" value=\"2\" name=\"ans\"/> {$r['ans2']}</div>";
            echo "<div><input type=\"radio\" value=\"3\" name=\"ans\"/> {$r['ans3']}</div>";
            echo "<div><input type=\"radio\" value=\"4\" name=\"ans\"/> {$r['ans4']}</div><br>";
            
            echo "<button type=\"button\" style=\"width:50px\" onclick=\"next();\">OK</button>";
	    }
        else{
            echo $_SESSION['points'];
            unset($_SESSION['points']);
        }
    }
?>
