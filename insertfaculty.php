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
*	This script defines an HTML form using php 
*	for user to enter faculty details - POST to savefaculty.php
*
*
*=====================================
*/
include("menu.php");
include_once("includes/connectdb.php");

if ($dbSuccess) {

	echo '<h1>Enter Faculty Details</h2>';

	echo "<br />";
	
	{	//		FORM postCompany 
		echo '<div class="grandcontainer" align="center">
			<div class="parenrcontainer">';
		echo '<form name="postCompany" action="savefaculty.php" method="post">';
		
				echo '
				<table>
					
					<tr>
						<td>Name</td>
						<td><input class="input" type="text" name="Name" required /></td>
					</tr>
					
						<td>Email Id</td>
						<td><input class="input" type="email" pattern="^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$" name="EmailID"  placeholder="xyz@abc.com" required /></td>
					</tr>
					<tr>
						<td>Phone Number</td>
						<td><input class="input" type="tel" pattern="^[6-9]\d{9}$" name="Phoneno" placeholder="xxxxxxxxxx" required /></td>
					</tr>
					<tr>
						<td>Designation</td>
						<td><input class="input" type="text" name="Designation" required/></td>
					</tr>
					<tr>
					   <td></td>
					   <td align="right"><input class="submitbtn" type="submit" value="Save"/> </td>
					</tr>
				</table>
				';
					
		echo '</form>';
		echo '</div></div>';
	}

}
?>
