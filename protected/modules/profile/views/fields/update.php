<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Profile field') ?> <small><?php echo Yii::t('admin', 'Update') ?></small></h1>
</div>
<?php
$this->breadcrumbs=array(
	Yii::t("yum", 'Profile fields')=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t("yum", 'Update'));

$this->menu=array(
	array('label'=>Yii::t('yum', 'Manage fields'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('yum', 'Create field'), 'url'=>array('create'), 'icon'=>'file black'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
