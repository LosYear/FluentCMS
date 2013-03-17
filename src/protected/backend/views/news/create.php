<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	Yii::t('admin','News')=>array('admin'),
	Yii::t('admin','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('admin','Manage news'), 'url'=>array('admin'), 'icon'=>'list black'),
);
?>

<h1><?php echo Yii::t('admin', 'Create news'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>