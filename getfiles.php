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
*	This script Lists a record in Files
*		with associated event
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
		 
			$tPerson_SQLselect = "SELECT * ";
			$tPerson_SQLselect .= "FROM ";
			$tPerson_SQLselect .= "files ";
			$tPerson_SQLselect .= "WHERE ID = '".$EventID."' ";
			
			$tPerson_SQLselect_Query = mysqli_query($dbConnected,$tPerson_SQLselect);	
			$Path="";
			while ($row = mysqli_fetch_array($tPerson_SQLselect_Query, MYSQLI_ASSOC)) {
				
				$Path = $row['Path'];
							 
			}
				
			mysqli_free_result($tPerson_SQLselect_Query);			
	}
	
	{	//		Output 
	
			echo '<div style=" font-family: arial, helvetica, sans-serif; ">';

					echo '<h1>Event Files</h1>';
					echo '<div align="center" style="margin-left: 100; ">';
					if(!empty($Path))
						echo '<a href='.$Path.'>'.$Path.'</a>';
					else
						echo '<p>No files uploaded</p>';
			
					echo '</div>';		//		END:  <div style="margin-left: 100; ">
			echo '</div>';				//		END:	<div style=" font-family...">


	
	}
	
}

;

?>
