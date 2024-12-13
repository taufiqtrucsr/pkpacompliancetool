<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('common/head_common'); ?>

<body class=" Create-Project-step creare-report-page">
	<?php $this->load->view('common/header'); ?>
	<div id="contractDetailsBlock" class="">
		<div class="container" >
			<div class="col-md-12">
				<div class="kyc-title"> <h2>Progress Report - <?php echo $progress_details->report_type_name;?></h2></div>
				<p class="text-center due-date"> Due date <?php echo date('d-m-Y',$progress_details->due_date);?> </p>

				<?php echo form_open( base_url( 'reports/reportPostForm' ), array( 'id' => 'pro-report-form', 'method' => 'POST',  'enctype' => 'multipart/form-data') );?>
				<div class="row setup-content registration-flow-setup tab-pane fade active in progress-report-section" id="info">
					<input type="hidden" name="reportID" id="reportID" value="<?php echo $progress_details->report_id;?>">
					<div class="" id="">
						<div class="sel-contri-box">	
							<div class="form-group col-sm-6 ">
								<label class="control-label grey-txt">SELECT CONTRIBUTORS</label>
								<div class="select-box">
									
									<select id="contributors" name="contributors[]" multiple class="form-control" onchange="reportFundsReceive(this);">
										<?php if(isset($contributorsList) && count($contributorsList) > 0) {
											foreach($contributorsList as $contributor) { ?>
										<option value="<?php echo $contributor->id;?>"><?php echo $contributor->funded_by;?></option>
										<?php } } ?>
									</select> 
								</div>
							</div>
						</div><!-- sel-contri-box -->
								
					  	<div class="form-group col-sm-12 mar-bot-10">
							<label class="control-label">PROJECT TITLE</label>
							<div class="profile-text-details"><?php echo $progress_details->project_name;?></div><!-- profile-text-details -->
					  	</div>

			  		<div class="form-group col-sm-12 mar-bot-10">
						<label class="control-label">DESCRIPTION</label>
						<div class="profile-text-details"><?php echo $progress_details->project_description;?></div><!-- profile-text-details -->
			  		</div>
			  		<?php
					$date1 = $progress_details->project_date_from;
					$date2 = $progress_details->project_date_to;							
					$get_interval_in_month = $this->CommonModel->get_interval_in_month($date1, $date2);		
					?>
					<div class="col-sm-12">
						<div class="row">
							<div class="form-group col-sm-6  mar-bot-10">
								<label class="control-label">DURATION</label>
								<div class="profile-text-details"><?php echo ($get_interval_in_month>1) ? $get_interval_in_month.' months': $get_interval_in_month.' month';?></div><!-- profile-text-details -->
							</div>	
							
							<div class="form-group col-sm-6 location-details-icon  mar-bot-10">
								<label class="control-label" >LOCATION</label>
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
								<label class="control-label">BENEFICIARIES  <span class="info-tip"><a data-toggle="tooltip" title="BENEFICIARIES" data-original-title="BENEFICIARIES"><img src="<?=SKIN_URL?>/images/info_grey.png"></a></span></label>
							   <div class="profile-text-details"><?php echo $progress_details->serve_beneficiaries.'/'.$progress_details->total_beneficiaries;?></div><!-- profile-text-details -->
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
					<div class="form-group col-sm-12 mar-bot-10 report-period">
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
					<label class="control-label " for="orgState">STATUS FOR WORK ACTIVITY</label>
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

			<div class="image-sec">
				<div class="col-sm-12 create-report-img-sec">
					<div class="image-add" id="image-add">
						<input type="hidden" id="total_image_added" class="total_image_added" value="1"> 
						<div class="image-add-block" id="image-add-block">
							<?php include('add_image_form.php'); ?> 
						</div>
						<p class="pad-5"></p>
						<div class="button-set add-another-img">
							<button class="add-entry-button" type="button" id="" onclick="addImageEntry();">+ Add another image</button>
						</div>
					</div>
				</div><!-- create-report-img-sec -->
			</div><!-- image-sec -->
            
            <div id="contributorDiv">
            <?php
                $fundHtml='';
	            $totalOtherCommitAmt=0;
	            $totalOtherReceiveAmt=0;
	            $totalOtherBalanceAmt=0;
	            $totalCommitAmt=0;
				$totalReceiveAmt=0;
				$totalBalanceAmt=0;
				 
                $fundHtml.='<div class="form-group  funded-table fund-received-table">';
					$fundHtml.='<p class="second-heading">FUNDS	RECEIVED FROM CONTRIBUTORS NAME</p>';
					$fundHtml.='<div class="team-members overflow-table  white-box">';
					    $fundHtml.="<br/>No Records Found<br/><br/>";
					$fundHtml.='</div>';

					$fundHtml.='<div class="add-another-fund-box">';
					    $fundHtml.='<div class="col-sm-4"><span> AMOUNT <br>COMMITTED</span> <input class="form-control" type="text" id="totalCommit" value="₹ '.number_format($totalCommitAmt, 0, '', ',').'" placeholder="--" disabled="disabled"></div>';
						$fundHtml.='<div class="col-sm-4"><span> AMOUNT <br>RECEIVED</span> <input class="form-control" type="text" id="received_amount" value="₹ '.number_format($totalReceiveAmt, 0, '', ',').'"  placeholder="--" disabled="disabled"></div>';
						$fundHtml.='<div class="col-sm-4"><span> BALANCE <br>AMOUNT </span> <input class="form-control" type="text" id="balance_amount" value="₹ '.number_format($totalBalanceAmt, 0, '', ',').'"  placeholder="--" disabled="disabled"></div>';
					$fundHtml.='</div>';
			    $fundHtml.='</div>';
                
                if(isset($unselectContributor) && count($unselectContributor) > 0){
				    $fundHtml.='<div class="form-group  funded-table fund-received-table">';
						$fundHtml.='<p class="second-heading">FUNDS	RECEIVED FROM OTHER  CONTRIBUTORS  <!--span class="remove-link"><a href="">Remove</a></span--></p>';
						$fundHtml.='<div class="team-members overflow-table  white-box">';
							$fundHtml.='<table cellpadding="0" cellspacing="0" align="center">';
								$fundHtml.='<thead>';
									$fundHtml.='<tr>';
										$fundHtml.='<th>FUNDED BY</th>';
										$fundHtml.='<th>DATE RECEIVED</th>';
										$fundHtml.='<th>SOURCE</th>';
										$fundHtml.='<th>COMMITTED</th>';
										$fundHtml.='<th>RECEIVED</th>';
										$fundHtml.='<th>BALANCE</th>';
									$fundHtml.='</tr>';
								$fundHtml.='</thead>';
								$fundHtml.='<tbody id="OtherContributerTable">';
								foreach($unselectContributor as $key => $value){
									$created= date('d-m-Y',$value->created_at);
									$fundHtml.='<tr id="'.$value->id.'">';
									    $fundHtml.='<td><input type="text" class="form-control " id="funded_by_'.$value->id.'" name="funded_by[]" value="'.$value->funded_by.'" placeholder="'.$value->funded_by.'" disabled="disabled"></td>';
									    $fundHtml.='<td><input type="text" class="form-control " id="funded_by_'.$value->id.'" name="created_at[]" value="'.$created.'" placeholder="'.$created.'" disabled="disabled"></td>';
									    $fundHtml.='<td><input type="text" class="form-control " id="source_'.$value->id.'" name="source[]" value="'.$value->source.'" placeholder="'.$value->source.'" disabled="disabled"></td>';
									    $fundHtml.='<td class="medium-td rupee-box"><input type="text" class="form-control amount-number " name="committed_amount" id="committed_amount_'.$value->id.'" value="'.number_format($value->committed_amount, 0, '', ',').'" disabled="disabled"></td>';
									    $fundHtml.='<td class="medium-td rupee-box"><input type="text" class="form-control amount-number " name="received_amount" id="received_amount_'.$value->id.'" value="'.number_format($value->received_amount, 0, '', ',').'" disabled="disabled"></td>';
									    $fundHtml.='<td class="medium-td rupee-box"><input type="text" class="form-control amount-number " name="balance_amount" id="balance_amount_'.$value->id.'" value="'.number_format($value->balance_amount, 0, '', ',').'" disabled="disabled"></td>';
									$fundHtml.='</tr>';
	                                $totalOtherCommitAmt=$totalOtherCommitAmt + $value->committed_amount;
									$totalOtherReceiveAmt=$totalOtherReceiveAmt + $value->received_amount;
									$totalOtherBalanceAmt=$totalOtherBalanceAmt + $value->balance_amount;
								}
								$fundHtml.='</tbody>';
							$fundHtml.='</table>';
						$fundHtml.='</div>';
					
						$fundHtml.='<div class="add-another-fund-box total-sub">';
							$fundHtml.='<div class="col-sm-4"><span> AMOUNT <br>COMMITTED</span> <input class="form-control" type="text" id="OthertotalCommit" value="₹ '.number_format($totalOtherCommitAmt, 0, '', ',').'" placeholder="--" disabled="disabled"></div>';
							$fundHtml.='<div class="col-sm-4"><span> AMOUNT <br>RECEIVED</span> <input class="form-control" type="text" id="Otherreceived_amount" value="₹ '.number_format($totalOtherReceiveAmt, 0, '', ',').'"  placeholder="--" disabled="disabled"></div>';
							$fundHtml.='<div class="col-sm-4"><span> BALANCE <br>AMOUNT </span> <input class="form-control" type="text" id="Otherbalance_amount" value="₹ '.number_format($totalOtherBalanceAmt, 0, '', ',').'"  placeholder="--" disabled="disabled"></div>';
						$fundHtml.='</div>';
				    $fundHtml.='</div>';
			    }

			    $recAmt	= $totalOtherReceiveAmt+$totalReceiveAmt;
				$balAmt	= $totalOtherBalanceAmt+$totalBalanceAmt;
				
				$fundHtml.='<div class="funds-summary total-sm">';
					$fundHtml.='<div class="form-group col-sm-6">';
						$fundHtml.='<label class="control-label grey-txt">TOTAL AMOUNT RECEIVED </label>';
						$fundHtml.='<input class="form-control" id="totalRecivedAmt" type="text" value="₹ '.number_format($recAmt, 0, '', ',').'" placeholder="--" disabled="disabled">';
					$fundHtml.='</div>';
					$fundHtml.='<div class="form-group col-sm-6">';
						$fundHtml.='<label class="control-label grey-txt">TOTAL BALANCE AMOUNT</label>';
						$fundHtml.='<input class="form-control" id="totalBalanceAmt" type="text" value="₹ '.number_format($balAmt, 0, '', ',').'" placeholder="--" disabled="disabled">';
					$fundHtml.='</div>';
				$fundHtml.='</div>';

				echo $fundHtml;

            ?>	
            </div>
	</div><!-- fund-received-table -->

	<div class="form-group  fund-received-table ">
		<p class="second-heading">FUNDS	UTILIZED</p>
		<div class=" financial-table overflow-table  white-box">
			<table cellpadding="0" cellspacing="0" align="center">
				<tbody>
					<tr>
						<th>SR.NO</th>
						<th>DESCRIPTION</th>
						<th>FUNDED BY</th>
						<th>AMOUNT SPENT</th>
						<th>DOCUMENT</th>
					</tr>
					<?php 
					$totalSpentAmt=0;
					$fundUtilizedHtml="";
					if(isset($proFundUtilized) && count($proFundUtilized)>0){
						$i=1;
						foreach($proFundUtilized as $value){
						    $totalSpentAmt=$totalSpentAmt+$value->amount;
							$fundUtilizedHtml.='<tr>';
								$fundUtilizedHtml.='<td class="grey-td"><span>'.$i.'</span></td>';
								$fundUtilizedHtml.='<td class="big-td">';
									$fundUtilizedHtml.='<input class="form-control" type="text" value="'.$value->amount_description.'" placeholder="We are aiming to make the villiage" disabled="disabled">';
								$fundUtilizedHtml.='</td>';
								$fundUtilizedHtml.='<td class="big-td">';
											foreach($contributorsList as $contributorFund) { 
												if($contributorFund->id==$value->project_contributor_fund_id){
													$funded_by=$contributorFund->funded_by;
												}
											}
											$fundUtilizedHtml.='<input class="form-control" type="text" value="'.$funded_by.'" placeholder="" disabled="disabled">';
								$fundUtilizedHtml.='</td>';
								$fundUtilizedHtml.='<td class="medium-td rupee-box">';
									$fundUtilizedHtml.='<input type="text" class="form-control amount-number validate-number" value="'.$value->amount.'" disabled="disabled">';
								$fundUtilizedHtml.='</td>';
								$ext = pathinfo(FUND_UTILIZED_IMG_PATH.$value->document, PATHINFO_EXTENSION);
								if($ext == 'pdf'){
									$imageSrc=SKIN_URL.'images/pdf-icon.png';
								}else{
									$imageSrc=FUND_UTILIZED_IMG_URL.$value->document;
								}
								$fundUtilizedHtml.='<td>';
									$fundUtilizedHtml.='<div class="incp-sec" id="upload_img_reciept_<?php echo $i;?>" >';
										$fundUtilizedHtml.='<span class="upload-file">';
											$fundUtilizedHtml.='<img class="imageThumb" src="'.$imageSrc.'" width="100" height="100">';
											$fundUtilizedHtml.='<span class="file-name">'.$value->document.'</span>';	
										$fundUtilizedHtml.='</span>';
									$fundUtilizedHtml.='</div>';
								$fundUtilizedHtml.='</td>';
							$fundUtilizedHtml.='</tr>';
						    $i++;
						} 
					}
                    
                    
					$fundUtilizedHtml.='<tr>';
						$fundUtilizedHtml.='<td class="grey-td">';
							$fundUtilizedHtml.='<span>'.$i.'</span>';
						$fundUtilizedHtml.='</td>';
						$fundUtilizedHtml.='<td class="big-td">';
							$fundUtilizedHtml.='<input type="text" class="form-control" id="amount_description" name="amount_description" placeholder="We are aiming to make the villiage">';
						$fundUtilizedHtml.='</td>';
						$fundUtilizedHtml.='<td class="big-td">';
							$fundUtilizedHtml.='<div class="select-box">';
								$fundUtilizedHtml.='<select id="project_contributor_fund_id" name="project_contributor_fund_id" class="form-control">';
								    foreach($contributorsList as $contributorfunding) {
								        $fundUtilizedHtml.='<option value="'.$contributorfunding->id.'">'.$contributorfunding->funded_by.'</option>';
								    }
								$fundUtilizedHtml.='</select>'; 
							$fundUtilizedHtml.='</div>';
						$fundUtilizedHtml.='</td>';
						$fundUtilizedHtml.='<td class="medium-td rupee-box">';
							$fundUtilizedHtml.='<input type="text" class="form-control amount-number validate-number" name="amount" id="amount">';
						$fundUtilizedHtml.='</td>';
						$fundUtilizedHtml.='<td>';
							$fundUtilizedHtml.='<div class="incp-sec" id="upload_img_reciept"></div>';
							$fundUtilizedHtml.='<div class="reciept-upload" style="display:block">';
								$fundUtilizedHtml.='<input class="upload-receipt" type="file" name="document" id="document" onchange="readRecieptURL(this);">';
							$fundUtilizedHtml.='</div>';	
						$fundUtilizedHtml.='</td>';
					$fundUtilizedHtml.='</tr>';
					echo $fundUtilizedHtml;
					?>
				</tbody>
			</table>
		</div>
		<div class="button-set"><button class="add-entry-button" type="submit">+ Add another entry</button></div>
		<div class="add-another-fund-box">
			<div class="col-sm-4"><span>TOTAL AMOUNT <br>RECEIVED</span> <input class="form-control" type="text" value="₹ <?=number_format($recAmt, 0, '', ',')?>" placeholder="--"></div>
			<div class="col-sm-4"><span>TOTAL AMOUNT <br>SPENT</span> <input class="form-control" type="text" value="₹ <?=number_format($totalSpentAmt, 0, '', ',')?>"  placeholder="--"></div>
			<div class="col-sm-4"><span>TOTAL BALANCE <br>UNSPENT  </span> <input class="form-control" type="text" value="₹ <?=number_format($recAmt - $totalSpentAmt, 0, '', ',')?>"  placeholder="--"></div>
		</div>
	</div><!-- fund-received-table -->

	<div class="form-group  fund-received-table">
		<p class="second-heading">MILESTONE SUMMARY</p>
		<div class=" financial-table overflow-table wid-300  white-box">
			<table cellpadding="0" cellspacing="0" align="center">
				<tbody>
					<tr>
						<th>MILESTONE</th>
						<th>START DATE</th>
						<th>END DATE</th>
						<th>AMOUNT ALLOTED</th>
						<th>STATUS</th>
					</tr>

					<tr>
						<td>Build the foundation for the building</td>
						<td>12-04-2019</td>
						<td>12-04-2019</td>
						<td><i class="fa fa-inr"></i> 6,20,000 (40%)</td>
						<td>
							<select class="form-control"><option>Completed</option></select>	
						</td>
					</tr>
				</tbody>
			</table>
			<table cellpadding="0" cellspacing="0" align="center">
				<tbody>
					<tr>
						<th class="wid-300"></th>
						<th>ACTUAL START DATE</th>
						<th>ACTUAL END DATE</th>
						<th>ACTUAL AMOUNT SPENT</th>
					</tr>

					<tr>
						<td></td>
						<td><div class="date-box">
						<input type="text" class="form-control" placeholder="DD MM YYYY" id="" name="" value="27 May 2018" >
						</div></td>
						
						<td><div class="date-box">
						<input type="text" class="form-control" placeholder="DD MM YYYY" id="" name="" value="27 May 2018" >
						</div>
						</td>
						<td class="medium-td rupee-box"><input type="text" class="form-control amount-number " name="" id="" value="1,75,000(30%)"></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div><!-- fund-received-table -->
	<div class="add-descp-block form-group">
		<label class="control-label">ADD DESCRIPTION <span class="remove-link"><a href="">Remove</a></span></label>
		<textarea class="form-control" placeholder="Enter decription here">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</textarea>
		<div class="button-set"><button class="add-entry-button" type="button" id="" onclick="">+ Add another</button></div>
	</div><!-- add-descp-block -->

	<div class="add-descp-block-list form-group">
		<div  class="blue-table overflow-table  white-box">
			<table cellpadding="0" cellspacing="0" align="center">
				<tbody>
					<tr>
						<td>Build the foundation for the building</td>
						<td>12-04-2019</td>
						<td>12-04-2019 </td>
						<td>₹ 1,25,000(30%)</td>
						<td><select class="form-control"><option>In progress</option></select></td>
					</tr>

					<tr>
						<td>Build the foundation for the building</td>
						<td>12-04-2019</td>
						<td>12-04-2019 </td>
						<td>₹ 1,25,000(30%)</td>
						<td><select class="form-control"><option>Not started</option></select></td>
					</tr>
					<tr>
						<td>Build the foundation for the building</td>
						<td>12-04-2019</td>
						<td>12-04-2019 </td>
						<td>₹ 1,25,000(30%)</td>
						<td><select class="form-control"><option>Not started</option></select></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div><!-- add-descp-block-list -->
					
		<div class="form-group">
			<input type="hidden" id="total_casestudy_added" class="total_casestudy_added" value="1"> 
			<div class="case-study-add-block" id="case-study-add-block">
				<?php include('add_case_study_form.php'); ?> 
			</div>

			<div class="button-set">
				<button class="add-entry-button" type="button" id="" onclick="addCaseStudyEntry()">+ Add case study</button>
			</div>
		</div>
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
					<input class="btn btn-primary cancelBtnbtn-lg border-btn" name="proReportFormbtn" type="button" value="Save As Draft" onclick="saveAsDraft()">
				</div>
				<div class="col-sm-4">
					<input class="btn btn-primary nextBtn btn-lg" type="submit" name="proReportFormbtn" id="proReportFormbtn" value="CREATE REPORT">
				</div>	
			</div>
		</div>
		</div>
	</div>
</div>
</form>
<!-- <a class="btn btn-primary " href="create-report-4.html" style=" width: 200px;  float: right; margin-right: 20px;">Create report 4</a> -->
<script type="text/javascript">
	function reportFundsReceive(){
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
	    $("#fundUtilizedForm").validate({
			ignore: ':hidden', 
			rules: {
				amount_description: {
					required: true
				},
				amount: {
					required: true,
					pattern: /^[0-9,]+$/,
					minlength: 3
					//minStrict: 99
				},
				document: {
					required: true
				},
				
			},
			messages: {
			   amount_description: 'Enter fund spent description',
			   amount: 'Enter fund amount',
			   document: 'Enter fund document pdf',
			},
			submitHandler: function(form) { 
				var form_data = new FormData($("#fundUtilizedForm")[0]);
				$.ajax({
					url: BASE_URL+"funds/add_contributor_fund_utilized",
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
	});

	function addImageEntry() { 
  
	  var total_image_recieved=$('#total_image_added').val();
	  if(total_image_recieved=='')
	  {
	    total_image_recieved=1;
	    $('#total_image_added').val(total_image_recieved);
	  }
	  
	  var i = 1;
	  for(i;i<=total_image_recieved;i++){
	    goalDescription = $("#ImageDescription_"+i).val();
	    goalImg = $("#rep_img_"+i).val();
	    
	    if(goalImg == '' || goalDescription == ''){
	    $.toast({
	      heading: '',
	      text: 'Cannot be blank',
	      showHideTransition: 'slide',
	      icon: 'error'
	      }); 
	      return false; 
	    }
	  }
	  
	  new_total_goal_recieved=parseInt(total_image_recieved) + parseInt(1);
	  $('#total_image_added').val(new_total_goal_recieved);
	      
	  $.ajax({
	    type: 'POST', 
	    url: BASE_URL+"reports/addImageEntry",
	    data: {
	      counter:new_total_goal_recieved
	    },
	    success: function(data) {
	      $('#image-add-block').append(data);
	    }
	  });

	}


	function addFundUtilizedEntry() {	
	
		var total_fund_utilized=$('#total_fund_utilized').val();
		var new_total_fund_utilized=$('#total_fund_utilized').val();
		if(total_fund_utilized=='')
		{
			new_total_fund_utilized=1;
		}
		$('#total_fund_utilized').val(new_total_fund_utilized);
		
		var i = 1;
		for(i;i<=new_total_fund_utilized;i++){
			fundDescription = $("#fundDescription_"+i).val();
			amountSpent = $("#amountSpent_"+i).val();
			reciept = $("#reciept_"+i).val();
			
			if(fundDescription == '' || amountSpent == ''){
			$.toast({
				heading: '',
				text: 'Cannot be blank',
				showHideTransition: 'slide',
				icon: 'error'
			});	
			return false;	
			}
		}
		
		new_total_fund_utilized=parseInt(new_total_fund_utilized) + parseInt(1);
		$('#total_fund_utilized').val(new_total_fund_utilized);

		$.ajax({
			type: 'POST',	
			url: BASE_URL+"reports/addFundUtilizedEntry",
			data: {
				counter:new_total_fund_utilized
			},
			success: function(data) {
				$('#fund-utilize-block').append(data);
			}
		});

	}

	function addCaseStudyEntry() {	
		
		var total_casestudy_added=$('#total_casestudy_added').val();
		var new_total_casestudy_added=$('#total_casestudy_added').val();
		if(total_casestudy_added=='')
		{
			new_total_casestudy_added=1;
		}
		$('#total_casestudy_added').val(new_total_casestudy_added);
		
		var i = 1;
		for(i;i<=new_total_casestudy_added;i++){
			caseStudyTitle = $("#caseStudyTitle_"+i).val();
			caseStudyDescription = $("#caseStudyDescription_"+i).val();
			caseStudyImg = $("#caseStudy_img_"+i).val();
			
			if(caseStudyTitle == '' || caseStudyDescription == ''){
			$.toast({
				heading: '',
				text: 'Cannot be blank',
				showHideTransition: 'slide',
				icon: 'error'
			  });	
				return false;	
			}
		}
		
		new_total_casestudy_added=parseInt(new_total_casestudy_added) + parseInt(1);
		$('#total_casestudy_added').val(new_total_casestudy_added);

		$.ajax({
			type: 'POST',	
			url: BASE_URL+"reports/addCaseStudyEntry",
			data: {
				counter:new_total_casestudy_added
			},
			success: function(data) {
				$('#case-study-add-block').append(data);
			}
		});

	}

	

</script>
	<script type="text/javascript" src="<?php echo SKIN_URL; ?>js/reports.js?v=<?php echo JS_CSC_V; ?>"></script>
	<?php $this->load->view('common/footer'); ?>
	<?php $this->load->view('common/footer_js'); ?>
</body>
</html>