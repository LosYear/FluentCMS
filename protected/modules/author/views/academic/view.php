<?php
/* @var $this AcademicController */
/* @var $model Academic */

$this->breadcrumbs=array(
	'Academics'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Academic', 'url'=>array('index')),
	array('label'=>'Create Academic', 'url'=>array('create')),
	array('label'=>'Update Academic', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Academic', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Academic', 'url'=>array('admin')),
);
?>

<h1>View Academic #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'abbr',
	),
)); ?>
