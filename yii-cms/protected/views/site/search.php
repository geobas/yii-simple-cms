<?php
/* @var $this SiteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Results',
);

?>

<h1>Results</h1>

<?php
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'emptyText'=>'Try again...',
	    'sortableAttributes'=>array(
	        'title',
	        'create_time',
	    ),		
	));
?>
