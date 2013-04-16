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

<div class="page-header">
  <h1><?php echo Yii::t('RushModule.admin', 'Tours') ?> <small><?php echo Yii::t('RushModule.admin', 'Manage') ?></small></h1>
</div>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ))); ?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'tour-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
        'template'=>"{items}\n{pager}",
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id', 'header'=>Yii::t('admin', '#'), 'htmlOptions' => array('class' => 'hidden-phone', 'style'=>'width: 30px'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
		'name',
                array('name' => 'type', 'filter' => Tour::types(), 'value' => 'Tour::getType($data->id, true)', 'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
		array('name' => 'category_id', 'filter' => Category::dropDown(), 'value' => 'Category::getName($data->category_id)'),
		array('name' => 'from', 'filter' => false, 'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
		array('name' => 'till', 'filter' => false, 'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template' => '{update}{delete}'
		),
	),
)); ?>
