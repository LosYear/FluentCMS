<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	Yii::t('RushModule.admin','Categories')=>array('admin'),
	Yii::t('RushModule.admin','Manage'),
);

$this->menu=array(
        array('label'=>Yii::t('RushModule.admin','Create category'), 'icon'=>'file black', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('category-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('RushModule.admin','Manage categories'); ?></h1>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'category-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
        'template'=>"{items}",
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id', 'header'=>Yii::t('admin', '#'), 'htmlOptions'=>array('style'=>'width: 30px'),),
		'name',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template' => '{update}{delete}'
		),
	),
)); ?>
