<?php
/* @var $this MenuController */
/* @var $model Menu */

$this->breadcrumbs=array(
	'Menus'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('admin','Manage menus'), 'url'=>array('admin'), 'icon'=>'list black'),
);
?>

<h1><?php echo Yii::t('admin', 'Create menu'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>