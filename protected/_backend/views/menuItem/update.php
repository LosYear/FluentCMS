<?php
/* @var $this MenuItemController */
/* @var $model MenuItem */

$this->breadcrumbs=array(
	'Menu Items'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>Yii::t('admin', 'Manage menu items'), 'url'=>array('admin', 'id'=>$model->menu_id), 'icon'=>'list black',),
	array('label'=>Yii::t('admin', 'Create menu item'), 'url'=>array('create', 'id'=>$model->menu_id), 'icon'=>'file black'),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Menu items') ?> <small><?php echo Yii::t('admin', 'Update') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>