<?php
/* @var $this TourController */
/* @var $model Tour */

$this->breadcrumbs=array(
	Yii::t('RushModule.admin', 'Tours')=>array('admin'),
	$model->name,
);

$this->menu=array(
        array('label'=>Yii::t('RushModule.admin', 'Manage tours'), 'url'=>array('admin'), 'icon'=>'list black'),
	array('label'=>Yii::t('RushModule.admin', 'Create tour'), 'url'=>array('create'), 'icon'=>'file black'),
	array('label'=>Yii::t('RushModule.admin', 'Update tour'), 'url'=>array('update', 'id'=>$model->id), 'icon'=>'pencil black'),
	array('label'=>Yii::t('RushModule.admin', 'Delete tour'),'icon'=>'trash black', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),

);
?>

<h1><?php echo Yii::t('RushModule.admin', 'View tour').' ';?><?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'category_id',
		'type',
		'from',
		'till',
	),
)); ?>
