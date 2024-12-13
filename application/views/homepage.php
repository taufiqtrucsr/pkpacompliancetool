<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('common/head_common'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo SKIN_URL; ?>css/home.css?v=<?php echo JS_CSC_V; ?>" media="all">
<style type="text/css">
	.skyblue-color {
     margin-top: 0px;
    }
	.outer {
	text-align: justify;
}
.outer img {
		display: inline-block;
vertical-align: center;
}
.outer .fix {
	width: 100%;
	height: 0;
		display: inline-block;
}
.img_ngo{			
		/* width:60px; */
		margin:auto;
	}
	.get-in-touch{
		background-color:#ffff;
	}

	
</style>
<?php 
//echo '<pre>';
//print_r($ProectListData);
//echo gettype($ProectListData);
//exit;
?>

 	<body class="home-index">
		<?php $this->load->view('common/home_header'); ?>
		
		<!-- <div class="home-banner" style="background-image:url('<?php //echo BANNER_IMAGE.$BannerData->banner_image;?>'); background-repeat:no-repeat;">
			<div class="container">
				<div class="banner-heading">
					<?php // echo $BannerData->description; ?>
				</div>
			</div>
		</div> -->
		<!-- home-banner -->
	<!--	<div class="home-banner home-banner-2" style="background-image:url('<?php //echo BANNER_IMAGE.$BannerData1->banner_image;?>'); background-repeat:no-repeat;background-size: cover;background-position-y: top;">
			<div class="container">
				<div class="banner-heading">
					<?php echo $BannerData1->description;?>
					<p><a class="blue-btn" href="#" onclick="submitDonationFormId()">Support COVID-19 Relief Work</a></p>
					<p><a class="blue-btn second-btn" href="<?php //echo base_url('donation'); ?>">Discover other Projects</a></p>
					</div>
			</div>
		</div>
		-->
		 <div class="home-banner home-banner-2 home-banner-new">
			<!--div class="blue-circle"></div-->
			<div class="overlay"></div>
			<div class="container">
				<div class="banner-heading">
					<h2><span class="color">C</span>ontributors!</h2>
					<p>Connect with <span class="color">I</span>mplementers - <span class="color">F</span>und <span class="color">P</span>rojects, <span class="color">E</span>ngage <span class="color">E</span>mployees, <span class="color">M</span>anage CSR </p>
					<div class="dual_btn">
						<div class="rows">
						<a class="blue-btn second-btn" href="#">Corporate CSR </a> 
						<span class="line"></span>
						<a class="blue-btn second-btn" href="#">Donate</a>
                        </div>
                    </div>
					<!--span style="color: #294ec0; text-shadow:none;">Transparent <br>Reliable <br>Utilitarian</span>
					<p class="orange-text">Spreading happiness together</p>
					<p><a class="blue-btn second-btn" href="https://www.trucsr.in/donation">Discover Projects</a></p>
					<p><a class="blue-btn second-btn" href="<?php echo base_url('donation'); ?>">Discover Projects</a></p-->
				</div>
			</div>
		</div>
		<div class="discover how-it-works">
<div class="container">
<div class="row">
<div class="col-sm-12">
<!-- Nav tabs -->
<ul class="nav nav-tabs">
<li class="bold">Discover:</li>
<li class="nav-item active"><a class="nav-link " href="#Contributors" data-toggle="tab" aria-expanded="true">CSR Funding Project</a></li>
<li class="nav-item"><a class="nav-link" href="#Partners" data-toggle="tab" aria-expanded="false"> Non-CSR Funding Project</a></li>
<li class="nav-item"><a class="nav-link" href="#Partners" data-toggle="tab" aria-expanded="false"> RFP</a></li>
<li class="nav-item"><a class="nav-link" href="#Partners" data-toggle="tab" aria-expanded="false"> Volunteering</a></li>
<li class="more"><a href="#">View More</a></li>
</ul>
<!-- nav-tabs --> <!-- Tab panes -->
<div class="tab-content">
<div id="Contributors" class="container tab-pane active in">
<div class="row">
<div class="col-md-4">
<div class="funding-project">
<div class="view_proj">
<img src="<?php echo SKIN_URL; ?>images/Tress_survive .png">
<span class="tag">CSR</span>
<span class="tag capital">Capital Asset</span>
</div>
<div class="proj_content">
<h2>Tress to Survive</h2>
<p>Sanjivani NGO</p>
<span class="sub_head">Project</span>
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
</div>
</div>
<ul class="funded">
	<li>50.5% Funded</li>
	<li>₹ 10,00,00,000</li>
</ul>
<ul class="funded location">
	<li><i class="fa fa-map-marker" aria-hidden="true"></i> Pune</li>
	<li><i class="fa fa-calendar-o" aria-hidden="true"></i> 1 Month</li>
</ul>
<a class="btn home_view" href="#">View Project</a>
</div>
</div>
</div>

<div class="col-md-4">
<div class="funding-project">
<div class="view_proj">
<img src="<?php echo SKIN_URL; ?>images/Tress_survive .png">
<span class="tag">CSR</span>
<span class="tag tax"><img src="<?php echo SKIN_URL; ?>images/tax-sav.png"> Tax Benefit</span>
</div>
<div class="proj_content">
<h2>Tress to Survive</h2>
<p>Sanjivani NGO</p>
<span class="sub_head">Project</span>
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
</div>
</div>
<ul class="funded">
	<li>50.5% Funded</li>
	<li>₹ 10,00,00,000</li>
</ul>
<ul class="funded location">
	<li><i class="fa fa-map-marker" aria-hidden="true"></i> Pune</li>
	<li><i class="fa fa-calendar-o" aria-hidden="true"></i> 1 Month</li>
</ul>
<a class="btn home_view" href="#">View Project</a>
</div>
</div>
</div>

<div class="col-md-4">
<div class="funding-project">
<div class="view_proj">
<img src="<?php echo SKIN_URL; ?>images/Tress_survive .png">
<span class="tag">CSR</span>
<span class="tag tax"><img src="<?php echo SKIN_URL; ?>images/tax-sav.png"> Tax Benefit</span>
</div>
<div class="proj_content">
<h2>Tress to Survive</h2>
<p>Sanjivani NGO</p>
<span class="sub_head">Project</span>
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
</div>
</div>
<ul class="funded">
	<li>50.5% Funded</li>
	<li>₹ 10,00,00,000</li>
</ul>
<ul class="funded location">
	<li><i class="fa fa-map-marker" aria-hidden="true"></i> Pune</li>
	<li><i class="fa fa-calendar-o" aria-hidden="true"></i> 1 Month</li>
</ul>
<a class="btn home_view" href="#">View Project</a>
</div>
</div>
</div>
</div>
</div>
<!-- Contributors -->
<div id="Partners" class="container tab-pane fade"><br>
<div class="row">
<div class="col-md-4">
<div class="funding-project">
<div class="view_proj">
<img src="<?php echo SKIN_URL; ?>images/Tress_survive .png">
<span class="tag">CSR</span>
<span class="tag capital">Capital Asset</span>
</div>
<div class="proj_content">
<h2>Tress to Survive</h2>
<p>Sanjivani NGO</p>
<span class="sub_head">Project</span>
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
</div>
</div>
<ul class="funded">
	<li>50.5% Funded</li>
	<li>₹ 10,00,00,000</li>
</ul>
<ul class="funded location">
	<li><i class="fa fa-map-marker" aria-hidden="true"></i> Pune</li>
	<li><i class="fa fa-calendar-o" aria-hidden="true"></i> 1 Month</li>
</ul>
<a class="btn home_view" href="#">View Project</a>
</div>
</div>
</div>

<div class="col-md-4">
<div class="funding-project">
<div class="view_proj">
<img src="<?php echo SKIN_URL; ?>images/Tress_survive .png">
<span class="tag">CSR</span>
<span class="tag tax"><img src="<?php echo SKIN_URL; ?>images/tax-sav.png"> Tax Benefit</span>
</div>
<div class="proj_content">
<h2>Tress to Survive</h2>
<p>Sanjivani NGO</p>
<span class="sub_head">Project</span>
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
</div>
</div>
<ul class="funded">
	<li>50.5% Funded</li>
	<li>₹ 10,00,00,000</li>
</ul>
<ul class="funded location">
	<li><i class="fa fa-map-marker" aria-hidden="true"></i> Pune</li>
	<li><i class="fa fa-calendar-o" aria-hidden="true"></i> 1 Month</li>
</ul>
<a class="btn home_view" href="#">View Project</a>
</div>
</div>
</div>

<div class="col-md-4">
<div class="funding-project">
<div class="view_proj">
<img src="<?php echo SKIN_URL; ?>images/Tress_survive .png">
<span class="tag">CSR</span>
<span class="tag tax"><img src="<?php echo SKIN_URL; ?>images/tax-sav.png"> Tax Benefit</span>
</div>
<div class="proj_content">
<h2>Tress to Survive</h2>
<p>Sanjivani NGO</p>
<span class="sub_head">Project</span>
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
</div>
</div>
<ul class="funded">
	<li>50.5% Funded</li>
	<li>₹ 10,00,00,000</li>
</ul>
<ul class="funded location">
	<li><i class="fa fa-map-marker" aria-hidden="true"></i> Pune</li>
	<li><i class="fa fa-calendar-o" aria-hidden="true"></i> 1 Month</li>
</ul>
<a class="btn home_view" href="#">View Project</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
		<div class="we-platform">
			<p>A Web Platform for Contributors & Implementers to plan, execute, track and <br>manage CSR initiatives across multiple projects and geographies.</p>
		</div>
		<div class="our-services-n container">
			<div class="row">
				<div class="col-sm-12">
					<h2>Our Services</h2>
					<div class="col-sm-6"><h3>Contributor (Corporate)</h3>
						<ul class="list-services-new">
							<li>
								<span class="ser-icons-new"><img src="https://www.trucsr.in/skin/images/CSR_Compliance.svg"></span>
								<p>CSR Advisory <br>& Compliance</p>
							</li>
							<li>
								<span class="ser-icons-new"><img src="https://www.trucsr.in/skin/images/Find_Projects.svg"></span>
								<p>Find Implementing <br>Agencies</p>
							</li>
							<li>
								<span class="ser-icons-new"><img src="https://www.trucsr.in/skin/images/Fund_Projects.svg"></span>
								<p>Fund Projects</p>
							</li>
							<li>
								<span class="ser-icons-new"><img src="https://www.trucsr.in/skin/images/monitor_Projects.svg"></span>
								<p>Monitoring <br>& Reporting</p>
							</li>
						</ul>
					</div>
					<div class="col-sm-6"><h3>Implementer (NGO)</h3>
						<ul class="list-services-new">
							<li>
								<span class="ser-icons-new"><img src="https://www.trucsr.in/skin/images/Showcase-projects.svg"></span>
								<p>Showcase Projects</p>
							</li>
							<li>
								<span class="ser-icons-new"><img src="https://www.trucsr.in/skin/images/lock-security-safety.svg"></span>
								<p>Secure  Funding</p>
							</li>
							<li>
								<span class="ser-icons-new"><img src="https://www.trucsr.in/skin/images/Upload-reports.svg"></span>
								<p>Upload Reports</p>
							</li>
							<li>
								<span class="ser-icons-new"><img src="https://www.trucsr.in/skin/images/Statutory-Accounting.svg"></span>
								<p>Statutory, Accounting <br>& Admin Services</p>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Section 3 Recently Added Projects Start -->
		<?php if (!empty($ProectListData)) { ?>
		<div class="skyblue-color">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="title">
							<h4 class="small-head-cap">Recently Added Projects</h4>
						</div>
						
						
						<div class="discover-block">
							<ul class="project-cards campaign-donated-cards projecr-page-list">
								<?php foreach($ProectListData as $value) {	
									/*
										sanjay oraon
										removed identifier
										$href = BASE_URL.'donor-project-details/'.$value['identifier'].'/';
									*/
									$href = BASE_URL.'donor-project-details/'.$value['id'].'/';	
								?>
								<li class="project-card" id="project-list-<?php echo $value['id']; ?>">
									<a href="<?php echo $href;?>" title="<?php echo $value['project_name']; ?>">
										<div class="card-main-wrap">
											<div class="card-image-wrap">
											<!--
												sanjay oraon
												removed cover_image
												<img src="<?php echo PRO_COVER_IMG_URL.$value['cover_image']; ?>" alt="" class="card-image" />
											-->
												<img src="#" alt="" class="card-image" />
												<?php if($value['tax_benefit']==1){ ?>
												<span class="card-tag tax-benefit">Tax Benefit</span>
												<?php }?>
												<?php if($value['project_type']==1){ ?>
												<span class="card-tag">Project</span>
												<?php }else if($value['project_type']==2) { ?>
												<span class="card-tag">Program</span>
												<?php } ?>
											</div>
											<div class="card-body-wrap">
												<div class="col-sm-12">
													<div class="col-sm-2 project-card-logo">
														<!--
															sanjay oraon
															removed org_logo
															<img src="<?php echo NGO_LOGO.$value['org_logo']; ?>" alt="<?php echo $value['project_name']; ?>" />
														-->
														<img src="" alt="<?php echo $value['project_name']; ?>" />
													</div>
													<div class="col-sm-10 project-name-card">
														<?php $sector = $this->MotivatorModel->getSectors($value['sectors']);?>
														<span class="card-top-light-text"><?php echo implode(' | ',$sector);?></span>
														<span class="card-projecttype project"><?php echo $value['project_name']; ?></span>
														<span class="fund-raisers">By <?php echo $value['org_name']; ?></span>
														<?php
														/*
															sanjay oraon
															removed csr_num due to table not exist
														*/
														/*if($value['csr_num']!='' && $value['csr_num']!='NA' ){
															echo '<span class="fund-raisers">CSR Reg No : '.'CSR'. strtoupper(substr(base64_decode($value['csr_num']),0,8));	
														}else{
															echo "<span><br></span>";
														}
														echo strtoupper(substr(base64_decode($value['csr_num']),0,11))?'CSR.'' strtoupper(substr(base64_decode($value['csr_num']),0,11))':'kumarp';
														*/
														?>
													</div>
												</div><!-- col-sm-12 -->
							
												<div class="col-sm-12 campaign-duration-box">
													<div class="col-sm-8">
														<?php 
														/*
															sanjay oraon
															removed project_type due to  field not exist
															if($value['project_type']==1){
														
														*/
														if(isset($value['project_type'])){ ?>
														<?php
														$date1 = $value['project_date_from'];
														$date2 = $value['project_date_to'];							
														$get_interval_in_month = $this->CommonModel->get_interval_in_month($date1, $date2);		
														?>
														<p class="small-light-text">Project duration (<strong><?php echo ($get_interval_in_month>1) ? $get_interval_in_month.' months': $get_interval_in_month.' month';?></strong>)</p>
														<p class="cammpaign-dates"> <?php echo date('d M Y',$date1); ?> - <?php echo date('d M Y',$date2); ?></p>
														<?php }else{ ?>
															<!--
															sanjay oraon
															removed target_frequency due to  field not exist
															<p class="small-light-text"><?php echo $value['target_frequency'];?></p>
															-->
														<?php } ?>
													</div>
													<!--
															sanjay oraon
															removed project_rating due to  field not exist
															<div class="col-sm-4 star-rating">
																<div class="card-text starrating">
																<?php 
																		$starrd = $value['project_rating']; 
																		if($starrd > 0) { 
																			$star_no = round($starrd, 2);
																			echo "<span class='star-no'>".$star_no."</span>";
																			echo ' <img src="'.SKIN_URL.'images/star.png">';
																		}else{ echo ""; }
																	?>
																</div>
															</div>
													-->
												</div><!-- campaign-duration-box -->
							
												<?php 
													$getTotalDonatedAmtofAllProjects = $this->DonorModel->getTotalDonatedAmt($value['id']);
													$totalDonationAmt = $value['total_project_cost'];
													/*
														sanjay oraon
														removed alrecd_committed_amount,alrecd_committed_amount_trucsr,contract_fund_received due to  field not exist
														$totalFundingAmt= ($value['alrecd_committed_amount']) + ($value['alrecd_committed_amount_trucsr']) + ($value['contract_fund_received']) + ($getTotalDonatedAmtofAllProjects->total_donation_amount);
													*/
													$totalFundingAmt=  ($getTotalDonatedAmtofAllProjects->total_donation_amount);
													$progressPercent=$this->CommonModel->getPercentOfNumber($totalDonationAmt,$totalFundingAmt);
												?>
							
												<div class="card-text percent-budget">
													<!-- <p class="card-text budget"><i class="fa fa-inr"></i> 10,00,000</p> -->
													<p class="card-text budget"><?php echo $this->CommonModel->numberToCurrency($totalFundingAmt); ?></p>
													<p class="card-text budget"><?php echo $this->CommonModel->numberToCurrency($value['total_project_cost']); ?></p>
												</div><!-- percent-budget -->
												
												<div class="card-text progress">
													<div class="progress-bar" role="progressbar" aria-valuenow="70"
													aria-valuemin="0" aria-valuemax="100" style="width:<?php echo ($progressPercent > 0)?$progressPercent:0;?>%">
													<span class="sr-only"><?php echo ($progressPercent > 0)?$progressPercent:0;?>% Complete</span>
												</div>
											</div><!-- progress -->
											
											<div class="card-text percent-budget">
												<p class="card-text percent"><?php echo ($progressPercent > 0)?$progressPercent:0;?>% Funded</p>
												<p class="card-text budget">Min Don. ₹100</p>
												<!-- <p class="card-text budget">Min < ?php echo $this->CommonModel->numberToCurrency($value['min_donation_amt']); ?></p> -->
												</div>
							
												<div class="card-text location-duration">
												<?php 
												 $state = $this->MotivatorModel->getState($value['state']);
												 ?>
													<h4 class="card-text location"><?php echo $value['city']; ?>, <?php echo implode(' | ',$state);?></h4>
												</div><!-- location-duration-->
											</div>
										</div>
									</a>
								</li>
							
								<?php } ?>
							</ul>	
								
							<p><a class="blue-btn-discover" target="_blank" href="<?php echo BASE_URL.'donation'?>" role="button"> Discover All Projects </a></p>						
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Section 3 Recently Added Projects End-->
		<?php } ?>
	
		<!-- Section 2 -->
		<?php if(isset($HomePageBlock1->content)) echo $HomePageBlock1->content; ?>
		
		<!-- Section 4 -->	
		<?php if(isset($HomePageBlock2->content)) echo $HomePageBlock2->content; ?>
	
		<!-- how it works section -->
		<?php if(isset($HomePageBlock3->content)) echo $HomePageBlock3->content; ?>
	

		<!-- Impact Created Start -->
		<div class="container">
		   <div class="row">
				<div class="impactbox">
					<div class="title">
						<h4 class="small-head-cap">Impact Created </h4>
					</div>
					<div class="col-sm-12 imgbox-content">
						<div class="col-md-6 imgbox-left">
							 <img src="<?php echo SKIN_URL; ?>images/impact.png">
						</div>
						
						<div class="col-md-6">
							<div class="contentbox-right">
								<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-6 ngoregisteredcount">
										<p class="blue-text"><?php echo $ngoUserCount->ngoCount; ?>+</p>
										<p>Implementers Registered</p>
									</div>
						 
									<div class="col-sm-6 ngoregisteredcount">
										<p class="blue-text"><?php echo $companyUserCount->companyCount; ?>+</p>
										<p>Contributors Registered</p>
									</div>
								</div>
								</div>
								
								<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-6 ngoregisteredcount">
										<!--p class="blue-text"><?php //echo $completedProjectsCount->completedproCount; ?></p>
										<p>Projects Completed</p-->
										<p class="blue-text"><?php echo $allProjectsCount->allProCount; ?>+</p>
										<p>Total no. of Projects registered</p>
									</div>
					   
									<div class="col-sm-6 ngoregisteredcount">
										<p class="blue-text"><?php echo $sectorCount; ?>+</p>
										<p>Sectors Covered</p>
									</div>
								</div>
								</div>
								
								<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-6 ngoregisteredcount">
										<!-- <p class="blue-text">8254</p> -->
										<p class="blue-text">5000+</p>
										<!-- <p class="blue-text"><?php echo $beneficiariesCount; ?>+</p> -->
										<p>Beneficiaries Impacted</p>
									</div>
									<?php
										$finalVal= 0;
										//$totalAmt = ($fundRaised->totalReceivedAmt + $fundRaised->totalReceivedAmtTruCSR + $fundRaised->totalContractAmt);
										
										/*
											sanjay oraon
											removed  $totalAmt due to some fields not exist in table
											$totalAmt = $fundRaised->totalReceivedAmtTruCSR + $fundRaised->totalCrowdFundAmt;
										*/
										$totalAmt = 0;
										$val = ($totalAmt)/100000;
										$val = round($val,2);
										if($val > 1)
											$finalVal = $val;
									?>
									<div class="col-sm-6 ngoregisteredcount">
										<p class="blue-text"><i class="fa fa-inr"></i><?php echo $val.' Lakhs'; ?>+</p>
										<p>Funds Raised</p>
									</div>
								</div>
								</div>
							</div><!-- contentbox-right -->
						</div>
					</div><!-- imgbox-content -->
				</div><!-- impactbox -->
			</div>
		</div>		
		<!-- Impact Created End -->

		<!-- code for work with our ngo section  -->
		<div style="background-color:#D5E4F6;margin-bottom:32px;" >
			<div class="outer" style="margin:0px 20px;">
				<img src="<?php echo base_url();?>skin/images/jeevan_jyot.png" class="img_ngo" width="60px;" style="padding-bottom:36px;">
				<img src="<?php echo base_url();?>skin/images/panpalia.png" class="img_ngo" width="110px;">
				<img src="<?php echo base_url();?>skin/images/grak_vikas_trust.png" class="img_ngo" width="120px;" style="margin-left:-64px;padding-bottom:38px;">
				<img src="<?php echo base_url();?>skin/images/turnstone.png" class="img_ngo" width="80px;">
				<img src="<?php echo base_url();?>skin/images/granules.png" class="img_ngo" width="100px;" style="margin-right:141px;padding-bottom:40px;">
				
					<span class="fix"></span>
			</div>
			<div class="outer" style="margin:-39px 20px;">
				<img src="<?php echo base_url();?>skin/images/nimkartek.png" class="img_ngo" style="margin-left:120px;" width="65px;">
				<img src="<?php echo base_url();?>skin/images/quantiphi.png" class="img_ngo" style="margin-left:57px;" width="125px;">
				<img src="<?php echo base_url();?>skin/images/ramkrishna_mission_ashram.png" class="img_ngo" style="margin-left:150px;" width="60px;">
				<img src="<?php echo base_url();?>skin/images/sri_aurobindo_society.png" class="img_ngo" style="margin-left:120px;" width="120px;">
				<img src="<?php echo base_url();?>skin/images/vishwa_yuvak_kendra.png" class="img_ngo" style="margin-left:90px;" width="120px;">
				<span class="fix"></span>
			</div>
		</div>
		<!-- code for with our ngo section ends here -->
		
		<!-- get-in-touch -->
		<?php if(isset( $HomePageBlock4->content)) echo $HomePageBlock4->content; ?>
		
		<input type="hidden" name="donateAmount" id="donateAmount" value="100">
	
		
		<?php $this->load->view('common/footer'); ?>
		<?php $this->load->view('common/footer_js'); ?>	
		
		<?php if(isset($_SESSION['UserId'])){
			$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);				
		}
		?>
		
		<form name="formId" id="formId" method="POST" action="<?php echo base_url('donation'); ?>">
			<input type="hidden" name="sector_value" value="Pandemic Relief"/>
		</form>	
		<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
		<script language="javascript" type="text/javascript">
		    function submitDonationFormId() {
		       jQuery("#formId").submit();
		    }
		</script>
		<script type="text/javascript">
		jQuery(document).on('click', '#donate-pay-btn', function (e) {
			console.log("Loaded donate payment");
			//var total = (jQuery('form#payment-form').find('input#donateAmount').val() * 100);
			var total = 100 * 100;
			console.log(total);
			var merchant_total = total;
			var currency_code_id = 'INR';
			var key_id = "<?php echo RAZOR_KEY_ID; ?>";
			var store_name = 'truCSR';
			var store_description = 'Payment';
			var store_logo = '<?php echo SKIN_URL;?>images/truCSR_logo.png';
			var email = '<?php echo isset($UserDetails)?$UserDetails->email:"";?>';
			var phone = '<?php echo isset($UserDetails)?$UserDetails->phone_no:"";?>';
			payableAmount = 100;
			
			var razorpay_options = {
				key: key_id,
				amount: merchant_total,
				name: store_name,
				description: store_description,
				//image: store_logo,
				netbanking: true,
				currency: currency_code_id,
				prefill: {
					email: email,
					contact: phone
				},
				/*notes: {
					soolegal_order_id: merchant_order_id,
				},*/
				handler: function (transaction) {
					console.log(transaction)
					jQuery.ajax({
						url:BASE_URL+"DonorPayment/callback",
						type: 'post',
						data: {razorpay_payment_id: transaction.razorpay_payment_id, currency_code_id: currency_code_id,merchant_total: merchant_total,payableAmount:payableAmount}, 
						dataType: 'json',
						success: function (response) {
							if(response.flag == 1) {
								// $.toast({
									// heading: '',
									// text: response.msg,
									// showHideTransition: 'slide',
									// icon: 'success'
								// })
								
								//var noHashURL = window.location.href.replace(/#.*$/, '');
							  
								/*setTimeout(function() {
										window.location.href =noHashURL+'#status';
										location.reload();
								});*/
								setTimeout(function() {
									window.location.href =response.redirect;
								}); 
								
						
							}else{

								$.toast({
									heading: '',
									text: response.msg,
									showHideTransition: 'slide',
									icon: 'error'
								  })
								  setTimeout(function() {                        
								  }, 1000);

							}
						}
					});
				},
				"modal": {
					"ondismiss": function () {
						// code here
						//location.reload()
					}
				}
			};
			// obj        
			var objrzpv1 = new Razorpay(razorpay_options);
			objrzpv1.open();
				e.preventDefault();
					
		});
		</script>
 	</body>
</html>