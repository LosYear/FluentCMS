<?php
	$this->breadcrumbs = array(
		ucfirst($this->module->id) => array('inbox'),
		ucfirst($this->getAction()->getId())
	);
	$this->renderpartial('_menu');

?>
<div class="mailbox-compose ui-helper-clearfix">

	<?php

		$this->renderPartial('_flash');


		$form = $this->beginWidget('CActiveForm', array(
			'id' => 'message-form',
			'enableAjaxValidation' => false,
			'htmlOptions' => array('autocomplete' => $this->createUrl('ajax/auto'), 'class' => 'form-horizontal'),
		)); ?>
	<div class="form message-create">
		<div class="form-group">
			<?= $form->label($conv, 'to', array('class' => 'col-lg-2 control-label')) ?>
			<div class="col-lg-8">
				<?php if(Yii::app()->user->isAdmin()): ?>
					<?php echo $form->textField($conv, 'to', array('style' => 'width:100%;', 'id' => 'message-to', 'class' => 'mailbox-input form-control', 'edit' => $this->module->editToField ? '1' : null,
					)); ?>
					<?php echo $form->error($conv, 'to'); ?>


					<?php

					if ($this->module->userSupportList) {

						$reps = $this->module->getUserSupportList();
						echo '<select name="ajax[to]" class="mailbox-support-list form-control" edit="' . (($this->module->editToField) ? '1' : null) . '" >';
						foreach ($reps as $key => &$label) {
							?>
							<option type="hidden" value="<?php echo $key; ?>"><?php echo $label; ?></option>
						<?php
						}
						echo '</select>';
					}
					?>
				<?php else: ?>
					<?php echo $form->dropDownList($conv ,'to', $this->module->getAdmins(), array('class' => 'form-control')); ?>
				<?php endif; ?>
			</div>
		</div>

		<div class="form-group">
			<?= $form->label($conv, 'subject', array('class' => 'col-lg-2 control-label')) ?>
			<div class="col-lg-8">
				<?php echo $form->textField($conv, 'subject', array('class' => 'mailbox-input form-control', 'placeholder' => Yii::t('MailboxModule.main', $this->module->defaultSubject))); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-lg-offset-2 col-lg-8">
				<?php echo $form->textArea($msg, 'text', array('cols' => 50, 'rows' => 7, 'class' => 'mailbox-message-input form-control', 'style' => 'width:100%;', 'placeholder' => Yii::t('MailboxModule.main', 'Enter message here...'))); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-lg-offset-2 col-lg-2">
				<button type="submit" class="btn btn-default"><?= Yii::t('MailboxModule.main', 'Send message') ?></button>
			</div>
		</div>
	</div>
	<?php $this->endWidget(); ?><!-- form -->

</div>
