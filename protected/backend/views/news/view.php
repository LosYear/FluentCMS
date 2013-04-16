<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	Yii::t('admin', 'News')=>array('admin'),
	$model->title,
);

$this->menu=array(
        array('label'=>Yii::t('admin', 'Manage news'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('admin', 'Create news'), 'url'=>array('create'), 'icon'=>'file black'),
	array('label'=>Yii::t('admin','Update news'), 'url'=>array('update', 'id'=>$model->id), 'icon'=>'pencil black'),
	array('label'=>Yii::t('admin','Delete news'), 'url'=>'#', 'icon'=>'trash black', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View News #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'url',
		'title',
		'content',
		//'author_id',
		'created',
		//'modified',
		//'modified_by',
		'status',
		//'comment_status',
	),
)); ?>
