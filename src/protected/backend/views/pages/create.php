<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	Yii::t('admin','Pages')=>array('admin'),
	Yii::t('admin','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('admin','Manage pages'), 'url'=>array('admin'), 'icon'=>'list black'),
);
?>

<h1><?php echo Yii::t('admin', 'Create page'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>