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

<div class="page-header">
  <h1><?php echo Yii::t('admin', 'News') ?> <small><?php echo Yii::t('admin', 'Create') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>