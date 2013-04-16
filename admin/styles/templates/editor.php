<?php
  session_start();
  if ($_SESSION['auth'] === true) {
      if ($_SESSION['group'] != 1) {
          die('&#1056;’&#1057;‹ &#1056;&#1029;&#1056;µ &#1057;&#1039;&#1056;&#1030;&#1056;»&#1057;&#1039;&#1056;µ&#1057;‚&#1056;µ&#1057;&#1027;&#1057;&#1034; &#1056;°&#1056;&#1169;&#1056;&#1112;&#1056;&#1105;&#1056;&#1029;&#1056;&#1105;&#1057;&#1027;&#1057;‚&#1057;&#1026;&#1056;°&#1057;‚&#1056;&#1109;&#1057;&#1026;&#1056;&#1109;&#1056;&#1112; &#1056;&#1169;&#1056;°&#1056;&#1029;&#1056;&#1029;&#1056;&#1109;&#1056;&#1110;&#1056;&#1109; &#1057;&#1027;&#1056;°&#1056;&#8470;&#1057;‚&#1056;°!');
      } else {
          
          $action = "index.php?mod=add&step=2";
          require_once("../config.php");
          if ($_REQUEST['mod'] === 'edit') {
              if (!mysql_connect($db_host, $db_user, $db_pass))
                  die(mysql_error());
              mysql_select_db($db);
              $id = $_REQUEST['p'];
              $query = "SELECT * FROM `$db`.`texts` WHERE id=$id";
              $result = mysql_query($query);
              $r = mysql_fetch_array($result);
              $caption = $r['caption'];
              $text = $r['text'];
              $action = "index.php?mod=edit&step=2&p=$id";
          }
          echo '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251">
<link rel="stylesheet" type="text/css" href="styles/main.css">
<link rel="stylesheet" type="text/css" href="styles/button.css">
<script type="text/javascript" src="../editor/tiny_mce.js"></script>
<script type="text/javascript">
  tinyMCE.init({
    // General options
    mode : "textareas",
    theme : "advanced",
    language : "ru",
    skin : "o2k7",
    plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

    // Theme options
    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect,|,bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,image,code,pagebreak",
    theme_advanced_buttons2 : "",
    theme_advanced_buttons3 : "",
    theme_advanced_buttons4 : "",
    // theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
    // theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
    // theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true,

    // Example word content CSS (should be your site CSS) this one removes paragraph margins
    content_css : "css/word.css",

    // Drop lists for link/image/media/template dialogs
    template_external_list_url : "lists/template_list.js",
    external_link_list_url : "lists/link_list.js",
    external_image_list_url : "lists/image_list.js",
    media_external_list_url : "lists/media_list.js",

    // Replace values for the template plugin
    template_replace_values : {
      username : "Some User",
      staffid : "991234"
    }
  });
</script>
<!-- /TinyMCE -->
<title></title>
</head>
<body>
<div class=\"block\">
<form method="post" action=' . $action . '>
<CENTER>&#1053;&#1072;&#1079;&#1074;&#1072;&#1085;&#1080;&#1077; <INPUT type="input" name="caption" value="' . $r['caption'] . '"></input></CENTER><BR/><center>';
          if ($_SESSION['group'] == 1) {
              echo '<input type="checkbox" 
name="isPage" ';
              if ($r['isPage'] != 0)
                  echo 'checked="true"';
              echo '/> &#1054;&#1073;&#1086;&#1079;&#1085;&#1072;&#1095;&#1080;&#1090;&#1100; &#1089;&#1087;&#1088;&#1072;&#1074;&#1086;&#1095;&#1085;&#1086;&#1081; &#1089;&#1090;&#1072;&#1090;&#1100;&#1077;&#1081;? ( &#1053;&#1077; &#1074;&#1099;&#1074;&#1086;&#1076;&#1080;&#1090;&#1089;&#1103; &#1074; &#1089;&#1087;&#1080;&#1089;&#1082;&#1077; &#1089;&#1090;&#1072;&#1090;&#1077;&#1081;)';
          }
          echo '<br/> <input type="checkbox" name="isHidden" ';
          if ($r['isHidden'] != 0) {
              echo 'checked="true"';
          }
          echo "/> &#1057;&#1082;&#1088;&#1099;&#1090;&#1072;&#1103; &#1089;&#1090;&#1088;&#1072;&#1085;&#1080;&#1094;&#1072;";
          echo '
  <textarea id="elm1" name="spaw1" rows="40" cols="80" style="width: 100%">';
          echo $text;
          echo '</textarea>
  </body>
  </html>';
          echo '<center><input type=submit class=input_submit value="Добавить"></CENTER>
</form>
<br>
<br>
<br>
<br>
</div>
</body>
</html>';
      }
  } else {
      
      die('&#1056;’&#1057;‹&#1056;&#1111;&#1056;&#1109;&#1056;»&#1056;&#1029;&#1056;&#1105;&#1057;‚&#1056;µ &#1056;&#1030;&#1057;…&#1056;&#1109;&#1056;&#1169;!');
  }
?>

