<div class="funds-summary">
	<div class="form-group ">
		<label class="control-label grey-txt">FUNDS RECEIVED MONTHWISE</label>
	</div><!-- col-sm-6 -->
</div><!-- funds-summary -->
		
<div class="amount-received-graph">
	<img style="width:100%;">
	<div id="project_month_budget_container"></div>
</div><!-- graph-funds -->
<script type="text/javascript">
	Highcharts.chart('project_month_budget_container', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'FUNDS RECEIVED MONTHWISE'
	    },
	    subtitle: {
	        text: ''
	    },
	    xAxis: {
	        categories: [
	            'Jan',
	            'Feb',
	            'Mar',
	            'Apr',
	            'May',
	            'Jun',
	            'Jul',
	            'Aug',
	            'Sep',
	            'Oct',
	            'Nov',
	            'Dec'
	        ],
	        crosshair: true
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Amount Received'
	        }
	    },
	    plotOptions: {
	        column: {
	            pointPadding: 0.2,
	            borderWidth: 0
	        }
	    },
	    series: [{
	        data: [<?=$projectMonthwiseContribution?>]
	    }]
	});
</script>
