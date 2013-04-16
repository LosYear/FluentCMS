<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<link rel="stylesheet" type="text/css" href="styles/main.css">
		<link rel="stylesheet" type="text/css" href="styles/checkBox/jquery.tzCheckbox/jquery.tzCheckbox.css" />
		</head>
	<body>
<div class="block">
P.S: А дизайн сломался ;-)<br>
Уже работаем<br>
 			<center>
			<div id="page">
					<div>
					<a href="index.php?mod=plugins&m=install&step=1">Установить плагин</a>
					</div>
					<form method="post">
						<table>
							<tr>
								<td>
								   <b>Название плагина</B></td>
								<td>
									Описание</td>
								<td>
									Контакты</td>
								 <td>
									Состояние</td>
								<td>
									Действия</td>
							</tr>
							<?php echo $plugins_list; ?>
						</table>
					</form>
			</div>
				<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
				<script src="styles/checkBox/jquery.tzCheckbox/jquery.tzCheckbox.js"></script>
				<script src="styles/checkBox/js/script.js"></script>
			</center>
		</div>
	</body>
</html>
