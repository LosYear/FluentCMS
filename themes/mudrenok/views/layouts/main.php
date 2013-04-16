<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Mudrenok</title>
		
	<!--	<script lang="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script lang="javascript" src="bootstrap/js/bootstrap.min.js"></script>
		
		
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="all" />
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" media="all" />-->
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" media="all" />
	</head>
	<body>
		<div class="header">
			<h1 class="title">
				<a href="">Мудрёнок</a>
			</h1>
		</div>
		<div class="page">
			<div class="menu">
				<!--<div class="navbar navbar-static-top navbar-inverse">
				  <div class="navbar-inner">
					<ul class="nav">
					  <li><a href="#">Главная</a></li>
					  <li><a href="#">О проекте</a></li>
					  <li><a href="#">Документы</a></li>
					  <li><a href="#">Направления</a></li>
					  <li><a href="#">Туры</a></li>
					  <li><a href="#">Помощь</a></li>
					  <li><a href="#">Команды</a></li>
					</ul>
					
					<ul class="nav pull-right">
					  <li><a href="#"><i class="icon-briefcase icon-white"></i>Личный кабинет</a></li>
					  <li><a href="#"><i class="icon-off icon-white"></i>Выход</a></li>
					</ul>
				  </div>
				</div>-->
                            
                            <?php $this->widget('application.widgets.BootstrapMenuWidget', array(
                                'type'=>'inverse', // null or 'inverse'
                                'brand' => false,
                                'htmlOptions' => array('class' => 'navbar-static-top'),
                                'fixed' => '',
                                'brandUrl'=>'#',
                                'collapse'=>true, // requires bootstrap-responsive.css
                                'items'=>array(),
                                'name' => 'mudrenok',
                            )); ?>
			</div>
			
			<div class="content">
				<!--<div class="well block">
					<div class="border"></div>
					<h2>Title</h2>
					<div class="meta">
						<p><i class="icon-user"></i>Admin</p>
						<p><i class="icon-calendar"></i>26 Января 2013</p>
					</div>
					<div class="article">
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
					<button class="btn btn-mini btn-primary" type="button">Далее</button>
					</div>
				</div>
				
				<div class="well block">
					<div class="border"></div>
					<h2>Title</h2>
					<div class="meta">
						<p><i class="icon-user"></i>Admin</p>
						<p><i class="icon-calendar"></i>26 Января 2013</p>
					</div>
					<div class="article">
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
					<button class="btn btn-mini btn-primary" type="button">Далее</button>
					</div>
				</div>
				
				<div class="well block">
					<div class="border"></div>
					<h2>Title</h2>
					<div class="meta">
						<p><i class="icon-user"></i>Admin</p>
						<p><i class="icon-calendar"></i>26 Января 2013</p>
					</div>
					<div class="article">
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
					<button class="btn btn-mini btn-primary" type="button">Далее</button>
					</div>
				</div>-->
                                <?php echo $content; ?>
			</div>
		</div>
		<div class="footer">
			<p>&copy; Тверская Гимназия 10</p>
			<p><b>Fluent CMS 0.3 pre-alpha</b></p>
		</div>
	</body>
</html>