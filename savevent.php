<?php
session_start();
if(!isset($_SESSION["logged_in"]))
	header('Location:loginForm.php');
?>

<?php
/*
*
*	This script collects data from insertevent.php
*	and processes it
*
*
*=====================================
*/
include("menu.php");
 		//	Secure Connection Script$db = array(
include_once("includes/connectdb.php");

if ($dbSuccess) {
		
		{  //   collect the data with $_POST
		
			$EventID = $_POST["EventID"];		
			$Venue = $_POST["Venue"];
            $Enddate = $_POST["Enddate"];
            $Startdate = $_POST["Startdate"];	
			$Starttime = $_POST["Starttime"];	
			$Endtime = $_POST["Endtime"];
			$Category = $_POST["Category"];

			$Startdate = $Startdate . ' ' . $Starttime;
			$Enddate = $Enddate . ' ' . $Endtime;
				
		}
			
		{  //   SQL:     $tCompany_SQLinsert

			$tCompany_SQLinsert = "UPDATE event SET ";		
			$tCompany_SQLinsert .=  "Venue = '".$Venue."', ";
			$tCompany_SQLinsert .=  "Startdate = '".$Startdate."', ";
			$tCompany_SQLinsert .=  "Enddate = '".$Enddate."', ";
			$tCompany_SQLinsert .=  "Category = '".$Category."' ";
			$tCompany_SQLinsert .=  "WHERE ID = '".$EventID."' "; 
		
		}
		
		{	//		check the data and process it 
			
							
					if (mysqli_query($dbConnected,$tCompany_SQLinsert))  {	
						header("Location: insertspeaker.php?EventID=".$EventID."");
					} 	
			
		}

}


?>
