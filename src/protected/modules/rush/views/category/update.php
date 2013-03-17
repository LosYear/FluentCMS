<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	Yii::t('RushModule.admin', 'Categories')=>array('admin'),
	$model->name=>'#',
	Yii::t('RushModule.admin', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('RushModule.admin','Create category'), 'icon'=>'file black', 'url'=>array('create')),
	array('label'=>Yii::t('RushModule.admin','Manage categories'), 'icon'=>'list black', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('RushModule.admin','Update category').' '.$model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>