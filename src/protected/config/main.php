<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.


return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'homeUrl' => 'http://new.cms',
    'name' => 'My Web Application',
    'sourceLanguage' => 'en',
    
    'id' => 'fluentCMS',
    
    'language' => 'ru',
    'theme' => 'mudrenok',
    
    // preloading 'log' component
    'preload' => array(
        'log',
        'bootstrap'
    ),
    
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.models.*',
        'application.controllers.*'
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
        'registration' => array(
            'registrationView' => 'application.views.registration.regestration',
        ),
        'avatar',
       /*'message' => array(
            'userModel' => 'YumUser',
            'getNameMethod' => 'getUsername',
            'getSuggestMethod' => 'getSuggest',
        ),
      //  'message',*/
        'rush',
        'mailbox' => array(
            'userClass' => 'YumUser',
            'juiThemes' => 'none',
            'juiButtons' => false,
            'juiIcons' => false,
        ),
    ),
    
    // application components
    'components' => array(
        'session' => array(
            'autoStart' => true,
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
            ),
        ),
        'cache' => array(
            'class' => 'system.caching.CDummyCache'
        ),
        
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
            'responsiveCss' => true,
        ),
        // uncomment the following to enable URLs in path-format
        
        
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'urlSuffix' => '.html',
            'rules' => array(
             //   '/' => 'author/issue/index',
                '/' => 'news/index',
                'cabinet' => 'rush/cabinet',
                'cabinet/profile' => 'profile/profile/update',
                'cabinet/profile/avatar/<action:\w+>/' => 'avatar/avatar/<action>',
                'mailbox' => 'mailbox/message',
                'mailbox/<action:\w+>' => 'mailbox/message/<action>',
                'profiles' => 'profile/profile/index',
                'profile/<id:\d+>' => 'profile/profile/view',
              //  'cabinet/view/<id:\d+>' => 'rush/cabinet/view',
                'cabinet/<action:\w+>/<id:\d+>' => 'rush/cabinet/<action>',
                'cabinet/<action:\w+>' => 'rush/cabinet/<action>',
                'gii' => 'gii',
                'user/login' => 'user/user/login',
                'user/logout' => 'user/user/logout',
                'user/registration' => 'registration/registration',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                array(
                    'class' => 'application.components.SiteRule',
                    'connectionID' => 'db'
                ),
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
              /*  array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                    'logFile' => 'trace.log'
                ),*/
                // uncomment the following to show log messages on web pages
                
                    array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'trace,log, error',
                    'categories' => 'system.db.CDbCommand',
                    'logFile' => 'db.log',
                  ), 
               /* array(
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