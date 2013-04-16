<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Compose Message"); ?>
<?php
	$this->breadcrumbs=array(
		MessageModule::t("Messages"),
		MessageModule::t("Compose"),
	);
        
                $this->menu = array(
            array('label'=>Yii::t('author', 'Inbox'), 'url' => $this->createUrl('inbox/'), 'icon' => 'inbox'),
            array('label'=>Yii::t('author', 'Sent'), 'url' => $this->createUrl('sent/sent/'), 'icon'=>'road'),
            array('label'=>Yii::t('author', 'Compose'), 'url' => $this->createUrl('compose/'), 'icon'=>'edit'),
            
            );
?>


<h2><?php echo MessageModule::t('Compose New Message'); ?></h2>

<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'message-form',
		'enableAjaxValidation'=>false,
	)); ?>

	<p class="note"><?php echo MessageModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>
        
        <?php if(Yii::app()->user->isAdmin()): ?>

	<div class="row">
		<?php echo $form->labelEx($model,'receiver_id'); ?>
		<?php echo CHtml::textField('receiver', $receiverName) ?>
		<?php echo $form->hiddenField($model,'receiver_id'); ?>
		<?php echo $form->error($model,'receiver_id'); ?>
	</div>
        <?php else:?>
               <?php echo $form->hiddenField($model,'receiver_id', array('value' => '-1')); ?>
        <?php endif;?>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject'); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body'); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(MessageModule::t("Send")); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_suggest'); ?>
