<?php
/* @var $this PollController */
/* @var $model Poll */

$this->breadcrumbs=array(
	Yii::t('PollModule.admin', 'Polls')=>array('admin'),
	Yii::t('admin', 'Manage'),
);

$this->menu=array(
        array('label'=>Yii::t('PollModule.admin','Create poll'), 'icon'=>'file black', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#poll-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="page-header">
  <h1><?php echo Yii::t('PollModule.admin', 'Polls') ?> <small><?php echo Yii::t('admin', 'Manage') ?></small></h1>
</div>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
))); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'poll-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
        'template'=>"{items}\n{pager}",
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id', 'header'=>Yii::t('admin', '#'), 'htmlOptions'=>array('style'=>'width: 30px'),),
		array('name'=>'title', 'header' => Yii::t('admin', 'title'), 
                    'value' => '"<b><a href=\"".Yii::app()->createUrl("poll/variants", array("id"=>Poll::getIdByNode($data->id)))."\">$data->title</a></b>"',
                    'type' => 'html',
                    ),
		/*'isLimited',
		'from',
		'till',*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template' => '{update}{delete}'
		),
	),
)); ?>
