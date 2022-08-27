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

*	This script defines an HTML form to load event details
*	and POST changed fields to updateevent.php
*
*
*=====================================
*/
include("menu.php");
include_once("includes/connectdb.php");

if ($dbSuccess) {

	{	//  Get the details of the company selected 
			$EventID = $_POST["EventID"];	
						
			if ($EventID == 0) {
				header("Location: editevent.php");	
			}
			

			$tCompany_SQLselect = "SELECT * ";
			$tCompany_SQLselect .= "FROM ";
			$tCompany_SQLselect .= "event ";
			$tCompany_SQLselect .= "WHERE ID = '".$EventID."' ";
			
			$tCompany_SQLselect_Query = mysqli_query($dbConnected,$tCompany_SQLselect);	
			
			while ($row = mysqli_fetch_array($tCompany_SQLselect_Query, MYSQLI_ASSOC)) {
				$current_Name = $row['Name'];
				$current_Venue = $row['Venue'];				
				$current_Startdate = $row['Startdate'];
				$current_Enddate = $row['Enddate'];
				$current_Category = $row['Category'];
							 
			}
			
			$tCompany_SQLselect = "SELECT * ";
			$tCompany_SQLselect .= "FROM ";
			$tCompany_SQLselect .= "budget ";
			$tCompany_SQLselect .= "WHERE ID = '".$EventID."' ";
			
			$tCompany_SQLselect_Query = mysqli_query($dbConnected,$tCompany_SQLselect);	
			
			while ($row = mysqli_fetch_array($tCompany_SQLselect_Query, MYSQLI_ASSOC)) {
				$current_Food = $row['Food'];
				$current_Venue1 = $row['Venue'];				
				$current_Takeaway = $row['Takeaway'];
				$current_Regkit = $row['Regkit'];
				$current_CoffeeTea = $row['CoffeeTea'];
				$current_TADA = $row['TADA'];				
				$current_Speaker = $row['Speaker'];
				$current_Regamount = $row['Regamount'];				
				$current_Printing = $row['Printing'];
				$current_Miscellaneous = $row['Miscellaneous'];
							 
			}
			
			//mysql_free_result($tCompany_SQLselect_Query);			
	}

	
	
	{	//		FORM postCompany 
		echo '<div class="grandcontainer" align="center">
			<div class="parenrcontainer">';
			echo '<h1>Event Edit Form</h1>';
		echo '<form name="postCompany" action="updateevent.php" method="post">';
		
				echo '<input type="hidden" name="EventID" value="'.$EventID.'"/>';
				echo '
				<table>
					<tr>
						<td>Event Name</td>
						<td><input class="input" type="text" name="Name" value="'.$current_Name.'" required /></td>
					</tr>
					<tr>
						<td>Venue</td>
						<td><input class="input" type="text" name="Venue" value="'.$current_Venue.'" required /></td>
					</tr>
					<tr>
						<td>Startdate</td>
						<td><input class="input" type="text" name="Startdate" value="'.$current_Startdate.'" required /></td>
					</tr>
					<tr>
						<td>Enddate</td>
						<td><input class="input" type="text" name="Enddate" value="'.$current_Enddate.'" required /></td>
					</tr>
					<tr>
						<td>Category</td>
						<td><select name="Category" required>
	
		<option  value="'.$current_Category.'" selected="selected">'.$current_Category.'</option>';
 	
	
			echo '<option value="Workshop">Workshop</option>';
			echo '<option value="Seminar">Seminar</option>';
			echo '<option value="Faculty dev programme">Faculty dev programme</option>';
			echo '<option value="Conference">Conference</option>';
			echo '<option value="Talk">Talk</option>';
	
			echo '</select></td>
					</tr>
				</table>
				<br />
				<h1>Budget Edit Form</h2>
				<table>
					<tr>
						<td>Food</td>
						<td><input class="input" type="number" name="Food" value="'.$current_Food.'"/></td>
					</tr>
					<tr>
						<td>Venue</td>
						<td><input class="input" type="number" name="Venue1" value="'.$current_Venue1.'"/></td>
					</tr>
					<tr>
						<td>Takeaway</td>
						<td><input class="input" type="number" name="Takeaway" value="'.$current_Takeaway.'"/></td>
					</tr>
					<tr>
						<td>Registration kit</td>
						<td><input class="input" type="number" name="Regkit" value="'.$current_Regkit.'"/></td>
					</tr>
					<tr>
						<td>Coffee/Tea</td>
						<td><input class="input" type="number" name="CoffeeTea" value="'.$current_CoffeeTea.'"/></td>
					</tr>
					<tr>
						<td>TADA</td>
						<td><input class="input" type="number" name="TADA" value="'.$current_TADA.'"/></td>
					</tr>
					<tr>
						<td>Speaker</td>
						<td><input class="input" type="number" name="Speaker" value="'.$current_Speaker.'"/></td>
					</tr>
					<tr>
						<td>Registration amount</td>
						<td><input class="input" type="number" name="Regamount" value="'.$current_Regamount.'"/></td>
					</tr>
					<tr>
						<td>Printing</td>
						<td><input class="input" type="number" name="Printing" value="'.$current_Printing.'"/></td>
					</tr>
					<tr>
						<td>Miscellaneous</td>
						<td><input class="input" type="number" name="Miscellaneous" value="'.$current_Miscellaneous.'"/></td>
					</tr>
					<tr>
						<td></td>
						<td align="right"><input class="submitbtn" type="submit"  value="Save" /></td>
					</tr>
				</table>
				';
					
		echo '</form>';
		echo '</div></div>';
	}

}

?>
