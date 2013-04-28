<?php
/* @var $this BlockController */
/* @var $model Block */

$this->breadcrumbs=array(
	Yii::t('admin', 'Blocks') =>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('admin', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('admin', 'Manage blocks'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('admin', 'Create block'), 'url'=>array('create'), 'icon'=>'file black'),
	array('label'=>Yii::t('admin', 'View block'), 'icon'=> 'eye-open','url'=>array('view', 'id'=>$model->id)),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Blocks') ?> <small><?php echo Yii::t('admin', 'Update') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>