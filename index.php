<?php

// change the following paths if necessary
$yii = dirname(__FILE__) . '/../framework/yii.php';
// $yii = dirname(__FILE__) . '/../html/framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

//ignore error
// define('YII_ENABLE_ERROR_HANDLER', false);
// define('YII_ENABLE_EXCEPTION_HANDLER', false);

//profiler
define('YII_DEBUG_SHOW_PROFILER', false);
define('YII_DEBUG_PROFILING', false);

require_once ($yii);

/*
 print '<pre>';
 print_r($_GET);
 print '<hr>';
 print_r($_SERVER);
 die();
 */

Yii::createWebApplication($config) -> run();

// echo Yii::getLogger()->getExecutionTime();
