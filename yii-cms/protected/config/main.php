<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Yii 1.1 CMS',
	'id'=>'CMS',
	'homeUrl'=>YII_ABSOLUTE_URL,
	'sourceLanguage'=>'en',
	'language'=>'el',
	// 'language'=>'el_gr', // this locale ID is not used anymore

	// preloading 'log' component
	'preload'=>array('log'),

	'aliases' => array(
		'bootstrap' => dirname(__FILE__).'/../../../vendor/crisu83/yiistrap', // change this if necessary
		'efeed' => dirname(__FILE__).'/../../../vendor/2amigos/efeed',
		'eClientScript' => dirname(__FILE__).'/../../../vendor/muayyad-alsadi/yii-extended-clientscript',
	),	

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	    'bootstrap.behaviors.*',
	    'bootstrap.components.*',
	    'bootstrap.form.*',
	    'bootstrap.helpers.*',
	    'bootstrap.widgets.*',
	    // 'application.modules.admin.models.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>false,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' => array('vendor.crisu83.yiistrap.gii'),
		),
		'admin',		
	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,			
			// custom RBAC
			'class' => 'WebUser',
			'authTimeout' => 600,
		),

		// YII_CSRF_TOKEN cookie
		'request'=>array(
	        'enableCsrfValidation' => true,
	        'enableCookieValidation'=>true,
	        'csrfCookie'=>array(
	        	'httpOnly'=>true,
	        ),
		),

		// PHPSESSID cookie
        'session' => array(
        	'sessionName' => 'cms',
            'cookieParams' => array(
            	'httponly' => true,
            ),
        ),

		// uncomment the following to enable URLs in path-format		
		'urlManager'=>array(
			'class'=>'application.components.UrlManager',
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
            	'<language:(en|el)>/' => 'site/index',				
				'<language:(en|el)>/<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<language:(en|el)>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<language:(en|el)>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<language:(en|el)>/<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
				'articlesfeed'=>array('site/feed', 'urlSuffix'=>'.xml', 'caseSensitive'=>false),

			),
		),		

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			// 'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error',
					'logFile'=>'application.log',
					'maxFileSize'=>2048,
					'maxLogFiles'=>10,
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'info, trace',
					'logFile'=>'infoMessages.log',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'warning',
					'logFile'=>'warningMessages.log',
				),		

				// uncomment the following to show log messages on web pages				
				array(
					'class'=>'CWebLogRoute',
					'levels'=>'warning',
				),
				
			),
		),

		'cache'=>array(
			'class'=>'system.caching.CFileCache',
		),

		'bootstrap' => array(
	    	// 'class' => 'bootstrap.components.TbApi',
	    	'class' => '\TbApi',
		),

		'clientScript' => array(
			'class' => 'application.extensions.NLSClientScript.NLSClientScript',
		    //'excludePattern' => '/\.tpl/i', //js regexp, files with matching paths won't be filtered is set to other than 'null'
		    //'includePattern' => '/\.php/', //js regexp, only files with matching paths will be filtered if set to other than 'null'
		 
		    'mergeJs' => true, //def:true
		    'compressMergedJs' => true, //def:false
		 
		    'mergeCss' => true, //def:true
		    'compressMergedCss' => true, //def:false
		 
		    'mergeJsExcludePattern' => '/edit_area/', //won't merge js files with matching names
		 
		    'mergeIfXhr' => true, //def:false, if true->attempts to merge the js files even if the request was xhr (if all other merging conditions are satisfied)
		 
		    'serverBaseUrl' => 'http://localhost', //can be optionally set here
		    'mergeAbove' => 1, //def:1, only "more than this value" files will be merged,
		    'curlTimeOut' => 10, //def:10, see curl_setopt() doc
		    'curlConnectionTimeOut' => 10, //def:10, see curl_setopt() doc
		 
		    'appVersion'=>'1.0', //if set, it will be appended to the urls of the merged scripts/css			
			'coreScriptPosition' => CClientScript::POS_END,
		),

		'coreMessages'=>array(
            'basePath'=>'protected/messages',
        ),		

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'salt' => '!#@SyR4t|\#~L#$^',
    	'languages'=>array('en'=>'English', 'el'=>'Ελληνικά'),		
	),
);
