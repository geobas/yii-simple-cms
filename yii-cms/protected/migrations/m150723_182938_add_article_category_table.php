<?php

class m150723_182938_add_article_category_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_article_category', array(
				'article_id' => 'int UNSIGNED NOT NULL',
				'category_id' => 'int UNSIGNED NOT NULL',
				'create_time' => 'datetime NOT NULL',
				'update_time' => 'datetime NOT NULL',
				'PRIMARY KEY (article_id,category_id)'
			), 'ENGINE=InnoDB CHARSET=utf8');
		$this->addForeignKey('fk1', 'tbl_article_category', 'article_id', 'tbl_article', 'id','CASCADE','CASCADE');
		$this->addForeignKey('fk2', 'tbl_article_category', 'category_id', 'tbl_category', 'id','CASCADE','CASCADE');

	    $this->insert('tbl_article_category', array(
		        'article_id' => '1',
		        'category_id' => '1',
		        'create_time' => date('Y-m-d H:i:s'),
		        'update_time' => date('Y-m-d H:i:s')
	        ));
	}

	public function down()
	{
		$this->dropTable('tbl_article_category');
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