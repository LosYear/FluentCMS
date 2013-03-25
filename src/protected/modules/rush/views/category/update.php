<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	Yii::t('RushModule.admin', 'Categories')=>array('admin'),
	$model->name=>'#',
	Yii::t('RushModule.admin', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('RushModule.admin','Create category'), 'icon'=>'file black', 'url'=>array('create')),
	array('label'=>Yii::t('RushModule.admin','Manage categories'), 'icon'=>'list black', 'url'=>array('admin')),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('RushModule.admin', 'Category') ?> <small><?php echo Yii::t('RushModule.admin', 'Update') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>