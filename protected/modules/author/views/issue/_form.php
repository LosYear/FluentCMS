<?php
	/* @var $this IssueController */
	/* @var $model Issue */
	/* @var $form CActiveForm */

	$assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.author.assets'));

	Yii::app()->clientScript->registerCssFile($assetsUrl . '/jquery-ui/jquery-ui-1.10.0.custom.css');

	Yii::app()->clientScript->registerScriptFile($assetsUrl . '/jquery-ui/jquery-ui-1.10.1.custom.min.js', CClientScript::POS_HEAD);

	Yii::app()->clientScript->registerCssFile($assetsUrl . '/jquery-ui-timepicker-addon.css');

	Yii::app()->clientScript->registerScriptFile($assetsUrl . '/jquery-ui-timepicker-addon.js', CClientScript::POS_HEAD);

	Yii::app()->clientScript->registerScriptFile($assetsUrl . '/localization/ru.js', CClientScript::POS_HEAD); ?>
<div class="form">

	<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id' => 'issue-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array('class' => 'form-horizontal')
	)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="form-group">
		<?= $form->label($model, 'number', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?php echo $form->textField($model, 'number', array('class' => 'form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<?= $form->label($model, 'year', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?php echo $form->textField($model, 'year', array('class' => 'form-control picker')); ?>
		</div>
	</div>

	<div class="form-group">
		<?= $form->label($model, 'cover', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?php echo $form->textField($model, 'cover', array('class' => 'form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<?= $form->label($model, 'isOpened', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?php echo $form->dropDownList($model, 'isOpened',
				array('1' => Yii::t('author', 'Opened'),
					'0' => Yii::t('author', 'Closed')), array('class' => 'form-control'))
			; ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-2">
			<button type="submit" class="btn btn-default"><?= Yii::t('admin', 'Submit') ?></button>
		</div>
	</div>

	<?php $this->endWidget(); ?>

	<script lang="javascript">
		$('.picker').datepicker({
			dateFormat: "yy-mm-dd"
		});
	</script>

</div><!-- form -->