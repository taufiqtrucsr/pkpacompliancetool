<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <head>
  <title> Donation Report </title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">

  <style>
  @import "https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap";
@import "https://fonts.googleapis.com/css?family=Open+Sans&display=swap";
body{font-family:'Roboto',sans-serif font-size:14px;}
	body{font-family:'Roboto',sans-serif,; font-size:14px;}
	table td, table th{padding:5px 7px; border:none; outline:0; word-wrap:break-word;}
	@page {
    size: A4 landscape;
	margin:20;
  }
  </style>
 </head>

 <body style="margin:0; padding:0;vertical-align:middle; font-family:'Roboto',sans-serif, arial; font-size: 14px; ">
 
 <!-- neeraj table -->
 <!-- neeraj table ends here -->
  
<table style=" font-family:'Roboto',sans-serif,; font-size:14px; ">


<tr>
	<td><img src="<?php echo base_url();?>public/uploads/banner/trucsr-email-logo.png"/ style="height:50px;"></td>
</tr>

<tr>
	<td><p style="font-family:'Roboto',sans-serif,; font-size:14px; text-align:center;">Donation Reporting for the period <?=$start_date?> to <?=$end_date?></p></td>
</tr>

<tr>
	<td width="100%" >
		<table cellpadding="0" cellspacing="0" align="center" style=" width:100%; margin:0 auto; font-family:'Roboto',sans-serif,; font-size:10px;">
			<tr>
				<td style="width:100px;padding:0px 0px 3px ;font-family:'Roboto',sans-serif,; font-size:14px;"><strong>NGO Name</strong></td> 
				<td style="width:300px;padding:0px 0px 3px;font-family:'Roboto',sans-serif,; font-size:14px;"><?=$ngo?></td>
				<td style="width:130px;padding:0px 0px 3px;font-family:'Roboto',sans-serif,; font-size:14px;"><strong>Total Donations</strong></td> 
				<td style="text-align:right; width:80px;padding:0px 0px 3px;font-family:'Roboto',sans-serif,; font-size:14px;"><?=$donationRaised?></td> 
			</tr>
			<tr>
				<td style="width:100px;padding:0px 0px 3px;font-family:'Roboto',sans-serif,; font-size:14px;"><strong>Address</strong></td> 
				<td style="width:300px;padding:0px 0px 3px;font-family:'Roboto',sans-serif,; font-size:14px;"><?=$address?></td>
				<td style="width:130px;padding:0px 0px 3px;font-family:'Roboto',sans-serif,; font-size:14px;"><strong>Total Deductions</strong></td> 
				<td style="text-align:right; width:80px;padding:0px 0px 3px;font-family:'Roboto',sans-serif,; font-size:14px;"><?=$donationDeducted?></td> 
			</tr>
			<tr>
				<td style="width:100px;padding:0px 0px 3px;font-family:'Roboto',sans-serif,; font-size:14px;"><strong>Section code</strong></td> 
				<td style="width:300px;padding:0px 0px 3px;font-family:'Roboto',sans-serif,; font-size:14px;">80G</td>
				<td style="width:130px;padding:0px 0px 3px;font-family:'Roboto',sans-serif,; font-size:14px;"><strong>Total Transferred</strong></td> 
				<td style="text-align:right; width:80px;padding:0px 0px 3px;font-family:'Roboto',sans-serif,; font-size:14px;"><?=$donationSettled?></td> 
			</tr>
			<tr>
				<td style="width:100px;padding:0px 0px 3px;font-family:'Roboto',sans-serif,; font-size:14px;"><strong>Donation type</strong></td> 
				<td style="width:300px;padding:0px 0px 3px;font-family:'Roboto',sans-serif,; font-size:14px;">Specific grant</td>
				<td style="width:130px;padding:0px 0px 3px;font-family:'Roboto',sans-serif,; font-size:14px;"><strong>&nbsp;</strong></td> 
				<td style="text-align:right; width:80px;padding:0px 0px 3px;font-family:'Roboto',sans-serif,; font-size:14px;">&nbsp;</td> 
			</tr>
		</table>
	</td>
</tr>
<?php 
foreach($projectArr as $project){ 
	echo '<tr><td><div style="page-break-before: always;"></div></td></tr>';
?>
								        
<tr>
	<td width="100%" >
	<p style="font-family:'Roboto',sans-serif,; font-size:14px;"><strong>Project Name &nbsp;&nbsp;&nbsp;&nbsp;</strong> <?=$project['project']?></p>
	
	<table cellpadding="0"  cellspacing="0" align="center" style=" width:100%; margin:0 auto; font-family:'Roboto',sans-serif,; font-size:8px;">
		<tr>
			<th style="border:1px solid #909090;font-family:'Roboto',sans-serif,;width:4%;font-size:8px;">Sr No.</th>
			<th style="border:1px solid #909090;font-family:'Roboto',sans-serif,;width:6%; font-size:8px;">Date</th>
			<th style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">Receipt No.</th>
			<th style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">Donor Name</th>
			<th style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">Address</th>
			<th style="border:1px solid #909090;font-family:'Roboto',sans-serif,;width:4%; font-size:8px;">UID Code</th>
			<th style="border:1px solid #909090;font-family:'Roboto',sans-serif,;width:6%; font-size:8px;">UID Type</th>
			<th style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">UID Number</th>
			<th style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">Transaction details</th>
			<th style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">Mode of receipt</th>
			<th style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">Donation <br>Amount<br>(₹)</th>
			<th style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">truCSR Platform <br>Fees <br>(₹)</th>
			<!-- <th style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">GST on truCSR <br>Platform fees</th> -->
			<th style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">Payment Gateway fee <br>(incl GST) <br>(₹)</th>
			<th style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">Net amount <br>Transferred</th>
			<th style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">Ref Doc</th>
		</tr>
        <?php 
        $count=0;
		foreach($project['transaction'] as $transaction){
		$count++; 
		?>
		<!-- < ?php 
		print_r("<pre>");
		print_r($transaction);
		?> -->
		<?php
		if ($count % 8 == 0) {
            // echo '<tr><td><div style="page-break-before: always;"></div></td></tr>';
			echo '	<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><div style="page-break-before: always;"></div></td>
					</tr>';
        }
		?>
		<tr>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><?=$count?></td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><?=date('d-m-Y',$transaction->created_at)?></td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><a href="<?php echo DOWNLOAD_RECIPT.$transaction->id;?>"><?=$transaction->receipt_no;?></a></td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><?=$transaction->first_name.'&nbsp;&nbsp;'.$transaction->last_name?></td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><?=$transaction->address?></td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><?=$transaction->uid?$transaction->uid:'--'?></td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><?=$transaction->uid_type?$transaction->uid_type:'--'?></td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><?=$transaction->uid_number?$transaction->uid_number:'--'?></td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><?=$transaction->transaction_id?></td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><?=$transaction->method?></td>
			<td style="text-align:right;border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><?=$transaction->donation_amount?></td>
			<td style="text-align:right;border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><?=$transaction->totalPlatFormFee?></td>
			<td style="text-align:right;border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><?=$transaction->gstPlatFormFee?></td>
			<td style="text-align:right;border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><?=$transaction->transfer_amount?></td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><a href='<?php echo OFFLINE_TRANSACTION_URL.$transaction->upload_offline_doc;?>'><?php
			if($transaction->method=='Cheque'){
				echo 'CHQ:'.$transaction->utr_offline_number;
			}else if($transaction->method=='NEFT'){
				echo 'UTR:'.$transaction->utr_offline_number;
			}
			else{
				echo "";
			}
			?></a></td>
		</tr>
        <?php }?>

		<tr>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">&nbsp;</td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">&nbsp;</td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">Total</td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">&nbsp;</td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">&nbsp;</td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">&nbsp;</td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">&nbsp;</td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">&nbsp;</td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">&nbsp;</td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">&nbsp;</td>
			<td style="text-align:right;border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><?=$project['donationRaised']?></td>
			<td style="text-align:right;border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><?=$project['platFormFee']?></td>
			<td style="text-align:right;border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><?=$project['gstPlatFormFee']?></td>
			<td style="text-align:right;border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;"><?=$project['donationSettled']?></td>
			<td style="border:1px solid #909090;font-family:'Roboto',sans-serif,; font-size:8px;">&nbsp;</td>
			
		</tr>

	</table>

	</td>
</tr>
<?php }?>

<tr>
	<td  width="100%">
		<p style="font-family:'Roboto',sans-serif,; font-size:14px;">--End of report--</p>
	</td>
</tr>

<tr>
	<td  width="100%">
		<p style="margin-top:50px;font-family:'Roboto',sans-serif,; font-size:14px;">GreenScarf Management Pvt. Ltd., Nariman Point, Mumbai</p>
	</td>
</tr>


</table>

 </body>
</html>
