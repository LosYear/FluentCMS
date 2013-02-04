<?php
$this->breadcrumbs=array(
		Yum::t('Permissions')=>array('admin'),
		Yum::t('Manage'),
		);

$this->menu=array(
	array('label'=>Yii::t('yum', 'Manage permissions'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('yum', 'Grant permission'), 'url'=>array('create'), 'icon'=>'file black'),
);

?>

<h1> <?php echo Yum::t('Manage permissions'); ?> </h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
			'id'=>'action-grid',
			'dataProvider'=>$model->search(),
                        'type'=>'striped bordered condensed',   
			'filter'=>$model,
			'columns' => array(
				array(
					'name' => 'type',
					'value' => '$data->type',
					'filter' => array(
						'type' => Yum::t('User'),
						'role' => Yum::t('Role'),
						)
					),
				array(
					'filter' => false,
					'name' => 'principal',
					'value' => '$data->type == "user" ? $data->principal->username : @$data->principal_role->title'
					), 
				'Action.title',
				'Action.comment',
			array(
					'class'=>'bootstrap.widgets.TbButtonColumn',
					'template' => '{delete}',
					),
				),

			)
		); ?>
