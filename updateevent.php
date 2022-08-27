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
*	This script collects data from eventeditform.php
*	and updates the database record
*
*
*=====================================
*/

include_once("includes/connectdb.php");
include("menu.php");

if ($dbSuccess) {
		if(isset($_POST['EventID']))
		{
		{  //   collect the data with $_POST
		
			$EventID = $_POST["EventID"];	
			
			$Name = $_POST["Name"];	
			$Venue = $_POST["Venue"];	
			$Startdate = $_POST["Startdate"];	
			$Enddate = $_POST["Enddate"];
			$Category = $_POST["Category"];
		}

			
		{  //   SQL:     UPDATE tCompany record
		
			$tCompany_SQLupdate = "UPDATE event SET ";			
			$tCompany_SQLupdate .=  "Name = '".$Name."', ";
			$tCompany_SQLupdate .=  "Venue = '".$Venue."', ";
			$tCompany_SQLupdate .=  "Startdate = '".$Startdate."', ";
			$tCompany_SQLupdate .=  "Enddate = '".$Enddate."', ";			
			$tCompany_SQLupdate .=  "Category = '".$Category."' ";
			$tCompany_SQLupdate .=  "WHERE ID = '".$EventID."' "; 		 
		}
		
		{	//		check the data and process it 
			
			  {
					
							
					if (mysqli_query($dbConnected,$tCompany_SQLupdate))  {	
						echo '<h5 align="center" style=" color:green; font-size:20px;">Successfully Updated Event</h5>';
					} else {
						echo '<h5 align="center" style="color:red; font-size:20px;">Failed to update the event.</h5><br /><br />';
						
					}	
			}
		}
		
		
		{  //   collect the data with $_POST
		
			$Food = $_POST["Food"];	
			
			$Venue1 = $_POST["Venue1"];	
			$Takeaway = $_POST["Takeaway"];	
			$Regkit = $_POST["Regkit"];	
			$CoffeeTea = $_POST["CoffeeTea"];	
		    $TADA = $_POST["TADA"];	
			$Speaker = $_POST["Speaker"];	
			$Regamount = $_POST["Regamount"];	
			$Printing = $_POST["Printing"];	
			$Miscellaneous = $_POST["Miscellaneous"];	
		}

			
		{  //   SQL:     UPDATE tCompany record
		
			$tCompany_SQLupdate = "UPDATE budget SET ";	
            if(empty($Food)) $tCompany_SQLupdate .=  "Food = NULL";	
			else $tCompany_SQLupdate .=  "Food = '".$Food."' ";
			if(empty($Venue1)) $tCompany_SQLupdate .=  ",Venue = NULL";
			else $tCompany_SQLupdate .=  ",Venue = '".$Venue1."' ";
			if(empty($Takeaway)) $tCompany_SQLupdate .=  ",Takeaway = NULL";
			else $tCompany_SQLupdate .=  ", Takeaway = '".$Takeaway."' ";
			if(empty($Regkit)) $tCompany_SQLupdate .=  ",Regkit = NULL";
			else $tCompany_SQLupdate .=  ", Regkit = '".$Regkit."' ";
			if(empty($CoffeeTea)) $tCompany_SQLupdate .=  ",CoffeeTea = NULL";
			else $tCompany_SQLupdate .=  ", CoffeeTea = '".$CoffeeTea."' ";
			if(empty($TADA)) $tCompany_SQLupdate .=  ",TADA = NULL";
			else $tCompany_SQLupdate .=  ", TADA = '".$TADA."' ";
			if(empty($Speaker)) $tCompany_SQLupdate .=  ",Speaker = NULL";
			else $tCompany_SQLupdate .=  ", Speaker = '".$Speaker."' ";
			if(empty($Regamount)) $tCompany_SQLupdate .=  ",Regamount = NULL";
			else $tCompany_SQLupdate .=  ", Regamount = '".$Regamount."' ";
			if(empty($Printing)) $tCompany_SQLupdate .=  ",Printing = NULL";
			else $tCompany_SQLupdate .=  ", Printing = '".$Printing."' ";	
			if(empty($Miscellaneous)) $tCompany_SQLupdate .=  ",Miscellaneous = NULL";
			else $tCompany_SQLupdate .=  ", Miscellaneous = '".$Miscellaneous."' ";
			$tCompany_SQLupdate .=  " WHERE ID = '".$EventID."' "; 		 
		}
		
		{	//		check the data and process it 
			
			  {
					
							
					if (mysqli_query($dbConnected,$tCompany_SQLupdate))  {	
						echo '<h5 align="center" style=" color:green; font-size:20px;">Successfully Updated Budget</h5>';
					} else {
						echo '<h5 align="center" style=" color:red; font-size:20px;">Failed to Update Budget</h5><br /><br />';
						
					}	
			}
		}
		}
		else
			$EventID = $_GET['EventID'];
}

echo "<br /><br />";

echo '<a class="back" href="editspeaker.php?EventID='.$EventID.'">Edit Speaker Details</a><br />';
echo '<a class="back" href="editparticipant.php?EventID='.$EventID.'">Edit Participant Details</a>';

?>
