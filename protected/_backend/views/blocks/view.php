<?php
/* @var $this BlockController */
/* @var $model Block */

$this->breadcrumbs=array(
	Yii::t('admin', 'Blocks')=>array('admin'),
	$model->title,
);

$this->menu=array(
        array('label'=>Yii::t('admin', 'Manage news'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('admin', 'Create news'), 'url'=>array('create'), 'icon'=>'file black'),
	array('label'=>Yii::t('admin','Update news'), 'url'=>array('update', 'id'=>$model->id), 'icon'=>'pencil black'),
	array('label'=>Yii::t('admin','Delete news'), 'url'=>'#', 'icon'=>'trash black', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1><?php echo Yii::t('admin', 'View block');?> <?php echo $model->title; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		//'type',
		'title',
		'content',
		//'name',
		//'author',
		//'created',
		//'updated',
		//'updater',
		//'status',
	),
)); ?>

<div class="well">
    <?php echo Yii::t('admin', 'To display this block paste following code to template');?><br>
   <code><?php echo htmlspecialchars("<?php \$this->widget('application.widgets.BlockWidget', array('name' => '{$model->name}')); ?>"); ?></code>
</div>
