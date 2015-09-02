<?php
/* @var $this SiteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Articles',
);

?>

<h1>Articles</h1>
<h5><?php echo CHtml::link('Articles feed', Yii::app()->createUrl('site/feed')); ?></h5>
<p><a href="<?php echo Yii::app()->homeUrl; ?>/articlesFeed.xml">Articles feed alias</a></p>

<?php 

$this->widget('application.components.widgets.RecentArticlesWidget', array('displayLimit' => 3));

// get first article
// $article = Article::model()->first()->find(); // lazy loading

// get latest article
// $article = Article::model()->with('user')->latest()->find(); // eager loading

// get recent articles
// $articles = Article::model()->with('user')->recent()->findAll(); // eager loading

?>

<?php
	$key = 'CMS.articles';
	$dependency = array(
					'dependency'=> array(
										'class'=>'system.caching.dependencies.CDbCacheDependency',
										'sql'=>'SELECT MAX(create_time) FROM tbl_article',
				  				   )
				  );

	// check if the list of articles has already being cached
	if ( $this->beginCache($key, $dependency) )
	{
		$this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
		));
		// cache articles
		$this->endCache();
	}
?>
