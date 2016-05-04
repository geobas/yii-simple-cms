<?php

Yii::import('application.modules.admin.models.*');

class CategoryTest extends CDbTestCase
{
	public $fixtures = array(
							'categories'=>'Category',
						);

	public function testCreate()
	{
		// Create a new category
		$new_category = new Category();
		$categoryTitle = 'This is a new cateogory title';
		$new_category->setAttributes(
				array(
					'title' => $categoryTitle,
					'create_time' => '2016-05-04 19:05:41',
					'update_time' => '2016-05-04 19:05:41',			
				)
			);
		$this->assertTrue($new_category->save(false));

		// Read the newly created category
		$retrievedCategory = Category::model()->findByPk($new_category->id);
		$this->assertTrue($retrievedCategory instanceof Category);
		$this->assertEquals($categoryTitle, $retrievedCategory->title);
	}

	public function testRead()
	{
		$retrievedCategory = $this->categories('category1');
		$this->assertTrue($retrievedCategory instanceof Category);
		$this->assertEquals('Dummy category title', $retrievedCategory->title);		
	}

	public function testUpdate()
	{
		$category = $this->categories('category2');
		$updatedTitle = 'updated title';
		$category->title = $updatedTitle; 
		$this->assertTrue($category->save(false));

		// Read the record again to ensure the update worked
		$updatedcategory = Category::model()->findByPk($category->id);
		$this->assertTrue($updatedcategory instanceof Category);
		$this->assertEquals($updatedTitle, $updatedcategory->title);		
	}

	public function testDelete()
	{
		$category = $this->categories('category2');
		$savedCategoryId = $category->id;
		$this->assertTrue($category->delete());
		$deletedCategory = Category::model()->findByPk($savedCategoryId);
		$this->assertEquals(NULL, $deletedCategory);		
	}
}