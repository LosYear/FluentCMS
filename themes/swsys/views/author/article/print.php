<h1 class="article-title"><?= $model->title ?></h1>
<h3><?= Yii::t('AuthorModule.main', 'Source') ?>: <?= Yii::app()->name ?> (<?= Yii::app()->homeUrl.MultilangHelper::addLangToUrl($model->url.'.html')?>)</h3>
					<?php
						$date = DateTime::createFromFormat("Y-m-d", $issue_info->year);
						$year = $date->format("Y");
						$month = Yii::t('date', $date->format("F"));
						$number = $issue_info->number;
					?>
					<p>
						<?= Yii::t('AuthorModule.main', 'The article was published in issue') ?> №<?=$number ?> <?= Yii::t('AuthorModule.main', 'which is dated by') ?> <?= Yii::app()->dateFormatter->formatDateTime(strtotime($date->format("d F Y")), 'long', null); ?>
					</p>
<div class="authors"><strong><?= Yii::t('AuthorModule.main', 'Authors') ?>:</strong>&nbsp;
	<?php
		foreach($authors as $one){
			echo $one['name'].';&nbsp;';
		}
	?>
</div>
<div class="annotation">
	<strong><?= Yii::t('AuthorModule.main', 'Abstract') ?>:</strong>
	<div class="annotation-text">
		<?= $advModel->annotation; ?>
	</div>
</div>
<div class="tags">
	<strong><?= Yii::t('AuthorModule.main', 'Keywords') ?>:</strong>&nbsp;
	<?php foreach ($tags_rus as $tag){
		echo $tag->info->tag.';&nbsp;';
	} ?>
</div>
<div class="article-text">
	<?= $model->content; ?>
</div>

<style>
 .article-text{
	margin-top: 50px;
 }
 img{
	margin: 5px 5px 5px 5px;
 }
 </style>