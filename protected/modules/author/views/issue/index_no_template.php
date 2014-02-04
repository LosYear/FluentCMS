<?php
$this->pageTitle = Yii::app()->name;
?>
<div id="main" class="main">
    <div class="ym-cbox">
        <div class="page-header" style="margin-left:34px">
            <h1 style="font-size:30px">Статьи выпуска за <?php echo $new_issue['month'] ?>&nbsp;<?= $new_issue['year'] ?></h1>
        </div>
        <div class="article-inner" style="margin-right: 34px !important">
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
</div>