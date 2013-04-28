<?php
/* @var $this MenuItemController */
/* @var $model MenuItem */

$this->breadcrumbs=array(
	'Menu Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t('admin', 'Manage menu items'), 'url'=>array('admin', 'id'=>$model->menu_id), 'icon'=>'list black',)
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Menu items') ?> <small><?php echo Yii::t('admin', 'Create') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>