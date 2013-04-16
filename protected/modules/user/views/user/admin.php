<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Users') ?> <small><?php echo Yii::t('admin', 'Manage') ?></small></h1>
</div>
<?php

$this->breadcrumbs = array(
	Yum::t('Users') => array('admin'),
	Yum::t('Manage'));

$this->menu=array(
	array('label'=>Yii::t('yum', 'Manage users'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('yum', 'Create user'), 'url'=>array('create'), 'icon'=>'file black'),
);

$this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
)));

$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
        'template'=>"{items}\n{pager}",
	'filter' => $model,
		'columns'=>array(
			array(
				'name'=>'id',
				'filter' => false,
				'type'=>'raw',
				'value'=>'CHtml::link($data->id,
				array("//user/user/update","id"=>$data->id))',
                                'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')
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
                                'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')
			),
			array(
				'name'=>'lastvisit',
				'filter' => false,
				'value'=>'date(UserModule::$dateFormat,$data->lastvisit)',
                                'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')
			),
			array(
				'name'=>'status',
				'filter' => false,
				'value'=>'YumUser::itemAlias("UserStatus",$data->status)',
                                'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')
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

