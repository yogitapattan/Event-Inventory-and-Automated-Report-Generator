<?php
session_start();
if(!isset($_SESSION["logged_in"]))
	header('Location:loginForm.php');
?>

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
/*

*
*	This script inserts incharge into incharge table
*
*
*=====================================
*/

include("menu.php");
include_once("includes/connectdb.php");

if ($dbSuccess) {
		
		
			
				
				$tCompany_SQLselect = "SELECT  ";
				$tCompany_SQLselect .= "Name, EmailID ";	
				$tCompany_SQLselect .= "FROM ";
				$tCompany_SQLselect .= "faculty ";
				$tCompany_SQLselect .= "Order By Name ";
				
			
				$tCompany_SQLselect_Query = mysqli_query($dbConnected,$tCompany_SQLselect);	
				
				echo '<h1>Create new Event</h1>';
				echo '<br /><br />';
				echo '<div class="grandcontainer" align="center">
					<div class="parenrcontainer">';
				echo '<form action="saveincharge.php" method="post">';
				
				echo '<label> <span class="label">Name of the Event:</span> <input class="input" type="text" name="Eventname" required></label>';
				
				echo '<br /><br /> <br />';
				
				echo '<label> <span class="label">Faculty Incharge: <br /><br /></span><select name="faculty_selected[]"  multiple required>';
				
					echo '<option>..select faculty incharge..</option>';
			 	
				
						while ($row = mysqli_fetch_array($tCompany_SQLselect_Query, MYSQLI_ASSOC)) {
						    //$ID = $row['ID'];
						    $Name = $row['Name'];
						    $EmailID = $row['EmailID'];
						    						    
						    echo '<option value="'.$Name.','.$EmailID.'">'.$Name.'</option>';
						}
					
						mysqli_free_result($tCompany_SQLselect_Query);		
				
						echo '</select></label>';
				
						echo'<br /><br />';
						echo '<input class="submitbtn" type="submit" />';
						
				echo '</form>';
				//	END:  Select company from dropdowm
			
			
		
		

//		END:	if ($dbSuccess)
}

echo "<br /><br />";



?>
