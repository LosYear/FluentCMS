<?php
/* @var $this ProfileController */
/* @var $model Profile */

$this->breadcrumbs=array(
	'Profiles'=>array('index'),
	$model->name=>array('view','id'=>$model->user_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Profile', 'url'=>array('index')),
	array('label'=>'Create Profile', 'url'=>array('create')),
	array('label'=>'View Profile', 'url'=>array('view', 'id'=>$model->user_id)),
	array('label'=>'Manage Profile', 'url'=>array('admin')),
);
$this->renderPartial('application.modules.author.views.sidebar', array('menu'=>$this->menu));
?>
<div id="main">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>