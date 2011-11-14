<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php fl_title(); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>css/main.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="styles/system/css/slide.css">
<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>css/panel.css">

<script type="text/javascript" src="includes/jquery-1.7.min.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>js/jquery.corner.js"></script>


<script src="styles/system/js/slide.js" type="text/javascript"></script>

<?php $events->fire("fl_head_add_script",""); ?>

<?php echo $script; ?>
</head>
<body text_id="<?php echo $_REQUEST['p'];?>">
<?php fl_logreg_panel(); ?>
<!-- start header -->
<div id="header">
	<h1><a class="title" href="index.php"><span><?php fl_title(); ?></span></a></h1>
</div>
<!-- end header -->
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
		<?php fl_page_content_think(
		"<div class=\"post\">
			<h2 class=\"title\"><a href=\"index.php?mod=shownews&p=%id%\">%title%</a></h2>
			<p class=\"meta\"><img src=\"{$path}/imgs/author.png\"/> Автор:%author% <br/>
			<img src=\"{$path}/imgs/calendar.png\"/>%date%
			</p>
			<div class=\"entry\">
				<p>%text%</p>
			</div>
		</div><br/>", 
		"<div class=\"post\">
			<h2 class=\"title\"><a href=\"index.php?mod=shownews&p=%id%\">%title%</a></h2>
			<p class=\"meta\"><img src=\"{$path}/imgs/author.png\"/> Автор:%author% <br/>
			<img src=\"{$path}/imgs/calendar.png\"/>%date%
			</p>
			<div class=\"entry\">
				<p>%text%</p>
			</div>
		</div><br/>",
		"<div class=\"post\">
		<div class=\"container\">",
		"</div></div><br/>"
		); ?>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
			<li>
				<h2>Меню</h2>
			 <?php fl_menu_think(); ?><hr/>
			 <?php fl_sidebar_print(); ?>
			</li>
		</ul>
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end sidebar -->
</div>
<!-- end page -->
<div id="footer">
<?php fl_copyright(); ?>
</div>
<script>
$(".post").corner("keep sc:#c7c7c7");
$("#sidebar").corner("keep sc:#c7c7c7");
</script>
</body>
</html>
