<?php
/* @var $this ProfileController */
/* @var $model Profile */

$this->breadcrumbs = array(
    Yii::t('AuthorModule.main', 'Profile') => array('edit'),
    $model->name => array('edit'),
    Yii::t('admin', 'Update')
);
?>
<div class="page-header">
    <h1><?php echo Yii::t('AuthorModule.main', 'Profile') ?> <small><?php echo Yii::t('admin', 'Update') ?></small></h1>
</div>

<div id="main">
    <div class="alert alert-info">
        <?= Yii::t('journal', 'You need to confirm your email before doing anything')?>
    </div>
    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block' => true,
        'fade' => true,
        'closeText' => '&times;',
        'alerts' => array(
            'success' => array('block' => true, 'fade' => true, 'closeText' => '&times;'),
        ))); ?>
    <?php echo $this->renderPartial('_activate_form', array('model' => $model, 'new' => $new)); ?></div>