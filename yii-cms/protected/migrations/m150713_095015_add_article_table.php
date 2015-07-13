<?php

class m150713_095015_add_article_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_article', array(
				'id' => 'int UNSIGNED NOT NULL AUTO_INCREMENT',
				'title' => 'varchar(255) NOT NULL',
				'body' => 'text NOT NULL',
				'image' => 'varchar(150) NOT NULL',
				'published' => 'tinyint(1) NOT NULL',
				'create_time' => 'datetime NOT NULL',
				'update_time' => 'datetime NOT NULL',
				'PRIMARY KEY (id)'
			), 'ENGINE=InnoDB CHARSET=utf8');

	    $this->insert('tbl_article', array(
		        'id' => '1',
		        'title' => 'Sample 1',
		        'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sit amet eros ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce ac nulla a erat egestas lacinia non et lacus. Sed fermentum varius tortor. Phasellus blandit purus sem, rhoncus commodo sapien porta non.',
		        'image' => 'image1.png',
		        'published' => '1',
		        'create_time' => date('Y-m-d H:i:s'),
		        'update_time' => date('Y-m-d H:i:s')
	        ));		
	}

	public function down()
	{
		$this->dropTable('tbl_article');
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