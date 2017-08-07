<!--
registration.php - Displays the sign up page.
Last Edited by Matthew Testerman on 11/9/2014
Orginally created by Matthew Testerman 11/1/2014
-->
<?php
#include header.php
session_start();

if(isset($_SESSION['login_email']))
{
	header('Location: profile-welcome.php');
}
include('header.php');
?>
<!--start of blank portion of webpage -->
<div id="content">
  <div id="content-main-profile">
  <?php
  #if login is bad
  if ($_GET['error'] == "badLogin")
  {
  	echo "<h3>Sorry, invalid email/password! Please try again. </h3>";
  }
	#if user has not activated account yet
  if ($_GET['error'] == "activate")
  {
  	echo "<h3>You need to activate your account before you can login. Please check your email.</h3>";
  }    
  #If user is suspended they end up back here
  if ($_GET['error'] == "suspended")
  {
  	echo "<h3>Your account has been suspended please contact the administator if you have any questions.</h3>";
  }  
  #If user is suspended they end up back here
  if ($_GET['error'] == "system_error")
  {
  	echo "<h3>The website is currently down for maintenance. Please try again later.</h3>";
  }    
  #If user has changed their password they will be directed here,
   if ($_GET['message'] == "start")
  {
	echo "<h3>You have successfully changed your password!</h3>";
   }
  ?>
    <h3>Please Login:</h3>
  <form name="login" method="post" action="login-post.php">
    <p>Email:</p>
    <p>
      <input name="email" type="text" id="email" size="25">
    </p>
    <p>Password:</p>
    <p>
      <input name="password" type="password" id="firstname" size="25">
    </p>
    <p><a href="forgot-password.php">Forgot Password?</a></p>
	<br>
	<p>
      <input type="submit" name="submit" id="submit" value="Submit">
    </p>
	
  </form>
  <p>&nbsp;</p>
</div>
<?php
#include footer.php
include('footer.php');
?>