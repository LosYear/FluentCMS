<?php
/* @var $this BranchController */
/* @var $model Branch */

$this->breadcrumbs=array(
	Yii::t('AuthorModule.admin', 'Branches')=>array('admin'),
	$model->name
);

$this->menu=array(
	array('label'=>Yii::t('AuthorModule.admin', 'Manage'), 'url'=>array('admin'), 'icon' => 'list'),
	array('label'=>Yii::t('AuthorModule.admin', 'Create'), 'url'=>array('create'), 'icon' => 'file'),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('AuthorModule.admin', 'Branches') ?> <small><?php echo $model->name ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>