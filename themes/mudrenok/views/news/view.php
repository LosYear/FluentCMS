<div class="well block">
    <div class="border"></div>
    <h2><?php echo CHtml::link(CHtml::encode($model->title), Yii::app()->createUrl($model->url)) ; ?></h2>
    <div class="meta">
        <p><i class="icon-user"></i><?php echo CHtml::encode(YumUser::getUsernameById($model->author)) ?></p>
            <p><i class="icon-calendar"></i><?php $formatter = new CDateFormatter(Yii::app()->locale); echo $formatter->formatDateTime($model->created, 'long', 'short') ?></p>
    </div>
    <div class="article">
    <?php echo $model->content; ?>
    </div>
</div>