<?php
	$newMsgs = $this->module->getNewMsgs();
	$action = $this->getAction()->getId();

	if ($this->module->authManager) {
		$authNew = Yii::app()->user->checkAccess("Mailbox.Message.New");
		$authInbox = Yii::app()->user->checkAccess("Mailbox.Message.Inbox");
		$authSent = Yii::app()->user->checkAccess("Mailbox.Message.Sent");
		$authTrash = Yii::app()->user->checkAccess("Mailbox.Message.Trash");
	} else {
		$authNew = $this->module->sendMsgs && (!$this->module->readOnly || $this->module->isAdmin());
		$authInbox = (!$this->module->readOnly || $this->module->isAdmin());
		$authTrash = $this->module->trashbox && (!$this->module->readOnly || $this->module->isAdmin());
		$authSent = $this->module->sentbox && (!$this->module->readOnly || $this->module->isAdmin());
	}
?>
	<!--<div class="mailbox-menu  ui-helper-clearfix">
		<div class="mailbox-menu-folders ui-helper-clearfix">
			<?php
				if ($authInbox):?>
					<div id="mailbox-inbox"
					     class="mailbox-menu-item <?php echo ($action == 'inbox') ? 'mailbox-menu-current' : ''; ?>">
						<a href="<?php echo $this->createUrl('message/inbox'); ?>">Inbox <span
								class="mailbox-new-msgs"><?php echo $newMsgs ? '(' . $newMsgs . ')' : null; ?></span></a>
					</div>
				<?php endif;
				if ($authSent) : ?>
					<div id="mailbox-sent"
					     class="mailbox-menu-item <?php if ($action == 'sent') echo 'mailbox-menu-current '; ?>">
						<a href="<?php echo $this->createUrl('message/sent'); ?>">Sent Mail</a>
					</div>
				<?php endif;
				if ($authTrash) : ?>
					<div id="mailbox-trash"
					     class="mailbox-menu-item <?php if ($action == 'trash') echo 'mailbox-menu-current '; ?>">
						<a href="<?php echo $this->createUrl('message/trash'); ?>">Trash </a>
					</div>
				<?php endif; ?>
		</div>
		<?php
			if ($authNew) :
				?>
				<div class="mailbox-menu-newmsg  ui-helper-clearfix" align="center">
					<span><a href="<?php echo $this->createUrl('message/new'); ?>">New Message</a></span>
				</div>
			<?php endif; ?>

	</div>-->

<?php
	$inbox_array = array();
	$sent_array = array();
	$trash_array = array();
	$new_array = array();
	if ($authInbox) {
		$inbox_array =
			array('label' => Yii::t('MailboxModule.main', 'Inbox'), 'url' => array('message/inbox'), 'icon' => 'inbox black');
	}
	if ($authSent) {
		$sent_array =
			array('label' => Yii::t('MailboxModule.main', 'Sent'), 'url' => array('message/sent'), 'icon' => 'share black');
	}
	if ($authTrash) {
		$trash_array =
			array('label' => Yii::t('MailboxModule.main', 'Trash'), 'url' => array('message/trash'), 'icon' => 'trash black');
	}
	if ($authNew) {
		$new_array =
			array('label' => Yii::t('MailboxModule.main', 'New message'), 'url' => array('message/new'), 'icon' => 'pencil black');
	}

	$this->menu = array(
		$inbox_array,
		$sent_array,
		$trash_array,
		$new_array
	);
?>