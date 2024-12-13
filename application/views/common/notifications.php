<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

//print_r($_SESSION['UserId']);
$UserNotificationsCount = $this->CommonModel->UserNotificationCount($_SESSION['UserId']);
$UserNotifications= $this->CommonModel->UserNotifications($_SESSION['UserId']);
?>

<!--<div class="notification">	-->
		<?php if($UserNotifications) { ?>
		<span class="notification-alert dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		</span>
		<?php if($UserNotificationsCount>0) { ?>
		<span class="notification-counter"><label style="<?php echo ($UserNotificationsCount>0)?'display:block;':'display:none;'; ?>" id="notifications-1"><?php echo $UserNotificationsCount; ?></label></span>
		<?php } } ?>
		<?php if(isset($UserNotifications) && count($UserNotifications)>0){
		
		$count=1;
		?>
		
		<div class="dropdown-menu notification-drop" aria-labelledby="dropdownMenuLink">
			
			<?php foreach($UserNotifications as $value){
				//print_r($value);
					$NgoData = $this->CommonModel->get_logo($value['from_user_id']);
					$ComapnayData = $this->CommonModel->get_logo($value['from_user_id']);
					
				if($count < 4) {
				?>
			<div class="personal-notify <?php echo ($value['unread_flag']==1)?'unread':''; ?> notify-item" id="notification_<?php echo $value['id']; ?>">
			 <a onclick="notificationUpdateD(<?php echo $value['id']; ?>)" class="notify-link"></a>
			   
			   
				<div class="personal-notify-img">
				       
					<?php
							
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
								else
								{
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
				</div><!-- personal-notify-img -->
			</div><!-- personal-notify -->
				<?php $resRowId = $value["id"]; } $count++; } ?>
			
			
			<a class="blue-link" href="<?php echo base_url();?>notifications">See all</a>
			
		 </div><!-- notification-drop -->
		<?php } ?>
		 
<!--</div>--><!-- notification -->

 <script type="text/javascript" src="<?php echo SKIN_URL; ?>js/notifications.js"></script>
