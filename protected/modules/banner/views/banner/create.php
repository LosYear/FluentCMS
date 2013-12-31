<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs = array(
    Yii::t('BannerModule.admin', 'Banners') => array('admin'),
    Yii::t('admin', 'Create'),
);

$this->menu = array(
    array('label' => Yii::t('BannerModule.admin', 'Manage banners'), 'url' => array('admin'), 'icon' => 'list black',),
);
?>

    <div class="page-header">
        <h1><?php echo Yii::t('BannerModule.admin', 'Banners') ?>
            <small><?php echo Yii::t('admin', 'Create') ?></small>
        </h1>
    </div>

<?php $this->renderPartial('_form', array('model' => $model)); ?>