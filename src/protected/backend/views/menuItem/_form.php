<?php
/* @var $this MenuItemController */
/* @var $model MenuItem */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'menu-item-form',
	'enableAjaxValidation'=>false,
)); ?>
    <fieldset class="edit-form">

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
            <div>
		<div class="column span-4"><?php echo $form->labelEx($model,'parent_id'); ?></div>
                <div class="column span-12"><?php echo $form->dropDownList($model,'parent_id', $model->itemsCombo()); ?></div>
            </div>
	</div>

	<div class="row">
            <div>
		<div class="column span-4"><?php echo $form->labelEx($model,'title'); ?></div>
                <div class="column span-12"><?php echo $form->textField($model,'title'); ?></div>
            </div>
	</div>
        
	<div class="row">
            <div>
		<div class="column span-4"><?php echo $form->labelEx($model,'type'); ?></div>
                <div class="column span-12"><?php echo $form->dropDownList($model,'type', array(
                    'internal' => Yii::t('admin', 'Internal link'))); ?></div>
            </div>
	</div>
        
	<div class="row">
            <div>
		<div class="column span-4"><?php echo $form->labelEx($model,'href'); ?></div>
                <div class="column span-12"><?php echo $form->textField($model,'href'); ?></div>
            </div>
	</div>



	<!--<div class="row">
            <div>
		<div class="column span-4"><?php echo $form->labelEx($model,'condition_name'); ?></div>
                <div class="column span-12"><?php echo $form->textField($model,'condition_name'); ?></div>
            </div>
	</div>

	<div class="row">
            <div>
		<div class="column span-4"><?php echo $form->labelEx($model,'condition_denial'); ?></div>
                <div class="column span-12"><?php echo $form->textField($model,'condition_denial'); ?></div>
            </div>
	</div>-->

	<div class="row">
            <div>
		<div class="column span-4"><?php echo $form->labelEx($model,'order'); ?></div>
                <div class="column span-12"><?php echo $form->textField($model,'order'); ?></div>
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

	<div class="row"><div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
            array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div></div>
    </fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->

