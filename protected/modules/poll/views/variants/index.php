<?php
/* @var $this VariantsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Poll Variants',
);

$this->menu=array(
	array('label'=>'Create PollVariant', 'url'=>array('create')),
	array('label'=>'Manage PollVariant', 'url'=>array('admin')),
);
?>

<h1>Poll Variants</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
