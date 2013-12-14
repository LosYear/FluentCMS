<?php
	/* @var $this ProfileController */
	/* @var $model Profile */

	$this->breadcrumbs = array(
		Yii::t('AuthorModule.main', 'Profile') => array('edit'),
		$model->name => array('edit'),
		Yii::t('admin', 'Update')
	);
?>
<div class="page-header">
	<h1><?php echo Yii::t('AuthorModule.main', 'Profile') ?> <small><?php echo Yii::t('admin', 'Update') ?></small></h1>
</div>

<div id="main">

	<?php echo $this->renderPartial('_form', array('model' => $model, 'new' => $new)); ?></div>