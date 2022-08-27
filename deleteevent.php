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
* 		to select which event to delete.
*
*
*=====================================
*/

include("menu.php");
include_once("includes/connectdb.php");

if ($dbSuccess) {

	if(isset($_POST['EventID']))
	{
			$EventID = $_POST['EventID'];
            if($EventID==0)
              header("Location: deleteevent.php");
            else
			{				
				//echo $EventID;	
				$tables = array("event","budget","incharge","speaker1","participants1");
				foreach($tables as $table) {
				$tCompany_SQLselect = "DELETE FROM ".$table." WHERE ID=".$EventID."";
				if (mysqli_query($dbConnected,$tCompany_SQLselect))  {	
						echo '<h5 align="center" style="color:green; font-size:20px;">Sucessfully Deleted '.$table.'</h5>';
					} else {
						echo '<h5 align="center" style="color:red; font-size:20px;">Failed to delete Event</h5><br />';
						
					}		
			    }
			}
					
		
	}
	else
	{
	$tCompany_SQLselect = "SELECT  ";
	$tCompany_SQLselect .= "ID, Name ";	
	$tCompany_SQLselect .= "FROM ";
	$tCompany_SQLselect .= "event ";
	$tCompany_SQLselect .= "Order By Name ";
	

	$tCompany_SQLselect_Query = mysqli_query($dbConnected,$tCompany_SQLselect);	
	
	echo '<div class="grandcontainer" align="center">
			<div class="parenrcontainer">';
	echo '<h1>Select Event to Delete</h1>';
	echo '<form action="deleteevent.php" method="post">';
	
	echo '<select name="EventID" required >';
	
		echo '<option value=""  selected="selected">..select event..</option>';
 	
	
			while ($row = mysqli_fetch_array($tCompany_SQLselect_Query, MYSQLI_ASSOC)) {
			    $ID = $row['ID'];
			    $eventName = $row['Name'];
			    			    
			    echo '<option value="'.$ID.'">'.$eventName.'</option>';
			}
		
			mysqli_free_result($tCompany_SQLselect_Query);		
	
			echo '</select>';
	
			echo '<br><br>';
			echo '<input class="submitbtn" type="submit" />';
			
	echo '</form>';
	}

}



?>