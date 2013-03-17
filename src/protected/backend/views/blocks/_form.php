<?php
/* @var $this BlockController */
/* @var $model Block */
/* @var $form CActiveForm */
?>
<?php 
    $cs=Yii::app()->getClientScript();
    $cs->registerScriptFile(Yii::app()->baseUrl.'/js/ckeditor/ckeditor.js');
?>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'block-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
        <fieldset class="edit-form">
            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'title'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'title', array('class'=>'span12')); ?></div>
                </div>
            </div>
            
            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'name'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'name', array('class'=>'span12')); ?></div>
                </div>
            </div>
            
            <div class="row">
                <div>
                   <div class="column span-4"><?php echo $form->labelEx($model,'content'); ?></div>
                   <div class="column span-12"><?php echo $form->textArea($model, 'content', array('class' => 'ckeditor span-12' )); ?></div>
                </div>
            </div>
            
            <div class="row">
                <div>
                   <div class="column span-4"><?php echo $form->labelEx($model,'status'); ?></div>
                   <div class="column span-12"><?php echo $form->dropDownList($model, 'status', 
                           array('0' => Yii::t('admin', 'Draft'), 
                               '1'=> Yii::t('admin', 'Published')), array('class'=>'span2')) /*textField($model, 'status', array('class'=>'span12'))*/; ?></div>
                </div>
            </div>
            
            <div class="row">
                <div>
                   <div class="column span-4"><?php echo $form->labelEx($model,'type'); ?></div>
                   <div class="column span-12"><?php echo $form->dropDownList($model, 'type', 
                           array('html' => Yii::t('admin', 'Html')), array('class'=>'span2')); ?></div>
                </div>
            </div>

            <div class="row"><div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
            array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div></div>
        </fieldset>
<?php $this->endWidget(); ?>

</div><!-- form -->