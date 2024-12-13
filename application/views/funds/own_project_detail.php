<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('common/head_common'); ?>

<body class="organisation-main-steps Create-Project-step own-project-new">
	<?php $this->load->view('common/header'); ?>
	<div class="container">
		<?php echo $breadcrumbs;?>
	</div>	
	<div id="contractDetailsBlock">
		<div class="container" >
			<div class="col-md-12">
				<div class="kyc-title"> <h2><?php echo $projectData->project_name;?></h2></div>
				<ul class="nav nav-tabs project-inside-tab">
					<li class="active"><a data-toggle="tab" href="#info">Project Info</a></li>
					<li><a data-toggle="tab" href="#reports" onclick="showProjectReport('<?php echo $projectData->id;?>');">Reports</a></li>
					<li><a data-toggle="tab" href="#contracts" id="contract">Contracts</a></li>
					<li><a data-toggle="tab" href="#status">Funding Status</a></li>
				</ul>
				
				<div id="info" class="project-det-sec-contri fade in active">
				<div class="need-support"><a class="border-btn" href="mailto:support@trucsr.in"> Need Support?</a></div>
				<?php if($orgStatus == 1 && $ngoUserDetails->status == 8 && $orgType == 2){?>
					<div class="project-detail-freezed verfication-block error">
						<span>The project is under verification.</span>
						<span><a onclick="openFreezedInfoPopup();" class="verify">Get more details</a></span>		
					</div>
				<?php } ?>	
				<div class="col-sm-12">
				<?php if(isset($projectGalleryData) && count($projectGalleryData)>1){?>
							<div id="gallery-carousel" class="owl-carousel owl-theme">
									<?php
									//echo '<pre>';print_r($projectGalleryData);
									$item_class = ' active';
									foreach ($projectGalleryData as $value): 
									?>
									<div class="item">
										<img src="<?php echo PRO_GALLERY_IMG_URL.$value->image;?>" width="322" height="282"/>
									</div>
									<?php  
										$item_class = '';
									endforeach;
									?>
							</div>
					<?php } ?>
				<div class="col-sm-8">
					
					<div  class="box-sec no-border mar-bot-zero">
						<p class="project-name"> <?php echo $projectData->project_name;?></p>
						<p class="project-short_desc"> <?php echo $projectData->project_short_description;?></p>
					</div>
					
					<div class="project-details-right-listing col-sm-10">
					<p class="project-desc com-list-det tb"><span>Tax Benefit</span> <span class="right-loc"> <?php if($ngoDetails->org_80g_file != '' && $ngoDetails->officialseal_file != '' && $ngoDetails->signature_file != '') echo "Yes"; else echo "No";?> </span></p>	
						
					<p class="project-desc com-list-det lc"><span>Location</span> <span class="right-loc"><?php echo $projectData->district.', '.$projectData->city;?></span></p>
					<?php
					$date1 = $projectData->project_date_from;
					$date2 = $projectData->project_date_to;							
					$get_interval_in_month = $this->CommonModel->get_interval_in_month($date1, $date2);		
					?>
					<p class="project-desc com-list-det dr"><span>Duration</span> <span class="right-loc"><?php echo ($get_interval_in_month>1) ? $get_interval_in_month.' months': $get_interval_in_month.' month';?></span></p>
					<?php $sectors = $this->ProjectModel->getSectors($projectData->sectors);?>
					<p class="project-desc com-list-det ss"><span>Sector(s)</span> <span class="right-loc"><?php echo implode(', ',$sectors);?></span></p>
					<?php $beneficiaries = $this->ProjectModel->getBeneficiaries($projectData->beneficiaries);?>
					<p class="project-desc com-list-det bn"><span>Beneficiaries</span> <span class="right-loc"><?php echo implode(', ',$beneficiaries);?></span></p>
					<p class="project-desc com-list-det pc"><span>Project Cost</span> <span class="right-loc"><?php echo $this->CommonModel->numberToCurrency($projectData->total_project_cost); ?></span></p>
					<p class="project-desc com-list-det md"><span>Minimum Donation</span> <span class="right-loc"><?php echo $this->CommonModel->numberToCurrency($projectData->min_donation_amt); ?></span></p>
					</div>
					
					<div  class="box-sec">
						<p class="pro-desc-bold">Description</p>
						<!-- class="project-desc"> <?php //echo $projectData->project_description;?></p-->
						<div class="project-desc"> <?php echo $projectData->project_description;?></div>
					</div>
					<div  class="box-sec">
						<p class="pro-desc-bold">Problem Statement</p>
						<!--p class="project-desc"> <?php //echo $projectData->problem_statement;?></p-->
						<div class="project-desc"> <?php echo $projectData->problem_statement;?></div>
					</div>
					

					<div class="box-sec">
					<p class="pro-desc-bold">Project Goal</p>
					<p class="project-desc">This project will accomplish these additional goals</p>
					
					<?php foreach($projectGoalsData as $value){?>
					<div id="goal_block">
						<?php if($value->image != ''){ ?>
						<div class="goal-image">
							<?php 
								$ext = pathinfo(PRO_GOAL_IMG_PATH.$value->image, PATHINFO_EXTENSION);
								if($ext == 'pdf'){
									$goalImage=SKIN_URL.'images/pdf-icon.png';
								}else{
									$goalImage=PRO_GOAL_IMG_URL.$value->image;
								}
							?>
							<img src="<?php echo $goalImage;?>" width="100" height="100">
						</div>
						<?php }?>
						<div class="goal-info">
							<p class="goal-title"><?php echo $value->name;?></p>
							<!--p class="goal-desc"><?php //echo $value->description;?></p-->
							<div class="goal-desc"><?php echo $value->description;?></div>
						</div>
					</div>
					<?php } ?>
					</div>
					
					<?php if($projectData->sdgs != "") { ?>
					<div class="box-sec">
					<p class="sus">Sustainable Development Goals</p>
						<div class="Sustainable-img">
						<?php 
							$SDGs = $this->ProjectModel->getSDGs($projectData->sdgs);
							if(isset($SDGs) && count($SDGs)>0){
								foreach($SDGs as $value){ ?>
									<img src="<?php echo PRO_SDGS_IMG_URL.$value; ?>" class="g-sdgs-img" width="100" height="100">	
						<?php	}
							}
						?>
						
						</div>
					</div>
					<?php } ?>
				
					<div class="ngo-info">
						<div class="cover-img">
							<?php
							if($ngoDetails->org_logo != ''){
								$ext = pathinfo(NGO_LOGO_PATH.$ngoDetails->org_logo, PATHINFO_EXTENSION);
								if($ext == 'pdf'){
									$imageSrc=SKIN_URL.'images/pdf-icon.png';
								}else{
									$imageSrc=NGO_LOGO.$ngoDetails->org_logo;
								}
							?>
							<img src="<?php echo $imageSrc; ?>" width="100" height="100">
							<?php } ?>
						</div>
						<div class="abt-org">
							<?php echo $ngoDetails->about_org;?>
						</div>
					</div>
					
				</div>
				</div>
				</div>
				<div id="reports" class="fade create-report-sec fade in">
					<!--div class="need-support"><a class="border-btn" href="#"> CREATE OWN REPORT</a></div-->
					<div id="report_div" style="display:none">
							<ul class="nav nav-tabs  project-inside-tab">
								<li class="active"><a data-toggle="tab" class="contract-tab" href="#due-report"
										aria-expanded="true">Due </a></li>
								<li class=""><a data-toggle="tab" class="contract-tab" href="#draft-report"
										aria-expanded="false">Draft </a></li>
								<li class=""><a data-toggle="tab" class="contract-tab" href="#submitted-report"
										aria-expanded="false">Submitted </a></li>
							</ul>

							<div id="due-report" class="fade active in contract-list overflow-table blue-table">
							</div>

							<div id="draft-report" class="fade contract-list overflow-table blue-table" style="">
							</div>

							<div id="submitted-report" class="fade contract-list overflow-table blue-table" style="">
							</div>
					</div>
				</div>	
				<div id="contracts" class="fade">
					<div class="need-support"><a class="border-btn" href="mailto:support@trucsr.in"> Need Support?</a></div>
					<?php /*if($orgStatus == 1 && $ngoUserDetails->status == 8 && $orgType == 2){?>
						<div class="project-detail-freezed verfication-block error">
							<span>The project is under verification.</span>
							<span><a onclick="openFreezedInfoPopup();" class="verify">Get more details</a></span>		
						</div>
					<?php }*/ ?>	
					<ul class="nav nav-tabs project-inside-tab">
						<li class="active"><a data-toggle="tab" href="#received">Awaiting Digital Signature</a></li>
						<li><a data-toggle="tab" href="#sent">All signed contracts</a></li>
						<li><a data-toggle="tab" class="contract-tab" href="#payslip"><?php echo ($orgType == 1)?'80G certifcates':'Payslips';?></a></li>
						<div class="download-btn-sec"><a class="downlod-a-btn border-btn" href="javascript:void(0)" onclick="downloadAllContracts();"> Download All </a></div>
					</ul>
					<?php include('unsigned_contract_tab.php');?> 
					<?php include('signed_contract_tab.php');?>
					<?php include('payslip_tab.php');?>
				</div>	
				<div id="status" class="fade fund-status-no-graph">
					<div class="need-support"><a class="border-btn" href="mailto:support@trucsr.in"> Need Support?</a></div>
					<?php /*if($orgStatus == 1 && $ngoUserDetails->status == 8 && $orgType == 2){?>
						<div class="project-detail-freezed verfication-block error">
							<span>The project is under verification.</span>
							<span><a onclick="openFreezedInfoPopup();" class="verify">Get more details</a></span>		
						</div>
					<?php }*/ ?>

					<?php include('funding_status_details.php');?>
					
				</div>	
			</div>	
		</div>	
		
		<div class="full-width white-bg">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-6">	
					<?php if($orgStatus == 1 && $ngoUserDetails->status == 1 && $orgType == 2){?>
					<a href="<?php echo BASE_URL ?>fund-project/<?php echo $projectData->identifier;?>/"><button class="btn btn-primary btn-lg">Fund Again</button></a>
					<?php }else{ ?>
					<?php if($ngoUserDetails->status == 1){ ?>
					<?php if($projectData->project_status == 1 || $projectData->project_status == 0){ ?><a href="<?php echo BASE_URL ?>project/request-edit/<?php echo $projectData->id;?>/"><button class="btn btn-primary cancelBtn btn-lg border-btn">Request Edit</button></a><?php } } ?>
					<?php } ?>
				</div>
				</div>
			</div>
		</div> 
	</div> 
	<div id="uploadContractBlock">
	</div>
	<script>
	function showProjectReport(projectDropdown) {
	    console.log(projectDropdown);
		if(projectDropdown!=""){
			url = BASE_URL+'reports/projectDropdown';
			$.ajax({
				type:"POST",
				url: url,
				data: {
						projectDropdown: projectDropdown,
					},
				dataType:"JSON",
				success: function(response) {  
					console.log(response);
					$('#report_div').show();
					$('#due-report').html(response.dueReportHtml);
					$('#draft-report').html(response.draftReportHtml);
					$('#submitted-report').html(response.submittedReportHtml);
				}
			});
	    }
	}
	</script>

	
	<script type="text/javascript" src="<?php echo SKIN_URL.'js/dashboard.js?v='.JS_CSC_V; ?>"></script>	
	<script type="text/javascript" src="<?php echo SKIN_URL.'js/reports.js?v='.JS_CSC_V; ?>"></script>	
	<?php $this->load->view('common/footer'); ?>
	<?php $this->load->view('common/footer_js'); ?>
</body>
</html>
