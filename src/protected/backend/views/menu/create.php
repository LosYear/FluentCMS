<?php
/* @var $this MenuController */
/* @var $model Menu */

$this->breadcrumbs=array(
	Yii::t('admin', 'Menu')=>array('admin'),
	Yii::t('admin', 'Create'),
);

$this->menu=array(
    array('label'=>Yii::t('admin','Manage menus'), 'url'=>array('admin'), 'icon'=>'list black'),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Menu') ?> <small><?php echo Yii::t('admin', 'Create') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>