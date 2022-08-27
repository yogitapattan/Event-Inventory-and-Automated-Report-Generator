<?php
/*
* Connect to a database named event
*/
	
$db = array(
'hostname' => 'localhost',
'username' => 'root',
'password' => '',
'database' => 'Event',
); 

$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password']);
$dbSuccess = false;
if ($dbConnected) {
	
	$dbSelected = mysqli_select_db($dbConnected,$db['database']);
	if ($dbSelected) {
		//echo "DB connected<br /><br />";
		$dbSuccess = true;
	} else {
		echo "DB connection FAILED<br /><br />";
	}		
} else {
	echo "MySQL connection FAILED<br /><br />";
}


?>

