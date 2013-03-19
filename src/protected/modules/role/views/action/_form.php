<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'action-form',
	'enableAjaxValidation'=>false,
)); 

?>

	<?php echo $form->errorSummary($model); ?>
	<div class="row-fluid">
		<label><?php echo $form->labelEx($model,'title'); ?></label>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'span9')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row-fluid">
		<label><?php echo $form->labelEx($model,'comment'); ?></label>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50, 'class' => 'span9')); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255, 'class' => 'span9')); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row-fluid buttons">
	<?php $this->widget('bootstrap.widgets.TbButton', 
            array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
