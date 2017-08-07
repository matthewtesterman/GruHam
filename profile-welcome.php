<!--
index.php - Displays the home page.
Last Edited by Matthew Testerman on 11/9/2014
Orginally created by Matthew Testerman 11/1/2014
-->
<?php
$access = "private"; #Variable used to restrict user access (private or public);
#include header.php
include("session.php");
include("header.php");
?>
<!--start of content portion of webpage -->
<div id="content">
<?php include("profile-menu.php"); ?>
<div id="content-main-profile">
  <h3>Welcome to your profile, <?php echo $profile['first_name'];  ?>!</h3>
  <p>GruHAM provides you with real estate at your finger tips. You can search for houses and add them to your favorites list. You can also read and write reviews or reports on a searched house. Get started by clicking one of the links to the left.</p>
</div>
<p>&nbsp;</p>
<?php
#include footer.php
include('footer.php');
?>