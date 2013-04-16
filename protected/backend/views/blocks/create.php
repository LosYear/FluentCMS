<?php
/* @var $this BlockController */
/* @var $model Block */

$this->breadcrumbs=array(
	Yii::t('admin', 'Blocks')=>array('admin'),
	Yii::t('admin', 'Create'),
);

$this->menu=array(
    array('label'=>Yii::t('admin','Manage blocks'), 'url'=>array('admin'), 'icon'=>'list black'),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Blocks') ?> <small><?php echo Yii::t('admin', 'Create') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>