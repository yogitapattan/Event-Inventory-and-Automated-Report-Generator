
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
* 		to select which faculty to edit.
*
*
*=====================================
*/

include("menu.php");
include_once("includes/connectdb.php");

if ($dbSuccess) {

	$tCompany_SQLselect = "SELECT  ";
	$tCompany_SQLselect .= "Name ";	
	$tCompany_SQLselect .= "FROM ";
	$tCompany_SQLselect .= "faculty ";
	$tCompany_SQLselect .= "Order By Name ";
	

	$tCompany_SQLselect_Query = mysqli_query($dbConnected,$tCompany_SQLselect);	
	//echo $tCompany_SQLselect;
	echo '<h1>Select faculty to edit</h1><br><br>';
	
	echo '<div class="grandcontainer" align="center">
			<div class="parenrcontainer">';
	echo '<form action="facultyeditform.php" method="post">';
	
	echo '<select name="Name" required>';
	
		echo '<option value=""  selected="selected">..select faculty..</option>';
 	
	
			while ($row = mysqli_fetch_array($tCompany_SQLselect_Query, MYSQLI_ASSOC)) {
			    //$ID = $row['ID'];
			    $facultyName = $row['Name'];
			    			    
			    echo '<option value="'.$facultyName.'">'.$facultyName.'</option>';
			}
		
			mysqli_free_result($tCompany_SQLselect_Query);		
	
			echo '</select>';
	
			echo '<br><br>';
			echo '<input class="submitbtn" type="submit" />';
			
	echo '</form>';
	echo '</div></div>';
}

echo "<br /><br />";


?>
