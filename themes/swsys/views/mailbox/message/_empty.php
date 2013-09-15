<?php $emptyText = 'You have no mail in your '.$this->getAction()->getId().' folder.';
    $emptyText = Yii::t('MailboxModule.main', $emptyText); ?>

<div class="mailbox-empty"><?php echo $emptyText ?></div>