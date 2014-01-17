<?php Yii::app()->getModule('author'); ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/main.css"/>
	<link href="<?= Yii::app()->theme->baseUrl ?>/theme.css" rel="stylesheet">
	<link href="<?= Yii::app()->theme->baseUrl ?>/cabinet.css" rel="stylesheet">
	<title>Кабинет</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="page">
	<div class="header">
		<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?= Yii::app()->homeUrl ?>">Кабинет</a>
			</div>

			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li><a href="<?= Yii::app()->homeUrl ?>">Сайт</a></li>
					<li><a href="<?= Yii::app()->createUrl('author/article') ?>">Статьи</a></li>
					<li><a href="<?= Yii::app()->createUrl('author/profile/edit') ?>">Профиль</a></li>
                    <li><a href="<?= Yii::app()->createUrl('user/user/logout') ?>">Выход</a></li>
				</ul>
			</div>
		</nav>
	</div>

	<ol class="breadcrumb">
		<li><a href="#">Главная</a></li>
		<?php foreach ($this->breadcrumbs as $label => $url) {
			if (is_string($label) || is_array($url)): ?>
				<li><a href="#"><?= $label ?></a></li>
			<?php else: ?>
				<li><?= $url ?></li>
			<?php endif;
		} ?>
	</ol>
	<div class="content-main col-md-12 col-sm-12 col-xs-12">
		<div class="content-main col-md-9 col-sm-9">
			<?php echo $content; ?>
		</div>
		<?php if (isset($this->menu)): ?>
			<div class="content-main col-md-2 col-sm-2 col-md-offset-1 col-sm-offset-1">
				<?php if (isset($this->menu)): ?>
					<?php $this->widget('bootstrap.widgets.TbMenu', array(
						'type' => 'list',
						'items' => $this->menu,
					)); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-44437381-1', 'school-discovery.ru');
	ga('send', 'pageview');

</script>
</body>
</html>