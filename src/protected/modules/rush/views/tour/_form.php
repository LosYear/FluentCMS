<?php
/* @var $this TourController */
/* @var $model Tour */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'tour-form',
	'enableAjaxValidation'=>false,
)); 
   $assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.rush.assets'));

   Yii::app()->clientScript->registerCssFile($assetsUrl.'/jquery-ui/jquery-ui-1.10.0.custom.css');

   Yii::app()->clientScript->registerScriptFile($assetsUrl.'/jquery-ui/jquery-ui-1.10.1.custom.min.js', CClientScript::POS_HEAD);
   
   Yii::app()->clientScript->registerCssFile($assetsUrl.'/jquery-ui-timepicker-addon.css');
   
   Yii::app()->clientScript->registerScriptFile($assetsUrl.'/jquery-ui-timepicker-addon.js', CClientScript::POS_HEAD);
   
   Yii::app()->clientScript->registerScriptFile($assetsUrl.'/localization/ru.js', CClientScript::POS_HEAD);
?>
    <fieldset class="edit-form">

                <?php echo $form->errorSummary($model); ?>

            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'name'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'name', array('class'=>'span12')); ?></div>
                </div>
            </div>

            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'description'); ?></div>
                    <div class="column span-12"><?php echo $form->textArea($model, 'description', array('class'=>'span12')); ?></div>
                </div>
            </div>

            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'category_id'); ?></div>
                    <div class="column span-12"><?php echo $form->dropDownList($model, 'category_id', Category::dropDown()); ?></div>
                </div>
            </div>

            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'type'); ?></div>
                    <div class="column span-12"><?php echo $form->dropDownList($model, 'type', Tour::types()); ?></div>
                </div>
            </div>

            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'from'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'from', array('id'=>'datetime', 'class'=>'span12')); ?></div>
                </div>
            </div>

            <div class="row">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'till'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'till', array('id'=>'datetime_2','class'=>'span12')); ?></div>
                </div>
            </div>

                <div class="row"><div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
            array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div></div>

        <?php $this->endWidget(); ?>
    </fieldset>

</div><!-- form -->
<script lang="javascript">
    $('#datetime').datetimepicker({
        dateFormat : "dd.mm.yy"
    });
    $('#datetime_2').datetimepicker();
</script>