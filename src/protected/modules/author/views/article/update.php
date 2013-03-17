<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);
$this->renderPartial('application.modules.author.views.sidebar');
$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index')),
	array('label'=>'Create Article', 'url'=>array('create')),
	array('label'=>'View Article', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Article', 'url'=>array('admin')),
);
?>
<div id="main" >
<?php echo $this->renderPartial('_form', array('model'=>$model, 'advModel'=>$advModel)); ?></div>