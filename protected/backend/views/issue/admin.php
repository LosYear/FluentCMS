<?php
/* @var $this IssueController */
/* @var $model Issue */

$this->breadcrumbs=array(
	'Issues'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>Yii::t('author','Create issue'), 'url'=>array('create'),'icon'=>'file black'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('issue-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('author', 'Manage issues'); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'issue-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
        'template'=>"{items}",
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id', 'header'=>Yii::t('admin', '#'), 'htmlOptions'=>array('style'=>'width: 30px'),),
		'number',
		'year',
		'cover',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template' => '{update}{delete}'
		),
	),
)); ?>
