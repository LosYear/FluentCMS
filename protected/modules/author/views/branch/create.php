<?php
/* @var $this BranchController */
/* @var $model Branch */

$this->breadcrumbs=array(
	Yii::t('AuthorModule.admin', 'Branches')=>array('admin'),
	Yii::t('AuthorModule.admin', 'Create'),
);

$this->menu=array(
	array('label'=>Yii::t('AuthorModule.admin', 'Manage'), 'url'=>array('admin'), 'icon' => 'list'),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('AuthorModule.admin', 'Branches') ?> <small><?php echo Yii::t('AuthorModule.admin', 'Create') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>