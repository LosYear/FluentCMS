<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	Yii::t('admin','News')=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('admin','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('admin', 'Manage news'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('admin', 'Create news'), 'url'=>array('create'), 'icon'=>'file black'),
	array('label'=>Yii::t('admin', 'View news'), 'icon'=> 'eye-open','url'=>array('view', 'id'=>$model->id)),
);
?>

<h1><?php echo Yii::t('admin','Update news'); ?> <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>