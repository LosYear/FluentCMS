<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <link rel=Stylesheet type="text/css" href="styles/system/css/style.css">
</head>
<body>
<xml:namespace ns="urn:schemas-microsoft-com:vml" prefix="v" />
<v:roundrect arcsize=".04" fillcolor="#000">
	<center><h1>Панель пользователя</h1></center>
</v:roundrect>
<br>
<xml:namespace ns="urn:schemas-microsoft-com:vml" prefix="v" />
<v:roundrect arcsize=".04" fillcolor="#000">
	<form method="post" action="usercp.php?mod=passchange&step=2">
		<center>
			<form action="usercp.php?mod=passchange">
				<b> Сменить пароль </b><br/>
				<label for="oldpass">Введите старый пароль:</label><br/>
				<input type="password" name="oldpass"/><br/>
				
				<label for="newpass">Введите новый пароль:</label><br/>
				<input type="password" name="newpass" /><br/>
				
				<label for="newpass2">Повторите новый пароль:</label><br/>
				<input type="password" name="newpass2" /><br/>
				
				<input type="submit" value="Изменить"/>
			</form>
		</center>
	</form>
</v:roundrect>
</body>
</html>
