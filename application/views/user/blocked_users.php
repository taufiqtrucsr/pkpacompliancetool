<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($UserDetails);
?>

<?php $this->load->view('common/head_common'); ?>

 <body class="newuser-home-index">
	<?php $this->load->view('common/header'); ?>

	<div class="main-wrapper search-page block-page">
		<?php $this->load->view('user/settings_left'); ?>
		
		<div class="main-container clearfix right-block-main lfloat">
			<h1 class="title-head-name">Blocked User</h1>
			<div class="block-main">
				<div class="main-page clearfix">
					<h2> Total <?php echo ((is_array($BlockedUsers)))?'(Results:'.count($BlockedUsers).')':''; ?></h2>
					
					<div class="people_list" >
					<?php
				

					if(is_array($BlockedUsers)) {?>
						
						<?php $count=1; foreach($BlockedUsers as $res) { 
						
						if($count < 7) {
						?>
							<div class="search-block-inner search-block-people">
								
								<div class="search-profile-inner">
								<?php 
									$custom_variable = $this->CommonModel->get_custom_variable('profile_sub_title'); 
									
									$profile_pic = '';
									if($res->profile_pic != '') {
										if (strpos($res->profile_pic, 'https://') !== false) {
											$profile_pic = $res->profile_pic;
										} else {
											$profile_pic = PROFILE_PIC_URL.$res->profile_pic;
										}
									}
								?>
								
								<a href="<?php echo BASE_URL.'public/profile/'.$res->identifier;?>">
								<?php if(isset($profile_pic) && $profile_pic!=''){?>
								<div  class="lfloat search-photo"><img src="<?php echo $profile_pic; ?>"></div>
								<?php }else {?>
									<div  class="lfloat search-photo"></div>
								<?php } ?>
								</a>							
					
								<div class="search-profile-info">
									<a href="<?php echo BASE_URL.'public/profile/'.$res->identifier;?>">
										<p class="profiler-name-search"><?php echo $res->name; ?></p>
									</a>
									<!-- <p class="mutual-mentor"><?php //echo $res->company; ?></p> -->
									<p class="location-search"><?php echo (isset($res->location) && $res->location!='')?$res->location:''; ?></p>
									
									<?php 
									$ConnectionExist = $this->CommonModel->CheckMentorConnections($this->session->userdata('ZoneUserId'),$res->user_id);
									
									if($ConnectionExist==0)
									{
									?><!--<div class="mentor-button" id="mentor-button-<?php echo $res->user_id; ?>">
										<input type="button" class="mentor-req" onclick="SendGlobalConnectionRequest(<?php echo $res->user_id; ?>);" value="Mentor request">
									</div>-->
									<?php } ?>
									<div class="mentor-button" id="blocked-button-<?php echo $res->user_id; ?>">
										<input type="button" class="mentor-req" onclick="javascript:UnBlockPerson(<?php echo $res->user_id; ?>,'blocked_users');" value="UnBlock">
									</div>
									
								</div>
								</div>
							</div><!-- searchblock-inner -->
						<?php $resRowId = $res->user_id; } $count++; } ?>
						<?php if($count > 6) { ?>
							
							<div class="search-see-more show_more_main" id="show_more_main<?php echo $resRowId; ?>" onclick="seeMorePeople();">
								<div id="<?php echo $resRowId; ?>" class="show_more_people" title="Load More People"><input type="submit" class="mentor-req" value="See More People"></div>
								<center><div class="loader"></div></center>
							</div>
							
						<?php } ?>
					<?php } else { ?>
						<div class="search-block-empty">								
							<div class="search-profile-inner">No Results found</div>
						</div>
					<?php } ?>
					</div>		
					
				

				</div>
			</div>
		</div>
		
		
	</div>
	<?php $this->load->view('common/footer'); ?>
 
	<?php $this->load->view('common/footer_js'); ?>
	<input type="hidden" name="current_page" id="current_page" value="blocked_users"> 
	<script type="text/javascript" src="<?php echo SKIN_URL; ?>js/user_profile.js"></script>
	<link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/jquery.mCustomScrollbar.css">
	<script type="text/javascript" src="<?php echo SKIN_URL; ?>js/jquery.mCustomScrollbar.js"></script>
	

<script>

function hideModalBody() {

  $(".modal-backdrop").remove();
  $('body').removeClass('modal-open');
  $('body').css('padding-right', '');
}


	$(function () {
		$('[data-toggle="tooltip"]').tooltip();  
		
	});
	</script>

	</body>
</html>
