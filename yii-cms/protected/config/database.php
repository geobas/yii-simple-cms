<?php

$host = $_ENV("HOST");
$dbname = $_ENV('DATABASE');
$username = $_ENV('USERNAME');
$password = $_ENV('PASSWORD');

// This is the database connection configuration.
return array(
	// 'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	'connectionString' => ( !empty($host) && !empty($dbname) ) ? 'mysql:host=' . $host . ';dbname=' . $dbname : 'mysql:host=localhost;dbname=CMS',
	'emulatePrepare' => true,
	'schemaCachingDuration' => 86400, // one day
	'username' => ( !empty($username) ) ? $username : 'root',
	'password' => ( !empty($password) ) ? $password : 'root',
	'charset' => 'utf8',
);
