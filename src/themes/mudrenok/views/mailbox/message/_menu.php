<div class="well">
<?php 
    Yii::app()->getModule('rush');
    
    $items = array_merge(array(array('label'=>Yii::t('MailboxModule.main', 'Mailbox')),
        array('label'=>Yii::t('MailboxModule.main', 'Inbox'), 'icon'=>'inbox', 'url'=>Yii::app()->createUrl('mailbox/message/inbox'),),
        array('label'=>Yii::t('MailboxModule.main', 'Sent'), 'icon'=>'share-alt', 'url'=>Yii::app()->createUrl('mailbox/message/sent')),
        array('label'=>Yii::t('MailboxModule.main', 'Trash'), 'icon'=>'trash', 'url'=>Yii::app()->createUrl('mailbox/message/trash')),
        array('label'=>Yii::t('MailboxModule.main', 'New'), 'icon'=>'pencil', 'url'=>Yii::app()->createUrl('mailbox/message/new'))));

    $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array_merge(array(), $items),
)); ?>
</div>
