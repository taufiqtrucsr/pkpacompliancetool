<?php  

$string = '0123456789';
$string_shuffled = str_shuffle($string);
$getOTP = substr($string_shuffled, 0, 4);

  
$mtd = "sms";
$mesg = 'Your OTP for new password is '.$getOTP;
$mob = '7506156106';
$send = "truCSR";
$key = "A6caf2ce090e57e969d65c6111ef27bb9";

$url = 'https://api-alerts.kaleyra.com/v4/?api_key='.$key.'&method='.$mtd.'&message='.$mesg.'&to='.$mob.'&sender='.$send.'';  // API URL
//print_r($url);exit;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); // change to 1 to verify cert
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
$result = curl_exec($ch);

echo json_encode(array('flag'=>1, 'msg'=>"OTP sent to your registered number."));
exit;