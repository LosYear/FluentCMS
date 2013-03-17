<h2> <?php echo Yii::t('main','Registration'); ?> </h2>

<?php $this->breadcrumbs = array(Yii::t('main','Registration')); ?>

<!--<div class="form">
<?php $activeform = $this->beginWidget('CActiveForm', array(
			'id'=>'registration-form',
			'enableAjaxValidation'=>true,
			'enableClientValidation'=>true,
			'focus'=>array($form,'username'),
			));
?>

<?php echo Yum::requiredFieldNote(); ?>
<?php echo CHtml::errorSummary(array($form, $profile)); ?>

<div class="row"> <?php
echo $activeform->labelEx($form,'username');
echo $activeform->textField($form,'username');
?> </div>

<div class="row"> <?php
echo $activeform->labelEx($profile,'email');
echo $activeform->textField($profile,'email');
?> </div>  

<div class="row">
<?php echo $activeform->labelEx($form,'password'); ?>
<?php echo $activeform->passwordField($form,'password'); ?>
</div>

<div class="row">
<?php echo $activeform->labelEx($form,'verifyPassword'); ?>
<?php echo $activeform->passwordField($form,'verifyPassword'); ?>
</div>
-
<?php if(extension_loaded('gd') 
			&& Yum::module('registration')->enableCaptcha): ?>
	<div class="row">
		<?php echo CHtml::activeLabelEx($form,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo CHtml::activeTextField($form,'verifyCode'); ?>
		</div>
		<p class="hint">
		<?php echo Yum::t('Please enter the letters as they are shown in the image above.'); ?>
		<br/><?php echo Yum::t('Letters are not case-sensitive.'); ?></p>
	</div>
	<?php endif; ?>
	
	<div class="row submit">
		<?php echo CHtml::submitButton(Yum::t('Registration')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

<div class="form">
<?php   $_form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
 
<div class="row"><?php echo $_form->textFieldRow($form, 'username', array('class'=>'span3')); ?></div>
<div class="row"><?php echo $_form->textFieldRow($profile, 'email', array('class'=>'span3')); ?></div>
    
<div class="row"><?php echo $_form->passwordFieldRow($form, 'password', array('class'=>'span3')); ?></div>
<div class="row"><?php echo $_form->passwordFieldRow($form, 'verifyPassword', array('class'=>'span3')); ?></div>

<?php if(extension_loaded('gd') 
			&& Yum::module('registration')->enableCaptcha): ?>
<div class="row">
        <div>
        <?php $this->widget('CCaptcha'); ?>
        <?php echo $_form->textFieldRow($form,'verifyCode', array('class'=>'span3')); ?>
        </div>
        <p class="hint">
        <?php echo Yum::t('Please enter the letters as they are shown in the image above.'); ?>
        <br/><?php echo Yum::t('Letters are not case-sensitive.'); ?></p>
</div>
<?php endif; ?>

<div class="row"><?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary','buttonType'=>'submit', 'label'=>Yum::t('Submit'))); ?></div>
 
<?php $this->endWidget(); ?>
    
</div>
