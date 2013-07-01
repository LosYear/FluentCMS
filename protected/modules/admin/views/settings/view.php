<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->key,
);

$this->menu=array(
	array('label'=>'List Setting','url'=>array('index')),
	array('label'=>'Create Setting','url'=>array('create')),
	array('label'=>'Update Setting','url'=>array('update','id'=>$model->key)),
	array('label'=>'Delete Setting','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->key),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Setting','url'=>array('admin')),
);
?>

<h1>View Setting #<?php echo $model->key; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'key',
		'value',
	),
)); ?>
