<?php
$this->pageTitle = Yum::t('Password recovery');

$this->breadcrumbs = array(
    Yum::t('Login') => Yum::module()->loginUrl,
    Yum::t('Restore'));

?>
<?php if (Yum::hasFlash()) {
    echo '<div class="success">';
    echo Yum::getFlash();
    echo '</div>';
} else {
    ?>
    <div class="form login-form">
        <?php $this->widget('bootstrap.widgets.TbAlert', array(
            'block' => true, // display a larger alert block?
            'fade' => true, // use transitions?
            'closeText' => '&times;', // close link text - if set to false, no close link is displayed
            'alerts' => array( // configurations per alert type
                'warning' => array('block' => true, 'fade' => true, 'closeText' => '&times;'), // success, info, warning, error or danger
            ))); ?>
        <h1 class="title title_article"><?= Yum::t('Password recovery') ?></h1><br/>
        <?php echo CHtml::beginForm(Yii::app()->createUrl('registration/registration/recovery'), 'POST', array('class' => 'form-horizontal')); ?>
        <?php echo CHtml::errorSummary($form); ?>

        <div class="form-group">
            <?= CHtml::activeLabel($form, 'login_or_email', array('class' => 'col-lg-3 control-label')) ?>
            <div class="col-lg-4">
                <?= CHtml::activeTextField($form, 'login_or_email', array('class' => 'form-control')) ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-2">
                <button type="submit" class="btn btn-default" id="btnSubmit"><?= Yii::t('yum', 'Restore') ?></button>
            </div>
        </div>
        <style>
            * {
                box-sizing: border-box !important;
            }
        </style>

        <?php echo CHtml::endForm(); ?>
    </div>
<?php } ?>
