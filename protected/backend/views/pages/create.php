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

<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Page') ?> <small><?php echo Yii::t('admin', 'Create') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>