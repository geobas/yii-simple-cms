<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

// if user is already logged in then redirect to admin's module index
if ( !Yii::app()->user->isGuest )
	Yii::app()->request->redirect('admin/default/index');

$this->pageTitle=Yii::app()->name . ' - ' . Yii::t('adminModule.login', 'Login');
$this->breadcrumbs=array(
	Yii::t('adminModule.login', 'Login'),
);
?>

<?php $dots = '...'; ?>

<h1><?php echo Yii::t('adminModule.login', 'Login{dots}', array('{dots}' => $dots)); ?></h1>

<p><?php echo Yii::t('adminModule.login', 'Please fill out the following form with your login credentials'); ?>:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><?php echo Yii::t('adminModule.login', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('adminModule.login', 'are required'); ?>.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
			<?php echo Yii::t('adminModule.login', 'Hint: You may login with <kbd>admin</kbd>/<kbd>admin</kbd>'); ?>.
		</p>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php //echo CHtml::submitButton('Login'); ?>
		<?php echo TbHtml::submitButton(Yii::t('adminModule.login', 'Login'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
