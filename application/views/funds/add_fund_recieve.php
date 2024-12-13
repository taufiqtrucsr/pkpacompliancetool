<?php 
if(isset($projectContributorFunds) && count($projectContributorFunds)>0){
	foreach($projectContributorFunds as $value){
		setlocale(LC_MONETARY, 'en_IN');
		$committed_amount = $value['committed_amount'];
		$recieved_amount = $value['received_amount'];
		$balance_amount = $value['balance_amount'];
		// $committed_amount = str_replace('INR ','',money_format('%i', $value['committed_amount']));
		// $recieved_amount = str_replace('INR ','',money_format('%i', $value['received_amount']));
		// $balance_amount = str_replace('INR ','',money_format('%i', $value['balance_amount']));
	    ?>
		<tr>
			<td class="big-td">
				<?=$value['funded_by']?> 
			</td>
			<td class="big-td">
				<?=$value['source']?>
			</td>
			<td class="medium-td rupee-box">
				<?php echo $committed_amount;?>
			</td>
			<td class="medium-td rupee-box">
				<?php echo $recieved_amount;?>
			</td>
			<td class="medium-td rupee-box">
				<?php echo $balance_amount;?>
			</td>
			<td class="medium-td rupee-box">
				<a class="blue-link" href="/funds/view/<?=$value['id']?>">VIEW DETAILS</a>
			</td>
		</tr>
	    <?php 
    } 
}

$current_date=strtotime(date("Y-m-d"));
if(($projectData->project_type == 1 && $projectData->project_date_to >= $current_date) || $projectData->project_type == 2){

 ?>
	<tr>
		<td class="big-td">
			--
		</td>
		<td class="big-td">
			--
		</td>
		<td class="medium-td rupee-box">
			--
		</td>
		<td class="medium-td rupee-box">
			--
		</td>
		<td class="medium-td rupee-box">
			--
		</td>
		<td class="medium-td rupee-box">
			<a class="blue-link" href="#"  data-toggle="modal" data-target="#add-fund-recieved-details-popup">ADD DETAILS</a>
		</td>
	</tr>
<?php }?>		

