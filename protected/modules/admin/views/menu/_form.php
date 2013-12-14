<?php
	/* @var $this MenuController */
	/* @var $model Menu */
	/* @var $form CActiveForm */
?>
<?php
	$assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.admin.assets'));
	Yii::app()->clientScript->registerScriptFile($assetsUrl . '/js/form.js', CClientScript::POS_HEAD);
?>
<div class="form">
	<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id' => 'menu-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array('class' => 'form-horizontal')
	)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="form-group">
		<?= $form->label($model, 'title', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?=
				$form->textField($model, 'title', array('class' => 'form-control',
					'data-title' => Yii::t('admin', 'Title'),
					'data-content' => Yii::t('popover', 'Menu title. Can be displayed to user.'),
					'rel' => 'popover')) ?>
		</div>
	</div>

	<div class="form-group">
		<?= $form->label($model, 'name', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?=
				$form->textField($model, 'name', array('class' => 'form-control',
					'data-title' => Yii::t('admin', 'Name'),
					'data-content' => Yii::t('popover', 'System name of menu. Must be unique. Will be used for displaying menu.'),
					'rel' => 'popover')) ?>
		</div>
	</div>

	<div class="form-group">
		<?= $form->label($model, 'description', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?=
				$form->textArea($model, 'description', array('class' => 'form-control',
					'data-title' => Yii::t('admin', 'Description'),
					'data-content' => Yii::t('popover', 'Admin\'s comment'),
					'rel' => 'popover')) ?>
		</div>
	</div>
	<div class="form-group">
		<?= $form->label($model, 'status', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-4">
			<?php echo $form->dropDownList($model, 'status',
				array('0' => Yii::t('admin', 'Draft'),
					'1' => Yii::t('admin', 'Published')), array('class' => 'form-control',
					'data-title' => Yii::t('admin', 'Status'),
					'data-content' => Yii::t('popover', 'Visibility for node. Draft is not displayed to user.'),
					'rel' => 'popover'));?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-2">
			<button type="submit" class="btn btn-default"><?= Yii::t('admin', 'Submit') ?></button>
		</div>
	</div>
	<?php $this->endWidget(); ?>
</div>
<!-- form -->
