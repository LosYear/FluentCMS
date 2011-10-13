<?php 
    if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
        require_once '../../config.php';
        if (!mysql_connect($db_host, $db_user, $db_pass))
            die(mysql_error());
        mysql_select_db($db);
	    $pid = $_POST[id];
	    $qid = $_POST[question];
	    $sql = "SELECT * FROM `questions` WHERE id = '{$qid}';";
	    $res = mysql_query($sql) or die(mysql_error());
	    $r = mysql_fetch_array($res);
	    echo "<label>{$r['question']}</label><br>";
               
        echo "<div><input type=\"radio\" value=\"1\" name=\"{$r['id']}\"/> {$r['ans1']}</div>";
        echo "<div><input type=\"radio\" value=\"2\" name=\"{$r['id']}\"/> {$r['ans2']}</div>";
        echo "<div><input type=\"radio\" value=\"3\" name=\"{$r['id']}\"/> {$r['ans3']}</div>";
        echo "<div><input type=\"radio\" value=\"4\" name=\"{$r['id']}\"/> {$r['ans4']}</div><br>";
        
        echo "<input type=\"button\" value=\"123\" style=\"width:50px\" />";
        echo "<input type=\"hidden\" value=\"{$qid}\"/>";
        
    }
?>
