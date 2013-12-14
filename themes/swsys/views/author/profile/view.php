<?php
	/* @var $this ProfileController */
	/* @var $model Profile */

	$this->breadcrumbs = array(
		'Profiles' => array('index'),
		$model->name,
	);

	$this->menu = array(
		array('label' => 'List Profile', 'url' => array('index')),
		array('label' => 'Create Profile', 'url' => array('create')),
		array('label' => 'Update Profile', 'url' => array('update', 'id' => $model->user_id)),
		array('label' => 'Delete Profile', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->user_id), 'confirm' => 'Are you sure you want to delete this item?')),
		array('label' => 'Manage Profile', 'url' => array('admin')),
	);
	$this->pageTitle = $model->name . ' | ' . Yii::app()->name;
?>
<div style="margin:40px" class="author-profile">
	<div class="page-header">
		<h1><?php echo $model->name ?>
			<small>&nbsp;<?php if ($model->academic != -1) echo Academic::model()->findByPk($model->academic)->name ?>&nbsp;
			</small>
		</h1>
	</div>
	<?php if($model->job != -1):?>
	<p>Место работы: <strong><?= $model->job;?></strong></p>
	<?php endif;?>
	<?php if($model->branch != -1):?>
	<p>Направление: <strong><?= Branch::model()->findByPk($model->branch)->name?></strong></p>
	<?php endif;?>
	
	<h2><?php echo Yii::t('AuthorModule.main', 'Publications'); ?></h2>
	<table class="table table-stripped">
		<?php foreach ($main_publications as $el): ?>
			<tr>
				<td>
					<a href="<?php echo Yii::app()->createUrl($el->url); ?>"><?php echo $el->title ?> </a>
				</td>
			</tr>
		<?php endforeach; ?>
		<?php foreach ($publications as $el): ?>
			<tr>
				<td>
					<a href="<?php echo Yii::app()->createUrl($el->article->article->url); ?>"><?php echo $el->article->article->title ?> </a>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
