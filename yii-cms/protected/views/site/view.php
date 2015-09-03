<?php
/* @var $this SiteController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Articles'=>array('articles'),
	$model->title,
);

?>

<h1>View Article #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'body',
		'image',
		array(
			'name'=>'user_id',
			'value'=>isset($model->user) ? CHtml::encode($model->user->username) : "unknown",
		),			
		array(
			'name'=>'published',
			'value'=>CHtml::encode($model->publishedText)
		),		
		array(
			'name'=>'create_time',
			'value'=>CHtml::encode($model->formatDate($model->create_time))
		),	
		array(
			'name'=>'update_time',
			'value'=>CHtml::encode($model->formatDate($model->update_time))
		),					
	),
)); ?>
