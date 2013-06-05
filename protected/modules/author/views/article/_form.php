<script lang="javascript">
    url = "<?php echo Yii::app()->createUrl('author/ajax/AutorsAutoComplete'); ?>";
</script>
<?php
/* @var $this ArticleController */
/* @var $model Article */
/* @var $form CActiveForm */

    $assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.author.assets'));
    Yii::app()->clientScript->registerScriptFile($assetsUrl.'/authors_field.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerCssFile($assetsUrl.'/admin.css');

    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'article-form',
        'enableAjaxValidation'=>false,
    )); 
    
    echo $form->errorSummary($model); 
    echo $form->errorSummary($advModel); 
 ?>
<div class="form">
<div class="row-fluid">
    <div>
        <div class="column span-6"><?php echo $form->labelEx($model,'url'); ?></div>
        <div class="column span-12"><?php echo $form->textField($model, 'url', array('class'=>'span9')); ?></div>
    </div>
</div>
     
<div class="row-fluid">
    <div>
       <div class="column span-6"><?php echo $form->labelEx($model,'title'); ?></div>
       <div class="column span-12"><?php echo $form->textField($model, 'title', array('class'=>'span9')); ?></div>
    </div>
</div>
     
<div class="row-fluid">
    <div>
       <div class="column span-6"><?php echo $form->labelEx($advModel,'title_eng'); ?></div>
       <div class="column span-12"><?php echo $form->textField($advModel, 'title_eng', array('class'=>'span9')); ?></div>
    </div>
</div>
     
<div class="row-fluid">
    <div>
       <div class="column span-6"><?php echo $form->labelEx($advModel,'annotation_rus'); ?></div>
       <div class="column span-12"><?php echo $form->textField($advModel, 'annotation_rus', array('class'=>'span9')); ?></div>
    </div>
</div>
     
<div class="row-fluid">
    <div>
       <div class="column span-6"><?php echo $form->labelEx($advModel,'annotation_eng'); ?></div>
       <div class="column span-12"><?php echo $form->textField($advModel, 'annotation_eng', array('class'=>'span9')); ?></div>
    </div>
</div>
     
<div class="row-fluid">
    <div>
       <div class="column span-6"><?php echo $form->labelEx($model,'content'); ?></div>
       <div class="column span-12"><?php $this->widget('ext.editMe.widgets.ExtEditMe', array(
                                'model'=>$model,
                                'attribute'=>'content',
                            )); ?></div>
    </div>
</div>
     
<div class="row-fluid">
    <div>
       <div class="column span-6"><?php echo $form->labelEx($advModel,'tags_rus'); ?></div>
       <div class="column span-12"><?php echo $form->textField($advModel, 'tags_rus', array('class'=>'span9')); ?></div>
    </div>
</div>
     
<div class="row-fluid">
    <div>
       <div class="column span-6"><?php echo $form->labelEx($advModel,'tags_eng'); ?></div>
       <div class="column span-12"><?php echo $form->textField($advModel, 'tags_eng', array('class'=>'span9')); ?></div>
    </div>
</div>
     
<div class="row-fluid">
    <div>
        <div class="span6 pull-left">
            <div class="column span-6"><?php echo $form->labelEx($advModel,'aditional_authors'); ?></div>
            <div class="column span-12 input-append"><?php echo $form->textField($advModel, 'aditional_authors', 
                    array('data-provider' => 'typeahead','class'=>'span11', 'id' => 'aditional_authors')); ?>
                 <button class="btn" type="button" id="addAuthorButton"><i class=" icon-plus-sign"></i></button>
                 <?php echo $form->hiddenField($advModel, 'aditional_authors', 
                    array('id' => 'aditional_authors_hidden')); ?>
            </div>
        </div>
        <div class="span6 pull-right">
            <ul id="authors">
            </ul>
        </div>
    </div>
</div>
     
<div class="row-fluid">
   <div>
      <div class="column span-6"><?php echo $form->labelEx($advModel,'issue_id'); ?></div>
      <?php
        $issues = array();
        $issue_model = new Issue;
        $tmp = $issue_model->findAll('isOpened = 1');
        foreach ($tmp as $item) {
            $issues[$item->id] = $item->number.'/'.$item->year;
        }
      ?>
      <div class="column span-12"><?php echo $form->dropDownList($advModel, 'issue_id', $issues,  array('class'=>'span9')); /*textField($model, 'status', array('class'=>'span12'))*/; ?></div>
   </div>
</div>
     
<div class="row-fluid">
   <div>
      <div class="column span-6"><?php echo $form->labelEx($model,'status'); ?></div>
      <div class="column span-12"><?php echo $form->dropDownList($model, 'status', 
              array('1' => Yii::t('author', 'Accepted'), 
                  '2'=> Yii::t('author', 'Pending'),
                  '3'=> Yii::t('author', 'Awaiting correction')), array('class'=>'span6')) /*textField($model, 'status', array('class'=>'span12'))*/; ?></div>
   </div>
</div>
<div class="row-fluid"><div class="column span-1"><?php $this->widget('bootstrap.widgets.TbButton', 
        array('type'=>'primary', 'htmlOptions'=>array('id'=>'btnSubmit'), 'label'=>Yii::t('admin','Submit'))); ?></div></div>
     
</div>

<?php $this->endWidget(); ?>     