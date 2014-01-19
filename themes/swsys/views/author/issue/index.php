<?php
$this->pageTitle = Yii::app()->name;
?>
<div id="main" class="main">
<div class="ym-column linearize-level-1">
<aside class="ym-col1">
    <div class="block_aside block_nomer-info">
        <div class="inner">
            <h2 class="title title_nomer-info"><?= Yii::t('journal', 'Current issue') ?>:</h2>

            <div class="nomer-stats ym-clearfix">
                <div class="nomer-caption">
                    <div class="nomer-caption-spoiler"><?= Yii::t('journal', 'last issue') ?></div>
                    <div class="nomer-caption-year"><?php echo $new_issue['year'] ?></div>
                    <div class="nomer-caption-month"><?php echo $new_issue['month'] ?></div>
                </div>

                <div class="nomer-stats-item">
                    <div class="value"><?php echo $new_issue['articles'] ?></div>
                    <div class="property"><?= Yii::t('journal', 'ARTICLES') ?></div>
                </div>


                <div class="nomer-stats-item">
                    <div class="value"><?php echo $new_issue['authors_amount'] ?></div>
                    <div class="property"><?= Yii::t('journal', 'AUTHORS') ?></div>
                </div>


                <div class="nomer-stats-item">
                    <div class="value"><?= $new_issue['popularity'] ?></div>
                    <div class="property"><?= Yii::t('journal', 'INTEREST') ?></div>
                </div>


            </div>


            <h2 class="title title_nomer-info"><?= Yii::t('journal', 'Topics') ?>:</h2>

            <div class="block_toc">

                <?php foreach ($new_issue['content'] as $el): ?>
                    <dl>
                        <dt><span style="left:<?php $per = 100 - $el['popularity'];
                            if ($per > 75): $per = 75; endif;
                            echo $per; ?>%"></span><?php echo $el['popularity'] ?>
                        </dt>
                        <dd class="pop">
                            <div class="pop-inner" rel="tooltip" data-original-title="<?= $el['title'] ?>"
                                 data-placement="top"><?php echo $el['title'] ?></div>
                        </dd>
                    </dl>
                <?php endforeach; ?>
                <script lang="javascript">
                    jQuery('[rel="tooltip"]').tooltip();
                    /*$("[data-placement=top]").hover(function(){
                     $('.*/
                </script>
                <style>
                    .tooltip.top .tooltip-arrow {
                        left: 6%;
                        bottom: 1px;
                    }

                    .tooltip {
                        font-size: 13px;
                        /* position: relative !important;/*
                         left: 100px !important;
                         top: 100px !important;
                         left: 0 !important;
                         right: 0 !important;
                         bottom: 0 !important;
                         top: 0 !important;*/
                    }
                </style>
            </div>
        </div>
    </div>


    <div class="block_aside block_archive">
        <h2 class="title_block_aside"><?= Yii::t('journal', 'Archive') ?>
            <div class="tail-corner-left-down"></div>
        </h2>
        <div class="inner">
            <?php $active = 'active';
            foreach ($new_issue['archive'] as $key => $year) : ?>
                <div class="archive-year-item ym-clearfix">
                    <div class="archive-year-label <?php echo $active;
                    $active = '' ?>"><?php echo $key ?></div>
                    <div class="archive-months-list">
                        <?php foreach ($year as $key_2 => $month): ?>
                            <div class="archive-month-item ym-clearfix">
                                <div class="archive-month-label"><?php echo $key_2 ?>:</div>
                                <div class="archive-items">
                                    <?php foreach ($month as $number => $el): ?>
                                        <a href="<?php echo Yii::app()->createUrl('author/issue', array('id' => $el->id,)); ?>"
                                           class="link">№<?php echo $number ?>
                                            (<?php $date = DateTime::createFromFormat("Y-m-d", $el->year);
                                            echo Yii::app()->dateFormatter->format("d MMMM", strtotime($date->format("d F Y"))); ?>
                                            )</a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="title_block_aside">
            <div class="tail-corner-top-left-gray"></div>
        </div>
    </div>
    <div class="block_aside block_contacts">
        <div class="inner" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <b><?= Yii::t('journal', 'How to contact with') ?> <a
                    href="<?php echo Yii::app()->homeUrl . MultilangHelper::addLangToUrl('contacts.html') ?>"><?= Yii::t('journal', 'editors') ?></a></b>

            <ul>
                <li><b><?= Yii::t('journal', 'Phone') ?>:</b> <span itemprop="telephone">(4822) 39-91-49</span>
                </li>
                <li><b><?= Yii::t('journal', 'Fax') ?>:</b> <span>(4822) 39-91-00</span></li>
                <li><b><?= Yii::t('journal', 'Address') ?>:</b>
                    <span itemprop="postalCode">170024</span>,
                    <span itemprop="addressLocality">г. Тверь</span>,
                    <span itemprop="streetAddress">проспект 50 лет Октября, 3 А</span></li>
                <li><b><?= Yii::t('journal', 'Email') ?>:</b>
                    <a itemprop="email" href="mailto:red@cps.tver.ru">red@cps.tver.ru</a>,
                    <a itemprop="email" href="mailto:info@cps.tver.ru">info@cps.tver.ru</a></li>
            </ul>
        </div>
    </div>
</aside>
<div class="ym-col3">
    <?php if (Setting::model()->findByPk('show_ad_block')->value): ?>
        <div class="block_infored_bg"></div>
        <div class="block_infored">
            <h2><a href="<?= Yii::app()->createUrl($last_news['href']); ?>"><?= $last_news['title'] ?></a></h2>

            <div class="date">[<?= $last_news['date'] ?>]</div>
            <div class="text"><?= $last_news['content'] ?><a href="<?= Yii::app()->createUrl($last_news['href']); ?>">[Читать полностью]</a></div>
            <a href="<?= Yii::app()->createUrl('news/index'); ?>">Все объявления...</a>
        </div>
    <?php endif; ?>
    <div class="cross-articles-nav">
        <div class="cross-articles-nav-prev">
            <?php if ($new_issue['previous_issue'] != -1): ?>
                <strong>←</strong>
                <a href="<?php echo Yii::app()->createUrl('author/issue', array('id' => $new_issue['previous_issue'],)); ?>"><?= Yii::t('journal', 'PREVIOUS ISSUE') ?></a>
            <?php endif; ?>
        </div>
        <div class="cross-articles-nav-active">
            <strong><?= Yii::t('journal', 'Issue') ?> № <?php echo $new_issue['number']; ?></strong>
            <small><?php $date = DateTime::createFromFormat("d.m.Y", $new_issue['date']);
                echo Yii::app()->dateFormatter->formatDateTime(strtotime($date->format("d F Y")), 'long', null); ?></small>
        </div>
        <div class="cross-articles-nav-next">
            <?php if ($new_issue['next_issue'] != -1): ?>
                <a href="<?php echo Yii::app()->createUrl('author/issue', array('id' => $new_issue['next_issue'],)); ?>"><?= Yii::t('journal', 'NEXT ISSUE') ?></a>
                <strong>→</strong>
            <?php endif; ?>
        </div>
    </div>
    <div class="ym-cbox">
        <div class="article-inner">
            <?php foreach ($new_issue['content'] as $element) { ?>
                <div class="article-tizer-item">
                    <?php if ($element['image'] != null): ?>
                        <div class="article-header-block">
                            <img src="<?= "/resources/uploads/article_images/" . $element['image'] ?>"
                                 class="img_title"/>

                            <div class="title_image">
                                <div class="wrap">
                                    <div class="linker">
                                        <h3 class="title title_article-tizer"><a
                                                href="<?php echo Yii::app()->createUrl($element['href']); ?>"><?php echo $element['title']; ?> </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <h3 class="title title_article-tizer"><a
                                href="<?php echo Yii::app()->createUrl($element['href']); ?>"><?php echo $element['title']; ?> </a>
                        </h3>
                    <?php
                    endif; ?>

                    <div class="article-tizer-authors">
                        <?php foreach ($element['authors'] as $author) { ?>
                            <span class="icon icon_person"></span>
                            <a class="link"
                               href="<?php echo Yii::app()->createUrl('author/profile/view', array('id' => $author['id'])); ?>"><?php echo $author['name'] ?></a>
                        <?php } ?>
                    </div>
                    <div class="article-tizer-content">
                        <?php echo $element['annotation']; ?>
                    </div>
                    <hr class="hr">
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="cross-articles-nav">
        <div class="cross-articles-nav-prev">
            <?php if ($new_issue['previous_issue'] != -1): ?>
                <strong>←</strong>
                <a href="<?php echo Yii::app()->createUrl('author/issue', array('id' => $new_issue['previous_issue'],)); ?>"><?= Yii::t('journal', 'PREVIOUS ISSUE') ?></a>
            <?php endif; ?>
        </div>
        <div class="cross-articles-nav-active">
            <strong><?= Yii::t('journal', 'Issue') ?> № <?php echo $new_issue['number']; ?></strong>
            <small><?php $date = DateTime::createFromFormat("d.m.Y", $new_issue['date']);
                echo Yii::app()->dateFormatter->formatDateTime(strtotime($date->format("d F Y")), 'long', null); ?></small>
        </div>
        <div class="cross-articles-nav-next">
            <?php if ($new_issue['next_issue'] != -1): ?>
                <a href="<?php echo Yii::app()->createUrl('author/issue', array('id' => $new_issue['next_issue'],)); ?>"><?= Yii::t('journal', 'NEXT ISSUE') ?></a>
                <strong>→</strong>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
</div>