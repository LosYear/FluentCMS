<?php
	/* @var $this MenuController */
	/* @var $model Menu */
	/* @var $form CActiveForm */
	?>
<?php 
	$cs=Yii::app()->getClientScript();
        $cs->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');
?>
<div class="form">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'menu-form',
		'enableAjaxValidation'=>false,
		)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'title'); ?></div>
			<div class="column span-12"><?php echo $form->textField($model, 'title', array('class'=>'span9',
                            'data-title'=>Yii::t('admin', 'Title'), 
                            'data-content'=>Yii::t('popover', 'Menu title. Can be displayed to user.'),
                            'rel'=>'popover')); ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'name'); ?></div>
			<div class="column span-12"><?php echo $form->textField($model, 'name', array('class'=>'span9',
                            'data-title'=>Yii::t('admin', 'Name'), 
                            'data-content'=>Yii::t('popover', 'System name of menu. Must be unique. Will be used for displaying menu.'),
                            'rel'=>'popover')); ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'description'); ?></div>
			<div class="column span-12"><?php echo $form->textArea($model, 'description', array('class'=>'span9',
                            'data-title'=>Yii::t('admin', 'Description'), 
                            'data-content'=>Yii::t('popover', 'Admin\'s comment'),
                            'rel'=>'popover')); ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'status'); ?></div>
			<div class="column span-12"><?php echo $form->dropDownList($model, 'status', 
				array('0' => Yii::t('admin', 'Draft'), 
				    '1'=> Yii::t('admin', 'Published')), array('class'=>'span2',
                            'data-title'=>Yii::t('admin', 'Status'), 
                            'data-content'=>Yii::t('popover', 'Visibility for node. Draft is not displayed to user.'),
                            'rel'=>'popover')) /*textField($model, 'status', array('class'=>'span12'))*/; ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
			array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div>
	</div>
	<?php $this->endWidget(); ?>
</div>
<!-- form -->
