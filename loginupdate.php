<?php
session_start();
if(!isset($_SESSION["logged_in"]))
	header('Location:loginForm.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="css/edit.css">
	</head>
<body>
</body>
</html>


<?php
/*

*	This script defines an HTML form to load login details
*
*
*=====================================
*/
include("menu.php");
include_once("includes/connectdb.php");

if ($dbSuccess) {
	
	if(isset($_POST['saveClicked']))
	{
			$Username = $_POST["Username"];
			$newusername = $_POST["username"];	
			$password = $_POST["password"];	
			$passwordValidate = $_POST["confirmpassword"];	
			$accessLevel = $_POST['accessLevel'];
			
		{	//		check the data before processing it
			$errorMsg = "";		 
			if (strlen($password) < 3) { $errorMsg .= "Password cannot be less than 5 characters<br />"; }
			if ($password <> $passwordValidate) { $errorMsg .= "Password retypedoes not match.<br />"; }
			else {$password = md5($password);}
		}
		
		if (empty($errorMsg)) {		
		
			$tCompany_SQLupdate = "UPDATE login SET ";		
			$tCompany_SQLupdate .=  "Username= '".$newusername."', ";
			$tCompany_SQLupdate .=  "Password= '".$password."', ";
			$tCompany_SQLupdate .=  "Accesslevel = '".$accessLevel."' ";
			$tCompany_SQLupdate .=  "WHERE Username = '".$Username."' "; 		 
		
		
		
		
							
					if (mysqli_query($dbConnected,$tCompany_SQLupdate))  {	
						echo '<h5 align="center" style=" color:green; font-size:20px;">Successfully updated login details.</h5><br />';
					} else {
						echo '<h5 align="center" style=" color:red; font-size:20px;">Failed to update login details.</h5><br />';
						
					}	
			
		}
		else
			echo $errorMsg;
	}
	else{

	{	//  Get the details of the company selected 
			$Username = $_POST["Username"];	
						
			/*if ($Username == 0) {
				header("Location: editlogin.php");	
			}*/
			

			$tCompany_SQLselect = "SELECT * ";
			$tCompany_SQLselect .= "FROM ";
			$tCompany_SQLselect .= "login ";
			$tCompany_SQLselect .= "WHERE Username = '".$Username."' ";
			
			$tCompany_SQLselect_Query = mysqli_query($dbConnected,$tCompany_SQLselect);	
			
			while ($row = mysqli_fetch_array($tCompany_SQLselect_Query, MYSQLI_ASSOC)) {
				$current_Username = $row['Username'];
							 
			}
			
			//mysql_free_result($tCompany_SQLselect_Query);			
	}

	echo '<h1>Edit login Form</h1>';
			
			{	
				$access_SQL =  "SELECT Accesslevel, Usertype FROM accesscontrol ";
				$access_SQL .= "ORDER By Accesslevel ";
				
				$access_SQL_Query = mysqli_query($dbConnected,$access_SQL);	
	
				$fld_access = '<select name="accessLevel">';		 
				$fld_access .= '<option value="25"> -- access level -- </option>';	
					while ($row = mysqli_fetch_array($access_SQL_Query, MYSQLI_ASSOC)) {
					    //$ID = $row['ID'];
					    $accessLevel = $row['Accesslevel'];
					    $userType = $row['Usertype'];
					    
					    $fld_access .= '<option value="'.$accessLevel.'">'.$userType.'</option>';
					}			
					mysqli_free_result($access_SQL_Query);			
				$fld_access .= '</select>';				
			//	END: create the accessLevel DROPDOWN  FIELD 
			}	
	
	{	//		FORM postCompany
		echo '<div class="grandcontainer" align="center">
			<div class="parenrcontainer">';
		echo '<form name="postCompany" action="loginupdate.php" method="post">';
		
				echo '<input type="hidden" name="Username" value="'.$Username.'"/>';
				echo '<input type="hidden" name="saveClicked" value="1"/>';
				echo '
				<table>
					<tr>
						<td>Username</td>
						<td><input class="input" type="text" name="username" value="'.$current_Username.'" required /></td>
					</tr>
					<tr>
						<td>Enter new password</td>
						<td><input class="input" type="text" name="password" required /></td>
					</tr>
					<tr>
						<td>Confirm new password</td>
						<td><input class="input" type="text" name="confirmpassword" required /></td>
					</tr>
					<tr>
						<td>Select Accesslevel</td>
						<td>'.$fld_access.'</td>
					</tr>
					<tr>
						<td></td>
						<td align="right"><input class="submitbtn" type="submit"  value="Save" /></td>
					</tr>
				</table>
				';
					
		echo '</form>';
		echo '</div></div>';
	}
	}
	
	echo "<br /><br />";



}

?>
