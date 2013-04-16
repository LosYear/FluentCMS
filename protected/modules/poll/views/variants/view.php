<?php
/* @var $this VariantsController */
/* @var $model PollVariant */

$this->breadcrumbs=array(
	'Poll Variants'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PollVariant', 'url'=>array('index')),
	array('label'=>'Create PollVariant', 'url'=>array('create')),
	array('label'=>'Update PollVariant', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PollVariant', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PollVariant', 'url'=>array('admin')),
);
?>

<h1>View PollVariant #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'poll_id',
		'text',
		'order',
	),
)); ?>
