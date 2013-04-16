<?php
/* @var $this CabinetController */

    $this->breadcrumbs=array(
            'Cabinet',
    );
    
   $assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.rush.assets'));

   Yii::app()->clientScript->registerCssFile($assetsUrl.'/cabinet.css');

?>

<div class="container-fluid margin-10">
  <div class="row-fluid">
    <div class="span3 block">
      <?php $this->renderPartial('sidebar', array('adv'=>array())); ?>
    </div>
    <div class="span9 well block">
        <div class="page-header">
            <h1><?php echo Tour::title($data->tour_id); ?> <small><?php echo Category::getName(Tour::getCategory($data->tour_id)); ?></small></h1>
        </div>
        <?php $this->widget('bootstrap.widgets.TbDetailView', array(
            'data'=>array('user'=>  YumProfile::getName($data->user_id), 'points'=>$data->points,),
            'attributes'=>array(
                array('name'=>'user', 'label'=> Yii::t('RushModule.moderator', 'Username')),
                array('name'=>'points', 'label'=>Yii::t('RushModule.moderator', 'Points')),
            ),
        )); ?>
        <h4 class="center"><?php echo Yii::t('RushModule.moderator', 'Answers'); ?></h4>
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'type'=>'striped bordered condensed',
            'dataProvider'=> new CArrayDataProvider($answers),
            'template'=>"{items}",
            'columns'=>array(
                array('name' => 'id', 'header' => '#'),
                array('name'=>'answer', 'header'=>Yii::t('RushModule.moderator', 'Answer'), 
                    'value' => '$data["answer"] =="undef" ? Yii::t("RushModule.moderator", "Skipped") : $data["answer"]'),
                array('name'=>'status', 'type'=>'html', 'header'=>Yii::t('RushModule.moderator', 'Status'),
                    'value' => '$data["status"] == "+" ? "<i class=\"icon-plus\"></i>" : "<i class=\"icon-minus\"></i>"'),
            ),
        )); ?>
    </div>
  </div>
</div>
