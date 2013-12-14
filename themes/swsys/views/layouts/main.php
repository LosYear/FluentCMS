<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo isset($this->pageTitle) ? $this->pageTitle : Yii::app()->name; ?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/normalize.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print/print.css" media="print">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.rs.carousel.css"
	      media="all"/>
	<link rel="stylesheet" type="text/css"
	      href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.rs.carousel-touch.css" media="all"/>

	<!-- lib -->
	<!--	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/jquery-1.8.2.min.js"></script>-->
	<script type="text/javascript"
	        src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/jquery.ui.widget.js"></script>

	<!-- carousel -->
	<script type="text/javascript"
	        src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/jquery.rs.carousel.js"></script>
	<script type="text/javascript"
	        src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/jquery.rs.carousel-autoscroll.js"></script>
	<script type="text/javascript"
	        src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/jquery.rs.carousel-continuous.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/modernizr-2.6.2.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=PT+Sans+Caption:700&subset=latin,cyrillic' rel='stylesheet'
	      type='text/css'>

	<!--<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>-->
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/flexible-columns.css" rel="stylesheet" type="text/css"/>
	<!--[if lte IE 7]>
	<link href="css/core/iehacks.css" rel="stylesheet" type="text/css"/>
	<![endif]-->

	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script type="text/javascript">
		WebFontConfig = {
			google: { families: [ 'PT Sans Caption' ] },
			custom: { families: ['Arial Narrow'],
				urls: [ '/css/fonts/arial-narrow.css' ] }
		};
		(function () {
			var wf = document.createElement('script');
			wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
				'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
			wf.type = 'text/javascript';
			wf.async = 'true';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(wf, s);
		})();
		$(document).ready(function () {
			$('.rs-carousel').carousel({itemsPerPage: '1', nextPrevLinks: false});
			if ($(':rs-carousel').carousel('getNoOfItems') <= 3) {
				$('.rs-carousel-action-prev').hide();
				$('.rs-carousel-action-next').hide();
			}
		});
	</script>
</head>
<body>
<noindex>
	<ul class="ym-skiplinks">
		<li><a class="ym-skip" href="#nav">К навигации</a></li>
		<li><a class="ym-skip" href="#main">К содержимому</a></li>
	</ul>
</noindex>
<div class="ym-wrapper">
	<div class="ym-wbox">
		<header class="header ym-clearfix">
			<a href="<?php echo Yii::app()->homeUrl.MultilangHelper::addLangToUrl(''); ?>"><h1>Электронный научный журнал: Программные продукты, системы и
					алгоритмы</h1></a>

			<form class="ym-searchform" method="get"
			      action="<?php echo Yii::app()->createAbsoluteUrl('author/article/search'); ?>">
				<input class="ym-searchfield" name="query" type="search"/>
				<button type="submit" class="searchbutton"></button>
			</form>

			<div class="block_add-article">
				<div class="icon icon_add-article"></div>
				<a href="<?php echo Yii::app()->createUrl('author/article/create'); ?>" class="link text_add-article"><?= Yii::t('journal', 'Create article') ?></a><br>
				<a href="<?= Yii::app()->createUrl('author/article/favorite') ?>" class="btn"><span
						class="glyphicon glyphicon-heart"></span></a>
				<?php if (Yii::app()->user->isGuest): ?>
					<a href="<?php echo Yii::app()->createUrl('user/login'); ?>" class="btn"><?= Yii::t('journal', 'Sign in'); ?></a>
					<a href="<?php echo Yii::app()->createUrl('user/registration'); ?>" class="btn"><?= Yii::t('journal', 'Sign up'); ?></a>
				<?php elseif (Yii::app()->user->isAdmin()): ?>
					<a href="<?php echo Yii::app()->baseUrl . 'admin/default'; ?>"><?= Yii::t('journal', 'Backend'); ?></a>
				<?php elseif (!Yii::app()->user->isGuest): ?>
					<a href="<?php echo Yii::app()->createUrl('author/article'); ?>" class="btn"><?= Yii::t('journal', 'Cabinet'); ?></a>
				<?php endif; ?>
				<?php /* $this->widget('application.widgets.LanguageSwitcherWidget'); */?>
			</div>
		</header>
		<nav id="nav" class="ym-clearfix">
			<div class="ym-hlist">
				<div class="sublogo"></div>
				<div class="tail-corner-top-left"></div>
				<div class="tail-corner-bottom-right"></div>

				<?php $this->widget('application.widgets.MenuWidget', array(
					'items' => array(),
					'activeCssClass' => 'active',
					'activateParents' => true,
					'activateItems' => true,
					'name' => 'Name',
					'htmlOptions' => array('class' => 'vert-nav'),
				));?>
				<div class="placeholder_after-mainmenu"><a href="http://swsys-web.ru/author/article/rss"
				                                           class="icon icon_rss">rss</a></div>
			</div>
		</nav>
		<?php echo $content ?>
		<div class="ym-clearfix"></div>
		<footer class="footer ym-clearfix">
			<div class="copyright">Создание сайта: <a href="http://cps.tver.ru" target="_blank" class="link">ЗАО НИИ
					ЦПС</a></div>
			<div class="footer-content">
				<p>Журнал зарегистрирован в Федеральной службе по надзору в сфере связи, информационных технологий и
				массовых коммуникаций, Свидетельство о регистрации электронного средства массовой информации Эл №
				ФС77-52371 от 28.12.2012 г.</p>

				<p>© <a href="http://cps.tver.ru" target="_blank" class="link">ЗАО НИИ
					ЦПС</a> Все права на авторские материалы охраняются в соответствии с законодательством РФ. Перепечатка
				возможна только с разрешения редакции. При цитировании материалов обязательна ссылка на Международный
				научно-практический журнал "Программные продукты, системы и алгоритмы" (для on-line проектов обязательна
				индексируемая гиперссылка).</p>
				<!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='http://www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t44.6;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet' "+
"border='0' width='31' height='31'><\/a>")
//--></script><!--/LiveInternet-->
		</footer>
	</div>
</div>


<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->
<!--<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.2.min.js"><\/script>')</script>-->
<!--<script src="js/plugins.js"></script>-->
<!--<script src="js/main.js"></script>-->

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
	var _gaq = [
		['_setAccount', 'UA-XXXXX-X'],
		['_trackPageview']
	];
	(function (d, t) {
		var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
		g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g, s)
	}(document, 'script'));
</script>
<script type="text/javascript">
	$(document).ready(function () {

		$('.vert-nav li').hover(
			function () {
				$('ul', this).slideDown(110);
			},
			function () {
				$('ul', this).slideUp(110);
			}
		);

	});
</script>
</body>
</html>
