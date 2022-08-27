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

*	This script defines an HTML form using php 
*	for user to enter event details - POST to saveevent.php
*
*
*=====================================
*/


include("menu.php");
include_once("includes/connectdb.php");

if ($dbSuccess) {

	echo '<h1>Insert New Event</h1>';

	echo "<br />";
	
	if(isset($_POST['EventID']))	
	{	$EventID = $_POST['EventID'];
		
		//		FORM postCompany 
		echo '<div class="grandcontainer" align="center">
			<div class="parenrcontainer">';
		echo '<form name="postCompany" action="savevent.php" method="post">';
		
				echo '
				<input type="hidden" name="EventID" value="'.$EventID.'"/><table>
					
					<tr>
						<td>Venue</td>
						<td><input class="input" type="text" name="Venue" required/></td>
					</tr>
					<tr>
						<td>Start Date</td>
						<td><input class="input" type="date" name="Startdate" placeholder="YYYY-MM-DD" required/></td>
					</tr>
                    <tr>
						<td>Start Time</td>
						<td><input class="input" type="time" name="Starttime" placeholder="HH:MM:DD" required/></td>
					</tr>
					<tr>
						<td>End Date</td>
						<td><input class="input" type="date" name="Enddate" placeholder="YYYY-MM-DD" required/></td>
					</tr>
                    <tr>
						<td>End Time</td>
						<td><input class="input" type="time" name="Endtime" placeholder="HH:MM:SS" required/></td>
					</tr>
					<tr>
						<td>Category</td>
						<td><select name="Category" required>';
	
		echo '<option value=""  selected="selected">..select event..</option>';
 	
	
			echo '<option value="Workshop">Workshop</option>';
			echo '<option value="Seminar">Seminar</option>';
			echo '<option value="Faculty dev programme">Faculty dev programme</option>';
			echo '<option value="Conference">Conference</option>';
			echo '<option value="Talk">Talk</option>';
	
			echo '</select></td>
					</tr>
					<tr>
					   <td></td>
					   <td align="right"><input class="submitbtn" type="submit" value="Save"/> </td>
					</tr>
				</table>
				';
					
		echo '</form>';
		echo '</div></div>';
	}
	else
	{
	$tCompany_SQLselect = "SELECT  ";
	$tCompany_SQLselect .= "ID, Name ";	
	$tCompany_SQLselect .= "FROM ";
	$tCompany_SQLselect .= "event ";
	$tCompany_SQLselect .= "WHERE Venue = 'undefined' Order By Name ";
	

	$tCompany_SQLselect_Query = mysqli_query($dbConnected,$tCompany_SQLselect);	
	echo '<div class="grandcontainer" align="center">
			<div class="parenrcontainer">';
	echo '<form action="insertevent.php" method="post">';
	
	echo '<select class="custom_select" name="EventID" required>';
	
		echo '<option value="">..select event..</option>';
 	
	
			while ($row = mysqli_fetch_array($tCompany_SQLselect_Query, MYSQLI_ASSOC)) {
			    $ID = $row['ID'];
			    $eventName = $row['Name'];
			    			    
			    echo '<option value="'.$ID.'">'.$eventName.'</option>'; 
			}
		
			mysqli_free_result($tCompany_SQLselect_Query);		
	
			echo '</select>';
	
			echo'<br /><br />';
			echo '<input class="submitbtn" type="submit" />';
			
	echo '</form>';
		echo '</div></div>';
	}
	
	

}

?>
