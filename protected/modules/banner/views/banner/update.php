<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs = array(
    Yii::t('BannerModule.admin', 'Banners')=>array('admin'),
    $model->name => '#',
    Yii::t('admin', 'Update'),
);

$this->menu=array(
    array('label'=>Yii::t('BannerModule.admin', 'Manage banners'), 'url'=>array('admin'), 'icon'=>'list black',),
    array('label'=>Yii::t('BannerModule.admin', 'Create banner'), 'url'=>array('create'), 'icon'=>'file black'),
);

?>

    <div class="page-header">
        <h1><?php echo Yii::t('BannerModule.admin', 'Banners') ?> <small><?= $model->name ?></small></h1>
    </div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>