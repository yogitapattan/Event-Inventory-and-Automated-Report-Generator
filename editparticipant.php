<?php
session_start();
if(!isset($_SESSION["logged_in"]))
	header('Location:loginForm.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="css/display.css">
	</head>
<body>
</body>
</html>


<?php
/*

*	This script edits participants details
*/
include("menu.php");
include_once("includes/connectdb.php");

$thisScriptName = "editparticipant.php";

if ($dbSuccess) {
		
		
		if(!isset($_POST["EventID"])) {$EventID = $_GET["EventID"]; }

		if (isset($_POST["EventID"]) AND $_POST["EventID"] > 0){
		$EventID = $_POST["EventID"];}
			//echo $EventID;
			if(isset($EventID)){
					
			{	
				 
					$indx = 0;
				
					$tPerson_SQLselect = "SELECT participants.USN,participants.Name,participants.Phoneno,participants.EmailID,participants.Department, ";
					$tPerson_SQLselect .= "participants.Semester,participants.Caste,participants1.Amountpaid,participants1.ID,participants1.USN  ";
					$tPerson_SQLselect .= "FROM participants JOIN participants1 ";
					$tPerson_SQLselect .= "ON participants.USN = participants1.USN ";
					$tPerson_SQLselect .= "WHERE participants1.ID = '".$EventID."' ";
					
					
					$tPerson_SQLselect_Query = mysqli_query($dbConnected,$tPerson_SQLselect);	
					
					while ($row = mysqli_fetch_array($tPerson_SQLselect_Query, MYSQLI_ASSOC)) {
						
						
						$personArray[$indx]['USN'] = $row['USN'];
						$personArray[$indx]['Name'] = $row['Name'];
						$personArray[$indx]['Phoneno'] = $row['Phoneno'];
						$personArray[$indx]['EmailID'] = $row['EmailID'];
						$personArray[$indx]['Department'] = $row['Department'];
						$personArray[$indx]['Semester'] = $row['Semester'];
						$personArray[$indx]['Caste'] = $row['Caste'];
						$personArray[$indx]['Amountpaid'] = $row['Amountpaid'];
	
						$indx++;			 
					}
		
					$numPersons = sizeof($personArray);
							
					mysqli_free_result($tPerson_SQLselect_Query);			
			}
		
			{	//		Output 

					echo '<h1> Edit Participant Details</h1><br>';
					
					echo '<div>';
							
							echo '<div>';
				
							{	//		Table of tPerson records
							echo '<table id="mytable" align="center" >';
								echo '<tr>
											<td class="td">USN</td>
											<td class="td">Name</td>
											<td class="td">Department</td>
											<td class="td">Semester</td>
											<td class="td">EmailID</td>
											<td class="td">Phoneno</td>
											<td class="td">Caste</td>
											<td class="td">Amountpaid</td>
											<td class="td"></td>
										</tr>	';	
																		
								for ($indx = 0; $indx < $numPersons; $indx++) {
									$thisUSN = $personArray[$indx]['USN'];
									$personEditLink = '<a href="participanteditform.php?USN='.$thisUSN.'&EventID='.$EventID.'">Edit</a>';
								 
		 
									echo '<tr  height="20">
									
												<td class="td">'.$personArray[$indx]['USN'].'</td>
												
												<td class="td">'.$personArray[$indx]['Name'].'</td>
												
												<td class="td">'.$personArray[$indx]['Department'].'</td>
		
												<td class="td">'.$personArray[$indx]['Semester'].'</td>
												
												<td class="td">'.$personArray[$indx]['EmailID'].'</td>
		
												<td class="td">'.$personArray[$indx]['Phoneno'].'</td>
		
												<td class="td">'.$personArray[$indx]['Caste'].'</td>
												
												<td class="td">'.$personArray[$indx]['Amountpaid'].'</td>
												
												<td class="td">'.$personEditLink.'</td>
												
											</tr>	';			     
								}
							echo '</table>';
							//		END:  Table of tPerson records
							}	
																								
							echo '</div>';		//		END:  <div style="margin-left: 100; ">
							
					echo '</div>';				//		END:	<div style=" font-family...">
					echo '<a class="back" href="updateevent.php?EventID='.$EventID.'">&laquo; Back</a>';

			//		END: Output section 
			}
				
		} 
		
//		END:	if ($dbSuccess)
}

echo "<br /><br />";

//unset($companyID);


?>
