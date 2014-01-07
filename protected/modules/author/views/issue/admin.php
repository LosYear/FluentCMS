<?php
/* @var $this IssueController */
/* @var $model Issue */

$this->breadcrumbs=array(
    Yii::t('author', 'Issues')=>array('admin'),
    Yii::t('admin', 'Manage'),
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

<div class="page-header">
    <h1><?php echo Yii::t('author', 'Issues') ?>
        <small><?php echo Yii::t('AuthorModule.admin', 'Manage') ?></small>
    </h1>
</div>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block' => true,
    'fade' => true,
    'closeText' => '&times;',
    'alerts' => array(
        'success' => array('block' => true, 'fade' => true, 'closeText' => '&times;'),
    ))); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'issue-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
        'template'=>"{items}{pager}",
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
