<?php
/* @var $this TourController */
/* @var $model Tour */

$this->breadcrumbs=array(
	Yii::t('RushModule.admin', 'Tours')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('RushModule.admin', 'Update'),
);

$this->menu=array(
        array('label'=>Yii::t('RushModule.admin', 'Manage tours'), 'url'=>array('admin'), 'icon'=>'list black'),
	array('label'=>Yii::t('RushModule.admin', 'Create tour'), 'url'=>array('create'), 'icon'=>'file black'),
);
?>

<h1><?php echo Yii::t('RushModule.admin', 'Update tour').' ';?><?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>