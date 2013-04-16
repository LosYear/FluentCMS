<?php 
	$cs=Yii::app()->getClientScript();
        $cs->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');
?>
<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'task-form',
        'htmlOptions' => array('enctype'=>'multipart/form-data',),
	'enableAjaxValidation'=>false,
)); 

    $assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.rush.assets'));
    Yii::app()->clientScript->registerScriptFile($assetsUrl.'/jquery.json-2.4.min.js', CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile($assetsUrl.'/task_create.js', CClientScript::POS_HEAD);
    
    $cs=Yii::app()->getClientScript();
    $cs->registerScriptFile(Yii::app()->baseUrl.'/js/ckeditor/ckeditor.js');
    
    $adv = json_decode($model->advanced, true);
    
    if (!isset($adv['title']))
           $adv['title'] = '';
?>
    <?php echo $form->errorSummary($model); ?>
        <div class="row-fluid">
            <div>
                <div class="column span-4"><?php echo $form->labelEx($model,'tour_id'); ?></div>
                <div class="column span-12"><?php echo $form->dropDownList($model, 'tour_id', Tour::dropDown(), array('class'=>'span5',
                            'data-title'=>Yii::t('RushModule.admin', 'Tour'), 
                            'data-content'=>Yii::t('RushModule.popover', 'Select tour which task belongs. Question type will be selected automaticly'),
                            'rel'=>'popover')); ?></div>
            </div>
        </div>
        <div class="column span-12"><?php echo $form->hiddenField($model, 'type',array('class'=>'span5', 'id' => 'task-type')); ?></div>

        <div id="task-text-div" class="row-fluid">
            <div>
                <div class="column span-4"><?php echo $form->labelEx($model,'task'); ?></div>
                <div class="column span-12"><?php echo CHtml::textArea('task-text', $model->task, array('class'=>'ckeditor span12')); ?></div>
            </div>
        </div>
        
        <div id="task-text-div" class="row-fluid">
            <div>
                <div class="column span-4"><?php echo CHtml::label(Yii::t('RushModule.admin', 'Points'), 'points'); ?></div>
                <div class="column span-12"><?php echo CHtml::textField('points', '', array('id'=>'points',' class'=>'span5',
                            'data-title'=>Yii::t('RushModule.admin', 'Points'), 
                            'data-content'=>Yii::t('RushModule.popover', 'How much points will get user after right answer'),
                            'rel'=>'popover')); ?></div>
            </div>
        </div>
        
        <div id="task-text-div" class="row-fluid">
            <div>
                <div class="column span-4"><?php echo CHtml::label(Yii::t('RushModule.admin', 'Time'), 'points'); ?></div>
                <div class="column span-12"><?php echo CHtml::textField('time', '', array('id'=>'time', 'class'=>'span5',
                            'data-title'=>Yii::t('RushModule.admin', 'Time'), 
                            'data-content'=>Yii::t('RushModule.popover', 'Enter time for solving task in seconds'),
                            'rel'=>'popover')); ?></div>
            </div>
        </div>
        
        <div id="task-text-div" class="row-fluid">
            <div>
                <div class="column span-4"><?php echo CHtml::label(Yii::t('RushModule.admin', 'Right Answer'), 'points'); ?></div>
                <div class="column span-12"><?php echo CHtml::textField('right_answer', '', array('id'=>'right_answer', 'class'=>'span5',
                            'data-title'=>Yii::t('RushModule.admin', 'Right Answer'), 
                            'data-content'=>Yii::t('RushModule.popover', 'Enter number of right answer'),
                            'rel'=>'popover')); ?></div>
            </div>
        </div>
        
        <div id="task-text-div" class="row-fluid">
            <div>
                <div class="column span-4"><?php echo CHtml::label(Yii::t('RushModule.admin', 'Answers'), 'answers'); ?></div>
                <div class="column"><a href="#" id="answer-add"class="icon-plus"></a></div>
            </div>
            <fieldset id="answers">
                
            </fieldset>
        </div>
        
        <div id="file-field-div" class="row-fluid">
            <div>
                <div class="column span-4"><?php echo $form->labelEx($model,'task'); ?></div>
                <div class="column span-12"><?php echo CHtml::fileField('task-file', '', array('class'=>'',
                            'data-title'=>Yii::t('RushModule.admin', 'Task'), 
                            'data-content'=>Yii::t('RushModule.popover', 'Select task file for uploading. Only doc(x), rtf and txt'),
                            'rel'=>'popover')); ?></div>
            </div>
        </div>
        
        <div id="file-field-div" class="row-fluid">
            <div>
                <div class="column span-4"><?php echo CHtml::label(Yii::t('RushModule.admin', 'Title'), 'title');; ?></div>
                <div class="column span-12"><?php echo CHtml::textField('title', $adv['title'], array('class'=>'span9',
                            'data-title'=>Yii::t('RushModule.admin', 'Title'), 
                            'data-content'=>Yii::t('RushModule.popover', 'Select title of the task shown to user'),
                            'rel'=>'popover')); ?></div>
            </div>
        </div>
       <?php echo $form->hiddenField($model, 'advanced', array('id' => 'adv-hidden')); ?>
        

        <div class="row-fluid"><div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
            array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div></div>

<?php $this->endWidget(); ?>
    <script lang="javascript">
        var type_url  = "<?php echo Yii::app()->createUrl('rush/task/type'); ?>"
    </script>
</div><!-- form -->