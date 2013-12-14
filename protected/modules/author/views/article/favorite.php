<?php $this->pageTitle = Yii::t('AuthorModule.main', 'Favorites') . ' | ' . Yii::app()->name; ?>
<div class="article">
	<h1 class="title title_article"><?= Yii::t('AuthorModule.main', 'Favorites') ?></h1>
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider' => $dataProvider,
		'itemView' => '_item',
		'template' => '{items}{pager}',
		'itemsTagName' => 'ol',
		'emptyText' => Yii::t('AuthorModule.main', 'There are no favorites yet'),
		'itemsCssClass' => '',
		'pagerCssClass' => 'center',
		'pager' => array('class' => 'bootstrap.widgets.TbPager')
	)); ?>
</div>

<style>
	ol {
		margin-right: 1.5em;
	}
</style>