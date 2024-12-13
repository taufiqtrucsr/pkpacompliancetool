<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('common/head_common'); ?>


	<style type="text/css">
	.stepwizard.col-md-offset-3 {
  display: table;
  width: 100%;
  position: relative;
  max-width: 1020px;
  margin: 0 auto;
  border: 0;
  z-index: 0;
}

.stepwizard-step, ul.nav.nav-tabs li {
    display: table-cell;
    text-align: center;
    position: relative;
    float: inherit;
}
</style>

<body class="">
	<?php $this->load->view('common/header'); 
	$sql="SELECT * FROM `corporate_board_members` WHERE `corporate_id`='".$companyDetails->id."'";
	 $count =$this->db->query($sql)->num_rows();
   ?>

	<div class="edit-company-page organisation-main-steps">
		  <!--ul class="nav nav-tabs">
		    <li class="active"><a data-toggle="tab" href="#company-register">Company Registration</a></li>
		  </ul-->

		<div class="tab-content">
		    
		   <?php //echo $companyDetails->id;//"<pre>"; print_r();?>
		   	<?php //echo $UserDetails->type ."--".$UserDetails->status;?>
		    <div id="company-register" class="tab-pane fade in active">
		     	<div class="kyc-title"> <h2>Contributor  KYC Verification</h2></div>
		     		<div class="">
		     			<div class="stepwizard col-md-offset-3">
						    <div class="stepwizard-row setup-panel">
						    	<div class="stepwizard-step">
						        	<a href="#company-step-1" id="company-step-1-btn" type="button" class="btn btn-default btn-circle"><span class="step-count">1</span> Overview Information</a>
						      	</div>

						      	<div class="stepwizard-step">
						        	<a href="#company-step-2" id="company-step-2-btn" type="button" class="btn btn-default btn-circle" disabled="disabled"><span class="step-count">2</span> Upload Documents</a>
						      	</div>
								
								<div class="stepwizard-step">
						        	<a href="#company-step-3" id="company-step-3-btn" type="button" class="btn btn-default btn-circle" disabled="disabled"><span class="step-count">3</span> Board Members</a>
						      	</div>
						    </div>
					  	</div>

					  	<form action="<?php echo base_url();?>Register/companyEditForm1" enctype="multipart/form-data" id="edit-company-form-1" method="POST">
						<div id="company-step-1">
						<div class="container">
						    <div class="row setup-content registration-flow-setup">
						      <div class="col-lg-12">
						          <!--h3>Company Overview Information</h3-->
						          
						          <div class="form-group col-sm-12 <?php echo ($companyDetails->company_logo !="")?'upload-logo-editpage':'';?>" id="<?php echo ($companyDetails->company_logo =="")?'logo':'';?>">
						            <label class="control-label">Contributor Logo (Optional) </label>
						            <?php 
									if($companyDetails->company_logo !="") {
										$ext = pathinfo(COMPANY_LOGO_PATH.$companyDetails->company_logo, PATHINFO_EXTENSION);
										if($ext == 'pdf'){
											$imageSrc=SKIN_URL.'images/pdf-icon.png';
										}else{
											$imageSrc=COMPANY_LOGO.$companyDetails->company_logo;
										}
									?>
						            	<img id="upload_img" width='100' height='100'  src="<?php echo $imageSrc;?>">
										<input type="file" onchange="readURL(this);" class="form-control" value="<?php echo $companyDetails->company_logo ?>" id="companyLogo" name="companyLogo"/>
						            <?php }else{ ?>
										<img id="upload_img"> 
										<div class="org-logo-upload" ><input type="file" onchange="readURL(this);" class="form-control" id="companyLogo" name="companyLogo"/></div>
									<?php } ?>
						            <input type="hidden" name="companyLogoHidden" id="companyLogoHidden" value="<?php echo $companyDetails->company_logo ?>">
						          </div>
								  
						          <div class="form-group col-sm-12">
						            <label class="control-label">Contributor Name <span>*</span></label>
						            <input type="text" class="form-control" value="<?php echo $companyDetails->company_name ?>" id="companyName" name="companyName"/>
						          </div>
								  
						          <div class="form-group col-sm-12">
						            <label class="control-label">Registered Office Location 1 <span>*</span></label>
						            <input type="text" class="form-control" value="<?php echo $companyDetails->company_address_1 ?>" id="companyAddress1" name="companyAddress1" />
						          </div>
						          <div class="form-group col-sm-12">
						            <label class="control-label">Registered Office Location 2 <span>*</span></label>
						            <input type="text" class="form-control" value="<?php echo $companyDetails->company_address_2 ?>" id="companyAddress2" name="companyAddress2" />
						          </div>
								  <div class="form-group col-sm-12 <?php echo ($companyDetails->address_proof !="")?'upload-proof-editpage':'';?>" id="<?php echo ($companyDetails->address_proof =="")?'add-proof':'';?>">
						            <label class="control-label">Address Proof (Optional)</label>
									<span class="info-tip"><a data-toggle="tooltip" title="Electric Bill | LandLine Phone Bill | L&L Agreement | Other">
									<img src="<?php echo SKIN_URL; ?>images/info_grey.png"></a></span>
						            <?php 
									if($companyDetails->address_proof !="") {
										$ext = pathinfo(COMPANY_ADD_PROOF_PATH.$companyDetails->address_proof, PATHINFO_EXTENSION);
										if($ext == 'pdf'){
											$imageSrc=SKIN_URL.'images/pdf-icon.png';
										}else{
											$imageSrc=COMPANY_ADD_PROOF_URL.$companyDetails->address_proof;
										}
									?>
						            	<img id="upload_proof" width='100' height='100'  src="<?php echo $imageSrc;?>">
										<input type="file" onchange="readAddProofURL(this);" class="form-control" value="<?php echo $companyDetails->address_proof ?>" id="companyAddProof" name="companyAddProof"/>
						            <?php }else{ ?>
										<img id="upload_proof"> 
										<div class="org-logo-upload" ><input type="file" onchange="readAddProofURL(this);" class="form-control" id="companyAddProof" name="companyAddProof"/></div>
									<?php } ?>
						            <input type="hidden" name="companyAddProofHidden" id="companyAddProofHidden" value="<?php echo $companyDetails->address_proof ?>">
						          </div>
								   <div class="col-sm-12">
									<div class="row">
										<div class="form-group col-sm-6">
											<label class="control-label">Pincode <span>*</span></label>
											<input type="text" placeholder="Enter the pincode here" class="form-control validate-number" id="companyPincode" name="companyPincode" maxlength="6" value="<?php echo $companyDetails->pincode; ?>" />
										</div>	
										
										<div class="form-group col-sm-6">
											<label class="control-label" for="orgState">State <span>*</span></label>
											<div class="select-box">
											<select id="companyState" name="companyState" class="form-control">
												<option value="">Select State</option>
												<?php if(isset($State) && count($State) > 0) 
												{
												foreach($State as $State_Name){	?>
													<option value="<?php echo $State_Name['st_code'];?>" <?php echo ($companyDetails->state == $State_Name['st_code']) ? 'selected="selected"' : ''; ?>><?php echo $State_Name['st_name'];?></option>
												<?php } }?>
											</select> 
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="row">
										<div class="form-group col-sm-6">
											<label class="control-label">District <span>*</span></label>
											<input type="text" placeholder="Enter the district here"  class="form-control" id="companyDistrict" name="companyDistrict"  value="<?php echo $companyDetails->district; ?>"/>
										</div>
										
										<div class="form-group col-sm-6">
											<label class="control-label">City <span>*</span></label>
											<input type="text" placeholder="Enter the city here" class="form-control" id="companyCity" name="companyCity" value="<?php echo $companyDetails->city; ?>"/>
										</div>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="row">
										<div class="form-group col-sm-6">
											<label class="control-label" for="companyOrgType">Organization Type <span>*</span></label>
											<div class="select-box">
											<select id="companyOrgType" name="companyOrgType" class="form-control">
												<option value="">Select Type</option>
												<?php if(isset($Co_Organization_Type) && count($Co_Organization_Type) > 0) 
												{
												foreach($Co_Organization_Type as $type){ ?>
												<option value="<?php echo $type['id'];?>" <?php echo ($companyDetails->company_org_type == $type['id']) ? 'selected="selected"' : ''; ?>><?php echo $type['org_type'];?>
												</option>
												<?php } }?>
											</select> 
											</div>
										</div>
									</div>
								</div>
						          <div class="form-group col-sm-12">
						            <label class="control-label">About the Contributor <span>*</span></label>
						            <textarea class="form-control" placeholder="Say something about your organization" id="companyAbout" name="companyAbout"><?php echo $companyDetails->about_company;  ?></textarea>
						          </div>
								  
								</div>
						    </div>
							</div><!-- container -->
							
							<div class="full-width white-bg">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-6">						
										<!-- <button class="btn btn-primary cancelBtn btn-lg border-btn" type="reset">Cancel</button> -->
										<!-- <input type="button" class="btn btn-primary cancelBtn btn-lg border-btn" value="Cancel3" onclick="history.back()"/>	 -->
										<?php 
										if($count=='0'){
											
											$btn_status = base_url().'discover';
										}else{
											 
											 $btn_status = base_url().'company/view';
										}
										?>

										<a href="<?php echo $btn_status;?>" class="btn btn-primary cancelBtn btn-lg border-btn">Cancel</a>

										
										

										

									</div>
									
									<div class="col-sm-6">	
											<button  class="btn btn-primary nextBtn btn-lg" type="submit" >Save as Draft & Continue</button>
											  <input type="hidden" value="<?php echo $companyDetails->user_id;  ?>" name="UserId_form1" id="UserId_form1">
											  <input type="hidden" name="step_1_current_id" id="step-1-current-id" value="<?php echo $this->uri->segment(3)?>">
									</div>

									</div>
								</div>
							</div> <!-- white-bg -->
								  
						          
						    </div><!-- company-step-1 -->
					  	</form>


					  	<form action="<?php echo base_url();?>Register/companyEditForm2" enctype="multipart/form-data" id="edit-company-form-2" method="POST">
						<div style="display: none;" id="company-step-2"> 
					  		<div class="row setup-content registration-flow-setup" >
						        <div class="col-md-12">
						          <!--h3>Corporate Detailed Information</h3-->
						          <?php $class = '';?>
						          <div class="form-group incp-sec col-md-12">
						             <p class="upload-incp-title">Upload Incorporation Certificate</p>
									<div class="col-sm-5">
								<label class="control-label">Document <span>*</span> <span class="logo-file-format">(Upload .jpg, .png, .pdf file format)</span></label>

									<div  class="upload-file" id="upload_cin_certificate_file" >
						            <?php 
									$imageSrc ='';
									if($companyDetails->cin_file !="") { 
										$class = 'file_replace';
										$ext = pathinfo(COMPANY_CIN_PATH.$companyDetails->cin_file, PATHINFO_EXTENSION);
										if($ext == 'pdf'){
											$imageSrc=SKIN_URL.'images/pdf-icon.png';
										}else{
											$imageSrc=COMPANY_CIN_URL.$companyDetails->cin_file;
										}
									?>
										<img width='100' height='100'  src="<?php echo $imageSrc;?>">
										<span class="file-name" id="cin_certificate_file_name"><?php echo $companyDetails->cin_file?></span>					
										<span class="remove" onclick="removImage('cin_certificate_file');">X</span>
						            <?php } ?>
									</div>
						           <div class="org-doc-upload" style="<?php echo ($imageSrc == '')?'display:block':'display:none'?>">
								 	  <input type="file" onchange="readFileURL(this);" class="form-control <?php echo $class; ?>" id="cin_certificate_file" name="cin_certificate_file"/>
								   </div>
						            <input type="hidden" name="cin_certificate_fileHidden" id="cin_certificate_fileHidden" value="<?php echo $companyDetails->cin_file ?>">
									</div>
									
									<div class="col-sm-7">
									<label class="control-label">CIN Number <span>*</span></label>
						            <input type="text" class="form-control doc-input" id="cin_certificate_number" value="<?php echo base64_decode ($companyDetails->cin_no);  ?>" name="cin_certificate_number" placeholder="CIN Number"  />
									</div>
						          </div>
								  
								  
								  <div class="form-group incp-sec col-md-12">
						             <p class="upload-incp-title">Upload GST Certificate (Optional)</p>
									<div class="col-sm-5">
									<label class="control-label">Document <span class="logo-file-format">(Upload .jpg, .png, .pdf file format)</span></label>

									<div  class="upload-file" id="upload_gst_certificate_file" >
						            <?php 
									$imageSrc ='';
									if($companyDetails->gst_file !="") {
										$class = 'file_replace';
										$ext = pathinfo(COMPANY_GST_PATH.$companyDetails->gst_file, PATHINFO_EXTENSION);
										if($ext == 'pdf'){
											$imageSrc=SKIN_URL.'images/pdf-icon.png';
										}else{
											$imageSrc=COMPANY_GST_URL.$companyDetails->gst_file;
										}
										?>
										<img width='100' height='100'  src="<?php echo $imageSrc;?>">
										<span class="file-name" id="gst_certificate_file_name"><?php echo $companyDetails->gst_file?></span>					
										<span class="remove" onclick="removImage('gst_certificate_file');">X</span>
						            <?php } ?>
									</div>
						           <div class="org-doc-upload" style="<?php echo ($imageSrc == '')?'display:block':'display:none'?>"> 
									   <input type="file" onchange="readFileURL(this);" class="form-control <?php echo $class; ?>" id="gst_certificate_file" name="gst_certificate_file"/>
								   </div>
						            <input type="hidden" name="gst_certificate_fileHidden" id="gst_certificate_fileHidden" value="<?php echo $companyDetails->gst_file ?>">
									</div>
									
									<div class="col-sm-7">
									<label class="control-label">GST Number</label>
						           <input type="text" class="form-control doc-input" id="gst_certificate_number" value ="<?php echo base64_decode($companyDetails->gst_no);  ?>" name="gst_certificate_number" placeholder="GST Number"  />
									</div>
						          </div>
								  
								  
								  
								  <div class="form-group incp-sec col-md-12">
						             <p class="upload-incp-title">Upload PAN Card</p>
									<div class="col-sm-5">
									<label class="control-label">Document <span>*</span> <span class="logo-file-format">(Upload .jpg, .png, .pdf file format)</span></label>

									<div  class="upload-file" id="upload_pan_card_file" >
						             <?php 
									 $imageSrc = '';
									 if($companyDetails->pan_file !="") { 
										$class = 'file_replace';
										$ext = pathinfo(COMPANY_PAN_PATH.$companyDetails->pan_file, PATHINFO_EXTENSION);
										if($ext == 'pdf'){
											$imageSrc=SKIN_URL.'images/pdf-icon.png';
										}else{
											$imageSrc=COMPANY_PAN_URL.$companyDetails->pan_file;
										}
									?>
										<img width='100' height='100'  src="<?php echo $imageSrc;?>">
										<span class="file-name" id="pan_card_file_name"><?php echo $companyDetails->pan_file?></span>					
										<span class="remove" onclick="removImage('pan_card_file');">X</span>
						            <?php } ?>
									</div>
						           <div class="org-doc-upload" style="<?php echo ($imageSrc == '')?'display:block':'display:none'?>">
										<input type="file" onchange="readFileURL(this);" class="form-control <?php echo $class; ?>" id="pan_card_file" name="pan_card_file"/>
									</div>
						            <input type="hidden" name="pan_card_fileHidden" id="pan_card_fileHidden" value="<?php echo $companyDetails->pan_file ?>">
									</div>
									
									<div class="col-sm-7">
									<label class="control-label">PAN Number <span>*</span></label>
						           <input type="text" class="form-control doc-input" value ="<?php echo base64_decode($companyDetails->pan_no);  ?>" id="pan_card_number" name="pan_card_number" placeholder="PAN Number"  />
									</div>
						          </div>

						          
						        </div><!-- col-md-12 -->
								
						    </div><!-- <!-- row setup-content --> 
							
							<div class="full-width white-bg">
								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-3">	
											<a href="<?php echo base_url();?>company/edit/<?php echo $companyDetails->id ?>/#company-step-1" onclick="setTimeout(location.reload.bind(location), 1)" class="btn btn-primary cancelBtn btn-lg border-btn">Back</a>
										</div>
										<div class="col-sm-3">						
										
									<?php 
										if($count=='0'){
											
											$btn_status = base_url().'discover';
										}else{
											 
											 $btn_status = base_url().'company/view';
										}
										?>

										<a href="<?php echo $btn_status;?>" class="btn btn-primary cancelBtn btn-lg border-btn">Cancel</a>

										</div>
										<div class="col-sm-6">	
												<input type="hidden" name="step_2_current_id" id="step-2-current-id" value="<?php echo $this->uri->segment(3)?>">
						          
												<button id="step-2-submit" class="btn btn-primary btn-lg" type="submit">Save as Draft & Continue</button>
										</div>

										</div>
									</div>
								</div> <!-- white-bg -->
								
								
							</div><!-- company-step-2 -->						
					  	</form>	

						<form action="<?php echo base_url();?>Register/companyEditForm3" enctype="multipart/form-data" id="edit-company-form-3" method="POST">
						<div style="display: none;" id="company-step-3">
							<div class="container">
								<div class="row setup-content registration-flow-setup team-member team-member-edit-page" >
									<div class="col-md-12">
										<div class="team-members" id="funds-recieved">
											<input type="hidden" id="total_team_members" class="total_team_members" value="<?php echo $team_member_counter;?>">
											<div class="team-member-block overflo-table">
												<table cellpadding="0" cellspacing="0" align="center" id="team-member-block"> 
													<tr>
														<th>Full name <span>*</span></th>
														<th>Email <span>*</span></th>
														<th>Contact Number <span>*</span></th>
														<th>Photograph <span>*</span></th>
													</tr>
													<?php include(APPPATH.'views/register/board_member_form.php'); ?>
												</table>
											</div>
											<p class="pad-5"></p>
											<div class="button-set">
												<button class="add-member-button" type="button" id="add-member-button" onclick="addMemberEntry('edit-company-form-3');">+ Add another member</button>
												<!--button type="button"  id="" onclick="saveMilestone();">Save</button-->
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="full-width white-bg">
							<div class="col-sm-12">
								<div class="row">
										<div class="col-sm-3">	
											<a href="<?php echo base_url();?>company/edit/<?php echo $companyDetails->id ?>/#company-step-2" onclick="setTimeout(location.reload.bind(location), 1)" class="btn btn-primary cancelBtn btn-lg border-btn">Back</a>
										</div>
										<div class="col-sm-3">						
										
										<?php 
										if($count=='0'){
											
											$btn_status = base_url().'discover';
										}else{
											 
											 $btn_status = base_url().'company/view';
										}
										?>

										<a href="<?php echo $btn_status;?>" class="btn btn-primary cancelBtn btn-lg border-btn">Cancel</a>



										</div>
										<div class="col-sm-6">	
												<input type="hidden" name="step_3_current_id" id="step-3-current-id" value="<?php echo $this->uri->segment(3)?>">
						          
												<button id="step-2-submit" class="btn btn-primary btn-lg" type="submit">Save as Draft & Continue</button>
										</div>

										</div>
								</div>
							</div> <!-- white-bg -->
						</div>	
						</form>	<!--company-step-4-->

		     		</div>	
		    </div>	

		</div> 
    </div>

   
    <script type="text/javascript">
		
		hash = window.location.hash;
    	if(hash=='#company-step-1')
    	{
    	  //alert("ee");
    	   $("#company-step-1-btn").removeClass('btn-default btn-complete').addClass('btn-primary');
    	   $("#company-step-2-btn").removeClass('btn-primary btn-complete').addClass('btn-default');
           $("#company-step-1-btn").removeAttr('disabled');
           $("#company-step-2-btn").attr('disabled', 'disabled');
            $("#company-step-2").css("display", "none");
           $("#company-step-1").css("display", "block");
           

    	}	 

    	if(hash=='#company-step-2')
    	{ //alert("aaa");
    	   $("#company-step-1-btn").removeClass('btn-primary btn-default').addClass('btn-complete');
           $("#company-step-2-btn").removeClass('btn-default btn-complete').addClass('btn-primary');
           $("#company-step-1-btn").attr('disabled', 'disabled');
           $("#company-step-2-btn").removeAttr('disabled');
           $("#company-step-1").css("display", "none");
           $("#company-step-2").css("display", "block");

    	}
		
		if(hash=='#company-step-3')
    	{ //alert("aaa");
    	   $("#company-step-1-btn").removeClass('btn-primary btn-default').addClass('btn-complete');
    	   $("#company-step-2-btn").removeClass('btn-primary btn-default').addClass('btn-complete');
           $("#company-step-3-btn").removeClass('btn-default btn-complete').addClass('btn-primary');
           $("#company-step-1-btn").attr('disabled', 'disabled');
           $("#company-step-2-btn").attr('disabled', 'disabled');
           $("#company-step-3-btn").removeAttr('disabled');
           $("#company-step-1").css("display", "none");
           $("#company-step-2").css("display", "none");
           $("#company-step-3").css("display", "block");
    	}
    </script>

    <!--script src="<?php //echo base_url()."skin/js/register.js?v=".JS_CSC_V?>"></script-->
	<?php $this->load->view('common/register-js.php'); ?>
	<?php $this->load->view('common/footer'); ?>
	<?php $this->load->view('common/footer_js'); ?>	

</body>
</html>
