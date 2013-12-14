<?php
/* @var $this MenuItemController */
/* @var $model MenuItem */

$this->breadcrumbs=array(
	Yii::t('admin','Menu items')=>'#',
	Yii::t('admin', 'Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('admin', 'Manage menu items'), 'url'=>array('admin', 'id'=>$model->menu_id), 'icon'=>'list black',),
	array('label'=>Yii::t('admin', 'Create menu item'), 'url'=>array('create', 'id'=>$model->menu_id), 'icon'=>'file black'),
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

<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Menu items') ?> <small><?php echo Yii::t('admin', 'Manage') ?></small></h1>
</div>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ))); ?>

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
        'template' => '{order}{items}{pager}',
        'options'=>array(
            'cursor' => 'crosshair',
        ),
	'columns'=>array(
		array('name'=>'id', 'header'=>Yii::t('admin', '#'), 'htmlOptions'=>array('style'=>'width: 30px'),
                    'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
                array('name' => 'parent_id',
                    'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
		array('name'=>'title', 'header'=>Yii::t('admin', 'Title')),
                array('name' => 'href',
                    'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
                array('name' => 'type',
                    'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
		array('name'=>'status', 'type'=>'html','header'=>Yii::t('admin', 'Status'), 'value'=>'($data->status == 1) ?  "<span class=\"glyphicon  glyphicon-eye-open\"/>" : "<span class=\"glyphicon glyphicon-eye-close\"/>"'),
		array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 40px'),
                    'template'=>'{update}{delete}',
		),
	),
));?>
