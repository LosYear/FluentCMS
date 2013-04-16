<div class="row-fluid">
    <div>
        <label><?php echo CHtml::activeLabelEx($form,'password'); ?></label>
        <div class="column"><?php echo CHtml::activePasswordField($form,'password', array('class' => 'span9',
                            'data-title'=>Yii::t('admin', 'Password'), 
                            'data-content'=>Yii::t('popover', 'Enter new password. Please, leave field blank for keeping old pass.'),
                            'rel'=>'popover')); ?></div>
    </div>
</div>

<div class="row-fluid">
    <div>
        <label><?php echo CHtml::activeLabelEx($form,'verifyPassword'); ?></label>
        <div class="column"><?php echo CHtml::activePasswordField($form,'verifyPassword', array('class' => 'span9',
                            'data-title'=>Yii::t('admin', 'Verify'), 
                            'data-content'=>Yii::t('popover', 'Verify your password.'),
                            'rel'=>'popover')); ?></div>
    </div>
</div>

