<?php
/* @var $this TaskController */
/* @var $model Task */

$this->breadcrumbs=array(
	Yii::t('RushModule.admin','Tasks')=>array('index'),
	Yii::t('RushModule.admin','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('RushModule.admin','Create task'), 'icon'=>'file black', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#task-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('RushModule.admin','Manage tasks'); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'task-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'template'=>"{items}",
	'columns'=>array(
		array('name'=>'id', 'header'=>Yii::t('admin', '#'), 'htmlOptions'=>array('style'=>'width: 30px'),),
		array('name' => 'tour_id', 'filter' => Tour::dropDown(), 'value' => 'Tour::dropDown()[$data->tour_id]'),
		array('name' => 'type', 'filter' => Task::types(), 'value' => 'Task::types()[$data->type]'),
		'task',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template' => '{update}{delete}'
		),
	),
)); ?>
