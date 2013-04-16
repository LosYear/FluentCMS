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

<div class="page-header">
  <h1><?php echo Yii::t('RushModule.admin', 'Tours') ?> <small><?php echo Yii::t('RushModule.admin', 'Update') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>