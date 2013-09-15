<?php $this->pageTitle = Yii::t('AuthorModule.main', 'Favorite') . ' | ' . Yii::app()->name; ?>
<div class="article">
	<h1 class="title title_article"><?= Yii::t('AuthorModule.main', 'Favorite') ?></h1>
	<?php foreach ($articles as $element): ?>
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
	<?php if (empty($articles)): ?>
		Результаты поиска отсутсвуют. Попробуйте изменить запрос.
	<?php endif ?>
</div>