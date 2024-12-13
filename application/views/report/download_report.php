<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <head>
  <title> Progress Report </title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">

  <style>
  @import "https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap";
@import "https://fonts.googleapis.com/css?family=Open+Sans&display=swap";
body{font-family:'Roboto',sans-serif font-size:14px;}
	body{font-family:'Roboto',sans-serif,; font-size:14px;}
	table td, table th{padding:0px 10px; border:none; outline:0; word-wrap:break-word;}
	@page {
    /* size: A4 landscape; */
    size: A4;
	margin:20;
  }
  .border{border:1px solid black;}
  </style>
  <script type="text/javascript" src="<?php echo SKIN_URL; ?>js/highcharts.js?v=<?php echo JS_CSC_V; ?>"></script>
 </head>
 <style>
/* .vl {
  border-left:2px solid #3366cc;
  height: 200px;
  position:absolute;
  right:50%;
}
@media print {
    .vl {
  border-left:2px solid #3366cc;
  height: 200px;
  position:absolute;
  right:50%;
}
      } */
</style>

 <body style="margin:0; padding:0;vertical-align:middle; font-family:'Roboto',sans-serif, arial; font-size: 14px; ">
 
 <!-- neeraj table -->
 <!-- neeraj table ends here -->
  
<table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center; ">

<tr valign:middle;>
	<td><img src="<?php echo base_url();?>public/uploads/banner/trucsr-email-logo.png"/ style="height:50px;"><br><br></td>
</tr>
<tr style="font-size:32px;font-weight:bold;">
    <td>
        <!-- <span>MONTHLY PROGRESS REPORT</span> -->
        <span>PROGRESS REPORT</span>
        <br>
        <!-- <span>< ?php echo strtoupper(date("M Y", strtotime("-1 months", $progress_details->due_date)));?></span> -->
        <span><?php echo strtoupper($_POST['report_start_date']).'&nbsp; TO &nbsp;'.strtoupper($_POST['report_end_date']);?></span>
    </td>
</tr>
<!-- <tr>
    <td></td>
</tr> -->
<tr  style="font-size:30px;font-weight:bold;">
    <td>
        <!-- <b>PROJECT NAME</b> -->
        <!-- <br> -->
        <span><?php echo strtoupper($progress_details->project_name);?></span>
        <!-- <br><br> -->
    </td>
</tr>

<tr>
    <?php if($get_report_cover_details->cover_image==""){?>
        <td>
            
        </td>
        <!-- echo ""; -->
     <?php }else{?>
        <td>
        <img class="imageThumb" src="<?php echo REP_COVER_IMG_URL.$get_report_cover_details->cover_image;?>" name="case_study_images" width="400" hieght="200" title="This is cover image" style=";height: 300px;width:600px;object-fit: cover;" >
        </td>
   <?php  }
        ?>
    
</tr>
<!-- <tr>
    <td><br></td>
</tr> -->

<!-- <tr> -->
    <!-- <td> -->
        <!-- <b>REPORT MONTH</b><br> -->
        <!-- < ?php echo date('M',$progress_details->due_date);?> -->
        <!-- < ?php $abc = date('M Y',$progress_details->due_date);?> -->
        <!-- < ?php echo date("M Y", strtotime("-1 months", $progress_details->due_date));?> -->
        <!-- <br><br> -->
        <!-- < ?php echo $strt_period; ?> <b>to</b> < ?php echo date('d-m-Y',$progress_details->due_date);?> -->
    <!-- </td> -->
<!-- </tr> -->
<!-- only contributor and collaborator name -->
<tr>
    <td>
        <br>
        <b>CONTRIBUTOR</b>
    </td>
</tr>
<tr>
    <td>
        <!-- <b>CONTRIBUTOR</b>
        <br> -->
        <?php
            if(isset($selectCurrentContributor) && count($selectCurrentContributor)>0){
                // $count=1;	
                // foreach($selectCurrentContributor as $key => $value){
                    // echo $count.". ".$value->funded_by."&nbsp; "; //original code commented
                    // echo ucfirst($value->funded_by)."<br>";?>
                    <table style="text-align:center;width:100%">
                        <tr>
                        <!-- < ?php foreach($selectCurrentContributor as $key => $value){ ?>
                            <td>
                                < ?php if($value->company_logo==""){
                                    echo '';
                                 }else{ ?>
                                    <img src="< ?php echo COMPANY_LOGO.$value->company_logo; ?>" width='100' height='100' style="object-fit: contain;" srcset="">
                                    
                                < ?php }
                                ?>
                            
                            </td>
                        < ?php 
                        $count++;
                        }
                        ?> -->
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
                    <!-- < ?php 
                    $count++;
                } -->
            <?php }else{?>
                <table style="text-align:center;width:100%">
                <tr>
                    <td>-</td>
                </tr>
                </table>
            <?php }
        ?>
        <!-- <br> -->
    </td>
</tr>
<tr>
    <!-- <td>
        <b>COLLABORATORS</b>
        <br>
        < ?php
            if(isset($selectCurrentCollaborator) && count($selectCurrentCollaborator)>0){
                $count=1;	
                foreach($selectCurrentCollaborator as $key => $value){
                    // echo $count.". ".$value->funded_by."&nbsp; "; //original code commented
                    echo ucfirst($value->funded_by)."<br>";
                    $count++;
                }
            }
        ?>
        <br>
    </td> -->
    <td>
        <br>
        <b>COLLABORATORS</b>
        <br>
        <br>
        <?php
            if(isset($selectCurrentCollaborator) && count($selectCurrentCollaborator)>0){
                $count=1;	
                // foreach($selectCurrentCollaborator as $key => $value){
                    // echo $count.". ".$value->funded_by."&nbsp; "; //original code commented
                    ?>
                    <!-- < ?php
                    if($count>1){
                        $width='95%';
                    }else{
                        $width='100%';
                    } 
                    ?> -->
                    <!-- <table style="text-align:center;width:< ?php echo $width?>"> -->
                        <table style="text-align:center;width:100%;">
                        <tr>
                            <?php foreach($selectCurrentCollaborator as $key => $value){?>
                                <td >
                                    <?php if($value->company_logo==""){
                                        // <!-- // $display="none"; -->
                                        echo "-";
                                        
                                    }else{?>
                                        <!-- // $display="block"; -->
                                        <img src="<?php echo COMPANY_LOGO.$value->company_logo; ?>" width='130' style="object-fit: contain;margin-bottom:3px;pxdisplay:block"  srcset="">&nbsp;
                                    <?php }
                                        ?>
                                    <!-- < ?php echo ucfirst($value->funded_by)."<br>";?> -->
                                    <!-- <img src="< ?php echo COMPANY_LOGO.$value->company_logo; ?>" width='130' style="object-fit: contain;margin-bottom:3px;pxdisplay:<?php echo $display;?>"  srcset="">&nbsp; -->
                                </td>
                                <?php 
                                $count++;
                            }?>                                
                        </tr>
                        <br>
                    </table>
                    <!-- echo ucfirst($value->funded_by)."<br>";?> -->
                    <!-- <img src="< ?php echo COMPANY_LOGO.$value->company_logo; ?>" width='100' height='100' style="object-fit: contain;" alt="Collaborator Logo" srcset=""> -->
                    
                    <!-- < ?php 
                    $count++;
                } -->
            <?php }else{
                echo '-';
            }
        ?>
    </td>
</tr>
<tr>
    <td>
        <br>
        <b>IMPLEMENTER</b>
    </td>
</tr>
<?php
    if($ngo_details->org_logo!=""){
?>
    <tr>
        <td>
            <img src='<?php echo NGO_LOGO.$ngo_details->org_logo;?>' width='100' height='100' style="object-fit: contain;" alt="Implementor Logo" srcset="">
        </td>
    </tr>
<?php 
}else{?>
    <tr>
        <td>
            -
        </td>
    </tr>
<?php }
?>
<!-- <tr>
    <td> -->
        <!-- < ?php echo ucfirst($user_details->first_name).'&nbsp;'.$user_details->last_name;?> -->
    <!-- </td>
</tr> -->

<!-- only contributor and collaborator name ends here -->
<!-- <tr>
    <td>
        <b>CONTRIBUTOR</b>
        <br>
        < ?php
            if(isset($selectedContributorArr) && count($selectedContributorArr)>0){
                $count=1;	
                foreach($selectedContributorArr as $key => $value){
                    // echo $count.". ".$value->funded_by."&nbsp; "; //original code commented
                    echo ucfirst($value->company_name)."<br>";
                    $count++;
                }
            }
        ?>
        <br>
    </td>
</tr> -->
<!-- <tr>
    <td>
        <b>PROJECT NAME</b>
        <br>
        < ?php echo ucfirst($progress_details->project_name);?>
        <br><br>
    </td>
</tr> -->
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
// code for duration ends here
?>
<!-- <tr>
    <td>
        <b>REPORT MONTH</b><br>
         < ?php echo date('M',$progress_details->due_date);?> -->
        <!-- < ?php $abc = date('M Y',$progress_details->due_date);?> -->
        <!--< ?php echo date("M Y", strtotime("-1 months", $progress_details->due_date));?>
         < ?php echo $strt_period; ?> <b>to</b> < ?php echo date('d-m-Y',$progress_details->due_date);?> -->
    <!--</td>
</tr> -->
</table>
<table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center; ">
    <tr>
        <p style="page-break-after: always;">&nbsp;</p>
    </tr>
</table>
<table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center; ">
    <tr>
        <td><img src="<?php echo base_url();?>public/uploads/banner/trucsr-email-logo.png" style="height:50px;"><br><br><br></td>
    </tr>
</table>
<table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:left; ">
    <tr>
        <td colspan="3">
            <p style="font-size:20px;font-weight:bold;">A - PROJECT DETAILS</p>
        </td>
    </tr>
    <br><br>
    <tr><td colspan="3"><p style="font-size:16px;font-weight:bold;">PROJECT TITLE</p></td></tr>
    <tr>
        <td colspan="3">
            <p style="font-size:12px;"><?php echo ucfirst($progress_details->project_name);?></p>
        </td>
    </tr> 
    <tr>
        <td colspan="3"><p style="font-size:16px;font-weight:bold;">Background Information</p></td>
    </tr>
    <tr>
        <td colspan="3"><p style="font-size:12px;"><?php echo ucfirst($progress_details->project_description);?></p></td>
    </tr>
    <tr>
        <td colspan="3">
            <p style="font-size:16px;font-weight:bold;">Problem Statement</p>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <p style="font-size:12px;"><?php echo ucfirst($progress_details->problem_statement);?></p>
        </td>
    </tr>
    <tr>
        <td colspan="3"><p style='font-size:16px;font-weight:bold;'>Problem Goals</p></td>
    </tr>
    <tr>
        <td colspan="3">
            <p style="font-size:12px;"><?php echo ucfirst($get_project_goals->description) ?></p>
        </td>
    </tr>
</table>
    <!-- <tr><td><br><b>PROJECT DESCRIPTION</b><br>< ?php echo $progress_details->project_description; ?></td></tr> -->
    <!-- <tr><td>< ?php echo $progress_details->project_description; ?></td></tr> -->
    <!-- < ?php if($progress_details->sdgs != "") { ?> -->
    <!-- <tr><td><b>SDG ALIGNMENT<br><br></b></td></tr> -->
    <!-- <tr>
        <td>
            < ?php 
                $SDGs = $this->ProjectModel->getSDGs($progress_details->sdgs);
                if(isset($SDGs) && count($SDGs)>0){
                    foreach($SDGs as $value){ ?>
                <img src="< ?php echo PRO_SDGS_IMG_URL.$value; ?>" class="g-sdgs-img" width="100" height="100">
            < ?php } } ?>
        </td>
    </tr> -->
    <!-- < ?php }?> -->
<table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center;padding:0px 100px;" cellspacing="10">
<!-- cellspacing="20" -->
    <tr style="text-align:center;">
        <?php $sectors = $this->ProjectModel->getSectors($progress_details->sectors);?>
        <?php $beneficiaries = $this->ProjectModel->getBeneficiaries($progress_details->beneficiaries);?>
        <td style="width:25%;height:150px;background-color:#33ccff;border-radius:10px;color:white;"><span style="font-size:18px;">Project Duration</span> <p> <span style="font-size:12px;"><?php echo ($get_interval_in_month>1) ? $get_interval_in_month.' months': $get_interval_in_month.' month';?> </span></p></td>
        <td style="width:25%;height:150px;background-color:#33ccff;border-radius:10px;color:white;"><span style="font-size:18px;">SECTORS FOCUSSED </span> <p> <span style="font-size:12px;"> <?php echo implode(', ',$sectors);?> </span></p></td>
        <td style="width:25%;height:150px;background-color:#33ccff;border-radius:10px;color:white;"><span style="font-size:18px;">PROJECT LOCATION </span> <p> <span style="font-size:12px;"> <?php echo $progress_details->district.', '.$progress_details->city;?></span></p></td>
    </tr>
    <tr style="text-align:center;">
        <td style="width:25%;height:150px;background-color:#33ccff;border-radius:10px;color:white;"><span style="font-size:18px;">BENEFICIARY TYPES</span> <p><span style="font-size:12px;"><?php echo implode(', ',$beneficiaries);?></span></p> </td>
        <td style="width:25%;height:150px;background-color:#33ccff;border-radius:10px;color:white;"><span style="font-size:18px;">BENEFICIARIES </span> <p><span style="font-size:12px;"><?php echo $progress_details->no_of_beneficiaries;?></span></p> </td>
        <td style="width:25%;height:150px;background-color:#33ccff;border-radius:10px;color:white;"><span style="font-size:18px;">PROJECT BUDGET </span> <p><span style="font-size:12px;"><?php echo $progress_details->total_project_cost; ?></span></p></td>
    </tr>
    <!-- <footer style="position:fixed;bottom:0px;width:100%;font-size:20px;left:3px;bottom:20px;font-family:arial;">
        Progress Report,&nbsp;< ?php echo strtoupper(date("M Y", strtotime("-1 months", $progress_details->due_date)));?><?php echo ';&nbsp;&nbsp;'.ucfirst($user_details->first_name).'&nbsp;'.$user_details->last_name;?>
    </footer> -->
</table>
<!-- <table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center; ">
    <tr>
        <td><b>Duration</b></td>
        <td><b>Sector</b></td>
        <td><b>Location</b></td>
        <td><b>Beneficiary</b></td>
        <td><b>Total No. of Beneficiaries Benefitted</b></td> -->
        <!-- <td><b>BENEFICIARIES</b></td> -->
    <!-- </tr>
    < ?php $sectors = $this->ProjectModel->getSectors($progress_details->sectors);?>
    < ?php $beneficiaries = $this->ProjectModel->getBeneficiaries($progress_details->beneficiaries);?>
    <tr> -->
        <!-- <td>< ?php echo ($get_interval_in_month>1) ? $get_interval_in_month.' months': $get_interval_in_month.' month';?></td>
        <td>< ?php echo implode(', ',$sectors);?></td>
        <td> < ?php echo $progress_details->district.', '.$progress_details->city;?></td>
        <td>< ?php echo implode(', ',$beneficiaries);?></td>
        <td>0</td> -->
        <!-- <td>< ?php echo $progress_details->serve_beneficiaries.'/'.$progress_details->total_beneficiaries;?></td> -->
    <!-- </tr> -->
<!-- </table> -->
<!-- page breaks here start here -->
<table>
<tr>
    <p style="page-break-after: always;">&nbsp;</p>
</tr>
</table>
<!-- page breaks here -->
<table style="font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center;">
    <tr>
        <td><img src="<?php echo base_url();?>public/uploads/banner/trucsr-email-logo.png"/ style="height:50px;"><br><br><br></td>
    </tr>
</table>
<table style="font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:left;">
<tr>
    <td><p style='font-size:20px;font-weight:bold;'>B- PROJECT PROGRESS REPORT DURING THE REPORTING PERIOD</p></td>
</tr>
<tr>
    <td><p style="font-size:16px;font-weight:bold;">Status of Project Activities </p></td>
</tr>
<tr>
    <td>
        <p style="font-size:12px;"><?php echo $progress_details->work_activity_status;?></p>
    </td>
</tr>
<tr>
    <td><p style="font-size:16px;font-weight:bold;">Description of activities Completed /In-Progress</p></td>
</tr>
<tr>
    <td>
        <p style="font-size:12px;"><?php echo $progress_details->work_description;?></p>
    </td>
</tr>
<tr><td><p style="font-size:16px;font-weight:bold;">NO. OF BENEFICIARIES</p></td></tr>
<tr>
    <td>
        <p style="font-size:12px;"><?php echo $progress_details->no_of_beneficiaries;?></p>
    </td>
</tr> 
<!-- </table>
<table style="font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:left;"> -->
<!-- <tr>
    <td><p style="font-size:16px;font-weight:bold;">Case Study :</p></td>
</tr> -->

<!-- <tr>
    <p style="page-break-after: always;">&nbsp;</p>
</tr> -->
<tr>
    <td>
        <p style="font-size:16px;font-weight:bold;">Case Study :</p>
    </td>
</tr>
</table>
<div style='padding:0px 15px;'>
<p><b>Title :</b>&nbsp;&nbsp;

    <?php 
    if($case_study_details==""){
        echo '';
    }else{
        echo ucfirst($case_study_details->case_study_title);
    }
    ?>
</p>
</div>
<p>
    <?php if($case_study_details==""){ ?>
        <?php echo '';?>
    <?php }else{?>
        <div style='margin-bottom:40px;padding:0px 15px;'>
            <img src="<?php echo REP_CASE_STUDY_URL.$case_study_details->case_study_image;?>" width="150" height="150" style="float:left;margin:5px 10px 15px 0px;">  
            <?= $case_study_details->case_study;?> 
        </div>
        
    <?php }?>
                   
    
</p>

    <!-- <tr>
        <td>
            <h2>PROGRESS THIS MONTH</h2>
        </td>
    </tr>
    <tr><td><b><br>STATUS FOR WORK ACTIVITY / ACTIVITIES</b></td><td></td></tr>
    <tr><td>< ?php echo $progress_details->work_activity_status;?><br></td></tr>
    <tr><td><b>WORK DESCRIPTION / ACTIVITIES</b></td></tr>
    <tr><td>< ?php echo $progress_details->work_description;?></td></tr>
    <tr><td><br><b>NO. OF BENEFICIARIES</b></td></tr>
    <tr><td>< ?php echo $progress_details->no_of_beneficiaries;?></td></tr> -->
    <!-- <footer style="position:fixed;bottom:0px;width:100%;font-size:10px;left:3px;bottom:20px;font-family:arial;">
        Progress Report,&nbsp;< ?php echo strtoupper(date("M Y", strtotime("-1 months", $progress_details->due_date)));?>< ?php echo ';&nbsp;&nbsp;'.ucfirst($user_details->first_name).'&nbsp;'.$user_details->last_name;?>
    </footer> -->
<!-- </table> -->
<!-- <table>
< ?php
    if(isset($proReportImageData) && count($proReportImageData)>0){
        foreach($proReportImageData as $value){
?>
<tr>
    <td style="width:20%;"><b>ACITIVITY IMAGE</b></td>
    <td><b>ACTIVITY DESCRIPTION</b></td>
</tr>
<br>
<tr>
    <td style="width:20%;"><img src="< ?=REP_IMG_URL.$value->image_path?>" width="100" height="100"></td>
    <td>< ?=$value->image_description?></td>
</tr>
< ?php 
        }
    }
?>
</table> -->
<!-- <table>
<tr>
    <p style="page-break-after: always;">&nbsp;</p>
</tr>
</table> -->
<p style="page-break-after: always;">&nbsp;</p>
<table style="font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center;">
    <tr>
        <td><img src="<?php echo base_url();?>public/uploads/banner/trucsr-email-logo.png" style="height:50px;"><br><br><br></td>
    </tr>
</table>
<table>
    <!-- <tr>
        <td><b>FUND SUMMARY</b></td>
    </tr> -->
    <tr>
        <td><p style='font-size:20px;font-weight:bold;'>C- Financial Summary</p></td>
    </tr>
</table>
<table cellspacing="0">
    <?php
    $totalBudgetAmt = ($progress_details->total_project_cost) + 0;
    ?>
    <!-- <tr>
        <td class="border">
            <b>TOTAL PROJECT COST</b> 
        </td>
         <td class="border">
            <b>TOTAL AMOUNT COMMITED</b>
        </td>
    </tr>
    
    <tr>
        <td class="border">₹ <?php echo $totalBudgetAmt;?></td>
        <td class="border" id="totalCommitedAmt">₹</td>
    </tr> -->
</table>
<table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:left; ">
    <tr>
        <td>
            <div class="graph-funds form-group">
                <img style="width:100%;">
                <div id="funds_summery" style="overflow: visible !important;"></div>                            
            </div>
        </td>
    </tr>
</table>

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
        <tr class="border">
            <td class="border" colspan="2">Total</td>
            <td class="border">₹<?= number_format($totalCommitAmt, 0, '', ','); ?></td>
            <td class="border">₹ <?= number_format($totalReceiveAmt, 0, '', ',');?></td>
            <td class="border">₹ <?= number_format($totalBalanceAmt, 0, '', ',');?></td>
        </tr>
    </table>
    <br><br>
    <table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center;" cellspacing="0">

        <tr>
            <td><b>AMOUNT COMMITTED</b></td>
            <td><b>AMOUNT RECEIVED</b></td>
            <td><b>BALANCE AMOUNT</b></td>
        </tr>
        <tr>
            <td>₹ <?= number_format($totalCommitAmt, 0, '', ','); ?></td>
            <td>₹  <?= number_format($totalReceiveAmt, 0, '', ',');?></td>
            <td>₹ <?= number_format($totalBalanceAmt, 0, '', ',');?></td>
        </tr>

        
    <?php } else { ?>
        <!-- <p>No Record Found</p> -->

        <!-- <tr class="border">
            <td class="border"><b>AMOUNT COMMITTED</b></td>
            <td class="border"><b>AMOUNT RECEIVED</b></td>
            <td class="border"><b>BALANCE AMOUNT</b></td>
        </tr>
        <tr class="border">
            <td class="border">₹ < ?= number_format($totalCommitAmt, 0, '', ','); ?></td>
            <td class="border">₹  < ?= number_format($totalReceiveAmt, 0, '', ',');?></td>
            <td class="border">₹ < ?= number_format($totalBalanceAmt, 0, '', ',');?></td>
        </tr> -->
    <?php }?>
</table>
<!-- <table>
<tr>
    <p style="page-break-after: always;">&nbsp;</p>
</tr>
</table> -->
<br><br>
<table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:left;" cellspacing="0">
    <!-- <tr>
        <td><img src="<?php echo base_url();?>public/uploads/banner/trucsr-email-logo.png"/ style="height:50px;"><br><br><br></td>
    </tr> -->
    <!-- <tr>
        <td>
            <b>FUNDS RECEIVED FROM OTHER CONTRIBUTORS</b>
        </td>
    </tr> -->
    <?php if(isset($unselectContributor) && count($unselectContributor) > 0){?>
        <tr>
            <td>
                <b style="font-size:16px;">FUNDS RECEIVED FROM OTHER SOURCE</b>
            </td>
        </tr>
    <?php }else {?>
        <tr>
            <td></td>
        </tr>
    <?php }?>
</table>
</table>
<table style="font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center;" cellspacing="0">
<?php if(isset($unselectContributor) && count($unselectContributor) > 0){?>
    <tr class="border">
        <th class="border">FUNDED BY</th>
        <!-- <th class="border">DATE RECEIVED</th> -->
        <th class="border">SOURCE</th>
        <th class="border">COMMITTED</th>
        <th class="border">RECEIVED</th>
        <th class="border">BALANCE</th>
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
    <th>TOTAL PROJECT BUDGET</th>
    <th>TOTAL AMOUNT COMMITTED</th>
    <th>TOTAL AMOUNT RECEIVED </th>
    <th>TOTAL BALANCE AMOUNT</th>
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
                <th class="border">No. of Donors who contributed</th>
                <th class="border">Total Amount Received</th>
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
        <th class="border">SR.NO</th>
        <th class="border">DESCRIPTION</th>
        <th class="border">FUNDED BY</th>
        <th class="border">AMOUNT SPENT</th>
        <th class="border">DOCUMENT</th>
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
            <th class="border">-</th>
            <th class="border">-</th>
            <th class="border">-</th>
            <th class="border">-</th>
            <th class="border">-</th>
        </tr>
   <?php }
    ?>
</table>
<table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center;" cellspacing="0">
     <input type="hidden" name="recAmt" id="recAmt" value="<?=$recAmt?>">
     <tr>
        <th><br style="font-size:16px;">TOTAL AMOUNT RECEIVED</th>
        <th><br style="font-size:16px;">TOTAL AMOUNT SPENT</th>
        <th><br style="font-size:16px;">TOTAL BALANCE UNSPENT</th>
     </tr>
     <tr>
        <td>₹ <?=number_format($recAmt, 0, '', ',');?></td>
        <td>₹ <?=number_format($totalSpentAmt, 0, '', ',');?></td>
        <td>₹ <?=number_format($recAmt - $totalSpentAmt, 0, '', ',');?></td>
     </tr>
     
</table>
<footer style="position:fixed;bottom:0px;width:100%;font-size:11px;left:3px;bottom:10px;font-family:arial;">
        Progress Report,&nbsp;<?php echo strtoupper(date("M Y", strtotime("-1 months", $progress_details->due_date)));?><?php echo ',&nbsp;&nbsp;'.ucfirst($user_details->first_name).'&nbsp;'.$user_details->last_name;?> | For any queries: info@trucsr.in
</footer>
<!-- <table> -->
    
<!-- <tr>
    <p style="page-break-after: always;">&nbsp;</p>
</tr> -->
<!-- </table> -->
<!-- <table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center;" cellspacing="0">
    <tr>
        <td><img src="< ?php echo base_url();?>public/uploads/banner/trucsr-email-logo.png"/ style="height:50px;"><br><br><br></td>
    </tr>
</table> -->
<!-- <table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:left;" cellspacing="0">
    <tr>
        <td>
            <b>CASE STUDY<br><br></b>
        </td>
    </tr>
</table> -->
<!-- <table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:left;" cellspacing="0">
    < ?php 
    if(isset($reportCaseStudyData) && count($reportCaseStudyData)>0){
        //echo "<pre>";print_r($reportCaseStudyData);echo "</pre>";
        foreach($reportCaseStudyData as $value){	?>
            <tr><td><b>TITLE OF THE CASE STUDY</b> <br><br>< ?= $value->case_study_title;?></td></tr>
            <tr><br><td><br><br><img src="< ?php echo REP_CASE_STUDY_URL.$value->case_study_image;?>" height="100" width="100" class="thumbnail" title=""></td></tr>
            <tr><br><td>< ?= $value->case_study;?></td></tr>
       < ?php  }}
    ?>
</table> -->
<!-- code commented becasue it is not required as of now -->
<!-- <table>
    <tr>
        <p style="page-break-after: always;">&nbsp;</p>
    </tr>
</table>
<table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center; ">
        <tr>
            <td><img src="< ?php echo base_url();?>public/uploads/banner/trucsr-email-logo.png"/ style="height:50px;"><br><br><br></td>
        </tr>
</table>
<table style=" font-family:'Roboto',sans-serif,; font-size:14px;width:100%;text-align:center; ">
    <tr>
        <th><h2>Implementer</h2></th>
        <th><h2>Contributor</h2></th>
    </tr>
    <tr>
        <td>< ?=  ucfirst($user_details->first_name).'&nbsp;'.$user_details->last_name;?><br>< ?= $ngo_details->org_address_line1.',&nbsp;'.$ngo_details->org_address_line1.'<br>'.$ngo_details->city.',&nbsp;'.$ngo_details->district.'<br>'.$ngo_details->state.'-'.$ngo_details->pincode;?></td>  
        <td>
            < ?php
                if(isset($selectedContributorArr) && count($selectedContributorArr)>0){
                    $count=1;	
                    foreach($selectedContributorArr as $key => $value){
                        // echo $count.". ".$value->funded_by."&nbsp; "; //original code commented
                        echo ucfirst($value->company_name)."<br>";
                        echo $value->company_address_1.','.$value->company_address_2.',&nbsp'.$value->city.'&nbsp;<br>'.$value->district.'&nbsp;&nbsp;<br>'.$value->state.'-'.$value->pincode;
                        $count++;
                    }
                }
            ?>
        </td>  
    </tr>
</table> -->

 </body>
</html>

<!-- cod start here -->
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
<!-- code ends here -->
