<?php 
Yii::app()->clientScript->registerCssFile(
		Yii::app()->getAssetManager()->publish(
			Yii::getPathOfAlias('YumAssets').'/css/yum.css'));

$module = Yii::app()->getModule('user');
$this->beginContent($module->baseLayout); ?>

<div class="container-fluid" style="margin-top:10px">
  <div class="row-fluid">
    <div class="span12 well block">
        <?php echo $content ?>
    </div>
  </div>
</div>

<?php $this->endContent(); ?>
