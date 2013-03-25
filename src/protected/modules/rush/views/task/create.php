<?php
/* @var $this TaskController */
/* @var $model Task */

$this->breadcrumbs=array(
	Yii::t('RushModule.admin', 'Tasks')=>array('index'),
	Yii::t('RushModule.admin', 'Create'),
);

$this->menu=array(
	array('label'=>Yii::t('RushModule.admin', 'Manage tasks'),'icon'=>'file black', 'url'=>array('admin')),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('RushModule.admin', 'Task') ?> <small><?php echo Yii::t('RushModule.admin', 'Create') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>