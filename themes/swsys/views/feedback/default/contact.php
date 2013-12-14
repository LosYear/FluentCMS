<?php $this->pageTitle = Yii::t('FeedbackModule.flash', 'Feedback') . ' | ' . Yii::app()->name; ?>
<div id="content" class="form login-form">
	<h1 class="title title_article" style="color:#fca100;"><?= Yii::t('FeedbackModule.flash', 'Feedback'); ?></h1><br/>
	<?php if (Yii::app()->user->hasFlash('contact')): ?>

		<div class="flash-success">
			<?php echo Yii::app()->user->getFlash('contact'); ?>
		</div>

	<?php elseif (Yii::app()->user->hasFlash('error')): ?>

		<div class="flash-error">
			<?php echo Yii::app()->user->getFlash('error'); ?>
		</div>

	<?php else: ?>

		<div class="form">
			<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
				'id' => 'block-form',
				'enableAjaxValidation' => false,
				'htmlOptions' => array('class' => 'form-horizontal')
			)); ?>
			<?php echo $form->errorSummary($model); ?>
			<div class="form-group">
				<?= $form->label($model, 'name', array('class' => 'col-lg-1 control-label')) ?>
				<div class="col-lg-5">
					<?= $form->textField($model, 'name', array('class' => 'form-control')) ?>
				</div>
			</div>
			<div class="form-group">
				<?= $form->label($model, 'email', array('class' => 'col-lg-1 control-label')) ?>
				<div class="col-lg-5">
					<?= $form->textField($model, 'email', array('class' => 'form-control')) ?>
				</div>
			</div>
			<div class="form-group">
				<?= $form->label($model, 'subject', array('class' => 'col-lg-1 control-label')) ?>
				<div class="col-lg-5">
					<?= $form->textField($model, 'subject', array('class' => 'form-control')) ?>
				</div>
			</div>
			<div class="form-group">
				<?= $form->label($model, 'body', array('class' => 'col-lg-1 control-label')) ?>
				<div class="col-lg-8">
					<?= $form->textArea($model, 'body', array('class' => 'form-control', 'rows' => 10)) ?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-lg-offset-1 col-lg-2">
					<button type="submit" class="btn btn-default" id="btnSubmit"><?= Yii::t('admin', 'Send') ?></button>
				</div>
			</div>
			<?php $this->endWidget(); ?>
		</div>
	<?php endif; ?>
</div>

<style>
	* {
		box-sizing: border-box !important;
	}
</style>