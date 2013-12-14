<?php $this->pageTitle = $query . ' | ' . Yii::app()->name; ?>
<div style="margin-left:40px">
	<h1 class="title title_article"><?= Yii::t('AuthorModule.main','Results for').' '.$query; ?></h1>
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_item',
			'template' => '{items}{pager}',
			'itemsTagName'=>'ol',
			'itemsCssClass'=>'',
			'pagerCssClass' => 'center',
			'pager' => array('class' => 'bootstrap.widgets.TbPager')
		)); ?>
</div>

<style>
	ol{
		margin-right: 1.5em;
	}
</style>