<?php
#function.php - This file contains all the functions the other webpages use from.
#last edited by Matthew Testerman 11/9/14

#Global Variables
$url = "https://php.radford.edu/~team01/GruHAM";
$error = "none";


#function that connects to the localhost databasse - Matthew Testerman 11/9/14
function connect_to_db()
{
	#Login information to db
	$username = "team01";
	$password = "HomeBuyer1!";
	$database = "team01";
	
	#Connect to database
	$connect = mysqli_connect("localhost", $username,$password, $database);
	
	#if error connecting
	if (mysqli_connect_errno())
	{
		#put a redirect URL here.
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	#return the #connection
	return $connect;
}

#Function that queries the database and return results - Matthew Testerman 11/11/14
function query_db($sql)
{
	global $error;
	#connect to db
	$connect = connect_to_db();
	#query result
	$result = mysqli_query($connect, $sql);
	#if nothing returned then display message and exit
	if (!$result) 
	{
    //echo "DB Error, could not query the database\n";
    $error = mysqli_connect_errno();
    //exit;
	$result = "error";
	}
	
	#return the results
	return $result;
}

#Function that adds a user - Matthew Testerman 11/11/14
function add_user($email, $password, $first_name, $last_name)
{
	global $url;
	$success = false;
	$password = sha1($password); #hash password
	
	#Generare a Random key to be used for activation
	$key = sha1(rand(0,10053323));
	
	$query = query_db("INSERT INTO gh_users (gh_user_id, gh_email, gh_password, gh_name_first, gh_name_last, gh_registration_date, gh_role, gh_user_suspended, gh_last_login, gh_activate_key, gh_active) VALUES (NULL, '$email', '$password', '$first_name', '$last_name', CURRENT_TIMESTAMP, 'user', '', '0000-00-00 00:00:00', '$key', '0')");
	$query_check = query_db("Select gh_email FROM gh_users WHERE gh_email = '$email'");
	$num_rows = mysqli_num_rows($query_check);
			
	if ($num_rows == 1)
	{
		mail($email, 'Welcome to GruHam', "Welcome to GruHAM.com!! Please click $url/activate.php?email=$email&id_link=$key to activate your account!");
		$success = true;
	}
	return $success;
}
#Function that adds a user - Matthew Testerman 11/11/14
function activate_user($key_id, $email)
{
	$query = "SELECT gh_email FROM gh_users WHERE gh_activate_key = '$key_id' AND gh_active = 0 AND gh_email = '$email'";
	$result = query_db($query);
	$num_rows = mysqli_num_rows($result);
	$success = false;
	if ($num_rows == 1)
	{
		$result = query_db("UPDATE gh_users SET gh_active =  1 WHERE gh_email = '$email'");
		$success = true;
	}
	return  $success;
}
#Function that checks if user does exist - Matthew Testerman 11/11/14
function check_if_user_exists($email)
{
	$exists = false;
	$query = "SELECT gh_email FROM gh_users WHERE gh_email = '$email'";
	$result = query_db($query);
	$num_rows = mysqli_num_rows($result);
	#If no rows returned then the record does not exist
	if ($num_rows == 1)
	{
		$exists = true; // change to doesn't exist (false)
	}
	return $exists;
}
#Deleting User - Chris Sayre - 11/11/14 (Last edited by Matthew Testerman 11/12/14)
function remove_user($email)
{
	##I believe this should work. It is basically a copy of the check_if_exists function. 
	## csayre 10/11/2014 1024
	$success = false;
	$query = "SELECT gh_email FROM gh_users WHERE gh_email = '$email'";
	$result = query_db($query); #I added this to query the database. -Matthew Testerman 11/11/14
	$num_rows = mysqli_num_rows($result);
	if	($num_rows >= 1)
	{
		$result = query_db("DELETE FROM gh_users WHERE gh_email = '$email'");
		$success = true;
	}
	return $success;
}

#validate login process - Alex Morris 11/11/14
function validate_user_login($email, $first_name, $last_name)
{
	if (check_if_user_exists($email))
	{
	#REGEX - limit number of characters, type of characters
	}
	else
	{ 
	#This should return the same error as if the user entered the wrong password to defend against brute force attacks i.e. both fields would need to be (continued on next line)
	#brute forced to return meaningful results therefore making the attack impractical.
	}
	
}


#validate registration process (Currently a stub and returns true.) - Alex Morris 11//11/14
function validate_registration($email, $first, $last, $password1, $password2)
{
	#compare password1 and password2 to make sure they are the same.
	#sanitize input
	#REGEX
	return true;
}

#Adds the specified house ID to the user's favorites
function add_to_favorites ($userID, $houseID)
{
	
}

#Removes the specified house ID from a user's favorites
function remove_from_favorites($userID, $houseID)
{
	
}

#Adds the review to the specified house ID
function post_house_review($houseID, $subject, $message, $userID)
{
	
}

#Returns the reviews of a house with the given ID (or false if there are no IDs?)
function view_house_review($houseID)
{
	
}

#Returns the role of the user
function user_role($userID)
{

}

##Logs the user out and returns them to the homepage - Matthew Testerman 11/14/14
function logout()
{
	//Clears the session then destroys it
	$_SESSION = array(); 
	session_destroy();
	//Sends the user back to the landing page
	header('Location:https://php.radford.edu~team01/GruHAM/index.php');
}


###Dummy - use to grt - Matthew Testerman 11/14/14
function display($result)
{
	while ($row = mysqli_fetch_assoc($result)) 
	{
    echo "<p>dgdfgf</p>" . $row["email"];
	}
}

#Updates the user information. Returns an error if issues with database - Matthew Testerman 11/21/2014
function update_user($user_id, $email, $first_name, $last_name, $role, $suspend, $activate)
{
	$sql = "UPDATE gh_users SET  gh_email =  '$email', gh_name_first =  '$first_name', gh_name_last =  '$last_name', gh_role =  '$role', gh_user_suspended = '$suspend', gh_active = '$activate' WHERE  gh_user_id = '$user_id'";
	query_db($sql);
}

#updates the user time when logged in.  - Matthew Testerman 11/21/2014
function update_user_login_time($email)
{
	$time_logged_in = date('Y-m-d H:i:s');
	$sql = "UPDATE gh_users SET gh_last_login = '$time_logged_in' WHERE gh_email = '$email'";
	query_db($sql);
}


#close the database - Matthew Testerman 11/11/14
function close_db()
{
	#stub
}

#
#Login to the website - Matthew Testerman 11/11/14
function check_user_name_password($email, $password)
{
	$login = false;
	$password = sha1($password);
	$result = query_db("SELECT gh_email FROM gh_users WHERE gh_email = '$email' AND gh_password = '$password'");
	

	$num_rows = mysqli_num_rows($result);

	if ($num_rows == 1)
	{
		$login = true;
	}
	return $login;
}

#Get the first name of the user - Matthew Testerman 11/11/14
function get_first_name($email)
{
	$result = query_db("SELECT gh_name_first FROM gh_users WHERE gh_email = '$email'");
	$row=mysqli_fetch_array($result);
	$first_name = $row['gh_name_first'];
	return $first_name;
}

#Get the email of the user - Matthew Testerman 11/11/14
function get_user_email($user_id)
{
	$result = query_db("SELECT gh_email FROM gh_users WHERE gh_user_id = '$user_id'");
	$row=mysqli_fetch_array($result);
	$email = $row['gh_email'];
	return $email;
}

#Get all profile data and store into the array - Matthew Testerman 11/17/14
function get_profile_info($email)
{
	$result = query_db("SELECT * FROM gh_users WHERE gh_email = '$email'");
	$row=mysqli_fetch_array($result);
	$profile['id'] = $row['gh_user_id'];
	$profile['email'] = $row['gh_email'];
	$profile['first_name'] = $row['gh_name_first'];
	$profile['last_name'] = $row['gh_name_last'];	
	$profile['registration_date'] = $row['gh_registration_date'];	
	$profile['role'] = $row['gh_role'];
	$profile['suspend'] = $row['gh_user_suspended'];
	$profile['last_login_date'] = $row['gh_last_login'];	
	$profile['gh_active'] = $row['gh_active'];	
	return $profile;
}

#Generate a radnom password with numbers and letters (no special characters) - Matthew Testerman 11/17/14
function generate_random_password() 
{
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); #remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; #put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); #turn the array into a string
}

#Gets user Activation Key - Matthew Testerman - 11/17/14
function get_activation_key($email)
{
	$result = query_db("SELECT gh_activate_key FROM gh_users WHERE gh_email = '$email'");
	$row = mysqli_fetch_array($result);
	$act_key= $row['gh_activate_key'];
	return $act_key;
}

#Check if activation key is valid - Matthew Testerman 11/17/14
function check_valid_activation($act_key, $email)
{
	$exists = false;
	$query = "SELECT gh_activate_key FROM gh_users WHERE gh_email = '$email' AND gh_activate_key = '$act_key'";
	$result = query_db($query);
	$num_rows = mysqli_num_rows($result);
	#If no rows returned then the record does not exist
	if ($num_rows == 1)
	{
		$exists = true; // change to doesn't exist (false)
	}

	return $exists;
}

#Function that resets the activation key - Matthew Testerman 11/17/14
function reset_activation_key($email)
{
	$act_key = generate_random_password(); #Generate a random password
	$act_key = sha1($act_key); #hash it
	query_db("UPDATE gh_users SET gh_activate_key =  '$act_key' WHERE gh_email = '$email'");	
	
}

#Function that resets the activation key - Matthew Testerman 11/17/14
function reset_password($email,$password)
{
	$password = sha1($password); #hash passsword
	query_db("UPDATE gh_users SET gh_password =  '$password' WHERE gh_email = '$email'");
}

#Function to send email to dev from contact page. - Chris Sayre 11/19/14
function mailTo($email,$name,$message)
{	
	mail ("team01@radford.edu" , "contact US Email" , $name.$message.$email);
}

#Function thats checks if user is an admin. Returns true if user is. - Matthew Testerman 11/23/14
function is_admin($email)
{
	$is_admin = false;
	$query = "SELECT gh_role FROM gh_users WHERE gh_email = '$email' AND gh_role = 'admin'";
	$result = query_db($query);
	$num_rows = mysqli_num_rows($result);
	#If no rows returned then then user is not an admin
	if ($num_rows == 1)
	{
		$is_admin = true; # change bool to user is an admin
	}
	
	return $is_admin;
	
}

#Function that retrieves if the user has been suspended
function is_suspended($email)
{
	$is_suspended = false;
	$query = "SELECT * FROM gh_users WHERE gh_email = '$email' AND gh_user_suspended = '1'";
	$result = query_db($query);
	$num_rows = mysqli_num_rows($result);
	if ($num_rows == 1)
	{
		$is_suspended = true; # user is suspended
	}
	return $is_suspended;
}

#Function that retrieves if the user has activated -Matthew Testerman 11/23/2014
function is_activated($email)
{
	$is_activated = false;
	$query = "SELECT * FROM gh_users WHERE gh_email = '$email' AND gh_active = '1'";
	$result = query_db($query);
	$num_rows = mysqli_num_rows($result);
	if ($num_rows == 1)
	{
		$is_activated = true; # user is activated
	}
	return $is_activated;
}
#functions checks if website is enabled -Matthew Testerman 11/23/2014
function is_site_enabled()
{
	$enabled = false;
	$query = "SELECT * FROM gh_system WHERE gh_system_id = '1' AND gh_system_disable = '0'";
	$result = query_db($query);
	$num_rows = mysqli_num_rows($result);
	if ($num_rows == 1)
	{
		$enabled = true; # website is enabled
	}	
	return $enabled;
}
function enable_or_disable_site($bool, $user_id)
{
	query_db("UPDATE gh_system SET gh_system_disable = '$bool', gh_user_id = '$user_id' WHERE gh_system_id = '1'");	
}

#Function that retrieves information using the Zillow API via restful webservice. PHP curl is used. Returns an XML object. - Matthew Testerman 11/24/14
function curl($service_url)
{
#Initialize Curl.
$curl = curl_init($service_url);

#setup response
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
#Execute request and retrieve information
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
#Close curl out
curl_close($curl);
#Setup as XML object in php.
$decoded = new SimpleXMLElement($curl_response);
#print_r($decoded);
return $decoded;
}

//http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm?zws-id=X1-ZWz1dz1k4bnxmz_5dugt&zpid=48749425
##Getting Variables
function get_general_home_information($xml_house)
{
$home['zpid'] = (string) $xml_house->response->results->result->zpid;
$home['address'] = (string) $xml_house->response->results->result->address->street;
$home['zip'] = (string) $xml_house->response->results->result->address->zipcode;
$home['city'] = (string) $xml_house->response->results->result->address->city;
$home['state'] = (string) $xml_house->response->results->result->address->state;
$home['amount'] = (string) $xml_house->response->results->result->zestimate->amount;
$home['year_built'] = (string) $xml_house->response->results->result->yearBuilt;
$home['lot_size_sqft'] = (string) $xml_house->response->results->result->lotSizeSqFt;
$home['bathrooms'] = (string) $xml_house->response->results->result->bathrooms;
$home['rooms'] = (string) $xml_house->response->results->result->totalRooms;
$home['bedrooms'] = (string) $xml_house->response->results->result->bedrooms;
$home['message'] = (string) $xml_house->message->code;
return $home;
}

function get_detailed_home_information($zws_id, $zpid, $xml_detail_house)
{
	$property['price'] = (string) $xml_detail_house->response->price;
	$property['owner_comments'] = (string) $xml_detail_house->response->whatOwnerLoves;
	$property['home_details'] = (string) $xml_detail_house->response->links->homeDetails;
	$property['home_description'] = (string) $xml_detail_house->response->homeDescription;	
	$property['image'] = (string) $xml_detail_house->response->images->image->url[0];
	$property['message'] = (string) $xml_detail_house->message->code;
	return $property;
}


#Test function
function mt_test()
{
	echo "Testing here";
}
?>
