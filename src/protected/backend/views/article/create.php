<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t('admin', 'Manage articles'), 'url'=>array('admin'), 'icon'=>'list black',),
);
?>
<div id="main" >

<?php echo $this->renderPartial('_form', array('model'=>$model, 'advModel'=>$advModel)); ?></div>