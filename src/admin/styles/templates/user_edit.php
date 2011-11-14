<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<link rel="stylesheet" type="text/css" href="styles/main.css">
	</head>
	<body>
	<div class="block">
			<center>
			<div id="page">
				<form action="index.php?mod=users&sub=edit&step=submit&id=<?php echo $_REQUEST['id'];?>" method="post"> 
					<label for="login">Логин</label><br/>
					<input type="text" name="login" value="<?php echo $user['login'];?>"/><br />
					<label for="email">Email</label><br />
					<input type="text" name="email" value="<?php echo $user['email'];?>"/><br />
					<label for="group">Группа</label><br/>
					<select name="group">
						<option value="1" <?php if($user['group']=='1'){echo "selected=\"selected\"";}?>>Администратор</option>
						<option value="2" <?php if($user['group']=='2'){echo "selected=\"selected\"";}?>>Модератор</option>
						<option value="0" <?php if($user['group']=='0'){echo "selected=\"selected\"";}?>>Пользователь</option>
					</select>
					<input type="submit" value="OK"/>
				</form>
			</div>
			</center>
		</div>
	</body>
</html>
