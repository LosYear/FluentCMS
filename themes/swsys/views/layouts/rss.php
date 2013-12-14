<?='<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0">
  <channel>
    <title><?= Yii::app()->name ?></title>
    <link>http://<?= Yii::app()->homeUrl ?></link>
    <description>Международный журнал "Программные продукты и системы" - научные статьи в области информационных технологий</description>
	<managingEditor>info@cps.tver.ru</managingEditor>
	
    <generator>Fluent CMS</generator>
 
	<?= $content; ?>
  </channel>
</rss>