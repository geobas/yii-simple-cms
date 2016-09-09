<?php

$host = $_ENV("HOST");
$dbname = $_ENV('DATABASE');
$username = $_ENV('USERNAME');
$password = $_ENV('PASSWORD');

// change the following paths if necessary
$yii=dirname(__FILE__).'/../vendor/yiisoft/yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
// define application's absolute url
$path_parts = pathinfo($_SERVER['PHP_SELF']);
defined('YII_ABSOLUTE_URL') or define('YII_ABSOLUTE_URL', 'http://' . $_SERVER['SERVER_NAME'] . $path_parts['dirname']);

require_once($yii);
Yii::createWebApplication($config)->run();

// automatically send every new message to available log routes
Yii::getLogger()->autoFlush = 1;

// when sending a message to log routes, also notify them to dump the message
// into the corresponding persistent storage (e.g. DB, email)
Yii::getLogger()->autoDump = true;
