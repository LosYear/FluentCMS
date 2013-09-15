<?php $this->pageTitle = Yii::t('FeedbackModule.flash', 'Feedback') . ' | ' . Yii::app()->name; ?>
<div id="content" class="form login-form">
	<h1 class="title title_article" style="color:#fca100;"><?= Yii::t('FeedbackModule.flash', 'Feedback');?></h1><br/>
	<?php if(Yii::app()->user->hasFlash('contact')): ?>

		<div class="flash-success">
			<?php echo Yii::app()->user->getFlash('contact'); ?>
		</div>

	<?php elseif(Yii::app()->user->hasFlash('error')): ?>

		<div class="flash-error">
			<?php echo Yii::app()->user->getFlash('error'); ?>
		</div>

	<?php else: ?>

	<div class="form">
		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id'=>'block-form',
			'enableAjaxValidation'=>false,
		)); ?>
		<?php echo $form->errorSummary($model); ?>
		<div class="row-fluid">
			<div>
				<div class="column span-4"><?php echo $form->labelEx($model,'name'); ?></div>
				<div class="column span-12"><?php echo $form->textField($model, 'name'); ?></div>
			</div>
		</div>
		<div class="row-fluid">
			<div>
				<div class="column span-4"><?php echo $form->labelEx($model,'email'); ?></div>
				<div class="column span-12"><?php echo $form->textField($model, 'email'); ?></div>
			</div>
		</div>
		<div class="row-fluid">
			<div>
				<div class="column span-4"><?php echo $form->labelEx($model,'subject'); ?></div>
				<div class="column span-12"><?php echo $form->textField($model, 'subject'); ?></div>
			</div>
		</div>
		<div class="row-fluid">
			<div>
				<div class="column span-4"><?php echo $form->labelEx($model,'body'); ?></div>
				<div class="column span-12"><?php echo $form->textArea($model, 'body', array('style'=>'width:60%', 'rows' => 10)); ?></div>
			</div>
		</div><br>

		<div class="row-fluid">
			<div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton',
					array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Отправить'))); ?></div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
	<?php endif; ?>
</div>