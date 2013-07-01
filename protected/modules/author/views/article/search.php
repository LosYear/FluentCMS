<div style="margin-left:40px">
	<?php foreach ($results as $element): ?>
		<div class="article-tizer-item">
			<h3 class="title title_article-tizer"><a
					href="<?php echo Yii::app()->createUrl($element['url']); ?>"><?php echo $element['title']; ?> </a>
			</h3>

			<div class="article-tizer-content">
				<?php echo $element->advanced->annotation_rus; ?>
			</div>
			<hr class="hr">
		</div>
	<?php endforeach; ?>
	<?php if (empty($results)): ?>
		Результаты поиска отсутсвуют. Попробуйте изменить запрос.
	<?php endif ?>
</div>