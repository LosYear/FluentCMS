<script lang="javascript">var mode = 'create';</script>
<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	Yii::t('AuthorModule.admin', 'Articles')=>array('admin'),
	Yii::t('AuthorModule.admin', 'Create'),
);

$this->menu=array(
	array('label'=>Yii::t('AuthorModule.admin', 'Manage articles'), 'url'=>array('admin'), 'icon'=>'list black',),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('AuthorModule.admin', 'Articles') ?> <small><?php echo Yii::t('AuthorModule.admin', 'Create') ?></small></h1>
</div>

<div id="main" >

<?php echo $this->renderPartial('_form', array('model'=>$model, 'advModel'=>$advModel)); ?></div>