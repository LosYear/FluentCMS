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
        <h3><?php echo Yii::t('RushModule.moderator', 'Updating points'); ?></h3>
        <div class="form">

        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'block-form',
                'enableAjaxValidation'=>false,
        )); ?>

                <?php echo $form->errorSummary($model); ?>
                <fieldset class="edit-form">
                    <?php echo $form->labelEx($model,'points'); ?>
                    <?php echo $form->textField($model, 'points', array('class'=>'')); ?><br>

                   <?php $this->widget('bootstrap.widgets.TbButton', 
                    array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?>
                </fieldset>
        <?php $this->endWidget(); ?>

        </div><!-- form -->
    </div>
  </div>
</div>


<style>
    .edit-form label{
    margin-bottom: 0.8em;
    font-weight: bold;
    font-size: 16px;
    vertical-align: top;
    width: 9em;
    float: left;
    clear: left;
}
</style>