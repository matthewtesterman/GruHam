<?php
include("functions.php");
include("header.php");
?>
<div id="content">
  <div id="content-main-profile">
  
<?php 
#Get variables
$act_key = $_GET['actid']; 
$email = $_GET['email']; 
$message = $_GET['error'];
#If user has valid acitvation to reset account then proceed with activation
if ($message == "password_mismatch")
{
	echo "<h2>Password mismatch. Please retype your password. Make sure they are identical.</h2>";
}
if (check_valid_activation($act_key, $email))
{
	echo "<h2>Reset your password</h2>";
	echo "<form action='reset-password-post.php?email=$email&act_key=$act_key' method='post'>";
	echo "<p>Enter a new password:<br /><input type='password' name='password1'></p>";
	echo "<p>Retype your password:<br /><input type='password' name='password2'></p>";
	echo "<input type='submit' name='submit'></p>";
	echo" </form>";
	
}
else
{
	header("Location:index.php");
}



  
  ?>
  
  
  
  </div>
</div>
<?php
include("footer.php");
?>