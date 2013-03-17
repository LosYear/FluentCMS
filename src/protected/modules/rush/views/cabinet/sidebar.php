<div class="well">
<?php 

    $items = array_merge(array(array('label'=>Yii::t('RushModule.cabinet', 'Cabinet')),
        array('label'=>Yii::t('RushModule.cabinet', 'Olympiad'), 'icon'=>'fire', 'url'=>Yii::app()->createUrl('rush/cabinet'),),
        array('label'=>Yii::t('RushModule.cabinet', 'Messages'), 'icon'=>'envelope', 'url'=>Yii::app()->createUrl('mailbox/message')),
        array('label'=>Yii::t('RushModule.cabinet', 'Profile'), 'icon'=>'user', 'url'=>Yii::app()->createUrl('profile/profile/update')),
        array('label'=>Yii::t('RushModule.cabinet', 'Password'), 'icon'=>'asterisk', 'url'=>'#'),
        array('label'=>Yii::t('RushModule.cabinet', 'Certificates'), 'icon'=>'certificate', 'url'=>'#'),), $adv);

    $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>$items,
)); ?>
</div>
