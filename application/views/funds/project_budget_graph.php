<div class="funds-summary">
	<p class="second-heading">FUNDS	SUMMARY</p>
	<div class="form-group ">
		<label class="control-label grey-txt">TOTAL PROJECT BUDGET</label>
		<input class="form-control" type="text" value="₹ <?=number_format($totalProjectAmount, 0, '', ',')?>" placeholder="" disabled="disabled">
	</div><!-- col-sm-6 -->
</div><!-- funds-summary -->
<div class="graph-funds">
	<img style="width:100%;">
	<div id="project_budget_container" style="overflow: visible !important;"></div>
</div><!-- graph-funds -->


<script type="text/javascript">
	Highcharts.chart('project_budget_container', {

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
	            ['Total Committed Amount - ₹<?=number_format($totalCommitedAmount, 0, '', ',')?>', <?=number_format($totalCommitedAmount, 0, '', ',')?>, false],
	            ['Total Received Amount - ₹<?=number_format($totalRecivedAmount, 0, '', ',')?>', <?=number_format($totalRecivedAmount, 0, '', ',')?>, false],
	            ['Total Balance Amount - ₹<?=number_format($totalBalanceAmount, 0, '', ',')?>', <?=number_format($totalBalanceAmount, 0, '', ',')?>, false]
	        ],
	        showInLegend: false
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

	.highcharts-figure, .highcharts-data-table table {
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

	.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
	    padding: 0.5em;
	}

	.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
	    background: #f8f8f8;
	}

	.highcharts-data-table tr:hover {
	    background: #f1f7ff;
	}
</style>