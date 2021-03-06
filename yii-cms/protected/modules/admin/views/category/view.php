<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'Update Category', 'url'=>array('update', 'id'=>$model->id)),
	array(
		'label'=>'Delete Category', 
		'url'=>'#', 
		'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?','csrf'=>true), 
		'visible'=>Yii::app()->user->checkAccess('admin'),
	),
	array('label'=>'Manage Category', 'url'=>array('admin')),
);
?>

<?php if ( Yii::app()->user->hasFlash('category') ): ?>
	<div class="alert alert-info" role="alert">
		<?php echo Yii::app()->user->getFlash('category'); ?>
	</div>
<?php endif; ?>

<h1>View Category #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'create_time',
		'update_time',
	),
)); ?>

<?php
	Yii::app()->clientScript->registerScript(
		'fadeAndHideEffect',
		'$(".alert-info").animate({opacity: 1.0}, 3000).fadeOut("slow");'
	);
?>