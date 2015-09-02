<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array(
		'label'=>'Delete User', 
		'url'=>'#',
		'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?','csrf'=>true),
		'visible'=>Yii::app()->user->checkAccess('admin'),
	),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<?php if ( Yii::app()->user->hasFlash('user') ): ?>
	<div class="alert alert-info" role="alert">
		<?php echo Yii::app()->user->getFlash('user'); ?>
	</div>
<?php endif; ?>

<h1>View User #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fname',
		'lname',
		'username',
		'email',
		'last_login_time',
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