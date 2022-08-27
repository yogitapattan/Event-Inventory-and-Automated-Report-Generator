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


session_start();
if(!isset($_SESSION["logged_in"]))
	header('Location:loginForm.php');

include("menu.php");
include_once("includes/connectdb.php");
require('fpdf.php');
if(isset($_POST['EventID']))
{
	$EventID = $_POST['EventID'];;
	$EventName = "select Name,Startdate,Enddate,Venue from event where ID = ".$EventID."";
	$tPerson_SQLselect_Query = mysqli_query($dbConnected,$EventName);
	while ($row = mysqli_fetch_array($tPerson_SQLselect_Query , MYSQLI_ASSOC)) {
		$Name = $row['Name'];
		$Starttime1 = $row['Startdate'];
		$Endtime1 = $row['Enddate'];
		$Venue = $row['Venue'];
	}

	echo ' <h1> <b> RV College Of Engineering, Bangalore-59 </b> </h1>';
	
	echo	 '<div align="center" >  <h3> <i> (Autonomous Institution affliated to VTU, Belgavi) </i> <br>
		   Department Of Information Science And Engineering </h3>
		   <img  src = "images\rvlogo.jpg" alt = "RVCE Image"  class="center"/>
		   <h2> '.$Name.' </h2> 
		   <p > Duration: '.$Starttime1.' to '.$Endtime1.'	<br></p> <p>Venue: '.$Venue.'<br></p>';
		   

			$Incharge = "select Name from incharge where ID = ".$EventID."";
			$tPerson_SQLselect_Query = mysqli_query($dbConnected,$Incharge);
			$indx1 = 0;
			
			while ($row = mysqli_fetch_array($tPerson_SQLselect_Query, MYSQLI_ASSOC)) {
				$personArray1[$indx1] = $row['Name'];
				$indx1++;	
				if($indx1 >0){
					$numPersons1 = sizeof($personArray1);
				} else {
					$numPersons1 = 0;
				}				
			}
			echo '<p><b> Incharge: </b><br></p>';
				for ($i = 0; $i < $numPersons1; $i++){
					$var = $i+1;
					echo ' <p>'.$var.'. '.$personArray1[$i].'</p>';
				}
				
		   
		
			  
		  
	echo '
		  <form enctype="multipart/form-data" action="report.php" method="POST">
				<input type="hidden" name="uploadActivated" value=1 />
				<input type="hidden" name="EventID" value="'.$EventID.'" />
				<p><b>Upload Images:</b></p> <input name="userfile[]" type="file" multiple />
				<input class = "submitbtn" type="submit" value="Submit" />
		  </form>';
	$imagePath = [];
	$im=0;	
	$Path="";				
	if(isset($_POST['uploadActivated']) AND $_POST['uploadActivated'] == 1)
	{
		$whiteList = array(".jpg", ".png", ".gif", ".jpeg");
			$im=0;
			foreach($_FILES['userfile']['name'] as $key=>$val)
			{	

				$path = "select Path from files where ID = ".$EventID."";
				$tPerson_SQLselect_Query = mysqli_query($dbConnected,$path);
				while ($row = mysqli_fetch_array($tPerson_SQLselect_Query , MYSQLI_ASSOC)) {
					$Path = $row['Path'];
				}
				
				$filetype = false;
				foreach ($whiteList as $file)
				{
					if(preg_match("/$file\$/i", $_FILES['userfile']['name'][$key]))
					{
						$imagePath[$im] = $Path.$_FILES['userfile']['name'][$key];
						$filetype = true;
						break;
						//echo $imagePath[$i];
					}
					
				}
				if($filetype==false) { echo '<h5 align="center" style="color:red;font-size:20px;">ERROR: Invalid File Type.</h5><br /><br />'; }
				$im++;
				 
			}
			for($j=0;$j<$im;$j++)
			{
				echo '<img src="'.$imagePath[$j].'" alt="Test Image uploaded" /> <br>
						<textarea form="report" rows = "4" cols = "50" name="imgdesc[]">
						</textarea>	<br>';	
			}
	}
	
	echo '<p><b> Description of the Event </b></p> 
		  <textarea form="report" rows="4" cols="189" name="description"></textarea>'; 

	$Speaker = "SELECT speaker.Fname,speaker.Lname,speaker.Company,";
	$Speaker .= "speaker1.ID, speaker1.Fname, speaker1.Lname ";
	$Speaker .= "FROM speaker JOIN speaker1 ";
	$Speaker .= "ON speaker1.Fname = speaker.Fname and speaker1.Lname = speaker.Lname WHERE speaker1.ID = '".$EventID."' ";
				$tPerson_SQLselect_Query = mysqli_query($dbConnected,$Speaker);	
				$indx = 0;
				while ($row = mysqli_fetch_array($tPerson_SQLselect_Query, MYSQLI_ASSOC)) {
					
					$personArray[$indx]['Fname'] = $row['Fname'];
					$personArray[$indx]['Lname'] = $row['Lname'];
					$personArray[$indx]['Company'] = $row['Company'];
						
					$indx++;			 
				}
				if($indx >0){
					$numPersons = sizeof($personArray);
				} else {
					
					$numPersons = 0;
				}		
				mysqli_free_result($tPerson_SQLselect_Query);
				echo '<p><b>Speakers:</b></p>';
								echo '<table id="mytable">';
										echo '<tr>
									<th class="th">First Name</th>
									<th class="th">Last Name</th>
									<th class="th">Company</th>
								</tr>';
								
							for ($indx = 0; $indx < $numPersons; $indx++) {
								
								echo '<tr>
											<td class="td">
											'.$personArray[$indx]['Fname'].'
											</td>
											
											<td class="td">
											'.$personArray[$indx]['Lname'].'
											</td>
											
											<td class="td">
											'.$personArray[$indx]['Company'].'
											</td>
										</tr>	';			     
							}
							echo '</table>';
							
							
				$tPerson_SQLselect = "SELECT  ";	
				$tPerson_SQLselect .= "Venue ,Food, Takeaway, Regkit, ";	
				$tPerson_SQLselect .= "CoffeeTea, TADA, Speaker, ";
				$tPerson_SQLselect .= "Regamount, Printing, Miscellaneous FROM budget ";			
				
				$tPerson_SQLselect .= "WHERE ID='".$EventID."'";
				 $tPerson_SQLselect_Query = mysqli_query($dbConnected,$tPerson_SQLselect);
				 
				 $exp=0;
				 $profit=0;
				 $amountcollected=0;
				while ($row = mysqli_fetch_array($tPerson_SQLselect_Query, MYSQLI_ASSOC)) {
					
					$Venue = $row['Venue'];
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
					if($profit>0)
						$profit=$profit;
					else
						$profit=0;					
				}
				
		echo '<p>Expenditure: '.$exp.'  Amount Collected: '.$amountcollected.' Profit: '.$profit.'   </p>';
		
		mysqli_free_result($tPerson_SQLselect_Query);

	//if(isset($_POST['uploadActivated']) AND $_POST['uploadActivated'] == 1)
	{
		
		echo '<form id="report" action="pdf.php" method="post">
				<input type="hidden" name = "eventID" value="'.$EventID.'"/>
				<input type="hidden" name = "eventname" value="'.$Name.'"/>
				<input type="hidden" name = "startdate" value="'.$Starttime1.'"/>
				<input type="hidden" name = "enddate" value="'.$Endtime1.'"/>
				<input type="hidden" name = "venue" value="'.$Venue.'"/>
				<input type="hidden" name = "numimages" value="'.$im.'"/>
				<input type="hidden" name = "numinch" value="'.$indx1.'"/>';
				for($i=0; $i<$im;$i++){
					echo "<input type='hidden' name='images[]' value='".$imagePath[$i]."'</input>";
				}
				for($i=0; $i<$indx1;$i++)
				echo '<input type="hidden" name = "incharge[]" value="'.$personArray1[$i].'"/>';
				echo'
				<input type="hidden" name = "expenditure" value="'.$exp.'"/>
				<input type="hidden" name = "amountcollected" value="'.$amountcollected.'"/>
				<input type="hidden" name = "profit" value="'.$profit.'"/>
				<input class="submitbtn" type="submit" value="Generate report"/>';
		echo '</form>';
		echo '</div>';
	}
}
else
{
	$tCompany_SQLselect = "SELECT  ";
	$tCompany_SQLselect .= "ID, Name, Venue ";	
	$tCompany_SQLselect .= "FROM ";
	$tCompany_SQLselect .= "event ";
	$tCompany_SQLselect .= "WHERE Venue != 'undefined' Order By Name ";
	

	$tCompany_SQLselect_Query = mysqli_query($dbConnected,$tCompany_SQLselect);	
	
	echo '<div class="grandcontainer" align="center">';
	echo '<div class="parentcontainer">';
	echo '<h1>Select Event</h1><br>';
	echo '<form action="report.php" method="post">';
	
	echo '<select name="EventID" required>';
	
		echo '<option value="" selected="selected" >..select event..</option>';
 	
	
			while ($row = mysqli_fetch_array($tCompany_SQLselect_Query, MYSQLI_ASSOC)) {
			    $ID = $row['ID'];
			    $eventName = $row['Name'];
			    $Venue = $row['Venue'];			    			    
			    echo '<option value="'.$ID.'">'.$eventName.'</option>';
			}
		
			mysqli_free_result($tCompany_SQLselect_Query);		
	
			echo '</select>';
	
			echo'<br><br>';
			echo '<input class="submitbtn" type="submit" />';
			
	echo '</form></div></div>';
}
?>
