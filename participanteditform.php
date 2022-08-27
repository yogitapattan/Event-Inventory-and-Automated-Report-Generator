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
*	This script defines an HTML form to load participant details
*	and POST changed fields back to this form and UPDATE
*	If UPDATE is good then use header(Location: ...
*	to return to the editparticipant.php form
*
*
*=====================================
*/
include("menu.php");
include_once("includes/connectdb.php");

$thisScriptName = "participanteditform.php";

if ($dbSuccess) {
	
	{	//	SAVE button was clicked 
		if (isset($_POST["saveClicked"])) {
			
			$oldUSN = $_POST['oldUSN'];
			$EventID = $_POST["EventID"];	
			$Name = $_POST["Name"];	
			$USN = $_POST["USN"];	
			$Phoneno = $_POST["Phoneno"];	
			$EmailID = $_POST["EmailID"];	
			$Department = $_POST["Department"];
			$Caste = $_POST["Caste"];	
			$Semester = $_POST["Semester"];	
			$Amountpaid = $_POST["Amountpaid"];	
			
	
			$tPerson_SQLupdate = "UPDATE participants SET ";
			 $tPerson_SQLupdate .=  "USN = '".$USN."' ";
			$tPerson_SQLupdate .=  ", Name = '".$Name."' ";
			 $tPerson_SQLupdate .=  ", Department = '".$Department."' ";
			 $tPerson_SQLupdate .=  ", Semester = '".$Semester."' ";
			 $tPerson_SQLupdate .=  ", EmailID = '".$EmailID."' ";
			$tPerson_SQLupdate .=  ", Phoneno = '".$Phoneno."' ";
			 $tPerson_SQLupdate .=  ", Caste = '".$Caste."' ";
			$tPerson_SQLupdate .=  " WHERE USN = '".$oldUSN."'"; 	
	
			
			if (mysqli_query($dbConnected,$tPerson_SQLupdate))  {	
			    echo $tPerson_SQLupdate;
				//echo header("Location: editparticipant.php?EventID=".$EventID);
			} else {
				echo $tPerson_SQLupdate;
				echo '<span style="color:red; ">FAILED to update the participant.</span><br /><br />';
				
			}	

			$tPerson_SQLupdate = "UPDATE participants1 SET ";
			 $tPerson_SQLupdate .=  "USN = '".$USN."' ";
			if(empty($Amountpaid)) $tPerson_SQLupdate .=  ", Amountpaid = NULL";
			 else $tPerson_SQLupdate .=  ", Amountpaid = '".$Amountpaid."' ";
			$tPerson_SQLupdate .=  " WHERE USN = '".$oldUSN."' ";//AND ID = '".$EventID."' "; 	
	
			
			if (mysqli_query($dbConnected,$tPerson_SQLupdate))  {	
			    echo $tPerson_SQLupdate;
				echo header("Location: editparticipant.php?EventID=".$EventID);
			} else {
				echo $tPerson_SQLupdate;
				echo '<span style="color:red; ">FAILED to update the participant.</span><br /><br />';
				
			}
			
		}	
	//	END:  SAVE button was clicked 	ie. if (isset($saveClicked))
	}		
	
	{	//  Get the details of the person selected 
			$EventID = $_GET["EventID"];	
			$USN = $_GET["USN"];	
					
			$tPerson_SQLselect = "SELECT participants.USN,participants.Name,participants.Phoneno,participants.EmailID,participants.Department, ";
			$tPerson_SQLselect .= "participants.Semester,participants.Caste,participants1.Amountpaid,participants1.ID,participants1.USN  ";
			$tPerson_SQLselect .= "FROM participants JOIN participants1 ";
			$tPerson_SQLselect .= "ON participants.USN = participants1.USN ";
			$tPerson_SQLselect .= "WHERE participants1.USN = '".$USN."' AND participants1.ID = '".$EventID."' "; 
			
			$tPerson_SQLselect_Query = mysqli_query($dbConnected,$tPerson_SQLselect);	
			
			while ($row = mysqli_fetch_array($tPerson_SQLselect_Query, MYSQLI_ASSOC)) {
				$current_USN = $row['USN'];
				$current_Name = $row['Name'];
				$current_Department = $row['Department'];
				$current_Phoneno = $row['Phoneno'];
				$current_EmailID = $row['EmailID'];
				$current_Semester = $row['Semester'];
				$current_Caste = $row['Caste'];
				$current_Amountpaid = $row['Amountpaid'];
				 
			}
			
			mysqli_free_result($tPerson_SQLselect_Query);			
	//  END: Get the details of the person selected 
	}

	echo '<h1>Participant Edit Form</h2>';
	
	{	//		FORM postPerson 
		echo '<div class="grandcontainer" align="center">
			<div class="parenrcontainer">';
		echo '<form name="postPerson" action="participanteditform.php" method="post">';
		
				echo '<input type="hidden" name="oldUSN" value="'.$USN.'"/>';
				echo '<input type="hidden" name="EventID" value="'.$EventID.'"/>';
				echo '<input type="hidden" name="saveClicked" value="1"/>';
				
				echo '
				<table>
					<tr>
						<td>USN</td>
						<td><input class="input" type="text" name="USN" value="'.$current_USN.'" required /></td>
					</tr>
					<tr>
						<td>Name</td>
						<td><input class="input" type="text" name="Name" value="'.$current_Name.'" required /></td>
					</tr>
					<tr>
						<td>Department</td>
						<td><input class="input" type="text" name="Department" value="'.$current_Department.'"/></td>
					</tr>
					<tr>
						<td>Semester</td>
						<td><input class="input" type="text" name="Semester" value="'.$current_Semester.'"/></td>
					</tr>
					<tr>
						<td>EmailID</td>
						<td><input class="input" type="email" pattern="^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$" name="EmailID" value="'.$current_EmailID.'"/></td>
					</tr>
					<tr>
						<td>Phoneno</td>
						<td><input class="input" type="tel" pattern="^[6-9]\d{9}$" name="Phoneno" value="'.$current_Phoneno.'" required /></td>
					</tr>
					<tr>
						<td>Caste</td>
						<td><input class="input" type="text" name="Caste" value="'.$current_Caste.'"/></td>
					</tr>
					<tr>
						<td>Amountpaid</td>
						<td><input class="input" type="number" name="Amountpaid" value="'.$current_Amountpaid.'"/></td>
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
