<?php
#admin-security-post.php - Created by Matthew Testerman  on 11/23/2014

#Handles form data and disables or enables user to access website.
$access = "private"; #Variable used to restrict user access (private or public);
#include header.php
include("session.php");
include("header.php");
#Check if user is not admin then leave this page
if (!is_admin($login_session))
{
	header("Location:index.php");
}
$disable = $_POST['disable'];

enable_or_disable_site($disable, $profile['id']);
header("Location:admin-security.php?message=". $disable);
?>