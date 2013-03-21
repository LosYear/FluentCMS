<?php
/* @var $this TourController */
/* @var $model Tour */

$this->breadcrumbs=array(
	Yii::t('RushModule.admin','Tours')=>array('admin'),
	Yii::t('RushModule.admin','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('RushModule.admin', 'Create tour'), 'url'=>array('create'), 'icon'=>'file black'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tour-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('RushModule.admin','Manage tours'); ?></h1>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'tour-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
        'template'=>"{items}",
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id', 'header'=>Yii::t('admin', '#'), 'htmlOptions'=>array('style'=>'width: 30px'),),
		'name',
                array('name' => 'type', 'filter' => Tour::types(), 'value' => 'Tour::getType($data->id, true)'),
		array('name' => 'category_id', 'filter' => Category::dropDown(), 'value' => 'Category::getName($data->category_id)'),
		array('name' => 'from', 'filter' => false,),
		array('name' => 'till', 'filter' => false,),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template' => '{update}{delete}'
		),
	),
)); ?>
