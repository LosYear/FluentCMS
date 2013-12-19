<?php
$this->breadcrumbs=array(
	Yii::t('admin','Settings') => array('admin'),
	$model->key=> '#',
	Yii::t('admin', 'Update'),
);

	$this->menu = array(
		array('label' => Yii::t('admin', 'Manage settings'), 'url' => array('admin'), 'icon' => 'list black',),
		array('label' => Yii::t('admin', 'Create param'), 'url' => array('create'), 'icon' => 'file black'),
	);
?>

<div class="page-header">
	<h1><?php echo Yii::t('admin', 'Settings') ?>
		<small><?= $model->key ?></small>
	</h1>
</div>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>