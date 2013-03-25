<?php 
	$cs=Yii::app()->getClientScript();
        $cs->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');
?>
<div class="form">
	<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::errorSummary($model); ?>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo CHtml::activeLabelEx($model,'varname'); ?></div>
			<div class="column span-12"><?php echo CHtml::activeTextField($model,'varname',array('class'=>'span5',
                            'data-title'=>Yii::t('admin', 'Varname'), 
                            'data-content'=>Yii::t('popover', 'Variable name should contatin only letters, numbers and _'),
                            'rel'=>'popover',
                            'size'=>60,'maxlength'=>50,$model->id!==null?'readonly':'')); ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo CHtml::activeLabelEx($model,'title'); ?></div>
			<div class="column span-12"><?php echo CHtml::activeTextField($model,'title',array('class'=>'span5',
                            'data-title'=>Yii::t('admin', 'Title'), 
                            'data-content'=>Yii::t('popover', 'Title of variable. Shown to a user'),
                            'rel'=>'popover','size'=>60,'maxlength'=>255)); ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo CHtml::activeLabelEx($model,'hint'); ?></div>
			<div class="column span-12"><?php echo CHtml::activeTextField($model,'hint',array('class'=>'span5',
                            'data-title'=>Yii::t('admin', 'Hint'), 
                            'data-content'=>Yii::t('popover', 'Hint for user. Can contain a description of variable'),
                            'rel'=>'popover','size'=>60)); ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo CHtml::activeLabelEx($model,'field_type'); ?></div>
			<div class="column span-12"><?php echo (($model->id)
				? CHtml::activeTextField($model,'field_type',array('class'=>'span5',
						'size'=>60,
						'maxlength'=>50,
						'readonly'=>true))
				: CHtml::activeDropDownList($model,
					'field_type',
					YumProfileField::itemAlias('field_type'), array('class'=>'span5',
                            'data-title'=>Yii::t('admin', 'Type'), 
                            'data-content'=>Yii::t('popover', 'Type of field\'s content'),
                            'rel'=>'popover'))); ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="column span-4"><?php echo CHtml::activeLabelEx($model,'field_size'); ?></div>
		<div class="column span-4"><?php echo CHtml::activeTextField($model,'field_size',array('class'=>'span5',
                            'data-title'=>Yii::t('admin', 'Size'), 
                            'data-content'=>Yii::t('popover', 'Maximum size for this field.'),
                            'rel'=>'popover', $model->id!==null?'readonly':'')); ?></div>
	</div>
	<div class="row-fluid">
		<div class="column span-4"><?php echo CHtml::activeLabelEx($model,'field_size_min'); ?></div>
		<div class="column span-4"><?php echo CHtml::activeTextField($model,'field_size_min', array('class'=>'span5',
                            'data-title'=>Yii::t('admin', 'Minimum size'), 
                            'data-content'=>Yii::t('popover', 'Minimum size for this field.'),
                            'rel'=>'popover')); ?></div>
	</div>
	<div class="row-fluid">
		<div class="column span-4"><?php echo CHtml::activeLabelEx($model,'required'); ?></div>
		<div class="column span-4"><?php echo CHtml::activeDropDownList($model,'required',YumProfileField::itemAlias('required'), array('class'=>'span5',
                            'data-title'=>Yii::t('admin', 'Required'), 
                            'data-content'=>Yii::t('popover', 'Is field required'),
                            'rel'=>'popover')); ?></div>
	</div>
	<?php echo CHtml::activeHiddenField($model,'match',array('class'=>'span5','size'=>60,'value'=>'', 'maxlength'=>255)); ?>
	<?php echo CHtml::activeHiddenField($model,'range',array('size'=>60, 'value'=>'', 'maxlength'=>255)); ?>
	<?php echo CHtml::activeHiddenField($model,'error_message', array('size'=>60, 'value'=>'', 'maxlength'=>255)); ?>
	<?php echo CHtml::activeHiddenField($model,'other_validator',array('value'=>'', 'size'=>60,'maxlength'=>255)); ?>
	<?php echo CHtml::activeHiddenField($model,'default',array('value'=>'', 'size'=>60,'maxlength'=>255,$model->id!==null?'readonly':''));?>
	<?php echo CHtml::activeHiddenField($model,'visible',array('value'=>'4', 'size'=>60,'maxlength'=>255,$model->id!==null?'readonly':''));?>
	<div class="row-fluid">
		<div class="column span-4"><?php echo CHtml::activeLabelEx($model,'position'); ?></div>
		<div class="column span-4"><?php echo CHtml::activeTextField($model,'position', array('class'=>'span5',
                            'data-title'=>Yii::t('admin', 'Order'), 
                            'data-content'=>Yii::t('popover', 'Fields with lower value will be displayed first'),
                            'rel'=>'popover')); ?></div>
	</div>
	<div class="row-fluid">
		<div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
			array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div>
	</div>
	<?php echo CHtml::endForm(); ?>
</div>
<!-- form -->