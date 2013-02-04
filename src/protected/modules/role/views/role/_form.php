<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
           // 'id'=>'block-form',
            'enableAjaxValidation'=>false,
    )); ?>
    <?php echo $form->errorSummary($model); ?>
    <fieldset class="edit-form">
        <div class="row">
            <div>
                <div class="column span-4"><?php echo $form->labelEx($model,'title'); ?></div>
                <div class="column span-12"><?php echo $form->textField($model, 'title', array('class'=>'span12')); ?></div>
            </div>
        </div>

        <div class="row">
            <div>
                <div class="column span-4"><?php echo $form->labelEx($model,'description'); ?></div>
                <div class="column span-12"><?php echo $form->textArea($model, 'description', array('rows' => '6', 'cols'=>'50' )); ?></div>
            </div>
        </div>	

        <div class="row">
            <div>
                <div class="column span-4"><?php echo CHtml::label(Yum::t('This users have been assigned to this role'), ''); ?></div>
                <div class="column span-4">
                <?php 
                $this->widget('YumModule.components.Relation', array(
                                        'model' => $model,
                                        'relation' => 'users',
                                        'style' => 'dropdownlist',
                                        'fields' => 'username',
                                        'htmlOptions' => array(
                                                'checkAll' => Yum::t('Choose All'),
                                                'template' => '<div style="float:left;margin-right:5px;">{input}</div>{label}'),
                                        'showAddButton' => false
                                        ));  
                ?></div>
            </div>
        </div>

       <!-- <?php if(Yum::hasModule('membership')) { ?>
        <div class="row">
        <?php echo CHtml::activeLabelEx($model,'is_membership_possible'); ?>
        <?php echo CHtml::activeCheckBox($model, 'is_membership_possible'); ?>

        </div>
        <div class="membership">
        <div class="row">
        <?php echo CHtml::activeLabelEx($model,'price'); ?>
        <?php echo CHtml::activeTextField($model, 'price'); ?>
        <?php echo CHtml::Error($model, 'price'); ?>
        </div>
        <div class="hint"> 
        <?php echo Yum::t('How expensive is a membership? Set to 0 to disable membership for this role'); ?>
        </div>

        <div class="row">
        <?php echo CHtml::activeLabelEx($model,'duration'); ?>
        <?php echo CHtml::activeTextField($model, 'duration'); ?>
        <?php echo CHtml::Error($model, 'duration'); ?>
        </div>
        <div class="hint"> 
        <?php echo Yum::t('How many days will the membership be valid after payment?'); ?>
        </div>

        </div>
        <?php Yii::app()->clientScript->registerScript('membership_toggle', "
                if(!$('#YumRole_is_membership_possible').attr('checked'))
                        $('.membership').hide();
                $('#YumRole_is_membership_possible').click(function() {
                $('.membership').toggle(500);
        });
        "); ?>
        <div style="clear: both;"> </div>
        <?php } ?> -->

        <div class="row">
            <div class="column span-1">
            <?php $this->widget('bootstrap.widgets.TbButton', 
            array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Save'))); ?>
            </div>
        </div>
    </fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->
