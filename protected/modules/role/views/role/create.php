<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Role') ?> <small><?php echo Yii::t('admin', 'Create') ?></small></h1>
</div>
<?php
$this->breadcrumbs=array(
	Yum::t('Roles')=>array('admin'),
	Yum::t('Create'));

$this->menu=array(
	array('label'=>Yii::t('yum', 'Manage roles'), 'url'=>array('admin'), 'icon'=>'list black',),
);

?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
