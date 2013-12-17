<div class="article-tizer-item">
	<h3 class="title title_article-tizer"><a
			href="<?php echo Yii::app()->createUrl($data['url']); ?>"><?php echo $data['title']; ?> </a>
	</h3>
	<div id="date"><i class="glyphicon glyphicon-calendar"></i> <?php $formatter = new CDateFormatter(Yii::app()->locale); echo $formatter->formatDateTime($data->created, 'medium', null) ?></div>

	<div class="article-tizer-content">
		<?php echo $data->getPreview(); ?>
	</div>
	<hr class="hr">
</div>