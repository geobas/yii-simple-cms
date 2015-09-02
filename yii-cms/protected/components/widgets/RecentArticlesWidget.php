<?php
/**
* RecentArticlesWidget is a Yii widget used to display a list of recent articles
*/
class RecentArticlesWidget extends CWidget
{
	private $_articles;
	public $displayLimit = 5;

	public function init()
	{
		$this->_articles = Article::model()->with('user')->recent($this->displayLimit)->findAll();
	}
			
	public function getData()
	{
		return $this->_articles;
	}

	public function run()
	{
		// this method is called by CController::endWidget()
		$this->render('recentArticlesWidget');
	}
}