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
*	This script displays events for HOD
*
*=============================================================
*/

include("menu.php");
include_once("includes/connectdb.php");

if ($dbSuccess) {
	
	$thisScriptName = 'companyListOrder.php';
	
	//		Get the sortorder with GET but default to Name
	
	if (!isset($_POST["Filter"])) {$orderClause = "Name"; }
	else $orderClause = $_POST["Filter"];	
	
	{	//		SELECT all companies in Name order and execute 
		$tCompany_SQLselect = "SELECT * ";
		$tCompany_SQLselect .= "FROM ";
		$tCompany_SQLselect .= "event ";	
		$tCompany_SQLselect .= "ORDER BY ";
		$tCompany_SQLselect .= "event.".$orderClause;

		$tCompany_SQLselect_Query = mysqli_query($dbConnected,$tCompany_SQLselect); 	

	}
	
	{	//		Output 
	
	echo '<div align="center" class="grandcontainer">';
    echo '<div class="parentcontainer">';
	echo '<form action="displayforHOD.php" method="post">';
	
	echo '<select name="Filter">';
	
		echo '<option  selected="selected" required>..select relevance..</option>';
 	
			    echo '<option value="ID">Order by Event ID</option>';
				echo '<option value="Name">Order by Event Name</option>';
				echo '<option value="Venue">Order by Event Venue</option>';		
	
			echo '</select>';
	
            echo '<br><br>';
			echo '<input class="submitbtn" type="submit" />';
			
	echo '</form>';
    echo '</div> </div> ';
	
	
	
	
	
	{	//		create a div for the whole rendering 
	echo '<div>';
	
		echo '<h2>Event List</h2>';
					
		echo '<table align="center" id="mytable">';	
			echo '<tr>';		
				echo '<td class="td"><b>Event ID</b</td>';
				echo '<td class="td"><b>Name</b></td>';
				echo '<td class="td"><b>Venue</b></td>';
				echo '<td class="td"><b>Start date</b></td>';
				echo '<td class="td"><b>End date</b></td>';
				echo '<td class="td">&nbsp &nbsp</td>';

			echo '</tr>';
	
			$indx = 0;		//		count the rows to give alternating style 
			while ($row = mysqli_fetch_array($tCompany_SQLselect_Query, MYSQLI_ASSOC)) {
				
				$ID = $row['ID'];
				$Name = $row['Name'];
				$Venue = $row['Venue'];		
				$Startdate = $row['Startdate'];
				$Enddate = $row['Enddate'];
				$viewlink = '<a href="displayevent.php?EventID='.$ID.'">View</a>';
				if($Venue!='undefined')
				{
				echo '<tr>';
				
					echo '<td class="td">'.$ID.'&nbsp;</td>'; 
					echo '<td class="td">'.$Name.'&nbsp;</td>'; 
					echo '<td class="td">'.$Venue.'&nbsp;</td>';
					echo '<td class="td">'.$Startdate.'&nbsp;</td>';
					echo '<td class="td">'.$Enddate.'&nbsp;</td>';
					echo '<td class="td">'.$viewlink.'&nbsp; </td>';
					
			
				echo '</tr>';
		  
		  		$indx++;
				}
		   //	END: while
			}

		echo '</table>';	

	echo '</div>';
	//		END: create a div for the whole rendering 
	}
	
	}	//		END: //		Output 
	
	mysqli_free_result($tCompany_SQLselect_Query);	
	
}


?>
