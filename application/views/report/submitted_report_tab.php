<div id="submitted-report" class="fade contract-list overflow-table blue-table" style="">
	<?php if($submittedReportsCount > 0) { ?>
	<div class="create-report-sec-inner">
		<table cellpadding="0" cellspacing="0" align="center"> 
			<tbody>
				<tr>
					<th>Sr No.</th>
					<th>REPORT TYPE</th>
					<th>DUE DATE</th>
					<th>DATE SUBMITTED </th>
					<th>STATUS</th>
					<th></th>
				</tr>
				<?php 
				if(isset($SubmittedReports) && !empty($SubmittedReports))
				{
					$i = 1;
					foreach ($SubmittedReports as $sub_report) { ?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $sub_report->report_type_name;?></td>
						<td>--</td>
						<td><?php echo date('d-m-Y', $sub_report->submit_date);?></td>
						<td class="">--</td>
						<td><a class="upload-contract campaign-blue-btn inactive-create" href="javascript:void(0)">CREATE REPORT</a>
						</td>
					</tr>
				<?php $i++; } } ?>
			</tbody>
		</table>
	</div>

	<!-- <div class="view-more-btn text-center">
		<a href="" class="view-more"> VIEW MORE</a>
	</div> -->
	<?php } else { ?>
		<p class="not-found">No Data found.</p>
	<?php } ?>	
</div>