<?php
/* @var $this IssueController */
/* @var $model Issue */
/* @var $form CActiveForm */

$assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.author.assets'));

Yii::app()->clientScript->registerCssFile($assetsUrl.'/jquery-ui/jquery-ui-1.10.0.custom.css');

Yii::app()->clientScript->registerScriptFile($assetsUrl.'/jquery-ui/jquery-ui-1.10.1.custom.min.js', CClientScript::POS_HEAD);

Yii::app()->clientScript->registerCssFile($assetsUrl.'/jquery-ui-timepicker-addon.css');

Yii::app()->clientScript->registerScriptFile($assetsUrl.'/jquery-ui-timepicker-addon.js', CClientScript::POS_HEAD);

Yii::app()->clientScript->registerScriptFile($assetsUrl.'/localization/ru.js', CClientScript::POS_HEAD); ?>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'issue-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

        <fieldset class="edit-form">
            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'number'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'number', array('class'=>'span12')); ?></div>
                </div>
            </div>
            
            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'year'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'year', array('class'=>'span12 picker')); ?></div>
                </div>
            </div>
            
            <div class="row">
                <div>
                   <div class="column span-4"><?php echo $form->labelEx($model,'cover'); ?></div>
                   <div class="column span-12"><?php echo $form->textArea($model, 'cover', array('class' => 'ckeditor span-12' )); ?></div>
                </div>
            </div>
            
            <div class="row">
                <div>
                   <div class="column span-5"><?php echo $form->labelEx($model,'isOpened'); ?></div>
                   <div class="column span-12"><?php echo $form->dropDownList($model, 'isOpened', 
                           array('1' => Yii::t('author', 'Opened'), 
                               '0'=> Yii::t('author', 'Closed')), array('class'=>'span2')) /*textField($model, 'status', array('class'=>'span12'))*/; ?></div>
                </div>
             </div>

            <div class="row"><div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
            array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div></div>
        </fieldset>

<?php $this->endWidget(); ?>

	<script lang="javascript">
		$('.picker').datepicker({
			dateFormat : "yy-mm-dd"
		});
	</script>

</div><!-- form -->