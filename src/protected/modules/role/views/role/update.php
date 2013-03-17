<?php
$this->title = Yum::t('Update role');

$this->breadcrumbs=array(
	Yum::t('Roles')=>array('index'),
	Yum::t('Update'));

$this->menu=array(
            array('label'=>Yii::t('yum','Create role'), 'url'=>array('create'), 'icon'=>'file black'),
            array('label'=>Yii::t('yum', 'Manage roles'), 'url'=>array('admin'), 'icon'=>'list black',),
);

?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
