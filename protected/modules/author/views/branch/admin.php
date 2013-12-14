<?php
/* @var $this BranchController */
/* @var $model Branch */

$this->breadcrumbs=array(
	Yii::t('AuthorModule.admin', 'Branches')=>array('admin'),
	Yii::t('AuthorModule.admin', 'Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('AuthorModule.admin', 'Create'), 'url'=>array('create'), 'icon' => 'file'),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('AuthorModule.admin', 'Branches') ?> <small><?php echo Yii::t('AuthorModule.admin', 'Manage') ?></small></h1>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'branch-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
	'filter'=>$model,
	'columns'=>array(
		'name',
		array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 40px'),
                    'template'=>'{update}{delete}',
		),
	),
)); ?>
