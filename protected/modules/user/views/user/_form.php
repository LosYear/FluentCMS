<?php 
	$cs=Yii::app()->getClientScript();
        $cs->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');
?>
<div class="form">
   <?php 
      $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
      			'id'=>'user-form',
      			'enableAjaxValidation'=>false));
      ?>
   <div class="note">
      <?php
         $models = array($model, $passwordform);
         if(isset($profile) && $profile !== false)
         	$models[] = $profile;
         	echo CHtml::errorSummary($models);
         	?>
   </div>
   <div class="row-fluid">
      <div>
         <label><?php echo $form->labelEx($model,'username'); ?></label>
         <div class="column"><?php echo $form->textField($model, 'username', array('class'=>'span9',
                            'data-title'=>Yii::t('admin', 'Username'), 
                            'data-content'=>Yii::t('popover', 'Should contain only letters and "_"'),
                            'rel'=>'popover')); ?></div>
      </div>
   </div>
   <div class="row-fluid">
      <div>
         <label><?php echo $form->labelEx($model,'superuser'); ?></label>
         <div class="column"><?php echo $form->dropDownList($model, 'superuser',YumUser::itemAlias('AdminStatus'),array('class'=>'span4',
                            'data-title'=>Yii::t('admin', 'Superuser'), 
                            'data-content'=>Yii::t('popover', 'User administrator or not'),
                            'rel'=>'popover')); ?></div>
      </div>
   </div>
   <div class="row-fluid">
      <div>
         <label><?php echo $form->labelEx($model,'status'); ?></label>
         <div class="column"><?php echo $form->dropDownList($model,'status',YumUser::itemAlias('UserStatus'),array('class'=>'span4',
                            'data-title'=>Yii::t('admin', 'Status'), 
                            'data-content'=>Yii::t('popover', 'Status of user'),
                            'rel'=>'popover')); ?></div>
      </div>
   </div>
   <!-- <?php if(Yum::hasModule('role')) { 
      Yii::import('application.modules.role.models.*');
      ?>
      <div class="row roles">
      <p> <?php echo Yum::t('User belongs to these roles'); ?> </p>
      
      	<?php $this->widget('YumModule.components.Relation', array(
         'model' => $model,
         'relation' => 'roles',
         'style' => 'dropdownlist',
         'fields' => 'title',
         'showAddButton' => false
         )); ?>
      </div>
      <?php } ?>-->
   <?php $this->renderPartial('/user/passwordfields', array(
      'form'=>$passwordform)); ?>
   <?php if(Yum::hasModule('profile')) 
      $this->renderPartial('application.modules.profile.views.profile._form', array(
      			'profile' => $profile)); ?>
   <div class="row-fluid buttons">
      <?php $this->widget('bootstrap.widgets.TbButton', 
         array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?>
   </div>
   <?php $this->endWidget(); ?>
</div>
<div style="clear:both;"></div>