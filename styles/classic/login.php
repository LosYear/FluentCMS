<?php   require_once 'header.php'; require_once 'sidebar.php'; ?>
<html>
  <head>
    <title></title>
    <meta content="text/html; http-equiv="Content-Type" />
    <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>style.css">


 

      <style type="text/css">
          .style3
          {
              text-align: center;
          }
          .alt
          {
              text-align: left;
          }
          .input_submit
          {
              text-align: center;
          }
      </style>

 

  </head>
 <form method="post" action="../usercp.php?mod=login_true">
  <body>
	<xml:namespace ns="urn:schemas-microsoft-com:vml" prefix="v" />
	<v:roundrect arcsize=".04" fillcolor="#000">
	<table cellspacing="0" align="center">
      <caption><?php echo $login_capt; ?></caption>

          <tr>
              <td class="style2">
            <div style="width: 70px; display: inline; height: 15px" ms_positioning="FlowLayout"><?php echo $nick;?> </div>
              </td>
              <td class="style1">
                  <input name="login" /></td>
          </tr>
          <tr>
              <td class="style2">
            <div style="width: 70px; display: inline; height: 15px" ms_positioning="FlowLayout"><?php echo $pass ?></div>
              </td>
              <td class="style1">
                  <input type="password" name="pass" /></td>
          </tr>
          <tr>
              <td class="style3" colspan="2">
                    
                  <input class="input_submit" value="<?php echo $login ?>" type="submit" name="in" /><center>
                  </center></td>
          </tr>

      </table>
</v:roundrect>
  </body>
</form>
  <?php require_once 'footer.php'; ?>
</html>