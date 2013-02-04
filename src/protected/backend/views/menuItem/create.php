<?php
/* @var $this MenuItemController */
/* @var $model MenuItem */

$this->breadcrumbs=array(
	'Menu Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MenuItem', 'url'=>array('index')),
	array('label'=>'Manage MenuItem', 'url'=>array('admin')),
);
?>

<h1>Create MenuItem</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>