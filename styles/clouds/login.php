<?php require_once("./includes/functions.php"); ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title><?php fl_title(); ?> </title>
    <link rel="stylesheet" type="text/css" href="<? echo $path; ?>css/reset-min.css">
    <link rel="stylesheet" type="text/css" href="<? echo $path; ?>css/tut.css">
    
    <script type="text/javascript" src="<? echo $path; ?>js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="<? echo $path; ?>js/jquery.scrollTo-1.4.2-min.js"></script>
    
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
	      <style type="text/css">
          .style3
          {
              text-align: center;
          }
          .alt
          {
              text-align: left;
          }
          .input_submit
          {
              text-align: center;
          }
      </style>
</head>
<body>
	<div id="cloud1" class="clouds">
    	<div id="clouds-small"></div>
    </div><!-- clouds -->
    <div id="cloud2" class="clouds">
        <div id="clouds-big"></div>
    </div><!-- clouds -->
	<div id="header">
   		<h1 id="logo"><?php fl_title(); ?></h1>
    	<ul id="menu">
		  <li><div class="link"><?php fl_menu_think(); ?></div></li>
      </ul>
	</div><!-- header -->
 <form method="post" action="../usercp.php?mod=login_true">
 	<div id="wrapper">
    	<ul id="mask">
        	<li id="box1" class="box">
			 <div class="content"><div class="inner"><center>
	<table cellspacing="0" align="center">
      <caption><?php echo $login_capt; ?></caption>

          <tr>
              <td class="style2">
            <div style="width: 70px; display: inline; height: 15px" ms_positioning="FlowLayout"><?php echo $nick;?> </div>
              </td>
              <td class="style1">
                  <input name="login" /></td>
          </tr>
          <tr>
              <td class="style2">
            <div style="width: 70px; display: inline; height: 15px" ms_positioning="FlowLayout"><?php echo $pass ?></div>
              </td>
              <td class="style1">
                  <input type="password" name="pass" /></td>
          </tr>
          <tr>
              <td class="style3" colspan="2">
                    
                  <input class="input_submit" value="<?php echo $login ?>" type="submit" name="in" /><center>
                  </center></td>
          </tr>

      </table>
	  <HR>
	  <?php
    echo $copyright;
?>
	  </center></div></div>
  </body>
</form>
</html>