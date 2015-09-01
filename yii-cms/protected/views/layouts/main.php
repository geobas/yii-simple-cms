<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
	
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
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>

		<div id="language-selector" style="float:right; margin:5px;">
		    <?php $this->widget('application.components.widgets.LanguageSelector'); ?>
		</div>		
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Articles', 'url'=>array('/site/articles')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Admin', 'url'=>array('/admin/default/index')),
				// array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/admin/default/logout'), 'visible'=>!Yii::app()->user->isGuest),
				// array('label'=>'Dummy', 'url'=>array('/site/index', 'id' => 1, 'pid' => 2, 'name' => 'geo')),
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
