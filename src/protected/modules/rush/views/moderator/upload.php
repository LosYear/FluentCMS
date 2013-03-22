<?php
/* @var $this CabinetController */

    $this->menu = array(
        array('label' => Yii::t('RushModule.moderator', 'Certificates')),
        array('label' => Yii::t('RushModule.moderator', 'Manage'), 'url' => Yii::app()->createUrl('rush/moderator/certificates'), 'icon' => 'list'),
        array('label' => Yii::t('RushModule.moderator', 'Upload certificate'), 'url' => Yii::app()->createUrl('rush/moderator/addCertificate'), 'icon' => 'upload'),
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
    <div class="page-header">
        <h1><?php echo Yii::t('RushModule.moderator', 'Certificate'); ?> <small><?php echo Yii::t('RushModule.moderator', 'Upload');?></small></h1>
    </div>
        <div class="form">
            <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'certificate-form',
                'htmlOptions' => array('enctype'=>'multipart/form-data',),
                'enableAjaxValidation'=>false,
            )); ?>
            <?php echo $form->errorSummary($model); ?>
            <fieldset class="edit-form">
                <div>
                    <div class="column span-4"><?php echo $form->labelEx($model,'user_id'); ?>
                    <?php echo $form->dropDownList($model, 'user_id', YumUser::dropDown()); ?></div>
                </div>
                
                <div id="file-field-div" class="">
                    <div>
                        <div class="column span-4"><?php echo $form->labelEx($model,'file_name'); ?>
                        <?php echo $form->fileField($model, 'file_name'); ?></div>
                    </div>
                </div>
                <div class=""><div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
            array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div></div>
            </fieldset>
            <?php $this->endWidget(); ?>
        </div>
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