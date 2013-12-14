<?php
	$assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.admin.assets'));
	Yii::app()->clientScript->registerScriptFile($assetsUrl . '/js/form.js', CClientScript::POS_HEAD);
?>
<div class="form">
	<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id' => 'menu-item-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array('class' => 'form-horizontal')
	)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="form-group">
		<?= $form->label($model, 'parent_id', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?php echo $form->dropDownList($model, 'parent_id', $model->itemsCombo(), array('class' => 'form-control',
				'data-title' => Yii::t('admin', 'Parent'),
				'data-content' => Yii::t('popover', 'Parent of item. Select "No" for displaying this item at root'),
				'rel' => 'popover', 'readonly' => $translation)); ?>
		</div>
	</div>
	<div class="form-group">
		<?= $form->label($model, 'title', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?=
				$form->textField($model, 'title', array('class' => 'form-control',
					'data-title' => Yii::t('admin', 'Title'),
					'data-content' => Yii::t('popover', 'Title displayed to user'),
					'rel' => 'popover')) ?>
		</div>
	</div>
	<div class="form-group">
		<?= $form->label($model, 'type', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?php echo $form->dropDownList($model, 'type', array(
				'internal' => Yii::t('admin', 'Internal link'),
				'external' => Yii::t('admin', 'External link'),
			), array('class' => 'form-control',
				'data-title' => Yii::t('admin', 'Type'),
				'data-content' => Yii::t('popover', 'Type of link. Select internal for creating links between site\'s pages'),
				'rel' => 'popover')); ?>
		</div>
	</div>

	<div class="form-group">
		<?= $form->label($model, 'href', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?=
				$form->textField($model, 'href', array('class' => 'form-control',
					'data-title' => Yii::t('admin', 'Link'),
					'data-content' => Yii::t('popover', 'Link. Without http/https'),
					'rel' => 'popover')) ?>
		</div>
	</div>

	<div class="form-group">
		<?= $form->label($model, 'order', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?=
				$form->textField($model, 'order', array('class' => 'form-control',
					'data-title' => Yii::t('admin', 'Order'),
					'data-content' => Yii::t('popover', 'Displaying order'),
					'rel' => 'popover', 'readonly' => $translation)) ?>
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

<script lang="javascript">
	jQuery('select[readonly] option:not(:selected)').attr('disabled',true);
</script>