<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('common/head_common'); ?>
 	<body class="">
		<?php $this->load->view('common/header'); ?>
		<div class="view-page">
			<div class="kyc-title"> <h2>KYC Verification</h2></div>
			<?php //echo $UserDetails->type ."--".$UserDetails->status;?>
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#step-1">Overview Information</a></li>
				<li><a data-toggle="tab" href="#company-step-2">Upload Documents</a></li>
				<li><a data-toggle="tab" href="#company-step-3">Board Members</a></li>
		 	</ul>
			
			<div class="row setup-content registration-flow-setup tab-pane fade in active " id="step-1">
			
			        <div class="col-md-12">
			          <!--h3>Company Overview Information</h3><a href="<?php //echo base_url()."company/edit/".$companyDetails->id."/#company-step-1"?>">Edit</a-->
			          <div class="form-group col-sm-12">
					  <div class="profile-text-details logo-upload-profile">
			            <?php if($companyDetails->company_logo !="") {
							$ext = pathinfo(COMPANY_LOGO_PATH.$companyDetails->company_logo, PATHINFO_EXTENSION);
							if($ext == 'pdf'){
								$imageSrc=SKIN_URL.'images/pdf-icon.png';
							}else{
								$imageSrc=COMPANY_LOGO.$companyDetails->company_logo;
							}
			             echo "<label class='control-label'>Contributor Logo</label>";
			             echo "<img width='100' height='100' src='".$imageSrc."' >";	
			            } ?>
						</div><!-- profile-text-details logo-upload-profile -->
			          </div>
					  
			           <div class="form-group col-sm-12">
			            <label class="control-label">Contributor Name</label>
						<div class="profile-text-details">
							<?php echo $companyDetails->company_name?>
						</div><!-- profile-text-details -->
			          </div>
					  
			          <div class="form-group col-sm-12">
			            <label class="control-label">Registered Office location</label>
						<div class="profile-text-details">
							<p><?php echo $companyDetails->company_address_1;?></p>
							<p><?php echo $companyDetails->company_address_2?></p>
						</div><!-- profile-text-details -->
			          </div>
					  
					 <?php if($companyDetails->address_proof !="") {?>
					  <div class="form-group col-sm-12">
					   <div class="profile-text-details logo-upload-profile">
			            <?php 
							$ext = pathinfo(COMPANY_ADD_PROOF_PATH.$companyDetails->address_proof, PATHINFO_EXTENSION);
							if($ext == 'pdf'){
								$imageSrc=SKIN_URL.'images/pdf-icon.png';
							}else{
								$imageSrc=COMPANY_ADD_PROOF_URL.$companyDetails->address_proof;
							}
			             echo "<label class='control-label'>Address Proof</label>";
			             echo "<img width='100' height='100' src='".$imageSrc."' >";	
			             ?>
					   </div><!-- profile-text-details proof-upload-profile -->
			          </div>
					  <?php } ?>
					  
					  <div class="col-sm-12">
							<div class="row">
								<div class="form-group col-sm-6">
									<label class="control-label" >Pincode</label>
									<div class="profile-text-details">
										<?php echo $companyDetails->pincode ?>
									</div><!-- profile-text-details -->
								</div>	
								
								<div class="form-group col-sm-6">
									<label class="control-label" for="orgState">State</label>
									<div class="select-box">
										<div class="profile-text-details">
											<?php if(isset($State) && count($State) > 0) 
											{
											foreach($State as $State_Name){ 
											$selected= "";
											 if( $State_Name['st_code'] == $companyDetails->state)
												{
													echo $State_Name['st_name'];
												}	
												?>
											<?php } }?>	
										</div><!-- profile-text-details -->
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="row">
								<div class="form-group col-sm-6">
									<label class="control-label">District</label>
									<div class="profile-text-details">
										<?php echo $companyDetails->district ?>
									</div><!-- profile-text-details -->
								</div>
								
								<div class="form-group col-sm-6">
									<label class="control-label">City</label>
								   <div class="profile-text-details">
									<?php echo $companyDetails->city ?>
								   </div><!-- profile-text-details -->
								</div>
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="row">
								<div class="form-group col-sm-6">
									<label class="control-label">Organization Type</label>
								   <div class="profile-text-details">
										<?php if($companyDetails->company_org_type != ''){$OrgTypeDetails = $this->CommonModel->getCompanyOrgTypeById($companyDetails->company_org_type); ?>
										<?php echo (!empty($OrgTypeDetails))?$OrgTypeDetails->org_type:''; }?>
								   </div><!-- profile-text-details -->
								</div>
							</div>
						</div>
						
			          <div class="form-group">
			            <label class="control-label">About the Contributor</label>
			            <div class="profile-text-details">
							<?php echo $companyDetails->about_company?>
						</div><!-- profile-text-details -->
			          </div>
					  
			         </div><!-- col-md-12 -->

			</div><!-- registration-flow-setup -->
			
			
			<div class="row setup-content registration-flow-setup tab-pane fade" id="company-step-2">
			       
				   <div class="col-md-12">
			          <!--h3>Corporate Detailed Information</h3><a href="<?php //echo base_url()."company/edit/".$companyDetails->id."/#company-step-2"?>">Edit</a-->
					  
			          <div class="form-group incp-sec col-md-12">
			             <p class="upload-incp-title">Incorporation Certificate</p>
			              <div class="download_file">
						  <div class="col-sm-5">
								<div class="upload-file">
						 		<?php if($companyDetails->cin_file !="") { 
								$ext = pathinfo(COMPANY_CIN_PATH.$companyDetails->cin_file, PATHINFO_EXTENSION);
								if($ext == 'pdf'){
									$imageSrc=SKIN_URL.'images/pdf-icon.png';
								}else{
									$imageSrc=COMPANY_CIN_URL.$companyDetails->cin_file;
								}
								?>
									<img id="upload_cin_certificate_file" width='100' height='100' src="<?php echo $imageSrc;?>">
									<span class="file-name" id="cin_certificate_file_name"><?php echo $companyDetails->cin_file?></span>	
									<button onclick="downloadFile(<?php echo $companyDetails->id; ?>,'cin_file');">Download File</button>
									<?php }else{ ?>
										<button class="disabled" disabled="disabled">Download File</button>
									<?php } ?>
								</div>
							
							</div>
							
							<div class="col-sm-7">
								<label class="control-label">CIN Number</label>
								<span class="crn-no"><?php echo base64_decode($companyDetails->cin_no);?></span>	
							</div>
						</div><!-- download_file -->
			          </div>
					  
					  <div class="form-group incp-sec col-md-12">
			             <p class="upload-incp-title">GST Number</p>
						  <!--img width='100' height='100' src='".COMPANY_GST_URL.$companyDetails->gst_file."' -->
			              <div class="download_file">
						  <div class="col-sm-5">
								<div class="upload-file">
								<?php if($companyDetails->gst_file !="") { $class = 'file_replace';
								$ext = pathinfo(COMPANY_GST_PATH.$companyDetails->gst_file, PATHINFO_EXTENSION);
								if($ext == 'pdf'){
									$imageSrc=SKIN_URL.'images/pdf-icon.png';
								}else{
									$imageSrc=COMPANY_GST_URL.$companyDetails->gst_file;
								}
								?>
									<img id="upload_cin_certificate_file" width='100' height='100' src="<?php echo $imageSrc;?>">
									<span class="file-name" id="cin_certificate_file_name"><?php echo $companyDetails->gst_file?></span>	
									<button onclick="downloadFile(<?php echo $companyDetails->id; ?>,'gst_file');">Download File</button>
									<?php }else{ ?>
										<button class="disabled" disabled="disabled">Download File</button>
									<?php } ?>
								</div>
							
							</div>
							
							<div class="col-sm-7">
								<label class="control-label">GST Number</label>
								<span class="crn-no"><?php echo base64_decode($companyDetails->gst_no);?></span>	
							</div>
						</div><!-- download_file -->
			          </div>
					  
					  
					   <div class="form-group incp-sec col-md-12 ins-sec-last">
			             <p class="upload-incp-title">PAN Number</p>
						 <!--img width='100' height='100' src='".COMPANY_PAN_URL.$companyDetails->pan_file."' -->
			              <div class="download_file">
						  <div class="col-sm-5">
								<div class="upload-file">
								<?php if($companyDetails->pan_file !="") { 
								$ext = pathinfo(COMPANY_PAN_PATH.$companyDetails->pan_file, PATHINFO_EXTENSION);
								if($ext == 'pdf'){
									$imageSrc=SKIN_URL.'images/pdf-icon.png';
								}else{
									$imageSrc=COMPANY_PAN_URL.$companyDetails->pan_file;
								}
								?>
									<img id="upload_cin_certificate_file" width='100' height='100' src="<?php echo $imageSrc;?>">
									<span class="file-name" id="cin_certificate_file_name"><?php echo $companyDetails->pan_file?></span>	
									<button onclick="downloadFile(<?php echo $companyDetails->id; ?>,'pan_file');">Download File</button>
									<?php }else{ ?>
										<button class="disabled" disabled="disabled">Download File</button>
									<?php } ?>
								</div>
							
							</div>
							
							<div class="col-sm-7">
								<label class="control-label">PAN Number</label>
								<span class="crn-no"><?php echo base64_decode($companyDetails->pan_no);?></span>	
							</div>
						</div><!-- download_file -->
			          </div>

					   
			          <input type="hidden" name="step_2_current_id" id="step-2-current-id" value="">
			          
			        </div><!-- col-md-12-->

			</div>
			
			<?php //print_r($UserDetails);?>
			
			<div class="row setup-content registration-flow-setup tab-pane fade" id="company-step-3">
				<div class="col-md-12">
					<div class="team-members" id="funds-recieved">
						<div class="team-member-block overflo-table">
							<table cellpadding="0" cellspacing="0" align="center" id="team-member-block"> 
								<tr>
									<th>Full name </th>
									<th>Email </th>
									<th>Contact Number </th>
									<th>Photograph </th>
								</tr>
								<?php if(isset($boardMembersData) && count($boardMembersData)>0){
								foreach($boardMembersData as $value){?>
								<tr>
									<td class="big-td">
										<?php echo $value->full_name;?>
									</td>
									<td class="medium-td">
										<?php echo ($value->email != '')?$value->email:'-';?>
									</td>
									<td class="medium-td">
										<?php echo ($value->phone_no != '')?$value->phone_no:'-';?>
									</td>
									<td>
										<?php if($value->photograph != ''){ ?>
										<div class="incp-sec" >
										<span class="upload-file download_file">
											<?php
												$ext = pathinfo(COMPANY_MEMBER_PATH.$value->photograph, PATHINFO_EXTENSION);
												if($ext == 'pdf'){
													$imageSrc=SKIN_URL.'images/pdf-icon.png';
												}else{
													$imageSrc=COMPANY_MEMBER_URL.$value->photograph;
												}
											?>
											<img class="imageThumb" src="<?php echo $imageSrc;?>" width="100" height="100">
											<!-- <span class="file-name">< ?php echo $value->photograph?></span> -->
											<!-- <button onclick="downloadBoardFile(<?php echo $value->id; ?>);">Preview</button> -->
										</span>
										</div>
										<?php }else{ echo '-';} ?>
									</td>
								</tr>
								<?php } }?>
							</table>
						</div>
					</div>			  
				   
				  <input type="hidden" name="step_2_current_id" id="step-2-current-id" value="">
				  
				</div><!-- col-md-12-->
			</div>
			<div class="full-width white-bg view-page-bottom">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-2"></div>
							<div class="col-sm-4">						
								<!-- < ?php if($UserDetails->status == 3 || $UserDetails->status == 2){?> -->
								<?php if( $UserDetails->type == 2){?>
									<a class="btn btn-primary cancelBtn btn-lg border-btn" href="<?php echo base_url()."company/edit/".$companyDetails->id."/#company-step-1"?>">Edit</a>
								<?php } ?>
							</div>
							
							<!-- <div class="col-sm-4">	
								<div class="pro-type last">
									<button class="btn btn-primary cancelBtn btn-lg border-btn" onclick="downloadForm(<?php echo $companyDetails->id; ?>);">Download Form</button>
								</div>
							</div> -->
							
							<div class="col-sm-4">	
								<!-- < ?php if($UserDetails->status == 3 || $UserDetails->status == 2){?> -->
								<?php if( $UserDetails->type == 2){?>
									<!--button id="step-2-submit" class="btn btn-primary btn-lg" onclick="sendForVerification(<?php //echo $UserDetails->id; ?>);">Send for Verification</button-->
									<button id="step-2-submit" class="btn btn-primary btn-lg" onclick="openTermsConditionsPopup();">Submit</button>
								<?php } ?> 
							</div>
							<div class="col-sm-2"></div>
					</div>
				</div>
			</div> <!-- white-bg -->
			
			
			
		</div>
		<script type="text/javascript" src="<?php echo SKIN_URL.'js/company.js?v='.JS_CSC_V; ?>"></script>
		<?php $this->load->view('common/footer'); ?>
		<?php $this->load->view('common/footer_js'); ?>	
	</body>
</html>				