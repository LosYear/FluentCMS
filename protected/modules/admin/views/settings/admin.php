<?php
$this->breadcrumbs=array(
	Yii::t('admin', 'Settings')=>array('admin'),
	Yii::t('admin', 'Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('admin', 'Manage settings'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('admin', 'Create param'), 'url'=>array('create'), 'icon'=>'file black'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('setting-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Settings') ?> <small><?php echo Yii::t('admin', 'Manage') ?></small></h1>
</div>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block' => true,
    'fade' => true,
    'closeText' => '&times;',
    'alerts' => array(
        'success' => array('block' => true, 'fade' => true, 'closeText' => '&times;'),
    ))); ?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'setting-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'type'=>'striped bordered condensed',
	'columns'=>array(
		'key',
		'value',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{update}',
		),
	),
)); ?>
