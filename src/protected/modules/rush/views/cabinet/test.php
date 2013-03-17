<?php
/* @var $this CabinetController */

    $this->breadcrumbs=array(
            'Tours',
    );
    

   $assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.rush.assets'));

   Yii::app()->clientScript->registerCssFile($assetsUrl.'/cabinet.css');
   Yii::app()->clientScript->registerScriptFile($assetsUrl.'/jquery.countDown.js');
   Yii::app()->clientScript->registerScriptFile($assetsUrl.'/jquery.json-2.4.min.js');
   Yii::app()->clientScript->registerScriptFile($assetsUrl.'/test.js');
   

?>

<div class="container-fluid margin-10">
  <div class="row-fluid">
    <div class="span12 well block">
        <div class="test-content">
            <center><h4>
                <?php echo Yii::t('RushModule.cabinet', "Press the button below when you are ready. Remember, you won't be able to return to previous question."); ?>
            </h4>
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>Yii::t('RushModule.cabinet','Start'),
                'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size'=>'normal', // null, 'large', 'small' or 'mini'
                'htmlOptions' => array('class'=>'margin-10', 'id' => 'start-button'),
                'icon' => 'fire white',
            )); ?>
            </center>
        </div>
    </div>
  </div>
</div>

<script lang="javascript">
    ajaxUrl = "<?php echo Yii::app()->createUrl('rush/test')?>";
    tour_id = <?php echo $tour->id ?>;
    buttonCaption = "<?php echo Yii::t('RushModule.cabinet','Next question')?>";
    congratulations = "<?php echo Yii::t('RushModule.cabinet','You got')?>";
    points = "<?php echo Yii::t('RushModule.cabinet','points')?>";
</script>