<div class="form-group  funded-table">
	<p class="second-heading">FUNDS	RECEIVED</p>
	<div class="blue-table overflow-table">
		<table cellpadding="0" cellspacing="0" align="center">
			<tbody>
				<tr>
					<th>Funded by</th>
					<th>Source</th>
					<th>COMMITTED (<i class="fa fa-inr"></i>)</th>
					<th>RECEIVED  (<i class="fa fa-inr"></i>)</th>
					<th>BALANCE  (<i class="fa fa-inr"></i>)<span class="info-tip"><a data-toggle="tooltip" title="" data-original-title="Balance"><img src="<?=SKIN_URL?>/images/info_grey.png"></a></span></th>
					<th>ACTION</th>
				</tr>
				<?php include('add_fund_recieve.php'); ?>
			</tbody>
		</table>
	</div>
	<div class="add-another-fund-box">
		<div class="col-sm-3">&nbsp;<!--button class="add-entry-button" type="button" id="" onclick="" disabled>+ Add another entry</button--></div>
		<div class="col-sm-3"><span>TOTAL AMOUNT COMMITTED</span> <input class="form-control" type="text" value="₹ <?=number_format($totalCommitedAmount, 0, '', ',')?>" placeholder="--" disabled="disabled"></div>
		<div class="col-sm-3"><span>TOTAL AMOUNT RECEIVED</span> <input class="form-control" type="text" value="₹ <?=number_format($totalRecivedAmount, 0, '', ',')?>"  placeholder="--" disabled="disabled"></div>
		<div class="col-sm-3"><span>TOTAL BALANCE AMOUNT </span> <input class="form-control" type="text" value="₹ <?=number_format($totalBalanceAmount, 0, '', ',')?>"  placeholder="--" disabled="disabled"></div>
	</div>
</div><!-- funded-table -->

<div id="" class="funding-total-funds">
	<div class="form-group col-sm-4 ">
	    <label class="control-label">Total Funds Required</label>
		<p class="normal-font black-font"><i class="fa fa-inr"></i><?=number_format($totalProjectAmount, 0, '', ',')?></p>
	</div>
	<div class="form-group col-sm-4 ">
	    <label class="control-label">Total Funds Committed</label>
		<p class="normal-font black-font"><i class="fa fa-inr"></i><?=number_format($totalCommitedAmount, 0, '', ',')?></p>
	</div>
	<div class="form-group col-sm-4 ">
	    <label class="control-label">Total Funds Received</label>
		<p class="normal-font black-font"><i class="fa fa-inr"></i><?=number_format($totalRecivedAmount, 0, '', ',')?></p>
	</div>
	<div class="form-group col-sm-4 ">
	    <label class="control-label">Funds Received This Month</label>
		<p class="normal-font black-font"><i class="fa fa-inr"></i><?=number_format($projecCurrenttMonthContribution, 0, '', ',')?></p>
	</div>
	<div class="form-group col-sm-4 ">
	    <label class="control-label">Total Balance Amount <span class="info-tip"><a data-toggle="tooltip" title="Total balance amount" data-original-title="Balance"><img src="<?=SKIN_URL?>/images/info_grey.png"></a></span> </label>
		<p class="normal-font black-font"><i class="fa fa-inr"></i><?=number_format($totalBalanceAmount, 0, '', ',')?></p>
	</div>	
</div><!-- funding-total-funds -->
<script type="text/javascript" src="<?php echo SKIN_URL; ?>js/highcharts.js?v=<?php echo JS_CSC_V; ?>"></script>

<?php include('project_budget_graph.php'); ?>
<?php include('project_budget_monthwise_graph.php'); ?>
<?php include('contributor_list_tab.php');?>