<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap',dirname(__FILE__).'/../extensions/yii-bootstrap-master');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Heroes Wanted',
	'aliases'=>array(
//				'bootstrap'=>dirname(__FILE__).'/../extensions/yiibooster/src',
				'xupload'=>dirname(__FILE__).'/../extensions/xupload-0.5.1',
		),
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.user.models.*',
		'application.modules.user.components.*',
		'application.extensions.awegen.components.*',
	),

	'modules'=>array(
			'user'=>array(
					# encrypting method (php hash function)
					'hash' => 'md5',
			
					# send activation email
					'sendActivationMail' => false,
			
					# allow access for non-activated users
					'loginNotActiv' => false,
			
					# activate user on registration (only sendActivationMail = false)
					'activeAfterRegister' => true,
			
			# automatically login from registration
							'autoLogin' => true,
			
							# registration path
			'registrationUrl' => array('/user/registration'),
			
					# recovery password path
			'recoveryUrl' => array('/user/recovery'),
			
            # login form path
			            'loginUrl' => array('/user/login'),
			
			            		# page after login
			            		'returnUrl' => array('/site/branch'),
			
			            				# page after logout
			            				'returnLogoutUrl' => array('/user/login'),
        ),
		'kiosk',
		'studio',
		'videoPoint',
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'bangbang',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
        	'generatorPaths' => array(
        		'ext.awegen',
        	),
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'class' => 'WebUser',
			'allowAutoLogin'=>true,
			'loginUrl' => array('/user/login'),
		),
		
		'bootstrap'=>array(
				'class'=>'bootstrap.components.Bootstrap',
		 		'responsiveCss'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		/* 'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		), */
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			
			'tablePrefix'=>'tbl_',
			'connectionString' => 'mysql:host=localhost;dbname=splat',
			'emulatePrepare' => true,
			'username' => 'splat',
			'password' => 'splat@123!',
			'charset' => 'utf8',
		),
		'prd'=>array(
					
				'tablePrefix'=>'tbl_',
				'connectionString' => 'mysql:host=mysql.serversfree.com;dbname=u768579415_docs',
				'emulatePrepare' => true,
				'username' => 'u768579415_docs',
				'password' => 'docs@123!',
				'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning,info,debug',
				),
				// uncomment the following to show log messages on web pages
				
				/* array(
					'class'=>'CWebLogRoute',
				), */
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'configureUrl'=>'configure',
		'kioskBaseUrl'=>'kiosk/default',
		'videoBaseUrl'=>'videoPoint/default',
		'studioBaseUrl'=>'user/login',
		'loginUrl'=>'user/login',
		'remoteHost'=>'14.96.211.112',
		'remoteUser'=>'splatupload',
		'remotePwd'=>'splat4site',
		'uploadDir'=>'Media',
		'downloadDir'=>'Upload', 
		'localUpload'=>'uploads',
		'localComposite'=>'composite',
		
	),
);
