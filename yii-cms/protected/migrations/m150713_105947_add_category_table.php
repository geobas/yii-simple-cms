<?php

class m150713_105947_add_category_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_category', array(
				'id' => 'int UNSIGNED NOT NULL AUTO_INCREMENT',
				'title' => 'varchar(150) NOT NULL',
				'create_time' => 'datetime NOT NULL',
				'update_time' => 'datetime NOT NULL',
				'PRIMARY KEY (id)'
			), 'ENGINE=InnoDB CHARSET=utf8');	

	    $this->insertMultiple('tbl_category', array(
	    		array(
			        'id' => '1',
			        'title' => 'Dummy category title',
			        'create_time' => date('Y-m-d H:i:s'),
			        'update_time' => date('Y-m-d H:i:s')
			    ),
		        array(
		        	'id' => '2',
			        'title' => 'Dummy category title #2',
			        'create_time' => date('Y-m-d H:i:s'),
			        'update_time' => date('Y-m-d H:i:s')
		        )		        
	        ));				
	}

	public function down()
	{
		$this->dropTable('tbl_category');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}