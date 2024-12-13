<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('common/head_common'); ?>
<style>
    table td, table th{padding:5px 10px; border:none; outline:0; word-wrap:break-word;}
    .border{border:1px solid black;}
</style>
<body class=" Create-Project-step creare-report-page">
    <?php $this->load->view('common/header'); ?>

    <script type="text/javascript" src="<?php echo SKIN_URL; ?>js/highcharts.js?v=<?php echo JS_CSC_V; ?>"></script>
    <div id="contractDetailsBlock" class="">
        <div class="container">
            <div class="col-md-12">
                <div class="kyc-title">
                    <h2>PROGRESS REPORT</h2>
                </div>
                <p class="text-center due-date"> <?= $_GET['start_date'];?> TO <?= $_GET['end_date'];?> </p>
                <!-- <p class="text-center due-date"> < ?= $_POST['report_start_date'];?> TO <?= $_POST['report_end_date'];?> </p> -->
                <div class="row setup-content registration-flow-setup  tab-pane fade active in progress-report-section" id="info">
                    <div class="" id="">
                        <div class="sel-contri-box">
                            <div class="form-group col-sm-6 ">
                                <label class="control-label grey-txt">Contributor</label>
                                <div class="profile-text-details">
                                    <?php if(isset($selectCurrentContributor) && count($selectCurrentContributor)>0){?>
                                    <table style="text-align:left;width:100%">
                                        <tr>
                                        <?php 
                                        if($selectCurrentContributor[0]->company_logo!==""){?>

                                            <td>
                                                <img src="<?php echo COMPANY_LOGO.$selectCurrentContributor[0]->company_logo; ?>" width='100' height='100' style="object-fit: contain;" srcset="">
                                            </td>

                                        <?php }else{?>
                                            <td>-</td>
                                        <?php }
                                        ?>
                                        </tr>
                                    </table>
                                    <?php }else{?>
                                        <table style="text-align:center;width:100%">
                                        <tr>
                                            <td>-</td>
                                        </tr>
                                        </table>
                                    <?php } ?>
                                </div>

                                <!-- code for collaborator start here-->
                                <br><br>
                                <label class="control-label grey-txt">Collaborator</label>
                                <td>
                                    <?php
                                        if(isset($selectCurrentCollaborator) && count($selectCurrentCollaborator)>0){
                                            $count=1;?>
                                                <table style="text-align:left;width:100%;">
                                                    <tr>
                                                        <?php foreach($selectCurrentCollaborator as $key => $value){?>
                                                            <td >
                                                                <?php if($value->company_logo==""){
                                                                    echo "-";
                                                                    
                                                                }else{?>
                                                                    <img src="<?php echo COMPANY_LOGO.$value->company_logo; ?>" width='130' style="object-fit: contain;margin-bottom:3px;pxdisplay:block"  srcset="">&nbsp;
                                                                <?php }
                                                                    ?>
                                                            </td>
                                                            <?php 
                                                            $count++;
                                                        }?>                                
                                                    </tr>
                                                    <br>
                                                </table>
                                            <?php }else{?>
                                                <table style="text-align:left;width:100%;">
                                                    <tr>
                                                        <td>-</td>
                                                    </tr>
                                                </table>
                                            <?php }
                                        ?>
                                </td>
                                <br><br>
                                <label class="control-label grey-txt">Implementer</label>
                                <br>
                                <?php
                                    if($ngo_details->org_logo!=""){
                                ?>
                                    <table style="text-align:left;width:100%;">
                                        <tr>
                                            <td>
                                                <img src='<?php echo NGO_LOGO.$ngo_details->org_logo;?>' width='100' height='100' style="object-fit: contain;" alt="Implementor Logo" srcset="">
                                            </td>
                                        </tr>
                                    </table> 
                                <?php 
                                }else{?>
                                    <tr>
                                        <td>
                                            -
                                        </td>
                                    </tr>
                                <?php }
                                ?>

                            </div>
                        </div><!-- sel-contri-box -->

                        <?php
                            $date1 = $progress_details->project_date_from;
                            $date2 = $progress_details->project_date_to;							
                            $get_interval_in_month = $this->CommonModel->get_interval_in_month($date1, $date2);		
                            // code for duartion start here
                            if($report_frequency == 'MPR'){
                                $strt_period = $this->ReportModel->getReportPeriod($progress_details->due_date, '30 days');
                            }else if($report_frequency == 'QPR'){
                                $strt_period = $this->ReportModel->getReportPeriod($progress_details->due_date, '3 month');
                            }else if($report_frequency == 'HPR'){
                                $strt_period = $this->ReportModel->getReportPeriod($progress_details->due_date, '6 month');
                            }else{
                                $strt_period = $this->ReportModel->getReportPeriod($progress_details->due_date, '1 year');
                            }
                            //code ends here
                        ?>

                        <div class="form-group col-sm-12 mar-bot-10">
                            <label class="control-label">REPORT COVER IMAGE</label><br>
                
                           <?php if($get_report_cover_details->cover_image==""){
                                $display="none";
                                echo '-';
                            }else{
                                $display="block";
                            } ?>
                            <img class="imageThumb" src="<?php echo REP_COVER_IMG_URL.$get_report_cover_details->cover_image;?>" name="case_study_images" width="400" hieght="200" title="This is cover image" style="display:<?php echo $display; ?>;height: 200px;width: 400px;object-fit: cover;" >
                            <br><br>
                        </div>

                        <div class="form-group col-sm-12 mar-bot-10">
                            <label class="control-label">PROJECT TITLE</label>
                            <div class="profile-text-details"><?php echo ucfirst($progress_details->project_name);?></div>
                        </div>



                        <div class="form-group col-sm-12 mar-bot-10">
                            <label class="control-label">BACKGROUND DESCRIPTION</label>
                            <div class="profile-text-details"><?php echo ucfirst($progress_details->project_description);?></div>
                        </div>

                        <div class="form-group col-sm-12 mar-bot-10">
                            <label class="control-label">PROBLEM STATEMENT</label>
                            <div class="profile-text-details"><?php echo ucfirst($progress_details->problem_statement);?></div>
                        </div>

                        <div class="form-group col-sm-12 mar-bot-10">
                            <label class="control-label">PROBLEM GOALS</label>
                            <div class="profile-text-details"><?php echo ucfirst($get_project_goals->description) ?></div>
                        </div>

                        
                        <?php
						$date1 = $progress_details->project_date_from;
						$date2 = $progress_details->project_date_to;							
						$get_interval_in_month = $this->CommonModel->get_interval_in_month($date1, $date2);		

                        $sectors = $this->ProjectModel->getSectors($progress_details->sectors);
                        $beneficiaries = $this->ProjectModel->getBeneficiaries($progress_details->beneficiaries);

						?>

                        <!-- code for project details start here -->
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="form-group col-sm-4  mar-bot-10">
                                    <label class="control-label">PROJECT DURATION</label>
                                    <div class="profile-text-details">
                                    <?php echo ($get_interval_in_month>1) ? $get_interval_in_month.' months': $get_interval_in_month.' month';?>
                                    </div>
                                </div>

                                <div class="form-group col-sm-4 mar-bot-10">
                                    <label class="control-label">SECTOR FOCUSSED</label>
                                    <div class="select-box">
                                        <div class="profile-text-details loc-tag-label">
                                            <?php echo implode(', ',$sectors);?>
										</div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4 location-details-icon mar-bot-10">
                                    <label class="control-label">PROJECT LOCATION</label>
                                    <div class="select-box">
                                        <div class="profile-text-details  loc-tag-label">
                                            <?php echo $progress_details->district.', '.$progress_details->city;?>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row">
                                <div class="form-group col-sm-4 mar-bot-10">
                                    <label class="control-label">BENEFICIARY TYPES</label>
                                    <div class="profile-text-details">
                                        <?php echo implode(', ',$beneficiaries);?>
                                    </div><!-- profile-text-details -->
                                </div>

                                <div class="form-group col-sm-4 mar-bot-10">
                                    <label class="control-label">BENEFICIARIES</label>
                                    <div class="select-box">
                                        <div class="profile-text-details loc-tag-label">
                                            <?php echo $progress_details->no_of_beneficiaries;?>
										</div>
                                        <!-- profile-text-details -->
                                    </div>
                                </div>
                                <div class="form-group col-sm-4  mar-bot-10">
                                    <label class="control-label">PROJECT BUDGET</label>
                                    <div class="select-box">
                                        <div class="profile-text-details loc-tag-label">
                                            <?php echo $progress_details->total_project_cost; ?>
										</div>
                                        <!-- profile-text-details -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- code for project details ends here -->
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
                            <h4>B-  PROJECT PROGRESS REPORT DURING THE REPORTING PERIOD</h4>
                            <br><br>
                        </div>
                        
                        <div class="form-group col-sm-12">
                            <label class="control-label ">STATUS OF PROJECT ACTIVITIES</label>
                            <div class="profile-text-details"><?php echo $progress_details->work_activity_status;?></div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label ">DESCRIPTION OF ACTIVITIES COMPLETED / IN-PROGRESS </label>
                            <div class="profile-text-details"><?php echo $progress_details->work_description;?></div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label ">NO. OF BENEFICIARIES</label>
                            <div class="profile-text-details"><?php echo $progress_details->no_of_beneficiaries;?></div>
                        </div>

                        <div class="form-group col-sm-12">
                            <?php if($case_study_details==""){
                                echo "";
                            }else{?>
                            <label class="1 ">CASE STUDY </label>
                            <br>
                            <br>
                            <p>
                                <b>Title :</b>&nbsp;&nbsp;
                                <?=  ucfirst($case_study_details->case_study_title);?>
                            </p>
                            <p>
                               <img src="<?php echo REP_CASE_STUDY_URL.$case_study_details->case_study_image;?>" width="150" height="150" style="float:left;margin:5px 10px 15px 0px;">  
                                <?= $case_study_details->case_study;?>  
                            </p>
                            <?php }?>
                            <!-- <tr>
                                <td>
                                    <p><b>Title :</b>&nbsp;&nbsp;< ?= ucfirst($case_study_details->case_study_title);?><br></p>
                                </td>
                            </tr>
                            <tr> -->
                                <!-- <td colspan="2"> -->
                                    <!-- <p> -->
                                        <!-- <img src="< ?php echo REP_CASE_STUDY_URL.$case_study_details->case_study_image;?>" width="150" height="150" style="float:left;margin:5px 10px 15px 0px;"> -->
                                    
                                        <!-- < ?= $case_study_details->case_study;?> -->
                                    <!-- </p> -->
                                <!-- </td> -->
                            <!-- </tr> -->
                            <div class="profile-text-details" style='display:none;'>
                                <?php 
                                    if(isset($reportCaseStudyData) && count($reportCaseStudyData)>0){
                                        //echo "<pre>";print_r($reportCaseStudyData);echo "</pre>";
                                        foreach($reportCaseStudyData as $value){?>
                                            <!-- <tr><td colspan='2' style="width:100%;"><b>Title :</b>&nbsp;&nbsp;< ?= ucfirst($value->case_study_title);?><br></td></tr> -->
                                            <!-- <tr>
                                                <td style="width:0%;"><img src="< ?php echo REP_CASE_STUDY_URL.ucfirst($value->case_study_image);?>" height="150" width="150" class="thumbnail" title=""></td>
                                                <td style="width:100%;vertical-align: baseline;padding:0px 0px;">< ?= $value->case_study;?></td>
                                            </tr> -->
                                            <tr>
                                                <td>
                                                    <p><b>Title :</b>&nbsp;&nbsp;<?= ucfirst($value->case_study_title);?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <!-- <p> -->
                                                        <img src="<?php echo REP_CASE_STUDY_URL.ucfirst($value->case_study_image);?>" width="150" height="150" style="float:left;margin:5px 10px 15px 0px;">
                                                    
                                                        <?= $value->case_study;?>
                                                    <!-- </p> -->
                                                </td>
                                            </tr>
                                    <?php  }}else{
                                        echo '-';
                                    }
                                ?>
                            </div>
                        </div>

                        <div class="image-sec"></div>
                            <div class="form-group col-sm-12">
                                <P class="second-heading">C- FINANCIAL SUMMARY </P>
                                <table cellspacing="0">
                                    <?php
                                    $totalBudgetAmt = ($progress_details->total_project_cost) + 0;
                                    ?>
                                </table>
                                <!-- <table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:left; ">
                                    <tr style='display:none;'>
                                        <td>
                                            <div class="graph-funds form-group">
                                                <img style="width:100%;">
                                                <div id="funds_summery" style="overflow: visible !important;"></div>                            
                                            </div>
                                        </td>
                                    </tr>
                                </table> -->
                                <?php if(isset($selectedContributorArr) && count($selectedContributorArr)>0){?>
                                    <table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:left; ">
                                        <tr><td><b style="font-size:16px;">FUNDS RECEIVED FROM CONTRIBUTORS NAME</b></td></tr>
                                    </table>
                                    <?php }else {
                                        echo '';
                                    }?>
                                    <br><br>
                                    <table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center;" cellspacing="0">
                                        <?php 
                                        $fundHtml='';
                                        $totalOtherCommitAmt=0;
                                        $totalOtherReceiveAmt=0;
                                        $totalOtherBalanceAmt=0;
                                        $totalCommitAmt=0;
                                        $totalReceiveAmt=0;
                                        $totalBalanceAmt=0;
                                        if(isset($selectedContributorArr) && count($selectedContributorArr)>0){?>

                                        <tr class="border">
                                            <td class="border"><b>FUNDED BY</b></td>
                                            <!-- <td class="border"><b>DATE RECEIVED</b></td> -->
                                            <td class="border"><b>SOURCE</b></td>
                                            <td class="border"><b>COMMITTED</b></td>
                                            <td class="border"><b>RECEIVED</b></td>
                                            <td class="border"><b>BALANCE</b></td>
                                        </tr>

                                        <?php foreach($selectedContributorArr as $key => $value){
                                            $created= date('d-m-Y',$value->created_at);?>
                                            <tr class="border">
                                                <td class="border"><?=$value->funded_by;?></td>
                                                <!-- <td class="border">< ?= $created;?></td> -->
                                                <td class="border"><?= $value->source;?></td>
                                                <td class="border"><?= number_format($value->committed_amount, 0, '', ',');?></td>
                                                <td class="border"><?= number_format($value->received_amount, 0, '', ',');?></td>
                                                <td class="border"><?= number_format($value->balance_amount, 0, '', ',');?></td>
                                            </tr>
                                        <?php 
                                            $totalCommitAmt=$totalCommitAmt + $value->committed_amount;
                                            $totalReceiveAmt=$totalReceiveAmt + $value->received_amount;
                                            $totalBalanceAmt=$totalBalanceAmt + $value->balance_amount;
                                            } ?>
                                            <br>
                                            <tr >
                                                <td class="border" colspan="2">Total</td>
                                                <td class="border">₹<?= number_format($totalCommitAmt, 0, '', ','); ?></td>
                                                <td class="border">₹ <?= number_format($totalReceiveAmt, 0, '', ',');?></td>
                                                <td class="border">₹ <?= number_format($totalBalanceAmt, 0, '', ',');?></td>
                                            </tr>
                                            

                                        </table>
                                        <br><br>
                                        <table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center;" cellspacing="0">
                                            <tr >
                                                <td><b>AMOUNT COMMITTED</b></td>
                                                <td><b>AMOUNT RECEIVED</b></td>
                                                <td><b>BALANCE AMOUNT</b></td>
                                            </tr>
                                            <tr >
                                                <td>₹ <?= number_format($totalCommitAmt, 0, '', ','); ?></td>
                                                <td>₹ <?= number_format($totalReceiveAmt, 0, '', ',');?></td>
                                                <td>₹ <?= number_format($totalBalanceAmt, 0, '', ',');?></td>
                                            </tr>

                                            
                                        <?php } else {  echo '';  ?>
                                            
                                        <?php }?>
                                    </table>
                                    <table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:left;" cellspacing="0">
                                        <!-- <tr>
                                            <td><img src="<?php echo base_url();?>public/uploads/banner/trucsr-email-logo.png"/ style="height:50px;"><br><br><br></td>
                                        </tr> -->
                                        <?php if(isset($unselectContributor) && count($unselectContributor) > 0){?>
                                            <tr>
                                                <td>
                                                    <br>
                                                    <b style="font-size:16px;">FUNDS RECEIVED FROM OTHER SOURCE</b>
                                                </td>
                                            </tr>
                                        <?php }else {?>
                                            <tr>
                                                <td></td>
                                            </tr>
                                        <?php }?>
                                    </table>
                                    <!-- code start here -->
                                    <table style="font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center;" cellspacing="0">
                                        <?php if(isset($unselectContributor) && count($unselectContributor) > 0){?>
                                            <tr class="border">
                                                <th class="border" style='text-align:center;'>FUNDED BY</th>
                                                <th class="border" style='text-align:center;'>SOURCE</th>
                                                <th class="border" style='text-align:center;'>COMMITTED</th>
                                                <th class="border" style='text-align:center;'>RECEIVED</th>
                                                <th class="border" style='text-align:center;'>BALANCE</th>
                                            </tr>
                                            <?php foreach($unselectContributor as $key => $value){
                                                $created= date('d-m-Y',$value->created_at);?> 
                                                <tr class="border" id='<?= $value->id;?>'>
                                                    <td class="border"><?= $value->funded_by;?></td>
                                                    <!-- <td class="border">< ?= $created;?></td> -->
                                                    <td class="border"><?= $value->source;?></td>
                                                    <td class="border"><?= number_format($value->committed_amount, 0, '', ',');?></td>
                                                    <td class="border"><?= number_format($value->received_amount, 0, '', ',');?></td>
                                                    <td class="border"><?= number_format($value->balance_amount, 0, '', ',');?></td>
                                                </tr>
                                                <?php 
                                                    $totalOtherCommitAmt=$totalOtherCommitAmt + $value->committed_amount;
                                                    $totalOtherReceiveAmt=$totalOtherReceiveAmt + $value->received_amount;
                                                    $totalOtherBalanceAmt=$totalOtherBalanceAmt + $value->balance_amount;
                                                ?>
                                        <?php  } ?>
                                        <tr class="border">
                                                    <td class="border" colspan="2">Total</td>
                                                    <td class="border">₹ <?= number_format($totalOtherCommitAmt, 0, '', ','); ?></td>
                                                    <td class="border">₹ <?= number_format($totalOtherReceiveAmt, 0, '', ',');?></td>
                                                    <td class="border">₹ <?= number_format($totalOtherBalanceAmt, 0, '', ',');?></td>
                                            </tr>
                                    </table>
                                        <br>
                                        <table style="font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center;" cellspacing="0">
                                        <!-- <tr>
                                            <th><br>AMOUNT COMMITED</th>
                                            <th><br>AMOUNT RECEIVED</th>
                                            <th><br>BALANCE AMOUNT</th>
                                        </tr>
                                        <tr>
                                            <td>₹< ?= number_format($totalOtherCommitAmt, 0, '', ',');?></td>
                                            <td>₹< ?= number_format($totalOtherReceiveAmt, 0, '', ',');?></td>
                                            <td>₹< ?= number_format($totalOtherBalanceAmt, 0, '', ',');?></td>
                                        </tr> -->

                                        <?php }?>
                                        <?php 
                                        $recAmt	= $totalOtherReceiveAmt+$totalReceiveAmt;
                                        $balAmt	= $totalOtherBalanceAmt+$totalBalanceAmt;
                                        $totalAmtToBeRaised = $totalBudgetAmt - $recAmt;
                                        $totalAllCommitAmt = $totalOtherCommitAmt + $totalCommitAmt;
                                        ?>
                                        <!-- <tr>
                                            <td colspan="3">
                                                <hr style="height:0.5px;border-width:0;color:gray;background-color:black">
                                            </td>
                                        </tr> -->
                                        <tr>
                                            <th style='text-align:Center;'>TOTAL PROJECT BUDGET</th>
                                            <th style='text-align:Center;'>TOTAL AMOUNT COMMITTED</th>
                                            <th style='text-align:Center;'>TOTAL AMOUNT RECEIVED </th>
                                            <th style='text-align:Center;'>TOTAL BALANCE AMOUNT</th>
                                        </tr>
                                        <tr>
                                            <td>₹ <?= $totalBudgetAmt?></td>
                                            <td>₹ <?= $totalAllCommitAmt;?></td>
                                            <td>₹ <?= number_format($recAmt, 0, '', ','); ?></td>
                                            <td>₹ <?= number_format($balAmt, 0, '', ',');?></td>
                                        </tr>
                                        </table>
                                                <br><br>
                                            <table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:left;" cellspacing="0">
                                                <tr>
                                                    <td><b style="font-size:16px;">DONATION RECEIVED FROM INDIVIDUALS</b></td>
                                                </tr>
                                            </table>
                                            <table style="font-family:'Roboto',sans-serif,; font-size:14px;width:60%;text-align:center;" cellspacing="0">
                                                <tbody>
                                                    <tr class="border">
                                                        <th class="border" style='text-align:center;'>No. of Donors who contributed</th>
                                                        <th class="border" style='text-align:center;'>Total Amount Received</th>
                                                    </tr>
                                                    <tr class="border" id="183">
                                                        <td class="border"><?= $gettotaldonation->no_of_doners?$gettotaldonation->no_of_doners:'-';?></td>
                                                        <td class="border"><?= $gettotaldonation->total_donation?$gettotaldonation->total_donation:'-';?></td>
                                                </tbody>
                                            </table>
                                            <!-- <footer style="position:fixed;bottom:0px;width:100%;font-size:11px;left:3px;bottom:20px;font-family:arial;">
                                                Progress Report,&nbsp;< ?php echo strtoupper(date("M Y", strtotime("-1 months", $progress_details->due_date)));?>< ?php echo ';&nbsp;&nbsp;'.ucfirst($user_details->first_name).'&nbsp;'.$user_details->last_name;?>
                                            </footer> -->
                                        <!-- <table>
                                        <tr>
                                            <p style="page-break-after: always;">&nbsp;</p>
                                        </tr>
                                        </table> -->
                                        <br><br>
                                        <table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center;" cellspacing="0">
                                            <!-- <tr>
                                                <td><img src="< ?php echo base_url();?>public/uploads/banner/trucsr-email-logo.png"/ style="height:50px;"><br><br><br></td>
                                            </tr> -->
                                        </table>
                                        <table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:left;" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <b style="font-size:16px;">FUNDS UTILIZED</b>
                                                </td>
                                            </tr>
                                        </table>


                                        <table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center;" cellspacing="0">
                                            <tr class="border">
                                                <th class="border" style='text-align:center;'>SR.NO</th>
                                                <th class="border" style='text-align:center;'>DESCRIPTION</th>
                                                <th class="border" style='text-align:center;'>FUNDED BY</th>
                                                <th class="border" style='text-align:center;'>AMOUNT SPENT</th>
                                                <th class="border" style='text-align:center;'>DOCUMENT</th>
                                            </tr>
                                            <?php
                                            $totalSpentAmt=0;
                                            $i=1;
                                            if(isset($proFundUtilized) && count($proFundUtilized)>0){
                                                foreach($proFundUtilized as $value){
                                                    $totalSpentAmt=$totalSpentAmt+$value->amount;
                                                    ?>
                                                    <tr class="border">
                                                        <td class="border"><?=  $i;?></td>
                                                        <td class="border"><?= $value->amount_description;?></td>
                                                        <td class="border">
                                                            <?php $funded_by='';?>
                                                            <?php foreach($contributorsList as $contributorFund) { 
                                                                if($contributorFund->id==$value->project_contributor_fund_id){
                                                                    $funded_by=$contributorFund->funded_by;
                                                                    // $funded_by=$contributorFund->funded_by?$contributorFund->funded_by:'';
                                                                }
                                                            }?>
                                                            <?php echo $funded_by; ?>
                                                        </td>
                                                        <td class="border"><?= $value->amount;?></td>
                                                        <?php 
                                                        $ext = pathinfo(FUND_UTILIZED_IMG_PATH.$value->document, PATHINFO_EXTENSION);
                                                        // print_r($ext);
                                                        // exit;
                                                        if($ext == 'pdf'){
                                                            // $imageSrc=SKIN_URL.'images/pdf-icon.png';
                                                            $imageSrc=FUND_UTILIZED_IMG_URL.$value->document;
                                                
                                                        }else{
                                                            $imageSrc=FUND_UTILIZED_IMG_URL.$value->document;
                                                        }
                                                        ?>
                                                        <td class="border"><a href="<?= $imageSrc;?>" target="_blank">VIEW</a></td>
                                                    </tr>
                                                    <?php $i++;?>
                                            <?php }
                                            }else{?>
                                                <tr class="border">
                                                    <th class="border" style='text-align:center;'>-</th>
                                                    <th class="border" style='text-align:center;'>-</th>
                                                    <th class="border" style='text-align:center;'>-</th>
                                                    <th class="border" style='text-align:center;'>-</th>
                                                    <th class="border" style='text-align:center;'>-</th>
                                                </tr>
                                            <?php }
                                            ?>
                                        </table>
                                        <table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center;" cellspacing="0">
                                            <input type="hidden" name="recAmt" id="recAmt" value="<?=$recAmt?>">
                                            <tr>
                                                <th style='text-align:center;'><br style="font-size:16px;">TOTAL AMOUNT RECEIVED</th>
                                                <th style='text-align:center;'><br style="font-size:16px;">TOTAL AMOUNT SPENT</th>
                                                <th style='text-align:center;'><br style="font-size:16px;">TOTAL BALANCE UNSPENT</th>
                                            </tr>
                                            <tr>
                                                <td>₹ <?=number_format($recAmt, 0, '', ',');?></td>
                                                <td>₹ <?=number_format($totalSpentAmt, 0, '', ',');?></td>
                                                <td>₹ <?=number_format($recAmt - $totalSpentAmt, 0, '', ',');?></td>
                                            </tr>
                                            
                                        </table>
                                    <!-- code ends ere -->

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- contractDetailsBlock-->

    <!-- < ?php
    print_r($_POST);
    exit;
    ?> -->

    <div class="full-width white-bg view-page-bottom">
        <form action="<?php echo site_url("download_reportn")?>" id="search_donation_report" class="search_donation_report" name="search_donation_report" method='post'>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <!-- <a class="btn btn-primary cancelBtn btn-lg border-btn" href="">Download Report</a> -->
                        <input type="submit" class="btn btn-primary cancelBtn btn-lg border-btn" value="Download Report">
                    </div>
                    <div class="col-sm-4"></div>
                </div>
                <input type="text" class='search_project_id' id='search_project_id' name='search_project_id' value='<?php echo $_GET['project_id']; ?>' style='display:none;'>
                <input type="text" class="form-control" placeholder="Start date" value="<?php echo  $_GET['start_date'];?>" id="report_start_date" name="report_start_date" style='display:none;'>
                <input type="text" class="form-control" placeholder="End date" value="<?php echo $_GET['end_date'] ?>" id="report_end_date" name="report_end_date" style='display:none;'>
                <!-- <input type="text" class='search_project_id' id='search_project_id' name='search_project_id' value='< ?php echo $_POST['search_project_id']; ?>' style='display:none;'> -->
                <!-- <input type="text" class="form-control" placeholder="Start date" value="< ?php echo  $_POST['report_start_date'];?>" id="report_start_date" name="report_start_date" style='display:none;'>
                <input type="text" class="form-control" placeholder="End date" value="< ?php echo $_POST['report_end_date'] ?>" id="report_end_date" name="report_end_date" style='display:none;'> -->
            </div>
        </form>
    </div>


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