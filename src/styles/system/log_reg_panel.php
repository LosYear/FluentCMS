<?php session_start();  global $theme_name;?><!-- Панель --><div id="toppanel"><div id="panel"><div class="content clearfix"><div class="left">Добро пожаловать!</div><?phpif(!$_SESSION['auth']):// Если Вы еще не зарегистрированы?><div class="left"><!-- Форма Входа --><form class="clearfix" action="usercp.php?mod=login_true" method="post">Вход для зарегистрированных пользователей<?phpif($_SESSION['msg']['login-err']){echo '<div class="err">'.$_SESSION['msg']['login-err'].'</div>';unset($_SESSION['msg']['login-err']);// This will output login errors, if any}?><label class="grey" for="username">Имя пользователя:</label><input class="field" type="text" name="username" id="username" value="" size="23" /><label class="grey" for="password">Пароль:</label><input class="field" type="password" name="password" id="password" size="23" /><div class="clear"></div><input type="submit" name="submit" value="Войти" class="bt_login" /></form></div><div class="left right"><!-- Форма регистрации --><form action="usercp.php?mod=register_true" method="post">Введите данные<?phpif($_SESSION['msg']['reg-err']){echo '<div class="err">'.$_SESSION['msg']['reg-err'].'</div>';unset($_SESSION['msg']['reg-err']);// Здесь выводим ошибку регистрации, если она есть}if($_SESSION['msg']['reg-success']){echo '<div class="success">'.$_SESSION['msg']['reg-success'].'</div>';unset($_SESSION['msg']['reg-success']);// Здесь выводим сообщение об успешности регистрации}?><label class="grey" for="username">Имя пользователя:</label><input class="field" type="text" name="username" id="username" value="" size="23" /><label class="grey" for="email">Email:</label><input class="field" type="text" name="email" id="email" size="23" /><label class="grey" for="password">Пароль:</label><input class="field" type="password" name="password" id="password" size="23" /><label class="grey" for="password2">Повторите пароль:</label><input class="field" type="password" name="password2" id="password" size="23" /><input type="submit" name="submit" value="Зарегистрироваться" class="bt_register" /></form></div><?phpelse:// Если вы вошли в систему?><div class="left"><?php 	if ($_SESSION['group'] === '1'){ echo '<a href="../admin/index.php"><img title="Панель управления сайтом" border=0 src="../styles/'.$theme_name.'/imgs/control_panel2.png" ></a> ';}		echo '<a href="../usercp.php"><img title="Управление профилем" border=0 src="../styles/'.$theme_name.'/imgs/user_panels.png" ></a> ';			global $events;		$events->fire("login_panel_echo","");?><br><a href="usercp.php?mod=logout">Выйти из системы</a></div><div class="left right"></div><?phpendif;// Закрываем конструкцию IF-ELSE?></div></div> <!-- /login --><!-- Закладка наверху --><div class="tab"><ul class="login"><li class="left">&nbsp;</li><li>Здравствуйте <?php echo $_SESSION['login'] ? $_SESSION['login'] : 'Гость';?>!</li><li class="sep">|</li><li id="toggle"><a id="open" class="open" href="#"><?php echo $_SESSION['auth']?'Открыть панель':'Вход|Регистрация';?></a><a id="close" style="display: none;" class="close" href="#">Закрыть панель</a></li><li class="right">&nbsp;</li></ul></div></div> 