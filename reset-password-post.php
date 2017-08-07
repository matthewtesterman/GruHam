<?php
include("functions.php");
include("header.php");

#Get data
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$act_key = $_GET['act_key'];
$email = $_GET['email'];
#If password do not match then send user back
if (check_valid_activation($act_key, $email)==false)
{
	header("Location:index.php?name$act_key&name=$email");
	exit;
}
if ($password1 != $password2)
{
	header("Location:reset-password.php?actid=$act_key&email=$email&error=password_mismatch");
	exit;
}
else
{
	reset_activation_key($email);
	reset_password($email,$password1);
	header("Location:login.php?message=start");
	exit;
}
#validate password (FUNCTION NOT FINISHED)


?>
<div id="content">
  <div id="content-main-profile">
<h3>You have successfully reset your password for account <?php echo $email; ?>. </h3>
	</div>
</div>
<?php
include("footer.php");
?>