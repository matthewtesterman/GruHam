<!--
Contact Us.php - Displays the Contact page.

Originally created by Alex Morris 11/12/2014

Last Updated Matthew Testerman 11/23/2014
-->
<?php
$access = "public"; #Variable used to restrict user access (private or public) -MT
include("session.php"); # -MT
include("header.php");
?>
<div id="content">
  <div id="content-main-profile">
 <?php
if ($_GET['message'] == 'error')
{
echo "<h3>One of the fields is incorrect. Please fill out all fields.</h3>";

}	
if ($_GET['message'] == 'confirmed')
{
echo "<h3>Your message was successfully sent.</h3>";

}	    
  ?>
  <h3>Contact Us</h3>
 
  <form action="contact-us-post.php" method="post">
Name:<br>
<input type="text" name="name"><br>
E-mail:<br>
<input type="text" name="email"><br>
Comment:<br>
<textarea name="message" rows="10" cols="50"></textarea>
<br>
<br>
<input type="submit" value="Send">
</form>

 </div>




<?php
include("footer.php");
?>
