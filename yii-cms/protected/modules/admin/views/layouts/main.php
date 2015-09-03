<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />

	<!-- blueprint CSS framework -->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">

	<?php		
		// blueprint CSS framework
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/screen.css');

		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/form.css');
	?>

	<?php /*load Yiistrap*/ Yii::app()->bootstrap->register(); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?> - Admin Area</div>

		<div id="language-selector" style="float:right; margin:5px;">
		    <?php $this->widget('application.components.widgets.LanguageSelector'); ?>
		</div>		
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Return to site\'s home page', 'url'=>array('/site/index')),
				array('label'=>'Article', 'url'=>array('/admin/article/index'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Category', 'url'=>array('/admin/category/index'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'User', 'url'=>array('/admin/user/index'), 'visible'=>!Yii::app()->user->isGuest, 'visible'=>Yii::app()->user->checkAccess('admin')),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/admin/default/logout'), 'visible'=>!Yii::app()->user->isGuest),
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
