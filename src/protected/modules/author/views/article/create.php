<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	'Create',
);
$this->renderPartial('application.modules.author.views.sidebar');
$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index')),
	array('label'=>'Manage Article', 'url'=>array('admin')),
);
?>
<div id="main" >

<?php echo $this->renderPartial('_form', array('model'=>$model, 'advModel'=>$advModel)); ?></div>