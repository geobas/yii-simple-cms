<?php

// This is the database connection configuration.
return array(
	// 'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	'connectionString' => ( getenv('HOST') ) ? getenv('HOST') : 'mysql:host=localhost;dbname=CMS',
	'emulatePrepare' => true,
	'schemaCachingDuration' => 86400, // one day
	'username' => ( getenv('USERNAME') ) ? getenv('USERNAME') : 'root',
	'password' => ( getenv('PASSWORD') ) ? getenv('PASSWORD') : 'root',
	'charset' => 'utf8',
);