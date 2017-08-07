<?php
#logout.php - Kills Session and redirects user to index.php
#last updated 12/1/2104
#Created by Matthew Testerman on 11/15/2014

#clear Session
 session_start();
 #if session is destroyed go to front page
if(session_destroy())
{
	header("Location: index.php?logout=ok");
}

?>