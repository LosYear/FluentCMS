<?php
	/* @var $this IssueController */
	/* @var $model Issue */

	$this->breadcrumbs = array(
        Yii::t('AuthorModule.admin', 'Issue') => array('admin'),
		$model->number . "/" . $model->year => '#',
		Yii::t('admin', 'Update'),
	);

	$this->menu = array(
		array('label' => Yii::t('author', 'Create issue'), 'url' => array('create'), 'icon' => 'file black'),
		array('label' => Yii::t('author', 'Manage issues'), 'url' => array('admin'), 'icon' => 'list black'),
	);
?>
	<div class="page-header">
		<h1><?php echo Yii::t('AuthorModule.admin', 'Issue') ?>
			<small><?php echo $model->number . "/" . $model->year; ?></small>
		</h1>
	</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>