<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	Yii::t('admin', 'News')=>array('admin'),
	Yii::t('admin', 'Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('admin', 'Manage news'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('admin', 'Create news'), 'url'=>array('create'), 'icon'=>'file black'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('news-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('admin', 'Manage news'); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'news-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'template'=>"{items}",
	'columns'=>array(
            array('name'=>'id', 'header'=>Yii::t('admin', '#')),
            array('name'=>'title', 'header'=>Yii::t('admin', 'Title')),
            array('name'=>'url', 'header'=>Yii::t('admin', 'Url')),
            array('name' => 'author', 'type'=>'html', 'header'=>Yii::t('admin', 'Author'), 'value'=>'YumUser::model()->findByPk($data->author)->username'),
            array('name' => 'created', 'header' => Yii::t('admin', 'Created')),
            array('name'=>'status', 'type'=>'html','header'=>Yii::t('admin', 'Status'), 'value'=>'($data->status == 1) ?  "<i class=\" icon-eye-open\"/>" : "<i class=\" icon-eye-close\"/>"'),
            array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 40px'),
                    'template'=>'{update}{delete}',
		),
	),
)); ?>