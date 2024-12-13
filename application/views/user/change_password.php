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
			<h1 class="title-head-name">Change Password</h1>
			<div class="block-main">
				<div class="main-page clearfix">
					<!--<h2></h2>-->
					
					<?php if($UserDetails->login_type=='Direct'){?>
						<form name="frm_change_password" id="frm_change_password" action="<?php echo BASE_URL."user/savechangepassword/"; ?>" onsubmit="javascript: return checkMachingPassword();" method="POST">
							<div class="form-box change-password">
							
							
								<div class="error_msg" id="chng_psw_msg">
								<?php
								
								if($this->session->userdata('password_success') !='') {
									echo $this->session->userdata('password_success');
									$this->session->unset_userdata('password_success');
								}
								?>
								</div>
								<ul>
									<li><input type="password" name="old_password" id="old_password" value="" maxlength="255" placeholder="Old Password" class="password"></li>

									<li><input type="password" name="new_pss" id="new_pss" value="" maxlength="255" placeholder="New Password" class="password"></li>
									
									<li><input type="password" name="new_pss_cnf" id="new_pss_cnf" value="" maxlength="255" placeholder="Confirm New Password" class="password"></li>
									
								</ul>
								
								<div class="login-button-set">
									<input type="submit" name="newpswbtn" id="newpswbtn" value="Save" class="button">					
								</div>
							</div>
						</form>
						<?php } ?>
					
				

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
	
	
	<script type="text/javascript">
	$(document).ready(function(){
		 $('[data-toggle="tooltip"]').tooltip(); 
	});
	<?php if($UserDetails->login_type=='Direct'){?>
		$( "#frm_change_password").validate({	  
			ignore: ":hidden",
			rules: {
				old_password: {
				  required: true,				  
				},
				new_pss: {
				  required: true,
				  minlength: 6
				},
				new_pss_cnf: {
				  required: true,
				  minlength: 6
				},
			},
			messages: {		
				new_pss : {"minlength":"Please enter 6 or more characters."},
				new_pss_cnf : {"minlength":"Please enter 6 or more characters."}
			},
			submitHandler: function(form) {

				var pass1 = $("#new_pss").val();
				var pass2 = $("#new_pss_cnf").val();
				
				if (pass1 != pass2) {				
					$('#chng_psw_msg').html('Passwords not matched.');
					$('#chng_psw_msg').show(0).delay(3000).fadeOut('slow');
					return false;
				}
				else { 
					//alert("Passwords Match!!!");
					$.ajax({
						url: form.action,
						type: 'ajax',
						method: form.method,
						dataType: 'json',
						data: $(form).serialize(),
						success: function(response) {
							if(response.flag == 1) {
								$('#chng_psw_msg').html(response.msg);
								$('#chng_psw_msg').show(0).delay(3000).fadeOut('slow');
								window.location.href = BASE_URL+response.redirecturl;
							} else {
								$('#chng_psw_msg').html(response.msg);
								$('#chng_psw_msg').show(0).delay(3000).fadeOut('slow');
							}
						}      
					});
				}							
			}
		});

		function checkMachingPassword(){

			return true;
		}
	<?php } ?>

	</script>

	</body>
</html>
