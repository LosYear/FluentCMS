<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Roles') ?> <small><?php echo Yii::t('admin', 'Manage') ?></small></h1>
</div>
<?php
$this->breadcrumbs=array(
	Yum::t('Roles')=>array('admin'),
	Yum::t('Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('yum', 'Manage roles'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('yum', 'Create role'), 'url'=>array('create'), 'icon'=>'file black'),
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
