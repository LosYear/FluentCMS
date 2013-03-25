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

<div class="page-header">
  <h1><?php echo Yii::t('RushModule.admin', 'Tasks') ?> <small><?php echo Yii::t('RushModule.admin', 'Manage') ?></small></h1>
</div>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ))); ?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'task-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'template'=>"{items}",
	'columns'=>array(
		array('name'=>'id', 'header'=>Yii::t('admin', '#'), 'htmlOptions'=>array('style'=>'width: 30px'),),
		array('name' => 'tour_id', 'filter' => Tour::dropDown(), 'value' => 'Tour::title($data->tour_id)'),
		array('name' => 'type', 'filter' => Task::types(), 'value' => 'Task::type($data->id)'),
		'task',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template' => '{update}{delete}'
		),
	),
)); ?>
