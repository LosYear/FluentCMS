<?php
/* @var $this VariantsController */
/* @var $model PollVariant */
/* @var $form CActiveForm */

    $cs=Yii::app()->getClientScript();
    $cs->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'poll-variant-form',
	'enableAjaxValidation'=>false,
)); ?>

        <div class="row-fluid">
            <div>
                <div class="column span-4"><?php echo $form->labelEx($model,'text'); ?>
                <?php echo $form->textArea($model, 'text', array('class'=>'span7',
                            'data-title'=>Yii::t('admin', 'Content'), 
                            'data-content'=>Yii::t('PollModule.popover', 'Enter the text of item. Don\'t write too much'),
                            'rel'=>'popover')); ?></div>
            </div>
        </div>

        <div class="row-fluid">
            <div>
                <div class="column span-4"><?php echo $form->labelEx($model,'order'); ?>
                <?php echo $form->textField($model, 'order', array('class'=>'span7',
                            'data-title'=>Yii::t('admin', 'Order'), 
                            'data-content'=>Yii::t('PollModule.popover', 'Enter the order of element. Elements with lower value will be shown first'),
                            'rel'=>'popover')); ?></div>
            </div>
        </div>

        <div class="row-fluid"><div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
            array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div></div>

<?php $this->endWidget(); ?>

</div><!-- form -->