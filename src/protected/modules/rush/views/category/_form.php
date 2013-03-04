<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="form">
    <fieldset class="edit-form">

        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'category-form',
                'enableAjaxValidation'=>false,
        )); ?>

                <?php echo $form->errorSummary($model); ?>

            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'name'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'name', array('class'=>'span12')); ?></div>
                </div>
            </div>

                <div class="row"><div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
            array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div></div>

        <?php $this->endWidget(); ?>
    </fieldset>

</div><!-- form -->