<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('common/head_common'); ?>

<body class=" Create-Project-step creare-report-page">
    <?php $this->load->view('common/header'); ?>

    <script type="text/javascript" src="<?php echo SKIN_URL; ?>js/highcharts.js?v=<?php echo JS_CSC_V; ?>"></script>
    <div id="contractDetailsBlock" class="">
        <div class="container">
            <div class="col-md-12">
                <div class="kyc-title">
                    <h2>Progress Report - <?php echo $progress_details->report_type_name;?></h2>
                </div>
                <p class="text-center due-date"> Due date <?php echo date('d-m-Y',$progress_details->due_date);?> </p>
                <div class="row setup-content registration-flow-setup  tab-pane fade active in progress-report-section" id="info">
                    <div class="" id="">
                        <div class="sel-contri-box">
                            <div class="form-group col-sm-6 ">
                                <label class="control-label grey-txt">SELECT CONTRIBUTORS</label>
                                <div class="profile-text-details">
                                    <?php
										if(isset($selectedContributorArr) && count($selectedContributorArr)>0){
											$count=1;	
											foreach($selectedContributorArr as $key => $value){
											    // echo $count.". ".$value->funded_by."&nbsp; "; //original code commented
                                                // echo $count.". ".$value->company_name."<br>";
                                                echo $value->funded_by."<br> "; //original code commented
												$count++;
											}
										}
									?>
                                </div>
                            </div>
                        </div><!-- sel-contri-box -->

                        <div class="form-group col-sm-12 mar-bot-10">
                            <label class="control-label">REPORT COVER IMAGE</label><br>
                
                           <?php if($get_report_cover_details->cover_image==""){
                                $display="none";
                            }else{
                                $display="block";
                            } ?>
                            <img class="imageThumb" src="<?php echo REP_COVER_IMG_URL.$get_report_cover_details->cover_image;?>" name="case_study_images" width="400" hieght="200" title="This is cover image" style="display:<?php echo $display; ?>;height: 200px;width: 400px;object-fit: cover;" >
                            <br><br>
                        </div>

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
                                    <div class="profile-text-details">
                                        <?php echo ($get_interval_in_month>1) ? $get_interval_in_month.' months': $get_interval_in_month.' month';?>
                                    </div><!-- profile-text-details -->
                                </div>

                                <div class="form-group col-sm-6 location-details-icon  mar-bot-10">
                                    <label class="control-label">PROJECT LOCATION</label>
                                    <div class="select-box">
                                        <div class="profile-text-details loc-tag-label">
                                            <?php echo $progress_details->district.', '.$progress_details->city;?>
										</div>
                                        <!-- profile-text-details -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $sectors = $this->ProjectModel->getSectors($progress_details->sectors);?>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="form-group col-sm-6  mar-bot-10">
                                    <label class="control-label">SECTOR</label>
                                    <div class="profile-text-details"><?php echo implode(', ',$sectors);?></div>
                                    <!-- profile-text-details -->
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
                                    <div class="profile-text-details"><?php echo implode(', ',$beneficiaries);?></div>
                                    <!-- profile-text-details -->
                                </div>

                                <div class="form-group col-sm-6 mar-bot-10">
                                    <!-- <label class="control-label">BENEFICIARIES <span class="info-tip"><a data-toggle="tooltip" title="BENEFICIARIES" data-original-title="BENEFICIARIES"><img src="<?=SKIN_URL?>/images/info_grey.png"></a></span></label>
                                    <div class="profile-text-details">
                                        < ?php echo $progress_details->serve_beneficiaries.'/'.$progress_details->total_beneficiaries;?>
                                    </div> -->
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
                            <label class="control-label">REPORT PERIOD</label>
                            <div class="profile-text-details"><?php echo $strt_period; ?> &nbsp; <i
                                    class="fa fa-angle-right"></i> &nbsp;
                                <?php echo date('d-m-Y',$progress_details->due_date);?></div>
                            <!-- profile-text-details -->
                            <input type="hidden" name="start_period" value="<?php echo $strt_period; ?>">
                            <input type="hidden" name="end_period"
                                value="<?php echo date('d-m-Y',$progress_details->due_date); ?>">
                        </div>

                        <div class="form-group col-sm-12">
                            <label class="control-label ">WORK DESCRIPTION / ACTIVITIES</label>
                            <div class="profile-text-details"><?php echo $progress_details->work_description;?></div>
                            <!-- profile-text-details -->
                        </div>

                        <div class="col-sm-12">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="control-label ">NO. OF BENEFICIARIES</label>
                                    <div class="profile-text-details">
                                        <?php echo $progress_details->no_of_beneficiaries;?></div>
                                    <!-- profile-text-details -->
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label " for="orgState">STATUS FOR WORK ACTIVITY / ACTIVITIES</label>
                                    <div class="select-box">
                                        <div class="profile-text-details">
                                            <?php echo $progress_details->work_activity_status;?></div>
                                        <!-- profile-text-details -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- col-sm-12 -->
                        <div class="image-sec"></div>
                        <div class="col-sm-12 form-group">
                            <p class="second-heading">ACTIVITIES DETAILS</p>
                        </div>
                        <div class="image-sec">
                            <?php
								if(isset($proReportImageData) && count($proReportImageData)>0){
									foreach($proReportImageData as $value){
								?>
                            <div class="col-sm-12 create-report-img-sec">
                                <div class="col-sm-2 image-s">
                                    <label class="control-label">ACTIVITY IMAGE</label>
                                    <img src="<?=REP_IMG_URL.$value->image_path?>" width="100" height="100">
                                </div>
                                <div class="col-sm-10 descp-s">
                                    <label class="control-label">ACTIVITY DESCRIPTION </label>
                                    <div class="profile-text-details"><?=$value->image_description?></div>
                                </div>
                            </div><!-- create-report-img-sec -->
                            <?php 
									}
								}
								?>
                        </div><!-- image-sec -->

                        <?php 
						$totalBudgetAmt = ($progress_details->total_project_cost) + 0;
						// $totalCommitedAmt= ($progress_details->alrecd_committed_amount) + ($progress_details->alrecd_committed_amount_trucsr) + ($progress_details->contract_fund_received);
						// $progressPercent=$this->CommonModel->getPercentOfNumber($totalDonationAmt,$totalFundingAmt);
						?>
                        <div class="funds-summary form-group col-sm-12">
                            <p class="second-heading">FUNDS SUMMARY</p>
                            <div class="col-sm-5 pad-left-zero">
                                <label class="control-label grey-txt line-height-55">TOTAL PROJECT BUDGET</label>
                                <input class="form-control" type="text" value="₹ <?php echo $totalBudgetAmt;?>" placeholder="" disabled>
                            </div><!-- col-sm-6 -->
                            <div class="col-sm-5 pad-left-zero ">
                                <label class="control-label grey-txt line-height-55">TOTAL AMOUNT COMMITTED </label>
                                <input class="form-control" id="totalCommitedAmt" type="text" value="₹ " placeholder="" disabled>
                            </div><!-- col-sm-6 -->
                        </div><!-- funds-summary -->

                        <div class="graph-funds form-group">
                            <img style="width:100%;">
                            <div id="funds_summery" style="overflow: visible !important;"></div>                            
                        </div><!-- graph-funds -->

                        <?php
							$fundHtml='';
							$totalOtherCommitAmt=0;
							$totalOtherReceiveAmt=0;
							$totalOtherBalanceAmt=0;
							$totalCommitAmt=0;
							$totalReceiveAmt=0;
							$totalBalanceAmt=0;
							
							$fundHtml.='<div class="form-group  funded-table fund-received-table">';
							if(isset($selectedContributorArr) && count($selectedContributorArr)>0){
								$fundHtml.='<p class="second-heading">FUNDS	RECEIVED FROM CONTRIBUTORS NAME</p>';
								$fundHtml.='<div class="team-members overflow-table  white-box">';
									$fundHtml.='<table cellpadding="0" cellspacing="0" align="center">';
										$fundHtml.='<thead>';
											$fundHtml.='<tr>';
												$fundHtml.='<th>FUNDED BY</th>';
												// $fundHtml.='<th>DATE RECEIVED</th>'; //code commented
												$fundHtml.='<th>SOURCE</th>';
												$fundHtml.='<th>COMMITTED</th>';
												$fundHtml.='<th>RECEIVED</th>';
												$fundHtml.='<th>BALANCE</th>';
											$fundHtml.='</tr>';
										$fundHtml.='</thead>';
										$fundHtml.='<tbody id="appendTable">';
										foreach($selectedContributorArr as $key => $value){
											$created= date('d-m-Y',$value->created_at);
											$fundHtml.='<tr id="'.$value->id.'">';
												$fundHtml.='<td><input type="text" class="form-control " id="funded_by_'.$value->id.'" name="funded_by[]" value="'.$value->funded_by.'" placeholder="'.$value->funded_by.'" disabled="disabled"></td>';
												// $fundHtml.='<td><input type="text" class="form-control " id="funded_by_'.$value->id.'" name="created_at[]" value="'.$created.'" placeholder="'.$created.'" disabled="disabled"></td><td><input type="text" class="form-control " id="source_'.$value->id.'" name="source[]" value="'.$value->source.'" placeholder="'.$value->source.'" disabled="disabled"></td>'; //code commented because as of now its not required
                                                $fundHtml.='<td><input type="text" class="form-control " id="source_'.$value->id.'" name="source[]" value="'.$value->source.'" placeholder="'.$value->source.'" disabled="disabled"></td>';
												$fundHtml.='<td class="medium-td rupee-box"><input type="text" class="form-control amount-number " name="committed_amount" id="committed_amount_'.$value->id.'" value="'.number_format($value->committed_amount, 0, '', ',').'" disabled="disabled"></td>';
												$fundHtml.='<td class="medium-td rupee-box"><input type="text" class="form-control amount-number " name="received_amount" id="received_amount_'.$value->id.'" value="'.number_format($value->received_amount, 0, '', ',').'" disabled="disabled"></td>';
												$fundHtml.='<td class="medium-td rupee-box"><input type="text" class="form-control amount-number " name="balance_amount" id="balance_amount_'.$value->id.'" value="'.number_format($value->balance_amount, 0, '', ',').'" disabled="disabled"></td>';
											$fundHtml.='</tr>';
											$totalCommitAmt=$totalCommitAmt + $value->committed_amount;
											$totalReceiveAmt=$totalReceiveAmt + $value->received_amount;
											$totalBalanceAmt=$totalBalanceAmt + $value->balance_amount;
										}
										$fundHtml.='</tbody>';
									$fundHtml.='</table>';
								$fundHtml.='</div>';
								$fundHtml.='<div class="add-another-fund-box">';
									$fundHtml.='<div class="col-sm-4"><span> AMOUNT <br>COMMITTED</span> <input class="form-control" type="text" id="totalCommit" value="₹ '.number_format($totalCommitAmt, 0, '', ',').'" placeholder="--" disabled="disabled"></div>';
									$fundHtml.='<div class="col-sm-4"><span> AMOUNT <br>RECEIVED</span> <input class="form-control" type="text" id="received_amount" value="₹ '.number_format($totalReceiveAmt, 0, '', ',').'"  placeholder="--" disabled="disabled"></div>';
									$fundHtml.='<div class="col-sm-4"><span> BALANCE <br>AMOUNT </span> <input class="form-control" type="text" id="balance_amount" value="₹ '.number_format($totalBalanceAmt, 0, '', ',').'"  placeholder="--" disabled="disabled"></div>';
								$fundHtml.='</div>';
							}else{
								$fundHtml.='<p class="second-heading">FUNDS	RECEIVED FROM CONTRIBUTORS NAME</p>';
								$fundHtml.='<div class="team-members overflow-table  white-box">';
									$fundHtml.="<br/>No Records Found<br/><br/>";
								$fundHtml.='</div>';

								$fundHtml.='<div class="add-another-fund-box">';
									$fundHtml.='<div class="col-sm-4"><span> AMOUNT <br>COMMITTED</span> <input class="form-control" type="text" id="totalCommit" value="₹ '.number_format($totalCommitAmt, 0, '', ',').'" placeholder="--" disabled="disabled"></div>';
									$fundHtml.='<div class="col-sm-4"><span> AMOUNT <br>RECEIVED</span> <input class="form-control" type="text" id="received_amount" value="₹ '.number_format($totalReceiveAmt, 0, '', ',').'"  placeholder="--" disabled="disabled"></div>';
									$fundHtml.='<div class="col-sm-4"><span> BALANCE <br>AMOUNT </span> <input class="form-control" type="text" id="balance_amount" value="₹ '.number_format($totalBalanceAmt, 0, '', ',').'"  placeholder="--" disabled="disabled"></div>';
								$fundHtml.='</div>';
							}
							$fundHtml.='</div>';
							
							if(isset($unselectContributor) && count($unselectContributor) > 0){
								$fundHtml.='<div class="form-group  funded-table fund-received-table">';
									$fundHtml.='<p class="second-heading">FUNDS	RECEIVED FROM OTHER  CONTRIBUTORS  <!--span class="remove-link"><a href="">Remove</a></span--></p>';
									$fundHtml.='<div class="team-members overflow-table  white-box">';
										$fundHtml.='<table cellpadding="0" cellspacing="0" align="center">';
											$fundHtml.='<thead>';
												$fundHtml.='<tr>';
													$fundHtml.='<th>FUNDED BY</th>';
													// $fundHtml.='<th>DATE RECEIVED</th>'; //code commented
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
													// $fundHtml.='<td><input type="text" class="form-control " id="funded_by_'.$value->id.'" name="created_at[]" value="'.$created.'" placeholder="'.$created.'" disabled="disabled"></td>'; //code commented becasue date is not required
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
							$totalAmtToBeRaised = $totalBudgetAmt - $recAmt;
							$totalAllCommitAmt = $totalOtherCommitAmt + $totalCommitAmt;
							
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


                            // code for donation amount

                            $fundHtml.='<div class="form-group">';
                            $fundHtml.='<p class="second-heading">DONATION RECEIVED FROM INDIVIDUALS</p>';
                            $fundHtml.='<br>';
                            $fundHtml.='<table style="border:1px solid #d3d2d7;" cellpadding="0" cellspacing="0">';
                                $fundHtml.='<tr>';
                                    $fundHtml.='<td style="border:1px solid #d3d2d7;padding:10px;color:#9ea9c2;font-size:12px;">No. of Donors who contributed</td>';
                                    $fundHtml.='<td style="border:1px solid #d3d2d7;padding:10px;color:#9ea9c2;font-size:12px;">Total Amount Received</td>';
                                $fundHtml.='</tr>';
                                $fundHtml.='<tr>';
                                    $fundHtml.='<td style="border:1px solid #d3d2d7;padding:10px;color:#9ea9c2;font-size:12px;">'.$gettotaldonation->no_of_doners.'</td>';
                                    $fundHtml.='<td style="border:1px solid #d3d2d7;padding:10px;color:#9ea9c2;font-size:12px;">'.$gettotaldonation->total_donation.'</td>';
                                $fundHtml.='</tr>';
                            $fundHtml.='</table>';
                            $fundHtml.='</div>';
                            $fundHtml.='<br>';
                            $fundHtml.='<br>';

                            // code ends for donation amount

							echo $fundHtml;
						?>
                        <div class="form-group  fund-received-table ">
                            <p class="second-heading">FUNDS UTILIZED</p>
                            <div class=" financial-table overflow-table  white-box">
                                <table cellpadding="0" cellspacing="0" align="center">
                                    <tbody id="fund-utilized-div">
                                        <?php
											$fundUtilizedHtml="";
											$fundUtilizedHtml.='<tr>';
												$fundUtilizedHtml.='<th>SR.NO</th>';
												$fundUtilizedHtml.='<th>DESCRIPTION</th>';
												$fundUtilizedHtml.='<th>FUNDED BY</th>';
												$fundUtilizedHtml.='<th>AMOUNT SPENT</th>';
												$fundUtilizedHtml.='<th>DOCUMENT</th>';
											$fundUtilizedHtml.='</tr>'; 
											$totalSpentAmt=0;
											$i=1;
											if(isset($proFundUtilized) && count($proFundUtilized)>0){
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
																//$fundUtilizedHtml.='<span class="remove-link" onclick="remove_fundutilized('.$value->id.')">Remove</span>';
																$fundUtilizedHtml.='<span><img class="imageThumb" src="'.$imageSrc.'" width="50" height="50"></span>';
														$fundUtilizedHtml.='</td>';
													$fundUtilizedHtml.='</tr>';
													$i++;
												} 
											}
											
											// $fundUtilizedHtml.='<tr>';
											// 	$fundUtilizedHtml.='<td class="grey-td">';
											// 		$fundUtilizedHtml.='<span>'.$i.'</span>';
											// 	$fundUtilizedHtml.='</td>';
											// 	$fundUtilizedHtml.='<td class="big-td">';
											// 		$fundUtilizedHtml.='<input type="text" class="form-control" id="amount_description" name="amount_description" placeholder="We are aiming to make the villiage">';
											// 	$fundUtilizedHtml.='</td>';
											// 	$fundUtilizedHtml.='<td class="big-td">';
											// 		$fundUtilizedHtml.='<div class="select-box">';
											// 			$fundUtilizedHtml.='<select id="project_contributor_fund_id" name="project_contributor_fund_id" class="form-control">';
											// 			    foreach($contributorsList as $contributorfunding) {
											// 			        $fundUtilizedHtml.='<option value="'.$contributorfunding->id.'">'.$contributorfunding->funded_by.'</option>';
											// 			    }
											// 			$fundUtilizedHtml.='</select>'; 
											// 		$fundUtilizedHtml.='</div>';
											// 	$fundUtilizedHtml.='</td>';
											// 	$fundUtilizedHtml.='<td class="medium-td rupee-box">';
											// 		$fundUtilizedHtml.='<input type="text" class="form-control amount-number validate-number" name="amount" id="fund_utilized_amount">';
											// 	$fundUtilizedHtml.='</td>';
											// 	$fundUtilizedHtml.='<td>';
											// 		$fundUtilizedHtml.='<div class="incp-sec" id="upload_img_reciept"></div>';
											// 		$fundUtilizedHtml.='<div class="reciept-upload" style="display:block">';
											// 			$fundUtilizedHtml.='<input class="upload-receipt" type="file" name="documentFile" id="fund_utilized_document">';
											// 		$fundUtilizedHtml.='</div>';	
											// 	$fundUtilizedHtml.='</td>';
											// $fundUtilizedHtml.='</tr>';
											echo $fundUtilizedHtml;
										?>
                                    </tbody>
                                </table>
                            </div>
                            <!--div class="button-set"><button class="add-entry-button" type="button" onclick="add_fundutilized()">+ Add another entry</button></div-->

                            <input type="hidden" name="recAmt" id="recAmt" value="<?=$recAmt?>">
                            <div class="add-another-fund-box">
                                <div class="col-sm-4"><span>TOTAL AMOUNT <br>RECEIVED</span> 
								<input class="form-control" type="text" value="₹ <?=number_format($recAmt, 0, '', ',')?>" placeholder="--" disabled>
								</div>
                                <div class="col-sm-4"><span>TOTAL AMOUNT <br>SPENT</span> 
									<input class="form-control" type="text" id="totalSpentAmt" value="₹ <?=number_format($totalSpentAmt, 0, '', ',')?>" placeholder="--" disabled>
								</div>
                                <div class="col-sm-4"><span>TOTAL BALANCE <br>UNSPENT </span> 
									<input class="form-control" type="text" id="totalUnSpentAmt" value="₹ <?=number_format($recAmt - $totalSpentAmt, 0, '', ',')?>" placeholder="--" disabled>
								</div>
                            </div>
                        </div><!-- fund-received-table -->

                        <div class="funds-summary">
                            <div class="form-group ">
                                <p class="second-heading">FUND ANALYIS OF CONTRIBUTORS NAME</p>
                                <p class="control-label grey-txt">BUDGET ANALYSIS</p>
                            </div><!-- col-sm-6 -->
                        </div>
                        <div class="graph-funds form-group">
                            <?php 
							// if(isset($proFundUtilizedgraph) && count($proFundUtilizedgraph)>0) {
							// 			foreach($proFundUtilizedgraph as $FundUtilized){
											// echo $FundUtilized->amount.", ";
							// $spentFundUtilized=$this->ReportModel->getProjectReportUtilizedSumAmount($FundUtilized->project_contributor_fund_id);
							// echo $FundUtilized->spentAmout.', ';
									// print_r($spentFundUtilized);
									// echo "<pre>";print_r($spentFundUtilized);echo "</pre>"; 
							// 	}
							// }  
							// echo "<pre>";print_r($proFundUtilizedgraph);echo "</pre>"; ?>
                            <!-- <img style="width:100%;"> -->
                            <div id="funds_analyis" style="overflow: visible !important;"></div>
                        </div><!-- graph-funds -->

                        <!-- <div class="funds-summary">
								<div class="form-group ">
									<p class="control-label grey-txt">TIME ANALYIS</p>
								</div>
							</div>
							<div class="graph-funds form-group no-border">
							</div>
						</div> -->

						<div class="case-study-label case-preview form-group"> 
							<p class="second-heading">CASE STUDY </p>
							<?php $caseStudyImageHtml="";
							if(isset($reportCaseStudyData) && count($reportCaseStudyData)>0){
								//echo "<pre>";print_r($reportCaseStudyData);echo "</pre>";
								foreach($reportCaseStudyData as $value){					        
									// $caseStudyImageHtml.= '<div class="case-study-label form-group">';
										$caseStudyImageHtml.= '<label class="control-label">TITLE OF THE CASE STUDY </label>';
										$caseStudyImageHtml.= '<div class="profile-text-details">'.$value->case_study_title.'</div>';
									// $caseStudyImageHtml.= '</div>';
									$caseStudyImageHtml.= '<div class="upload-img ">';
										$caseStudyImageHtml.= '<label class="control-label">IMAGES</label>';
										$caseStudyImageHtml.= '<div class="upload-img-section">';
											$caseStudyImageHtml.= '<div class="gallery_box" id="">';
												$caseStudyImageHtml.= '<div class="gallery-image">';
													$caseStudyImageHtml.= '<img src="'.REP_CASE_STUDY_URL.$value->case_study_image.'" height="100" width="100" class="thumbnail" title="">';
										//$caseStudyImageHtml.= '<span onclick="remove_casestudy_image('.$value->id.')" class="remove-cross">X</span>';
												$caseStudyImageHtml.= '</div>';
											$caseStudyImageHtml.= '</div>';
										$caseStudyImageHtml.= '</div>';
									$caseStudyImageHtml.= '</div>';
									$caseStudyImageHtml.= '<div class="add-descp-block "><label class="control-label">CASE STUDY CONTENT </label>';
										$caseStudyImageHtml.= '<div class="profile-text-details">'.$value->case_study.'</div>';
									$caseStudyImageHtml.= '</div>';
									// $caseStudyImageHtml.= '</div>';									
								}
								echo $caseStudyImageHtml;
							} ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- contractDetailsBlock-->

    <script type="text/javascript">
    Highcharts.chart('funds_summery', {
        chart: {
            styledMode: false
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

        },
        series: [{
            type: 'pie',
            allowPointSelect: true,
            keys: ['name', 'y', 'selected', 'sliced'],
            data: [
                ['Total Amount Received- ₹<?=number_format($recAmt, 0, '', ',')?>',
                    <?=number_format($recAmt, 0, '', ',')?>, false
                ],
                ['Total Balance Amount - ₹<?=number_format($balAmt, 0, '', ',')?>',
                    <?=number_format($balAmt, 0, '', ',')?>, false
                ],
                ['Total Amount to be Raised- ₹<?=number_format($totalAmtToBeRaised, 0, '', ',')?>',
                    <?=number_format($totalAmtToBeRaised, 0, '', ',')?>, false
                ]
            ],
            showInLegend: false
        }]
    });

    Highcharts.chart('funds_analyis', {
        chart: {
            type: 'column'
        },
        // title: {
        // text: 'Monthly Average Rainfall'
        // },
        // subtitle: {
        // text: 'Source: WorldClimate.com'
        // },
        xAxis: {
            categories: [
                <?php 
					if(isset($proFundUtilizedgraph) && count($proFundUtilizedgraph)>0) {
						foreach($proFundUtilizedgraph as $selContributor){
							echo "'".$selContributor->funded_by."',";
						}
					} 
				?>
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            // title: {
            // text: 'Rainfall (k)'
            // }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} k</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Funds received',
            // data: [200, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
            data: [<?php 
					if(isset($proFundUtilizedgraph) && count($proFundUtilizedgraph)>0) {
						foreach($proFundUtilizedgraph as $checkedContributor){
							echo $checkedContributor->received_amount.", ";
						}
					} 
				?>]

        }, {
            name: 'Funds spend',
            data: [<?php 
					if(isset($proFundUtilizedgraph) && count($proFundUtilizedgraph)>0) {
						foreach($proFundUtilizedgraph as $FundUtilized){
							echo $FundUtilized->spentAmout.", ";
						}
					} 
				?>]

        }]
    });
    </script>

    <style>
    @import 'https://code.highcharts.com/css/highcharts.css';

    .highcharts-pie-series .highcharts-point {
        stroke: #EDE;
        stroke-width: 2px;
    }

    .highcharts-pie-series .highcharts-data-label-connector {
        stroke: silver;
        stroke-dasharray: 2, 2;
        stroke-width: 2px;
    }

    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 320px;
        max-width: 600px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
    </style>
    <script type="text/javascript">
    document.getElementById('totalCommitedAmt').value = '₹ <?php echo $totalAllCommitAmt; ?>';

    function reportFundsReceive() {
        var projectContributorFundsId = $('#contributors').val();
        var projectId = <?php echo $progress_details->project_id; ?>;
        //console.log(projectContributorFundsId,projectId);
        if (projectContributorFundsId.length > 0) {
            //console.log('test');
            $('#contributorDiv').html('');
            $.ajax({
                url: BASE_URL + 'reports/contributername',
                type: "POST",
                data: {
                    projectContributorFundsId: projectContributorFundsId,
                    projectId: projectId
                },
                dataType: "json",
                success: function(data) {
                    //console.log(data);
                    $('#contributorDiv').append(data.fundHtml);
                }
            });
        }
    }

    $(document).ready(function() {
        $('.validate-char').on('keypress', function(key) {
            //alert(111111)
            if ((key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) &&
                (key.charCode != 45 && key.charCode != 32 && key.charCode != 0)) {
                return false;
            }
        });

        $(".validate-number").keydown(function(event) {
            if (event.shiftKey == true) {
                event.preventDefault();
            }

            if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <=
                    105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event
                .keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

            } else {
                event.preventDefault();
            }

            if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
                event.preventDefault();

        });

        $('input.amount-number').keyup(function(event) {
            // skip for arrow keys
            if (event.which >= 37 && event.which <= 40) return;

            // format number
            convertToINRFormat($(this).val(), $(this));
        });
    });
    </script>

    <script type="text/javascript" src="<?php echo SKIN_URL; ?>js/reports.js?v=<?php echo JS_CSC_V; ?>">
    </script>
    <?php $this->load->view('common/footer'); ?>
    <?php $this->load->view('common/footer_js'); ?>
        </body> 
        </html>