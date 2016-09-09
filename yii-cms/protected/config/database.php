<?php

// This is the database connection configuration.
return array(
	// 'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	'connectionString' => ( $_ENV("HOST") ) ? 'mysql:host=' . $_ENV('HOST') . ';dbname=' . $_ENV('DATABASE') : 'mysql:host=localhost;dbname=CMS',
	'emulatePrepare' => true,
	'schemaCachingDuration' => 86400, // one day
	'username' => ( $_ENV('USERNAME') ) ? $_ENV('USERNAME') : 'root',
	'password' => ( $_ENV('PASSWORD') ) ? $_ENV('PASSWORD') : 'root',
	'charset' => 'utf8',
);
