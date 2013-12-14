<?php
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/form.js');
?>
	<div class="page-header">
		<h1><?php echo Yii::t('admin', 'Permission') ?>
			<small><?php echo Yii::t('admin', 'Grant') ?></small>
		</h1>
	</div>
	<div class="form">
		<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id' => 'permission-create-form',
			'enableAjaxValidation' => false,
			'htmlOptions' => array('class' => 'form-horizontal')
		));

			$this->menu = array(
				array('label' => Yii::t('yum', 'Manage permissions'), 'url' => array('admin'), 'icon' => 'list black',),
			);

		?>
		<?php echo $form->errorSummary($model); ?>
		<div class="form-group">
			<label
				class="col-lg-2 control-label"><?php echo Yum::t('Do you want to grant this permission to a user or a role'); ?></label>

			<div class="col-lg-8">
				<?php echo $form->dropDownList($model, 'type', array(
					'role' => Yum::t('Role'),
					'user' => Yum::t('User')), array('class' => 'form-control',
					'data-title' => Yii::t('admin', 'Type'),
					'data-content' => Yii::t('popover', 'Select owner of permissions. Group will grant permissions to whole group.'),
					'rel' => 'popover')); ?>
			</div>
		</div>

		<div id="assignment_user">
			<div class="form-group">
				<?= $form->label($model, 'principal_id', array('class' => 'col-lg-2 control-label')) ?>
				<div class="col-lg-8">
					<?php $this->widget('Relation', array(
						'model' => $model,
						'relation' => 'principal',
						'fields' => 'username',
						'htmlOptions' => array('class' => 'form-control',
							'data-title' => Yii::t('admin', 'Username'),
							'data-content' => Yii::t('popover', 'Select username for granting permissions'),
							'rel' => 'popover')
					));?>
				</div>
			</div>

			<div class="form-group">
				<?= $form->label($model, 'template', array('class' => 'col-lg-2 control-label')) ?>
				<div class="col-lg-8">
					<?php echo $form->dropDownList($model, 'template', array(
						'0' => Yum::t('No'),
						'1' => Yum::t('Yes'),
					), array('class' => 'form-control',
						'data-title' => Yii::t('admin', 'Auto grant'),
						'data-content' => Yii::t('popover', 'Grant permission to all new users'),
						'rel' => 'popover')); ?>
				</div>
			</div>
		</div>
		<div id="assignment_role" style="display: none;">
			<div class="form-group">
				<?= $form->label($model, 'principal_id', array('class' => 'col-lg-2 control-label')) ?>
				<div class="col-lg-8">
					<?php $this->widget('Relation', array(
						'model' => $model,
						'relation' => 'principal_role',
						'fields' => 'title',
						'htmlOptions' => array('class' => 'form-control',
							'data-title' => Yii::t('admin', 'Role'),
							'data-content' => Yii::t('popover', 'Select role for granting permissions'),
							'rel' => 'popover')
					));?>
					<?php $this->widget('Relation', array(
						'model' => $model,
						'allowEmpty' => true,
						'relation' => 'subordinate_role',
						'fields' => 'title',
						'htmlOptions' => array('class' => 'form-control',
							'data-title' => Yii::t('admin', 'Title'),
							'data-content' => Yii::t('popover', 'Name of the role. Case sensetive'),
							/*   'rel'=>'popover'*/)
					));?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<?= $form->label($model, 'action', array('class' => 'col-lg-2 control-label')) ?>
			<div class="col-lg-8">
				<?php $this->widget('Relation', array(
					'model' => $model,
					'relation' => 'Action',
					'fields' => 'title',
					'htmlOptions' => array('class' => 'form-control',
						'data-title' => Yii::t('admin', 'Action'),
						'data-content' => Yii::t('popover', 'Select action, which user can do'),
						'rel' => 'popover')
				));?>
			</div>
		</div>

		<div class="form-group">
			<?= $form->label($model, 'comment', array('class' => 'col-lg-2 control-label')) ?>
			<div class="col-lg-8">
				<?php echo $form->textArea($model, 'comment', array('class' => 'form-control',
					'data-title' => Yii::t('admin', 'Comment'),
					'data-content' => Yii::t('popover', 'Comment for granted permission. You can write some notes here'),
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
<?php Yii::app()->clientScript->registerScript('type', "
$('#YumPermission_type').click(function(){
switch ($('#YumPermission_type').val()){
case 'role' : $('#assignment_role').show(); $('#assignment_user').hide(); break;
case 'user' : $('#assignment_role').hide(); $('#assignment_user').show(); break;
}
});
");