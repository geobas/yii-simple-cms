<?php

class m150723_125717_add_role_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_role', array(
				'id' => 'int UNSIGNED NOT NULL AUTO_INCREMENT',
				'type' => 'varchar(100) NOT NULL',
				'create_time' => 'datetime NOT NULL',
				'update_time' => 'datetime NOT NULL',
				'PRIMARY KEY (id)'
			), 'ENGINE=InnoDB CHARSET=utf8');

	    $this->insertMultiple('tbl_role', array(
	    		array(
			        'id' => '1',
			        'type' => 'admin',
			        'create_time' => date('Y-m-d H:i:s'),
			        'update_time' => date('Y-m-d H:i:s')
			    ),
		        array(
			        'id' => '2',
			        'type' => 'staff',
			        'create_time' => date('Y-m-d H:i:s'),
			        'update_time' => date('Y-m-d H:i:s')
		        )		        
	        ));	
	}

	public function down()
	{
		$this->dropTable('tbl_role');
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