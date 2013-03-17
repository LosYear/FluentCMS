<?php
$this->title = Yum::t('Create role');

$this->breadcrumbs=array(
	Yum::t('Roles')=>array('admin'),
	Yum::t('Create'));

$this->menu=array(
	array('label'=>Yii::t('yum', 'Manage roles'), 'url'=>array('admin'), 'icon'=>'list black',),
);

?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
