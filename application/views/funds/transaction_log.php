<div class="blue-table overflow-table recent-transcation">
	<table cellpadding="4" cellspacing="4" align="center">
		<tbody>
			<tr>
				<th>DESCRIPTION </th>
				<th>DATE </th>
				<th>RECEIVED  (₹)</th>
				<th>UTILIZED  (₹)</th>
			</tr>
			<?php 
			$totalRecived=0;
			$totalUtilized=0;
			if(isset($projectContributorFundReceiveDetails) && count($projectContributorFundReceiveDetails)>0){
				// echo "<pre>";print_r($projectContributorFundReceiveDetails);echo "<pre>";
                $j=0;
				foreach($projectContributorFundReceiveDetails as $value){
					// echo "<pre>";print_r($FundReceiveDetails);echo "<pre>";
					if($value['type']=="received"){
						$totalRecived=$totalRecived+$value['amount'];
	                    ?>
						<tr id="trId<?=$j?>">
							<!-- <td><?php //echo $value['amount_description']; ?></td> -->
							<td class="red-text"> --</td>
							<td><?php echo date("d-m-Y",$value['created_at'])?></td>
							<td class="green-text"><i class="fa fa-inr">₹</i> <?=$value['amount']?></td>
							<td class="red-text"> --</td>
						</tr>
						<?php
					}else{
						$totalUtilized=$totalUtilized+$value['amount'];
						?>
						<tr id="trId<?=$j?>">
							<td><?php echo $value['amount_description']; ?></td>
							<td><?php echo date("d-m-Y",$value['created_at'])?></td>
							<td class="green-text"> --</td>
							<td class="red-text"><i class="fa fa-inr">₹</i> <?=$value['amount']?></td>
						</tr>
						<?php
					}
					$j++;
			    }
			}
			?>
		</tbody>
	</table>
</div>