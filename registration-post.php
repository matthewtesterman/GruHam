<?php

#registration-post.php - registration page that creates accounts and displays if successful registration.
#Originally created by Matthew Testerman 11/1/2014
#Last Edited by Alex Morris on 12/1/2014  - Added pattern matching

include("functions.php");
include("header.php");

$email = $_POST['email'];
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

$match = 1;


if (!preg_match("/^[a-zA-Z0-9._]+@+[a-zA-Z0-9.-]+\.(com|org|net|edu|gov)$/",$email)){
		header("Location:https://php.radford.edu/~team01/GruHAM/registration.php?error=invalidEmail");
		$match =0;
}

if (!preg_match("/^[a-zA-Z]{1,20}$/",$first_name)){
		header("Location:https://php.radford.edu/~team01/GruHAM/registration.php?error=invalidFirstName");
		$match =0;
}

if (!preg_match("/^[a-zA-Z]{1,20}$/",$last_name)){
		header("Location:https://php.radford.edu/~team01/GruHAM/registration.php?error=invalidLastName");
		$match = 0;
}

if (!preg_match("/^(?=.*\d)(?=.*[a-zA-Z]).{8,20}$/",$password1)){
		header("Location:https://php.radford.edu/~team01/GruHAM/registration.php?error=invalidPassword");
		$match = 0;

}

if ($password1!=$password2){
		header("Location:https://php.radford.edu/~team01/GruHAM/registration.php?error=invalidPassword2");
		$match = 0;
}



$exists = check_if_user_exists($email);

if ($exists)
{
	header("Location:https://php.radford.edu/~team01/GruHAM/registration.php?error=exists");
}
if (!$exists)
{
	if($match){
	
		$result = add_user($email,$password1,$first_name,$last_name);
		if ($result)
		{
			$message = "<h3>You have successfully created an account. Please check your e-mail for further instructions.</h3>";
		}
	}
}
?>
<div id="content">
  <div id="content-main-profile">
<?php echo $message; ?>
</div>
</div>




<?php
include("footer.php");

?>