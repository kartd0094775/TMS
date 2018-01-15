<?php

$dbName='taipei_station';

$dbUsername = 'root';
// $dbUsername = 'utown';
$dbPassword= 'sto123';
// $dbPassword= '_}{9z%;+_}*S';

$dbServer = 'localhost';
$dbLocation = 'localhost';
// $dbServer = '54.183.167.179';


// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Unipapa',
	
	'timeZone'=>"Asia/Taipei",
	
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		// 'application.vendors.yiiexcel.YiiExcel',
		
		//mongoyii
		// 'application.extensions.MongoYii.*',
		// 'application.extensions.MongoYii.validators.*',
		// 'application.extensions.MongoYii.behaviors.*',
		// 'application.extensions.MongoYii.util.*'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'4785735',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		


	),

	// application components
	'components'=>array(
	
 
 	'facebook'=>array(
			'class' => 'ext.yii-facebook-opengraph.SFacebook',
			'appId'=>'33333333333333333', // needed for JS SDK, Social Plugins and PHP SDK
			'secret'=>'1111111111111111111', // needed for the PHP SDK
			//'fileUpload'=>false, // needed to support API POST requests which send files
			//'trustForwarded'=>false, // trust HTTP_X_FORWARDED_* headers ?
			//'locale'=>'en_US', // override locale setting (defaults to en_US)
			//'jsSdk'=>true, // don't include JS SDK
			//'async'=>true, // load JS SDK asynchronously
			//'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
			//'status'=>true, // JS SDK - check login status
			//'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
			//'oauth'=>true,  // JS SDK - enable OAuth 2.0
			//'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
			//'frictionlessRequests'=>true, // JS SDK - enable frictionless requests for request dialogs
			//'html5'=>true,  // use html5 Social Plugins instead of XFBML
			//'ogTags'=>array(  // set default OG tags
			//'title'=>'MY_WEBSITE_NAME',
			//'description'=>'MY_WEBSITE_DESCRIPTION',
			//'image'=>'URL_TO_WEBSITE_LOGO',
			//),
		),
		
 
	/*
		'clientScript'=>array(
			'class' => 'CClientScript',
			'scriptMap' => array(
				'jquery.js'=>false,
			),
			'coreScriptPosition' => CClientScript::POS_BEGIN,
		),
	 * */
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			
			'rules'=>array(
			
				
			//	'search/<text>'=>'search/index',
			 
				
				// 'phone/<id:\d+>'=>'phone/item',
			 
					
			),
			
			/*
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
			 * */
			'showScriptName' => false
		),
		
		// 'db'=>array(
			// 'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		// ),
		// uncomment the following to use a MySQL database
		
		
	
		'db'=>array(
				'emulatePrepare' => true,
				// 'schemaCachingDuration' => 86400,
				'connectionString' => 'mysql:host='.$dbServer.';dbname='.$dbName,
				'username' => $dbUsername,
				'password' => $dbPassword,
				'initSQLs'=>array(
                "SET time_zone = '+8:00'" 
				),
				
                'enableProfiling' =>YII_DEBUG_PROFILING,
				
				// 'connectionString' => 'mysql:host=localhost;dbname=test',
				// 'emulatePrepare' => true,
				// 'username' => 'ahkin',
				// 'password' => 'o89drgkcJYi394kB',
				
				'charset' => 'utf8',
				
				
			),
			'dbSto'=>array(
				'emulatePrepare' => true,
				// 'schemaCachingDuration' => 86400,
				'connectionString' => 'mysql:host='.$dbServer.';dbname=sto',
				'username' => $dbUsername,
				'password' => $dbPassword,
				'initSQLs'=>array(
                "SET time_zone = '+8:00'" 
				),
				
				'class'            => 'CDbConnection' ,
                // 'enableProfiling' =>YII_DEBUG_PROFILING,
				
				'charset' => 'utf8',
				
				
			),
		
		 


// 'cache'=>array(
    // 'class' => 'CFileCache',
    // 'directoryLevel' => 2,
// ), 
// 		

		 
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				//profiler
				array(
                	'class'=>'CProfileLogRoute',
            	),
            
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);

