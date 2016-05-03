<?php

Yii::import('application.modules.admin.models.*');

class ArticleTest extends CTestCase
{
	public function testCRUD()
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
		$this->assertEquals(NULL,$deletedArticle);
	}
}