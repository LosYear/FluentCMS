<?php 
Yii::app()->clientScript->registerCssFile(
		Yii::app()->getAssetManager()->publish(
			Yii::getPathOfAlias('YumAssets').'/css/yum.css'));

$module = Yii::app()->getModule('user');
$this->beginContent($module->baseLayout); ?>

<div class="container-fluid" style="margin-top:10px">
  <div class="row-fluid">
    <div class="span3 block">
      <?php $this->renderFile(Yii::getPathOfAlias('application.modules.rush.views.cabinet').'/sidebar.php', array('adv'=>array())); ?>
    </div>
    <div class="span9 well block">
        <?php echo $content ?>
    </div>
  </div>
</div>

<?php $this->endContent(); ?>

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
    
    .form{
        margin: 0;
        margin-top: 20px;
    }
    
    .row{
        margin:0;
    }
    .row textarea{
        margin-bottom: 10px;
    }
</style>
