<?php  require_once 'includes/comments.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php global $path; echo $path; ?>css/comments.css">
<script type="text/javascript" src="includes/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo "./includes/"; ?>comment.js"></script>
</head>
<body>
<ul id="commentRoot">
<?php 
	global $events;
	$events->fire("comments_print_start","");
	echo $comments;
	$events->fire("comments_print_end","");
?>
<li id="newComment">
   <div class="commentContent">
      <div id="cancelComment">X</div>
          <h6>Ваше имя: <input name="name" type="text"> <span></span> </h6>
          <div class="comment">
              Комментарий: 
              <textarea name="newCommentText"></textarea>
          </div>
          
         <button>Сохранить</button><img class="loader" src="<?php echo $path; ?>imgs/loader.gif">
      </div>                            
  </li>

</ul> 
<button id="addNewComment">Добавить комментарий</button>
   
</body>
</html>
