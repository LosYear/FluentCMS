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

<h1><?php echo Yum::t('Manage profiles'); ?> </h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'profiles-grid',
	'dataProvider'=>$dataProvider,
        'type'=>'striped bordered condensed',
	'filter'=>$model,
        'template'=>"{items}",
	'columns'=>array(
                array('name'=>'id', 'header'=>'#', 'htmlOptions'=>array('style'=>'width: 30px'),),
                   // 'email',
            array('name' => 'user_id', 'header' => Yum::t('Username'), 'value' => 'YumUser::getUsernameById($data->user_id)'),
            'name',
            'city',
            'school',
		array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 40px'),
                    'template'=>'{update}{delete}',
		),
					),

)); ?>


