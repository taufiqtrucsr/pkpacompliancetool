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
			<h1 class="title-head-name">Refer a friend</h1>
			<div class="block-main refer-friend">
				<div class="main-page clearfix">
					<h2>Share ZonesPro with your friends</h2>
					
					<div class="social-share-popup">			
						
						<span>	</span>		
						<?php 
							$SS_Title = 'The ZonesPro';
							
							$UserDetails = $this->UserModel->GetUserByUserId($this->session->userdata('ZoneUserId'));

							$SocialShareGoalImageByZone = $this->CommonModel->GetSocialShareGoalImageByZone(6);
							//$SS_Image = $SocialShareGoalImageByZone['socialshare'];

							$SS_Image = SKIN_URL.'images/socialshare/Refer-friend_share.jpg';
							$TW_Image_Path = $SocialShareGoalImageByZone['twittershare'];
							
							$SS_Content = "I am using ".$SS_Title." beta to create goals. I am inviting you to download the app or create a profile on the web. www.thezones.in";
							
							$SS_Content=htmlentities($SS_Content, ENT_QUOTES); 

							$TW_Content = "I am using ".$SS_Title." beta to create goals. I am inviting you to download the app or create a profile on the web. www.thezones.in";
							
							$TW_Content=htmlentities($TW_Content, ENT_QUOTES);
						?>
						<ul>
							<li class="fb-share"><a href="javascript:void(0);" onclick="shareSocialPost('facebook','<?php echo $SS_Title; ?>','<?php echo $SS_Content; ?>','<?php echo $SS_Image; ?>','');" title="Facebook"></a></li>
							<li class="twit-share"><a href="javascript:void(0);" onclick="shareSocialPost('twitter','<?php echo $SS_Title ." - "; ?>','<?php echo $SS_Content.' - '; ?>','<?php echo $TW_Image_Path; ?>','<?php echo BASE_URL; ?>');" title="Twitter"></a></li>
							<li class="pint-share"><a href="javascript:popWin('<?php echo 'https://pinterest.com/pin/create/button/?url='.BASE_URL.'&media='.$SS_Image.'&description='.$SS_Title.' - '.str_replace("%"," percent",$SS_Content); ?>', 'pinterest', 'width=640,height=480,left=0,top=0,location=no,status=yes,scrollbars=yes,resizable=yes','<?php echo $SS_Image; ?>');" title="Pin it" class="pinterest-share"></a></li>
							<!--<li class="insta-share"><a href=""></a></li>-->
							<li class="linke-share"><a href="javascript:popWin('<?php echo 'https://www.linkedin.com/shareArticle?url='.BASE_URL.'&title='.$SS_Title.'&submitted-image-url='.$SS_Image.'&summary='.str_replace("%"," percent",$SS_Content).'&source='.BASE_URL; ?>', 'linkedin', 'width=640,height=480,left=0,top=0,location=no,status=yes,scrollbars=yes,resizable=yes','<?php echo $SS_Image; ?>');" title="Linkedin" class="linkedin-share"></a></li>
							<!--<li class="google-share"><a href=""></a></li>-->
							<li class="email-share"><a href="mailto:example@mail.com?subject=<?php echo $SS_Title; ?>&body=<?php echo $SS_Content; ?>"  title="Email" class="email-share-anc"></a></li>
						</ul>
						
						<!--<p>Sharing your goal with friends will increase your commitment towards the goal</p>-->
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
