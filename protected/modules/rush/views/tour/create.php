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

<div class="page-header">
  <h1><?php echo Yii::t('RushModule.admin', 'Tour') ?> <small><?php echo Yii::t('RushModule.admin', 'Create') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>