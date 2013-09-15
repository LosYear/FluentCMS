<?php
	/* @var $this PageController */
	/* @var $model Page */

	$this->breadcrumbs = array(
		$model->title,
	);
	$this->pageTitle = $model->title . ' | ' . Yii::app()->name;
	$this->menu = array(
		array('label' => 'List Page', 'url' => array('index')),
		array('label' => 'Create Page', 'url' => array('create')),
		array('label' => 'Update Page', 'url' => array('update', 'id' => $model->id)),
		array('label' => 'Delete Page', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
		array('label' => 'Manage Page', 'url' => array('admin')),
	);
?>

<h1><?php echo $model->title ?></h1>

<div id="content">
	<?php echo $model->content ?>
</div>