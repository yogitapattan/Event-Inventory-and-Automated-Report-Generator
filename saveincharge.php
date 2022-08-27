<?php
session_start();
if(!isset($_SESSION["logged_in"]))
	header('Location:loginForm.php');
?>

<?php
/*

*
*	This script collects data from insertincharge.php
*	and processes it
*
*
*=====================================
*/
include("email.php");
include("menu.php");
include_once("includes/connectdb.php");
if ($dbSuccess) {
		
		{  //   collect the data with $_POST
		
			$eventName = $_POST['Eventname'];
			
				$tCompany_SQLinsert = "INSERT INTO event (";			
				//$tCompany_SQLinsert .=  "ID, ";
				$tCompany_SQLinsert .=  "Name, ";
				$tCompany_SQLinsert .=  "Venue, ";
				$tCompany_SQLinsert .=  "Startdate, ";
				$tCompany_SQLinsert .=  "Enddate, ";				
				$tCompany_SQLinsert .=  "Category ";
				$tCompany_SQLinsert .=  ") ";
				
			
				$tCompany_SQLinsert .=  "VALUES (";
				//$tCompany_SQLinsert .=  "'".$newID."', ";
				$tCompany_SQLinsert .=  "'".$eventName."', ";
				$tCompany_SQLinsert .=  "'undefined', ";
				$tCompany_SQLinsert .=  "'2019-12-12 00:00:00', ";
				$tCompany_SQLinsert .=  "'2019-12-12 00:00:00', ";
				$tCompany_SQLinsert .=  "'undefined' ";
				$tCompany_SQLinsert .=  ") ";
				
				//echo $tCompany_SQLinsert;
				if (mysqli_query($dbConnected,$tCompany_SQLinsert))  {	
						echo '<h5 align="center" style="color:green; font-size:20px;">Successfully Created New Event.</h5><br /><br />';
					} else {
						echo '<h5 align="center" style="color:red; font-size:20px;">Failed to create new Event.</h5><br /><br />';
						
					}
			
			$i=0;
			foreach ((array)$_POST['faculty_selected'] as $fs){
				$faculty_array[$i] = explode(',',$fs);
				$Name =  $faculty_array[$i][0];
				$EmailID = $faculty_array[$i][1];
				
				//   SQL:     $tCompany_SQLinsert
						
				$tcompany_SQLretrieve = "SELECT ID FROM event ORDER BY ID DESC LIMIT 1 ";
				$tcompany_SQL = mysqli_query($dbConnected,$tcompany_SQLretrieve)	;			
			     $ID = mysqli_fetch_row($tcompany_SQL);
				 $newID = $ID[0];
		
				$tCompany_SQLinsert = "INSERT INTO incharge (";			
				$tCompany_SQLinsert .=  "ID, ";
				$tCompany_SQLinsert .=  "Name ";
				$tCompany_SQLinsert .=  ") ";
			
				$tCompany_SQLinsert .=  "VALUES (";
				$tCompany_SQLinsert .=  "'".$newID."', ";
				$tCompany_SQLinsert .=  "'".$Name."' ";
				$tCompany_SQLinsert .=  ") ";
				
				
				{	//		check the data and process it 
			
					 (mysqli_query($dbConnected,$tCompany_SQLinsert)) ;	
					
		}
				$i++;
				
			}//end for
		//email
		{
			
			email($faculty_array,$i,$eventName);
			
		
		}


		}
			
		
		
		

}

?>
