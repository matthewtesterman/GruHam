<!--
profile search-houses.php - Displays the search page

Originally created by Matthew Testerman 11/1/2014
Edited by Matthew Testerman on 11/24/2014
Edited by Alex Morris on 12/2/2014
-->
<?php
$access = "private"; #Variable used to restrict user access (private or public);
#include header.php
include("session.php");
include("header.php");
#used for error handeling.
$flag = false;
if ($_GET['search'] == 'go')
{
#API key used in the URL to access zillow.
$zwis_id = "X1-ZWz1dz1k4bnxmz_5dugt";
#Retrieve any POST gloabal arrays.
$address = $_POST['address'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$state = $_POST['state'];

	$search_url = "http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=$zwis_id&address=" . $_POST['address'] . "&citystatezip=" . $_POST['city'] . "+" . $_POST['state'] . "+" . $_POST['zip'];

	$search_url = str_replace(' ','%20', $search_url); 
		
	$xml_house = curl($search_url);
	$house = get_general_home_information($xml_house);
	
	$house_detail_url = "http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm?zws-id=$zwis_id&zpid=" . $house['zpid'];

	$house_detail_url = str_replace(' ','%20', $house_detail_url); 
	$xml_detail_house = curl($house_detail_url );
	$detailed_house = get_detailed_home_information($zws_id, $house['zpid'], $xml_detail_house);

$message = "";
#if conditions to handle error codes returns via api
  if ($house['message'] == '508' && $_GET['search'] == 'go')
  {
	    $message = "Sorry, we could not find the specified house.";
		$flag = true;
  }
  #If user did not enter an address.
   if ($house['message'] == '500' && $_GET['search'] == 'go')
  {
	    $message = "Please enter an address.";
		$flag = true;
  } 
     if ($detailed_house['message'] == '501' && $_GET['search'] == 'go')
  {
	    $message = "This house is not available because it is listed as protected from Zillow.com. Please visit <a href='http://www.zillow.com'>Zillow.com</a> to view this listing.";
		$flag = true;
  } 
  if ($house['message'] == '502' && $_GET['search'] == 'go')
  {
	    $message = "Sorry, the address you provided is not found in the Zillow property database.";
		$flag = true;
  }  
  
  if ($house['message'] == "1" ||  $detailed_house['message'] == "2" ||  $detailed_house['message'] == "3"||  $detailed_house['message'] == "4"  && $_GET['search'] == 'go')
 {
	    $message = "Sorry, the address you provided is not currently for sale or the address is invalid.";
		$flag = true;
 }  
 #if the price is not numeric then raise a flag (true)
 if (!is_numeric($detailed_house['price']))
 {
	 $message = "Sorry, this house is currently not for sale.";
	 $sale_message =  "";
 }
else
{
	setlocale(LC_MONETARY, 'en_US');
	$amount = money_format('%n', $detailed_house['price']);
	$sale_message =  "FOR SALE: <br> $amount";
}
$df = "" . $detailed_house['image'];

if($df == "")
{
	$img = "";
}
else
{
	$img = "<img class='img-shadow' src='" . $detailed_house['image'] . "' width='256' height='183'>";
}

  
}
  ?>

<div id="content">
<?php include("profile-menu.php"); ?>
<div id="content-main-profile">
  <h3>Search for your house now!</h3>
<form action="profile-search-houses.php?search=go" method="post">
<div class="content-main-profile-search-bar-left-label">Street Address:</div>
<div class="content-main-profile-search-bar-left-box"> <input type="text" name="address" id="address" value="<?php echo $address; ?>"></div>
<div class="content-main-profile-search-bar-right-label">City:</div>
<div class="content-main-profile-search-bar-right-box"><input name="city" type="text" id="city" size="10" value="<?php echo $city; ?>"> </div>

<div class="content-main-profile-search-bar-left-label">State:</div>
<div class="content-main-profile-search-bar-left-box"> <input type="text" name="state" id="state" value="<?php echo $state; ?>"></div>
<div class="content-main-profile-search-bar-right-label">Zip:</div>
<div class="content-main-profile-search-bar-right-box"><input name="zip" type="text" id="zip" size="10" value="<?php echo $zip; ?>"> </div>
<div class="content-main-profile-search-bar-left-label">&nbsp;</div>
<div class="content-main-profile-search-bar-left-box"><input type="submit" name="button" id="button" value="Submit"></div>
<div id="clearall">&nbsp;</div>    
  </form>
  <p>
<?php
#If error display message
  echo $message;

?>
</p>
<?php 
if (isset($detailed_house['message']) && $flag == false)
{ 

?>
<div class="content-view-house-column-image">
      <p>&nbsp;</p>
      <p><?php echo $img; ?></p>
      <p><a href="<?php echo $detailed_house['home_details'];  ?>" target="new">View on Zillow</a></p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </div>
<div class="content-view-house-column-info">
  <h1><?php  echo $house['address'] ?><br>
    <?php echo $house['city'] . ", " . $house['state'] . " " . $house['zip'] ?></h1>
  <h3>
    <?php echo $house['bedrooms']?> beds <?php echo $house['bathrooms'] ?> baths <?php echo $house['lot_size_sqft']; ?> sqft</h3>
  <p>
    <?php echo $amount; ?></p>
  <p>&nbsp;</p>
  <p><?php echo $detailed_house['home_description'] . "<br>"; echo $detailed_house['owner_comments']; ?><br>
  </p>
  <p>&nbsp;</p>
  </div>
<h2>Reviews and Reports</h2>
<p>



<form action="#" method="post">
   Subject:<br>
  <input type="text" name="name"><br><br>
  <label for="textarea"></label>
  <textarea name="textarea" cols="70" id="textarea" placeholder="Post a comment...."></textarea>
</p>
<p>
  <input type="submit" name="button" id="button" value="Submit">
</p>
</form>

<p>&nbsp;</p>

<?php
	$house_id=$_POST['address'];
	$query="SELECT * FROM gh_reviews WHERE house_id = '$house_id'";
	$result=query_db($query);
	while($row = mysqli_fetch_assoc($result)){
		echo "<div class=\"content-view-house-comments\">";
			echo "<div class=\"content-view-house-comments-header-name\">"."<h5>";
			echo $row['subject'];
			echo "</h5>"."</div>";
				echo "<div class=\"content-view-house-comments-header-date\">";
					echo "<h5>";
					echo $row['post_time'];
					echo "</h5></div>";
						echo "<div class=\"content-view-house-comments-header-commment\"><p>";
						echo $row['body'];
						echo "</p></div>";
			echo "<div id=\"clearall\">";
	echo "</div>";
	echo "</div>";
	}
?>

<p>&nbsp;</p>
<div id="clearall">
<p>&nbsp;</p>
</div>

</div>
<div id="clearall">
<p>&nbsp;</p>
</div>

</div>
<?php
}
?>




</div>


<?php
#include footer.php
include('footer.php');
?>
