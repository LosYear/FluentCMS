<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$swsys = true;

	return array(
		'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
		'homeUrl' => 'http://new.cms',
		'name' => 'Программные продукты и системы',
		'sourceLanguage' => 'en',

		'id' => 'fluentCMS',

		'language' => 'ru',
		'theme' => 'swsys',

		// preloading 'log' component
		'preload' => array(
			'UnderConstruction',
			'log',
			'bootstrap'
		),

		// autoloading model and component classes
		'import' => array(
			'application.models.*',
			'application.components.*',
			'application.modules.user.models.*',
            'application.modules.banner.models.*',
			'application.controllers.*',
			'ext.YiiMailer.YiiMailer',
		),

		'modules' => array(
			// uncomment the following to enable the Gii tool

			'author',
			'admin',
			'feedback',
            'banner',
			'gii' => array(
				'class' => 'system.gii.GiiModule',
				'password' => '123456',
				// If removed, Gii defaults to localhost only. Edit carefully to taste.
				'ipFilters' => false,
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
				'enableCaptcha' => true,
				'loginAfterSuccessfulActivation' => true,
				'enableActivationConfirmation' => true,
			),
			'avatar',
			/*'message' => array(
					'userModel' => 'YumUser',
					'getNameMethod' => 'getUsername',
					'getSuggestMethod' => 'getSuggest',
				),
			  //  'message',*/
			//  'rush',
			'mailbox' => array(
				'userClass' => 'YumUser',
				'juiThemes' => 'none',
				'juiButtons' => false,
				'juiIcons' => false,
			),
		),

		// application components
		'components' => array(
			'UnderConstruction' => array(
				'class' => 'application.components.UnderConstruction',
				'locked' => true,
				'type' => 'until',
				'until' => '2013-10-01 09:00:00', //mm/dd/y hh:mm
				'view' => 'webroot.themes.school.coming_soon'
			),
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
				'responsiveCss' => false,
				'coreCss' => true,
				'enableJS' => true,
			),
			// uncomment the following to enable URLs in path-format

			'request' => array(
				'class'=>'LanguageHttpRequest',
			),

			'urlManager' => array(
				'class'=>'LanguageUrlManager',
				'urlFormat' => 'path',
				'showScriptName' => false,
				'urlSuffix' => '.html',
				'rules' => array(
					'/' => 'author/issue/index',

					'issue_<id:\d+>' => 'author/issue',
                    'issue_no_template_<id:\d+>' => 'author/issue/list',
					'search' => 'author/article/search',
					'feedback' => 'feedback/default/contact',
					'author/<id:\d+>' => 'author/profile/view',
					'cabinet' => 'rush/cabinet',
					'moderator' => 'rush/moderator',
					'cabinet/profile' => 'profile/profile/update',
					'cabinet/profile/avatar/<action:\w+>/' => 'avatar/avatar/<action>',
					'mailbox' => 'mailbox/message',
					'mailbox/<action:\w+>' => 'mailbox/message/<action>',
					'profiles' => 'profile/profile/index',
					'profile/<id:\d+>' => 'profile/profile/view',
					//  'cabinet/view/<id:\d+>' => 'rush/cabinet/view',
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
				'tablePrefix' => '',
				'enableProfiling' => true,
				'enableParamLogging' => true,
			),

			/* 'errorHandler' => array(
					// use 'site/error' action to display errors
					'errorAction' => 'site/error'
				),*/
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
						'class' => 'CFileLogRoute',
						'levels' => 'trace,log, error',
						'categories' => 'system.db.CDbCommand',
						'logFile' => 'db.log',
					),
					array(
						'class' => 'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
						'ipFilters' => array('127.0.0.1', '192.168.1.37', '192.168.1.35'),
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
			'adminEmail' => 'webmaster@example.com',
			'cacheDuration' => 3600,
			'swsys' => 0,
			'defaultTranslationLanguage' => 'ru',
		)
	);