<?php
#Created by Matthew Testerman on 11/11/14
#session.php - keeps track of the current login session of the user.

include('functions.php');

session_start();

$check=$_SESSION['login_email'];
$session=query_db("SELECT gh_email FROM gh_users WHERE gh_email = '$check'");
$row=mysqli_fetch_array($session);
$login_session=$row['gh_email'];

#restrict user from seeing all pages.
if(!isset($login_session) && $access == 'private')
{
	header("Location:index.php");
}

#Store user information into $profile
$profile = get_profile_info($login_session);

?>