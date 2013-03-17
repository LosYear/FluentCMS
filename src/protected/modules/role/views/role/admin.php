<?php
$this->title = Yum::t('Manage roles'); 

$this->breadcrumbs=array(
	Yum::t('Roles')=>array('admin'),
	Yum::t('Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('yum', 'Manage roles'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('yum', 'Create role'), 'url'=>array('create'), 'icon'=>'file black'),
);

?>



<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$dataProvider,
        'type'=>'striped bordered condensed',
	'columns'=>array(
		array(
			'name' => 'title',
			'type' => 'raw',
			'value'=> 'CHtml::link(CHtml::encode($data->title),
				array(Yum::route("role/view"),"id"=>$data->id))',
		),
		//'autoassign',
		'is_membership_possible',
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template' => '{view}{update}{delete}'
                ),
	),
)); ?>
