<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs=array(
    Yii::t('BannerModule.admin', 'Banners')=>array('admin'),
    Yii::t('admin', 'Manage'),
);

$this->menu=array(
    array('label'=>Yii::t('BannerModule.admin', 'Manage banners'), 'url'=>array('admin'), 'icon'=>'list black',),
    array('label'=>Yii::t('BannerModule.admin', 'Create banner'), 'url'=>array('create'), 'icon'=>'file black'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#banner-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="page-header">
    <h1><?php echo Yii::t('BannerModule.admin', 'Banners') ?> <small><?php echo Yii::t('admin', 'Manage') ?></small></h1>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'banner-grid',
    'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'title',
		'href',
		'views',
		'clicks',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 40px'),
            'template'=>'{update}{delete}',
        ),
	),
)); ?>
