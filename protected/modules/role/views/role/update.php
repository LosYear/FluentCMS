<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Role') ?> <small><?php echo Yii::t('admin', 'Update') ?></small></h1>
</div>
<?php
$this->breadcrumbs=array(
	Yum::t('Roles')=>array('index'),
	Yum::t('Update'));

$this->menu=array(
            array('label'=>Yii::t('yum','Create role'), 'url'=>array('create'), 'icon'=>'file black'),
            array('label'=>Yii::t('yum', 'Manage roles'), 'url'=>array('admin'), 'icon'=>'list black',),
);

?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
