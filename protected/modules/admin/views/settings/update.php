<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->key=>array('view','id'=>$model->key),
	'Update',
);

$this->menu=array(
	array('label'=>'List Setting','url'=>array('index')),
	array('label'=>'Create Setting','url'=>array('create')),
	array('label'=>'View Setting','url'=>array('view','id'=>$model->key)),
	array('label'=>'Manage Setting','url'=>array('admin')),
);
?>

<h1>Update Setting <?php echo $model->key; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>