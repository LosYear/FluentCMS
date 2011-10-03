<?php   require_once 'header.php'; require_once 'sidebar.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
  <HEAD>
    <TITLE>{TITLE}</TITLE>
    <meta content="text/html; http-equiv="Content-Type" />
	<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>style.css">
  </HEAD>
  <BODY>
	<xml:namespace ns="urn:schemas-microsoft-com:vml" prefix="v" />
	<v:roundrect arcsize=".04" fillcolor="#000">
  	<FORM action="../usercp.php?mod=register_true" method="post">
		<P align="center">
		<?php echo $nick." :" ?> <BR>
		<INPUT type="input" name="login">
		<BR>
		<?php echo $pass." :"; ?>
		<BR>
		<INPUT type="PASSWORD" name="pass1" action="">
		<BR>
		<?php echo $repeat_pass." :"; ?>
		<BR>
		<INPUT type="PASSWORD" name="pass2" action="">
		<BR>
		<?php echo $your_mail." :"; ?>
		<BR>
		<INPUT type="input" name="email">
		<BR>
		<INPUT class="input_submit" type="submit" name="OK" value="OK"></P>
    </FORM>
	</v:roundrect>
  </BODY>
    <?php require_once 'footer.php'; ?>
</HTML>