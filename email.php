<?php


// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Load Composer's autoloader
//require 'vendor/autoload.php';


function email($faculty_array,$i,$eventName)
{
	ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "eventreportgeneration@gmail.com";
	
	$incharges = "";
	$to = "";
	for($x=0;$x<$i;$x++)
	{	//$mail->addAddress($faculty_array[$x][1],$faculty_array[$x][0]);     // Add a recipient
		if($x==0){					
			$incharges .= $faculty_array[$x][0];
			$to .= $faculty_array[$x][1];
		}
		else{
			$incharges .= ", ".$faculty_array[$x][0];
			$to .= ", ".$faculty_array[$x][1];
		}
	}	
	
    $subject = 'Event Incharge';
    $message = "Hi,
			Event ".$eventName." has been assigned to ".$incharges.".
			Kindly contact the HOD in this regard.
			
			RV College of Engineering, Bengaluru.
			Dept of ISE.";
    $headers = "From Event Generator";
    if(mail($to,$subject,$message, $headers))
		echo '<h5 align="center" style="color:green; font-size:20px;">Email has been sent</h5>';
	else
		echo '<h5 align="center" style="color:red; font-size:20px;">Email could not be sent.</h5>';
    //echo "The email message was sent.";
}

/*
function email($faculty_array,$i,$eventName)
{
			$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
			try {
			    //Server settings
			    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
			    $mail->isSMTP();                                      // Set mailer to use SMTP
			    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			    $mail->SMTPAuth = true;                               // Enable SMTP authentication
			    $mail->Username = 'eventreportgeneration@gmail.com';                 // SMTP username
			    $mail->Password = 'EventReport@123';                           // SMTP password
			    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			    $mail->Port = 587;                                    // TCP port to connect to

			    //Recipients
			    $mail->setFrom('eventreportgeneration@gmail.com');
				$incharges = "";
			    for($x=0;$x<$i;$x++)
			    {	$mail->addAddress($faculty_array[$x][1],$faculty_array[$x][0]);     // Add a recipient
					if($x==0)					
					$incharges .= $faculty_array[$x][0];
					else
					$incharges .= ", ".$faculty_array[$x][0];
				}		
	
			    //Content
				$body = "Hi,<br>
							Event <b>".$eventName."</b> has been assigned to ".$incharges.".<br>
							Kindly contact the HOD in this regard.<br><br>
							RV College of Engineering, Bengaluru.<br>Dept of ISE.<br>";


			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Event Incharge';
			    $mail->Body    = $body;
			    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			    $mail->send();
			    echo '<h5 align="center" style="color:green; font-size:20px;">Email has been sent</h5>';
			} catch (Exception $e) {
			    echo '<h5 align="center" style="color:red; font-size:20px;">Email could not be sent.</h5>', $mail->ErrorInfo;
			}
}
*/


?>
