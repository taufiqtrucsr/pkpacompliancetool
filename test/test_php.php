<?php 
$date1=date_create("2013-01-01");
$date2=date_create("2013-08-15");
$diff=date_diff($date1,$date2);
$InDays = $diff->format("%a");
   $convert = $InDays + 1; // days you want to convert

$years = ($convert / 365) ; // days / 365 days
$years = floor($years); // Remove all decimals

$month = ($convert % 365) / 30.5; // I choose 30.5 for Month (30,31) ;)
$month = floor($month); // Remove all decimals

$days = ($convert % 365) % 30.5; // the rest of days

// Echo all information set
//echo 'DAYS RECEIVE : '.$convert.' days ';
echo '2013-08-01 and 2013-08-15 <br>';
echo $month.' month';
 ?>