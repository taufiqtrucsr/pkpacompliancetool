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


table.table.cus-rep-table th {
    text-align: center !important;
}
	.upload_imgs{
		margin-left: 10px;
	}
	.cross-icon{
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
	}
	.conclussion p{
		margin-bottom: 0px;
		margin-top: 10px;
	}
	.select2-container {
   	 	width: 160px!important;
	}
	.text-area-content{
		white-space: pre-wrap;
	}
	.note p {
		font-size: 13px!important;
	}
	.p-25{
		padding-left: 25px;
	}
	.mb-35{
		margin-bottom: 35px!important;
	}
</style>
<body class="full-page">
	<?php $this->load->view('common/header');$year = explode('-', $director_report->FY_year);?>
	<div class="container">
			<div class="col-md-12" id="contractDetailsBlock" style="background: transparent;">
				<div class="reportcreate">
					<h2>Annual Report on CSR Activities (For Purpose Of Director’s Report)<br> April
						<?php echo $year[0]; ?> to March
						<?php echo $year[1]; ?>
					</h2>
					<div class="brief_report">
						<p>
							A brief outline of the Company’s Corporate Social Responsibilty (CSR) policy, including
							overview of projects or programmes proposed to be undertaken and a reference to the web-link to the
							CSR policy and projects or programmes:
						</p>
						<p class="text-area-content"><?=$director_report->brief_about_director_report?></p>
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
						<a class="csr_policy"  target="_blank"  href="<?php echo $urlStr; ?>">
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
							<table class="table cus-rep-table">
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
											<?=round($avg_net_profit->avg_net_profit)?>
											<input  type="hidden" name="avg_net_profit" value="<?=round($avg_net_profit->avg_net_profit)?>">
										</td>
										<td>
											<?=round($obligation->percentage_of_avg_net_profit)?>
											<input  type="hidden" name="percentage_of_avg_net_profit" value="<?=round($obligation->percentage_of_avg_net_profit)?>">
										</td>
										<td>
											<?=round($obligation->CSR_obligation_current_FY)?>
											<input  type="hidden" name="CSR_obligation_current_FY" value="<?=round($obligation->CSR_obligation_current_FY)?>">
										</td>
										<td>
											<?=$director_report->amt_unspent_for_FY?>
											<input type="hidden" name="amt_unspent_for_FY" value="<?=$director_report->amt_unspent_for_FY?>">
										</td>
									</tr>
								</tbody>
							</table>
						</div>

					</div>
					<div class="financial_year">
						<label class="control-label" style="color:#000000;">Manner in which amount spent during the
							financial year: *</label>
						<table class="table profit">
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
								</tr>
								<?php foreach($director_project as $key => $row){ ?>
								<tr>
									<th style=" width: 75px; "><?=++$key?></th>
									<td>
										<?=$row->project_activity_name?>
									</td>
									<td>
										<?=($row->sector ? $row->sector : '-')?>
										<input type="hidden" data-sdgs='<?=$row->sdgs_id?>' name="sector[]" value="<?=$row->sector?>">	
									</td>
									<td>
										<?=($row->is_project_location_local == 1)? 'Yes':'No' ?>
									</td>
									<td>
										<?=($row->project_location_state ? $row->project_location_state : '-')?>
									</td>
									<td>
										<?=($row->project_outlay_amt ? $row->project_outlay_amt : '-')?>
										<input type="hidden" name="project_outlay_amt[]" value="<?=$row->project_outlay_amt?>" >
									</td>
									<td>
										<?=$row->direct_expenditure?>
										<input type="hidden" class="comulative-calculate" value="<?=$row->direct_expenditure?>" name="direct_expenditure[]">
									</td>
									<td>
										<?=($row->overheads ? $row->overheads : '-')?>
										<input type="hidden" class="comulative-calculate" value="<?=$row->overheads?>" name="overheads[]">
									</td>
									<td>
										<?=$row->cumulative_expense?>
										<input type="hidden" class="total" value="<?=$row->cumulative_expense?>" name="cumulative_expense[]">
									</td>
									<td>
										<?=($row->is_direct_implementation_dir_report == 1)? 'Implementing agency':'Direct' ?>
									</td> 
								</tr>
								<?php } ?>
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
								</tr>
							</tfoot>

						</table>
						<div class="note">
							<p><b>Note:</b> With respect to the projects identified by the Company as a part of its CSR
								activities, the Company had an outlay of (₹) <span class="budget-text-display"></span> against which a cumulative expenditure of (₹)
								<span class="expenditure-text-display"></span> has been incurred upto March 31, <?php echo $year[1]; ?> (financial closing year)
							</p>
						</div>
						<?php if($director_report->reason_failed_to_csr_spend_director_report){ ?>
						<div class="reasons">
							<p>
								<label>
									In case the company has failed to spend the 2% of the average net profit of the
									last 3 FY or any part of thereof, the company
									shall provide he reasons for not spending the amount in its Board report.
									(Optional)
								</label>
							</p>
							<div class="note">
								<p class="text-area-content"><?=$director_report->reason_failed_to_csr_spend_director_report?></p>
							</div>
						</div>
						<?php } ?>
						<div class="reasons">
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
					<?php if($case_study->case_study_title){ ?>
					<div class="additional_information">
						<h2>Additional Information</h2>
						<p class="case_stu">Case Study</p>
						<div class="write_report write_add_info">
							<p><label>Case Study Title</label></p>
							<div class="note mb-35">
								<p class="p-25"><?=$case_study->case_study_title?></p>
							</div>
							<p><label>Case Study Description</label></p>
							<div class="note mb-35">
								<p class="text-area-content p-25"><?=$case_study->case_study?></p>
							</div>
							<p><label>Conclusion</label></p>
							<div class="conclussion mb-35">
								<div class="note">
									<p class="text-area-content p-25"><?=$case_study->conclusion?></p>
								</div>
							</div>
							<div class="add_images">
								<p><label>Images</label></p>
								<?php foreach($case_study_image as $path){ ?>
									<div class="upload_imgs">
										<img src="<?=MEDIA_URL.''.$path->path?>">
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php if($testimonials){ ?>
					<div class="additional_information testimonails">
						<h2>Testimonials</h2>
						<div class="additional_information-testimonials">
							<?php foreach($testimonials as $row){ ?>
								<div class="row testimonails-count">
									<div class="col-md-2 image-container">
										<div class="upload_imgs">
											<img src="<?php echo CSR_COMPLIANCE_URL.$row->person_image; ?>">
										</div>
									</div>
									<div class="col-md-10">
										<div class="row">
											<p><?=$row->person_name?> - <?=$row->person_designation?> <?=$row->person_organisation?></p>
											<div class="note">
												<p class="text-area-content"><?=$row->testimonial_description?></p>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
					<?php } ?>
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
		<div class="save_btns">
			<div class="col-sm-12">
				<div class="wrap_flex_btn">
					<div class="form-group">
						<a href="<?php echo base_url(); ?>CsrCompliance/dashboard" class="cancelBtn">Cancel</a>
					</div>
					<div class="form-group">
						<a target="_blank" style="line-height: 40px;" href="<?=base_url()?>CsrCompliance/previewreport?year=<?=$_GET['year']?>&report_id=<?=$_GET['report_id']?>&action=pdf" class="btn btn-primary saveBtn">Download</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</body>
<script type="text/javascript" src="<?php echo SKIN_URL . 'js/compliance.js?v=' . JS_CSC_V; ?>"></script>
<script>
	comulativeCalculation();
	sdgs();
</script>