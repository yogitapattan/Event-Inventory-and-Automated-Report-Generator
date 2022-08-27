<?php
session_start();
if(isset($_SESSION["logged_in"]))
	unset($_SESSION["logged_in"]);
?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="css/login.css">
	</head>
<body>
</body>
</html>

<?php
	
/*

*
*	This script is the login FORM for event
*
*
*============================================================
*/

include_once("includes/connectdb.php");

$thisScriptName = "loginForm.php";

   /*$flag;
	if($flag=='1')
	{
		$username = $_POST['username'];
	}  */
	//var_dump($_POST);
	//echo $_POST['username'];
	
	if(isset($_POST['username'])) {
		$username = $_POST['username'];
		$password = $_POST['Password'];
		$md5Password = md5($password);
		
		{	//		SELECT password for this user from the DB and see it it matches 
			$tUser_SQLselect = "SELECT Password,Accesslevel FROM login ";
			$tUser_SQLselect .= "WHERE Username = '".$username."' ";	

			$tUser_SQLselect_Query = mysqli_query($dbConnected,$tUser_SQLselect); 	
			while ($row = mysqli_fetch_array($tUser_SQLselect_Query, MYSQLI_ASSOC)) {
			    
				$passwordRetrieved = $row['Password'];
				$accessLevel = $row['Accesslevel'];
			}
			mysqli_free_result($tUser_SQLselect_Query);
			
			
			if (!empty($passwordRetrieved) AND ($md5Password == $passwordRetrieved)) 
			{	
				$_SESSION["logged_in"]='1';
					
					setcookie('loginAuthorised','loginAuthorised',time()+7200,'/');
					setcookie('accessLevel',$accessLevel,time()+7200,'/');
										
					header('Location:index.php');
			}
					else {
				//echo "Access denied.<br /><br />";		
				//echo '<a href="'.$thisScriptName.'">Try again</a>';	
				
				echo' <div align="center" class="grandcontainer">
				
		<div class="parentcontainer">
		<h5>Invalid username or password</h5>';
		echo '<form name="postLoginHid" action="'.$thisScriptName.'" method="post">';	
				echo '
					
					<h1>Login</h1>
					<P>Username<br/>
					<INPUT class="input" TYPE=text NAME=username value="" ></P>
					<P>Password<br/>
					<INPUT class="input" TYPE=password NAME=Password value="" ></P>
					<input class="submitbtn" type="submit"  value="Login" />
				';
		echo '</form>';
		echo' </div></div>';	
                  				
			}
		}
		
	} else {
		echo' <div align="center" class="grandcontainer">
		<div class="parentcontainer">';
		
		echo '<form name="postLoginHid" action="'.$thisScriptName.'" method="post">';	
				echo '
					<h1>Login</h1>
					<P>Username<br/>
					<INPUT class="input" TYPE=text NAME=username value="" ></P>
					<P>Password<br/>
					<INPUT class="input" TYPE=password NAME=Password value="" ></P>
					<input class="submitbtn" type="submit"  value="Login" />
				';
		echo '</form>';
		echo' </div></div>';
		
	}
	


?>
