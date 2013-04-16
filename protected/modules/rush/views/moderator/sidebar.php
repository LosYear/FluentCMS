<div class="well">
<?php 
    Yii::app()->getModule('mailbox');
    Yii::import('application.modules.mailbox.models.*');

    $items = array_merge(array(array('label'=>Yii::t('RushModule.moderator', 'Cabinet')),
        array('label'=>Yii::t('RushModule.moderator', 'Home'), 'icon'=>'home', 'url'=>Yii::app()->createUrl('rush/moderator'),),
        array('label'=>Yii::t('RushModule.cabinet', 'Messages').' ('.Mailbox::newMsgs(Yii::app()->user->id).')', 'icon'=>'envelope', 'url'=>Yii::app()->createUrl('mailbox/message')),
        array('label'=>Yii::t('RushModule.moderator', 'Results'), 'icon'=>'tasks', 'url'=>Yii::app()->createUrl('rush/moderator/results')),
        array('label'=>Yii::t('RushModule.moderator', 'Solves'), 'icon'=>'briefcase', 'url'=>Yii::app()->createUrl('rush/moderator/solves')),
        array('label'=>Yii::t('RushModule.moderator', 'Certificates'), 'icon'=>'certificate', 'url'=>Yii::app()->createUrl('rush/moderator/certificates')),), $adv);

    $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>$items,
)); ?>
</div>
