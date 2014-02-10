<?php
/* @var $this SubscriptionController */

$this->breadcrumbs = array(
    Yii::t('AuthorModule.admin', 'Subscription') => array('#'),
    Yii::t('AuthorModule.admin', 'New'),
);
?>
<div class="page-header">
    <h1><?php echo Yii::t('AuthorModule.admin', 'Subscription') ?>
        <small><?php echo Yii::t('AuthorModule.admin', 'New') ?></small>
    </h1>
</div>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
    ))); ?>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'profile-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')
    )); ?>
    <?php echo $form->errorSummary($model); ?>
    <div class="form-group">
        <?= $form->label($model, 'smtp', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-8">
            <?= $form->textField($model, 'smtp', array('class' => 'name form-control')) ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->label($model, 'port', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-8">
            <?= $form->textField($model, 'port', array('class' => 'name form-control')) ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->label($model, 'login', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-8">
            <?= $form->textField($model, 'login', array('class' => 'name form-control')) ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->label($model, 'password', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-8">
            <?= $form->passwordField($model, 'password', array('class' => 'name form-control')) ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->label($model, 'sender', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-8">
            <?= $form->textField($model, 'sender', array('class' => 'name form-control')) ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->label($model, 'subject', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-8">
            <?= $form->textField($model, 'subject', array('class' => 'name form-control')) ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->label($model, 'text', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-8">
            <?= $form->textArea($model, 'text', array('class' => 'name form-control', 'rows' => '20', 'resize' => 'vertical')) ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-2">
            <button type="submit" class="btn btn-default"><?= Yii::t('admin', 'Submit') ?></button>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>