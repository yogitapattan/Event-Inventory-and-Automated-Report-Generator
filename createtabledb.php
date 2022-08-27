<?php
/*
*	This script creates tables
*
*
*=====================================
*/
include_once("includes/connectdb.php");
if($dbSuccess)
{
				 		
				//   SQL script to create table LOGIN
	
				$createLoginTable_SQL = "CREATE TABLE login ( ";
				//$createTable_SQL .= "ID INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY , ";
				$createLoginTable_SQL .= "Username VARCHAR( 50 ) NOT NULL UNIQUE, ";
				$createLoginTable_SQL .= "Password VARCHAR( 50 ) NOT NULL, ";
				$createLoginTable_SQL .= "Accesslevel INT( 50 )  NOT NULL ";
				$createLoginTable_SQL .= ")";
				
				if (mysqli_query($dbConnected,$createLoginTable_SQL))  {	
					echo "'Create TABLE LOGIN' -  Successful.<br /><br />";
				}
				
								
				//   SQL script to create table event 
				$createEventTable_SQL = "CREATE TABLE event ( ";
				$createEventTable_SQL .= "ID INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY  , ";
				$createEventTable_SQL .= "Name VARCHAR( 100 ) NOT NULL UNIQUE, ";
				$createEventTable_SQL .= "Venue VARCHAR( 100 ) NOT NULL, ";
				$createEventTable_SQL .= "Startdate TIMESTAMP NOT NULL, ";
				$createEventTable_SQL .= "Enddate TIMESTAMP  NOT NULL, ";
				$createEventTable_SQL .= "Category VARCHAR(100)  NOT NULL ";
				$createEventTable_SQL .= ")";
	
				if (mysqli_query($dbConnected,$createEventTable_SQL))  {	
					echo "'Create TABLE event' -  Successful.<br /><br />";
				}

				//   SQL script to create table speaker
	
				$createSpeakerTable_SQL = "CREATE TABLE speaker ( ";
				$createSpeakerTable_SQL .= "Fname VARCHAR( 50 ) NOT NULL , ";
				$createSpeakerTable_SQL .= "Lname VARCHAR( 50 ) NOT NULL, ";
				$createSpeakerTable_SQL .= "Phonenumber BIGINT( 10 ) NOT NULL, ";
				$createSpeakerTable_SQL .= "Email VARCHAR( 70 ) NOT NULL, ";
				$createSpeakerTable_SQL .= "Designation VARCHAR( 150 ) NOT NULL, ";
				$createSpeakerTable_SQL .= "Company VARCHAR( 150 ) , ";
				$createSpeakerTable_SQL .= "Yearofexp INT( 2 ) ,";
				$createSpeakerTable_SQL .= "PRIMARY KEY(Fname,Lname) ";
				$createSpeakerTable_SQL .= ")";
				
				if (mysqli_query($dbConnected,$createSpeakerTable_SQL))  {	
					echo "'Create TABLE speaker' -  Successful.<br /><br />";
				}
				
				//   SQL script to create table speaker1
	
				$createSpeakerTable_SQL1 = "CREATE TABLE speaker1 ( ";
				$createSpeakerTable_SQL1 .= "ID INT(11) NOT NULL, ";
				$createSpeakerTable_SQL1 .= "Fname VARCHAR( 50 ) NOT NULL , ";
				$createSpeakerTable_SQL1 .= "Lname VARCHAR( 50 ) NOT NULL, ";				
				/*$createSpeakerTable_SQL1 .= "foreign key(ID) references event(ID), ";
				$createSpeakerTable_SQL1 .= "foreign key(Fname) references speaker(Fname), ";
				$createSpeakerTable_SQL1 .= "foreign key(Lname) references speaker(Lname), ";*/
				$createSpeakerTable_SQL1 .= "PRIMARY KEY(ID,Fname,Lname)";
				$createSpeakerTable_SQL1 .= ")";
				
				if (mysqli_query($dbConnected,$createSpeakerTable_SQL1))  {	
					echo "'Create TABLE speaker1' -  Successful.<br /><br />";
				}

				//   SQL script to create table budget 
				$createBudgetTable_SQL = "CREATE TABLE budget ( ";
				$createBudgetTable_SQL .= "ID INT( 11 ) NOT NULL  , ";
				$createBudgetTable_SQL .= "Venue INT( 20 ) , ";
				$createBudgetTable_SQL .= "Food INT( 20 ) , ";
				$createBudgetTable_SQL .= "Takeaway INT( 20 ) , ";
				$createBudgetTable_SQL .= "Regkit INT ( 20 ),  ";
				$createBudgetTable_SQL .= "CoffeeTea INT ( 20 ),  ";
				$createBudgetTable_SQL .= "TADA INT ( 20 ),  ";
				$createBudgetTable_SQL .= "Speaker INT ( 20 ),  ";
				$createBudgetTable_SQL .= "Regamount INT ( 20 ) , ";
				$createBudgetTable_SQL .= "Printing INT ( 20 ),  ";
				$createBudgetTable_SQL .= "Miscellaneous INT ( 20 ) , ";
				$createBudgetTable_SQL .= "FOREIGN KEY(ID) REFERENCES event(ID) ";
				$createBudgetTable_SQL .= "ON DELETE CASCADE ";
				$createBudgetTable_SQL .= ")";
	
				if (mysqli_query($dbConnected,$createBudgetTable_SQL))  {	
					echo "'Create TABLE budget' -  Successful.<br /><br />";
				} 		
				
				//   SQL script to create table PARTICIPANTS
				$createPartTable_SQL = "CREATE TABLE participants ( ";
				//$createPartTable_SQL .= "ID INT( 11 ) NOT NULL , ";
				$createPartTable_SQL .= "USN VARCHAR( 20 ) NOT NULL PRIMARY KEY , ";
				$createPartTable_SQL .= "Name VARCHAR( 50 ) NOT NULL, ";
				$createPartTable_SQL .= "Department VARCHAR( 50 ), ";
				$createPartTable_SQL .= "Semester VARCHAR ( 11 ), ";
				$createPartTable_SQL .= "EmailID VARCHAR( 50 ), ";
				$createPartTable_SQL .= "Phoneno BIGINT ( 10 ) NOT NULL, ";
				$createPartTable_SQL .= "Caste VARCHAR( 50 ) ";
				//$createPartTable_SQL .= "Amountpaid INT ( 11 ), ";
				$createPartTable_SQL .= ")";
	
				if (mysqli_query($dbConnected,$createPartTable_SQL))  {	
					echo "'Create TABLE participants' -  Successful.<br /><br />";
				} 	
				
				//   SQL script to create table PARTICIPANTS1
				$createPartTable_SQL1 = "CREATE TABLE participants1 ( ";
				$createPartTable_SQL1 .= "ID INT( 11 ) NOT NULL , ";
				$createPartTable_SQL1 .= "USN VARCHAR( 20 ) NOT NULL , ";
				$createPartTable_SQL1 .= "Amountpaid INT ( 11 ), ";
				$createPartTable_SQL1 .= "foreign key(ID) references event(ID), ";
				$createPartTable_SQL1 .= "foreign key(USN) references participants(USN), ";
				$createPartTable_SQL1 .= "PRIMARY KEY(ID,USN) ";
				$createPartTable_SQL1 .= ")";
	
				if (mysqli_query($dbConnected,$createPartTable_SQL1))  {	
					echo "'Create TABLE participants1' -  Successful.<br /><br />";
				} 	
				
				//   SQL script to create table FACULTY
				$createFacutlyTable_SQL = "CREATE TABLE faculty ( ";
				$createFacutlyTable_SQL .= "Name VARCHAR( 50 ) NOT NULL UNIQUE, ";
				$createFacutlyTable_SQL .= "EmailID VARCHAR( 50 ) NOT NULL, ";
				$createFacutlyTable_SQL .= "Phoneno BIGINT ( 10 ) NOT NULL, ";
				$createFacutlyTable_SQL .= "Designation VARCHAR( 50 ) NOT NULL ";
				$createFacutlyTable_SQL .= ")";
	
				if (mysqli_query($dbConnected,$createFacutlyTable_SQL))  {	
					echo "'Create TABLE faculty' -  Successful.<br /><br />";
				} 
				
				//   SQL script to create table INCHARGE
				$createInchargeTable_SQL = "CREATE TABLE incharge ( ";
				$createInchargeTable_SQL .= "ID INT( 11 ) NOT NULL , ";
				$createInchargeTable_SQL .= "Name VARCHAR( 50 ) NOT NULL, ";
				$createInchargeTable_SQL .= "FOREIGN KEY(ID) REFERENCES event(ID)";
				$createInchargeTable_SQL .= "ON DELETE CASCADE ";
				$createInchargeTable_SQL .= ")";
	
				if (mysqli_query($dbConnected,$createInchargeTable_SQL))  {	
					echo "'Create TABLE incharge' -  Successful.<br /><br />";
				} 			
		
				//   SQL script to create table ACCESSCONTROL
				$createInchargeTable_SQL = "CREATE TABLE accesscontrol ( ";
				$createInchargeTable_SQL .= "Usertype VARCHAR( 50 ) NOT NULL, ";
				$createInchargeTable_SQL .= "Accesslevel INT(10) NOT NULL";
				$createInchargeTable_SQL .= ")";
	
				if (mysqli_query($dbConnected,$createInchargeTable_SQL))  {	
					echo "'Create TABLE Accesscontrol' -  Successful.<br /><br />";
				} 	

				//   SQL script to create table FILES
				$createFilesTable_SQL = "CREATE TABLE files ( ";
				$createFilesTable_SQL .= "ID INT( 11 ) NOT NULL , ";
				$createFilesTable_SQL .= "Path VARCHAR( 300 ) ";
				$createFilesTable_SQL .= ")";
	
				if (mysqli_query($dbConnected,$createFilesTable_SQL))  {	
					echo "'Create TABLE files' -  Successful.<br /><br />";
				} 
				
				$populateAccesscontrol = "INSERT INTO accesscontrol ";
				$populateAccesscontrol .=  "VALUES ('Administrator',99),('HOD',78),('Faculty Incharge',25)";
				if (mysqli_query($dbConnected,$populateAccesscontrol))  {	
						echo 'used to Successfully populate accesscontrol table.<br /><br />';
				}

	
}



?>
