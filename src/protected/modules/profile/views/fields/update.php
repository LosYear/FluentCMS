<?php
$this->title = Yii::t("yum", 'Update profile field'). ' ' . $model->varname;
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
