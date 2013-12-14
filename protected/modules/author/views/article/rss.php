<?='<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0">
  <channel>
    <title><?= Yii::app()->name ?></title>
    <link>http://<?= Yii::app()->homeUrl ?></link>
    <description>Международный журнал "Программные продукты и системы" - научные статьи в области информационных технологий</description>
	<managingEditor>info@cps.tver.ru</managingEditor>
	
    <generator>Fluent CMS</generator>
 
	<?php foreach($items as $item): ?>
		<item>
		  <title><?= $item->article->title ?></title>
		  <link><?= Yii::app()->homeUrl.'/'.$item->article->url.'.html'?></link>
		  <description><![CDATA[<?= $item->annotation ?>]]></description>
		  <pubDate><?php $date = DateTime::createFromFormat("Y-m-d G:i:s", $item->article->created);  echo $date->format("D, d M Y H:i:s O");  ?></pubDate>
		  <guid><?= Yii::app()->homeUrl.'/'.$item->article->url.'.html'?></guid>
		</item>
	<?php endforeach; ?>
  </channel>
</rss>