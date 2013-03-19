<div class="row-fluid">
    <div>
        <label><?php echo CHtml::activeLabelEx($form,'password'); ?></label>
        <div class="column"><?php echo CHtml::activePasswordField($form,'password', array('class' => 'span9')); ?></div>
    </div>
</div>

<div class="row-fluid">
    <div>
        <label><?php echo CHtml::activeLabelEx($form,'verifyPassword'); ?></label>
        <div class="column"><?php echo CHtml::activePasswordField($form,'verifyPassword', array('class' => 'span9')); ?></div>
    </div>
</div>

