<?php
/* @var $this VariantsController */
/* @var $model PollVariant */

$this->breadcrumbs=array(
	Yii::t('PollModule.admin','Variants')=>array('admin', 'id'=>$poll_id),
	Yii::t('admin', 'Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('PollModule.admin','Manage variants'), 'url'=>array('admin', 'id'=>$poll_id), 'icon'=>'list black'),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('PollModule.admin', 'Poll variant') ?> <small><?php echo Yii::t('admin', 'Create') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>