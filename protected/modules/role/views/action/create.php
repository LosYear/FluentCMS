<?php
$this->breadcrumbs=array(
	Yum::t('Actions')=>array('admin'),
	Yum::t('Create'),
);

$this->menu=array(
	array('label'=>Yii::t('yum', 'Manage actions'), 'url'=>array('admin'), 'icon'=>'list black',),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Action') ?> <small><?php echo Yii::t('admin', 'Create') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
