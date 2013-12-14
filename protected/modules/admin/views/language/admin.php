<?php
/* @var $this LanguageController */
/* @var $model Language */

$this->breadcrumbs=array(
	Yii::t('admin', 'Languages')=>array('admin'),
	Yii::t('admin', 'Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('admin', 'Manage languages'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('admin', 'Create language'), 'url'=>array('create'), 'icon'=>'file black'),
);

?>

<div class="page-header">
	<h1><?php echo Yii::t('admin', 'Languages') ?> <small><?php echo Yii::t('admin', 'Manage') ?></small></h1>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'language-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>'striped bordered condensed',
	'template' => '{items}{pager}',
	'columns'=>array(
		'id',
		'name',
		'flag',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'htmlOptions'=>array('style'=>'width: 40px'),
			'template'=>'{update}',
		),
	),
)); ?>
