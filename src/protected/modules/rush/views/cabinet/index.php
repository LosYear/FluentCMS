<?php
/* @var $this CabinetController */

    $this->breadcrumbs=array(
            'Cabinet',
    );
    
    $this->menu = array(
        array('label' => Yii::t('RushModule.cabinet', 'Olympiad')),
        array('label' => Yii::t('RushModule.cabinet', 'All tours'), 'url' => Yii::app()->createUrl('rush/cabinet/all'), 'icon' => 'road'),
        array('label' => Yii::t('RushModule.cabinet', 'Active tours'), 'url' => Yii::app()->createUrl('rush/cabinet/active'), 'icon' => 'time'),
        array('label' => Yii::t('RushModule.cabinet', 'Results'), 'url' => Yii::app()->createUrl('rush/cabinet/results'), 'icon' => 'tasks'),
    );

   $assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.rush.assets'));

   Yii::app()->clientScript->registerCssFile($assetsUrl.'/cabinet.css');

?>

<div class="container-fluid margin-10">
  <div class="row-fluid">
    <div class="span3 block">
      <?php $this->renderPartial('sidebar', array('adv'=>$this->menu)); ?>
    </div>
    <div class="span9 well block">
123
    </div>
  </div>
</div>