<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <link rel=Stylesheet type="text/css" href="styles/main.css">
    <style type="text/css">
        .style1
        {
            width: 100%;
        }
        .style2
        {
            width: 221px;
        }
    </style>
</head>
<body>
<form action="index.php?mod=plugins&m=install&step=2" method="post">
<div class="block">
<center>
	<?php
		if ( $_REQUEST['step'] === '2' ){
			echo "Installed";
		}
	?>
	<h2>Установка расширений</h2>
	Введите название папки с расширением :<br/>
	<input type="text" name="plugin_folder"> </input><br/>
	<input type="submit" name="Установить" value="Установить расширение"></input><br/>
</center>
</div>
</form>
</body>
</html>
