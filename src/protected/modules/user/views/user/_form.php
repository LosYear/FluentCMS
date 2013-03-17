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
<fieldset class="edit-form">
<div class="row">
    <div>
        <label><?php echo $form->labelEx($model,'username'); ?></label>
        <div class="column"><?php echo $form->textField($model, 'username'/*, /*array('class'=>'span12')*/); ?></div>
    </div>
</div>

<div class="row">
    <div>
        <label><?php echo $form->labelEx($model,'superuser'); ?></label>
        <div class="column"><?php echo $form->dropDownList($model, 'superuser',YumUser::itemAlias('AdminStatus')); ?></div>
    </div>
</div>

<div class="row">
    <div>
        <label><?php echo $form->labelEx($model,'status'); ?></label>
        <div class="column"><?php echo $form->dropDownList($model,'status',YumUser::itemAlias('UserStatus')); ?></div>
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

<div class="row buttons">
<?php $this->widget('bootstrap.widgets.TbButton', 
            array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?>
</div>
 </fieldset>
<?php $this->endWidget(); ?>
</div>
	<div style="clear:both;"></div>
