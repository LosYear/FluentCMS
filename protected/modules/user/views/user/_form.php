<?php
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/form.js');
?>
<div class="form">
	<?php
		$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id' => 'user-form',
			'htmlOptions' => array('class' => 'form-horizontal'),
			'enableAjaxValidation' => false));
	?>
	<div class="note">
		<?php
			$models = array($model, $passwordform);
			if (isset($profile) && $profile !== false)
				$models[] = $profile;
			echo CHtml::errorSummary($models);
		?>
	</div>
	<div class="form-group">
		<?= $form->label($model, 'username', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?php echo $form->textField($model, 'username', array('class' => 'form-control',
				'data-title' => Yii::t('admin', 'Username'),
				'data-content' => Yii::t('popover', 'Should contain only letters and "_"'),
				'rel' => 'popover')); ?>
		</div>
	</div>

	<div class="form-group">
		<?= $form->label($model, 'superuser', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?php echo $form->dropDownList($model, 'superuser', YumUser::itemAlias('AdminStatus'), array('class' => 'form-control',
				'data-title' => Yii::t('admin', 'Superuser'),
				'data-content' => Yii::t('popover', 'User administrator or not'),
				'rel' => 'popover')); ?>
		</div>
	</div>

	<div class="form-group">
		<?= $form->label($model, 'status', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?php echo $form->dropDownList($model, 'status', YumUser::itemAlias('UserStatus'), array('class' => 'form-control',
				'data-title' => Yii::t('admin', 'Status'),
				'data-content' => Yii::t('popover', 'Status of user'),
				'rel' => 'popover')); ?>
		</div>
	</div>

	<!-- <?php if(Yum::hasModule('role')) {
      Yii::import('application.modules.role.models.*');
      ?>
      <div class="row roles">
      <p> <?php echo Yum::t('User belongs to these roles'); ?> </p>
      
      	<?php $this->widget('YumModule.components.Relation', array(
         'model' => $model,
         'relation' => 'roles',
         'style' => 'dropdownlist',
         'fields' => 'title',
         'showAddButton' => false
         )); ?>
      </div>
      <?php } ?>-->
	<?php $this->renderPartial('/user/passwordfields', array(
		'form' => $passwordform)); ?>
	<?php if (Yum::hasModule('profile'))
		$this->renderPartial('application.modules.profile.views.profile._form', array(
			'profile' => $profile)); ?>
	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-2">
			<button type="submit" class="btn btn-default"><?= Yii::t('admin', 'Submit') ?></button>
		</div>
	</div>
	<?php $this->endWidget(); ?>
</div>
<div style="clear:both;"></div>