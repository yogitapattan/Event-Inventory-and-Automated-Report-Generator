<?php

session_start();
if(!isset($_SESSION["logged_in"]))
	header('Location:loginForm.php');

if(!file_exists('fpdf.php')){
	
echo " Place fpdf.php file in this directory before using this page. ";
exit;	
}

if(!file_exists('font')){
	echo " Place font directory in this directory before using this page. ";
exit;	
}


include_once("includes/connectdb.php");
$EventID = $_GET['EventID'];
$tPerson_SQLselect = "SELECT participants.USN,participants.Name,participants.Phoneno,participants.EmailID,participants.Department, ";
$tPerson_SQLselect .= "participants.Semester,participants.Caste,participants1.Amountpaid,participants1.ID,participants1.USN  ";
$tPerson_SQLselect .= "FROM participants JOIN participants1 ";
$tPerson_SQLselect .= "ON participants.USN = participants1.USN ";
$tPerson_SQLselect .= "WHERE participants1.ID = '".$EventID."' ";
require('fpdf.php');
$pdf = new FPDF(); 
$pdf->AddPage();

$width_cell=array(25,25,25,25,25,25,25,25);
$pdf->SetFont('Arial','B',10);

$pdf->SetFillColor(193,229,252); // Background color of header 
// Header starts /// 
$pdf->Cell($width_cell[0],10,'USN',1,0); // First header column 
$pdf->Cell($width_cell[1],10,'Name',1,0); // Second header column
$pdf->Cell($width_cell[2],10,'Department',1,0); // Third header column 
$pdf->Cell($width_cell[3],10,'Semester',1,0); // Fourth header column
$pdf->Cell($width_cell[4],10,'EmailID',1,0); // Third header column 
$pdf->Cell($width_cell[5],10,'Phone number',1,0); // Third header column 
$pdf->Cell($width_cell[6],10,'Caste',1,0); // Fourth header column
$pdf->Cell($width_cell[7],10,'Amount Paid',1,1); // Third header column 
//$pdf->Cell($width_cell[8],10,'Signature',1,1); // Third header column 

//// header ends ///////

$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(235,236,236); // Background color of header 
$fill=false; // to give alternate background fill color to rows 

/// each record is one row  ///
foreach ($dbConnected->query($tPerson_SQLselect) as $row) {
$pdf->Cell($width_cell[0],10,$row['USN'],1,0);
$pdf->Cell($width_cell[1],10,$row['Name'],1,0);
$pdf->Cell($width_cell[2],10,$row['Department'],1,0);
$pdf->Cell($width_cell[3],10,$row['Semester'],1,0);
$pdf->Cell($width_cell[4],10,$row['EmailID'],1,0);
$pdf->Cell($width_cell[5],10,$row['Phoneno'],1,0);
$pdf->Cell($width_cell[6],10,$row['Caste'],1,0);
$pdf->Cell($width_cell[7],10,$row['Amountpaid'],1,1);

$fill = !$fill; // to give alternate background fill  color to rows
}
/// end of records /// 

$pdf->Output();

?>
