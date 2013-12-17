<?php $this->pageTitle = $model->title . ' | ' . Yii::app()->name; ?>
<article class="main ym-clearfix">
<div class="article page">
<ul class="breadcrumbs">
	<li>
		<a href="http://new.cms">Главная страница</a>
		<span class="divider">»</span>
	</li>
	<li>
		<a href="<?= Yii::app()->createUrl('news/index');?>"><?= Yii::t('journal', 'Announcements') ?></a>
		<span class="divider">»</span>
	</li>
	<li class="active">
		<a><?= $model->title ?></a>
	</li>
</ul>
<h1 class="title title_article"><?php echo $model->title; ?></h1>
		<div class="article-content">
			<?php echo $model->content; ?>
		</div>
	</div>
</article>

<style>
	h3{
		color: #fca100;
		font-size: 24px;
	}

	h4{
		color: #fca100;
	}
</style>