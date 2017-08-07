<!--
admin-security.php - Deals with security of the website
Last Edited by Matthew Testerman on 11/9/2014
-->
<?php
$access = "private"; #Variable used to restrict user access (private or public);
#include header.php
include("session.php");
include("header.php");

#If user is not admin then send user back to home page
if (!is_admin($login_session))
{
	header("Location:index.php");
}
?>
<!--start of blank portion of webpage -->
<div id="content">
<?php include("profile-menu.php");?>
<div id="content-main-profile">
  <h3>Website Security</h3>
  <p>
  <?php
  
  if (isset($_GET['message']))
  {
	  echo "<h4>You have successfully made a change.</h4>";
  }
  
  ?>
  <form name="disable-site" action="admin-security-post.php" method="post">
  Disable all general users from logging in?<br>
  <?php
  if (is_site_enabled())
  {
 	 echo "<label for='radio'>No</label><input type='radio' name='disable' id='enable' value='0' checked>";
 	 echo "<label for='radio'>Yes</label><input type='radio' name='disable' id='disable' value='1'>";
  }
  else
  {
 	 echo "<label for='radio'>No</label><input type='radio' name='disable' id='enable' value='0' >";
 	 echo "<label for='radio'>Yes</label><input type='radio' name='disable' id='disable' value='1'checked>";	  
  }
  ?>
  <br>
  <br>
  <input type="submit">
  </form>
  
  
  
  </p>
  
  
  </div>

<?php
#include footer.php
include('footer.php');
?>