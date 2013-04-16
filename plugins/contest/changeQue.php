<?php 
    session_start();
	require_once '../../config.php';
	require_once("../../plugins/contest/lang.php");
	//$hn = fopen("output.txt","w");
	
	// Different checkings
	$DB = mysql_connect($db_host, $db_user, $db_pass)or die(mysql_error());
	mysql_select_db($db)or die(mysql_error());
	
	// Preparations for processing of request of next question
	$sql = "SELECT * FROM `results` WHERE user_id='{$_SESSION['id']}' AND tour_id='{$_REQUEST['tour_id']}' LIMIT 1;";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0){
		// If all the questions are answered, then we end up here - printing out the results of the test
		$result = mysql_fetch_array($result);
		$response = 	"{\"mode\":\"result\",
						\"text\":\"{$lang['you_get']} {$result['points']} {$lang['points']}\"}";
		echo $response;
	}
	else{
		// Here we start the processing of test and first of all initialise the session variables
		unset($_SESSION['answers']);
		if(!isset($_SESSION['answers']['points'])){
			$_SESSION['answers']['points'] = 0;  // ну это понятно - баллы
			$_SESSION['answers']['numbers'] = 0;	// это что? вроде как количество попыток сменить вопрос :)
			$_SESSION['answers']['now_quest'] = 1;		// номер текущего вопроса
		}
		
		// Taking the temporary results from the DataBase and parsing them
		$sql = "SELECT * FROM `tmp_result` WHERE `user_id`='{$_SESSION['id']}' AND `tour_id`='{$_REQUEST['tour_id']}' LIMIT 1;";
		$result = mysql_query($sql) or die(mysql_error());
		$isInsert = true;
		if(mysql_num_rows($result) > 0){
			$isInsert = false;
			$data = mysql_fetch_array($result);
			$_SESSION['answers'] = json_decode($data['data'], true);
		}
		$_REQUEST['question'] = $_SESSION['answers']['now_quest'];
		$_SESSION['answers']['now_quest']++;
		
		
		function Check_Answer($pid, $qid, $ans)
		{
			//global $hn;
			global $isInsert;
			if($qid > 1){
				$sql = "SELECT * FROM `questions` WHERE tour_id='{$pid}' LIMIT " . ($qid-2) . ", 1";	// тут же идет предыдущий вопрос - поэтому для проверки -2
				$res = mysql_query($sql) or die(mysql_error());
				$r = mysql_fetch_array($res);
				
				$_SESSION['answers'][$qid-1] = $ans;
				$_SESSION['answers']['numbers']++;
			
				if($r['write_ans'] == $ans)
					$_SESSION['answers']['points'] += $r['point'];
			}
			
			if($isInsert){
				$query = "SELECT MAX(`id`) AS Number FROM `tmp_result`";
				$res = mysql_query($query);
				$row = mysql_fetch_assoc($res);
				$id = $row['Number'] + 1;
				
				$sql_data = json_encode($_SESSION['answers']);
				$_SESSION['tmp_id'] = $id;
				
				$sql = "INSERT INTO `tmp_result` (`id`, `user_id`, `tour_id`, `data`) VALUES ('$id', '{$_SESSION['id']}', '{$_REQUEST['tour_id']}', '$sql_data');";
				mysql_query($sql);
			}
			else{
				$sql_data = json_encode($_SESSION['answers']);
				
				$tmp_id = $_SESSION['tmp_id'];
				
				$sql = "UPDATE `tmp_result` SET  `data` =  '$sql_data' WHERE  `id` = '$tmp_id' LIMIT 1 ;";
				
				mysql_query($sql);
			}
		}
		
		// Making of response with the next question
		if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
			$pid = $_REQUEST['tour_id'];
			$qid = $_REQUEST['question'];
			$ans = $_REQUEST['ans'];
			Check_Answer($pid, $qid, $ans);
			$sql = "SELECT * FROM `questions` WHERE tour_id='{$pid}' LIMIT " . ($qid-1) . ", 1";	// -1, т.к. счет строк в SQL-запросе идет с 0
			$res = mysql_query($sql) or die(mysql_error());
			$r = mysql_fetch_array($res);
			
			if($r != false){
				$response = 	"{\"mode\":\"quest\",
								\"que\":\"".addslashes($r['question'])."\",
								\"time\":\"{$r['time']}\",
								\"answs\":[
								{\"ans\":\"".addslashes($r['ans1'])."\"},
								{\"ans\":\"".addslashes($r['ans2'])."\"},
								{\"ans\":\"".addslashes($r['ans3'])."\"},
								{\"ans\":\"".addslashes($r['ans4'])."\"}]}";
				echo $response;
			}
			else{
				global $lang;
				$query = "SELECT MAX(`id`) AS Number FROM `$db`.`results`";
				$res = mysql_query($query);
				$row = mysql_fetch_assoc($res);
				$id = $row['Number'] + 1;
				
				$sql = "INSERT INTO `results` (`id`, `user_id`, `tour_id`, `points`, `state`, `adv`) VALUES ('$id', '{$_SESSION['id']}', '{$pid}',
				 '{$_SESSION['answers']['points']}', '0', '--');";
				mysql_query($sql) or die(mysql_error());
				$response = 	"{\"mode\":\"result\",
								\"text\":\"{$lang['you_get']} {$_SESSION['answers']['points']} {$lang['points']}\"}";
				echo $response;
				unset($_SESSION['answers']);
			}
		}
	}
	mysql_close($DB);
	//fclose($hn);
?>
