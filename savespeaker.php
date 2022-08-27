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
*	This script collects data from insertspeaker.php
*	and processes it
*
*
*=====================================
*/

include_once("includes/connectdb.php");
include("menu.php");
if ($dbSuccess) {
		
		{  //   collect the data with $_POST
		
			$EventID = $_POST["EventID"];//echo $EventID;	
			$Fname = $_POST["Fname"];
			$Lname = $_POST["Lname"];
			$Phonenumber = $_POST["Phonenumber"];	
			$EmailID = $_POST["EmailID"];
            $Designation = $_POST["Designation"];
            $Company = $_POST["Company"];	
            $Years = $_POST["Years"];				
				
		}
			
		{  //   SQL:     $tCompany_SQLinsert
            				
		
			$tCompany_SQLinsert = "INSERT INTO speaker (";			
			//$tCompany_SQLinsert .=  "ID, ";
			$tCompany_SQLinsert .=  "Fname, ";
			$tCompany_SQLinsert .=  "Lname, ";
			$tCompany_SQLinsert .=  "Phonenumber, ";
			$tCompany_SQLinsert .=  "Email, ";
			$tCompany_SQLinsert .=  "Designation ";
			if (!empty($Company)) $tCompany_SQLinsert .=  ",Company ";
			if (!empty($Years)) $tCompany_SQLinsert .=  ",Yearofexp ";
			$tCompany_SQLinsert .=  ") ";
			
			$tCompany_SQLinsert .=  "VALUES (";
			//$tCompany_SQLinsert .=  "'".$EventID."', ";
			$tCompany_SQLinsert .=  "'".$Fname."', ";
			$tCompany_SQLinsert .=  "'".$Lname."', ";
			$tCompany_SQLinsert .=  "'".$Phonenumber."', ";
			$tCompany_SQLinsert .=  "'".$EmailID."', ";
			$tCompany_SQLinsert .=  "'".$Designation."' ";
			if (!empty($Company)) $tCompany_SQLinsert .=  ",'".$Company."' ";
			if (!empty($Years)) $tCompany_SQLinsert .=  ",'".$Years."' ";
			$tCompany_SQLinsert .=  ") ";
		}
		
		//		check the data and process it 
        {				
				mysqli_query($dbConnected,$tCompany_SQLinsert) ;	
						//echo 'used to Successfully add new event.<br /><br />';
			
		}
			$tCompany_SQLinsert = "INSERT INTO speaker1 (";			
			$tCompany_SQLinsert .=  "ID, ";
			$tCompany_SQLinsert .=  "Fname, ";
			$tCompany_SQLinsert .=  "Lname ";
			$tCompany_SQLinsert .=  ") ";
			
			$tCompany_SQLinsert .=  "VALUES (";
			$tCompany_SQLinsert .=  "'".$EventID."', ";
			$tCompany_SQLinsert .=  "'".$Fname."', ";
			$tCompany_SQLinsert .=  "'".$Lname."' ";
			$tCompany_SQLinsert .=  ") ";
			
			if (mysqli_query($dbConnected,$tCompany_SQLinsert))  {	
			
						echo '<br><a class="back" href="insertspeaker.php?EventID='.$EventID.'">Enter Another Speaker</a><br><br>';
                        echo '<a class="back" href="insertbudget.php?EventID='.$EventID.'">Enter Budget Details</a>';
					} 

}


?>
