<?php
session_start();
if(!isset($_SESSION["logged_in"]))
	header('Location:loginForm.php');
?>

<?php
/*

*	
*	This script collects data from insertfaculty.php
*	and processes it
*
*
*=====================================
*/

{ 		//	Secure Connection Script$db = array(

include_once("includes/connectdb.php");
include("menu.php");


if ($dbSuccess) {
		
		{  //   collect the data with $_POST
				
			$Name = $_POST["Name"];	
			$EmailID = $_POST["EmailID"];	
			$Phoneno = $_POST["Phoneno"];	
			$Designation = $_POST["Designation"];

			
				
		}
			
		{  //   SQL:     $tCompany_SQLinsert	
		
			$tCompany_SQLinsert = "INSERT INTO faculty (";	
			$tCompany_SQLinsert .=  "Name, ";
			$tCompany_SQLinsert .=  "EmailID, ";
			$tCompany_SQLinsert .=  "Phoneno, ";
			$tCompany_SQLinsert .=  "Designation ";
			$tCompany_SQLinsert .=  ") ";
			
			$tCompany_SQLinsert .=  "VALUES (";
			$tCompany_SQLinsert .=  "'".$Name."', ";
			$tCompany_SQLinsert .=  "'".$EmailID."', ";
			$tCompany_SQLinsert .=  "'".$Phoneno."', ";
			$tCompany_SQLinsert .=  "'".$Designation."' ";
			$tCompany_SQLinsert .=  ") ";
		}
		
		{	//		check the data and process it 

			/*include_once("includes/validation.php");
			if(valid_phone($Phoneno))
				echo 'Valid';
			else
			echo 'invalid';*/
			
			if (empty($Name)) {
				echo '<h5 align="center" style="color:red; font-size:20px; ">Cannot add faculty with no name.</h5><br /><br />'; 
			} else {
					
							
					if (mysqli_query($dbConnected,$tCompany_SQLinsert))  {	
						echo '<h5 align="center" style="color:green; font-size:20px;">Successfully added new faculty.</h5><br /><br />';
					} else {
						echo '<h5 align = "center" style="color:red; font-size:20px;">Failed to add new faculty.</h5><br /><br />';
						
					}	
			}
		}

}

echo "<br /><br />";
}
?>
