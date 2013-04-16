<?php
/* @var $this PollController */
/* @var $model Poll */
/* @var $form CActiveForm */
?>
 <?php 
    $url = Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('application.modules.poll.assets').'/ckeditor');
    Yii::app()->clientScript->registerScriptFile(
        $url.'/ckeditor.js'
    );
    $cs=Yii::app()->getClientScript();
    $cs->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');
    
    $assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.poll.assets'));

   Yii::app()->clientScript->registerCssFile($assetsUrl.'/jquery-ui/jquery-ui-1.10.0.custom.css');

   Yii::app()->clientScript->registerScriptFile($assetsUrl.'/jquery-ui/jquery-ui-1.10.1.custom.min.js', CClientScript::POS_HEAD);
   
   Yii::app()->clientScript->registerCssFile($assetsUrl.'/jquery-ui-timepicker-addon.css');
   
   Yii::app()->clientScript->registerScriptFile($assetsUrl.'/jquery-ui-timepicker-addon.js', CClientScript::POS_HEAD);
   
   Yii::app()->clientScript->registerScriptFile($assetsUrl.'/localization/ru.js', CClientScript::POS_HEAD);
 ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'poll-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->errorSummary($node); ?>
        
        <div class="row-fluid">
            <div>
                <div class="column span-4"><?php echo $form->labelEx($node,'title'); ?></div>
                <div class="column span-12"><?php echo $form->textField($node, 'title', array('class'=>'span9',
                            'data-title'=>Yii::t('admin', 'Title'), 
                            'data-content'=>Yii::t('PollModule.popover', 'Title of the poll. Shown to a user.'),
                            'rel'=>'popover')); ?></div>
            </div>
        </div>
        
        <div class="row-fluid">
            <div>
                <div class="column span-4"><?php echo $form->labelEx($node,'url'); ?></div>
                <div class="column span-12"><?php echo $form->textField($node, 'url', array('class'=>'span9',
                            'data-title'=>Yii::t('admin', 'URL'), 
                            'data-content'=>Yii::t('PollModule.popover', 'Custom URL for this poll. Poll can be accessed by this URL'),
                            'rel'=>'popover')); ?></div>
            </div>
        </div>
        
        <div class="row-fluid">
            <div>
                <div class="column span-4"><?php echo $form->labelEx($node,'content'); ?></div>
                <div class="column span-12"><?php echo $form->textArea($node, 'content', array('class'=>'span12 ckeditor',
                            'rel'=>'popover')); ?></div>
            </div>
        </div>

        <div class="row-fluid">
            <div>
                <div class="column span-4"><?php echo $form->labelEx($model,'isLimited'); ?>
                <?php echo $form->checkBox($model, 'isLimited', array(//'class'=>'span12 ckeditor',
                            'data-title'=>Yii::t('PollModule.admin', 'Time Limit'), 
                            'data-content'=>Yii::t('PollModule.popover', 'Do you want to specify the time when users can vote?'),
                            'rel'=>'popover')); ?></div>
            </div>
        </div>

        <div class="row-fluid">
            <div>
                <div class="column span-4"><?php echo $form->labelEx($model,'from'); ?></div>
                <div class="column span-12"><?php echo $form->textField($model, 'from', array('id'=>'datetime','class'=>'span9' ,
                        'data-title'=>Yii::t('PollModule.admin', 'Till'), 
                        'data-content'=>Yii::t('PollModule.popover', 'Click for selecting date. Select date when poll will begin.'),
                        'rel'=>'popover')); ?></div>
            </div>
        </div>

        <div class="row-fluid">
            <div>
                <div class="column span-4"><?php echo $form->labelEx($model,'till'); ?></div>
                <div class="column span-12"><?php echo $form->textField($model, 'till', array('id'=>'datetime_2','class'=>'span9' ,
                        'data-title'=>Yii::t('PollModule.admin', 'Till'), 
                        'data-content'=>Yii::t('PollModule.popover', 'Click for selecting date. Select date when poll will end.'),
                        'rel'=>'popover')); ?></div>
            </div>
        </div>
        
	<div class="row-fluid">
		<div>
			<div class="column span-4"><?php echo $form->labelEx($node,'status'); ?></div>
			<div class="column span-12"><?php echo $form->dropDownList($node, 'status', 
				array('0' => Yii::t('admin', 'Draft'), 
				    '1'=> Yii::t('admin', 'Published')), array('class'=>'span2',
                            'data-title'=>Yii::t('admin', 'Status'), 
                            'data-content'=>Yii::t('popover','Draft or published. Draft are not displayed even if widget called.'),
                            'rel'=>'popover')) ?></div>
		</div>
	</div>

        <div class="row-fluid"><div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
            array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div></div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script lang="javascript">
    $('#datetime').datetimepicker({
        dateFormat : "dd.mm.yy"
    });
    $('#datetime_2').datetimepicker({
        dateFormat : "dd.mm.yy"
    });
</script>