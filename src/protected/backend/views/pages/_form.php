<?php
	/* @var $this PageController */
	/* @var $model Page */
	/* @var $form CActiveForm */
	?>
<?php 
	$cs=Yii::app()->getClientScript();
	$cs->registerScriptFile(Yii::app()->baseUrl.'/js/ckeditor/ckeditor.js');
	?>
<div class="form">
	<?php /** @var BootActiveForm $form */
		$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		    'id'=>'page-form',
		)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'url'); ?></div>
			<div class="column span-12"><?php echo $form->textField($model, 'url', array('class'=>'span12')); ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'title'); ?></div>
			<div class="column span-12"><?php echo $form->textField($model, 'title', array('class'=>'span12')); ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'content'); ?></div>
			<div class="column span-12"><?php echo $form->textArea($model, 'content', array('class' => 'ckeditor span-12' )); ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'status'); ?></div>
			<div class="column span-12"><?php echo $form->dropDownList($model, 'status', 
				array('0' => Yii::t('admin', 'Draft'), 
				    '1'=> Yii::t('admin', 'Published')), array('class'=>'span2')) /*textField($model, 'status', array('class'=>'span12'))*/; ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
			array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div>
	</div>
	<?php $this->endWidget(); ?>     
</div>