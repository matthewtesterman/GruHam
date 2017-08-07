<!--
forgot-password.php
Created by Matthew Testerman 11/17/14
Handles forgot user input and validates the input. Sends email to reset password.

-->
<?php
#error_reporting(E_ALL);
include("functions.php");

#Get form data
$email = $_POST['email'];

#If user exists then go ahead and reset password else go back to forgot-login.php with an error message.
if (check_if_user_exists($email))
{
	#Gets user's activation key
	$act_key = get_activation_key($email);
	
	#Prepare email to send
	$subject = "Reset Password";
	$body = "Click this URL to reset your password: $url/reset-password.php?actid=$act_key&email=$email";
	#Send email temporary password
	mail($email, $subject, $body);	
	header("Location:forgot-password.php?message=reset");
}
else
{
	header("Location:forgot-password.php?message=nouser");
}





?>