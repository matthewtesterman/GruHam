<!--
PrivacyandTerms.php - Displays the Privacy and terms page.

Originally created by Alex Morris 11/12/2014
-->
<?php
$access = "public"; #This webpage can be displayed for all users.
include("session-test.php");
include("header.php");


?>
<div id="content">
  <div id="content-main-profile">
  <h3>Privacy and Terms</h3>
<p>
<?php
	$house_id="1111";
	$query="SELECT * FROM gh_reviews WHERE house_id = '$house_id'";
	$result=query_db($query);
	while($row = mysqli_fetch_assoc($result)){
		echo $row['house_id'] . "<br>";
}
?>
</p>  
  
 </div>
</div>



<?php
include("footer.php");
?>