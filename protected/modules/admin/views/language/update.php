<?php
	/* @var $this LanguageController */
	/* @var $model Language */

	$this->breadcrumbs = array(
		Yii::t('admin', 'Language') => array('admin'),
		$model->name,
		Yii::t('admin', 'Update'),
	);

	$this->menu = array(
		array('label'=>Yii::t('admin', 'Manage languages'), 'url'=>array('admin'), 'icon'=>'list black',),
		array('label'=>Yii::t('admin', 'Create language'), 'url'=>array('create'), 'icon'=>'file black'),
	);
?>

<div class="page-header">
	<h1><?php echo Yii::t('admin', 'Language') ?>
		<small><?= $model->name ?></small>
	</h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>