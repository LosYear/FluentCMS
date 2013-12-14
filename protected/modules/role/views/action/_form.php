<?php
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/form.js');
?>
<div class="form">

	<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id' => 'action-form',
		'htmlOptions' => array('class' => 'form-horizontal'),
		'enableAjaxValidation' => false,
	));

	?>

	<?php echo $form->errorSummary($model); ?>
	<div class="form-group">
		<?= $form->label($model, 'title', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control',
				'data-title' => Yii::t('admin', 'Name'),
				'data-content' => Yii::t('popover', 'System identificator of action. Should be unique'),
				'rel' => 'popover')); ?>
		</div>
	</div>

	<div class="form-group">
		<?= $form->label($model, 'comment', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?php echo $form->textArea($model, 'comment', array('rows' => 6, 'cols' => 50, 'class' => 'span9',
				'data-title' => Yii::t('admin', 'Comment'),
				'data-content' => Yii::t('popover', 'Comment for created action. You can write some notes here'),
				'rel' => 'popover')); ?>
		</div>
	</div>

	<div class="form-group">
		<?= $form->label($model, 'subject', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control',
				'data-title' => Yii::t('admin', 'Subject'),
				'data-content' => Yii::t('popover', 'Subject which action belongs'),
				'rel' => 'popover')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-2">
			<button type="submit" class="btn btn-default"><?= Yii::t('admin', 'Submit') ?></button>
		</div>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->
