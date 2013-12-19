<div class="form">
	<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id' => 'setting-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array('class' => 'form-horizontal')
	)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?= $form->label($model, 'key', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?=
				$form->textField($model, 'key', array('class' => 'form-control')) ?>
		</div>
	</div>

	<div class="form-group">
		<?= $form->label($model, 'value', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?=
				$form->textField($model, 'value', array('class' => 'form-control')) ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-2">
			<button type="submit" class="btn btn-default"><?= Yii::t('admin', 'Submit') ?></button>
		</div>
	</div>

	<?php $this->endWidget(); ?>
</div>