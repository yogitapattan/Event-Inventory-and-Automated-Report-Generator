<?php
session_start();
if(!isset($_SESSION["logged_in"]))
	header('Location:loginForm.php');
?>

<?php
/*

*
*	This script collects data from facultyeditform.php
*	and updates the database record
*
*
*=====================================
*/

include_once("includes/connectdb.php");
include("menu.php");

if ($dbSuccess) {
		
		{  //   collect the data with $_POST
		
			$Name = $_POST['Name'];	
			
			$EmailID = $_POST["EmailID"];	
			$Phoneno = $_POST["Phoneno"];	
			$Designation = $_POST["Designation"];	
		}

			
		{  //   SQL:     UPDATE tCompany record
		
			$tCompany_SQLupdate = "UPDATE faculty SET ";			
			$tCompany_SQLupdate .=  "Name = '".$Name."', ";
			$tCompany_SQLupdate .=  "EmailID = '".$EmailID."', ";
			$tCompany_SQLupdate .=  "Phoneno = '".$Phoneno."', ";
			$tCompany_SQLupdate .=  "Designation = '".$Designation."' ";
			$tCompany_SQLupdate .=  "WHERE Name = '".$Name."' "; 		 
		}
		
		{	//		check the data and process it 
			
			 {

							
					if (mysqli_query($dbConnected,$tCompany_SQLupdate))  {	
						echo '<h5 align="center" style=" color:green; font-size:20px;">Successfully Updated Faculty</h5>';
					} else {
						echo '<h5 align="center" style=" color:red; font-size:20px;">Failed to Update Faculty</h5><br /><br />';
						
					}	
			}
		}

}


?>
