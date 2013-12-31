<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>
<?php
$assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.admin.assets'));
Yii::app()->clientScript->registerScriptFile($assetsUrl . '/js/form.js', CClientScript::POS_HEAD);
?>
<div class="form">
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'news-form',
        'htmlOptions' => array('class' => 'form-horizontal')
    )); ?>
    <?php echo $form->errorSummary($model); ?>
    <div class="form-group">
        <?= $form->label($model, 'url', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-8">
            <?=
            $form->textField($model, 'url', array('class' => 'form-control', 'data-title' => Yii::t('admin', 'URL'),
                'data-content' => Yii::t('popover', 'Custom URL for node. Node can be displayed at current URL.'),
                'rel' => 'popover', 'readonly' => $translation)) ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->label($model, 'title', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-8">
            <?=
            $form->textField($model, 'title', array('class' => 'form-control',
                'data-title' => Yii::t('admin', 'Title'),
                'data-content' => Yii::t('popover', 'Title displayed to user'),
                'rel' => 'popover')) ?>
        </div>
    </div>

    <div class="form-group">
        <?= $form->label($model, 'content', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-8">
            <?php $this->widget('ext.editMe.widgets.ExtEditMe', array(
                'model' => $model,
                'attribute' => 'content',
            )); ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->label($model, 'status', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-4">
            <?php echo $form->dropDownList($model, 'status',
                array('0' => Yii::t('admin', 'Draft'),
                    '1' => Yii::t('admin', 'Published')), array('class' => 'form-control',
                    'data-title' => Yii::t('admin', 'Status'),
                    'data-content' => Yii::t('popover', 'Visibility for node. Draft is not displayed to user.'),
                    'rel' => 'popover'));?>
        </div>
    </div>

    <?php if (Yii::app()->user->isAdmin() && ($model->isNewRecord || $model->status != 1)): ?>
        <div class="form-group" id="social-export" style="display:none">
            <label
                class="col-lg-2 control-label"><?= Yii::t('admin', 'Export to social networks') ?></label>

            <div class="col-lg-4">
                <?= $form->checkBox($model, 'exportVK', array('class' => '')) ?>
                <?= $form->label($model, 'exportVK', array('class' => '')) ?><br/>

                <?= $form->checkBox($model, 'exportTwitter', array('class' => '')) ?>
                <?= $form->label($model, 'exportTwitter', array('class' => '')) ?><br/>

                <?= $form->checkBox($model, 'exportFacebook', array('class' => '')); ?>
                <?= $form->label($model, 'exportFacebook', array('class' => '')) ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-2">
            <button type="submit" class="btn btn-default"><?= Yii::t('admin', 'Submit') ?></button>
        </div>
    </div>
    <?php $this->endWidget(); ?>
    <script lang="JavaScript">
        $('#News_status').change(function(){if($('#News_status').val() == 0){$('#social-export').hide()}else{$('#social-export').show()} })
    </script>
</div>