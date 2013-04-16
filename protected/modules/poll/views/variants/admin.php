<?php
/* @var $this VariantsController */
/* @var $model PollVariant */

$this->breadcrumbs=array(
	Yii::t('PollModule.admin','Variants')=>array('admin', 'id'=>$id),
	Yii::t('admin', 'Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('PollModule.admin','Create poll variant'), 'icon'=>'file black', 'url'=>array('create', 'poll_id' => $id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#poll-variant-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="page-header">
  <h1><?php echo Yii::t('PollModule.admin', 'Poll Variants') ?> <small><?php echo Yii::t('admin', 'Manage') ?></small></h1>
</div>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ))); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'poll-variant-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
        'template'=>"{items}\n{pager}",
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id', 'header'=>Yii::t('admin', '#'), 'htmlOptions'=>array('style'=>'width: 30px'),),
		'text',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template' => '{update}{delete}'
		),
	),
)); ?>
