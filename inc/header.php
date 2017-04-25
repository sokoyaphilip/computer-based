<?php
include_once 'check_login_status.php';
$nav = "";
$nav = '<a href="login.php">Login</a> &nbsp;&nbsp;/&nbsp;&nbsp;<a href="register.php">Sign up</a>';
	
?>
  <div id='Head'>
         <div class="Title"><h1><em>...Welcome To Your Computer Solution Center!</em></h1></div>
         <div id="loglink"><h1><?php echo $nav;?></h1></div>
  </div>