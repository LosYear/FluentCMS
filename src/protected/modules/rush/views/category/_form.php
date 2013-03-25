<?php 
	$cs=Yii::app()->getClientScript();
        $cs->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');
?>
<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'category-form',
            'enableAjaxValidation'=>false,
    )); ?>

            <?php echo $form->errorSummary($model); ?>

        <div class="row-fluid">
            <div>
                <div class="column span-4"><?php echo $form->labelEx($model,'name'); ?></div>
                <div class="column span-12"><?php echo $form->textField($model, 'name', array('class'=>'span9',
                            'data-title'=>Yii::t('admin', 'Name'), 
                            'data-content'=>Yii::t('RushModule.popover', 'Title of category. Shown to user'),
                            'rel'=>'popover')); ?></div>
            </div>
        </div>

            <div class="row-fluid"><div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
        array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div></div>

    <?php $this->endWidget(); ?>

</div><!-- form -->