<?php
include('functions.php');
session_start();
$check=$_SESSION['login_email'];
$session=query_db("SELECT gh_email FROM gh_users WHERE gh_email = '$check'");
$row=mysqli_fetch_array($session);
$login_session=$row['gh_email'];
if(!isset($login_session) && $access == 'private')
{
header("Location:index.php");
}
$profile = get_profile_info($login_session);
?>