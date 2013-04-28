<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	Yii::t('admin', 'Pages')=>array('admin'),
        $model->title,
);

$this->menu=array(
        array('label'=>Yii::t('admin', 'Manage pages'), 'url'=>array('admin'), 'icon'=>'list black',),
	array('label'=>Yii::t('admin', 'Create page'), 'url'=>array('create'), 'icon'=>'file black'),
	array('label'=>Yii::t('admin','Update page'), 'url'=>array('update', 'id'=>$model->id), 'icon'=>'pencil black'),
	array('label'=>Yii::t('admin','Delete page'), 'url'=>'#', 'icon'=>'trash black', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1><?php echo $model->title ?></h1>

<div id="content">
    <?php echo $model->content ?>
</div>