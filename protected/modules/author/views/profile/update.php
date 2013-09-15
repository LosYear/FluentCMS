<?php
/* @var $this ProfileController */
/* @var $model Profile */

$this->breadcrumbs=array(
	Yii::t('AuthorModule.main','Profile')=>array('edit'),
	$model->name=>array('edit'),
	Yii::t('admin','Update')
);

$this->menu=array(
	array('label'=>'List Profile', 'url'=>array('index')),
	array('label'=>'Create Profile', 'url'=>array('create')),
	array('label'=>'View Profile', 'url'=>array('view', 'id'=>$model->user_id)),
	array('label'=>'Manage Profile', 'url'=>array('admin')),
);
?>
<div id="main">

<?php echo $this->renderPartial('_form', array('model'=>$model, 'new' => $new)); ?></div>