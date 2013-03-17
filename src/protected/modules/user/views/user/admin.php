<?php

$this->title = Yum::t('Manage users');

$this->breadcrumbs = array(
	Yum::t('Users') => array('admin'),
	Yum::t('Manage'));

$this->menu=array(
	array('label'=>Yii::t('yum', 'Manage users'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('yum', 'Create user'), 'url'=>array('create'), 'icon'=>'file black'),
);

echo Yum::renderFlash();

$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
	'filter' => $model,
		'columns'=>array(
			array(
				'name'=>'id',
				'filter' => false,
				'type'=>'raw',
				'value'=>'CHtml::link($data->id,
				array("//user/user/update","id"=>$data->id))',
				),
			array(
				'name'=>'username',
				'type'=>'raw',
				'value'=>'CHtml::link(CHtml::encode($data->username),
				array("//user/user/view","id"=>$data->id))',
			),
			array(
				'name'=>'createtime',
				'filter' => false,
				'value'=>'date(UserModule::$dateFormat,$data->createtime)',
			),
			array(
				'name'=>'lastvisit',
				'filter' => false,
				'value'=>'date(UserModule::$dateFormat,$data->lastvisit)',
			),
			array(
				'name'=>'status',
				'filter' => false,
				'value'=>'YumUser::itemAlias("UserStatus",$data->status)',
			),
			array(
				'name'=>Yum::t('Roles'),
				'type' => 'raw',
				'visible' => Yum::hasModule('role'),
				'filter' => false,
				'value'=>'$data->getRoles()',
			),
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
                                'template' => '{update}{delete}'
			),
))); ?>

