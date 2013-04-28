<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	Yii::t('admin', 'Pages')=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('admin', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('admin', 'Manage pages'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('admin', 'Create page'), 'url'=>array('create'), 'icon'=>'file black'),
	array('label'=>Yii::t('admin', 'View page'), 'icon'=> 'eye-open','url'=>array('view', 'id'=>$model->id)),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Page') ?> <small><?php echo Yii::t('admin', 'Update') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>