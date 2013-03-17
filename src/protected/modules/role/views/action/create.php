<?php
$this->breadcrumbs=array(
	Yum::t('Actions')=>array('admin'),
	Yum::t('Create'),
);

$this->menu=array(
	array('label'=>Yii::t('yum', 'Manage actions'), 'url'=>array('admin'), 'icon'=>'list black',),
);
?>

<h1> <?php echo Yum::t('Create Action'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
