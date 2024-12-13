<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

	/*$random = "1234569";
	$to = "kadambari@bcod.co.in";
	$mail = new PHPMailer;
	$mail->IsSMTP();
	$mail->Mailer = "smtp";
	
	$mail->SMTPDebug = 1;
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	//$mail->Username = 'bcod.web@gmail.com';
	//$mail->Password = 'bcod999999';
	$mail->Username = 'trucsljv';
	$mail->Password = 'W7#4#9L1u1*2VrEj';
	
	$mail->IsHTML(true);
	$mail->AddAddress($to, "recipient-name");
	$mail->SetFrom("kadambari@bcod.co.in");
	//$mail->AddReplyTo("rpi-app.com", "reply-to-name");
	//$mail->AddCC("rpi-app.com", "cc-recipient-name");
	$mail->Subject = "Password reset successfully!";
	//$content = "Here's your new password : ";
	$content = "Here's your new password : ".$random;
	
	$mail->MsgHTML($content); 
	if(!$mail->Send()) {
	  echo "Error while sending Email.";
	  //var_dump($mail);
	} else {
	  echo "Email sent successfully";
	}*/

	/*ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $to = "kadambari@bcod.co.in";
	$subject = "My subject";
	$txt = "Hello world!";
	$headers = "From: info@trucsr.in" . "\r\n" .
	"CC: somebodyelse@example.com";

	// mail($to,$subject,$txt,$headers);
    mail($to,$subject,$txt,$headers);*/
		
	$to      = "kadambari@bcod.co.in";
	$from    = "kadambari@bcod.co.in";
	$subject = "Hi Test";
	$message = "Hi how are you!";
	$headers = "From: ".$from. "\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
				
	$send_mail = mail($to, $subject, $message, $headers);
	if($send_mail)
	{
		echo "send mail";
		//return true;
	}
	else
	{
		echo "not send mail";
		//return false;
	}


	/*ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $to = "kadambari@bcod.co.in";
    // $to = "rakesh.gupta@bcod.co.in,support@bcod.co.in,anu.jp.08@gmail.com,test.october88@gmail.com";
    $subject = "Password reset successfully!";
    $message = "Here's your new password : ";
    $headers = "MIME-Version: 1.0"."\r\n";
	// $headers .= "Content-type: text/html; charset=iso-8859-1"."\r\n";
	$headers .= "Content-type: text/html; charset=UTF-8"."\r\n";
	// $headers .= "From: Resourceful Parenting "."\r\n";
    if(mail($to,$subject,$message, $headers))
	{
		echo "Message accepted";
	}
	else
	{
		echo "Error: Message not accepted";
	}*/
	
	/*use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'PHPMailer-master/src/Exception.php';
	require 'PHPMailer-master/src/PHPMailer.php';
	require 'PHPMailer-master/src/SMTP.php';
	
	$random = "1234569";
	$to = "kadambari@bcod.co.in";
	$mail = new PHPMailer;
	$mail->IsSMTP();
	$mail->Mailer = "smtp";
	
	$mail->SMTPDebug = 1;
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Username = 'bcod.web@gmail.com';
	$mail->Password = 'bcod999999';
	//$mail->Username = 'resourcefulparenting2020@gmail.com';
	//$mail->Password = 'parenting999999';
	
	$mail->IsHTML(true);
	$mail->AddAddress($to, "recipient-name");
	$mail->SetFrom("kadambari@bcod.co.in");
	//$mail->AddReplyTo("rpi-app.com", "reply-to-name");
	//$mail->AddCC("rpi-app.com", "cc-recipient-name");
	$mail->Subject = "Password reset successfully!";
	//$content = "Here's your new password : ";
	$content = "Here's your new password : ".$random;
	
	$mail->MsgHTML($content); 
	if(!$mail->Send()) {
	  echo "Error while sending Email.";
	  var_dump($mail);
	} else {
	  echo "Email sent successfully";
	}*/
	
?>
