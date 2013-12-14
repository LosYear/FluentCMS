<?php
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/form.js');
?>
<div class="form">
	<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		// 'id'=>'block-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array('class' => 'form-horizontal')
	)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="form-group">
		<?= $form->label($model, 'title', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?php echo $form->textField($model, 'title', array('class' => 'form-control',
				'data-title' => Yii::t('admin', 'Title'),
				'data-content' => Yii::t('popover', 'Name of the role. Case sensetive'),
				'rel' => 'popover')); ?>
		</div>
	</div>

	<div class="form-group">
		<?= $form->label($model, 'description', array('class' => 'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?php echo $form->textArea($model, 'description', array('rows' => '6', 'cols' => '50', 'class' => 'form-control',
				'data-title' => Yii::t('admin', 'Description'),
				'data-content' => Yii::t('popover', 'Description should content only plain text. Helps to administator'),
				'rel' => 'popover')); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo CHtml::label(Yum::t('This users have been assigned to this role'), '', array('class' => 'col-lg-2 control-label')); ?>
		<div class="col-lg-8">
			<?php
				$this->widget('YumModule.components.Relation', array(
					'model' => $model,
					'relation' => 'users',
					'style' => 'dropdownlist',
					'fields' => 'username',
					'htmlOptions' => array(
						'checkAll' => Yum::t('Choose All'),
						'template' => '<div style="float:left;margin-right:5px;" class="form-control">{input}</div>{label}',
						'class' => 'form-control',
						'rel' => 'popover'),
					'showAddButton' => false
				));
			?>
		</div>
	</div>


	<!-- <?php if(Yum::hasModule('membership')) { ?>
        <div class="row">
        <?php echo CHtml::activeLabelEx($model,'is_membership_possible'); ?>
        <?php echo CHtml::activeCheckBox($model, 'is_membership_possible'); ?>

        </div>
        <div class="membership">
        <div class="row">
        <?php echo CHtml::activeLabelEx($model,'price'); ?>
        <?php echo CHtml::activeTextField($model, 'price'); ?>
        <?php echo CHtml::Error($model, 'price'); ?>
        </div>
        <div class="hint"> 
        <?php echo Yum::t('How expensive is a membership? Set to 0 to disable membership for this role'); ?>
        </div>

        <div class="row">
        <?php echo CHtml::activeLabelEx($model,'duration'); ?>
        <?php echo CHtml::activeTextField($model, 'duration'); ?>
        <?php echo CHtml::Error($model, 'duration'); ?>
        </div>
        <div class="hint"> 
        <?php echo Yum::t('How many days will the membership be valid after payment?'); ?>
        </div>

        </div>
        <?php Yii::app()->clientScript->registerScript('membership_toggle', "
                if(!$('#YumRole_is_membership_possible').attr('checked'))
                        $('.membership').hide();
                $('#YumRole_is_membership_possible').click(function() {
                $('.membership').toggle(500);
        });
        "); ?>
        <div style="clear: both;"> </div>
        <?php } ?> -->

	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-2">
			<button type="submit" class="btn btn-default"><?= Yii::t('admin', 'Submit') ?></button>
		</div>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->
