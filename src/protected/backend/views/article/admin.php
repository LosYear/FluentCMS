<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>Yii::t('author', 'Create article'), 'url'=>array('create'), 'icon' => 'file black',),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('article-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div id="main">
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'article-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
      //  'htmlOptions' => array('class' => 'well'),
        'template'=>"{items}",
	'columns'=>array(
            array('name'=>'title', 'header'=>Yii::t('admin', 'Title')),
            array('name'=>'url', 'header'=>Yii::t('admin', 'Url')),
            array('name' => 'created', 'header' => Yii::t('admin', 'Created')),
            array(
                'name'=>'status', 
                'type'=>'html',
                'header'=>Yii::t('admin', 'Status'), 
                'value'=>'($data->status == 1) ?  "<i class=\" icon-eye-open\"/>" : "<i class=\" icon-eye-close\"/>"',
                'filter' => array(
                    '0' => Yii::t('author', 'Draft'),
                    '1' => Yii::t('author', 'Published'),
                    '2' => Yii::t('author', 'Pending'),
                    '3' => Yii::t('author', 'Awaiting correction')),

            ),
            array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 40px'),
                    'template'=>'{update}{delete}',
		),
	)
)); ?></div>