<?php
# contact-us-post.php (PHP only page not viewable to the user)
# This page sends an email to the localhost email account
# This page was created/last edited by Matthew Testerman on 12/1/14

# Inlcude Function.php (Library we created)
include("functions.php");

# Grab data from form valued from 'contactUs.php' and sanatize the input
$email = $_POST['email'];
$message = $_POST['message'];
$name = $_POST['name'];

# If theere are any error on the form, send the user back to ContactUs page displaying the error.
if ($email == "" || $message == "" || $name == "")
{
	header("Location: ContactUs.php?message=error");
	exit;
}

# Email the admin
mail($admin_email, "GruHAM client, " . $name . " has contacted you" , $message . "\n" . "\r\n" . "From: " . $email);

# Redirect the user back to the contact us page displaying a confirmation message
header("Location: ContactUs.php?message=confirmed");
?>