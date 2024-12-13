<?php 
$LoggedInUserId	= $this->session->userdata('ZoneUserId');
$UserName = $this->UserModel->GetUserNameByUserId($LoggedInUserId);
?>

<!-- Left menu list --->



<div class="left-menu-tree lfloat ">
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
			<div class="panel-heading <?php echo (isset($header_menu) && $header_menu=='change_password')?'active':''; ?>">
				<h4 class="panel-title ">
					<a href="<?php echo BASE_URL;?>settings/<?php echo $UserName; ?>/">Change Password</a>
				</h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading <?php echo (isset($header_menu) && $header_menu=='refer_friend')?'active':''; ?>">
				<h4 class="panel-title">
					<a href="<?php echo BASE_URL; ?>refer-a-friend/<?php echo $UserName; ?>/">Refer A Friend</a>
				</h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading <?php echo (isset($header_menu) && $header_menu=='blocked_user')?'active':''; ?>">
				<h4 class="panel-title">
					<a href="<?php echo BASE_URL; ?>blocked-users/<?php echo $UserName; ?>/">Blocked User</a>
				</h4>
			</div>
		</div>
		<!--<div class="panel panel-default">
			<div class="panel-heading <?php echo (isset($header_menu) && $header_menu=='notifications')?'active':''; ?>">
				<h4 class="panel-title">
					<a href="<?php echo BASE_URL; ?>notifications-settings/<?php echo $UserName; ?>/">Notification</a>			
				</h4>
			</div>
		</div>-->		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a href="<?php echo BASE_URL; ?>logout/">Logout</a>
				</h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a title="Delete My Account" href="mailto:info@thezones.in?subject=Delete My Account">Delete My	Account</a>						
				</h4>
			</div>
		</div>
	</div>
</div>



<!------------------->
	