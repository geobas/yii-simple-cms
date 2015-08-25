<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Καλωσήρθες στο <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<?php // CVarDumper::dump(Yii::getLogger()->getLogs(), 3, true); // YII_DEBUG must be true ?>

<p>Συγχαρητήρια! Έχετε δημιουργήσει με επιτυχία την εφαρμογή σας Yii. <span class="label label-info"><?php echo $today['mday'] . ' ' . $locale->monthNames[$today['mon']] . ' ' . $today['year'];?></span></p>

<p>Μπορείτε να αλλάξετε το περιεχόμενο αυτής της σελίδας με την τροποποίηση των ακόλουθων δύο φακέλων</p>
<ul>
	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

<p>Για περισσότερες λεπτομέρειες σχετικά με το πώς μπορείτε να αναπτύξετε περαιτέρω αυτήν την εφαρμογή, παρακαλούμε διαβάστε την <a href="http://www.yiiframework.com/doc/">τεκμηρίωση</a>.
Μη διστάσετε να ρωτήσετε στο <a href="http://www.yiiframework.com/forum/">forum</a>, εάν έχετε οποιεσδήποτε ερωτήσεις.</p>