<?php
/* @var $this PollController */
/* @var $model Poll */

$this->breadcrumbs=array(
	Yii::t('PollModule.admin', 'Poll')=>array('admin'),
	Yii::t('admin', 'Create') ,
);

$this->menu=array(
	array('label'=>Yii::t('PollModule.admin','Manage polls'), 'icon'=>'list black', 'url'=>array('admin')),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('PollModule.admin', 'Poll') ?> <small><?php echo Yii::t('admin', 'Create') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'node' => $node)); ?>