<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index')),
	array('label'=>'Create Article', 'url'=>array('create')),
	array('label'=>'Update Article', 'url'=>array('update', 'id'=>$model->id)),
	array(
		'label'=>'Delete Article', 
		'url'=>'#', 
		'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?','csrf'=>true), 
		'visible'=>Yii::app()->user->checkAccess('admin'),
	),
	array('label'=>'Manage Article', 'url'=>array('admin')),
);
?>

<?php if ( Yii::app()->user->hasFlash('article') ): ?>
	<div class="alert alert-info" role="alert">
		<?php echo Yii::app()->user->getFlash('article'); ?>
	</div>
<?php endif; ?>

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

<?php
	Yii::app()->clientScript->registerScript(
		'fadeAndHideEffect',
		'$(".alert-info").animate({opacity: 1.0}, 3000).fadeOut("slow");'
	);
?>