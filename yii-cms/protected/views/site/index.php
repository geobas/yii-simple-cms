<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<?php // CVarDumper::dump(Yii::getLogger()->getLogs(), 3, true); // YII_DEBUG must be true ?>

<p>Congratulations! You have successfully created your Yii application. <span class="label label-info"><?php echo $today['mday'] . ' ' . $locale->monthNames[$today['mon']] . ' ' . $today['year'];?></span></p>

<?php //echo Yii::app()->numberFormatter->formatDecimal(3.14); ?>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>

<?php

$this->beginWidget('zii.widgets.CPortlet', array(
	'title'=>'Recent Articles',
));

$this->widget('application.components.widgets.RecentArticlesWidget', array('displayLimit' => 3));

$this->endWidget();

?>
