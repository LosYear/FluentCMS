<div class="container-fluid margin-10">
  <div class="row-fluid">
    <div class="span3 block">
      <?php $this->renderPartial('_menu');  ?>
    </div>
    <div class="span9 well block">
<?php
$this->breadcrumbs=array(
	ucfirst($this->module->id)=>array('mailbox/inbox'),
	'Message',
);


$subject = ($conv->subject)? $conv->subject : $this->module->defaultSubject;

if(strlen($subject) > 100)
{
	$subject = substr($subject,0,100);
}

?>
<div class="mailbox-message-list">


<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>
<div class="mailbox-message-subject  mailbox-ellipsis"><?php echo $subject; ?></div>

<br />
<?php
$first_message=1;
foreach($conv->messages as $msg): 
	$sender = $this->module->getUserName($msg->sender_id);
	if(!$sender)
		$sender = $this->module->deletedUser;
	?>

	<div class="mailbox-message-header">
		<div class="message-sender">
<?php	echo ($msg->sender_id == Yii::app()->user->id)? Yii::t('MailboxModule.main','You') : ucfirst($sender);
	echo ($first_message)? ' '.Yii::t('MailboxModule.main','said') : ' '.Yii::t('MailboxModule.main','replied') ; ?></div>
		<div class="message-date"><?php echo Yii::app()->dateFormatter->formatDateTime($msg->created, 'long', 'short');; ?></div>
		<br />
	</div>
	<div class="mailbox-message-text"><?php echo $msg->text; ?></div>
	<br />
<?php $first_message=0;
endforeach; 

if($this->module->authManager)
	$authReply = Yii::app()->user->checkAccess("Mailbox.Message.Reply");
else
	$authReply = $this->module->sendMsgs;

if($authReply)
{

$form=$this->beginWidget('CActiveForm', array(
    'action'=>$this->createUrl('message/reply',array('id'=>$_GET['id'])),
    'id'=>'message-reply-form',
    'enableAjaxValidation'=>false,
)); ?>
	<div class="mailbox-message-reply ui-helper-clearfix">
	<?php /* echo $form->errorSummary(array($reply,$conv));*/ ?>
	<?php echo $form->error($reply,'text'); ?>
		<div class="mailbox-textarea-wrap ui-helper-clearfix">
			<textarea name="text" cols="50" rows="7" placeholder="<?php echo Yii::t('MailboxModule.main', 'Reply here...'); ?>"></textarea>
		</div>
	<input type="submit" class="btn btn-large mailbox-input" value="<?php echo Yii::t('MailboxModule.main', 'Send Reply'); ?>" />
	</div>



<?php $this->endWidget(); 
}
?>
</div>
    </div>
  </div>
</div>