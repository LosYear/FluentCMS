<?php
/* @var $this AcademicController */
/* @var $model Academic */

$this->breadcrumbs=array(
	Yii::t('AuthorModule.admin', 'Academics')=>array('admin'),
	Yii::t('AuthorModule.admin', 'Create'),
);

$this->menu=array(
	array('label'=>Yii::t('AuthorModule.admin', 'Manage'), 'url'=>array('admin'), 'icon' => 'list'),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('AuthorModule.admin', 'Academic') ?> <small><?php echo Yii::t('AuthorModule.admin', 'Create') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>