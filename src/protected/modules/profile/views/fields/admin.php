<?php
$this->title = Yii::t("yum", 'Manage profile fields'); 

$this->breadcrumbs=array(
	Yii::t("yum", 'Profile fields')=>array('admin'),
	Yii::t("yum", 'Manage'));

$this->menu=array(
	array('label'=>Yii::t('yum', 'Manage fields'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('yum', 'Create field'), 'url'=>array('create'), 'icon'=>'file black'),
);

?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$dataProvider,
        'type'=>'striped bordered condensed',
        'template'=>"{items}",
	'columns'=>array(
		//'position',
		'varname',
		array(
			'name'=>'title',
			'value'=>'Yii::t("UserModule.user", $data->title)',
		),
		'field_type',
		//'field_size',
		//'field_size_min',
		array(
			'name'=>'required',
			'value'=>'YumProfileField::itemAlias("required",$data->required)',
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
