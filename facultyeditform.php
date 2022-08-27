
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
			$facultyName = $_POST['Name'];	
		
			$tCompany_SQLselect = "SELECT * ";
			$tCompany_SQLselect .= "FROM ";
			$tCompany_SQLselect .= "faculty ";
			$tCompany_SQLselect .= "WHERE Name = '".$facultyName."' ";
			
			$tCompany_SQLselect_Query = mysqli_query($dbConnected,$tCompany_SQLselect);	
			
			while ($row = mysqli_fetch_array($tCompany_SQLselect_Query, MYSQLI_ASSOC)) {
				$current_Name = $row['Name'];
				$current_EmailID = $row['EmailID'];				
				$current_Phoneno = $row['Phoneno'];
				$current_Designation = $row['Designation'];
							 
			}
			
			
			//mysql_free_result($tCompany_SQLselect_Query);			
	}

	echo '<h1>Faculty Edit Form</h1>';
	
	{	//		FORM postCompany 
	
	echo '<div class="grandcontainer" align="center">
			<div class="parenrcontainer">';
		echo '<form name="postCompany" action="updatefaculty.php" method="post">';
		
				echo '<input type="hidden" name="facultyName" value="'.$facultyName.'"/>';
				echo '
				<table>
					<tr>
						<td>Faculty Name</td>
						<td><input class="input" type="text" name="Name" value="'.$current_Name.'" required /></td>
					</tr>
					<tr>
						<td>EmailID</td>
						<td><input class="input" type="email" pattern="^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$" name="EmailID" value="'.$current_EmailID.'" required /></td>
					</tr>
					<tr>
						<td>Phone number</td>
						<td><input class="input" type="tel" pattern="^[6-9]\d{9}$" name="Phoneno" value="'.$current_Phoneno.'" required /></td>
					</tr>
					<tr>
						<td>Designation</td>
						<td><input class="input" type="text" name="Designation" value="'.$current_Designation.'" required /></td>
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
