<?php
#Created by Matthew Testerman 11-23-2014
# admin-user-management-post.php - Handles data from the adminstrator user management webapage and makes the desired changes to the user.

$access = "private"; #Variable used to restrict user access (private or public);
#include header.php
include("session.php");
include("header.php");

#If user is not admin then send user back to home page
if (!is_admin($login_session))
{
	header("Location:index.php");
}

#Get user input
$user_id = $_GET['id'];
$email = $_POST['email'];
$first_name = $_POST['name_first'];
$last_name = $_POST['name_last'];
$active = $_POST['gh_active'];
$delete_user = $_POST['remove'];
$suspend = $_POST['suspend'];
$role = $_POST['role'];
if ($role == "yes")
{
	$role = "admin";
}
else
{
	$role = "user";
}
#Validate user input here


#delete user if admin said yes and the user is not an admin
if ($delete_user == "yes")
{
	if (!is_admin($email) && $profile[$email] != $email)
	{
		remove_user($email);
		header("Location:admin-user-management.php?action=delete");
	}
	else
	{
		header("Location:admin-user-management.php?action=nodelete");
	
	}	
	exit;
}

#Update user information
$current_user_email = get_user_email($user_id);
#if the specified user's id == the current logged in admin's id then he cannot suspend himself. 
if ($user_id == $profile['id'] &&  $suspend == 1)
{
	header("Location:admin-user-management.php?action=suspend");
	exit;
}
#admin cannot downgrade theirself to user.
if ($user_id == $profile['id'] &&  $role == "user")
{
	header("Location:admin-user-management.php?action=role");
	exit;
}
##lets admin know they have to update their to a unique email.
if (check_if_user_exists($email) && $email == $current_user_email )
{
	update_user($user_id, $email, $first_name, $last_name, $role, $suspend, $active);
	header("Location:admin-user-management.php?action=success");
	exit;
}
if (check_if_user_exists($email) && $email != $current_user_email )
{
	header("Location:admin-user-management.php?action=duplicate");
	exit;
}
if (!check_if_user_exists($email) && $email != $current_user_email )
{
	update_user($user_id, $email, $first_name, $last_name, $role, $suspend, $active);
	header("Location:admin-user-management.php?action=success");	
	exit;
}
if (!check_if_user_exists($email) && $email == $current_user_email )
{
	#impossible scenario but just in case.
	header("Location:admin-user-management.php?action=duplicate");
	exit;
}

?>