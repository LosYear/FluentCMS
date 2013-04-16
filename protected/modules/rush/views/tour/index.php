<?php
/* @var $this TourController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tours',
);

$this->menu=array(
	array('label'=>'Create Tour', 'url'=>array('create')),
	array('label'=>'Manage Tour', 'url'=>array('admin')),
);
?>

<h1>Tours</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
