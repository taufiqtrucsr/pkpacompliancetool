<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('common/head_common'); ?>

 	<body class="sign-in">
		<?php $this->load->view('common/header'); ?>

		<div class="container">
			
			<div class="verifymobile-form" id="verifymobile_form">
				<div class="main-div">
    			
    		<form id="verifymobile-user" action="<?php echo base_url();?>forgotpassword/postData" method="POST">
              <p><img class="otp-img" src="skin/images/verifymobile.png"></p>
				      <h4>Verify Mobile</h4>
				      <p>Please enter your mobile number to verify your account</p>
						<div class="pad-tb-20"></div>
			        <div class="form-group">
			            <input type="text" class="form-control validate-number" name="inputMobile" id="inputMobile" placeholder="Phone Number" maxlength="10">
			        </div>

        			<button type="submit" class="btn btn-primary">Send OTP</button>

    			</form>
    			</div>
				</div>

       <div class="otp-form" id="otp_form" style="display: none;" >
			   <p><img class="otp-img" src="skin/images/verifyOTP.png"></p>
				<h4>OTP Verfication</h4>
				<p>Please enter OTP sent to <span class="blk-clr">+91</span> <span class="blk-clr" id="phn-label"></span></p>
				<div class="pad-top-bot-25"></div>
				<form id="forgotpwd-otp" method="POST" action="<?php echo base_url()?>forgotpassword/verifyOtp">
					<input type="hidden" name="phone" id="otp-phone" value="">
					<div id="divOuter">
						<div id="divInner">
							<input id="otpNumber" name="otpNumber" type="text" maxlength="4" />
						</div>
					</div>
					<p>Didn't receive OTP? <a class="blue-link" href="javascript:void(0)" onclick="forgotpwdresendOtp();">Resend OTP</a><span class="one-of-three">(1 of 3)</span></p>
					<div class="pad-top-bot-25"></div>
					<button type="submit" class="btn btn-primary">VERIFY AND PROCEED</button>
				</form>
			 </div>


      <div class="password-form login-form otp-form" id="password_form" style="display: none;" >
      	<p><img class="otp-img" src="skin/images/newpass.png"></p>
				<h4>Set New Password</h4>
			   <form id="setpassword-user" method="POST" action="<?php echo base_url()?>forgotpassword/changePassword">
			   	<input type="hidden" name="phone" id="password-phone" value="">
        <div class="form-group">
			       <label>New Password</label><br>
			       <input type="password"class="form-control" name="inputNewPassword" id="inputNewPassword">
			       <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-Newpassword"></span>
			  </div>

			  <div class="form-group">
			       <label>Confirm Password</label><br>
			       <input type="password"class="form-control" name="inputRePassword" id="inputRePassword">
			       <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-Repassword"></span>
			  </div>

			  <button type="submit" class="btn btn-primary">Proceed</button>
			</form>
		 </div>


		 <div id="success-password" class="success-password success-otp" style="display: none;">
			<p><img class="otp-img" src="skin/images/otp-img.jpg"></p>
				<h4>Congratulations !</h4>
				<p>New password has been set successfully.</p>
				<p>Login to continue</p>

				<a href="<?php echo base_url()?>signin"><button type="submit" class="btn btn-primary">LOG IN</button></a>
     </div>

		</div>

		<?php $this->load->view('common/footer'); ?>
		<?php $this->load->view('common/footer_js'); ?>	


 	</body>
</html>	