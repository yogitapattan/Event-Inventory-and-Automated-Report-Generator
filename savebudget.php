<?php
session_start();
if(!isset($_SESSION["logged_in"]))
	header('Location:loginForm.php');
?>


<?php
/*
*	This script collects data from insertbudget.php
*	and processes it
*
*
*=====================================
*/
include("menu.php");
include_once("includes/connectdb.php");

if ($dbSuccess) {
		
		{  //   collect the data with $_POST
			$EventID = $_POST["EventID"];
			$Takeaway = $_POST["Takeaway"];	
			$Speaker = $_POST["Speaker"];	
			$Venue = $_POST["Venue"];	
			$Food = $_POST["Food"];	
			$Regkit = $_POST["Regkit"];	
			$CoffeeTea = $_POST["CoffeeTea"];	
			$TADA = $_POST["TADA"];	
			$Regamount = $_POST["Regamount"];
			$Printing = $_POST["Printing"];	
			$Miscellaneous = $_POST["Miscellaneous"];	
				
		}
			
		{  //   SQL:     $tCompany_SQLinsert	
			
		
			$tCompany_SQLinsert = "INSERT INTO budget (";			
			$tCompany_SQLinsert .=  "ID ";
			if (!empty($Venue)) $tCompany_SQLinsert .=  ",Venue";
			if (!empty($Food)) $tCompany_SQLinsert .=  ",Food";
			if (!empty($Takeaway)) $tCompany_SQLinsert .=  ",Takeaway";		
			if (!empty($Regkit)) $tCompany_SQLinsert .=  ",Regkit";
			if (!empty($CoffeeTea)) $tCompany_SQLinsert .=  ",CoffeeTea";
			if (!empty($TADA)) $tCompany_SQLinsert .=  ",TADA";
			if (!empty($Speaker)) $tCompany_SQLinsert .=  ",Speaker";		
			if (!empty($Regamount)) $tCompany_SQLinsert .=  ",Regamount";
			if (!empty($Printing)) $tCompany_SQLinsert .=  ",Printing ";
			if (!empty($Miscellaneous)) $tCompany_SQLinsert .=  ",Miscellaneous ";
			$tCompany_SQLinsert .=  ") ";
			
			$tCompany_SQLinsert .=  "VALUES (";
			$tCompany_SQLinsert .=  "'".$EventID."'";
			if (!empty($Venue)) $tCompany_SQLinsert .=  ",'".$Venue."' ";
			if (!empty($Food)) $tCompany_SQLinsert .=  ",'".$Food."'";
			if (!empty($Takeaway)) $tCompany_SQLinsert .=  ",'".$Takeaway."'";
			if (!empty($Regkit)) $tCompany_SQLinsert .=  ",'".$Regkit."'";
			if (!empty($CoffeeTea)) $tCompany_SQLinsert .=  ",'".$CoffeeTea."'";
			if (!empty($TADA)) $tCompany_SQLinsert .=  ",'".$TADA."'";
			if (!empty($Speaker)) $tCompany_SQLinsert .=  ",'".$Speaker."'";
			if (!empty($Regamount)) $tCompany_SQLinsert .=  ",'".$Regamount."'";
			if (!empty($Printing)) $tCompany_SQLinsert .=  ",'".$Printing."' ";
			if (!empty($Miscellaneous)) $tCompany_SQLinsert .=  ",'".$Miscellaneous."' ";
			$tCompany_SQLinsert .=  ") ";
		}
		
		{	//		check the data and process it 
			
			//if (empty($Eventname)) {
				//echo '<span style="color:red; ">Cannot add budget with no name.</span><br /><br />'; 
	//		} else {
					echo '<span style = "text-decoration: underline;">
							SQL statement:</span>
							<br />'.$tCompany_SQLinsert.'<br /><br />';
							
					if (mysqli_query($dbConnected,$tCompany_SQLinsert))  {	
						header("Location: uploadparticipants.php?EventID=".$EventID."");
						
					}	
			//}
		}

}


?>
