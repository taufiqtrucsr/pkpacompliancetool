<?php $to = "shubratap@bcod.co.in";
			$subject = "Zone test";

			$message = "
			<html>
			<head>
			<title>HTML email</title>
			</head>
			<body>
			<p>This email contains HTML Tags!</p>
			<table>
			
			</table>
			</body>
			</html>
			";

			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= 'From: <deepak@bcod.co.in>' . "\r\n";

			$send = mail($to,$subject,$message,$headers);
			if($send){
		echo '<center><h3 style="color:#009933;">Mail sent successfully at '.date('d-m-Y h:i:s A').'</h3></center>';
	}
	else{
		echo '<center><h3 style="color:#FF3300;">Mail error: </h3></center>'.$mail->ErrorInfo;
	}
?>			