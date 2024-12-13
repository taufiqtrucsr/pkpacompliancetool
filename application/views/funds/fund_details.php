<div class="kyc-title"> <h2>Funding status</h2><span class="support-action"><a href="mailto:support@trucsr.in"> Need Support?</a></span></div>
			
<div class="shadow-box">
	<p class="create-para create-project-sec pl-0"><label class="control-label no-cap-txt"><a href="<?php echo base_url('dashboard/funds');?>">Funding Status &nbsp; </a><i class="fa fa-angle-right"></i> &nbsp;  <?=$projectContributorFundDetails['funded_by']?></label></p>

	<div id="" class="funding-total-funds funding-det">
	    <p class="second-heading">FUNDING DETAILS</p>
		<div class="form-group col-sm-3 ">
			<label class="control-label">Funded By</label>
			<p class="normal-font black-font no-cap-txt"><?=$projectContributorFundDetails['funded_by']?></p>
		</div>
		<div class="form-group col-sm-3 ">
		    <label class="control-label">Start Date</label>
			<p class="normal-font black-font"><?php echo date("d-m-Y",$projectContributorFundDetails['start_date'])?></p>
		</div>
		<div class="form-group col-sm-3 ">
		    <label class="control-label">End Date</label>
			<p class="normal-font black-font"><?php echo date("d-m-Y",$projectContributorFundDetails['end_date'])?></p>
		</div>
		<div class="form-group col-sm-3 ">
		    <label class="control-label">Amount Commited</label>
			<p class="normal-font black-font"><i class="fa fa-inr"></i> <?=$projectContributorFundDetails['committed_amount']?></p>
		</div>
	</div><!-- funding-total-funds -->


	<div class="form-group  funded-table">
		<p class="second-heading">RECENT TRANSACTION LOG <button class="blue-link dwn-btn" onclick="downloadTransactionLog(<?=$projectContributorFundDetails['id']?>)">DOWNLOAD</button></p>
		<div class="blue-table overflow-table recent-transcation">
			<table cellpadding="0" cellspacing="0" align="center">
				<tbody>
					<tr>
						<th>DATE </th>
						<th>RECEIVED  (<i class="fa fa-inr"></i>)</th>
						<th>UTILIZED  (<i class="fa fa-inr"></i>)</th>
						<th>DESCRIPTION </th>
					</tr>
					<?php 
					$totalRecived=0;
					$totalUtilized=0;
					if(isset($projectContributorFundReceiveDetails) && count($projectContributorFundReceiveDetails)>0){
						//echo "<pre>";print_r($projectContributorFundReceiveDetails);echo "<pre>";
		                $contributorCount=count($projectContributorFundReceiveDetails);
		                $pageContributorCount=4;
		                $noPage=round($contributorCount/$pageContributorCount);
		                $array=array();
		                for ($i=0; $i < $noPage ; $i++) {
		                	$start=$pageContributorCount*$i;  
		                    $end=($start+$pageContributorCount) -1;
		                }
                        $j=0;
						foreach($projectContributorFundReceiveDetails as $value){
							// echo "<pre>";print_r($value);echo "<pre>";
							if($value['type']=="received"){
								$totalRecived=$totalRecived+$value['amount'];
			                    ?>
								<tr id="trId<?=$j?>" style="display:none">
									<td><?php echo date("d-m-Y",$value['created_at'])?></td>
									<td class="green-text"><i class="fa fa-inr"></i> <?=number_format($value['amount'], 0, '', ',')?></td>
									<td class="red-text"> --</td>
									<td class="red-text"> --</td>
									<!-- <td><?php // echo $value['amount_description']; ?></td> -->
								</tr>
								<?php
							}else{
								$totalUtilized=$totalUtilized+$value['amount'];
								?>
								<tr id="trId<?=$j?>" style="display:none">
									<td><?php echo date("d-m-Y",$value['created_at'])?></td>
									<td class="green-text"> --</td>
									<td class="red-text"><i class="fa fa-inr"></i> <?=number_format($value['amount'], 0, '', ',')?></td>
									<td><?php echo $value['amount_description']; ?></td>
								</tr>
								<?php
							}
							$j++;
					    }
					}
					$totalUnspent=$totalRecived-$totalUtilized;
					?>
				</tbody>
			</table>
		</div>
		<div class="add-another-fund-box recent-transation-fund">
			<div class="col-sm-2">&nbsp;</div>
			<div class="col-sm-5"><span>TOTAL AMOUNT RECEIVED</span><input class="form-control green-box" type="text" value="₹ <?=number_format($totalRecived, 0, '', ',')?>"  placeholder="--" disabled="disabled"></div>
			<div class="col-sm-5"><span>TOTAL AMOUNT UTILIZED </span> <input class="form-control red-box" type="text" value="₹ <?=number_format($totalUtilized, 0, '', ',')?>"  placeholder="--" disabled="disabled"></div>
		</div>
	</div><!-- funded-table -->
    
    <?php if(isset($noPage) && $noPage > 0){?>
	<div class="pagination-recent">
		<ul>
			<?php
			for ($i=0; $i < $noPage ; $i++) {
		        $start=$pageContributorCount*$i;  
		        $end=($start+$pageContributorCount) -1;
		        $num=$i+1;
		    ?>    
			    <li id="liid<?=$i?>" onclick="selectPage(<?=$i?>,<?=$contributorCount?>,<?=$start?>,<?=$end?>)"><a href="javascript:void()"><?=$num?></a></li>
			<?php }?>    
		</ul>
	</div><!-- pagination-recent -->
    <?php }?>
	<div class="funds-summary unsent-amount">
		<div class="form-group col-sm-6">
			<label class="control-label grey-txt">TOTAL AMOUNT UNSPENT  <span class="info-tip"><a data-toggle="tooltip" title="Total unsent amount" data-original-title="Balance"><img src="<?=SKIN_URL?>/images/info_grey.png"></a></span> </label>
			<input class="form-control" type="text" value="₹<?=number_format($totalUnspent, 0, '', ',')?>" placeholder="" disabled="disabled">
		</div><!-- col-sm-6 -->
		<div class="form-group col-sm-6">
			<label class="control-label grey-txt">TOTAL AMOUNT BALANCE <span class="info-tip"><a data-toggle="tooltip" title="Total balance amount" data-original-title="Balance"><img src="<?=SKIN_URL?>/images/info_grey.png"></a></span></label>
			<input class="form-control" type="text" value="₹ <?=number_format($projectContributorFundDetails['balance_amount'], 0, '', ',')?>" placeholder="" disabled="disabled">
		</div><!-- col-sm-6 -->
	</div><!-- funds-summary -->
   <?php
    $current_date=strtotime(date("Y-m-d"));
    if($projectData->project_type == 1 && $projectData->project_date_to >= $current_date){
    ?>
	<div class="add-amount-btns">
		<button class="btn btn-primary " type="button" data-toggle="modal" data-target="#add-the-amount-recieved-popup">ADD THE AMOUNT RECEIVED</button>
		<?php if ($totalRecived !=0) { ?>
			<button class="btn btn-primary " type="button" data-toggle="modal" data-target="#add-the-amount-utilized-popup">ADD THE AMOUNT UTILIZED</button>
		<?php } ?>
	</div><!-- add-amount-btns -->
    <?php }elseif($projectData->project_type == 2){?>
    <div class="add-amount-btns">
		<button class="btn btn-primary " type="button" data-toggle="modal" data-target="#add-the-amount-recieved-popup">ADD THE AMOUNT RECEIVED</button>
		<?php if ($totalRecived !=0) { ?>
			<button class="btn btn-primary " type="button" data-toggle="modal" data-target="#add-the-amount-utilized-popup">ADD THE AMOUNT UTILIZED</button>
		<?php } ?>
	</div><!-- add-amount-btns -->
    <?php }?>	
    <form id="downloadTransForm" method="POST" action="<?=base_url();?>funds/get_transaction_log">
    	<input type="hidden" id="trans_fund_id" name="fund_id">
    </form>	
</div><!-- shadow-box -->
<script>
	selectPage(0,<?=$contributorCount?>,0,<?=$pageContributorCount-1?>);
	function selectPage(num,pages,start,end){
		for (var i = 0; i < pages; i++) {
			$('#trId'+i).hide();
			$("#liid"+i).removeClass("active");
		}
		$("#liid"+num).addClass("active");
		for (var i = start; i <= end; i++) {
			$('#trId'+i).show();
		}
        
	}

	function downloadTransactionLog(fund_id){
		$("#trans_fund_id").val(fund_id);
        $("#downloadTransForm").submit();
	}
</script>	
