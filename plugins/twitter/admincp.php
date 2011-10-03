<html>
<head>
	<link rel="stylesheet" type="text/css" href=<?php echo "\"../plugins/{$_POST['folder']}/styles/main.css\"" ?>/>
</head>
<body>
	<div id="logo">
		<img src=<?php echo "\"../plugins/{$_POST['folder']}/imgs/logo.png\"" ?>>
		<font size="6"> Настройки Twitter</font>
	</div>
	<center>
		<form action=<?php echo "\"../plugins/{$_POST['folder']}/admin.php?mod=edit\""?> method="post">
			<div id="content">
    			<label for="username">Имя пользователя</label><br>
    			<input type="text" name="username" value=<?php echo "\"$username\"";?>><br>
    			
    			<label for="twittsMaxCount">Выводимое количество твитов</label><br>
    			<input name="twittsMaxCount" value=<?php echo "\"$twittsMaxCount\"";?>><br>
    			
    			<label for="twittWrapper">Шаблон твита</label><br>
    			<textarea rows="5" name="twittWrapper"><?php echo htmlspecialchars("$twittWrapper");?></textarea><br>
    			
    			<label for="dateFormat">Формат даты</label><br>
    			<input type="text" name="dateFormat" value=<?php echo "\"$dateFormat\"";?>><br>
    			
    			<input type="submit" value="OK">
			</div>
		</form>
	</center>
</body>
</html>