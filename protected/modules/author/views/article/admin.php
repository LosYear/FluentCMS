<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>Yii::t('authorModule.main', 'Create article'), 'url'=>array('create'), 'icon' => 'file black',),
);
$this->renderPartial('application.modules.author.views.sidebar');

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
<div id="main"><div class="well">
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
                    '0' => Yii::t('authorModule.main', 'Draft'),
                    '1' => Yii::t('authorModule.main', 'Published'),
                    '2' => Yii::t('authorModule.main', 'Pending'),
                    '3' => Yii::t('authorModule.main', 'Awaiting correction')),

            ),
            array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 40px'),
                    'template'=>'{update}{delete}',
		),
	)
)); ?></div></div>
<?php $this->renderPartial('application.modules.author.views.sidebar2', array('menu'=>$this->menu)); ?>