<?php
include("functions.php");
session_start();
#Get form information
$email = $_POST['email'];
$password = $_POST['password'];

#Validate input and sanitize it here
#(NEED FUNCTIONS)
#EX: $password = santize_password($password);

#call function to confirm if login is correct
$logged_in = check_user_name_password($email,$password);

#if true then set up session & send on to welcome page.
if ($logged_in)
{
	if (!is_site_enabled() && !is_admin($email))
	{
		header('Location:login.php?error=system_error');
		exit;
	}
	#if user has not activated account do not login. Go back to login page.
	if (!is_activated($email))
	{
		header('Location:login.php?error=activate');
		exit;
	}
	#if user is suspended then stop login
	if(is_suspended($email))
	{
		header('Location:login.php?error=suspended');
		exit;
	}	
	#after session is created... send user to the profile-welcome.php
	$_SESSION['login_email'] = $email;
	#update login time
	update_user_login_time($email);
	#send to login welcome page
	header('Location:profile-welcome.php');
}
#if false then send back to login page.
else
{
	header('Location:login.php?error=badLogin');
	exit;
}
?>