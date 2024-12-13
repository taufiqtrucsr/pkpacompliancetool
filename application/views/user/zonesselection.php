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
				<div class="modal-header close-right">
					<!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
				</div>
				<div class="modal-body">
					<div class="popup-page" id="createanewgoal">
						<div class="popup-content">	
							<form name="frm_zones_selection" id="frm_zones_selection" action="<?php echo BASE_URL."user/zonesselection/"; ?>" method="POST">
								<div class="ini-screen-page"> 
									<h3>Which areas of your life you would like to improve ?</h3>
									<p>Select atleast 3 or more areas to include in your member profile</p>
									<div class="error_msg"></div>
									<ul class="form-checkbox checkbox-style">

										<?php if(isset($ZonesList) && count($ZonesList) > 0) { 
											foreach($ZonesList as $data) { ?>
												<li>
													<div>
														<input id="<?php echo 'zones_'.$data['id']; ?>" type="checkbox" name="zones[]" value="<?php echo $data['id']; ?>" <?php echo ($data['default_checked']==1) ? 'checked="checked"' : ''; ?>><label for="<?php echo 'zones_'.$data['id']; ?>"><span></span><?php echo $data['name']; ?></label>
													</div>
												</li>	
										<?php } } ?>
									</ul>
									<div class="button-set bottom-right">
										<!-- <input type="submit" class="btn-cancel" value="Cancel"> -->
										<input type="submit" name="zonesselectionbtn" id="zonesselectionbtn" class="btn-submit proceed" value="Proceed">
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

	
		
