<?php
/* @var $this CabinetController */

    $this->breadcrumbs=array(
            'Tours',
    );
    
    $this->menu = array(
        array('label' => Yii::t('RushModule.cabinet', 'Olympiad')),
        array('label' => Yii::t('RushModule.cabinet', 'All tours'), 'url' => Yii::app()->createUrl('rush/cabinet/all'), 'icon' => 'road'),
        array('label' => Yii::t('RushModule.cabinet', 'Active tours'),
            'template' => '{menu}',
            'url' => Yii::app()->createUrl('rush/cabinet/active'), 'icon' => 'time'),
        array('label' => Yii::t('RushModule.cabinet', 'Results'), 'url' => Yii::app()->createUrl('rush/cabinet/results'), 'icon' => 'tasks'),
    );

   $assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.rush.assets'));

   Yii::app()->clientScript->registerCssFile($assetsUrl.'/cabinet.css');
   
    $type = Tour::types()[$data->type];

    $from = Yii::app()->dateFormatter->formatDateTime($data->from, 'long', 'short');

    $till = Yii::app()->dateFormatter->formatDateTime($data->till, 'long', 'short');

?>

<div class="container-fluid margin-10">
  <div class="row-fluid">
    <div class="span3 block">
      <?php $this->renderPartial('sidebar', array('adv'=>$this->menu)); ?>
    </div>
    <div class="span9 well block">
        <div class="element">
            <div class="page-header">
                <h1><?php echo $data->name; ?> <small><?php echo Category::getName($data->category_id); ?></small></h1>
            </div>

        <?php $this->widget('bootstrap.widgets.TbDetailView', array(
            'data'=>$data,
            'attributes'=>array(
                array('name'=>'description', 'label'=>Yii::t('RushModule.cabinet', 'Description')),
                array('name'=>'type', 'label'=>Yii::t('RushModule.cabinet', 'Type'), 'value'=>$type),
                array('name'=>'from', 'label'=>Yii::t('RushModule.cabinet', 'From'), 'value' => $from),
                array('name'=>'till', 'label'=>Yii::t('RushModule.cabinet', 'Till'), 'value' => $till),
            ),
        ));?>
            <?php
                $criteria = new CDbCriteria;
                $criteria->condition = '`user_id` = :user_id AND `tour_id` = :tour_id';
                $criteria->params = array(':user_id' => Yii::app()->user->id, ':tour_id' => $data->id);
                if(Tour::isActive($data->id) == true && Results::model()->count($criteria) < 1): ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>Yii::t('RushModule.cabinet', 'Take part'),
                    'type'=>'primary', 
                    'size'=>'normal', 
                    'htmlOptions' => array('class'=>'center'),
                    'url' => Yii::app()->createUrl('rush/cabinet/takepart', array('id' => $data->id)),
                )); ?>
            <?php elseif (Results::model()->count($criteria) >= 1): 
                $result = Results::model()->find($criteria);?>
                <div class="alert alert-info center"><?php echo Yii::t('RushModule.cabinet', 'You have got taken part in this tour and you got')?> 
                <span class="badge"><?php echo $result->points ?></span> <?php echo Yii::t('RushModule.cabinet', 'points')?></div>
            <?php endif; ?>
        </div>
    </div>
  </div>
</div>
