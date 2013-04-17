<?php
/**
 * set with your webroot application (this is not YII framework path)
 */
$yii_app = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..';

// -- main logic
$current_cwd = getcwd();
// we need ability to share SESSION between kcfinder and YII ?
chdir($yii_app);
// get current after change directory ...
$curr = getcwd();

// set $yii and $config path value
// THIS IS YII Framework directory, relative with your application. 
// For easier purpose, I just copy paste my code in index.php
// ---
$yii=$curr.'/../framework/yii.php';

if(!($_SERVER['HTTP_HOST']=='localhost')) {
    // change the following paths if necessary
    $yii=$curr.'/../framework/yii.php';

    $config=$curr.'/../protected/config/kcfinder.php';

    // specify how many levels of call stack should be shown in each log message
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
} else {
     $config=$curr.'/../protected/config/kcfinder.php';

    // remove the following lines when in production mode
    defined('YII_DEBUG') or define('YII_DEBUG',true);
    // specify how many levels of call stack should be shown in each log message
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
}

require_once($yii);

Yii::createWebApplication($config);

/**
 * SET WITH YOUR VALUE ------------------------
 * decide your own PATH here
 * for description then you need to read kcfinder manual
 */
$uploadURL = Yii::app()->baseUrl
        .'/../uploads'
        .Yii::app()->params['fileDownloadPath'];
$uploadDir = dirname(__FILE__).DIRECTORY_SEPARATOR
        .'..'.DIRECTORY_SEPARATOR // out of integration
		.'..'.DIRECTORY_SEPARATOR
        .'uploads' // out of kcfinder
        .Yii::app()->params['fileDownloadPath'];
$session = new CHttpSession;
$session->setSavePath(Yii::app()->session->savePath);
$session->open();
$session['KCFINDER'] = array();
$session['KCFINDER'] = array(
    'disabled'=> false,
    'uploadURL'=> $uploadURL,
    'uploadDir'=>$uploadDir,
);
// then back to our path
chdir($current_cwd);

spl_autoload_unregister(array('YiiBase','autoload'));
spl_autoload_register('__autoload');
spl_autoload_register(array('YiiBase','autoload'));
?>