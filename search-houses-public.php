<!--
search-houses-public.php - Displays the search results for all users
Last Edited by Matthew Testerman on 11/24/2014
Originally created by Matthew Testerman 11/23/2014
-->
<?php
$access = "private"; #Variable used to restrict user access (private or public);
#include header.php
include("functions.php");
include("header.php");
$flag = false;
if ($_GET['search'] == 'go')
{
#API key used in the URL to access zillow.
$zwis_id = "X1-ZWz1dz1k4bnxmz_5dugt";
#Retrieve any POST global arrays.
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
  #If search did not return results.
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
<!--start of blank portion of webpage -->
<div id="content">
<div id="content-house-search-bar">
<form action="search-houses-public.php?search=go" method="post">
Street Address:
<input type="text" name="address" id="address" size="14" value="<?php echo $address; ?>">
City:
<input name="city" type="text" id="city" size="8" value="<?php echo $city; ?>"> 
State:
 <input type="text" name="state" id="state" size="2" value="<?php echo $state; ?>">
Zip:
<input name="zip" type="text" id="zip" size="5" value="<?php echo $zip; ?>"> 

<input type="submit" name="button" id="button" value="Submit">
<div id="clearall">&nbsp;</div>    
  </form>
</div>

<div id="content-house-search-results">
  <p>
<?php
#If error display message
  echo $message;

?>
</p>
<?php 
if ($flag == false)
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
    <?php echo $house['bedrooms']?> beds <?php echo $house['bathrooms'] ?> baths <?php echo $house['lot_size_sqft']; ?> sqft (Lot Size)</h3>
  <p> 
    <?php echo $sale_message; ?></p>
  <p>&nbsp;</p>
  <p><?php echo $detailed_house['home_description'] . "<br>"; echo $detailed_house['owner_comments'];?><br>
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