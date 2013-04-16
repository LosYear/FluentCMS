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
<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Actions') ?> <small><?php echo Yii::t('admin', 'Manage') ?></small></h1>
</div>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ))); ?>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'action-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'type'=>'striped bordered condensed',  
        'template'=>"{items}\n{pager}",
	'columns'=>array(
		'title',
		array('name' => 'comment',
                    'htmlOptions' => array('class' => 'hidden-phone'), 'headerHtmlOptions'=>array('class' => 'hidden-phone'), 'filterHtmlOptions' => array('class' => 'hidden-phone')),
		'subject',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template' => '{update}{delete}',
		),
	),
)); ?>
