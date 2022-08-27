<?php
session_start();
if(!isset($_SESSION["logged_in"]))
	header('Location:loginForm.php');
	

	
	
	if(isset($_GET['status'])){
		$status = $_GET['status'];
		if($status == 'logout'){
		setcookie('loginAuthorised','',time()-7200);
		$loginAuthorised = false;
		}
	}
	else{
		$loginAuthorised = ($_COOKIE['loginAuthorised'] == 'loginAuthorised');
	}
	
	if($loginAuthorised){
		$contentFile = 'home.php';
	}else{
		header('Location:loginForm.php');
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>


</head>
<body>

<?php
	
	include_once($contentFile);

?>



</body>
</html>
