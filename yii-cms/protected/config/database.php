<?php

// This is the database connection configuration.
return array(
	// 'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	'connectionString' => ( apache_getenv("HOST") ) ? 'mysql:host=' . apache_getenv('HOST') . ';dbname=' . apache_getenv('DATABASE') : 'mysql:host=localhost;dbname=CMS',
	'emulatePrepare' => true,
	'schemaCachingDuration' => 86400, // one day
	'username' => ( apache_getenv('USERNAME') ) ? apache_getenv('USERNAME') : 'root',
	'password' => ( apache_getenv('PASSWORD') ) ? apache_getenv('PASSWORD') : 'root',
	'charset' => 'utf8',
);