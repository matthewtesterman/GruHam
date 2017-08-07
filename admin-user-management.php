<!--
admin-user-management.php - Displays security form.
Last Edited by Matthew Testerman on 11/21/2014
Orginally created by Matthew Testerman 11/1/2014
-->
<?php
$access = "private"; #Variable used to restrict user access (private or public);
#include header.php
include("session.php");
include("header.php");
#Check if user is not admin then leave this page
if (!is_admin($login_session))
{
	header("Location:index.php");
}
?>
<div id="content">
<?php include("profile-menu.php");?>
<div id="content-main-profile">
  <h3>User Management</h3>
  
  <?php
  #If conditions used to handle form errors

  #If user attempt to change their own role.
  if ($_GET['action'] == "role")
  {
	  echo "<h4>You cannot change your own role.</h4>";
  }  
  #If user atempts to suspend hiself.
  if ($_GET['action'] == "suspend")
  {
	  echo "<h4>You cannot suspend yourself.</h4>";
  }  
  #if user enter duplicate email
  if ($_GET['action'] == "duplicate")
  {
	  echo "<h4>Unable to update e-mail because it is already taken by another user.</h4>";
  }  
  #Successfull update
  if ($_GET['action'] == "success")
  {
	  echo "<h4>The user has been successfully updated.</h4>";
  }  
  #unable to delte user
  if ($_GET['action'] == "nodelete")
  {
	  echo "<h4>Cannot delete a user that is an administrator (or yourself).</h4>";
  }
  #Successful delete of user.
  if ($_GET['action'] == "delete")
  {
	   echo "<h4>The user has been removed.</h4>";
  }
  #display the resutls returned to lookup user
  if (isset($_POST['email']) && $_GET['action'] == "post")
  {
	  $email = $_POST['email'];
	  $profile = get_profile_info($email);
	  if ($profile['email'] == "")
	  {
		  echo "<h4>There is no user with that email.</h4>";
	  }
	  else
	  {
		  echo "<h4>User Information:</h4>";
		  echo "<form action='admin-user-management-post.php?id=". $profile['id'] . "' method='post'>";
		  echo "<p>User Email:<br>";
		  echo "<input type='text' name='email' value='" . $profile['email'] ."'>";
		  echo "<br>";
		  echo "Fist Name:<br>";
		  echo "<input type='text' name='name_first' value='" . $profile['first_name'] ."'>";
		  echo "<br>";
		  echo "Last Name:<br>";
		  echo "<input type='text' name='name_last' value='" . $profile['last_name'] ."'>";
		  echo "<br>";
		  echo "Registration Date:<br>";
		  echo "<input type='text' name='register_date' value='" . $profile['registration_date'] ."' disabled='disabled'>";
		  echo "<br>";
		  echo "Last Login:<br>";
		  echo "<input type='text' name='last_login_date' value='" . $profile['last_login_date'] ."' disabled='disabled'>";
		  echo "<br>";
		  echo "Role:<br>";
		  if ($profile['role'] == "admin")
		  {
		  	echo "<label for='radio'>Admin</label><input type='radio' name='role' id='active' value='yes' checked>";
			echo "<label for='radio'>User</label><input type='radio' name='role' id='active' value='no'>";
		  }
		  if ($profile['role'] == "user")
		  {
			echo "<label for='radio'>Admin</label><input type='radio' name='role' id='role' value='yes'>";
			echo "<label for='radio'>User</label><input type='radio' name='role' id='role' value='no' checked>";
		  }
		  echo "<br>";
		  echo "Account Activation:<br>";
		  if ($profile['gh_active'] == 1)
		  {
		  	echo "<label for='radio'>Yes</label><input type='radio' name='gh_active' id='active' value='1' checked>";
			echo "<label for='radio'>No</label><input type='radio' name='gh_active' id='active' value=''>";
		  }
		  else
		  {
			echo "<label for='radio'>Yes</label><input type='radio' name='gh_active' id='active' value='1'>";
			echo "<label for='radio'>No</label><input type='radio' name='gh_active' id='active' value='' checked>";
		  }
		  
		  echo "<br>";
		  echo "Account Suspension:<br>";
		  if ($profile['suspend'] == 1)
		  {
		  	echo "<label for='radio'>Yes</label><input type='radio' name='suspend' id='suspend' value='1' checked>";
			echo "<label for='radio'>No</label><input type='radio' name='suspend' id='suspend' value=''>";
		  }
		  else
		  {
			echo "<label for='radio'>Yes</label><input type='radio' name='suspend' id='active' value='1'>";
			echo "<label for='radio'>No</label><input type='radio' name='suspend' id='active' value='' checked>";
		  }
		  	  
		  echo "<br>";
		  
		  echo "Delete Account:<br>";
		  echo "<label for='radio'>Yes</label><input type='radio' name='remove' id='remove' value='yes'>";
		  echo "<label for='radio'>No</label><input type='radio' name='remove' id='remove' value='no' checked>";
		  echo "<br>";
		  echo "<br>";
		  echo "<input type='submit'  value='Update User'>";
		  echo "<br>";

		  echo "</p>";
		  echo "</form>";
		  echo "<br>";
		  echo "<h4>Lookup another user:</h4>";
	  }
  }
  ?>
  <form action="admin-user-management.php?action=post" method="post">
  <p>Lookup a user by email:
    <br>
    <input type="text" name="email" id="email">
    <br>
    <br>
    <input type="submit">
  </p>
  </form>
</div>
<!--start of blank portion of webpage -->


<?php
#include footer.php
include('footer.php');
?>