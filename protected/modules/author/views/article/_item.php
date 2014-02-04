<li class="article-tizer-item">
    <h3 class="title title_article-tizer"><a
            href="<?php echo Yii::app()->createUrl($data['url']); ?>"><?php echo $data['title']; ?> </a>
    </h3>

    <div class="article-tizer-authors">
        <?php $a = $data->getAuthors();
        foreach ($a as $author): ?>
            <span class="icon icon_person"></span>
            <a class="link" href="/author/<?= $author['id'] ?>.html"><?= $author['name'] ?></a>
        <?php endforeach; ?>
    </div>


    <?php $issue_info = $data->getIssue();
    $date = DateTime::createFromFormat("Y-m-d", $issue_info->year);
    $year = $date->format("Y");
    $month = Yii::t('date', $date->format("F"));
    $number = $issue_info->number;
    ?>
    <p>
        <?= Yii::t('AuthorModule.main', 'The article was published in issue') ?> <a
            href="<?= Yii::app()->createUrl('author/issue', array('id' => $issue_info->id,)) ?>">№<?= $number ?></a> <?= Yii::t('AuthorModule.main', 'which is dated by') ?> <?= Yii::app()->dateFormatter->formatDateTime(strtotime($date->format("d F Y")), 'long', null); ?>
    </p>


    <div class="article-tizer-content">
        <?php echo $data->advanced->annotation; ?>
    </div>
    <hr class="hr">
</li>