<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Profile fields') ?> <small><?php echo Yii::t('admin', 'Manage') ?></small></h1>
</div>

<?php
$this->breadcrumbs=array(
	Yii::t("yum", 'Profile fields')=>array('admin'),
	Yii::t("yum", 'Manage'));

$this->menu=array(
	array('label'=>Yii::t('yum', 'Manage fields'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('yum', 'Create field'), 'url'=>array('create'), 'icon'=>'file black'),
);

?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ))); ?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$dataProvider,
        'type'=>'striped bordered condensed',
        'template'=>"{items}\n{pager}",
	'columns'=>array(
		//'position',
		'varname',
		array(
			'name'=>'title',
			'value'=>'Yii::t("UserModule.user", $data->title)',
		),
		 array('name' => 'field_type', 'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
		//'field_size',
		//'field_size_min',
		array(
			'name'=>'required',
			'value'=>'YumProfileField::itemAlias("required",$data->required)',
                        'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone'),
		),
		//'match',
		//'range',
		//'error_message',
		//'other_validator',
		//'default',
		//'position',
		/*array(
			'name'=>'visible',
			'value'=>'YumProfileField::itemAlias("visible",$data->visible)',
		),*/
		//*/
		array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 40px'),
                    'template'=>'{update}{delete}',
		),
	),
)); ?>
