<div class="form login-form">
<?php   $_form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'verticalForm',
	'htmlOptions' => array('class'=>'form-horizontal')
)); ?>
	<h1 class="title title_article"><?php echo Yii::t('main','Registration'); ?></h1><br/>
    <?= Yii::t('journal', 'All fields are required') ?><br/><br/>
	<?php echo $_form->errorSummary(array($form, $profile)); ?>
	<div class="form-group">
		<?= $_form->label($form, 'username', array('class'=>'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?= $_form->textField($form, 'username', array('class'=>'form-control')) ?>
		</div>
	</div>
	<div class="form-group">
		<?= $_form->label($profile, 'email', array('class'=>'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?= $_form->textField($profile, 'email', array('class'=>'form-control')) ?>
		</div>
	</div>
	<div class="form-group">
		<?= $_form->label($form, 'password', array('class'=>'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?= $_form->passwordField($form, 'password', array('class'=>'form-control')) ?>
		</div>
	</div>
	<div class="form-group">
		<?= $_form->label($form, 'verifyPassword', array('class'=>'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<?= $_form->passwordField($form, 'verifyPassword', array('class'=>'form-control')) ?>
		</div>
	</div>
	<?php if(extension_loaded('gd') 
			&& Yum::module('registration')->enableCaptcha): ?>
	<div class="form-group">
		<?= $_form->label($form, 'verifyCode', array('class'=>'col-lg-2 control-label')) ?>
		<div class="col-lg-8">
			<div class="col-lg-5" style="padding-left:0; padding-right:0"><?php echo $_form->textField($form,'verifyCode', array('class'=>'form-control')); ?></div>
			<div class="col-lg-5"><?php $this->widget('CCaptcha', array('buttonOptions' => array('class' => 'captcha-refresh'))); ?></div><br/>
		</div>
	</div>
	<?php endif; ?>
	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-10">
			<button type="submit" class="btn btn-default"><?= Yii::t('main','Registration') ?></button>
		</div>
	</div>
<?php $this->endWidget(); ?>
	</div>