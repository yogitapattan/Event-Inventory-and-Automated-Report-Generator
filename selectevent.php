<?php
session_start();
if(!isset($_SESSION["logged_in"]))
	header('Location:loginForm.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="css/forms.css">
	</head>
<body>
</body>
</html>
<?php
/*

*
*	This script defines an HTML form using a dropdown
* 		to select which event to edit.
*
*
*=====================================
*/


include_once("includes/connectdb.php");
include("menu.php");

echo '<h1>
				Select Event
			</h1>';

	echo "<br />";
	

if ($dbSuccess) {

	$tCompany_SQLselect = "SELECT  ";
	$tCompany_SQLselect .= "ID, Name, Venue ";	
	$tCompany_SQLselect .= "FROM ";
	$tCompany_SQLselect .= "event ";
	$tCompany_SQLselect .= "WHERE Venue != 'undefined' Order By Name ";
	

	$tCompany_SQLselect_Query = mysqli_query($dbConnected,$tCompany_SQLselect);	
	
	echo '<div align="center" class="grandcontainer">';
    echo '<div class="parentcontainer">';
    echo '<form action="displayevent.php" method="post">';
	
	echo '<select name="EventID" required>';
	
		echo '<option value=""  selected="selected">..select event..</option>';
 	
	
			while ($row = mysqli_fetch_array($tCompany_SQLselect_Query, MYSQLI_ASSOC)) {
			    $ID = $row['ID'];
			    $eventName = $row['Name'];
			    $Venue = $row['Venue'];		    			    
			    echo '<option value="'.$ID.'">'.$eventName.'</option>';
			}
		
			mysqli_free_result($tCompany_SQLselect_Query);		
	
			echo '</select>';
	
			echo'<br><br>';
			echo '<input class="submitbtn" type="submit" />';
			
	echo '</form>';
    echo '</div> </div>';

}


?>
