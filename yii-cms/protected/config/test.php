<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(

			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			
			// setup the database that's used for unit testing
			'db'=>array(
				'connectionString' => 'mysql:host=localhost;dbname=CMS_test',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => 'root',
				'charset' => 'utf8',					
			),
			
			// set the connectionID of test database (see DbTest.php)
		    'CMStest'=>array(
	      		'class'=>'CDbConnection',
	            'connectionString' => 'mysql:host=localhost;dbname=CMS_test',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => 'root',
				'charset' => 'utf8',	
		    ),		

		),
	)
);
