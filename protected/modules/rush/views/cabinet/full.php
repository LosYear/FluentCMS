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
   Yii::app()->clientScript->registerScriptFile($assetsUrl.'/full.js');
?>

<div class="container-fluid margin-10">
  <div class="row-fluid">
    <div class="span3 block">
      <?php $this->renderPartial('sidebar', array('adv'=>$this->menu)); ?>
    </div>
    <div class="span9 well block">
        <h3 class="center"><?php echo Category::getName($tour->category_id) ?><b> / </b>
                <?php echo $tour->name ?></h3>
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
                'id'=>'results-grid',
                'type'=>'striped condensed',
                'dataProvider'=>$tasks,
                'template'=>"{items}",
                //'filter'=>$dataProvider->model,
                'columns'=>array(
                array('name'=>'task', 'value'=>'Task::getFileTitle($data->id)'),
                array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'htmlOptions'=>array('style'=>'width: 40px'),
                        'buttons'=>array(
                            'download' => array(
                                'label' => Yii::t('RushModule.cabinet', 'Download'),
                                'url' => 'Yii::app()->createUrl("rush/cabinet/download", array("id"=>"$data->id"))',
                                'icon' => 'download-alt'
                            ),
                        ),
                        'template'=>'{download}',
                    ),
                ),
        )); ?>
        <?php
                $criteria = new CDbCriteria;
                $criteria->condition = '`user_id` = :user_id AND `tour_id` = :tour_id';
                $criteria->params = array(':user_id' => Yii::app()->user->id, ':tour_id' => $tour->id);
                if(Tour::isActive($tour->id) == true && Results::model()->count($criteria) < 1): ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>Yii::t('RushModule.cabinet', 'Send answer'),
                    'type'=>'primary', 
                    'size'=>'normal', 
                    'htmlOptions' => array('class'=>'center', 'id' => 'send'),
                )); 
        ?>
        <?php elseif (Results::model()->count($criteria) >= 1): 
            $result = Results::model()->find($criteria);?>
            <?php if ($result->points >= 0):?>
            <div class="alert alert-info center"><?php echo Yii::t('RushModule.cabinet', 'You have got taken part in this tour and you got')?> 
            <span class="badge"><?php echo $result->points ?></span> <?php echo Yii::t('RushModule.cabinet', 'points')?></div>
            <?php  else:?>
            <div class="alert alert-info center"><?php echo Yii::t('RushModule.cabinet', 'Your solve is on checking')?></div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
  </div>
</div>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"><?php echo Yii::t('RushModule.cabinet', 'Warning'); ?></h3>
  </div>
  <div class="modal-body">
    <p><?php echo Yii::t('RushModule.cabinet', 'All answers should be included into ONE file'); ?></p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo Yii::t('RushModule.cabinet', 'Cancel'); ?></button>
    <button class="btn btn-primary" id="continue"><?php echo Yii::t('RushModule.cabinet', 'Next'); ?></button>
  </div>
</div>
