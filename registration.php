<!--
registration.php - Displays the sign up page.
Originally created by Matthew Testerman 11/1/2014
Edited by Matthew Testerman on 11/9/2014
Last Edited by Alex Morris on 12/1/2014 - Updated for patern matching
-->
<?php
#include header.php
include('header.php');
if(isset($_SESSION['login_email']))
{
	header('Location: profile-welcome.php');
}
?>
<!--start of blank portion of webpage -->
<div id="content">
  <div id="content-main-profile">
  <?php
  if ($_GET['error'] == "exists")
  {
  	echo "<h3>Sorry, that email already exists! Please try again. </h3>";
  }
  if ($_GET['error'] == "invalidFirstName")
  {
  	echo "<h3>Please enter a valid first name. </h3>";
  }
  if ($_GET['error'] == "invalidLastName")
  {
  	echo "<h3>Please enter a valid last name. </h3>";
  }
  if ($_GET['error'] == "invalidEmail")
  {
  	echo "<h3>Please enter a valid email address. </h3>";
  }
  
  if ($_GET['error'] == "invalidPassword")
  {
   echo "<h3>Password must be 8-20 characters and must contain letters and numbers. </h3>";
  }
  if ($_GET['error'] == "invalidPassword2"){
   echo "<h3>Passwords do not match. </h3>";
   }
   
  ?>
  
    <h3>Join GruHam to receive all the wonderful benefits GruHAM has to offer!</h3>
  <p>Fill out the form below.  </p>
  <form name="registerationform" method="post" action="registration-post.php">
    <p>Email:</p>
    <p>
      <input name="email" type="text" id="email" size="25">
    </p>
    <p>First Name:</p>
    <p>
      <input name="firstname" type="text" id="firstname" size="25">
    </p>
    <p>Last Name:</p>
    <p>
      <input name="lastname" type="text" id="lastname" size="25">
    </p>
    <p>Password (8-20 characters, must contain letters and numbers): </p>
    <p>
      <input name="password1" type="password" id="password1" size="25">
    </p>
    <p>Retype Password:</p>
    <p>
      <input name="password2" type="password" id="password2" size="25">
    </p>
    <p>&nbsp;</p>
    <p>
      <input type="submit" name="submit" id="submit" value="Submit">
    </p>
  </form>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>
<?php
#include footer.php
include('footer.php');
?>