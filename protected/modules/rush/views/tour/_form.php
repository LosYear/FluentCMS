<?php 
	$cs=Yii::app()->getClientScript();
        $cs->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');
?>
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

            <?php echo $form->errorSummary($model); ?>

            <div class="row-fluid">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'name'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'name', array('class'=>'span9' ,
                            'data-title'=>Yii::t('RushModule.admin', 'Name'), 
                            'data-content'=>Yii::t('RushModule.popover', 'Name of tour shown to user'),
                            'rel'=>'popover')); ?></div>
                </div>
            </div>

            <div class="row-fluid">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'description'); ?></div>
                    <div class="column span-12"><?php echo $form->textArea($model, 'description', array('class'=>'span9' ,
                            'data-title'=>Yii::t('RushModule.admin', 'Description'), 
                            'data-content'=>Yii::t('RushModule.popover', 'Description of tour. Here you can write a little more about tour'),
                            'rel'=>'popover')); ?></div>
                </div>
            </div>

            <div class="row-fluid">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'category_id'); ?></div>
                    <div class="column span-12"><?php echo $form->dropDownList($model, 'category_id', Category::dropDown(), array('class'=>'span5' ,
                            'data-title'=>Yii::t('RushModule.admin', 'Category'), 
                            'data-content'=>Yii::t('RushModule.popover', 'Select category which tour belongs to'),
                            'rel'=>'popover')); ?></div>
                </div>
            </div>

            <div class="row-fluid">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'type'); ?></div>
                    <div class="column span-12"><?php echo $form->dropDownList($model, 'type', Tour::types(),array('class'=>'span5' ,
                            'data-title'=>Yii::t('RushModule.admin', 'Type'), 
                            'data-content'=>Yii::t('RushModule.popover', 'Select type of tour. Select test for creating test questions.'),
                            'rel'=>'popover')); ?></div>
                </div>
            </div>

            <div class="row-fluid">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'from'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'from', array('id'=>'datetime', 'class'=>'span9' ,
                            'data-title'=>Yii::t('RushModule.admin', 'From'), 
                            'data-content'=>Yii::t('RushModule.popover', 'Click for selecting date. Select date when tour will begin.'),
                            'rel'=>'popover')); ?></div>
                </div>
            </div>

            <div class="row-fluid">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'till'); ?></div>
                    <div class="column span-12"><?php echo $form->textField($model, 'till', array('id'=>'datetime_2','class'=>'span9' ,
                            'data-title'=>Yii::t('RushModule.admin', 'Till'), 
                            'data-content'=>Yii::t('RushModule.popover', 'Click for selecting date. Select date when tour will end.'),
                            'rel'=>'popover')); ?></div>
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