<?php
#activate.php - deals with activating accounts.

include('functions.php');

include('header.php');
$key = $_GET['id_link'];
$email = $_GET['email'];
$success = activate_user($key, $email);
?>
<div id="content">
  <div id="content-main-profile">
    
<?php
if($success)
{
	echo "<h3>Thank you for activating your account! Please <a href=\"login.php\">login</a> to start your account!</h3>";
	
}
else
{
	echo "<h3>We apologize but there seems to be an error activating this account. Please contact support for further assistance.</h3>";
}
?>
	</div>
</div>


<?php
include('footer.php');



?>