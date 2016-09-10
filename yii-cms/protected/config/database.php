<?php

$host = ( !empty(getenv('HOST')) ) ? getenv('HOST') : 'localhost';
$dbname = ( !empty(getenv('DATABASE')) ) ? getenv('DATABASE') : 'CMS';
$username = ( !empty(getenv('USERNAME')) ) ? getenv('USERNAME') : 'root';
$password = ( !empty(getenv('PASSWORD')) ) ? getenv('PASSWORD') : 'root';

// This is the database connection configuration.
return array(
	// 'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	'connectionString' => 'mysql:host=' . $host . ';dbname=' . $dbname,
	'emulatePrepare' => true,
	'schemaCachingDuration' => 86400, // one day
	'username' => $username,
	'password' => $password,
	'charset' => 'utf8',
);
