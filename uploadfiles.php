<?php
session_start();
if(!isset($_SESSION["logged_in"]))
	header('Location:loginForm.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="css/upload.css">
	</head>
<body>
</body>
</html>
<?php

//This script uploads files 


include_once("includes/connectdb.php");
include("menu.php");
echo '<h1>Upload Files</h1><br><br>';
if(!isset($_POST['EventID'])) { $EventID = $_GET['EventID'];}

if (isset($_POST['uploadActivated']) AND $_POST['uploadActivated'] == 1) {
	
	$uploadActivated = $_POST['uploadActivated'];
	$EventID = $_POST['EventID'];
	
	$tCompany_SQLselect = "SELECT  ";
	$tCompany_SQLselect .= "Name ";	
	$tCompany_SQLselect .= "FROM ";
	$tCompany_SQLselect .= "event ";
	$tCompany_SQLselect .= "WHERE ID='".$EventID."'";	

	$tCompany_SQLselect_Query = mysqli_query($dbConnected,$tCompany_SQLselect);	
	while ($row = mysqli_fetch_array($tCompany_SQLselect_Query, MYSQLI_ASSOC)) {
			    $eventName = $row['Name'];
	}
	$fileName = preg_replace('/\s+/', '_', $eventName);
	//echo $fileName;
	if (!file_exists('Files/'.$fileName.'')) {
		mkdir('Files/'.$fileName.'', 0777, true);
		$uploaddir = 'Files/'.$fileName.'/';
		
			$tCompany_SQLinsert = "INSERT INTO files (";			
			$tCompany_SQLinsert .=  "ID, ";
			$tCompany_SQLinsert .=  "Path ";
			$tCompany_SQLinsert .=  ") ";
			
			$tCompany_SQLinsert .=  "VALUES (";
			$tCompany_SQLinsert .=  "'".$EventID."', ";
			$tCompany_SQLinsert .=  "'".$uploaddir."' ";
			$tCompany_SQLinsert .=  ") ";
			
			if (mysqli_query($dbConnected,$tCompany_SQLinsert))  {	
						echo '<Successfully uploaded files.<br /><br />';
					} else {
						echo '<h5 align="center">Failed to upload files.</h5><br /><br />';
						
					}
	}
		

	$uploaddir = 'Files/'.$fileName.'/';
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

	$maxFileSize = 300000;
	$fileSizeOK = TRUE;	 

	$filesize = $_FILES['userfile']['size'];
	if ($filesize > $maxFileSize)	{ 
		echo '<h5 align="center">ERROR: File too large.</h5>';
		$fileSizeOK = FALSE;		
	}
	
	$fileTypeOK = FALSE;	
		
	$whiteList = array(".jpg", ".png", ".gif", ".pdf", ".doc", ".rar", ".zip",".txt");
	foreach ($whiteList as $file)
	{
		if(preg_match("/$file\$/i", $_FILES['userfile']['name']))
		{ $fileTypeOK = TRUE;	} 
	}
	
	if (!$fileTypeOK) { echo '<h5 align="center">ERROR: Invalid file type.<br /><br /></h5>'; }
	
	if ($fileTypeOK AND $fileSizeOK) {
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
			 chmod($uploadfile, 0666);			//		used for commercial grade systems 		
		    //echo 'Valid File of size '.$filesize.' successfully uploaded.<br />';
	
			//echo 'The image uploaded was "'.$uploadfile.'"<br /><br /><br />';
			$imgList = array(".jpg", ".png", ".gif");
			foreach ($imgList as $file)
			{
				if(preg_match("/$file\$/i", $_FILES['userfile']['name']))
				{ echo '<img src="'.$uploadfile.'" alt="Test Image uploaded" class="center" />';	} 
			}
			
			
	
		} else {
	
		    echo "File upload error!<br />";
		}
	}					

}

unset($uploadActivated);	
	
	
echo '

<!-- The data encoding type, enctype, MUST be specified as below -->
<div align="center" class="grandcontainer">
<div class="parentcontainer">
<form enctype="multipart/form-data" action="uploadfiles.php" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="uploadActivated" value=1 />
	<input type="hidden" name="EventID" value='.$EventID.' />
    <!-- Name of input element determines name in $_FILES array -->
    <input  name="userfile" type="file"/>
    <br> <br>
    <input class="submitbtn" type="submit" value="Upload File" />
</form></div></div>';
	

?>
