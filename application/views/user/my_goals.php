<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($UserDetails);
?>

<?php $this->load->view('common/head_common'); ?>

 <body class="newuser-home-index">
	<?php $this->load->view('common/header'); ?>
	<div class="main-wrapper ">
		<div class="main-container clearfix">
			<div class="block-main">
			<div class="left-section">
				<?php $this->load->view('common/profile_cover_section'); ?>
				<div class="left-in-main" id="goal-left-section">
					<div class="select-box">
						<span class="arrow-dn">
							<i class="fa fa-angle-down"></i>
						</span>
						<select class="select-info days">
							<option value="Last week">Last week</option>
							<option value="This week" selected>This week</option>
							<option value="Next week">Next week</option>
						</select>
					</div>
				</div>
			</div>
			<div class="right-section" id="goal-right-section">
				<div class="section-table">
					<div class="right-main content-welocme">
						<p>Welcome to the ZonesPro!<p>
						<p>We are excited to have you here</p>
						<div class="button-set button-createnew">
							<a href="#" class="button btn-style" data-toggle="modal" data-target="#createanewgoal">+ Create a new goal</a>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('common/footer'); ?>
	<?php $this->load->view('user/create_goal_popup'); ?>	
	<script type="text/javascript" src="<?php echo SKIN_URL;?>js/goal.js"></script>	
	<?php $this->load->view('common/footer_js'); ?>

 </body>
</html>

	
		
