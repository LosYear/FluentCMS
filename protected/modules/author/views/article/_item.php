<li class="article-tizer-item">
	<h3 class="title title_article-tizer"><a
			href="<?php echo Yii::app()->createUrl($data['url']); ?>"><?php echo $data['title']; ?> </a>
	</h3>

	<div class="article-tizer-content">
		<?php echo $data->advanced->annotation; ?>
	</div>
	<hr class="hr">
</li>