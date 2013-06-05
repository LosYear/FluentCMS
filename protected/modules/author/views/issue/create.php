<?php
/* @var $this IssueController */
/* @var $model Issue */

$this->breadcrumbs=array(
	'Issues'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t('author', 'Manage issues'), 'url'=>array('admin'), 'icon' =>'list black'),
);
?>

<h1><?php echo Yii::t('author', 'Create issue'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>