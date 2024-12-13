<?php
$to      = 'rutul.patel@bcod.co.in, rutulcom92@gmail.com,rutul.ritz@gmail.com';
$subject = 'Test Email From info@thezones.in';
$message = 'Hello Test';
$headers = 'From: info@thezones.in' . "\r\n" .  
    'Reply-To: info@thezones.in' . "\r\n" .        
    'X-Mailer: PHP/' . phpversion();
 
if(mail($to, $subject, $message, $headers))
{
    echo "test mail success";
}else
{
    echo "test mail not success";
}

/*
$to      = 'rutul.patel@bcod.co.in, saroj@bcod.co.in';
$subject = 'Test Email From ragesh@knowthesign.in';
$message = 'Hello Test';
$headers = 'From: ragesh@knowthesign.in' . "\r\n" .  
    'Reply-To: info@thezones.in' . "\r\n" .        
    'X-Mailer: PHP/' . phpversion();
 
if(mail($to, $subject, $message, $headers))
{
    echo "test mail success";
}else
{
    echo "test mail not success";
}*/

?>