<?php
$this->breadcrumbs=array(
	'Actions'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
            array('label'=>Yii::t('yum','Create action'), 'url'=>array('create'), 'icon'=>'file black'),
            array('label'=>Yii::t('yum', 'Manage actions'), 'url'=>array('admin'), 'icon'=>'list black',),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Action') ?> <small><?php echo Yii::t('admin', 'Update') ?></small></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>