<!--
forgot-password.php
Created by Matthew Testerman 11/17/14
Displays a form to be used to reset password.

-->
<?php
include("header.php");
?>
<div id="content">
  <div id="content-main-profile">
  <?php
  ##Display message in applicable
  if ($_GET['message'] == "nouser")
  {
	   echo "<h2>That e-mail does not exist. Please re-enter your email.</h2>";
  }
  if ($_GET['message'] == "reset")
  {
	   echo "<h2>Please check your email for further instructions.</h2>";
  }  
  ?>
  <h3>Forgot Password</h3>
  
  <p>Enter your email:</p>
  <p><form  name="forgotpassword" action="forgot-password-post.php" method="post">
  <input type="text" name="email" id="email"><br /><br />
  <input type="submit" name="submit" id="submit" value="submit"></p>
  
  </form>
  
 </div>
</div>



<?php
include("footer.php");
?>