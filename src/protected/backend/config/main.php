<?php
$backend  = dirname(dirname(__FILE__));
$frontend = dirname($backend);
Yii::setPathOfAlias('backend', $backend);

return array(
    'basePath' => $frontend,
    'name' => 'Admin',
    
    'id' => 'fluentCMS',
    
    'controllerPath' => $backend . '/controllers',
    'viewPath' => $backend . '/views',
    'runtimePath' => $backend . '/runtime',
    'sourceLanguage' => 'en',
    'language' => 'ru',
    
    'import' => array(
        'backend.models.*',
        'backend.components.*',
        'backend.controllers.*',
        'application.models.*',
        'application.components.*',
        'application.modules.user.*',
        'application.modules.user.models.*',
        'application.modules.author.models.*'
    ),
    
    'preload' => array(
        'log',
        'bootstrap'
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        
        'author',
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array(
                '127.0.0.1',
                '::1'
            ),
            'generatorPaths' => array(
                'bootstrap.gii'
            )
        ),
        
        'user' => array(
            'debug' => false,
            'userTable' => 'user',
            'translationTable' => 'translation'
        ),
        'usergroup' => array(
            'usergroupTable' => 'user_group',
            'usergroupMessagesTable' => 'user_group_message'
        ),
        'profile' => array(
            'privacySettingTable' => 'privacysetting',
            'profileFieldTable' => 'profile_field',
            'profileTable' => 'profile',
            'profileCommentTable' => 'profile_comment',
            'profileVisitTable' => 'profile_visit'
        ),
        'role' => array(
            'roleTable' => 'role',
            'userRoleTable' => 'user_role',
            'actionTable' => 'action',
            'permissionTable' => 'permission'
        ),
        'message' => array(
            'userModel' => 'YumUser',
            'getNameMethod' => 'getUsername',
            'getSuggestMethod' => 'getSuggest',
        ),
        'rush',
    ),
    // application components
    'components' => array(
        'session' => array(
            'cookieMode' => 'allow',
            'cookieParams' => array(
                 'domain' => 'new.cms',
                 'httponly' => true,
            ),
        ),
        'user' => array(
            'class' => 'application.modules.user.components.YumWebUser',
            'allowAutoLogin' => true,
            'loginUrl' => array(
                '//user/user/login'
            )
        ),
        'cache' => array(
            'class' => 'system.caching.CDummyCache'
        ),
        
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap' // assuming you extracted bootstrap under extensions
        ),
        // uncomment the following to enable URLs in path-format
        
        
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => true,
            'urlSuffix' => '.html',
            'rules' => array(
                '/' => 'main/index',
                'menuitem/<id:\d+>' => 'menuitem/admin',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>'
            )
        ),
        // uncomment the following to use a MySQL database
        
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=fluent',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '1111',
            'charset' => 'utf8',
            'tablePrefix' => ''
        ),
        
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error'
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                /*array(
                'class' => 'CFileLogRoute',
                'levels' => 'error, warning'
                ),
                // uncomment the following to show log messages on web pages
                */
                
             /*   array(
                    'class' => 'CWebLogRoute'
                )*/
            )
        )
    ),
    
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com'
    )
    
);



