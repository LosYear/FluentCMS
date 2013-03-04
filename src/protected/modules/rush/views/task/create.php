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

<h1><?php echo Yii::t('RushModule.admin', 'Create task') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>