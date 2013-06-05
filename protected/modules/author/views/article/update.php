<script lang="javascript">var mode = 'update';</script>
<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);
$this->menu=array(
            array('label'=>Yii::t('author','Create article'), 'url'=>array('create'), 'icon'=>'file black'),
            array('label'=>Yii::t('author', 'Manage articles'), 'url'=>array('admin'), 'icon'=>'list black',),
);
?>
<div id="main" >
<?php echo $this->renderPartial('_form', array('model'=>$model, 'advModel'=>$advModel)); ?></div>