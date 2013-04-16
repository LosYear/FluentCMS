<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Messages:sent"); ?>
<?php
	$this->breadcrumbs=array(
		MessageModule::t("Messages"),
		MessageModule::t("Sent"),
	);
        
                $this->menu = array(
            array('label'=>Yii::t('author', 'Inbox'), 'url' => $this->createUrl('inbox/'), 'icon' => 'inbox'),
            array('label'=>Yii::t('author', 'Sent'), 'url' => $this->createUrl('sent/sent/'), 'icon'=>'road'),
            array('label'=>Yii::t('author', 'Compose'), 'url' => $this->createUrl('compose/'), 'icon'=>'edit'),
            
            );
?>

<h2><?php echo MessageModule::t('Sent'); ?></h2>

<?php if ($messagesAdapter->data): ?>
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'message-delete-form',
		'enableAjaxValidation'=>false,
		'action' => $this->createUrl('delete/')
	)); ?>

	<table class="dataGrid">
		<tr>
			<th  class="label">To</th>
			<th  class="label">Subject</th>
		</tr>
		<?php foreach ($messagesAdapter->data as $index => $message): ?>
			<tr>
				<td>
					<?php echo CHtml::checkBox("Message[$index][selected]"); ?>
					<?php echo $form->hiddenField($message,"[$index]id"); ?>
					<?php echo $message->getReceiverName() ?>
				</td>
				<td><a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></td>
				<td><span class="date"><?php echo date(Yii::app()->getModule('message')->dateFormat, strtotime($message->created_at)) ?></span></td>
			</tr>
		<?php endforeach ?>
	</table>

	<div class="row buttons">
		<?php echo CHtml::submitButton(MessageModule::t("Delete Selected")); ?>
	</div>

	<?php $this->endWidget(); ?>

	<?php $this->widget('CLinkPager', array('pages' => $messagesAdapter->getPagination())) ?>
<?php endif; ?>
