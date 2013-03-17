<?php
/* @var $this ProfileController */
/* @var $model Profile */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
        <fieldset class="edit-form well">
            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'name'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'name', array('class'=>'span6')); ?></div>
                </div>
            </div>
            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'academic'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'academic', array('class'=>'span6')); ?></div>
                </div>
            </div>
            
            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'email'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'email', array('class'=>'span6')); ?></div>
                </div>
            </div>
            

            <div class="row"><div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
            array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div></div>
        </fieldset>
<?php $this->endWidget(); ?>

</div><!-- form -->