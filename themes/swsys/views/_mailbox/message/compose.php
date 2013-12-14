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
			'htmlOptions' => array('autocomplete' => $this->createUrl('ajax/auto')),
		)); ?>
	<div class="form message-create">

		<div class="mailbox-input-row">
			<div style="float:left">
				<?php echo CHtml::activeLabelEx($conv, 'to'); ?>
			</div>
			<div style="margin-left:80px">
				<?php if(Yii::app()->user->isAdmin()): ?>
				<?php echo $form->textField($conv, 'to', array('style' => 'width:100%;', 'id' => 'message-to', 'class' => 'mailbox-input', 'edit' => $this->module->editToField ? '1' : null,
				)); ?>
				<?php echo $form->error($conv, 'to'); ?>


				<?php

					if ($this->module->userSupportList) {

						$reps = $this->module->getUserSupportList();
						echo '<select name="ajax[to]" class="mailbox-support-list" edit="' . (($this->module->editToField) ? '1' : null) . '" >';
						foreach ($reps as $key => &$label) {
							?>
							<option type="hidden" value="<?php echo $key; ?>"><?php echo $label; ?></option>
						<?php
						}
						echo '</select>';
					}
				?>
				<?php else: ?>
					<?php echo $form->dropDownList($conv ,'to', $this->module->getAdmins()); ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="mailbox-input-row">
			<div style="float:left">
				<?php echo CHtml::activeLabelEx($conv, 'subject', array('class' => 'mailbox-label')); ?>
			</div>
			<div class="mailbox-compose-inputwrap">
				<?php echo $form->textField($conv, 'subject', array('class' => 'mailbox-input span12', 'placeholder' => Yii::t('MailboxModule.main', $this->module->defaultSubject))); ?>
				<?php echo $form->error($conv, 'subject'); ?>
			</div>
		</div>
		<div class="mailbox-textarea-wrap">
			<?php echo $form->textArea($msg, 'text', array('cols' => 50, 'rows' => 7, 'class' => 'mailbox-message-input', 'style' => 'width:100%;', 'placeholder' => Yii::t('MailboxModule.main', 'Enter message here...'))); ?>
			<?php echo $form->error($msg, 'text'); ?>
		</div>
		<div>
			<button
				class="btn btn-large message-btn-reply"><?php echo Yii::t('MailboxModule.main', 'Send message'); ?></button>
		</div>
	</div>
	<?php $this->endWidget(); ?><!-- form -->

</div>
