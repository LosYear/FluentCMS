<div class="form">
<fieldset class="edit-form">

<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($model); ?>
	
	<div class="row">
            <div>
		<div class="column span-4"><?php echo CHtml::activeLabelEx($model,'varname'); ?></div>
		<div class="column span-12"><?php echo CHtml::activeTextField($model,'varname',array('size'=>60,'maxlength'=>50,$model->id!==null?'readonly':'')); ?></div>
            </div>
	</div>

	<div class="row">
            <div>
                <div class="column span-4"><?php echo CHtml::activeLabelEx($model,'title'); ?></div>
                <div class="column span-12"><?php echo CHtml::activeTextField($model,'title',array('size'=>60,'maxlength'=>255)); ?></div>
            </div>
	</div>
	
	<div class="row">
            <div>
                <div class="column span-4"><?php echo CHtml::activeLabelEx($model,'hint'); ?></div>
                <div class="column span-12"><?php echo CHtml::activeTextField($model,'hint',array('size'=>60)); ?></div>
            </div>
	</div>	
	
	<div class="row">
            <div>
		<div class="column span-4"><?php echo CHtml::activeLabelEx($model,'field_type'); ?></div>
		<div class="column span-12"><?php echo (($model->id)
				? CHtml::activeTextField($model,'field_type',array(
						'size'=>60,
						'maxlength'=>50,
						'readonly'=>true))
				: CHtml::activeDropDownList($model,
					'field_type',
					YumProfileField::itemAlias('field_type'))); ?></div>
            </div>
	</div>

	<div class="row">
		<div class="column span-4"><?php echo CHtml::activeLabelEx($model,'field_size'); ?></div>
		<div class="column span-4"><?php echo CHtml::activeTextField($model,'field_size',array($model->id!==null?'readonly':'')); ?></div>
	</div>

	<div class="row">
		<div class="column span-4"><?php echo CHtml::activeLabelEx($model,'field_size_min'); ?></div>
		<div class="column span-4"><?php echo CHtml::activeTextField($model,'field_size_min'); ?></div>
	</div>

	<div class="row">
		<div class="column span-4"><?php echo CHtml::activeLabelEx($model,'required'); ?></div>
		<div class="column span-4"><?php echo CHtml::activeDropDownList($model,'required',YumProfileField::itemAlias('required')); ?></div>
	</div>

        <?php echo CHtml::activeHiddenField($model,'match',array('size'=>60,'value'=>'', 'maxlength'=>255)); ?>


        <?php echo CHtml::activeHiddenField($model,'range',array('size'=>60, 'value'=>'', 'maxlength'=>255)); ?>



        <?php echo CHtml::activeHiddenField($model,'error_message', array('size'=>60, 'value'=>'', 'maxlength'=>255)); ?>



        <?php echo CHtml::activeHiddenField($model,'other_validator',array('value'=>'', 'size'=>60,'maxlength'=>255)); ?>


        <?php echo CHtml::activeHiddenField($model,'default',array('value'=>'', 'size'=>60,'maxlength'=>255,$model->id!==null?'readonly':''));?>

        <?php echo CHtml::activeHiddenField($model,'visible',array('value'=>'4', 'size'=>60,'maxlength'=>255,$model->id!==null?'readonly':''));?>


	<div class="row">
		<div class="column span-4"><?php echo CHtml::activeLabelEx($model,'position'); ?></div>
		<div class="column span-4"><?php echo CHtml::activeTextField($model,'position'); ?></div>
	</div>
        <div class="row"><div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
        array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div></div>

<?php echo CHtml::endForm(); ?>

</fieldset>
</div><!-- form -->
