<?php
/* @var $this AcademicController */
/* @var $model Academic */

$this->breadcrumbs=array(
	Yii::t('AuthorModule.admin', 'Academics')=>array('admin'),
	Yii::t('AuthorModule.admin', 'Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('AuthorModule.admin', 'Create'), 'url'=>array('create'), 'icon' => 'file'),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('AuthorModule.admin', 'Academics') ?> <small><?php echo Yii::t('AuthorModule.admin', 'Manage') ?></small></h1>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'academic-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name' => 'id', 'header'=>'#', 'htmlOptions'=>array('style'=>'width: 40px')),
		array('name' => 'name', 'header'=>Yii::t('AuthorModule.admin', 'Name')),
		array('name' => 'abbr', 'header'=>Yii::t('AuthorModule.admin', 'Abbreviation')),
		array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 40px'),
                    'template'=>'{update}{delete}',
		),
	),
)); ?>
