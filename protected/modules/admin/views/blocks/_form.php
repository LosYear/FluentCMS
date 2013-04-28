<?php
	/* @var $this BlockController */
	/* @var $model Block */
	/* @var $form CActiveForm */
	?>
<?php 
        $assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.admin.assets'));
        Yii::app()->clientScript->registerScriptFile($assetsUrl.'/js/form.js', CClientScript::POS_HEAD);
?>
<div class="form">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'block-form',
		'enableAjaxValidation'=>false,
		)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'title'); ?></div>
			<div class="column span-12"><?php echo $form->textField($model, 'title', array('class'=>'span9',
                            'data-title'=>Yii::t('admin', 'Title'), 
                            'data-content'=>Yii::t('popover', 'Block title. Can be displayed to user.'),
                            'rel'=>'popover')); ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'name'); ?></div>
			<div class="column span-12"><?php echo $form->textField($model, 'name', array('class'=>'span9',
                            'data-title'=>Yii::t('admin', 'Name'), 
                            'data-content'=>Yii::t('popover','System name of block. Must be unique. Will be used for displaying block.'),
                            'rel'=>'popover')); ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'content'); ?></div>
                        <div class="column span-12">
                            <?php $this->widget('ext.editMe.widgets.ExtEditMe', array(
                                'model'=>$model,
                                'attribute'=>'content',
                            )); ?>
                        </div>
		</div>
	</div>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'status'); ?></div>
			<div class="column span-12"><?php echo $form->dropDownList($model, 'status', 
				array('0' => Yii::t('admin', 'Draft'), 
				    '1'=> Yii::t('admin', 'Published')), array('class'=>'span2',
                            'data-title'=>Yii::t('admin', 'Status'), 
                            'data-content'=>Yii::t('popover','Draft or published. Draft are not displayed even if widget called.'),
                            'rel'=>'popover')) ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($model,'type'); ?></div>
			<div class="column span-12"><?php echo $form->dropDownList($model, 'type', 
				array('html' => Yii::t('admin', 'Html')), array('class'=>'span2',
                            'data-title'=>Yii::t('admin', 'Type'), 
                            'data-content'=>Yii::t('popover','Select type of block. Select HTML for displaying HTML content.'),
                            'rel'=>'popover')); ?></div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
			array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div>
	</div>
	<?php $this->endWidget(); ?>
</div>
<!-- form -->