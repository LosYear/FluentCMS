<div class="well block article-block">
    <div class="border"></div>
    <h2><?php echo CHtml::link(CHtml::encode($data->title), Yii::app()->createUrl($data->url)) ; ?></h2>
    <div class="meta">
        <p><i class="icon-user"></i><?php echo CHtml::encode(YumUser::getUsernameById($data->author)) ?></p>
            <p><i class="icon-calendar"></i><?php $formatter = new CDateFormatter(Yii::app()->locale); echo $formatter->formatDateTime($data->created, 'long', 'short') ?></p>
    </div>
    <div class="article">
    <?php echo NewsController::getPreview($data->content) ?>
    <a href="<?php echo Yii::app()->createUrl($data->url) ?>" class="btn btn-mini btn-primary">Далее</a>
    </div>
</div>