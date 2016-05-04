<?php

Yii::import('application.modules.admin.models.*');

// class ArticleTest extends CTestCase
class ArticleTest extends CDbTestCase
{
	public $fixtures = array(
							'articles'=>'Article',
						);

	public function testCreate()
	{
		// Create a new article
		$new_article = new Article();
		$title = 'Test Article 4';
		$new_article->setAttributes(
				array(
					'title' => $title,
					'body' => 'Lorem4 ipsum4 dolor4 sit amet, consectetur adipiscing elit. Phasellus ultrices neque dignissim magna tincidunt, eget aliquet libero ultricies. Aenean egestas placerat leo, sit amet vestibulum nunc commodo eu. Nullam vehicula dui risus, at feugiat lectus ultrices in. Etiam non suscipit felis, rutrum efficitur odio. Etiam pretium, elit a aliquam dignissim, nibh velit elementum lacus, eu aliquam neque dui sed sapien. Integer quis sem ultricies, facilisis ex eget, viverra felis.',
					'image' => 'image1.png',
					'user_id' => 1,
					'published' => 1,
					'create_time' => date("Y-m-d H:i:s")
				)
			);
		$this->assertTrue($new_article->save(false));

		// Read the newly created article
		$retrievedArticle = Article::model()->findByPk($new_article->id);
		$this->assertTrue($retrievedArticle instanceof Article);
		$this->assertEquals($title, $retrievedArticle->title);
	}

	public function testRead()
	{
		$retrievedArticle = $this->articles('article1');
		$this->assertTrue($retrievedArticle instanceof Article);
		$this->assertEquals('This is test article 1', $retrievedArticle->title);		
	}

	public function testUpdate()
	{
		$article = $this->articles('article2');
		$updatedArticleTitle = 'This is updated Test Article 2';
		$article->title = $updatedArticleTitle; 
		$this->assertTrue($article->save(false));

		// Read the record again to ensure the update worked
		$updatedArticle = Article::model()->findByPk($article->id);
		$this->assertTrue($updatedArticle instanceof Article);
		$this->assertEquals($updatedArticleTitle, $updatedArticle->title);		
	}

	public function testDelete()
	{
		$article = $this->articles('article3');
		$savedArticleId = $article->id;
		$this->assertTrue($article->delete());
		$deletedArticle = Article::model()->findByPk($savedArticleId);
		$this->assertEquals(NULL, $deletedArticle);		
	}

	public function testArticleUserFname()
	{
		$article = $this->articles('article2');
		$fname = $article->user->fname;
		$this->assertEquals('geo', $fname);
	}

	public function testArticlePublicity()
	{
		$article = $this->articles('article3');
		$this->assertEquals(0, $article->published);
	}	

	public function testArticleCategoryTitle()
	{
		$article = $this->articles('article1');
		$category = $article->categories[0]->title;
		$this->assertEquals('Dummy category title', $category);
	}

	public function testPublishedOptions()
	{
		$options = Article::model()->publishedOptions;
		$this->assertTrue(is_array($options));
		$this->assertTrue(2 == count($options));
		$this->assertTrue(in_array('Yes', $options));
		$this->assertTrue(in_array('No', $options));		
	}

	public function testCategoryOptions()
	{
		$options = Article::model()->categoryList;
		$this->assertTrue(is_array($options));
		$this->assertTrue(count($options) > 0);
		$this->assertTrue(in_array('Dummy category title', $options));
	}

	/*public function testCRUD()
	{
		// Create a new article
		$article = new Article();
		$title = 'Test Article 1';
		$article->setAttributes(
				array(
					'title' => $title,
					'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultrices neque dignissim magna tincidunt, eget aliquet libero ultricies. Aenean egestas placerat leo, sit amet vestibulum nunc commodo eu. Nullam vehicula dui risus, at feugiat lectus ultrices in. Etiam non suscipit felis, rutrum efficitur odio. Etiam pretium, elit a aliquam dignissim, nibh velit elementum lacus, eu aliquam neque dui sed sapien. Integer quis sem ultricies, facilisis ex eget, viverra felis.',
					'image' => 'image1.png',
					'user_id' => 1,
					'published' => 1,
					'create_time' => date("Y-m-d H:i:s")
				)
			);
		$this->assertTrue($article->save(false));

		// Read the newly created article
		$retrievedArticle = Article::model()->findByPk($article->id);
		$this->assertTrue($retrievedArticle instanceof Article);
		$this->assertEquals($title, $retrievedArticle->title);

		// Update the newly created article
		$updatedArticleTitle = 'Updated Test Article 1';
		$article->title = $updatedArticleTitle; 
		$this->assertTrue($article->save(false));

		// Read the record again to ensure the update worked
		$updatedProject = Article::model()->findByPk($article->id);
		$this->assertTrue($updatedProject instanceof Article);
		$this->assertEquals($updatedArticleTitle, $updatedProject->title);			
		
		// Delete the article
		$articleId = $article->id;
		$this->assertTrue($article->delete());
		$deletedArticle = Article::model()->findByPk($articleId);
		$this->assertEquals(NULL, $deletedArticle);
	}*/
}