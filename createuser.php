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
*	This script provides ADMIN with a form to 
*	create a new user login
*	checks data integrity and SAVES if OK
*
*
*=====================================
*/

include("menu.php");
include_once("includes/connectdb.php");

//$loginAuthorised = ($_COOKIE["loginAuthorised"] == "loginAuthorised");

if ($dbSuccess ){//AND $loginAuthorised) {
	//	external style sheet 
		
	$thisScriptName = 'createuser.php';

	echo '<h1>Create New User</h1>';
		
	
	/*if (isset($_POST["saveClicked"]) AND ($_POST["saveClicked"] == 'saveClicked')) {
		$saveClicked = $_POST["saveClicked"];
		//		Save the user 		
				include_once('saveuser.php');
		 
	} else */{
		echo "<br />";

		//		create the accessLevel DROPDOWN  FIELD 
				{	
				$access_SQL =  "SELECT Accesslevel, Usertype FROM accesscontrol ";
				$access_SQL .= "ORDER By Accesslevel ";
				
				$access_SQL_Query = mysqli_query($dbConnected,$access_SQL);	
	
				$fld_access = '<select name="accessLevel" required>';		 
				$fld_access .= '<option value=""> -- access level -- </option>';	
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
								
		//		FORM postUser
			{echo '<div class="grandcontainer" align="center">
			<div class="parenrcontainer">';	
			echo '<form name="postUser" action="saveuser.php" method="post">';
					echo '<input type="hidden" name="saveClicked" value="saveClicked"/>';
					echo '
					<table>
						<tr>
							<td>Username</td>
							<td><input class="input" type="text" name="username" required /></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><input class="input" type="text" name="password" required /></td>
						</tr>
						<tr>
							<td>Retype password</td>
							<td><input class="input" type="text" name="passwordValidate" required /></td>
						</tr>
						<tr>
							<td>Access level</td>
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
			//	END: FORM postUser 
			}
	}	
	

} else {
	
	echo '<h2>You are not authorised to use this page.</h2>';
	echo "<br /><hr /><br />";
//		END:       if ($dbSuccess AND $loginAuthorised)
}

?>
