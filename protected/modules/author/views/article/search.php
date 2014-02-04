<?php $this->pageTitle = $query . ' | ' . Yii::app()->name; ?>
<div style="margin-left:40px">
    <h1 class="title title_article"><?= Yii::t('AuthorModule.main', 'Results for') . ' ' . $query; ?></h1>
    <?php if (isset($authors) && (count($authors) > 0)): ?>
        <p class="authors" style="margin-left: 1em; padding-left: 40px;">
            Может быть Вы искали авторов?<br/>
            <?php foreach ($authors as $author): ?>
                <a href="<?php echo Yii::app()->createUrl('author/profile/view', array('id' => $author['id'])); ?>"><?php echo $author['name'] ?></a>
            <?php endforeach; ?>
        </p>
    <?php endif; ?>
    <? if (count($authors) == 0 || $dataProvider->getItemCount() > 0) {

        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_item',
            'template' => '{items}{pager}',
            'itemsTagName' => 'ol',
            'itemsCssClass' => '',
            'emptyText' => Yii::t('journal', 'There are no articles for this request'),
            'pagerCssClass' => 'center',
            'pager' => array('class' => 'bootstrap.widgets.TbPager')
        ));
    }?>
</div>

<style>
    ol {
        margin-right: 1.5em;
    }

    .list-view {
        padding-top: 0px !important;
    }
</style>