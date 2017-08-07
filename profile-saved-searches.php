<!--
profile-saved-searched.php - Displays the saved searches.
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
  <h3>This will allow the user to save their searches. This page is pending the search page. </h3>
</div>


<?php
#include footer.php
include('footer.php');
?>