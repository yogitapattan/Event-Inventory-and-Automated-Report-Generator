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
this script inserts speaker details
*=====================================
*/

include_once("includes/connectdb.php");
include("menu.php");

if ($dbSuccess) {
	
	$EventID = $_GET['EventID'];
	//echo $EventID;
	
	echo '<h1>
				Enter Speaker Details
			</h1>';

	echo "<br />";
		
	{	//		FORM postCompany 
        echo '<div align="center" class="grandcontainer" >';
        echo '<div class="parentcontainer" >';
		echo '<form name="postCompany" action="savespeaker.php" method="post">';
		
				echo '
				<input type="hidden" name="EventID" value="'.$EventID.'" />
				<table>
					
					<tr>
						<td>First Name</td>
						<td><input class="input" type="text" name="Fname" required /></td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td><input class="input" type="text" name="Lname" required /></td>
					</tr>
					<tr>
						<td>Phone Number</td>
						<td><input class="input" type="tel" pattern="^[6-9]\d{9}$" name="Phonenumber" placeholder="xxxxxxxxxx" /></td>
					</tr>
					<tr>
						<td>Email ID</td>
						<td><input class="input" type="email" pattern="^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$" name="EmailID"  placeholder="xyz@abc.com" /></td>
					</tr>
					<tr>
						<td>Designation</td>
						<td><input class="input" type="text" name="Designation" /></td>
					</tr>
					<tr>
						<td>Company</td>
						<td><input class="input" type="text" name="Company"  /></td>
					</tr>
					<tr>
						<td>Years of Experience</td>
						<td><input class="input" type="number" name="Years"  /></td>
					</tr>
					<tr>
					   <td></td>
					   <td align="right"><input align="center" class="submitbtn" type="submit" value="Save"/> </td>
					</tr>
				</table>
				';
					
		echo '</form>';
        echo '</div> </div>';
	}

}

?>
