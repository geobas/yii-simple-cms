<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(

			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			
/*			'db'=>array(
				'db'=>require(dirname(__FILE__).'/database.php'),
			),*/
			
		),
	)
);
