<div class="well">
<?php 
    Yii::app()->getModule('mailbox');
    Yii::import('application.modules.mailbox.models.*');
    $items = array_merge(array(array('label'=>Yii::t('RushModule.cabinet', 'Cabinet')),
        array('label'=>Yii::t('RushModule.cabinet', 'Olympiad'), 'icon'=>'fire', 'url'=>Yii::app()->createUrl('rush/cabinet'),),
        array('label'=>Yii::t('RushModule.cabinet', 'Messages').' ('.Mailbox::newMsgs(Yii::app()->user->id).')', 'icon'=>'envelope', 'url'=>Yii::app()->createUrl('mailbox/message')),
        array('label'=>Yii::t('RushModule.cabinet', 'Profile'), 'icon'=>'user', 'url'=>Yii::app()->createUrl('profile/profile/update')),
    //    array('label'=>Yii::t('RushModule.cabinet', 'Password'), 'icon'=>'asterisk', 'url'=>Yii::app()->createUrl('user/user/changepassword')),
        array('label'=>Yii::t('RushModule.cabinet', 'Certificates'), 'icon'=>'certificate', 'url'=>Yii::app()->createUrl('rush/cabinet/certificates')),), $adv);

    $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>$items,
)); ?>
</div>
