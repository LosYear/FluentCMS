<?php 
	$cs=Yii::app()->getClientScript();
	$cs->registerScriptFile(Yii::app()->baseUrl.'/js/ckeditor/ckeditor.js');
        $cs->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');
?>
<div class="form">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'menu-item-form',
		'enableAjaxValidation'=>false,
		)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'parent_id'); ?></div>
			<div class="column span-12"><?php echo $form->dropDownList($model,'parent_id', $model->itemsCombo(),  array('class'=>'span4',
                            'data-title'=>Yii::t('admin', 'Parent'), 
                            'data-content'=>Yii::t('popover', 'Parent of item. Select "No" for displaying this item at root'),
                            'rel'=>'popover')); ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'title'); ?></div>
			<div class="column span-12"><?php echo $form->textField($model,'title', array('class'=>'span8',
                            'data-title'=>Yii::t('admin', 'Title'), 
                            'data-content'=>Yii::t('popover', 'Title displayed to user'),
                            'rel'=>'popover')); ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'type'); ?></div>
			<div class="column span-12"><?php echo $form->dropDownList($model,'type', array(
				'internal' => Yii::t('admin', 'Internal link')), array('class'=>'span4',
                            'data-title'=>Yii::t('admin', 'Type'), 
                            'data-content'=>Yii::t('popover', 'Type of link. Select internal for creating links between site\'s pages'),
                            'rel'=>'popover')); ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'href'); ?></div>
			<div class="column span-12"><?php echo $form->textField($model,'href', array('class'=>'span8',
                            'data-title'=>Yii::t('admin', 'Link'), 
                            'data-content'=>Yii::t('popover', 'Link. Without http/https'),
                            'rel'=>'popover')); ?></div>
		</div>
	</div>
	<!--<div class="row-fluid">
		<div>
		<div class="column span-4"><?php echo $form->labelEx($model,'condition_name'); ?></div>
		    <div class="column span-12"><?php echo $form->textField($model,'condition_name',array('class'=>'span12')); ?></div>
		</div>
		</div>
		
		<div class="row-fluid">
		<div>
		<div class="column span-4"><?php echo $form->labelEx($model,'condition_denial'); ?></div>
		    <div class="column span-12"><?php echo $form->textField($model,'condition_denial',array('class'=>'span12')); ?></div>
		</div>
		</div>-->
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'order'); ?></div>
			<div class="column span-12"><?php echo $form->textField($model,'order',array('class'=>'span8',
                            'data-title'=>Yii::t('admin', 'Order'), 
                            'data-content'=>Yii::t('popover', 'Displaying order'),
                            'rel'=>'popover')); ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'status'); ?></div>
			<div class="column span-12"><?php echo $form->dropDownList($model, 'status', 
				array('0' => Yii::t('admin', 'Draft'), 
				    '1'=> Yii::t('admin', 'Published')), array('class'=>'span4',
                            'data-title'=>Yii::t('admin', 'Status'), 
                            'data-content'=>Yii::t('popover', 'Visibility for node. Draft is not displayed to user.'),
                            'rel'=>'popover')) /*textField($model, 'status', array('class'=>'span12'))*/; ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
			array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div>
	</div>
	<?php $this->endWidget(); ?>
</div>
<!-- form -->
