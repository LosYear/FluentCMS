<?php
/* @var $this ProfileController */
/* @var $model Profile */
/* @var $form CActiveForm */
?>
<script lang="javascript">
	ajax_url = "<?php echo Yii::app()->createUrl('author/ajax/profile'); ?>";
</script>
<div class="form">

<?php

	$assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.author.assets'));
	Yii::app()->clientScript->registerScriptFile($assetsUrl . '/typeahead.min.js', CClientScript::POS_END);
	if($new){
		Yii::app()->clientScript->registerScriptFile($assetsUrl . '/profile_autocomplete.js', CClientScript::POS_END);
	}

	$form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
        <fieldset class="edit-form">
            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'name'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'name', array('class'=>'name span6')); ?></div>
                </div>
            </div>
            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'academic'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'academic', array('class'=>'academic span6')); ?></div>
                </div>
            </div>
            
            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'email'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'email', array('class'=>'email span6')); ?></div>
                </div>
            </div>
            

            <div class="row"><div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
            array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div></div>
        </fieldset>
<?php $this->endWidget(); ?>

</div><!-- form -->