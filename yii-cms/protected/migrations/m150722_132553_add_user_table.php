<?php

class m150722_132553_add_user_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_user', array(
				'id' => 'int UNSIGNED NOT NULL AUTO_INCREMENT',
				'fname' => 'varchar(50) NOT NULL',
				'lname' => 'varchar(70) NOT NULL',
				'username' => 'varchar(50) NOT NULL',
				'password' => 'varchar(64) NOT NULL',
				'email' => 'varchar(50) NOT NULL',
				'role_id' => 'int UNSIGNED NOT NULL',
				'last_login_time' => 'datetime NOT NULL',
				'create_time' => 'datetime NOT NULL',
				'update_time' => 'datetime NOT NULL',
				'PRIMARY KEY (id)'
			), 'ENGINE=InnoDB CHARSET=utf8');
			$this->addForeignKey('fk3', 'tbl_user', 'role_id', 'tbl_role', 'id','CASCADE','CASCADE');
		
	    $this->insert('tbl_user', array(
				'id' => '1',
				'fname' => 'geo',
				'lname' => 'bas',
				'username' => 'admin',
				'password' => '$2a$13$fYg.jiQLBgEynkHadahx9uETljHbVKZYHrCaLdwJqjbQh4K0la6SS',
				'email' => 'ksenera@yahoo.com',
				'role_id' => '1',
				'last_login_time' => date('Y-m-d H:i:s'),
				'create_time' => date('Y-m-d H:i:s'),
				'update_time' => date('Y-m-d H:i:s'),
	        ));				
	}

	public function down()
	{
		$this->dropTable('tbl_user');
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