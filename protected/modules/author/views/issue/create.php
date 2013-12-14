<?php
	/* @var $this IssueController */
	/* @var $model Issue */

	$this->breadcrumbs = array(
		'Issues' => array('index'),
		'Create',
	);

	$this->menu = array(
		array('label' => Yii::t('author', 'Manage issues'), 'url' => array('admin'), 'icon' => 'list black'),
	);
?>

	<div class="page-header">
		<h1><?php echo Yii::t('AuthorModule.admin', 'Issue') ?>
			<small><?php echo Yii::t('AuthorModule.admin', 'Create') ?></small>
		</h1>
	</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>