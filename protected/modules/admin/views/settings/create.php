<?php
	$this->breadcrumbs = array(
		Yii::t('admin','Settings') => array('admin'),
		Yii::t('admin', 'Create'),
	);

	$this->menu=array(
		array('label'=>Yii::t('admin','Manage settings'), 'url'=>array('admin'), 'icon'=>'list black'),
	);
?>

<div class="page-header">
	<h1><?php echo Yii::t('admin', 'Settings') ?>
		<small><?php echo Yii::t('admin', 'Create') ?></small>
	</h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>