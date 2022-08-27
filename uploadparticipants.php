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
/*

*
*	This script uploads participants details.
*
*
*=====================================
*/

include("menu.php");
include_once("includes/connectdb.php");

if ($dbSuccess) {
	
	
	

	if(isset($_POST['uploadActivated']) AND $_POST['uploadActivated'] == 1)
	{
		
			$EventID = $_POST['EventID'];
	//		Table Definition 
	        $file = $_FILES['userfile']['name'];
		$tableName = "participants";	
		$tableName1 = "participants1";
		$CSVfilename = $file;
		
		$fileTypeOK = FALSE;	
		
		$whiteList = (".txt");
		if(preg_match("/$whiteList\$/i", $_FILES['userfile']['name']))
		{ $fileTypeOK = TRUE;	} 
		
		if($fileTypeOK)
		{
		$tableField = array(
					//'ID',
					'USN',
					'Name',
					'Department',			
					'Semester',			
					'EmailID',			
					'Phoneno',			
					'Caste'								
		);
		$tableField1 = array(
					'USN',
					'Amountpaid'									
		);
		
		$numFields = sizeof($tableField);
		$numFields1 = sizeof($tableField1);
		
		//echo '$numFields : '.$numFields.'<br />';

		
	
	
	//	=======^^^^^^^^^^^^^^^^^^^^^^^=========  End of Definition Part ======^^^^^^^^^=====

										
		{  //		read CSV data file
	
			$file = fopen($CSVfilename, "r"); 		
			$i = 0;
			while(!feof($file))
			  {		  	
				$thisLine = fgets($file);		
				$tableData[$i] = explode(",", $thisLine);
				$i++; 
			  }
			fclose($file);
			
			$numRows = sizeof($tableData);
			
			
		}
		//echo '$numRows : '.$numRows.'<br />';
		//echo '$tableField[$numFields-1] : '.$tableField[$numFields-1].'<br />';		
		//echo "<br /><hr /><br />";
			
			
			$indx = 0;		
			while($indx < $numRows) {	
				$table_SQLinsert = "INSERT INTO ".$tableName." (";
			
				foreach($tableField as $tableFieldName) {
					$table_SQLinsert .=  $tableFieldName;
					if($tableFieldName <> $tableField[$numFields-1]) {
						$table_SQLinsert .=  ", ";
					}
				}
				$table_SQLinsert .=  ") VALUES ";
				$table_SQLinsert .=  "(";
				
				foreach($tableField as $key => $tableFieldName) {
					
					$table_SQLinsert .=  "'".$tableData[$indx][$key]."'";
					if($tableFieldName <> $tableField[$numFields-1]) {
						$table_SQLinsert .=  ", ";
						
					}

				}

				$table_SQLinsert .=  ") ";
				mysqli_query($dbConnected,$table_SQLinsert);
				//if ($indx < ($numRows - 1)) {
					//$table_SQLinsert .=  ",\n";
				//}
				
				$indx++;
			}
		
			{	//	Echo and Execute the SQL and test for success   
			
				//echo $table_SQLinsert;		
							
						 //(mysqli_query($dbConnected,$table_SQLinsert));  				
							
			
			
			$table_SQLinsert = "INSERT INTO ".$tableName1." (";
			
			$table_SQLinsert .=   "ID,USN,Amountpaid"; 
			
			
			$table_SQLinsert .=  ") VALUES ";
			$indx = 0;		
			while($indx < $numRows) {			
				$table_SQLinsert .=  "('".$EventID."',";
				$table_SQLinsert .=  "'".$tableData[$indx][0]."',".$tableData[$indx][7]."";

				$table_SQLinsert .=  ") ";
				if ($indx < ($numRows - 1)) {
					$table_SQLinsert .=  ",\n";
				}
				
				$indx++;
			}
		
				//	Echo and Execute the SQL and test for success   
			
						
							
						if (mysqli_query($dbConnected,$table_SQLinsert))  {							
							header("Location: uploadfiles.php?EventID=".$EventID."");
						} 
			}
			
			
		}
		else
			echo '<h5 align="center" style="font-size:20px; color:red;">Invalid File Type</h5>';
	}
		else
		{
			$EventID = $_GET['EventID'];
			echo '<h1>Upload Participant Details</h1><br><br>';
		        echo '<div class="grandcontainer" align="center">
			<div class="parenrcontainer">
                        <form enctype="multipart/form-data" action="uploadparticipants.php" method="POST">
                                <input type="hidden" name="uploadActivated" value=1 />
								<input type="hidden" name="EventID" value="'.$EventID.'" />
                                Select file: <input name="userfile" type="file" /><br><br>
                                <input class="submitbtn" type="submit" value="Upload File" />
                        </form>';
				echo '</div></div>';
        }
		

}

?>
