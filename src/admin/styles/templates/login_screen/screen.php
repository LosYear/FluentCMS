<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Добро пожаловать в панель управления!</title>
<link href="styles/templates/login_screen/screen.css" rel="stylesheet" type="text/css" />
<script type='text/javascript' src='styles/templates/login_screen/js/jquery-1.3.2.js'></script>
<script type="text/javascript">
        $(document).ready(function() {
		
            $(document).mouseup(function() {
				$("#loginform").mouseup(function() {
					return false
				});
				
				$("a.close").click(function(e){
					e.preventDefault();
					$("#loginform").hide();
                    $(".lock").fadeIn();
				});
				
                if ($("#loginform").is(":hidden"))
                {
                    $(".lock").fadeOut();
                } else {
                    $(".lock").fadeIn();
                }				
				$("#loginform").toggle();
            });
			


			 // This is example of other button
			$("input#cancel_submit").click(function(e) {
					$("#loginform").hide();
                    $(".lock").fadeIn();
			});		
		
			
        });
	function sendData(){
		var username;
		username = document.getElementById('username').value;
		var password;
		password = document.getElementById('password').value;
		$.ajax({
			url:"index.php?mod=login",
			async : false,
			type : 'POST',
			data : {username : username, password: password},
			processData : true,
			success : function(data){ if(data == "WPL" ){alert("Вы ввели не правильный логин или пароль" );} }
					
		});
				return false;
		//$.post("index.php?mod=login", {username : username, password: password},function(data){ console.write(typeof(data)); alert("123"); });
		alert("DOJILI");
	}
</script>
</head>
<body>
<div id="cont">
  <div class="box lock"> </div>
  <div id="loginform" class="box form">
    <h2> Запрос Авторизации <a href="" class="close"> Закрыть </a></h2>
    <div class="formcont">
      <fieldset id="signin_menu">
      <span class="message">Вход в панель управления</span>
      <form method="post" id="signin" ><!--action="index.php?mod=login"-->
        <label for="username">Имя пользователя</label>
        <input id="username" name="username" value="" title="username" class="required" tabindex="4" type="text">
        </p>
        <p>
          <label for="password">Пароль</label>
          <input id="password" name="password" value="" title="password" class="required" tabindex="5" type="password">
        </p>
        <p class="clear"></p>
        <a href="../index.php" class="forgot" id="resend_password_link">Вернуться</a>
        <p class="remember">
          <input id="signin_submit" name="bSumbit" value="Войти" tabindex="6" type="submit" onclick="sendData();">
          <input id="cancel_submit" value="Отмена" tabindex="7" type="button">
        </p>
      </form>
      </fieldset>
    </div>
    <div class="formfooter"></div>
  </div>
</div>
<!-- Begin Full page background technique -->
<div id="bg">
  <div>
    <table cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="styles/templates/login_screen/images/bg.jpg" alt=""/> </td>
      </tr>
    </table>
  </div>
</div>
<!-- End Full page background technique -->
</body>
</html>
