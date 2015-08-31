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
