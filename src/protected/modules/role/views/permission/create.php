<?php $this->title = Yum::t('Grant permission'); ?>
<div class="form">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'permission-create-form',
		'enableAjaxValidation'=>false,
		)); 
		
		$this->menu=array(
		array('label'=>Yii::t('yum', 'Manage permissions'), 'url'=>array('admin'), 'icon'=>'list black',),
		);
		
		?>
	<?php echo $form->errorSummary($model); ?>
	<div class="row-fluid">
		<label> <?php echo Yum::t('Do you want to grant this permission to a user or a role'); ?> </label>
		<?php /*echo $form->radioButtonList($model, 'type', array(
			'user' => Yum::t('User'),
			'role' => Yum::t('Role'))/*,
			array('template' => '<div class="checkbox">{input}</div>{label}'
			)); */?>
		<?php echo $form->dropDownList($model, 'type', array(
			'role' => Yum::t('Role'),
			                            'user' => Yum::t('User')), array('class'=>'span4')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
	<div id="assignment_user">
		<div class="row-fluid">
			<?php echo $form->labelEx($model,'principal_id'); ?>
			<?php $this->widget('Relation', array(
				'model' => $model,
				'relation' => 'principal',
				'fields' => 'username',
				         'htmlOptions' =>  array('class'=>'span4')
				));?>
			<?php echo $form->error($model,'principal_id'); ?>
			<!--<?php echo $form->labelEx($model,'subordinate_id'); ?>
				<?php $this->widget('Relation', array(
					'model' => $model,
					'allowEmpty' => true,
					'relation' => 'subordinate',
					'fields' => 'username',
					));?>-->
			<?php echo $form->error($model,'subordinate_id'); ?>
		</div>
		<div class="row-fluid">
			<?php echo $form->labelEx($model,'template'); ?>
			<?php echo $form->dropDownList($model,'template', array(
				'0' => Yum::t('No'),
				'1' => Yum::t('Yes'),
				), array('class'=>'span4')); ?>
			<?php echo $form->error($model,'template'); ?>
		</div>
	</div>
	<div id="assignment_role" style="display: none;">
		<div class="row-fluid">
			<?php echo $form->labelEx($model,'principal_id'); ?>
			<?php $this->widget('Relation', array(
				'model' => $model,
				'relation' => 'principal_role',
				'fields' => 'title',
				         'htmlOptions' =>  array('class'=>'span4')
				));?>
			<?php echo $form->error($model,'principal_id'); ?>
			<?php echo $form->labelEx($model,'subordinate_id'); ?>
			<?php $this->widget('Relation', array(
				'model' => $model,
				'allowEmpty' => true,
				'relation' => 'subordinate_role',
				'fields' => 'title',
                                'htmlOptions' =>  array('class'=>'span4')
				));?>
			<?php echo $form->error($model,'subordinate_id'); ?>
		</div>
	</div>
	<div class="row-fluid">
		<?php echo $form->labelEx($model,'action'); ?>
		<?php $this->widget('Relation', array(
			'model' => $model,
			'relation' => 'Action',
			'fields' => 'title',
			                                    'htmlOptions' =>  array('class'=>'span4')
			));?>
		<?php echo $form->error($model,'action'); ?>
	</div>
	<div class="row-fluid">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment', array('class'=>'span4')); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>
	<div class="row-fluid buttons">
		<?php $this->widget('bootstrap.widgets.TbButton', 
			array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?>
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