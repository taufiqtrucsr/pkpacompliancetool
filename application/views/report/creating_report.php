<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('common/head_common'); ?>

<body class=" Create-Project-step creare-report-page">
	<?php $this->load->view('common/header'); ?>
	<!-- < ?php print_r("<pre>");?>
	< ?php print_r($contracted_contributor_list);?>
	< ?php echo "Neerajkumar";?> -->
<form id="reportForm" name="reportForm" method="post" enctype="multipart/form-data">	
<div id="contractDetailsBlock" class="">
	<div class="container" >
		<div class="col-md-12">
			<div class="kyc-title"> <h2>Progress Report - <?php echo $progress_details->report_type_name;?></h2></div>
			<p class="text-center due-date"> Due date <?php echo date('d-m-Y',$progress_details->due_date);?> </p>
			<div class="row setup-content registration-flow-setup tab-pane fade active in progress-report-section" id="info">
				<input type="hidden" name="report_id" id="report_id" value="<?php echo $progress_details->report_id;?>">
				<input type="hidden" name="project_id" id="project_id" value="<?php echo $progress_details->project_id; ?>">	
				<!-- code for select type start here -->
				<!-- <div class="col-md-6">
					<div class="row"><input type="checkbox" name="contributor" id="contributor">Contriburor</div>
					<div class="row"><input type="checkbox" name="crowdfunding" id="crowdfunding">Crowdfunding</div>
					<div class="row"><input type="checkbox" name="both" id="both">Both</div>
				</div> -->
				<!-- code for select type ends here -->
				<div class="" id="">
					<div class="sel-contri-box" style='display:none;'>
						<div class="form-group col-sm-6" class="select_contributor" id="select_contributor" style="display:block;">
							<label class="control-label grey-txt">SELECT CONTRIBUTORS</label>
							<!-- code start here  -->
							<?php
								$ExternalContributor= array();
								foreach($ExternalcontributorsList as $ExternalContributors){
									// $ExternalContributor[] = $ExternalContributors['id'];
									$ExternalContributor[] = $ExternalContributors['id'];
								}
								$ExternalContributor = $ExternalContributor;
							?>
								<!-- code ends here -->
							<div class="select-box">
								<select id="contributors" name="contributors[]" multiple class="form-control" onchange="reportFundsReceive(this);">
									<?php
									if(isset($progress_details->contributor_id) && $progress_details->contributor_id!=""){
                                       $contributor_arr=explode(",", $progress_details->contributor_id);
									}else{
									   $contributor_arr=array();
									} 
									if(isset($contributorsList) && count($contributorsList) > 0) {
										foreach($contributorsList as $contributor) {
											// if(in_array($contributor->id, $contributor_arr)){ //old code commented here
											if(in_array($contributor->id,$ExternalContributor)){
                                                echo "<option value='".$contributor->id."' selected>".$contributor->funded_by."</option>";
												// echo "<option value='".$contributor->id."' selected>".$contributor->company_name."</option>";
											}
											//below code commented here
											// else{
												// echo "<option value='".$contributor->id."'>".$contributor->funded_by."</option>";

												// echo "<option value='".$contributor->id."'>".$contributor->company_name."</option>";
											// }
											
								        } 
										// echo "<option value='240'>CrowdFunding</option>";
								    } 
								    ?>
								</select> 
								<!-- <br>
								<p style="color:#36c;">Do not select contributor name who has funded this project externally.</p> -->
							</div>
						</div>

					</div><!-- sel-contri-box -->
					
				  	<div class="form-group col-sm-12 mar-bot-10">
						<label class="control-label">PROJECT TITLE</label>
						<div class="profile-text-details"><?php echo $progress_details->project_name;?></div>
				  	</div>

			  		<div class="form-group col-sm-12 mar-bot-10">
						<label class="control-label">PROJECT DESCRIPTION</label>
						<div class="profile-text-details"><?php echo $progress_details->project_description;?></div>
			  		</div>
			  		<?php
					$date1 = $progress_details->project_date_from;
					$date2 = $progress_details->project_date_to;							
					$get_interval_in_month = $this->CommonModel->get_interval_in_month($date1, $date2);		
					?>
					<div class="col-sm-12">
						<div class="row">
							<div class="form-group col-sm-6  mar-bot-10">
								<label class="control-label">PROJECT DURATION</label>
								<div class="profile-text-details"><?php echo ($get_interval_in_month>1) ? $get_interval_in_month.' months': $get_interval_in_month.' month';?></div><!-- profile-text-details -->
							</div>	
							
							<div class="form-group col-sm-6 location-details-icon  mar-bot-10">
								<label class="control-label" >PROJECT LOCATION</label>
								<div class="select-box">
									<div class="profile-text-details loc-tag-label"><?php echo $progress_details->district.', '.$progress_details->city;?></div><!-- profile-text-details -->
								</div>
							</div>
						</div>
					</div>
					<?php $sectors = $this->ProjectModel->getSectors($progress_details->sectors);?>
					<div class="col-sm-12">
						<div class="row">
							<div class="form-group col-sm-6  mar-bot-10">
								<label class="control-label">SECTOR</label>
								<div class="profile-text-details"><?php echo implode(', ',$sectors);?></div><!-- profile-text-details -->
							</div>

							<?php if($progress_details->sdgs != "") { ?>
							<div class="form-group col-sm-6 mar-bot-10">
								<label class="control-label">SDG ALIGNMENT</label>
						   		<div class="profile-text-details SDG-sec">
						   			<?php $SDGs = $this->ProjectModel->getSDGs($progress_details->sdgs);
									if(isset($SDGs) && count($SDGs)>0){
										foreach($SDGs as $value){ ?>
					   						<img src="<?php echo PRO_SDGS_IMG_URL.$value; ?>" class="g-sdgs-img" width="100" height="100">
					   					<?php } } ?>
						   		</div>
							</div>
							<?php } ?>
						</div>
					</div>
					<?php $beneficiaries = $this->ProjectModel->getBeneficiaries($progress_details->beneficiaries);?>
					<div class="col-sm-12">
						<div class="row">
							<div class="form-group col-sm-6 mar-bot-10">
								<label class="control-label">BENEFICIARY </label>
								<div class="profile-text-details"><?php echo implode(', ',$beneficiaries);?></div><!-- profile-text-details -->
							</div>
							
							<div class="form-group col-sm-6 mar-bot-10">
								<!-- <label class="control-label">BENEFICIARIES  <span class="info-tip"><a data-toggle="tooltip" title="BENEFICIARIES" data-original-title="BENEFICIARIES"><img src="<?=SKIN_URL?>/images/info_grey.png"></a></span></label>
							   <div class="profile-text-details">< ?php echo $progress_details->serve_beneficiaries.'/'.$progress_details->total_beneficiaries;?></div> -->
							   <label class="control-label">Total No. of Beneficiaries Benefitted<span class="info-tip"><a data-toggle="tooltip" title="BENEFICIARIES" data-original-title="BENEFICIARIES"><img src="<?=SKIN_URL?>/images/info_grey.png"></a></span></label>
							   <?php $total_beneficiaries = $get_current_tot_beneficiaries->total_beneficiaries_benefitted;?>
							   <div class="profile-text-details"><?php echo $total_beneficiaries?$total_beneficiaries:'0';?></div>
							   <!-- profile-text-details -->
							</div>
						</div>
					</div>
					<?php 
					if($report_frequency == 'MPR'){
						$strt_period = $this->ReportModel->getReportPeriod($progress_details->due_date, '30 days');
					}else if($report_frequency == 'QPR'){
						$strt_period = $this->ReportModel->getReportPeriod($progress_details->due_date, '3 month');
					}else if($report_frequency == 'HPR'){
						$strt_period = $this->ReportModel->getReportPeriod($progress_details->due_date, '6 month');
					}else{
						$strt_period = $this->ReportModel->getReportPeriod($progress_details->due_date, '1 year');
					}

					?>
					<input type="hidden" name="report_start_period" value="<?=$strt_period?>">
				    <input type="hidden" name="report_end_period" value="<?=date('d-m-Y',$progress_details->due_date)?>">	
				
					<div class="form-group col-sm-12 mar-bot-10 report-period">
						<!-- code start here for cover image  -->
						<!-- <div> -->
							<p class="second-heading">Add report cover image</p>
							<div class="upload-img form-group" style="padding:0px;">	
								<label class="control-label">IMAGES (Cover Image should be in the ratio of 400 * 200)</label>
								<div class="upload-img-section">
									<div class="gallery_box">
										<?php
										// $caseStudyImageHtml="";
										// if(isset($reportCaseStudyData) && count($reportCaseStudyData)>0){
										// 	//echo "<pre>";print_r($reportCaseStudyData);echo "</pre>";
										//     foreach($reportCaseStudyData as $value){
										//         $caseStudyImageHtml.= '<div class="gallery-image">';
										// 	        $caseStudyImageHtml.= '<img src="'.REP_CASE_STUDY_URL.$value->case_study_image.'" height="100" width="100" class="thumbnail" title="">';
										// 	        $caseStudyImageHtml.= '<span onclick="remove_casestudy_image('.$value->id.')" class="remove-cross">X</span>';
										//         $caseStudyImageHtml.= '</div>';
										//     }
										//     echo $caseStudyImageHtml;
										// }
										?>
									</div>
								</div><!-- upload-img-section-->
								<div class="incp-sec" id="uploadCoverImages">
									<!-- < ?php 
									if(isset($get_report_cover_details) && count($get_report_cover_details)>0){ 
										foreach($get_report_cover_details as $value){?> -->
											<?php if($get_report_cover_details->cover_image==""){
												$display="none";
											}else{
												$display="block";
											} ?>
											<span class="upload-file" style="margin-bottom:10px;background:none;">
												<!-- <img class="imageThumb" src="< ?php echo REP_COVER_IMG_URL.$value->case_study_image;?>" name="case_study_images" width="100" hieght="100" title="This is cover image"> -->
												<img class="imageThumb" src="<?php echo REP_COVER_IMG_URL.$get_report_cover_details->cover_image;?>" name="case_study_images" width="100" hieght="100" title="This is cover image" style="display:<?php echo $display; ?>;height: 150px;width: 150px;object-fit: contain;" >
												<br>
												<br>
												<span class="file-name"><?php $get_report_cover_details->cover_image;?></span>
												<!-- <span class="remove">X</span> -->
											</span>
										<!-- < ?php }
									}
									?> -->
								</div>
								<br>
								<br>
								<div class="org-logo-upload">
									<input type="file" id="case_study_images" name="case_study_images" onchange="readReportCoverURL(this);">
								</div>
							</div>
							
						<!-- </div> -->
						<br><br>
						<!-- code ends here for cover image -->
						<label class="control-label">REPORT PERIOD</label>
						<div class="profile-text-details"><?php echo $strt_period; ?> &nbsp; <i class="fa fa-angle-right"></i>  &nbsp;  <?php echo date('d-m-Y',$progress_details->due_date);?></div><!-- profile-text-details -->
						<input type="hidden" name="start_period" value="<?php echo $strt_period; ?>">
						<input type="hidden" name="end_period" value="<?php echo date('d-m-Y',$progress_details->due_date); ?>">
				  	</div>	
					<div class="form-group col-sm-12">
						<label class="control-label ">WORK DESCRIPTION / ACTIVITIES</label>
						<textarea class="form-control" id="work_description" name="work_description" placeholder="Enter here"><?php echo($progress_details->work_description == '') ? '' : $progress_details->work_description;?></textarea>
					</div>
					<div class="col-sm-12">
						<div class="row">
							<div class="form-group col-sm-6">
								<label class="control-label ">NO. OF BENEFICIARIES</label>
								<input type="text" placeholder="Enter the no. of people benefitted or affected" class="form-control amount-number validate-number" id="no_of_beneficiaries" name="no_of_beneficiaries" value="<?php echo($progress_details->no_of_beneficiaries <= 0) ? '' : $progress_details->no_of_beneficiaries;?>">
							</div>	
							<div class="form-group col-sm-6">
								<label class="control-label " for="orgState">STATUS FOR WORK ACTIVITY / ACTIVITIES</label>
								<div class="select-box">
									<select id="work_activity_status" name="work_activity_status" placeholder="Enter the state here" class="form-control">
										<option value="">Select the status for work activity</option>
										<option value="Not Started" <?php echo($progress_details->work_activity_status == 'Not Started')?'selected="selected"':'';?>>Not Started</option>
										<option value="Completed" <?php echo($progress_details->work_activity_status == 'Completed')?'selected="selected"':'';?>>Completed</option>
										<option value="In-Progress" <?php echo($progress_details->work_activity_status == 'In-Progress')?'selected="selected"':'';?>>In Progress</option>
									</select> 
								</div>
							</div>
						</div>
					</div><!-- col-sm-12 -->					
					<div class="image-sec"></div>
					<div class="col-sm-12 form-group">
						<p class="second-heading">ACTIVITIES DETAILS</p>
					</div>
			        <?php include('report_image_tab.php'); ?> 
			        <?php include('report_contributor_tab.php'); ?>

					<!-- code for donation amount -->
					<div style="padding:20px;">
						<p class="second-heading">DONATION RECEIVED FROM INDIVIDUALS</p>
						<br>
						<table style="border:1px solid #d3d2d7;" cellpadding="0" cellspacing="0">
							<tr>
								<td style="border:1px solid #d3d2d7;padding:10px;color:#9ea9c2;font-size:12px;">No. of Donors who contributed</td>
								<td style="border:1px solid #d3d2d7;padding:10px;color:#9ea9c2;font-size:12px;">Total Amount Received</td>
							</tr>
							<tr>
								<td style="border:1px solid #d3d2d7;padding:10px;color:#9ea9c2;font-size:12px;"><?php echo $gettotaldonation->no_of_doners;?></td>
								<td style="border:1px solid #d3d2d7;padding:10px;color:#9ea9c2;font-size:12px;"><?php echo $gettotaldonation->total_donation;?></td>
							</tr>
						</table>
					</div>
					<br>
					<br>
					<!-- code for donation ends here -->
					<!-- <br>
					< ?php echo $gettotaldonation->total_donation;?> -->
			        <?php include('report_fundutilized_tab.php'); ?>
			        <?php include('report_milestone_tab.php'); ?>
			        <?php include('report_casestudy_tab.php'); ?>
	            </div>
	        </div><!-- info -->
	    </div>	
     </div>	
</div> <!-- contractDetailsBlock-->

<div class="full-width white-bg">
	<div class="container ">
		<div class="registration-flow-setup">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-4">
					<a href="<?php echo base_url(); ?>dashboard/reports" class="btn btn-primary cancelBtn btn-lg border-btn">CANCEL</a>
				</div>
				<div class="col-sm-4">
					<input class="btn btn-primary cancelBtnbtn-lg border-btn" name="proReportFormbtn" type="button" value="Save As Draft" onclick="saveDraftReport()">
				</div>
				<div class="col-sm-4">
					<input class="btn btn-primary nextBtn btn-lg" type="submit"  value="CREATE REPORT">
				</div>	
			</div>
		</div>
		</div>
	</div>
</div>
</form>

<script type="text/javascript">
	function saveDraftReport(){	
		var fd = new FormData($('#reportForm')[0]);
		fd.append('report_type','Draft');	
		$.ajax({
			url: BASE_URL+'reports/save_draft_report',
			type: 'POST',
			method: 'POST',
			dataType: 'json',
			contentType: false,
			processData: false,
			data:fd,
			beforeSend: function() {
				var spinner = $('#loader');
				$('#loader').show();
			},
			complete: function() {
				$('#loader').hide();
			},
			success: function(response) {
				console.log(response);
		  		if(response.flag == 1) {
		  			$.toast({
				        heading: '',
				        text: response.msg,
				        showHideTransition: 'slide',
				        icon: 'success'
				    })
					setTimeout(function() {
						window.location.href = response.redirect;
				  	}, 1000);
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
	}

	function reportFundsReceive(){
		$('#loader').show().delay(1500).fadeOut();//code added here on 22-09-2022
		var projectContributorFundsId = $('#contributors').val();
		var projectId = <?php echo $progress_details->project_id; ?>;
		//console.log(projectContributorFundsId,projectId);
		if(projectContributorFundsId.length > 0){
			//console.log('test');
			$('#contributorDiv').html('');		  
			$.ajax({				
				url: BASE_URL + 'reports/contributername',
				type: "POST",
				data: {projectContributorFundsId: projectContributorFundsId, projectId : projectId},
				dataType: "json",
				success:function(data) {
				    //console.log(data);
					$('#contributorDiv').append(data.fundHtml);	
				}
			});
		}
	}
	
    $(document).ready(function () {
    	$("#reportForm").validate({
			// ignore: ':hidden',
		ignore: ':hidden:not("#contributors")', 
			rules: {
				"contributors[]": {
		          required: true,
					minlength: 1
		        },
				work_description: {
					required: true
				},
				no_of_beneficiaries: {
					required: true,
					pattern: /^[0-9,]+$/
				},
				work_activity_status: {
					required: true
				},
				case_study_title: {
					// required: true
					required: false
				},
				case_study: {
					required: false
				},
				image_description: {
					required: true
				},
				
			},
			messages: {
			   contributors: 'Enter correct/valid details',
			   work_description: 'Enter correct/valid details',
			   no_of_beneficiaries: 'Enter correct/valid details',
			   work_activity_status: 'Enter correct/valid details',
			   case_study_title: 'Enter correct/valid details',
			   //case_study_image: 'Upload valid image',
			   case_study: 'Enter correct/valid details',
			   image_description: 'Enter correct/valid details',
			},
			submitHandler: function(form) {   
                var form_data = new FormData($("#reportForm")[0]);
		        form_data.append('report_type','Submitted');	
				$.ajax({
					url: BASE_URL+"reports/submit_report",
					type: 'ajax',
	                method: "POST",
					dataType: 'json',
					data: form_data,
					processData: false,
                    contentType: false,
					success: function(response) {
						console.log(response);
						if(response.flag == 0){
						    $.toast({
						        heading: '',
						        text: response.msg,
						        showHideTransition: 'slide',
						        icon: 'error'
						    })
						    setTimeout(function() {}, 1000);
						}else if(response.flag == 1) {
							$.toast({
						        heading: '',
						        text: response.msg,
						        showHideTransition: 'slide',
						        icon: 'success'
						    })
						    window.location.href =response.redirect;
						}
					}
				});	
			}
		});	

	 	$('.validate-char').on('keypress', function(key) {
	        //alert(111111)
			if((key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45 && key.charCode != 32 && key.charCode != 0)) {
				return false;	
			}
		});
		
		$(".validate-number").keydown(function(event) {
			if (event.shiftKey == true) {
	            event.preventDefault();
	        }

	        if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

	        } else {
	            event.preventDefault();
	        }

	        if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
	            event.preventDefault();

	    });
		
		$('input.amount-number').keyup(function(event) {
			// skip for arrow keys
	  		if(event.which >= 37 && event.which <= 40) return;
		
	  		// format number
	  		convertToINRFormat($(this).val(),$(this));
		});
	});

	// code for create report start here
	function readReportCoverURL(input) {
		$(".cover-upload").hide('');
		console.log(input);
		console.log(input.files);
	
		if (input.files && input.files[0]) {
			var file = input.files[0];
			var extension = file.name.split('.').pop().toLowerCase();
			
			console.log(file);
			console.log(extension);
			
			var reader = new FileReader();
			var pdfImage = BASE_URL+'skin/images/pdf-icon.png';
			
			reader.onload = function(e) {
				if(extension == 'pdf'){
					// $("#uploadCoverImages").html("<span class=\"upload-file\">" + "<img class=\"imageThumb\" src=\"" + pdfImage + "\" width=\"100\" hieght=\"100\" title=\"" + file.name + "\"/>" + "<br/><span class=\"file-name\">" + file.name + "</span><span class=\"remove\">X</span>" + "</span>");
					$("#uploadCoverImages").html("<img class=\"imageThumb\" src=\"" + pdfImage + "\" width=\"1\"50 hieght=\"100\" title=\"" + file.name + "\"/>");
				}else{
					// $("#uploadCoverImages").html("<span class=\"upload-file\">" + "<img class=\"imageThumb\" src=\"" + e.target.result + "\" width=\"100\" hieght=\"100\" title=\"" + file.name + "\"/>" + "<br/><span class=\"file-name\">" + file.name + "</span><span class=\"remove\">X</span>" + "</span>");
					$("#uploadCoverImages").html("<img class=\"imageThumb\" src=\"" + e.target.result + "\" width=\"150\" hieght=\"100\" title=\"" + file.name + "\"/>");
				}
			
			$(".remove").click(function(){
				$(this).parent(".upload-file").remove();
				$("#coverImage").val('');
				$(".cover-upload").show('');
			});
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
	// code for create report ends here

	// code created for getting contributor id 
	$(document).ready(function(){
		// alert("this is my function for teseting");
		// $('#loader').show().delay(1500).fadeOut();//code added here on 22-09-2022
		var projectContributorFundsId = $('#contributors').val();
		var projectId = <?php echo $progress_details->project_id; ?>;
		//console.log(projectContributorFundsId,projectId);
		if(projectContributorFundsId.length > 0){
			//console.log('test');
			$('#contributorDiv').html('');		  
			$.ajax({				
				url: BASE_URL + 'reports/contributername',
				type: "POST",
				data: {projectContributorFundsId: projectContributorFundsId, projectId : projectId},
				dataType: "json",
				success:function(data) {
				    //console.log(data);
					$('#contributorDiv').append(data.fundHtml);	
				}
			});
		}
	});
	//code end here for gettting contributor id



</script>
<script type="text/javascript" src="<?php echo SKIN_URL; ?>js/reports.js?v=<?php echo JS_CSC_V; ?>"></script>
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/footer_js'); ?>
</body>
</html>