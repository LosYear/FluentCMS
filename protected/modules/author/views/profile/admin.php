<?php
/* @var $this ProfileController */
/* @var $model Profile */

$this->breadcrumbs=array(
	Yii::t('AuthorModule.admin', 'Authors')=>array('admin'),
	Yii::t('AuthorModule.admin', 'Manage'),
);

$this->menu=array(
	/*array('label'=>'List Profile', 'url'=>array('index')),
	array('label'=>'Create Profile', 'url'=>array('create')),*/
	array('label'=>strtoupper(Yii::t('AuthorModule.admin', 'Advanced'))),
	array('label'=>Yii::t('AuthorModule.admin', 'Academics'), 'url' =>Yii::app()->createUrl('author/academic/admin'), 'icon'=>'book'),
	array('label'=>Yii::t('AuthorModule.admin', 'Branches'), 'url' =>Yii::app()->createUrl('author/branch/admin'), 'icon'=>'road'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('profile-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="page-header">
  <h1><?php echo Yii::t('AuthorModule.admin', 'Authors') ?> <small><?php echo Yii::t('AuthorModule.admin', 'Manage') ?></small></h1>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'profile-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'user_id',
			'header' => Yii::t('admin', 'User'),
			'value' => '($data->user_id == -1) ? Yii::t("AuthorModule.admin", "Not registered") : YumUser::model()->findByPk($data->user_id)->username'
		),
		'name',
		array(
			'name' => 'email',
			'header' => Yii::t('admin', 'Email'),
			'value' => '($data->email == -1) ? Yii::t("AuthorModule.admin", "Not registered") : $data->email'
		),
		array(
			'name' => 'academic',
			'header' => Yii::t('AuthorModule.admin', 'Academic'),
			'value' => '($data->academic == -1) ? Yii::t("AuthorModule.admin", "Not registered") : Academic::model()->findByPk($data->academic)->abbr'
		),
		array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 40px'),
                    'template'=>'{update}{delete}',
		),
	),
)); ?>
