<?php
#porifle-account-settings - This page displays the account settings
#Created by Matthew Testerman on 11/15/2014
#Edited by Matthew Testerman on 12/1/2014
$access = "private"; #Variable used to restrict user access (private or public);
include("session.php");
include("header.php");

?>
<div id="content">
<?php include("profile-menu.php"); ?>
<div id="content-main-profile">
  <h3>Account Settings (Under Construction)</h3>
  <p>User Email (ID):
    <br>
    <input name="email" type="text" value="<?php echo $profile['email'];  ?>" id="textfield2">
  </p>
  <p>First Name:
    <br>
    <input name="firstname" type="text" id="textfield4" value="<?php echo $profile['first_name'];  ?>">
  </p>
  <p>Last Name:
    <br>
    <input name="lastname" type="text" id="textfield3" value="<?php echo $profile['last_name'];  ?>">
  </p>
  </br>
  <p>Remove your Account? &nbsp; &nbsp; &nbsp; &nbsp;	
    <select name="select2" id="select2">
      <option value="remove_no">No</option>
      <option value="remove_yes">Yes</option>
    </select>
  </p>
  </br>
  <p>
    <input type="submit" name="button2" id="button2" value="Apply Changes">
    <label for="textfield3"></label>
    <label for="textarea"></label>
    <label for="textarea"></label>
  </p>
</div>
</div>



<?php
include("footer.php");
?>