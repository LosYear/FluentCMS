<?php
/* @var $this VariantsController */
/* @var $model PollVariant */

$this->breadcrumbs=array(
	Yii::t('PollModule.admin','Variants')=>array('admin', 'id'=>$model->poll_id),
	Yii::t('admin', 'Update'),
);

$this->menu=array(
    array('label'=>Yii::t('PollModule.admin','Manage variants'), 'url'=>array('admin', 'id'=>$model->poll_id), 'icon'=>'list black'),
    array('label'=>Yii::t('PollModule.admin','Create poll variant'), 'icon'=>'file black', 'url'=>array('create', 'poll_id' => $model->poll_id)),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('PollModule.admin', 'Poll variant') ?> <small><?php echo Yii::t('admin', 'Update') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>