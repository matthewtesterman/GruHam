<!--
rofile-search-houses-public.php - Displays the search results for all users
Last Edited by Matthew Testerman on 11/24/2014
Orginally created by Matthew Testerman 11/23/2014
-->
<?php
$access = "private"; #Variable used to restrict user access (private or public);
#include header.php
include("session.php");
include("header.php");
?>
<!--start of blank portion of webpage -->
<div id="content">
<div id="content-house-search-bar">

</div>

<div id="content-house-search-results">

</div>

<?php
#include footer.php
include('footer.php');
?>