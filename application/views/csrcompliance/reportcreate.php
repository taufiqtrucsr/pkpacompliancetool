<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $this->load->view('common/head_common'); ?>
<link rel="stylesheet" media="all" href="<?php echo SKIN_URL; ?>css/csrcompliance.css" />
<link href="<?php echo SKIN_URL; ?>css/select2.min.css" rel="stylesheet" />
<style>
	#result {
		display: flex;
		flex-wrap: wrap;
		gap: 10px;
		padding: 10px 0;
	}
	.upload_imgs img{
		height: 100px;
		width: 100px;
	}
	.text-area-content{
		white-space: pre-wrap;
	}
	.error-image-span{
		color: red;
		font-size: 12px;
		position: absolute;
		margin-top: 110px;
	}
	div.preview-container img {
		height: 100px;
		width: 100px;
	}
	.event-delete-testimonial{
		float: inline-end;
	}
	.cross-icon,.cross-icon-x{
		position: absolute;
		color: white;
		background: #ff0000c2;
		border-radius: 3px;
		margin-left: 78px;
		margin-top: 5px;
		z-index:10;
	}
	.thumbnail {
		height: 192px;
	}
	.table-delete-icon{
		width:auto!important;
	}
	.signature thead{
		height: 80px!important;
	}
	.upload_imgs{
		width: fit-content;
		float: left;
	}
	.upload_imgs input{
		width: 100px!important;
    	height: 100px!important;
		margin-bottom: 0!important;
		margin-right: 0!important;
	}
	.add_images{
		margin-bottom: 100px;
		margin-top:22px;
	}
	.conclussion p{
		margin-bottom: 0px;
		margin-top: 10px;
	}
	.select2-container {
   	 	width: 160px!important;
	}
	.cus-mod .btn-primary:hover {
    color: #fff;
    background-color: #3166cf;
    border-color: #3166cf;
}
</style>
<body class="full-page">
	<?php $this->load->view('common/header');$year = explode('-', $prime_year);?>
	<div class="container">
		<form action="<?php echo base_url() . "/CsrCompliance/storeDirectorReport"; ?>" method="post" enctype="multipart/form-data">
			<div class="col-md-12" id="contractDetailsBlock" style="background: transparent;">
				<div class="reportcreate">
					<!--<h2>Financial Year Closing Report (Directors Report)<br> April
						<?php echo $year[0]; ?> to March
						<?php echo $year[1]; ?>
					</h2>-->
					<h2>Annual Report on CSR Activities (For Purpose Of Director’s Report)<br> April
						<?php echo $year[0]; ?> to March
						<?php echo $year[1]; ?></h2>
					<div class="brief_report">
						<p>
							A brief outline of the Company’s Corporate Social Responsibilty (CSR) policy, including
							overview of projects or programmes proposed to be undertaken and a reference to the web-link to the
							CSR policy and projects or programmes:
						</p>
						<div class="write_report">
							<p><label>Write a brief about this report</label></p>
							<textarea class="text-area-content" name="brief_about_director_report" required><?=isset($report->brief_about_director_report)?$report->brief_about_director_report:''?></textarea>
						</div>
						<p>
							The projects undertaken are within the broad framework of Schedule VII of the Companies Act,
							2013. Details of the CSR policy and projects or programmes undertaken by the Company are
							available on links given below:
						</p>
						<?php
								$urlStr = $obligation->CSR_policy_link;
								$parsed = parse_url($urlStr);
								if (empty($parsed['scheme'])) {
									$urlStr = 'http://' . ltrim($urlStr, '/');
								}
						?>
						<a class="csr_policy" target="_blank" href="<?php echo $urlStr; ?>">
							<?php echo $obligation->CSR_policy_link; ?>
						</a>

						<div class="comitee_members">
							<p><label>Details of CSR Comittee Members</label></p>
							<ul class="member_name">
								<?php foreach ($committee as $row) {
									echo '<li>' . $row->name_of_director . '</li>';
								} ?>
							</ul>
						</div>

						<div class="avg_profit avg-profit-box">
							<table class="table">
								<thead>
									<tr>
										<th scope="col">
											Avg. net profit of last 3 FY:
										</th>
										<th scope="col">
											Prescribed CSR Expenditure:
										</th>
										<th scope="col">
											Total Amount to be spent for the FY
										</th>
										<th scope="col">
											Amount Unspent for the FY: *
										</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<input  type="number" class="form-control" required name="avg_net_profit" value="<?=round($avg_net_profit->avg_net_profit)?>" readonly>
										</td>
										<td>
											<input  type="number" class="form-control" required name="percentage_of_avg_net_profit" value="<?=round($obligation->percentage_of_avg_net_profit)?>" readonly>
										</td>
										<td>
											<input  type="number" class="form-control" required name="CSR_obligation_current_FY" value="<?=round($obligation->CSR_obligation_current_FY)?>" readonly>
										</td>
										<td>
											<input type="number" class="form-control" required name="amt_unspent_for_FY" readonly>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

					</div>
					<div class="financial_year">
						<label class="control-label" style="color:#000000;">Manner in which amount spent during the
							financial year: *</label>
						<table class="table profit" style="margin-bottom:0px">
							<thead>
								<tr>
									<th scope="col" style=" width: 80px; ">Sr. No</th>
									<th scope="col">CSR Project or Activity identified</th>
									<th scope="col">Sector in which project is covered (As in Schedule-VII)</th>
									<th scope="col" colspan="2">Projects or programs <br> (1) Local area or other
										<br>(2)
										Specify the State and district where projects or programs was undertaken
									</th>
									<th scope="col">Amount Outlay (budget) projects or programs wise (₹)</th>
									<th scope="col" colspan="2">Amount spent on the projects or program Subheads :
										(1) Direct Expenditure on Projects or Programs; (2) Overheads (₹)</th>
									<th scope="col">Cumulative Expenditure upto the reporting period (₹)</th>
									<th scope="col">Amount Spent : Direct or through implementing agency </th>
									<th  class="table-delete-icon"></th>
								</tr>
							</thead>
							<tbody class="csr_two_director_report">
								<tr>
									<th colspan="3"></th>
									<th style=" background: rgba(51, 102, 204, 0.06);color:#7D879C">Local Area: Y/N ?
									</th>
									<th style=" background: rgba(51, 102, 204, 0.06);color:#7D879C">State & District
									</th>
									<th colspan="1"></th>
									<th style=" background: rgba(51, 102, 204, 0.06);color:#7D879C"> Direct Expenditure
										on
										Projects or Programs (₹)</th>
									<th style=" background: rgba(51, 102, 204, 0.06);color:#7D879C"> Overheads (₹)</th>
									<th colspan="2"></th>
									<th  class="table-delete-icon"></th>
								</tr>
								<?php if(isset($director_project)){ foreach($director_project as $key => $row){ ?>
									<tr>
										<th style=" width: 75px; "><?=++$key?></th>
										<td>
											<?php if(!empty($row->sector)){  if($row->project_outlay_amt){ ?>
												<?=$row->project_activity_name?>
												<input type="hidden" required name="project_activity_name[]" value="<?=$row->project_activity_name?>">
												<?php }else{ ?>
													<input type="text" class="form-control" required name="project_activity_name[]" value="<?=$row->project_activity_name?>" <?=($row->project_outlay_amt)? 'readonly' : '' ?>>
											<?php } }else{ ?>
												<?=$row->project_activity_name?>
												<input type="hidden" required name="project_activity_name[]" value="<?=$row->project_activity_name?>">
											<?php } ?>
											<input type="hidden" name="project_type[]" value="<?=$row->project_type?>">
										</td>
										<td>
											<?php if(!empty($row->sector)){  if($row->project_outlay_amt){ ?>
												<?=$row->sector?>
												<input type="hidden" data-sdgs='<?=$row->sdgs_id?>' required name="sector[]" value="<?=$row->sector?>">	
												<?php }else{ ?>
													<select name="sector[]" class="form-control" required>
														<option value="">Select Sector</option>
														<?php foreach($sectors as $sec){ ?>
															<option data-sdgs='<?=$sec->sdgs_id?>' <?=($row->sector == $sec->sector_type)? 'selected' : '' ?> value="<?=$sec->sector_type?>"><?=$sec->sector_type?></option>
														<?php } ?>
													</select>
											<?php } }else{ ?>
												-
												<input type="hidden" data-sdgs='<?=$row->sdgs_id?>' required name="sector[]" value="<?=$row->sector?>">	
											<?php } ?>
										</td>
										<td>
											<?php if(!empty($row->sector)){ ?>
												<select class="form-control" required name="is_project_location_local[]">
													<option <?=($row->is_project_location_local == 1)? 'selected':'' ?> value='1'>Y</option>
													<option <?=($row->is_project_location_local == 2)? 'selected':'' ?> value='2'>N</option>
												</select>
											<?php }else{ ?>
												-
												<input type="hidden" name="is_project_location_local[]" value="0">	
											<?php } ?>
										</td>
										<td>
											<?php if(!empty($row->sector)){  if($row->project_outlay_amt){ ?>
												<?=$row->project_location_state?>
												<input type="hidden" required name="project_location_state[]" value="<?=$row->project_location_state?>">		
												<?php }else{ ?>
													<select name="project_location_state[]" class="form-control" required>
														<option value="">Select Location</option>
														<?php foreach($district as $dst){ ?>
															<option <?=($row->project_location_state == $dst->dst_name.','.$dst->st_name)? 'selected' : '' ?> value="<?=$dst->dst_name.','.$dst->st_name?>"><?=$dst->dst_name.','.$dst->st_name?></option>
														<?php } ?>
													</select>
											<?php } }else{ ?>
												-
												<input type="hidden" required name="project_location_state[]" value="">	
											<?php } ?>
										</td>
										<td>
											<?php if(!empty($row->sector)){ ?>
												<?=$row->project_outlay_amt?>
												<input type="hidden" class="form-control" required name="project_outlay_amt[]" value="<?=$row->project_outlay_amt?>" <?=($row->project_outlay_amt)? 'readonly' : '' ?>>
											<?php }else{ ?>
												-
												<input type="hidden" required name="project_outlay_amt[]" value="" >
											<?php } ?>
										</td>
										<td>
											<input type="number" class="form-control comulative-calculate" value="<?=$row->direct_expenditure?>" required name="direct_expenditure[]">
										</td>
										<td>
											<?php if(!empty($row->sector)){ ?>
												<input type="number" class="form-control comulative-calculate" value="<?=$row->overheads?>" required name="overheads[]">
											<?php }else{ ?>
												-
												<input type="hidden" value=""  name="overheads[]">
											<?php } ?>
										</td>
										<td>
											<input type="number" class="form-control total" value="<?=$row->cumulative_expense?>" required name="cumulative_expense[]" readonly>
										</td>
										<td>
											<select class="form-control" required name="is_direct_implementation_dir_report[]">
												<option <?=($row->is_direct_implementation_dir_report == 1)? 'selected':'' ?> value='1'>Implementing agency</option>
												<option <?=($row->is_direct_implementation_dir_report == 2)? 'selected':'' ?> value='2'>Direct</option>
											</select>
										</td> 
										<?php if($row->project_outlay_amt){ ?>
											<td  class="table-delete-icon"></td>
										<?php }else{ ?>
											<td  class="table-delete-icon calculate-event-init">
												<a href="javascript:void(0)" class="event-delete-row">  
													<img src="<?=SKIN_URL?>images/deleteIconsline.svg" alt=""/>
												</a> 
											</td>
										<?php } ?>
									</tr>	
								<?php } }else{ foreach($annual_plan as $key => $row){ ?>
									<tr>
										<th style=" width: 75px; "><?=++$key?></th>
										<td>
											<?=$row->project_name?>
											<input type="hidden"  name="project_activity_name[]" value="<?=$row->project_name?>">
											<input type="hidden" name="project_type[]" value="<?=$row->project_type?>">
										</td>
										<td>
											<input type="text" class="form-control" data-sdgs='<?=$row->sdgs_id?>' required name="sector[]" value="<?=$row->sectors?>" readonly>	
										</td>
										<td>
											<select class="form-control" required name="is_project_location_local[]">
												<option value=''></option>
												<option value='Y'>Y</option>
												<option value='N'>N</option>
											</select>
										</td>
										<td>
											<?=$row->project_location_district.','.$row->project_location_state?>
											<input type="hidden" name="project_location_state[]" value="<?=$row->project_location_district.','.$row->project_location_state?>">	
										</td>
										<td>
											<?=$row->budgeted_amt?>
											<input type="hidden" name="project_outlay_amt[]" value="<?=$row->budgeted_amt?>">
										</td>
										<td>
											<input type="number" class="form-control comulative-calculate" required name="direct_expenditure[]">
										</td>
										<td>
											<input type="number" class="form-control comulative-calculate" required name="overheads[]">
										</td>
										<td>
											<input type="number" class="form-control total" required name="cumulative_expense[]" readonly>
										</td>
										<td>
											<select class="form-control" required name="is_direct_implementation_dir_report[]">
												<option value=''></option>
												<option value='Implementing agency'>Implementing agency</option>
												<option value='Direct'>Direct</option>
											</select>
										</td> 
										<td  class="table-delete-icon"></td>
									</tr>
								<?php } } ?>
							</tbody>
							<tfoot>
								<tr>
									<th style=" width: 75px; ">Total</th>
									<td colspan="4"></td>
									<td><input type="number" class="form-control no-css"  name="total_budget" readonly></td>
									<td><input type="number" class="form-control no-css"  name="total_expenditure" readonly></td>
									<td><input type="number" class="form-control no-css"  name="total_overheads" readonly></td>
									<td><input type="number" class="form-control no-css"  name="total_commutative" readonly></td>
									<td colspan="1"></td>
									<td  class="table-delete-icon"></td>
								</tr>
							</tfoot>

						</table>
						<div class="add-button-project">
							<a href="javascript:void(0)" class="btn addmore addmoreprojectreport">
								<span>+</span>
								Add details of other projects 
							</a>
							<a href="javascript:void(0)" class="btn addmore addmoreprojectassesment">
							<span>+</span>
							Expenses on Impact Assessment 
							</a>
						</div>
						
						<div class="note">
							<p><b>Note:</b> With respect to the projects identified by the Company as a part of its CSR
								activities, the Company had an outlay of (₹) <span class="budget-text-display"></span> against which a cumulative expenditure of (₹)
								<span class="expenditure-text-display"></span> has been incurred upto March 31, <?php echo $year[1]; ?> (financial closing year)
							</p>
						</div>
						<div class="reasons">
							<p><label>In case the company has failed to spend the 2% of the average net profit of the
									last 3
									FY or any part of thereof, the company
									shall provide he reasons for not spending the amount in its Board report.
									(Optional)</label></p>
							<textarea class="text-area-content" name="reason_failed_to_csr_spend_director_report"><?=isset($report->reason_failed_to_csr_spend_director_report)?$report->reason_failed_to_csr_spend_director_report:''?></textarea>
							<p><label>A responsibilty statement of the CSR Committee that the implementation and
									Monitoring
									of CSR Policy, is in compliance with CSR objectives and Policy of the
									company.</label>
							</p>
							<div class="col-md-8">
								<div class="row">
									<table class="table signature">
										<thead>
											<tr>
												<th scope="col">
													Sd/-
												</th>
												<th scope="col">
													Sd/-
												</th>
												<th scope="col">
													Sd/-
												</th>

											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Chief Executive Officer or Managing Director or Director</td>
												<td>Chairman CSR Committee</td>
												<td>(Person specified under clause (d)of sub-section (1) of section 380
													of
													the Act)</td>
											</tr>

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div id="case-study-container">
    <div class="additional_information">
        <h2>Additional Information</h2>
        <p class="case_stu">Case Study (Optional)</p>
        <p>Add a detailed case study to give confidence about your work.</p>

        <div class="write_report write_add_info">
            <p><label>Case Study Title</label></p>
            <input type="text" class="form-control" name="case_study_title" value="<?=isset($case_study->case_study_title)?$case_study->case_study_title:''?>">

            <p><label>Case Study Description (Minimum 50, Maximum 5000 Characters)</label></p>
            <div>
                <textarea class="text-area-content" name="case_study" onkeyup="countChar(this)" data-pointer="charac" minlength="50" maxlength="5000"><?=isset($case_study->case_study)?$case_study->case_study:''?></textarea>
                <p class="charac"></p>
            </div>

            <div class="conclussion">
                <p><label>Conclusion (Minimum 50, Maximum 1000 Characters) *</label></p>
                <textarea class="text-area-content" name="conclusion" onkeyup="countChar(this)" data-pointer="charac" minlength="50" maxlength="1000"><?=isset($case_study->conclusion)?$case_study->conclusion:''?></textarea>
                <p class="charac" style="margin-bottom:10px"></p>
            </div>

            <div class="add_images">
                <p><label>Images</label></p>
                <?php if(isset($case_study->case_study_image)){ ?>
                    <input type="hidden" name="case_study_file" value="<?=$case_study->case_study_image?>"/>
                    <input type="hidden" name="case_study_file_removed"/>
                <?php } ?>
                <?php if(isset($case_study_image)){ foreach($case_study_image as $path){ ?>
                    <div class="upload_imgs">
                        <svg class="cross-icon remove-case-study-file" xmlns="http://www.w3.org/2000/svg" data-id="<?=$path->id?>" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                        <img src="<?=MEDIA_URL.''.$path->path?>">
                    </div>
                <?php }} ?>
                <div class="upload_imgs">
                    <input type="file" name="case_study_image[]" accept="" class="upload __upload multiple-file-api">
                    <img src="<?php echo SKIN_URL; ?>/images/add_more.png">
                </div>
                <div class="preview-container"></div>
            </div>
        </div>
    </div>
</div>


<a href="javascript:void(0)" class="btn addmore addmore-casestudy">
    <span>+</span>
    Add More Case Studies
</a>


<p id="validation-message" style="color: red; display: none;">This field is required. Please fill out the first case study block before adding more.</p>

			
					<div class="additional_information testimonails">
						<h2>Testimonials</h2>
						<div class="additional_information-testimonials">
							<?php if(isset($testimonials) && $testimonials){ foreach($testimonials as $key => $row){ ?>
								<div class="row testimonails-count">
									<div class="col-md-2 image-container">
										<div class="upload_imgs">
											<input  type="hidden" value="<?=$row->id?>" name="person_id[]">
											<?php if(isset($row->person_image)){ ?>
											<svg class="cross-icon-x" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
												<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
											</svg>
											<input type="file" name="person_image[]" accept="" class="upload __upload file-api">
											<img src="<?php echo CSR_COMPLIANCE_URL.$row->person_image; ?>">
											<?php }else{ ?>
												<input type="file" name="person_image[]" accept="" class="upload __upload file-api">
												<img src="<?php echo SKIN_URL; ?>/images/add_image.png">
										    <?php } ?>
										</div>
									</div>
									<div class="col-md-10">
										<div class="row">
											<p>Name, Organisation & Designation</p>
											<input placeholder="Name" type="text" class="form-control" value="<?=$row->person_name?>" name="person_name[]" onpaste="return false;" onkeypress="return /[a-zA-Z ]/i.test(event.key)">
											<input placeholder="Organisation" type="text" class="form-control"  value="<?=$row->person_organisation?>"  name="person_organisation[]"  onpaste="return false;" onkeypress="return /[a-zA-Z ]/i.test(event.key)">
											<input placeholder="Designation" type="text" class="form-control"  value="<?=$row->person_designation?>"  name="person_designation[]"  onpaste="return false;" onkeypress="return /[a-zA-Z ]/i.test(event.key)">
											<a href="javascript:void(0)" class="event-delete-testimonial">  
												<img src="<?=SKIN_URL?>images/deleteIconsline.svg" alt=""/>
											</a> 
											<div class="conclussion">
												<p><label>Description (Minimum 10, Maximum 300 Characters) </label></p>
												<textarea class="text-area-content" name="testimonial_description[]"  onkeyup="countChar(this)" data-pointer="charac" minlength="10"   maxlength="300"   data-maximum="300"><?=$row->testimonial_description?></textarea>
												<p class="charac"></p>
											</div>
										</div>
									</div>
								</div>
							<?php }}else{ ?>
							<div class="row testimonails-count">
								<div class="col-md-2 image-container">
									<p>Images</p>
									<div class="upload_imgs">
										<input type="file" name="person_image[]" accept="" class="upload __upload file-api">
										<img src="<?php echo SKIN_URL; ?>/images/add_image.png">
									</div>
								</div>
								<div class="col-md-10">
									<div class="row">
										<p>Name, Organisation & Designation</p>
										<input placeholder="Name" type="text" class="form-control" name="person_name[]" onpaste="return false;" onkeypress="return /[a-zA-Z ]/i.test(event.key)">
										<input placeholder="Organisation" type="text" class="form-control" name="person_organisation[]"  onpaste="return false;" onkeypress="return /[a-zA-Z ]/i.test(event.key)">
										<input placeholder="Designation" type="text" class="form-control" name="person_designation[]"  onpaste="return false;" onkeypress="return /[a-zA-Z ]/i.test(event.key)">
										<div class="conclussion">
											<p><label>Description (Minimum 10, Maximum 300 Characters) </label></p>
											<textarea class="text-area-content" name="testimonial_description[]"  onkeyup="countChar(this)" data-pointer="charac" minlength="10"   maxlength="300"   data-maximum="300"></textarea>
											<p class="charac"></p>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
						<label class="error testimonial-error" style="display:none">Please fill out all testimonials fields.</label>
						<a href="javascript:void(0)" class="btn addmore addmoretestimonials" onclick=""> <span>+</span> Add	another </a>
					</div>

					<div class="additional_information SDGs">
						<h2>Sustainable Development Goals (SDGs) </h2>
						<div class="row">
							<div class="col-md-8">
								<?php  foreach ($sdgs as $value) { ?>
              						<div class="sector-img-sec-sdgs gallery">
              							<input type="checkbox" data-id="<?=$value->id?>" value="<?=$value->id?>" sdg-id="<?=$value->image?>" name="sdgs_pref[]">
              							<img src="<?=base_url()?>/public/uploads/project/sdg_image/<?=$value->image?>" alt="img">
              						</div>
            					<?php }  ?> 
							</div>
						</div>
					</div>

				</div>
			</div>
			<input type="hidden"  name="report_status" class="report_status" value="">
			<input type="submit" style="display: none;" class="submitform">
		</form>
		<div class="save_btns">
			<div class="col-sm-12">
				<div class="wrap_flex_btn">
					<div class="form-group">
						<a href="<?php echo base_url(); ?>/CsrCompliance/dashboard" class="cancelBtn">Cancel</a>
					</div>
					<div class="form-group">
						<a href="javascript:void(0)" class="draftbtn">Save As Draft</a>
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-primary saveBtn">Submit & Preview</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="projectTypeSelector" role="dialog">
		<div class="modal-dialog modal-sm">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Select Type Of Project</b></h4>
				</div>
				<div class="modal-body">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-12">
								<div class="radio-box"><input type="radio" value="Other than Ongoing"  name="project_type"/> <label>Other than Ongoing</label></div>
							</div>
							<div class="col-sm-12">
								<div class="radio-box"><input type="radio" value="Ongoing" name="project_type"/> <label>Ongoing</label> </div>
							</div>
						</div>
					</div>
					<div class="modal-btn-sec cus-mod" style="text-align:center;">
						<button class="btn btn-primary updateProjectType" style="width:auto;">Save & Add Project</button>
					</div>
			</div>
			</div>
		</div>
	</div>
</body>
<link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/jquery.multiselect.css">
<script src="<?php echo SKIN_URL; ?>js/jquery.multiselect.js"></script>
<script type="text/javascript" src="<?php echo SKIN_URL . 'js/compliance.js?v=' . JS_CSC_V; ?>"></script>
<script type="text/javascript" src="<?php echo SKIN_URL . 'js/discover.js?v=' . JS_CSC_V; ?>"></script>
<script type="text/javascript" src="<?php echo SKIN_URL . 'js/implementor.js?v=' . JS_CSC_V; ?>"></script>
<script type="text/javascript" src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script type="text/javascript" src="<?php echo SKIN_URL . 'js/select2.min.js?v=' . JS_CSC_V; ?>"></script>
<?php $this->load->view('common/footer_js'); ?>
<script>
let SKIN_URL = '<?php echo SKIN_URL; ?>';
$(".draftbtn").click(function(){
	$('.report_status').val(2);
	setTimeout(() => {
		$('.submitform').click();
	}, 1500);
});
$(".saveBtn").click(function(){
	$('.report_status').val(3);
	setTimeout(() => {
		$('.submitform').click();
	}, 1500);
});

$(".addmoreprojectreport").click(function () {
    $('#projectTypeSelector').modal();
});
$(".updateProjectType").click(function () {
	if($(document).hasClass('location-select-2'))
		$(".location-select-2").select2('destroy');
	var type = $('input[name="project_type"]:checked').val();
	if(type){
	
		var trcount = $('tbody.csr_two_director_report tr').length;
		var html = `<tr>
						<th style=" width: 75px; ">${trcount}</th>
						<td>
							<input type="text" class="form-control" required name="project_activity_name[]"  onpaste="return false;" onkeypress="return /[a-zA-Z ]/i.test(event.key)">
							<input type="hidden" name="project_type[]" value="${type}">
						</td>
						<td>
							<select name="sector[]" class="form-control" required>
								<option value="">Select Sector</option>
								<?php foreach($sectors as $row){ ?>
									<option data-sdgs='<?=$row->sdgs_id?>'  value="<?=$row->sector_type?>"><?=$row->sector_type?></option>
								<?php } ?>
							</select>
						</td>
						<td>
							<select class="form-control" required name="is_project_location_local[]">
								<option value=''></option>
								<option value='1'>Y</option>
								<option value='0'>N</option>
							</select>
						</td>
						<td>
							<select name="project_location_state[]" class="form-control location-select-2" required="">
								<option value="">Select Location</option>
								<?php foreach($district as $row){ ?>
                                    <option value="<?=$row->dst_name.','.$row->st_name?>"><?=$row->dst_name.','.$row->st_name?></option>
                                <?php } ?>
                            </select>	
						</td>
						<td>
							<input type="hidden" required name="project_outlay_amt[]">
							-
						</td>
						<td>
							<input type="number" class="form-control comulative-calculate" required name="direct_expenditure[]">
						</td>
						<td>
							<input type="number" class="form-control comulative-calculate" required name="overheads[]">
						</td>
						<td>
							<input type="number" class="form-control total" required name="cumulative_expense[]" readonly>
						</td>
						<td>
							<select class="form-control" required name="is_direct_implementation_dir_report[]">
								<option value=''></option>
								<option value='1'>Implementing agency</option>
								<option value='0'>Direct</option>
							</select>
						</td>
						<td  class="table-delete-icon calculate-event-init">
							<a href="javascript:void(0)" class="event-delete-row">  
								<img src="`+SKIN_URL+`images/deleteIconsline.svg" alt=""/>
							</a> 
						</td
					</tr>`;
		$(".csr_two_director_report").append(html);
		$('#projectTypeSelector').modal('hide');
		$(".location-select-2").select2();
	}
});
$(".addmoreprojectassesment").click(function () {
		var trcount = $('tbody.csr_two_director_report tr').length;
		var html = `<tr>
						<th style=" width: 75px; ">${trcount}</th>
						<td>
						    Expenses on Impact Assessment
							<input type="hidden" name="project_activity_name[]" value="Expenses on Impact Assessment">
							<input type="hidden" name="project_type[]" value="Impact Assessment">
						</td>
						<td>
							-
							<input type="hidden" name="sector[]">
						</td>
						<td>
							-
							<input type="hidden" name="is_project_location_local[]">
						</td>
						<td>
							-
							<input type="hidden" name="project_location_state[]">
						</td>
						<td>
							<input type="hidden" required name="project_outlay_amt[]">
							-
						</td>
						<td>
							<input type="number" class="form-control comulative-calculate" required name="direct_expenditure[]">
						</td>
						<td>
							-
							<input type="hidden" name="overheads[] comulative-calculate">
						</td>
						<td>
							<input type="number" class="form-control total" required name="cumulative_expense[]" readonly>
						</td>
						<td>
							-
							<input type="hidden" name="is_direct_implementation_dir_report[]">
						</td>
						<td  class="table-delete-icon calculate-event-init">
							<a href="javascript:void(0)" class="event-delete-row">  
								<img src="`+SKIN_URL+`images/deleteIconsline.svg" alt=""/>
							</a> 
						</td>
					</tr>`;
		$(".csr_two_director_report").append(html);
});
comulativeCalculation();
$(document).on('change','.comulative-calculate',function(){
	comulativeCalculation();
});
$(document).on('click','.calculate-event-init',function(){
	comulativeCalculation();
	sdgs();
});
$(document).on('change','select[name="sector[]"]',function(){
	sdgs();
});
sdgs();
$(document).on('change','[name="case_study_title"],[name="case_study"],[name="conclusion"]',function(){
	if($('[name="case_study_title"]').val().length>0 || $('[name="case_study"]').val().length>0 || $('[name="conclusion"]').val().length>0){
		$('[name="case_study_title"],[name="case_study"],[name="conclusion"]').attr('required',true);
	}else{
		$('[name="case_study_title"],[name="case_study"],[name="conclusion"]').attr('required',false);
	}
});
$(document).on('change','[name="person_name[]"],[name="person_organisation[]"],[name="person_designation[]"],[name="testimonial_description[]"]',function(){
	verifyTestimonial();
	if($('[name="person_name[]"]').val().length>0 || $('[name="person_organisation[]"]').val().length>0 || $('[name="person_designation[]"]').val().length>0  || $('[name="testimonial_description[]"]').val().length>0){
		$('[name="person_name[]"],[name="person_organisation[]"],[name="person_designation[]"],[name="testimonial_description[]"]').attr('required',true);
	}else{
		$('[name="person_name[]"],[name="person_organisation[]"],[name="person_designation[]"],[name="testimonial_description[]"]').attr('required',false);
	}
});
function verifyTestimonial(){
	var flag = false;
	$('[name="person_name[]"]').each(function(){
            var name = $(this).val();
            var org = $(this).parent().find('[name="person_organisation[]"]').val();
            var desi = $(this).parent().find('[name="person_designation[]"]').val();
            var des = $(this).parent().find('[name="testimonial_description[]"]').val();
            if(name.length==0||org.length==0||desi.length==0||des.length==0){
                flag = true;
            }
    });
	if(flag==false){
        $('.testimonial-error').css('display','none');
    }
}
</script>

<style>
    .close-icon {
        position: absolute;
        top: 5px;
        right: 10px;
        cursor: pointer;
        color: black;
        font-weight: bold;
        font-size: 18px;
    }
    .additional_information {
        position: relative; 
        padding: 20px;
        border: 1px solid #ddd;
        margin-bottom: 10px;
    }
</style>

<script>

function checkFirstBlockCompletion() {
    const firstBlock = document.querySelector('#case-study-container .additional_information');
    const title = firstBlock.querySelector('input[name="case_study_title"]').value;
    const caseStudyText = firstBlock.querySelector('textarea[name="case_study"]').value;
    const conclusion = firstBlock.querySelector('textarea[name="conclusion"]').value;

    return title && caseStudyText && conclusion;
}


document.querySelector('.addmore-casestudy').addEventListener('click', function() {
    const validationMessage = document.getElementById('validation-message');
    const isFirstBlockFilled = checkFirstBlockCompletion();

    if (isFirstBlockFilled) {
        const caseStudyContainer = document.getElementById('case-study-container');
        const caseStudyCount = caseStudyContainer.querySelectorAll('.additional_information').length;

     
        const newCaseStudy = caseStudyContainer.querySelector('.additional_information').cloneNode(true);

        
        newCaseStudy.querySelector("input[name='case_study_title']").value = "";
        newCaseStudy.querySelector("textarea[name='case_study']").value = "";
        newCaseStudy.querySelector("textarea[name='conclusion']").value = "";

        
        if (caseStudyCount > 0) {
            newCaseStudy.querySelector('h2').remove();
            newCaseStudy.querySelector('.case_stu').remove();
            newCaseStudy.querySelector('p').remove();

            
            const newHeading = document.createElement('h2');
            newHeading.classList.add('case-study-heading');
            newHeading.textContent = `Case Study ${caseStudyCount + 1}`;
            newCaseStudy.prepend(newHeading);
        }

        
        const closeIcon = document.createElement('span');
        closeIcon.textContent = '×';
        closeIcon.classList.add('close-icon');
        newCaseStudy.prepend(closeIcon);

        
        closeIcon.addEventListener('click', function() {
            newCaseStudy.remove();
        });

       
        caseStudyContainer.appendChild(newCaseStudy);

        
        validationMessage.style.display = 'none';
    } else {
        
        validationMessage.style.display = 'block';
    }
});
</script>

