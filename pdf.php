<?php


session_start();
if(!isset($_SESSION["logged_in"]))
	header('Location:loginForm.php');


require('fpdf.php');
include_once("includes/connectdb.php");
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('C:\Users\USER\Pictures\RVlogo.jpg',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'RV College Of Engineering, Bangalore-59',0,2,'C');
	$this->SetFont('Arial','I',12);
	$this->Cell(30,5,'(Autonomous Institution affliated to VTU, Belgavi)',0,2,'C');
	$this->SetFont('Arial','',12);
	$this->Cell(30,5,'Department Of Information Science And Engineering',0,2,'C');
    // Line break
    $this->Ln(10);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
if(isset($_POST['eventID']))
{
	$EventID = $_POST['eventID'];
	$EventName = $_POST['eventname'];
	$Startdate = $_POST['startdate'];
	$Enddate = $_POST['enddate'];
	$Venue = $_POST['venue'];
	$EventName = $_POST['eventname'];
	$Expenditure = $_POST['expenditure'];
	$Amountcollected = $_POST['amountcollected'];
	$Profit = $_POST['profit'];
	$description = $_POST['description'];
	$numimages = $_POST['numimages'];
	$numinch = $_POST['numinch'];
	
	$pdf->SetFont('Times','B',15);
	$pdf->Cell(0,10,$EventName,0,1,'C');
	$pdf->Ln(10);
	
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,5,'Duration: '.$Startdate.' to '.$Enddate,0,1);
	$pdf->Cell(0,5,'Venue: '.$Venue,0,1);
	$pdf->Cell(0,5,'Faculty Incharge:',0,1);
	for($i=0; $i<$numinch;$i++){
	$pdf->Cell(0,5,($i+1).') '.$_POST['incharge'][$i],0,1);
	}
	$pdf->Cell(0,10,$description,0,1);
		
	$Speaker = "SELECT speaker.Fname,speaker.Lname,speaker.Company,";
	$Speaker .= "speaker1.ID, speaker1.Fname, speaker1.Lname ";
	$Speaker .= "FROM speaker JOIN speaker1 ";
	$Speaker .= "ON speaker1.Fname = speaker.Fname and speaker1.Lname = speaker.Lname WHERE speaker1.ID = '".$EventID."' ";
	
	$pdf->Cell(0,5,'Speakers: ',0,1);
	
	$pdf->Cell(40,10,'First Name',1,0); // First header column 
	$pdf->Cell(40,10,'Last Name',1,0); // Second header column
	$pdf->Cell(40,10,'Company',1,1); // Second header column
	
	foreach ($dbConnected->query($Speaker) as $row) {
		$pdf->Cell(40,10,$row['Fname'],1,0);
		$pdf->Cell(40,10,$row['Lname'],1,0);
		$pdf->Cell(40,10,$row['Company'],1,1);
	}
	
	$pdf->Cell(0,10,'Budget: ',0,1);
	$pdf->Cell(0,5,'Expenditure: '.$Expenditure,0,1);
	$pdf->Cell(0,5,'Amount collected: '.$Amountcollected,0,1);
	$pdf->Cell(0,5,'Profit: '.$Profit,0,1);
	
	if(isset($_POST['images']))
	{
		for($i=0; $i<$numimages;$i++){
			$pdf->Image($_POST['images'][$i],$i*100+10,170,100);
			$pdf->Cell(0,5,$_POST['imgdesc'][$i],0,0);
		}
	}
	
	
	
}
//for($i=1;$i<=40;$i++)
    //$pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();
?>