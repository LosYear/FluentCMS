<?php
$this->breadcrumbs=array(
	'States'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Manage'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('states-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->menu=array(
	array('label'=>Yii::t('yum', 'Manage profiles'), 'url'=>array('admin'), 'icon'=>'list black',),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Profiles') ?> <small><?php echo Yii::t('admin', 'Manage') ?></small></h1>
</div>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ))); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'profiles-grid',
	'dataProvider'=>$dataProvider,
        'type'=>'striped bordered condensed',
	'filter'=>$model,
        'template'=>"{items}\n{pager}",
	'columns'=>array(
            array('name'=>'id', 'header'=>'#', 'htmlOptions'=>array('style'=>'width: 30px', 'class' => 'hidden-phone'),
                'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
            array('name' => 'user_id', 'header' => Yum::t('Username'), 'value' => 'YumUser::getUsernameById($data->user_id)'),
            'name',
            array('name' => 'city', 'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
            array('name' => 'school', 'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
		array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 40px'),
                    'template'=>'{update}{delete}',
		),
					),

)); ?>


