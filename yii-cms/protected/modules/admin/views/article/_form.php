<?php
/* @var $this ArticleController */
/* @var $model Article */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php //echo $form->dropDownList($model,'category', $model->getCategoryOptions()); ?>
		<?php echo $form->dropDownList(
								$model,
								'category', 
								$model->categoryList,
								array(/*'multiple'=>'false', */'options' => array($model->category => array('selected' => true)))
						  ); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>	

	<div class="row">
		<?php //echo $form->labelEx($model,'body'); ?>
		<?php //echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
		<?php //echo $form->error($model,'body'); ?>
		<?php $this->widget('application.extensions.extckeditor.ExtCKEditor', array(
				'model'=>$model,
				'attribute'=>'body', // model atribute
				'language'=>'en', /* default lang, If not declared the language of the project will be used in case of using multiple languages */
				'editorTemplate'=>'full', // Toolbar settings (full, basic, advanced)
			  )); 
		?>		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'published'); ?>
		<?php echo $form->dropDownList($model,'published', $model->publishedOptions); ?>
		<?php echo $form->error($model,'published'); ?>
	</div>

	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->