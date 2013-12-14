<?php
/* @var $this BranchController */
/* @var $model Branch */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id' => 'branch-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array('class' => 'form-horizontal')
	)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?= $form->label($model, 'name', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?= $form->textField($model, 'name', array('class' => 'form-control')) ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-2">
			<button type="submit" class="btn btn-default"><?= Yii::t('admin', 'Submit') ?></button>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->