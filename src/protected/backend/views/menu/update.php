<?php
/* @var $this MenuController */
/* @var $model Menu */

$this->breadcrumbs=array(
	Yii::t('admin','Menu')=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('admin','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('admin', 'Manage menus'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('admin', 'Create menu'), 'url'=>array('create'), 'icon'=>'file black'),
	array('label'=>Yii::t('admin', 'View menu'), 'icon'=> 'eye-open','url'=>array('view', 'id'=>$model->id)),
);
?>

<h1><?php echo Yii::t('admin','Update menu'); ?> <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>