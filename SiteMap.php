<!--
Contact Us.php - Displays the Contact page.

Originally created by Alex Morris 11/12/2014
Updated 11/23/2014 Matthew Testerman
Updated 11/19/2014 Chris Sayre
-->
<?php
$access = "public"; #Variable used to restrict user access (private or public) -MT
include("session.php"); # -MT
include("header.php");
?>
<div id="content">
  <div id="content-main-profile">
  <h3>Site Map</h3>
  
  <p><a href="index.php">Home</a></p>
  <p><a href="ContactUs.php">Contact Us</a></p>
  <p><a href="registration.php">Sign Up</a></p>
  <p><a href="login.php">Log In</a></p>
  <p><a href="forgot-password.php">Forgot Your password?</a></p>
  
  
 </div>
</div>



<?php
include("footer.php");
?>