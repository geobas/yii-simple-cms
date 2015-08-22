<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<!-- <h1><?php //echo $this->uniqueId . '/' . $this->action->id; ?></h1> -->

<?php if ( !empty($time) ) : ?>

<div class="alert alert-info" role="alert">
	<?php echo 'You last logged in on ' . $time; ?>
</div>

<?php endif; ?>

<p>
This is the view content for action "<?php echo $this->action->id; ?>".
The action belongs to the controller "<?php echo get_class($this); ?>"
in the "<?php echo $this->module->id; ?>" module.
</p>
<p>
You may customize this page by editing <tt><?php echo __FILE__; ?></tt>
</p>

<?php
	Yii::app()->clientScript->registerScript(
		'fadeAndHideEffect',
		'$(".alert-info").animate({opacity: 1.0}, 3000).fadeOut("slow");'
	);
?>
