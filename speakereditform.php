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
*	This script defines an HTML form to load speaker details
*	and POST changed fields back to this form and UPDATE
*	If UPDATE is good then use header(Location: ...
*	to return to the editspeaker.php form
*
*
*=====================================
*/
include("menu.php");
include_once("includes/connectdb.php");

$thisScriptName = "speakereditform.php";

if ($dbSuccess) {
	
	{	//	SAVE button was clicked 
		if (isset($_POST["saveClicked"])) {
			
			$personFname = $_POST['personFname'];
			$personLname = $_POST['personLname'];
			$EventID = $_POST["EventID"];	
			$Fname = $_POST["Fname"];	
			$Lname = $_POST["Lname"];	
			$Phonenumber = $_POST["Phonenumber"];	
			$Email = $_POST["Email"];	
			$Designation = $_POST["Designation"];
			$Company = $_POST["Company"];	
			$Yearofexp = $_POST["Yearofexp"];	
			
	
			$tPerson_SQLupdate = "UPDATE speaker SET ";			
			$tPerson_SQLupdate .=  "Fname = '".$Fname."', ";
			$tPerson_SQLupdate .=  "Lname = '".$Lname."', ";
			$tPerson_SQLupdate .=  "Phonenumber = '".$Phonenumber."', ";
			$tPerson_SQLupdate .=  "Email = '".$Email."', ";
			$tPerson_SQLupdate .=  "Designation = '".$Designation."' ";
			 $tPerson_SQLupdate .=  ", Company = '".$Company."' ";
			 if(empty($Yearofexp)) $tPerson_SQLupdate .=  ", Yearofexp = NULL";
			 else $tPerson_SQLupdate .=  ", Yearofexp = '".$Yearofexp."' ";
			$tPerson_SQLupdate .=  " WHERE Fname = '".$personFname."' AND Lname = '".$personLname."' "; 	
			
			//echo $tPerson_SQLupdate;
			if (mysqli_query($dbConnected,$tPerson_SQLupdate))  {	
			    echo $tPerson_SQLupdate;
				//echo header("Location: editspeaker.php?EventID=".$EventID);
				
			} else {
				echo '<span style="color:red; ">FAILED to update the speaker.</span><br /><br />';
				
			}	
			
			$tPerson_SQLupdate = "UPDATE speaker1 SET ";			
			$tPerson_SQLupdate .=  "Fname = '".$Fname."', ";
			$tPerson_SQLupdate .=  "Lname = '".$Lname."' ";
			$tPerson_SQLupdate .=  " WHERE Fname = '".$personFname."' AND Lname = '".$personLname."' "; 
			
			if (mysqli_query($dbConnected,$tPerson_SQLupdate))  {	
			    echo $tPerson_SQLupdate;
				echo header("Location: editspeaker.php?EventID=".$EventID);
				
			}
		}	
	//	END:  SAVE button was clicked 	ie. if (isset($saveClicked))
			
	
	{	//  Get the details of the person selected 
			$EventID = $_GET["EventID"];	
			$personFname = $_GET["personFname"];
			$personLname = $_GET["personLname"];
					
			$tPerson_SQLselect = "SELECT * ";
			$tPerson_SQLselect .= "FROM ";
			$tPerson_SQLselect .= "speaker ";
			$tPerson_SQLselect .= "WHERE Fname = '".$personFname."' and Lname = '".$personLname."' ";
			
			$tPerson_SQLselect_Query = mysqli_query($dbConnected,$tPerson_SQLselect);	
			
			while ($row = mysqli_fetch_array($tPerson_SQLselect_Query, MYSQLI_ASSOC)) {
				$current_Fname = $row['Fname'];
				$current_Lname = $row['Lname'];
				$current_Phonenumber = $row['Phonenumber'];
				$current_Email = $row['Email'];
				$current_Designation = $row['Designation'];
				$current_Company = $row['Company'];
				$current_Yearofexp = $row['Yearofexp'];
				 
			}
			
			mysqli_free_result($tPerson_SQLselect_Query);			
	//  END: Get the details of the person selected 
	}

	echo '<h1>Speaker Edit Form</h1>';
	
	{
	
		echo '<div class="grandcontainer" align="center">
			<div class="parenrcontainer">';
		echo '<form name="postPerson" action="speakereditform.php" method="post">';
		
				echo '<input type="hidden" name="personFname" value="'.$personFname.'"/>';
				echo '<input type="hidden" name="personLname" value="'.$personLname.'"/>';
				echo '<input type="hidden" name="EventID" value="'.$EventID.'"/>';
				echo '<input type="hidden" name="saveClicked" value="1"/>';
				
				echo '
				<table>
					<tr>
						<td>First Name</td>
						<td><input class="input" type="text" name="Fname" value="'.$current_Fname.'" required /></td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td><input class="input" type="text" name="Lname" value="'.$current_Lname.'" required /></td>
					</tr>
					<tr>
						<td>Phonenumber</td>
						<td><input class="input" type="tel" pattern="^[6-9]\d{9}$" name="Phonenumber" value="'.$current_Phonenumber.'" required /></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input class="input" type="email" pattern="^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$" name="Email" value="'.$current_Email.'" required /></td>
					</tr>
					<tr>
						<td>Designation</td>
						<td><input class="input" type="text" name="Designation" value="'.$current_Designation.'" required /></td>
					</tr>
					<tr>
						<td>Company</td>
						<td><input class="input" type="text" name="Company" value="'.$current_Company.'"/></td>
					</tr>
					<tr>
						<td>Yearofexp</td>
						<td><input class="input" type="number" name="Yearofexp" value="'.$current_Yearofexp.'"/></td>
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
	
	echo "<br /><br />";
	
	}
}

?>