<?php
$this->breadcrumbs=array(
	Yum::t('Actions')=>array('admin'),
	Yum::t('Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('yum', 'Manage actions'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('yum', 'Create action'), 'url'=>array('create'), 'icon'=>'file black'),
);

?>
<h1> <?php echo Yum::t('Manage Actions'); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'action-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'type'=>'striped bordered condensed',  
	'columns'=>array(
		'title',
		'comment',
		'subject',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template' => '{update}{delete}',
		),
	),
)); ?>
