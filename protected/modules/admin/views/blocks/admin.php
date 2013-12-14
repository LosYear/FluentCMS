<?php
/* @var $this BlockController */
/* @var $model Block */

$this->breadcrumbs=array(
	Yii::t('admin', 'Blocks')=>array('admin'),
	Yii::t('admin', 'Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('admin', 'Manage blocks'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('admin', 'Create block'), 'url'=>array('create'), 'icon'=>'file black'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('block-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Blocks') ?> <small><?php echo Yii::t('admin', 'Manage') ?></small></h1>
</div>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ))); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'block-grid',
    'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'template'=>"{items}\n{pager}",
	'columns'=>array(
		array('name'=>'id', 'header'=>Yii::t('admin', '#'), 'htmlOptions'=>array('style'=>'width: 30px'),
                    'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
		array('name'=>'title', 'header'=>Yii::t('admin', 'Title')),
		array('name'=>'name', 'header'=>Yii::t('admin', 'Name'),
                    'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
                array('name'=>'type', 'header'=>Yii::t('admin', 'Type'),
                    'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
		array('name' => 'author', 'type'=>'html', 'header'=>Yii::t('admin', 'Author'), 'value'=>'YumUser::model()->findByPk($data->author)->username',
                    'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
		array('name' => 'created', 'header' => Yii::t('admin', 'Created'),
                    'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
                array('name'=>'status', 'type'=>'html','header'=>Yii::t('admin', 'Status'), 'value'=>'($data->status == 1) ?  "<span class=\"glyphicon  glyphicon-eye-open\"/>" : "<span class=\"glyphicon glyphicon-eye-close\"/>"'),
		array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 40px'),
                    'template'=>'{update}{delete}',
		),
	),
)); ?>
