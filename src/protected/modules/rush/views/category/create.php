<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	Yii::t('RushModule.admin', 'Categories')=>array('admin'),
	Yii::t('RushModule.admin', 'Create'),
);

$this->menu=array(
	array('label'=>Yii::t('RushModule.admin','Manage categories'), 'icon'=>'list black', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('RushModule.admin', 'Create category') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>