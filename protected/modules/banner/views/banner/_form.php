<?php
/* @var $this BannerController */
/* @var $model Banner */
/* @var $form CActiveForm */
?>

<div class="form">


    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'banner-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
    )); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?= $form->label($model, 'name', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-8">
            <?= $form->textField($model, 'name', array('class' => 'form-control')) ?>
        </div>
    </div>

    <div class="form-group">
        <?= $form->label($model, 'title', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-8">
            <?= $form->textField($model, 'title', array('class' => 'form-control')) ?>
        </div>
    </div>

    <div class="form-group">
        <?= $form->label($model, 'type', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-2">
            <?= $form->dropDownList($model, 'type', array('image' => Yii::t('BannerModule.admin', 'Image')), array('class' => 'form-control')) ?>
        </div>
    </div>

    <div class="form-group">
        <?= $form->label($model, 'file', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-2">
            <?= $form->fileField($model, 'file', array('image' => Yii::t('BannerModule.admin', 'Image')), array('class' => 'form-control')) ?>
        </div>
    </div>

    <div class="form-group">
        <?= $form->label($model, 'href', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-8">
            <?= $form->textField($model, 'href', array('class' => 'form-control')) ?>
        </div>
    </div>

    <div class="form-group">
        <?= $form->label($model, 'new_window', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-1">
            <?= $form->checkBox($model, 'new_window', array('class' => 'form-control')) ?>
        </div>
    </div>

    <div class="form-group">
        <?= $form->label($model, 'status', array('class' => 'col-lg-2 control-label')) ?>
        <div class="col-lg-4">
            <?php echo $form->dropDownList($model, 'status',
                array('0' => Yii::t('admin', 'Draft'),
                    '1' => Yii::t('admin', 'Published')), array('class' => 'form-control'));?>
        </div>
    </div>

    <?php if (!$model->isNewRecord): ?>
        <div class="form-group">
            <?= $form->label($model, 'views', array('class' => 'col-lg-2 control-label')) ?>
            <div class="col-lg-8">
                <span class="label label-success" id="views"><?= $model->views ?></span>
            </div>
        </div>

        <div class="form-group">
            <?= $form->label($model, 'clicks', array('class' => 'col-lg-2 control-label')) ?>
            <div class="col-lg-8">
                <span class="label label-success" id="clicks"><?= $model->clicks ?></span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-2">
                <button type="button" class="btn btn-danger"
                        id="clean-statistics"><?= Yii::t('BannerModule.admin', 'Clean statistics') ?></button>
            </div>
        </div>

        <script lang="javascript">
            $('#clean-statistics').click(function () {
                $.ajax({
                    url: "<?= Yii::app()->createUrl('banner/banner/cleanStatistics', array('id'=>$model->id)) ?>"
                }).success(function () {
                        $('#views').html('0');
                        $('#clicks').html('0');
                    });
            });
        </script>
    <?php endif; ?>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-2">
            <button type="submit" class="btn btn-default"><?= Yii::t('admin', 'Submit') ?></button>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->