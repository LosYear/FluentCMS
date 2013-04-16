<?php
/* @var $this NewsController */
/* @var $model News */
?>

<div class="view well">

    <div id="title"><h3><?php echo CHtml::link(CHtml::encode($data->title), Yii::app()->createUrl($data->url)) ; ?></h3></div>
    <div id="author"><i class="icon-user"></i> <?php echo CHtml::encode($data->author) ?></div>
    <div id="date"><i class="icon-calendar"></i> <?php $formatter = new CDateFormatter(Yii::app()->locale); echo $formatter->formatDateTime($data->created) ?></div>
    <hr>
    <div id="content"><?php echo NewsController::getPreview($data->content) ?></div>
</div>