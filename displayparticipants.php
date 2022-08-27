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

*
*	This script displays list of participants
*
*=====================================
*/


include_once("includes/connectdb.php");
include("menu.php");

if ($dbSuccess) {
	
	{	//  Get the details of the company selected 
			$EventID = $_GET["EventID"];	
			
			if ($EventID == 0) {
				header("Location: selectevent.php");	
			}
					
	}
	
	{	//  Get the details of all associated Person records
		//		and store in array:  personArray  with key >$indx
		 
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
				$personArray[$indx]['Caste'] = $row['Caste'];
				$personArray[$indx]['Amountpaid'] = $row['Amountpaid'];
				$personArray[$indx]['Semester'] = $row['Semester'];
					
				$indx++;			 
			}
			if($indx >0){
				$numPersons = sizeof($personArray);
			} else {
				
				$numPersons = 0;
			}
					
			mysqli_free_result($tPerson_SQLselect_Query);			
	}
	
	{	//		Output 
	
			echo '<div style=" font-family: arial, helvetica, sans-serif; ">';

					echo '<h1>Participant Details</h1><br>';
					echo '<div style="margin-left: 100; ">';
					
						
			
						echo '<table id="mytable" align="center" >';
						
						echo '<tr>
								<th class="th">USN</th>
								<th class="th">Name</th>
								<th class="th">Department</th>
								<th class="th">Semester</th>
								<th class="th">Email ID</th>
								<th class="th">Phone number</th>
								<th class="th">Caste</th>
								<th class="th">Amountpaid</th>
							</tr>';
							
						for ($indx = 0; $indx < $numPersons; $indx++) {
						
							 
						    
							echo '<tr>
							
										<td class="td">
										'.$personArray[$indx]['USN'].'
										</td>
										
										<td class="td">
										'.$personArray[$indx]['Name'].'
										</td>
										
										<td class="td">
										'.$personArray[$indx]['Department'].'
										</td>

										<td class="td">
										'.$personArray[$indx]['Semester'].'
										</td>
										
										<td class="td">
										'.$personArray[$indx]['EmailID'].'
										</td>
										
										<td class="td">
										'.$personArray[$indx]['Phoneno'].'
										</td>

										<td class="td">
										'.$personArray[$indx]['Caste'].'
										</td>
										
										<td class="td">
										'.$personArray[$indx]['Amountpaid'].'
										</td>
									</tr>	';			     
						}
						echo '</table>';
					echo '</div>';		//		END:  <div style="margin-left: 100; ">
			echo '</div>';				//		END:	<div style=" font-family...">


	
	}
	
}

echo "<br /><br /><br><br>";

echo '<a class="back" href="attendance.php?EventID='.$EventID.'">Obtain attendance sheet</a>';
echo "<br />";
echo '<a class="back" href="getfiles.php?EventID='.$EventID.'">View Event Files</a>';
echo "<br />";


?>
