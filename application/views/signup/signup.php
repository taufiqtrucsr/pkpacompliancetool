<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style>
	#verify-otp .form-control {
		background: #FAFAFA;
		border: 1px solid #C4C4C4;
		border-radius: 5px;
		height: 45px;
	}

	._otp-form p {
		font-size: 14px;
	}

	._otp-form h4 {
		font-size: 24px;
	}

	._otp-form h4 i {
		font-size: 24px;
		color: #C4C4C4;
		left: 10px;
		padding: 0;
		margin: 0;
		position: absolute;
	}

	.sub_container {
		color: black;
		margin: auto;
		background: white;
		height: 270px;
		width: 220px;
		border-radius: 5px;
		border: 1px solid #ffff;
		/* border:1px solid #3366cc; */
	}

	.current_act_btn {
		border: 1px solid #3366cc;
		border-radius: 5px;
	}

	.submit_user:hover {
		background-color: #3366cc;
	}

	.btn:focus,
	.btn.Focus {
		outline: 0;
	}

	#TermsConditionKYC .modal-body {
		background: transparent;
		margin-top: 5px !important;
	}

	.terms-and-conditions {
		border: 1px solid #BABABA;
		border-radius: 5px;
	}

	.terms-and-conditions p,
	.terms-and-conditions ul li {
		font-size: 16px !important;
		color: #000;
		margin-bottom: 10px;
	}

	.terms-and-conditions h3 {
		color: #000;
		font-weight: 500 !important;
		margin-bottom: 5px;
		margin-top: 15px;
	}

	.accept-button {
		height: auto !important;
		margin: 10px !important;
	}

	.btn-secondary {
		border: 1px solid #3366CC !important;
		border-radius: 3px !important;
		width: 190px;
		color: #3366CC;
		padding: 12px 10px !important;
		font-size: 17px !important;
		line-height: normal !important;
		height: 50px;
		margin: 10px;
		font-weight: 500 !important;
	}

	/* .top-header {
		display:none;
	}
	.footer{
		display:none;
	} */

	.AcceptTermError {
		display: none;
	}

	/* taufiq */
	.select-box #orgType {
		background: #fff url(skin/images/Dropdown_black.png) no-repeat !important;
		background-position: right 3% center !important;
		background-size: 12px !important;
	}

	/*end taufiq */
</style>
<!-- Testing Mail via localhost by krishna -->
<!-- Testing Mail via localhost by krishna -->
<?php $this->load->view('common/head_common'); ?>

<body class="sign-in">
	<?php $this->load->view('common/header'); ?>
	<div class="container slide_1">
		<div class="login-form">
			<div class="main-div">
				<div class="panel">
					<h2>Sign In</h2>
				</div>
				<form id="login-user" action="<?php echo base_url(); ?>login/loginpost" method="POST">

					<input type="hidden" name="enityTypeLogin" id="enityTypeLogin" value="1">
					<div class="form-group">
						<label>Enter Email ID/ Mobile Number</label><br>
						<input type="text" class="form-control" name="inputMobileLogin">
					</div>

					<div class="form-group">
						<label>Password</label><br>
						<input type="password" class="form-control" name="inputPasswordLogin" id="inputPasswordLogin">
						<span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password-login"></span>
					</div>

					<div class="forgot">
						<a href="<?php echo base_url() ?>forgotpassword">Forgot password?</a>
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
					<p class="new-user-text">New User? <a href="javascript:void(0)" class="slide_click_1"> Sign Up</a>
					</p>

				</form>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="login-form _login-form slide_2" id="login_form">
			<div class="main-div">
				<div class="panel">
					<h2>Sign Up</h2>
				</div>
				<div id="Non-Individual" class="tab-pane fade in active">
					<form id="signup-user" method="POST" action="<?php echo base_url() ?>signup/postData">
						<input type="hidden" name="enityType" id="enityType" value="1">
						<div class="form-group">
							<label>First Name</label><br>
							<input type="text" class="form-control validate-char" placeholder="First Name"
								name="inputFname" id="inputFname">
						</div>
						<div class="form-group">
							<label>Middle Name</label><br>
							<input type="text" class="form-control validate-char" placeholder="Middle Name"
								name="inputMiddle" id="inputMiddle">
						</div>

						<div class="form-group">
							<label>Last Name</label><br>
							<input type="text" class="form-control validate-char" placeholder="Last Name"
								name="inputLname" id="inputLname">
						</div>
						<div class="form-group entity">
							<label>Entity Name</label><br>
							<!-- sanjay oraon 27/06/2023 removing validate-char and duplicate maxlength -->
							<input type="text" class="form-control alpha_numeric_space" minlength="5" maxlength="100"
								placeholder="Entity Name" onpaste="return false;" name="enityName" id="enityName">
						</div>
						<div class="form-group entity_type">
							<label style="margin-bottom: 8px;">Select Entity Type</label><br>
							<!-- taufiq -->
							<div class="select-box">
								<select name="orgType" class="form-control" id="orgType" style="height:44px;">
									<option value="">Select a Entity Type</option>
									<?php
									foreach ($orgtypeall as $keys => $orgvals) {
										echo '<option value="' . $orgvals->id . '">' . $orgvals->org_type . '</option>';
									}
									?>
								</select>
							</div>
							<!-- end taufiq -->
						</div>


						<div class="form-group">
							<label>Email Id</label><br>
							<input type="text" class="form-control" placeholder="Email Id" name="inputEmail"
								id="inputEmail">
						</div>
						<div class="form-group mobile-prefix">
							<label>Mobile Number</label><br>
							<input type="text" class="form-control validate-number" placeholder="Mobile Number"
								maxlength="10" name="inputMobile" id="inputMobile">
						</div>

						<!-- Google reCAPTCHA box -->
						<!-- Nk on 01-04-22 code commented duu to local setup -->
						<!-- CAPTCHA CODE START HERE -->
						<!-- <div class="form-group captcha-code">
							<div class="g-recaptcha" data-sitekey="< ?php echo GOOGLE_RECAPTCHA_SITE_KEY; ?>" data-callback="recaptchaCallback"></div>
							<input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
							</div> -->
						<!-- CAPTCHA CODE ENDS HERE -->



						<div class="form-group form-check">
							<input type="checkbox" class="form-check-input" id="CheckTerms" name="CheckTerms">
							<label class="form-check-label" for="CheckTerms">I Agree to <span
									style="text-transform:initial;">truCSR</span> <a href="page/term-and-conditions/"
									target="_blank">Terms and
									Conditions</a>, <a href="page/privacy-policy/" target="_blank">Privacy Policy</a>
								provide consent to verify my information
								necessary as per Govt of India.</label>
						</div>

						<!--button type="submit" class="btn btn-primary" id="signUP">Sign Up</button-->

						<button type="submit" class="btn btn-primary" id="signUP">
							Sign Up
						</button>

						<!-- data-toggle="modal" data-target="#TermsConditionKYC" -->

						<p class="new-user-text"> Existing User? <a href="javascript:void(0)"
								class="_sign_up slide_click_2"> Sign In</a>
						</p>


					</form>
				</div>
			</div>
		</div>

	</div>

	<div class="otp-form _otp-form" id="otp_form" style="display:none;">
		<!-- <p><img class="otp-img" src="skin/images/verifyOTP.png"></p> -->
		<h4><span class="verify_otp_back"><i class="fa fa-chevron-left"></i></span> Set Password & Enter OTP</h4>
		<!-- <p>Please enter OTP sent to <span class="blk-clr">+91</span> <span class="blk-clr" id="phn-label"></span></p> -->
		<p>Set Password followed by OTP verification code we’ve sent by SMS to <span class="blk-clr">+91</span> <span
				class="blk-clr" id="phn-label"></span></p>

		<form id="verify-otp" method="POST" action="<?php echo base_url() ?>signup/verifyOtp">
			<input type="hidden" name="phone" id="otp-phone" value="">
			<div class="form-group">
				<label>Enter Password</label><br>
				<input type="password" class="form-control" name="inputPassword" id="inputPasswordOTP" />
				<span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password-otp"></span>
			</div>
			<div class="form-group">
				<label>Re-enter Password</label><br>
				<input type="password" class="form-control" name="inputConfPassword" id="inputConfPassword" />
				<span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-Confpassword"></span>
			</div>

			<div class="form-group">
				<label>Enter OTP</label><br>
				<div id="divInner">
					<input id="otpNumber" name="otpNumber" type="text" maxlength="4" class="form-control" />
				</div>
			</div>
			<p>Didn't Received OTP? <a class="blue-link" href="#" onclick="resendOtp(); return false;">Send Again</a>
				<span class="one-of-three">
					<!-- (1 of 3) -->
				</span>
			</p>
			<button type="submit" class="btn btn-primary">Verify & Proceed</button>
		</form>
	</div>

	<div id="success-otp" class="success-otp" style="display: none;">


		<p><img class="otp-img" src="skin/images/congratulation.png"></p>
		<h4>Congratulations !</h4>
		<p>You have successfully Signed Up.</p>
		<p>Login to continue</p>
		<div class="pad-top-bot-25"></div>

		<a href="<?php echo base_url() ?>signin"><button type="submit" class="btn btn-primary">LOG IN</button></a>

	</div>
	</div>

	<!-- Consent deepak-->
	<div class="modal fade terms_and_condition" id="TermsConditionKYC" tabindex="-1" role="dialog"
		aria-labelledby="TermsConditionKYCTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<?php $consent = fatch_consent(CONSENT[0]);
			if (isset($consent->title)) { ?>
				<div class="modal-content">
					<h2 class="heading"><?= $consent->title ?></h2>
					<p style="color:#000;" class="termsandnotes">Please read the following and provide your consent by
						clicking on “I Consent” button</p>
					<div class="modal-body">
						<main>
							<article class="terms-and-conditions">
								<?= $consent->content ?>
							</article>
						</main>
					</div>
					<div class="form-group text_terms" style="margin-top:15px;padding-left: 15px;">
						<!--<p class="notes">Note: Please refer clause No.__ in respect to Annual Subscription Fee
	of Rs. 7500 plus GST.</p>-->
						<div class="wrap_checkbox" style="margin-top:15px;">
							<!-- sanjay oraon 27/06/2023 changed check box id from CheckTerms to  AcceptTerm--->
						<input type="checkbox" class="form-check-input" id="AcceptTerm" name="CheckTerms">
						<label class="form-check-label" for="AcceptTerm">I Accept Terms and Condition</label>
						<div class="invalid-feedback text-danger AcceptTermError">
							You Must Accept Terms and Condition Before Submitting.
						</div>
						<!---------------- ------------->
					</div>
				</div>
				<div class="term-buttons-container">
					<a class="scroll-to-bottom" style="display:none;">
						<svg width="20" height="11" xmlns="http://www.w3.org/2000/svg"
							title="Go to bottom to accept terms and conditions">
							<title>Go to bottom to accept terms and conditions</title>
							<path
								d="M20 1.39L18.594 0 9.987 8.261l-.918-.881.005.005L1.427.045 0 1.414 9.987 11 20 1.39"
								fill="#fff" fill-rule="evenodd" />
						</svg>
					</a>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="accept-button btn-primary iconsent" style="padding:15px 10px">I
						Consent</button>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<!-- Terms and conditions -->
	<script>
		var baseUrl = '<?= base_url() ?>';
		const terms = document.querySelector(".terms-and-conditions");
		const termsLastElement = terms.lastElementChild;
		const scrollToBottom = document.querySelector(".scroll-to-bottom");
		const acceptButton = document.querySelector(".accept-button");

		scrollToBottom.addEventListener("click", function (e) {
			termsLastElement.scrollIntoView({
				block: "start",
				behavior: "smooth",
				inline: "nearest"
			});
		});

		function obCallback(payload) {
			if (payload[0].isIntersecting) {
				scrollToBottom.setAttribute("aria-hidden", true);
				acceptButton.setAttribute("aria-hidden", false);
				observer.unobserve(termsLastElement);
			}
		}
		const observer = new IntersectionObserver(obCallback, { root: terms, threshold: 0.1 });
		observer.observe(termsLastElement);
	</script>
	<!-- Terms and conditions -->
	<!-- I consent End Modal-->

	<?php $this->load->view('common/footer'); ?>
	<?php $this->load->view('common/footer_js'); ?>

	<script>
		$(document).ready(function () {
			$("#btn1").click(function () {
				$("#box").animate({ height: "300px" }, 500, function () {
					$(this).hide();
				});
			});
			$("#btn2").click(function () {
				$("#box").animate({ height: "300px" }, 500, function () {
					$(this).show();
				});
			});
		});
		$(".slide_click_2").on("click", function (event) {
			event.preventDefault();
			$("html, body").animate({ scrollTop: 0 }, "fast");
		});
		$('.verify_otp_back').click(function () {
			$('#otp_form').css("display", 'none');
			$('.slide_2_animation').css("display", "block");
		});

		$(document).ready(function () {
			$('input[type="password"]').keypress(function (event) {
				if (event.which === 32) {
					event.preventDefault();
				}
			});
		});

	</script>
</body>

</html>