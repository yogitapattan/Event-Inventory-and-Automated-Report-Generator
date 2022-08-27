<?php
/*
*
*	This script CREATEs new database
*=====================================
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
	echo "MySQL connection SUCCESSFUL<br /><br />";
	$dbSuccess = true;
			
} else {
	echo "MySQL connection FAILED<br /><br />";
}

if($dbSuccess)
{

$dbName = "Event";
$create_SQL = "Create DATABASE ".$dbName;

if (mysqli_query($dbConnected,$create_SQL))  {	
	echo "'Create DATABASE ".$dbName."' -  Successful.";
} else {
	echo "'Create DATABASE ".$dbName."' - Failed.";
}
}



?>
