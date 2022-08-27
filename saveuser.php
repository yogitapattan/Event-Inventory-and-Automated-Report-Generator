<?php
session_start();
if(!isset($_SESSION["logged_in"]))
	header('Location:loginForm.php');
?>

<?php
/*

*
*	This script checks data from createuser.php form 
*		& saves if its OK
*
*=====================================
*/
include("menu.php");
include_once("includes/connectdb.php");
		{  //   collect the data with $_POST
			$username = $_POST["username"];	
			$password = $_POST["password"];	
			$passwordValidate = $_POST["passwordValidate"];	
			$accessLevel = $_POST['accessLevel'];
			
		}
			
		{	//		check the data before processing it
			$errorMsg = "";		 
			if (strlen($username) < 3) { $errorMsg = "Username cannot be less than 5 characters<br />"; }
			if (strlen($password) < 3) { $errorMsg .= "Password cannot be less than 5 characters<br />"; }
			if ($password <> $passwordValidate) { $errorMsg .= "Password retypedoes not match.<br />"; }
			else {$password = md5($password);}
		}
		
		
		if (empty($errorMsg)) {		
		
			{  //   SQL:     $tUser_SQLinsert				
				$tUser_SQLinsert = "INSERT INTO login (";			
				$tUser_SQLinsert .=  "username, ";
				$tUser_SQLinsert .=  "password, ";		
				$tUser_SQLinsert .=  "accessLevel ";
				$tUser_SQLinsert .=  ") ";
				
				$tUser_SQLinsert .=  "VALUES (";
				$tUser_SQLinsert .=  "'".$username."', ";
				$tUser_SQLinsert .=  "'".$password."', ";
				$tUser_SQLinsert .=  "'".$accessLevel."' ";
				$tUser_SQLinsert .=  ") ";
			}
			
			{	//		run the SQL 
						if (mysqli_query($dbConnected,$tUser_SQLinsert))  {	
							echo '<h5 align="center" style=" color:green; font-size:20px;">New user successfully added.</h5><br /><br />';
						} else {
							echo '<h5 align = "center" style="color:red; font-size:20px;">Failed to add new user.</h5><br /><br />';
							//echo mysqli_error();	
							echo '<br /><br />';
						}						
			}
		
		} else {
			{	//		error handling
			echo "There are errors in the data:<br /><br />";
			echo 	$errorMsg."<br /><br />";
			echo '<a href="createuser.php">
						<span class="mainMenuItem">Click to Try Again</span>
						</a>';
			echo '<br /><br />';		
			}	
		}

?>
