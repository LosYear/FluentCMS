<?php
	/* @var $this BlockController */
	/* @var $model Block */
	/* @var $form CActiveForm */
?>
<?php
	$assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.admin.assets'));
	Yii::app()->clientScript->registerScriptFile($assetsUrl . '/js/form.js', CClientScript::POS_HEAD);
?>
<div class="form">
	<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id' => 'block-form',
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
					'data-content' => Yii::t('popover', 'Block title. Can be displayed to user.'),
					'rel' => 'popover')) ?>
		</div>
	</div>
	<div class="form-group">
		<?= $form->label($model, 'name', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?=
				$form->textField($model, 'name', array('class' => 'form-control', 'data-title' => Yii::t('admin', 'Name'),
					'data-content' => Yii::t('popover', 'System name of block. Must be unique. Will be used for displaying block.'),
					'rel' => 'popover', 'readonly' => $translation)) ?>
		</div>
	</div>
	<div class="form-group">
		<?= $form->label($model, 'content', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?php $this->widget('ext.editMe.widgets.ExtEditMe', array(
				'model' => $model,
				'attribute' => 'content',
			)); ?>
		</div>
	</div>

	<div class="form-group">
		<?= $form->label($model, 'status', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-4">
			<?php echo $form->dropDownList($model, 'status',
				array('0' => Yii::t('admin', 'Draft'),
					'1' => Yii::t('admin', 'Published')), array('class' => 'form-control',
					'data-title' => Yii::t('admin', 'Status'),
					'data-content' => Yii::t('popover', 'Draft or published. Draft are not displayed even if widget called.'),
					'rel' => 'popover'));?>
		</div>
	</div>

	<div class="form-group">
		<?= $form->label($model, 'status', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-4">
			<?php echo $form->dropDownList($model, 'type',
				array('html' => Yii::t('admin', 'HTML')), array('class' => 'form-control',
					'data-title' => Yii::t('admin', 'Type'),
					'data-content' => Yii::t('popover', 'Select type of block. Select HTML for displaying HTML content.'),
					'rel' => 'popover')); ?>
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