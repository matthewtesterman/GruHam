<!--
header.php - This part of the file belongs to the header. Every page references this file.
Last Edited by Matthew Testerman on 12/1/2014
Orginally created by Matthew Testerman 11/1/2014
-->
<!doctype html>
<html>
<head>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css'>
<meta charset="UTF-8">
<title>Housing &amp; Mortgage</title>
<link href="assets/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="banner">
<a href="index.php"><img src="assets/logo-main.png" width="375" height="85"></a>
</div>
<div id="bar">
<div id="bar-login">
<p><?php 
if (isset($_SESSION['login_email']))
{
	$name = get_first_name($_SESSION['login_email']);
	echo "Welcome, <a href='profile-welcome.php'>$name</a>! ";
	#If the user is an administrator display the admin menu
	if (is_admin($_SESSION['login_email']))
	{
		echo "| <a href=\"admin-user-management.php\">User Management</a> | <a href=\"admin-security.php\">Security</a> ";
	}
	
	echo "| <a href=\"logout.php\">Logout</a>";
	
}
	else
	{
	echo "<a href=\"login.php\">Login</a> | <a href=\"forgot-password.php\">Forgot your password?</a> | <a href=\"registration.php\">Sign Up!</a></p>";
	}

?>
</div>
</div>