<?php
	//require_once("./includes/functions.php");
	require_once($path."lang/".$language.".php");
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title><?php fl_title(); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>css/reset-min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>css/tut.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>css/panel.css">
	<link rel="stylesheet" type="text/css" href="styles/system/css/slide.css">
	
    <script type="text/javascript" src="<?php echo $path; ?>js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="<?php echo $path; ?>js/jquery.scrollTo-1.4.2-min.js"></script>
	<script src="styles/system/js/slide.js" type="text/javascript"></script>

    <script type="text/javascript">
	$(document).ready(function() {  
		$('a.link').click(function () {  
			$('#wrapper').scrollTo($(this).attr('href'), 800);
			setPosition($(this).attr('href'), '#cloud1', '0px', '400px', '800px', '1200px')
			setPosition($(this).attr('href'), '#cloud2', '0px', '800px', '1600px', '2400px')
			$('a.link').removeClass('selected');  
			$(this).addClass('selected');
			return false;  
		});  
	});
	function setPosition(check, div, p1, p2, p3, p4) {
	if(check==='#box1')
		{
			$(div).scrollTo(p1, 800);
		}
	else if(check==='#box2')
		{
			$(div).scrollTo(p2, 800);
		}
	else if(check==='#box3')
		{
			$(div).scrollTo(p3, 800);
		}
	else
		{
			$(div).scrollTo(p4, 800);
		}
	};
	</script>
	<!-- Фиксируем PNG для IE6 -->
	<!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
	<!--[IE 6]>
	<script type="text/javascript" src="login_panel/js/pngfix/supersleight-min.js"></script>
	<![endif]-->
	<script src="login_panel/js/slide.js" type="text/javascript"></script>
	<?php echo $script; ?>
</head>

<body <?php echo "text_id=\"".$_REQUEST['p']."\""; ?> >
<?php fl_logreg_panel(); ?>
	<div id="cloud1" class="clouds">
    	<div id="clouds-small"></div>
    </div><!-- clouds -->
    <div id="cloud2" class="clouds">
        <div id="clouds-big"></div>
    </div><!-- clouds -->
	<div id="header">
   		<h1 id="logo"><?php fl_title(); ?></h1>
    	<ul id="menu">
		  <li><div class="link"><br><br><?php fl_menu_think(); ?></div></li>
      </ul>
	</div><!-- header -->
	<div id="wrapper">
    	<ul id="mask">
        	<li id="box1" class="box">
            	<a name="box1"></a>
                <div class="content"><div class="inner"><center><H1><?php fl_title();  ?><br/> </H1>
<H3><?php fl_desc(); ?></H3><br><HR/> <BR/><?php
    if($_REQUEST['mod']==='shownews'){
        fl_text($_REQUEST['p']);
		echo "<BR/>" ;
		require_once ('includes/comments_index.php');
    }
    else if($_REQUEST['mod']==''){
        fl_texts();
        

    }
    else{
        echo "Ooops.";
    }
?>
<br/>
<?php
    fl_copyright();
?></center></div></div>
    
        </ul><!-- mask -->
    </div><!-- wrapper -->
</body>
</html>
