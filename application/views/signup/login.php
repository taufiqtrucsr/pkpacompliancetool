<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('common/head_common'); ?>
 	<body class="sign-in">
		<?php $this->load->view('common/header'); ?>
		<div class="container">
			<div class="login-form">
				<div class="main-div">
				    <div class="panel">
				   		<h2>Sign In</h2>
				   </div>
    			<form id="login-user" action="<?php echo base_url();?>login/loginpost" method="POST">
			        <div class="form-group">
			        	<label>Mobile</label><br>
			            <input type="text" class="form-control validate-number" name="inputMobile" id="inputMobile" maxlength="10">
			        </div>

			        <div class="form-group">
			        	<label>Password</label><br>
			            <input type="password" class="form-control" name="inputPassword" id="inputPassword">
			            <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
			        </div>
        			
        			<div class="forgot">
        				<a href="<?php echo base_url()?>forgotpassword">Forgot password?</a>
					</div>
					
					<!-- Google reCAPTCHA box -->
					<!-- Code commented on 01 st april 2022 Neerkumar -->
					<!-- CAPTCHA CODE START HERE -->
					<!-- <div class="form-group captcha-code">
					<div class="g-recaptcha" data-sitekey="< ?php echo GOOGLE_RECAPTCHA_SITE_KEY; ?>" data-callback="recaptchaCallback"></div>
					<input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
					</div> -->
					<!-- CAPTCHA CODE ENDS HERE -->
					<!-- Code ends here -->
					
        			<button type="submit" class="btn btn-primary">Sign In</button>
        			<p class="new-user-text">New User? <a href="<?php echo base_url()?>signup"> Sign Up</a></p>

    			</form>
    			</div>
				
			</div>
		</div>

		<?php $this->load->view('common/footer'); ?>
		<?php $this->load->view('common/footer_js'); ?>	


 	</body>
</html>	