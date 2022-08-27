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

*	This script defines an HTML form using php 
*	for user to enter budget details - POST to savebudget.php
*
*
*=====================================
*/


include_once("includes/connectdb.php");
include("menu.php");

if ($dbSuccess) {

	$EventID = $_GET['EventID'];
	
	echo '<h1 >
				Enter Budget Details
			</h1>';

	echo "<br />";
	
	{	//		FORM postCompany 
        echo '<div align = "center" class="grandcontainer" >';
        echo '<div class="parentcontainer" >';
		echo '<form name="postCompany" action="savebudget.php" method="post">';
		
				echo '
				<input type="hidden" name="EventID" value="'.$EventID.'" />
				<table>
					
					<tr>
						<td>Venue</td>
						<td><input class="input" type="number" name="Venue" /></td>
					</tr>
					<tr>
						<td>Food</td>
						<td><input class="input" type="number" name="Food" /></td>
					</tr>
					<tr>
						<td>Takeaway</td>
						<td><input class="input" type="number" name="Takeaway" /></td>
					</tr>
					<tr>
						<td>Registeration kit</td>
						<td><input class="input" type="number" name="Regkit" /></td>
					</tr>
					<tr>
						<td>Coffee/Tea</td>
						<td><input class="input"type="number" name="CoffeeTea" /></td>
					</tr>
					<tr>
						<td>TADA</td>
						<td><input class="input" type="number" name="TADA" /></td>
					</tr>
					<tr>
						<td>Speaker</td>
						<td><input class="input" type="number" name="Speaker" /></td>
					</tr>
					<tr>
						<td>Registeration amount Collected</td>
						<td><input class="input"type="number" name="Regamount" /></td>
					</tr>
					<tr>
						<td>Printing</td>
						<td><input class="input"type="number" name="Printing" /></td>
					</tr>
					<tr>
						<td>Miscellaneous</td>
						<td><input class="input" type="number" name="Miscellaneous" /></td>
					</tr>
					<tr>
					   <td></td>
					   <td align="right"><input class = "submitbtn" type="submit" value="Save"/> </td>
					</tr>
				</table>
				';
					
		echo '</form>';
        echo '</div> </div>';
	}

}

?>