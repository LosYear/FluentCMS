<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php fl_title(); ?></title>

<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>css/style.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>css/panel.css">
<link rel="stylesheet" type="text/css" href="styles/system/css/slide.css">

<script type="text/javascript" src="includes/jquery-1.7.min.js"></script>
<script src="styles/system/js/slide.js" type="text/javascript"></script>

<?php $events->fire("fl_head_add_script",""); ?>

<?php echo $script; ?>

</head>
<body text_id="<?php echo $_REQUEST['p'];?>">
<?php fl_logreg_panel(); ?>
<div id="pageContent">
	<div class="header">
		<a href="index.php"><img src="<?php echo $path; ?>imgs/Logo.png" align="left"></a>
		 <H1><?php fl_title(); ?></H1>
		 <H2><?php fl_desc(); ?></H2>
	</div>
	<div id="bd">
		<div class="container">
			 <?php fl_page_content_think(); ?>
		</div>
		<div class="sidebar">
			 <?php fl_menu_think(); ?><hr/>
			 <?php fl_sidebar_print(); ?>
		</div>
	</div>
	<div class="footer">
		 <?php fl_copyright(); ?>
	</div>
</div>
</body>
</html>
