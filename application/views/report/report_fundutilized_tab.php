<div class="form-group  fund-received-table ">
	<p class="second-heading">FUNDS	UTILIZED</p>
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
							$fundUtilizedHtml.='<td class="medium-td">';
								$fundUtilizedHtml.='<input class="form-control" type="text" value="'.$value->amount_description.'" placeholder="We are aiming to make the villiage" disabled="disabled">';
							$fundUtilizedHtml.='</td>';
							$fundUtilizedHtml.='<td class="medium-td">';
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
							// if($ext == 'pdf'){
							// 	$imageSrc=SKIN_URL.'images/pdf-icon.png';
							// }else{
							// 	$imageSrc=FUND_UTILIZED_IMG_URL.$value->document;
							// }
							if($ext == 'pdf'){
								$imageSrc=SKIN_URL.'images/pdf-icon.png';
								$imagePdf='<img class="imageThumb" src="'.$imageSrc.'" width="50" height="50">';
							}else{
								$imagePdf='-';
							}
							$fundUtilizedHtml.='<td>';
									$fundUtilizedHtml.='<span class="remove-link" onclick="remove_fundutilized('.$value->id.')">Remove</span>';
									$fundUtilizedHtml.='<span>'.$imagePdf.'</span>';
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
						$fundUtilizedHtml.='<input type="text" class="form-control" id="amount_description" name="amount_description" placeholder="Enter amount description here">';
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
						$fundUtilizedHtml.='<input type="text" class="form-control amount-number validate-number" name="amount" id="fund_utilized_amount">';
					$fundUtilizedHtml.='</td>';
					$fundUtilizedHtml.='<td>';
						$fundUtilizedHtml.='<div class="incp-sec" id="upload_img_reciept"></div>';
						$fundUtilizedHtml.='<div class="reciept-upload" style="display:block">';
							$fundUtilizedHtml.='<input class="upload-receipt" type="file" name="documentFile" id="fund_utilized_document">';
						$fundUtilizedHtml.='</div>';	
					$fundUtilizedHtml.='</td>';
				$fundUtilizedHtml.='</tr>';
				echo $fundUtilizedHtml;
				?>
			</tbody>
		</table>
	</div>
	<div class="button-set"><button class="add-entry-button" type="button" onclick="add_fundutilized()">+ Add another entry</button></div>

    <input type="hidden" name="recAmt" id="recAmt" value="<?=$recAmt?>">	
	<div class="add-another-fund-box">
		<div class="col-sm-4"><span>TOTAL AMOUNT <br>RECEIVED</span> <input class="form-control" type="text" value="₹ <?=number_format($recAmt, 0, '', ',')?>" placeholder="--"></div>
		<div class="col-sm-4"><span>TOTAL AMOUNT <br>SPENT</span> <input class="form-control" type="text" id="totalSpentAmt" value="₹ <?=number_format($totalSpentAmt, 0, '', ',')?>"  placeholder="--"></div>
		<div class="col-sm-4"><span>TOTAL BALANCE <br>UNSPENT  </span> <input class="form-control" type="text" id="totalUnSpentAmt" value="₹ <?=number_format($recAmt - $totalSpentAmt, 0, '', ',')?>"  placeholder="--"></div>
	</div>
</div><!-- fund-received-table -->
<script type="text/javascript">
	function add_fundutilized(){
		var form_data = new FormData();                  
	    form_data.append('documentFile', $('#fund_utilized_document').prop('files')[0]);                   
	    form_data.append('project_id', $('#project_id').val());                 
	    form_data.append('project_contributor_fund_id', $('#project_contributor_fund_id').val());                  
	    form_data.append('amount_description', $('#amount_description').val());                  
	    form_data.append('amount', $('#fund_utilized_amount').val());                  
	    form_data.append('recAmt', $('#recAmt').val());
	    $.ajax({
	        url: BASE_URL+"reports/add_fundutilized",
			type: 'ajax',
            method: "POST",
			dataType: 'json',
			data: form_data,
			processData: false,
            contentType: false,
			success: function(response) {
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
				    $('#fund-utilized-div').html('');
                    $('#fund-utilized-div').html(response.fundUtilizedHtml);
                    $('#totalSpentAmt').val(response.totalSpentAmt);
                    $('#totalUnSpentAmt').val(response.totalUnSpentAmt);
				}
			}
	    });
	}

	function remove_fundutilized(id){
		if (confirm('Are you sure that want to delete this Image?')){
			var project_id=$('#project_id').val();
			var recAmt=$('#recAmt').val()
			$.ajax({
		        url: BASE_URL+"reports/remove_fundutilized",
				type: 'ajax',
	            method: "POST",
				dataType: 'json',
				data: {id:id,project_id:project_id,recAmt:recAmt},
				success: function(response) {
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
					    $('#fund-utilized-div').html('');
	                    $('#fund-utilized-div').html(response.fundUtilizedHtml);
                        $('#totalSpentAmt').val(response.totalSpentAmt);
                        $('#totalUnSpentAmt').val(response.totalUnSpentAmt);
					}
				}
		    });
	    }
	}
</script>