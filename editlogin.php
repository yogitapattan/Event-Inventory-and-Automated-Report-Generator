<?php
session_start();
if(!isset($_SESSION["logged_in"]))
	header('Location:loginForm.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="css/edit.css">
	</head>
<body>
</body>
</html>

<?php
/*

*
*	This script defines an HTML form using a dropdown
* 		to select which login detail to edit.
*
*
*=====================================
*/

include("menu.php");
include_once("includes/connectdb.php");

if ($dbSuccess) {

	$tCompany_SQLselect = "SELECT  ";
	$tCompany_SQLselect .= "Username ";	
	$tCompany_SQLselect .= "FROM ";
	$tCompany_SQLselect .= "login ";
	$tCompany_SQLselect .= "Order By Username ";
	

	$tCompany_SQLselect_Query = mysqli_query($dbConnected,$tCompany_SQLselect);	
	
	echo '<h1>Select to edit login</h1>';
	
	echo '<div class="grandcontainer" align="center">
			<div class="parenrcontainer">';
	echo '<form action="loginupdate.php" method="post">';
	
	echo '<select name="Username" required>';
	
		echo '<option value="" selected="selected">..select username..</option>';
 	
	
			while ($row = mysqli_fetch_array($tCompany_SQLselect_Query, MYSQLI_ASSOC)) {
			    
			    $Username = $row['Username'];
			    			    
			    echo '<option value="'.$Username.'">'.$Username.'</option>';
			}
		
			mysqli_free_result($tCompany_SQLselect_Query);		
	
			echo '</select>';
	
			echo '<br><br>';
			echo '<input class="submitbtn" type="submit" />';
			
	echo '</form>';
	echo '</div></div>';
}


?>
