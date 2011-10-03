<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <link rel=Stylesheet type="text/css" href="styles/main.css">
</head>
<body>
<xml:namespace ns="urn:schemas-microsoft-com:vml" prefix="v" />
<v:roundrect arcsize=".04" fillcolor="#000">
	<form method="post" action="index.php?mod=siteedit&step=2">
		<center>
			<label for="sitename">Имя сайта:</label><br/>
			<input type="text" name="sitename" value="<?php echo $site_name ?>" size="50" />
			<br/>
			
			<label for="sitedesc">Подзаголовок сайта:</label><br/>
			<input type="text" name="sitedesc" value="<?php echo $site_describe; ?>" size="50" />
			<br/>
			
			<label for="copyright">Копирайты:</label><br/>
			<input type="text" name="copyright" value="<?php echo $copyright; ?>" size="50" />
			<br/>
			
			<input type="submit" name="submit" value="Изменить" />
		</center>
	</form>
</v:roundrect>
</body>
</html>
