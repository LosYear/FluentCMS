<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

// Считываем текущее время
$current_time = microtime();
// Отделяем секунды от миллисекунд
$current_time = explode(" ",$current_time);
// Складываем секунды и миллисекунды
$start_time = $current_time[1] + $current_time[0];

require_once($yii);
Yii::createWebApplication($config)->run();

// То же, что и в 1 части
$current_time = microtime();
$current_time = explode(" ",$current_time);
$current_time = $current_time[1] + $current_time[0];

// Вычисляем время выполнения скрипта
$result_time = ($current_time - $start_time);

echo("<center><b>Time: ".$result_time." sec<br/>");
die("Memory: ". (memory_get_peak_usage()/1024)/1024 ." MBytes</b></center>");