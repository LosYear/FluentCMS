<div class="form-group">
	<?= CHtml::activeLabel($form, 'password', array('class' => 'col-lg-2 control-label')) ?>
	<div class="col-lg-8">
		<?php echo CHtml::activePasswordField($form,'password', array('class' => 'form-control',
			'data-title'=>Yii::t('admin', 'Password'),
			'data-content'=>Yii::t('popover', 'Enter new password. Please, leave field blank for keeping old pass.'),
			'rel'=>'popover')); ?>
	</div>
</div>

<div class="form-group">
	<?= CHtml::activeLabel($form, 'verifyPassword', array('class' => 'col-lg-2 control-label')) ?>
	<div class="col-lg-8">
		<?php echo CHtml::activePasswordField($form,'verifyPassword', array('class' => 'form-control',
			'data-title'=>Yii::t('admin', 'Verify'),
			'data-content'=>Yii::t('popover', 'Verify your password.'),
			'rel'=>'popover')); ?>
	</div>
</div>