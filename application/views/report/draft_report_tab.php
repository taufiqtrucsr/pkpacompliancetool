<div id="draft-report" class="fade contract-list overflow-table blue-table" style="">
	<?php if($draftReportsCount > 0) { ?>
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
				if(isset($DraftReports) && !empty($DraftReports))
				{
					$i = 1;
					foreach ($DraftReports as $draft_report) { ?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $draft_report->report_type_name;?></td>
						<td><?php echo date('d-m-Y', $draft_report->due_date);?></td>
						<td><?php echo ($draft_report->submit_date == 0)?'--' : date('d-m-Y', $draft_report->submit_date);?></td>
						<?php 
							if(empty($draft_report->submit_date)) {
							$overdue = $this->CommonModel->get_days_interval($current_date,$draft_report->due_date);
							if($current_date > $draft_report->due_date && $overdue['D'] > 7){ ?>

								<td class="red-text">Overdue report <br>submission by <?php echo $overdue['YM'];?></td>
								<td><a class="upload-contract campaign-blue-btn" href="<?php echo BASE_URL ?>progress-report/<?php echo $draft_report->id ?>">CREATE REPORT</a>
								</td>

							<?php } else if($current_date < $draft_report->due_date && $overdue['D'] <= 3){ ?>

								<td class="blue-text">Upcoming report <br>submission by <?php echo $overdue['YM'];?>
								</td>
								<td><a class="upload-contract campaign-blue-btn" href="<?php echo BASE_URL ?>progress-report/<?php echo $draft_report->id ?>">CREATE REPORT</a>
								</td>

							<?php } else { ?>
								<td class="">--</td>
								<td><a class="upload-contract campaign-blue-btn <?php echo ($current_date < $draft_report->due_date) ? 'inactive-create':''; ?>" href="<?php echo ($current_date < $draft_report->due_date)?'javascript:void(0)':BASE_URL.'progress-report/'.$draft_report->id; ?>">CREATE REPORT</a></td>
						<?php } } else { ?>
							<td class="">--</td>
							<td><a class="upload-contract campaign-blue-btn inactive-create" href="javascript:void(0)">CREATE REPORT</a></td>
						<?php } ?>
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