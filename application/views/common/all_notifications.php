<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//print_r($_SESSION['UserId']);
$UserNotifications= $this->CommonModel->UserNotifications($_SESSION['UserId']);
?>
<?php $this->load->view('common/head_common'); ?>
 	<body class="">
		<?php $this->load->view('common/header'); ?>

		<div class="col-md-12" id="">
		<div class="kyc-title"> <h2>Notifications</h2></div>
		<p class="notify-para">See all your notification in one place</p>
		
		<div class="upload-contract-sec-main notify-inner-page">
				<div class="col-sm-12">
					<div class="row">
						<?php if(isset($UserNotifications) && count($UserNotifications)>0){
							
							foreach($UserNotifications as $value)
							{
								$NgoData = $this->CommonModel->get_logo($value['from_user_id']);
								$ComapnayData = $this->CommonModel->get_logo($value['from_user_id']);
						?>
					
						<div class="personal-notify  notify-inner-sec <?php echo ($value['unread_flag']==1)?'unread':''; ?> notify-item" id="notification_<?php echo $value['id']; ?>">
						 <a onclick="notificationUpdateD(<?php echo $value['id']; ?>)" class="notify-link"></a>   
							<div class="personal-notify-img">
						
								<?php
								   //print_r($NgoData);
								   // $ngologo = $NgoData->org_logo;
								    //$companylogo = $ComapnayData->company_logo;
									if($value['type_of_notification'] == 2 || $value['type_of_notification'] == 3){
										if(!empty($NgoData->org_logo))
										{	
											$imagengoSrc=NGO_LOGO.$NgoData->org_logo;	
											echo "<img width='100' height='100' src='".$imagengoSrc."' >";	
										}
										elseif(!empty($ComapnayData->company_logo))	
										{
											$imageSrc=COMPANY_LOGO.$ComapnayData->company_logo;	
											echo "<img width='100' height='100' src='".$imageSrc."' >";
										}
										/*elseif($NgoData != "")
										{
											 echo "<img width='100' height='100' src='".SKIN_URL."images/profile-default.jpg'>";
										}*/
										else{
										   echo "<img width='100' height='100' src='".SKIN_URL."images/profile-default.jpg'>";
										}
									}else{
										echo "<img width='100' height='100' src='".SKIN_URL."images/profile-default.jpg'>";
									}										
								 ?>		
							  
							</div><!-- personal-notify-img -->
							<div class="personal-notify-content">
								<h3><?php echo $value['notification_text']; ?></h3>
								<p><?php echo $value['link']; ?></p>
								<?php if($value['remark'] != ''){?>
									<p class="notify-details"><?php echo $value['remark']; ?></p>
								<?php }?>
								<p class="time-ago">
								   <?php
										$time = $value['created_at'];
										$date1 = $time;
										$date2 = strtotime(date('Y-m-d H:i:s'));
										
										//$diff = abs(strtotime($date2) - strtotime($date1));
										$diff = abs($date2 - $date1);

										$years = floor($diff / (365*60*60*24));
										$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
										$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
										$hours = floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24) / (60*60));
										$minutes = floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24  - $hours*60*60)/ 60); 
										$seconds = floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));  
										
										if($years != 0 && $months != 0 && $days != 0)
										{
											printf("%d years, %d months, %d days ago\n", $years, $months, $days);
										}
										elseif($months != 0 && $days != 0)
										{
											printf("%d months, %d days ago\n", $months, $days);
										}
										elseif($days != 0)
										{
											printf("%d days ago\n", $days);
										}
										elseif($hours != 0 && $minutes != 0)
										{
											if($hours == 1)
											{
												printf("%d hour, %d minutes ago\n", $hours, $minutes);
											}
											else
											{
												printf("%d hours, %d minutes ago\n", $hours, $minutes);

											}
										}
										elseif($minutes != 0)
										{
											printf("%d minutes ago\n", $minutes);
										}?>
								</p>
							</div><!-- personal-notify-content -->	
						</div><!-- personal-notify -->
						<?php } } ?>
					</div>
					
				</div>
		</div>
		
				
		</div>
	    <?php $this->load->view('common/footer'); ?>
		<?php $this->load->view('common/footer_js'); ?>	
	</body>
</html>	