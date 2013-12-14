<?php
/* @var $this LanguageController */
/* @var $model Language */

$this->breadcrumbs=array(
	Yii::t('admin', 'Language')=>array('admin'),
	Yii::t('admin', 'Create'),
);

$this->menu=array(
	array('label'=>Yii::t('admin','Manage languages'), 'url'=>array('admin'), 'icon'=>'list black'),
);
?>

	<div class="page-header">
		<h1><?php echo Yii::t('admin', 'Language') ?> <small><?php echo Yii::t('admin', 'Create') ?></small></h1>
	</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>