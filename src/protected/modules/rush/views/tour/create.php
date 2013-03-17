<?php
/* @var $this TourController */
/* @var $model Tour */

$this->breadcrumbs=array(
	Yii::t('RushModule.admin', 'Tours')=>array('index'),
	Yii::t('RushModule.admin', 'Create'),
);

$this->menu=array(
        array('label'=>Yii::t('RushModule.admin', 'Manage tours'), 'url'=>array('admin'), 'icon'=>'list black'),
);
?>

<h1><?php echo Yii::t('RushModule.admin', 'Create tour');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>