<div class="page-header">
  <h1><?php echo Yii::t('admin', 'User') ?> <small><?php echo Yii::t('admin', 'Create') ?></small></h1>
</div>
<?php

$this->menu=array(
	array('label'=>Yii::t('yum', 'Manage users'), 'url'=>array('admin'), 'icon'=>'list black',),
);

$this->breadcrumbs = array(
		Yum::t('Users') => array('admin'),
		Yum::t('Create'));

echo $this->renderPartial('_form', array(
			'model'=>$model,
			'passwordform'=>$passwordform,
			'profile'=>isset($profile) ? $profile : null)); ?>
