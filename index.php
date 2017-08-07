<!--
index.php - Displays the home page.
Edited by Matthew Testerman on 12/1/2014
Last edited by Alex Morris on 11/12/2014 Minor textual changes to 
Originally created by Matthew Testerman 11/1/2014
-->
<?php
#include header.php
include('header.php');

session_start();

if(isset($_SESSION['login_email']))
{
	header('Location: profile-welcome.php');
}
?>
<!--start of content portion of webpage -->


<div id="content">
<?php
#if logging out
if ($_GET['logout'] == 'ok')
{
echo "
	<div id=\"content-house-search-bar\">
	<p>You have successfully logged out!</p>
	<p>&nbsp;</p>
	</div>
	<div id=\"clearall\">
	</div>";
}
?>
<div id='content-sidebar'>
<h1>What is GruHAM?</h1>
<div class="content-sidebar-column-left"><img src="assets/search.png" width="48" height="45" alt="search"></div>
<div class="content-sidebar-column-right">You can search through millions of houses with the powerful search engines of Zillow.com!</div>
<div class="content-sidebar-column-left"><img src="assets/write.png" width="48" height="45"></div>
<div class="content-sidebar-column-right">You can view and post housing reviews or even reports!</div> <!--"and Reviews" removed to reflect changes in project scope"
<!--
Commented out to reflect changes in project scope
<div class="content-sidebar-column-left"><img src="assets/calc.png" width="44" height="58"></div>
<div class="content-sidebar-column-right">Use our mortgage financial calculator to assist your choice!</div>
-->
<div class="content-sidebar-column-left"><img src="assets/fav.png" width="47" height="42"></div>
<div class="content-sidebar-column-right">Add your favorite houses to your wish list so you don't lose it!</div>
<div id="clearall"></div>
</div>
<div class="content-join">
  <div class="content-sidebar-column-left"><img src="assets/house.png" width="54" height="51"></div>
  <div class="content-sidebar-column-right"><a href="registration.php">Join for free</a> to obtain all of the wonderful benefits of GruHAM!</div>
  <div id="clearall"></div>
</div>
<div class="content-box">
  <h3>Search for your home right now!</h3>
  <form action="search-houses-public.php?search=go" method="post">
<div class="content-main-profile-search-bar-left-label">Address:</div>
<div class="content-main-profile-search-bar-left-box"> <input type="text" name="address" id="address" value=""></div>
<div class="content-main-profile-search-bar-left-label">City:</div>
<div class="content-main-profile-search-bar-left-box"><input name="city" type="text" id="city" size="10" value=""> </div>

<div class="content-main-profile-search-bar-left-label">State:</div>
<div class="content-main-profile-search-bar-left-box"> <input type="text" name="state" id="state" value=""></div>
<div class="content-main-profile-search-bar-left-label">Zip:</div>
<div class="content-main-profile-search-bar-left-box"><input name="zip" type="text" id="zip" size="10" value=""> </div>
<div class="content-main-profile-search-bar-left-label">&nbsp;</div>
</br>
<div class="content-main-profile-search-bar-left-box"><input type="submit" name="button" id="button" value="Submit"></div>
<div id="clearall">&nbsp;</div>    
  </form>
</div>
<p>&nbsp;</p>


<?php
#include footer.php
include('footer.php');
?>