<?php
/* @var $this MenuItemController */
/* @var $model MenuItem */

$this->breadcrumbs=array(
	Yii::t('admin','Menu items')=>array('admin'),
	Yii::t('admin', 'Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('admin', 'Manage menu items'), 'url'=>array('admin', 'id'=>$model->menu_id), 'icon'=>'list black',),
	array('label'=>Yii::t('admin', 'Create menu item'), 'url'=>array('create'), 'icon'=>'file black'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('menu-item-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('admin', 'Manage menu items'); ?></h1>

<?php $this->widget('ext.RGridView.RGridViewWidget', array(
	//'id'=>'menu-item-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'type'=>'striped bordered condensed',
        'template'=>"{items}",
        'dataProvider'=>$model->search(),
        'rowCssId'=>'$data->id',
        'orderUrl'=>array('order'),
        'successOrderMessage'=>'Success',
        'buttonLabel'=>'Order',
        'template' => '{order}{items}',
        'options'=>array(
            'cursor' => 'crosshair',
        ),
	'columns'=>array(
		array('name'=>'id', 'header'=>Yii::t('admin', '#'), 'htmlOptions'=>array('style'=>'width: 30px'),),
		'parent_id',
		//'menu_id',
		array('name'=>'title', 'header'=>Yii::t('admin', 'Title')),
		'href',
		'type',
		array('name'=>'status', 'type'=>'html','header'=>Yii::t('admin', 'Status'), 'value'=>'($data->status == 1) ?  "<i class=\" icon-eye-open\"/>" : "<i class=\" icon-eye-close\"/>"'),
		array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 40px'),
                    'template'=>'{update}{delete}',
		),
	),
));?>
