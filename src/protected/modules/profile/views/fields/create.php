<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Profile fields') ?> <small><?php echo Yii::t('admin', 'Create') ?></small></h1>
</div>
<?php
$this->breadcrumbs=array(
	Yii::t("yum", 'Profile fields')=>array('admin'),
	Yii::t("yum", 'Create'));

$this->menu=array(
	array('label'=>Yii::t('yum', 'Manage fields'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('yum', 'Create field'), 'url'=>array('create'), 'icon'=>'file black'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
