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

*	This script edit speaker details
*/

include_once("includes/connectdb.php");
include("menu.php");

$thisScriptName = "editspeaker.php";

if ($dbSuccess) {
		
		
		if(!isset($_POST["EventID"])) {$EventID = $_GET["EventID"]; }

		if (isset($_POST["EventID"]) AND $_POST["EventID"] > 0){
		$EventID = $_POST["EventID"];}
			//echo $EventID;
			if(isset($EventID)){
			
			{	
				 
					$indx = 0;
				
					$tPerson_SQLselect = "SELECT speaker.Fname,speaker.Lname,speaker.Phonenumber,speaker.Email,speaker.Designation,speaker.Company,speaker.Yearofexp, ";
					$tPerson_SQLselect .= "speaker1.ID, speaker1.Fname, speaker1.Lname ";
					$tPerson_SQLselect .= "FROM speaker JOIN speaker1 ";
					$tPerson_SQLselect .= "ON speaker1.Fname = speaker.Fname and speaker1.Lname = speaker.Lname WHERE speaker1.ID = '".$EventID."' ";
					$tPerson_SQLselect_Query = mysqli_query($dbConnected,$tPerson_SQLselect);	
					
					while ($row = mysqli_fetch_array($tPerson_SQLselect_Query, MYSQLI_ASSOC)) {
						
						
						$personArray[$indx]['Fname'] = $row['Fname'];
						$personArray[$indx]['Lname'] = $row['Lname'];
						$personArray[$indx]['Phonenumber'] = $row['Phonenumber'];
						$personArray[$indx]['Email'] = $row['Email'];
						$personArray[$indx]['Designation'] = $row['Designation'];
						$personArray[$indx]['Company'] = $row['Company'];
						$personArray[$indx]['Yearofexp'] = $row['Yearofexp'];
	
						$indx++;			 
					}
		
					$numPersons = sizeof($personArray);
							
					mysqli_free_result($tPerson_SQLselect_Query);			
			}
		
			{	//		Output 

					
					echo '<h1>Edit Speaker Details</h1><br>';
					echo '<div>';
		
															
							echo '<div>';
				
							{	//		Table of tPerson records
                            echo '<br><br>';
							echo '<table id="mytable" align="center">';
								echo '<tr>
											<td class="td"><b>First Name</b></td>
											<td class="td"><b>Last Name</b></td>
											<td class="td"><b>Phonenumber</b></td>
											<td class="td"><b>Email</b></td>
											<td class="td"><b>Designation</b></td>
											<td class="td"><b>Company</b></td>
											<td class="td"><b>Yearofexp</b></td>
											<td class="td"></td>
										</tr>	';	
																		
								for ($indx = 0; $indx < $numPersons; $indx++) {
									$thisFname = $personArray[$indx]['Fname'];
									$thisLname = $personArray[$indx]['Lname'];
									$personEditLink = '<a href="speakereditform.php?personFname='.$thisFname.'&personLname='.$thisLname.'&EventID='.$EventID.'">Edit</a>';
								 
		 
									echo '<tr  height="20">
									
												<td class="td">'.$personArray[$indx]['Fname'].'</td>
												
												<td class="td">'.$personArray[$indx]['Lname'].'</td>
												
												<td class="td">'.$personArray[$indx]['Phonenumber'].'</td>
		
												<td class="td">'.$personArray[$indx]['Email'].'</td>
		
												<td class="td">'.$personArray[$indx]['Designation'].'</td>
												
												<td class="td">'.$personArray[$indx]['Company'].'</td>
		
												<td class="td">'.$personArray[$indx]['Yearofexp'].'</td>
												
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


?>
