<?php
/* @var $this PollController */
/* @var $model Poll */

$this->breadcrumbs=array(
	Yii::t('PollModule.admin', 'Poll')=>array('admin'),
	$node->title,
);

$this->menu=array(
	array('label'=>Yii::t('PollModule.admin','Manage polls'), 'icon'=>'list black', 'url'=>array('admin')),
        array('label'=>Yii::t('PollModule.admin','Create poll'), 'icon'=>'file black', 'url'=>array('create')),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('PollModule.admin', 'Poll') ?> <small><?php echo Yii::t('admin', 'Update') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'node' => $node)); ?>