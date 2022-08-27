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
*	This script displays event
*
*
*=====================================
*/

include("menu.php");
include_once("includes/connectdb.php");

if ($dbSuccess) {
	
	{	//  Get the details of the company selected 
			if(!isset($_POST["EventID"]))
			{$EventID = $_GET["EventID"];}
			else
			{
				$EventID = $_POST["EventID"];	
			}
			
			if ($EventID == 0) {
				header("Location: selectevent.php");	
			}
			
			$tPerson_SQLselect = "SELECT  ";
			$tPerson_SQLselect .= "event.ID AS EventID, ";	
			$tPerson_SQLselect .= "event.Venue, event.Startdate, event.Enddate, event.Name, ";	
			$tPerson_SQLselect .= "budget.Venue AS Venue1, budget.Food, budget.Takeaway, budget.Regkit, ";	
			$tPerson_SQLselect .= "budget.CoffeeTea, budget.TADA, budget.Speaker, ";
			$tPerson_SQLselect .= "budget.Regamount, budget.Printing, budget.Miscellaneous, budget.ID  ";			
			$tPerson_SQLselect .= "FROM event JOIN budget ";
			$tPerson_SQLselect .= "ON budget.ID = event.ID  WHERE event.ID='".$EventID."'";
			
			//echo $tPerson_SQLselect;
			$tPerson_SQLselect_Query = mysqli_query($dbConnected,$tPerson_SQLselect);	
			
			while ($row = mysqli_fetch_array($tPerson_SQLselect_Query, MYSQLI_ASSOC)) {
				$Name = $row['Name'];
				$Venue = $row['Venue'];
				$Startdate = $row['Startdate'];
				$Enddate = $row['Enddate'];
			
				
				$Venue1 = $row['Venue1'];
				$Food = $row['Food'];
				$Takeaway = $row['Takeaway'];
				$Regkit = $row['Regkit'];
				$CoffeeTea = $row['CoffeeTea'];
				$TADA = $row['TADA'];
				$Speaker = $row['Speaker'];
				$Regamount = $row['Regamount'];
				$Printing = $row['Printing'];
				$Miscellaneous = $row['Miscellaneous'];
				if(empty($Food)) $Food=0;
				if(empty($Venue1)) $Venue1=0;
				if(empty($Takeaway)) $Takeaway=0;
				if(empty($Regkit)) $Regkit=0;
				if(empty($CoffeeTea)) $CoffeeTea=0;
				if(empty($TADA)) $TADA=0;
				if(empty($Speaker)) $Speaker=0;
				if(empty($Regamount)) $Regamount=0;
				if(empty($Printing)) $Printing=0;
				if(empty($Miscellaneous)) $Miscellaneous=0;	
                $exp = $Venue1+$Food+$Takeaway+$Regkit+$CoffeeTea+$TADA+$Speaker+$Printing+$Miscellaneous;
                $amountcollected = $Regamount;
				$profit = $amountcollected - $exp;	
				if($profit<0)
					$profit=0;
			}
			
			mysqli_free_result($tPerson_SQLselect_Query);


			$tPerson_SQLselect = "SELECT * ";
			$tPerson_SQLselect .= "FROM ";
			$tPerson_SQLselect .= "incharge ";
			$tPerson_SQLselect .= "WHERE ID = '".$EventID."' ";
			
			$tPerson_SQLselect_Query = mysqli_query($dbConnected,$tPerson_SQLselect);	
			
			$indx = 0;
		
			while ($row = mysqli_fetch_array($tPerson_SQLselect_Query, MYSQLI_ASSOC)) {
				
				$personArray1[$indx]['Name'] = $row['Name'];
				$indx++;			 
			}
			if($indx >0){
				$numPersons1 = sizeof($personArray1);
			} else {
				
				$numPersons1 = 0;
			}
					
			mysqli_free_result($tPerson_SQLselect_Query);
	}
	
	{	//  Get the details of all associated Person records
		//		and store in array:  personArray  with key >$indx
		 
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
			if($indx >0){
				$numPersons = sizeof($personArray);
			} else {
				
				$numPersons = 0;
			}
					
			mysqli_free_result($tPerson_SQLselect_Query);			
	}
	
	{	//		Output 
	
			echo '<div align = "center">';

					
					echo '<h1>'.$Name.'</h1>';
					echo '<h2>Event Details</h2>';
					echo '<table align="center" class="table">';
					echo '<tr>
								<td>Name</td>
								<td>'.$Name.'</td>
						  </tr>';
					echo '<tr>
								<td>Venue</td>
								<td>'.$Venue.'</td>
						  </tr>';
					echo '<tr>
								<td>Start Date</td>
								<td>'.$Startdate.'</td>
						  </tr>';
					echo '<tr>
								<td>End Date</td>
								<td>'.$Enddate.'</td>
						  </tr>';
							
					echo '</table>';
					echo '<p>Faculty Incharge<br>';
					for ($indx = 0; $indx < $numPersons1; $indx++){
						$var = $indx+1;
						echo ''.$var.'. '.$personArray1[$indx]['Name'].'<br>';
					}
					echo'</p>';
					echo '<h2>Budget Details</h2>';
					echo '<table align="center">';
					echo '<tr>
								<td>Venue</td>
								<td>'.$Venue1.'</td>
						  </tr>';
					echo '<tr>
								<td>Food</td>
								<td>'.$Food.'</td>
						  </tr>';
					echo '<tr>
								<td>Takeaway</td>
								<td>'.$Takeaway.'</td>
						  </tr>';
					echo '<tr>
								<td>Registration Kit</td>
								<td>'.$Regkit.'</td>
						  </tr>';
					echo '<tr>
								<td>Coffee/Tea</td>
								<td>'.$CoffeeTea.'</td>
						  </tr>';
					echo '<tr>
								<td>TADA</td>
								<td>'.$TADA.'</td>
						  </tr>';
					echo '<tr>
								<td>Speaker</td>
								<td>'.$Speaker.'</td>
						  </tr>';
					echo '<tr>
								<td>Registration Amount</td>
								<td>'.$Regamount.'</td>
						  </tr>';
					echo '<tr>
								<td>Printing</td>
								<td>'.$Printing.'</td>
						  </tr>';
					echo '<tr>
								<td>Miscellaneous</td>
								<td>'.$Miscellaneous.'</td>
						  </tr>';
					echo'</table>';
				
					echo '<p> Expenditure: '.$exp.' <br />Amount Collected: '.$amountcollected.' <br />Profit: '.$profit.' </p>';
						
						echo '<h2>Speaker Details</h2>';
						echo '<table id="mytable" align = "center">';
						
						echo '<tr>
								<th class="th" >First Name</th>
								<th class="th" >Last Name</th>
								<th class="th">Phone number</th>
								<th class="th" >Email ID</th>
								<th class="th" >Designation</th>
								<th class="th" >Company</th>
								<th class="th" >Years of Experience</th>
							</tr>';
							
						for ($indx = 0; $indx < $numPersons; $indx++) {
						
							 
						    
							echo '<tr>
										<td class="td" >
										'.$personArray[$indx]['Fname'].'
										</td>
										
										<td class="td">
										'.$personArray[$indx]['Lname'].'
										</td>
										
										<td class="td">
										'.$personArray[$indx]['Phonenumber'].'
										</td>

										<td class="td">
										'.$personArray[$indx]['Email'].'
										</td>
										
										<td class="td">
										'.$personArray[$indx]['Designation'].'
										</td>
										
										<td class="td">
										'.$personArray[$indx]['Company'].'
										</td>

										<td class="td">
										'.$personArray[$indx]['Yearofexp'].'
										</td>
									</tr>	';			     
						}
						echo '</table>';
					echo '</div>';		//		END:  <div style="margin-left: 100; ">
			echo '</div>';				//		END:	<div style=" font-family...">


	
	}
	
}

echo "<br /><br />";

echo '<a class="back" href="displayparticipants.php?EventID='.$EventID.'">Participant Details</a>';

?>
