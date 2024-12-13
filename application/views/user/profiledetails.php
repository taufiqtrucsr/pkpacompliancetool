<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('common/head_common'); ?>

 <body class="newuser-home-index">
	<?php $this->load->view('common/header'); ?>

	<div class="main-wrapper ">
		<div class="main-container clearfix">
			<div class="block-main">
			<div class="left-section">				
				<?php $this->load->view('common/profile_cover_section'); ?>
				<div class="left-in-main">
					<div class="select-box">
						<span class="arrow-dn">
							<i class="fa fa-angle-down"></i>
						</span>
						<select class="select-info days">
							<option value="Today" selected>This Week</option>
							<option value=""></option>
						</select>
					</div>
				</div>
			</div>
			<div class="right-section">
				<div class="section-table">
					<div class="right-main content-welocme">
						<p>Welcome to the ZonesPro!<p>
						<p>We are excited to have you here</p>
						<div class="button-set button-createnew">
							<a href="#" class="button btn-style" data-toggle="modal" data-target="#lightbox">+ Create a new goal</a>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade in" id="creategoal-2" style="display: block">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
					<h4 class="modal-title">Profile Details</h4>
				</div>
				<div class="modal-body">
					<div class="popup-page" id="createanewgoal">
						<div class="popup-content">	

						<form name="frm_profile_details" id="frm_profile_details" action="<?php echo BASE_URL."user/profiledetails/"; ?>" method="POST">
							<div class="ini-screen-page"> 
								<!-- <h1>Profile Details</h1> -->
								<div class="error_msg"></div>
								<?php if($UserDetails->name != '') { ?>
									<input type="hidden" name="name" id="name" value="<?php echo $UserDetails->name; ?>">
								<?php } ?>
								<?php if($UserDetails->gender != '') { ?>
									<input type="hidden" name="gender" value="<?php echo $UserDetails->gender; ?>">
								<?php } ?>
								<ul class="form-create-page first-popup">
									<?php if($UserDetails->name == '') { ?>
									<li>
										<div class="field-row">
											<input type="text" name="name" id="name" value="" maxlength="255" placeholder="Full Name" class="full-name text-input">
										</div>
									</li>
									<?php } ?>
									<li>
										<div class="field-row select-box">
											<span class="arrow-dn">
												<i class="fa fa-angle-down"></i>
											</span>
											<select name="country" id="country" class="select-info country">
												<option value="" selected>Select Country</option>
												<?php if(isset($CountriesList) && count($CountriesList) > 0) { 
													foreach($CountriesList as $data) { ?>
														<option value="<?php echo $data['country_code']; ?>" <?php echo $data['country_code']=='IN' ? "selected='selected'" : ''; ?>><?php echo $data['country_name']; ?></option>
												<?php } } ?>
											</select>
										</div>
									</li>
									<?php if($UserDetails->gender == '') { ?>
									<li class="gender-block radio-style"><i>Gender</i>
										<div><input id="gender_female" type="radio" name="gender" value="female" checked="checked" class="gender"><label for="gender_female"><span><span></span></span>Female</label></div>
										<div><input id="gender_male" type="radio" name="gender" value="male" class="gender"><label for="gender_male"><span><span></span></span>Male</label></div>
									</li>
									<?php } ?>
									<li class="clearfix dob">
										<em>DOB</em>
										<div class="lfloat select-box">
											<span class="arrow-dn">
												<i class="fa fa-angle-down"></i>
											</span>
											<?php
											echo '<select name="dob_day" id="dob_day" class="select-info dd">';
											  echo '<option value="">DD</option>';
												for($i = 1; $i <= 31; $i++){
												  $i = str_pad($i, 2, 0, STR_PAD_LEFT);
													echo "<option value='$i'>$i</option>";
												}
											echo '</select>';
											?>
										</div>
										<span class="slach-breaker">/</span>
										<div class="lfloat select-box">
											<span class="arrow-dn">
												<i class="fa fa-angle-down"></i>
											</span>
											<?php							
											echo '<select name="dob_month" id="dob_month" class="select-info mm">';
												echo '<option value="">MM</option>';
												for($i = 1; $i <= 12; $i++){
												  $i = str_pad($i, 2, 0, STR_PAD_LEFT);
													echo "<option value='$i'>$i</option>";
												}
											echo '</select>';
											?>
										</div>
										<span class="slach-breaker">/</span>
										<div class="lfloat select-box">
											<span class="arrow-dn">
												<i class="fa fa-angle-down"></i>
											</span>
											<?php							
											echo '<select name="dob_year" id="dob_year" class="select-info yy">';
											  echo '<option value="">YYYY</option>';
												for($i = (date('Y')-13); $i >= date('Y', strtotime('-100 years')); $i--){
												  echo "<option value='$i'>$i</option>";
												} 
											echo '</select>';						
											?>
										</div>
									</li>
								</ul>
								<div class="button-set bottom-right">
									<input type="submit" name="profiledetailsbtn" id="profiledetailsbtn" value="Submit" class="button submit3">
								</div>
								
							</div><!-- ini-screen-page -->
						</form>
					</div><!-- popup-content -->
					</div><!-- popup-page -->
				</div><!-- modal-body -->
			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->

	<?php $this->load->view('common/footer'); ?>
	<div class="modal-backdrop fade in"></div>
	
	<?php $this->load->view('common/footer_js'); ?>	
 </body>
</html>