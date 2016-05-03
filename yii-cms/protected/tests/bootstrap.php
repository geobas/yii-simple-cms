<?php

// change the following paths if necessary
$yiit=dirname(__FILE__).'/../../../vendor/yiisoft/yii/framework/yiit.php';
$config=dirname(__FILE__).'/../config/test.php';

require_once($yiit);
// require_once(dirname(__FILE__).'/WebTestCase.php');

// define application's absolute url
$path_parts = pathinfo($_SERVER['PHP_SELF']);
$_SERVER['SERVER_NAME'] = 'localhost';

defined('YII_ABSOLUTE_URL') or define('YII_ABSOLUTE_URL', 'http://' . $_SERVER['SERVER_NAME'] . $path_parts['dirname']);

Yii::createWebApplication($config);
