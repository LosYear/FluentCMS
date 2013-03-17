<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	Yii::t('admin', 'Pages')=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('admin', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('admin', 'Manage pages'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('admin', 'Create page'), 'url'=>array('create'), 'icon'=>'file black'),
	array('label'=>Yii::t('admin', 'View page'), 'icon'=> 'eye-open','url'=>array('view', 'id'=>$model->id)),
);
?>

<h1><?php echo Yii::t('admin', 'Update page')." "; echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>