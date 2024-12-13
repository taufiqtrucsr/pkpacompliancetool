<div class="form-group  fund-received-table" id="contributorDiv">
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
						// $fundHtml.='<th>DATE RECEIVED</th>';
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
					    // $fundHtml.='<td><input type="text" class="form-control " id="funded_by_'.$value->id.'" name="funded_by[]" value="'.$value->funded_by.'" placeholder="'.$value->funded_by.'" disabled="disabled"></td>';
					    $fundHtml.='<td><input type="text" class="form-control " id="funded_by_'.$value->id.'" name="created_at[]" value="'.$created.'" placeholder="'.$created.'" disabled="disabled"></td><td><input type="text" class="form-control " id="source_'.$value->id.'" name="source[]" value="'.$value->source.'" placeholder="'.$value->source.'" disabled="disabled"></td>';
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
		    $fundHtml.="<br/>No Records FoundD<br/><br/>";
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
							// $fundHtml.='<th>DATE RECEIVED</th>';
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
						    // $fundHtml.='<td><input type="text" class="form-control " id="funded_by_'.$value->id.'" name="created_at[]" value="'.$created.'" placeholder="'.$created.'" disabled="disabled"></td>';
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

	//code for donation amount

	// $fundHtml.='<div>';
	// $fundHtml.='<p class="second-heading">DONATION RECEIVED FROM INDIVIDUALS</p>';
	// $fundHtml.='<br>';
	// $fundHtml.='<table style="border:1px solid #d3d2d7;" cellpadding="0" cellspacing="0">';
	// 	$fundHtml.='<tr>';
	// 		$fundHtml.='<td style="border:1px solid #d3d2d7;padding:10px;color:#9ea9c2;font-size:12px;">No. of Donors who contributed</td>';
	// 		$fundHtml.='<td style="border:1px solid #d3d2d7;padding:10px;color:#9ea9c2;font-size:12px;">Total Amount Received</td>';
	// 	$fundHtml.='</tr>';
	// 	$fundHtml.='<tr>';
	// 		$fundHtml.='<td style="border:1px solid #d3d2d7;padding:10px;color:#9ea9c2;font-size:12px;">'.$gettotaldonation->no_of_doners.'</td>';
	// 		$fundHtml.='<td style="border:1px solid #d3d2d7;padding:10px;color:#9ea9c2;font-size:12px;">'.$gettotaldonation->total_donation.'</td>';
	// 	$fundHtml.='</tr>';
	// $fundHtml.='</table>';
	// $fundHtml.='</div>';
	// $fundHtml.='<br>';
	// $fundHtml.='<br>';
	// $fundHtml.='<hr>';
	
	echo $fundHtml;

?>	
</div>

