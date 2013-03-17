<?php
$this->breadcrumbs=array(
	'Actions'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
            array('label'=>Yii::t('yum','Create action'), 'url'=>array('create'), 'icon'=>'file black'),
            array('label'=>Yii::t('yum', 'Manage actions'), 'url'=>array('admin'), 'icon'=>'list black',),
);
?>

<h1>Update Action <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>