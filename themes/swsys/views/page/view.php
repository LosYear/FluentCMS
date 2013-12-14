<?php $this->pageTitle = $model->title . ' | ' . Yii::app()->name; ?>
<article class="main ym-clearfix">
<div class="article page">
<ul class="breadcrumbs">
	<li>
		<a href="http://new.cms">Главная страница</a>
		<span class="divider">»</span>
	</li>
	<?php
		$criteria = new CDbCriteria();
		$criteria->condition = '`href` = :href';
		$criteria->params = array(':href' => trim(Yii::app()->request->requestUri, '/'));
		$md = MenuItem::model()->find($criteria);
		if($md->parent_id == 0){
	?>
		<li class="active">
			<a><?= $md->title ?></a>
		</li>
		<?php }else{
			$model_2 = MenuItem::model()->findByPk($md->parent_id);
		?>
		<li>
			<a href="<?= $model_2->href ?>"><?= $model_2->title ?></a>
			<span class="divider">»</span>
		</li>
		<li class="active">
			<a><?= $md->title ?></a>
		</li>
		<?php } ?>
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