<?php session_start(); ?>
<xml:namespace ns="urn:schemas-microsoft-com:vml" prefix="v" />

<v:roundrect arcsize=".04" fillcolor="#000">
<center>
<?php
$str='lang/'.$language.".php";
require_once $str;
echo '<a href="../index.php"><img border=0 src="../styles/'.$theme_name.'/images/toolbar_home.png" ></a>';
fl_pages();
if ($_SESSION['auth'] === true && $_SESSION['group'] === '1') {
   echo '<a href="../admin/index.php"><img border=0 src="../styles/'.$theme_name.'/images/control_panel2.png" ></a>';
}
if ($_SESSION['auth'] === true) {
	echo '<a href="../usercp.php"><img border=0 src="../styles/'.$theme_name.'/images/user_panels.png" ></a>';
}
if ($_SESSION['auth'] === true) {
    echo '<a href="../usercp.php?mod=logout"><img border=0 src="../styles/'.$theme_name.'/images/logout.png" ></a>';

} else {
    echo '<a href="../usercp.php?mod=login"><img border=0 src="../styles/'.$theme_name.'/images/login.png" ></a>';
}
if ($_SESSION['auth'] !== true) {
    echo '<a href="../usercp.php?mod=register"><img border=0 src="../styles/'.$theme_name.'/images/register.png" ></a>';

}
?>
</center>
</v:roundrect>
<br/>