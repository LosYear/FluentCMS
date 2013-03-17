<?php
/* @var $this ArticleController */
/* @var $model Article */
/* @var $form CActiveForm */
?>
 <?php 
    $url = Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('author.assets').'/ckeditor');
    Yii::app()->clientScript->registerScriptFile(
        $url.'/ckeditor.js'
    );
 ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>
    <?php echo $form->errorSummary($advModel); ?>
 <fieldset class="edit-form">
<div class="row">
    <div>
        <div class="column span-5"><?php echo $form->labelEx($model,'url'); ?></div>
        <div class="column span-12"><?php echo $form->textField($model, 'url', array('class'=>'span6')); ?></div>
    </div>
</div>
     
<div class="row">
    <div>
       <div class="column span-5"><?php echo $form->labelEx($model,'title'); ?></div>
       <div class="column span-12"><?php echo $form->textField($model, 'title', array('class'=>'span6')); ?></div>
    </div>
</div>
     
<div class="row">
    <div>
       <div class="column span-5"><?php echo $form->labelEx($advModel,'title_eng'); ?></div>
       <div class="column span-12"><?php echo $form->textField($advModel, 'title_eng', array('class'=>'span6')); ?></div>
    </div>
</div>
     
<div class="row">
    <div>
       <div class="column span-5"><?php echo $form->labelEx($advModel,'annotation_rus'); ?></div>
       <div class="column span-12"><?php echo $form->textField($advModel, 'annotation_rus', array('class'=>'span6')); ?></div>
    </div>
</div>
     
<div class="row">
    <div>
       <div class="column span-5"><?php echo $form->labelEx($advModel,'annotation_eng'); ?></div>
       <div class="column span-12"><?php echo $form->textField($advModel, 'annotation_eng', array('class'=>'span6')); ?></div>
    </div>
</div>
     
<div class="row">
    <div>
       <div class="column span-5"><?php echo $form->labelEx($model,'content'); ?></div>
       <div class="column span-12"><?php echo $form->textArea($model, 'content', array('class' => 'ckeditor span6' )); ?></div>
    </div>
</div>
     
<div class="row">
    <div>
       <div class="column span-5"><?php echo $form->labelEx($advModel,'tags_rus'); ?></div>
       <div class="column span-12"><?php echo $form->textField($advModel, 'tags_rus', array('class'=>'span6')); ?></div>
    </div>
</div>
     
<div class="row">
    <div>
       <div class="column span-6"><?php echo $form->labelEx($advModel,'tags_eng'); ?></div>
       <div class="column span-12"><?php echo $form->textField($advModel, 'tags_eng', array('class'=>'span6')); ?></div>
    </div>
</div>
     
<div class="row">
    <div>
       <div class="column span-5"><?php echo $form->labelEx($advModel,'aditional_authors'); ?></div>
       <div class="column span-12"><?php echo $form->textField($advModel, 'aditional_authors', array('class'=>'span6')); ?></div>
    </div>
</div>
     
<div class="row">
   <div>
      <div class="column span-5"><?php echo $form->labelEx($advModel,'issue_id'); ?></div>
      <?php
        $issues = array();
        $issue_model = new Issue;
        $tmp = $issue_model->findAll('isOpened = 1');
        foreach ($tmp as $item) {
            $issues[$item->id] = $item->number.'/'.$item->year;
        }
      ?>
      <div class="column span-12"><?php echo $form->dropDownList($advModel, 'issue_id', $issues,  array('class'=>'span6')); /*textField($model, 'status', array('class'=>'span12'))*/; ?></div>
   </div>
</div>
     
<div class="row">
   <div>
      <div class="column span-5"><?php echo $form->labelEx($model,'status'); ?></div>
      <div class="column span-12"><?php echo $form->dropDownList($model, 'status', 
              array('1' => Yii::t('author', 'Accepted'), 
                  '2'=> Yii::t('author', 'Pending'),
                  '3'=> Yii::t('author', 'Awaiting correction')), array('class'=>'span6')) /*textField($model, 'status', array('class'=>'span12'))*/; ?></div>
   </div>
</div>
<div class="row"><div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
        array('type'=>'primary','buttonType'=>'submit', 'label'=>Yii::t('admin','Submit'))); ?></div></div>
     
</fieldset>

<?php $this->endWidget(); ?>     