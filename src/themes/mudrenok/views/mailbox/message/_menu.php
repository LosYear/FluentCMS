<div class="well">
<?php 
    Yii::app()->getModule('rush');
    
    $main = array_merge(array(array('label'=>Yii::t('RushModule.cabinet', 'Cabinet')),
        array('label'=>Yii::t('RushModule.cabinet', 'Olympiad'), 'icon'=>'fire', 'url'=>Yii::app()->createUrl('rush/cabinet'),),
        array('label'=>Yii::t('RushModule.cabinet', 'Messages'), 'icon'=>'envelope', 'url'=>'#'),
        array('label'=>Yii::t('RushModule.cabinet', 'Profile'), 'icon'=>'user', 'url'=>Yii::app()->createUrl('profile/profile/update')),
        array('label'=>Yii::t('RushModule.cabinet', 'Password'), 'icon'=>'asterisk', 'url'=>'#'),
        array('label'=>Yii::t('RushModule.cabinet', 'Certificates'), 'icon'=>'certificate', 'url'=>'#'),));
    
    $items = array_merge(array(array('label'=>Yii::t('MailboxModule.main', 'Mailbox')),
        array('label'=>Yii::t('MailboxModule.main', 'Inbox'), 'icon'=>'inbox', 'url'=>Yii::app()->createUrl('mailbox/message/inbox'),),
        array('label'=>Yii::t('MailboxModule.main', 'Sent'), 'icon'=>'share-alt', 'url'=>Yii::app()->createUrl('mailbox/message/sent')),
        array('label'=>Yii::t('MailboxModule.main', 'Trash'), 'icon'=>'trash', 'url'=>Yii::app()->createUrl('mailbox/message/trash')),
        array('label'=>Yii::t('MailboxModule.main', 'New'), 'icon'=>'pencil', 'url'=>Yii::app()->createUrl('mailbox/message/new'))));

    $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array_merge($main, $items),
)); ?>
</div>
