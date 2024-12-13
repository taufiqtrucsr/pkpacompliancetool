<?php
		defined('BASEPATH') or exit('No direct script access allowed');
		error_reporting(0);
		?>
		<?php $this->load->view('common/head_common'); ?>
		<link rel="stylesheet" media="all" href="<?php echo SKIN_URL; ?>css/csrcompliance.css" />

		<body class="full-page">
		<?php $this->load->view('common/header'); ?>
			<div class="container">
				<div class="col-md-12" id="contractDetailsBlock" style="background: transparent;">
				   <div class="reportcreate">
				   <h2>Progress Report<br>	January  to March 2022</h2>
				   <div class="thruout_year" style="margin-top: 0;">
				   <label class="control-label" style="color:#000;">Project Title:</label>
				   <p><label>Name of the Project </label></p>
				   <div class="pro_rep">
				   <label class="control-label" style="color:#000;">Background Information:</label>
				   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
				   </div>
				   <div class="pro_rep">
				   <label class="control-label" style="color:#000;">Problem Statement:</label>
				   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
				   </div>
				   <div class="pro_rep">
				   <label class="control-label" style="color:#000;">Project Goals & Objectives:</label>
				   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
				   <ul>
				   <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</li>
				   <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s </li>
				   </ul>
				   </div>
				   <div class="pro_rep">
				   <div class="row">
				   <div class="col-md-4">
				   <div class="boxes">
				   <p>Project <br> Duration </p>
				   <span>12 Months</span>
				   </div>
				   </div>
				   <div class="col-md-4">
				   <div class="boxes">
				   <p>Sector <br> Focused</p>
				   <span>Health, Education, Women</span>
				   </div>
				   </div>
				   <div class="col-md-4">
				   <div class="boxes">
				   <p>Project <br> Location</p>
				   <span>12 Months</span>
				   </div>
				   </div>
				   <div class="col-md-4">
				   <div class="boxes">
				   <p>Beneficiary <br> Type</p>
				   <span>Children, Women</span>
				   </div>
				   </div>
				   <div class="col-md-4">
				   <div class="boxes">
				   <p>Beneficiaries <br> Benefited</p>
				   <span>500 (300 Children, 200 Women)</span>
				   </div>
				   </div>
				   <div class="col-md-4">
				   <div class="boxes">
				   <p>Project <br> Budget</p>
				   <span>₹10,00,000</span>
				   </div>
				   </div>
				   </div>
				   </div>
				   </div>
				   <div class="thruout_year">
				   <label class="control-label" style="color:#000;">Activity Overview:</label>
				   <p><label>Project progress overview during the reporting period.</label></p>
				   <div class="pro_rep_pro">
				   <div class="barWrapper">
		 <!--span class="progressText"><p>Completed : 90% </p> <p>Pending : 10%</p></span-->
					<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100" >   
						<span class="popOver" data-toggle="tooltip" data-placement="top" title="42%"> 42% </span>     
					</div>
					</div>
					<p>03 Activites of 07 is completed</p>
				   </div>
				   </div>
				   <table class="table" style="border:none;margin-bottom:30px">
				   <thead>
            <tr class="pro">
			    <th></th>
				<th></th>
                <th colspan="2" style="background-color:#F5F7FC">
                   Proposed
                </th>
                <th colspan="2" style="background-color:#7082A999; color:#fff">
                   Actual
                </th>
				<th></th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th scope="col" style=" width: 100px; ">
                    Sr. No
                </th>
                <th scope="col">
                  Activity Description
                </th>
                <th scope="col">
                   Start Date
                </th>
                <th scope="col">
                  End Date
                </th>
				 <th scope="col">
                   Start Date
                </th>
                <th scope="col">
                  End Date
                </th>
				 <th scope="col">
                  Status
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>01</td>
                <td>Activity Description 01</td>
                <td>01 Jan 2022</td>
                <td>01 Feb 2022</td>
				<td>01 Jan 2022</td>
				<td>01 Feb 2022</td>
				<td>Completed</td>
            </tr>
			<tr>
                <td>02</td>
                <td>Activity Description 02</td>
                <td>01 Feb 2022</td>
                <td>01 Mar 2022</td>
				<td>01 Feb 2022</td>
                <td>01 Mar 2022</td>
				<td>Completed</td>
            </tr>
			<tr>
                <td>03</td>
                <td>Activity Description 03</td>
                <td>01 Feb 2022</td>
                <td>01 Mar 2022</td>
				<td>01 Feb 2022</td>
                <td>-</td>
				<td>In-Progress</td>
            </tr>
			<tr>
                <td>04</td>
                <td>Activity Description 04</td>
                <td>01 Feb 2022</td>
                <td>01 Mar 2022</td>
				<td>-</td>
                <td>-</td>
				<td>Not Started</td>
            </tr>
			<tr>
                <td>05</td>
                <td>Activity Description 05</td>
                <td>01 Feb 2022</td>
                <td>01 Mar 2022</td>
				<td>-</td>
                <td>-</td>
				<td>Not Started</td>
            </tr>
			<tr>
                <td>06</td>
                <td>Activity Description 06</td>
                <td>01 Feb 2022</td>
                <td>01 Mar 2022</td>
				<td>-</td>
                <td>-</td>
				<td>Not Started</td>
            </tr>
			<tr>
                <td>07</td>
                <td>Activity Description 07</td>
                <td>01 Feb 2022</td>
                <td>01 Mar 2022</td>
				<td>-</td>
                <td>-</td>
				<td>Not Started</td>
            </tr>
        </tbody>
    </table>
	<div class="pro_rep completed_act">
	<label class="control-label" style="color:#000;">Details of Completed Activities :</label>
	<p>Activity progress along with short description, actual dates, budget expensed towards the activity, Beneficiaries during the said reporting period.</p>
	<div class="Activity">
	<h2>Activity</h2>
	<hr style="margin:10px 0">
	<div class="row">
	<div class="col-md-4">
	<h3>Resarch work to engage with the under privilaged students.</h3>
	</div>
	<div class="col-md-4">
	<h3>Activity Description</h3>
	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
	</div>
	<div class="col-md-4">
	<h3>Image</h3>
	<img src="<?php echo SKIN_URL; ?>/images/actvit.png">
	</div>
	</div>
	<hr>
	<div class="row">
	<div class="col-md-4">
	<h3>Resarch work to engage with the under privilaged students.</h3>
	</div>
	<div class="col-md-4">
	<h3>Activity Description</h3>
	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
	</div>
	<div class="col-md-4">
	<h3>Image</h3>
	<img src="<?php echo SKIN_URL; ?>/images/actvit.png">
	</div>
	</div>
	<hr>
	</div>
	</div>
	<div class="pro_rep evalu_plan">
	<label class="control-label" style="color:#000;float: none;">Monitoring & Evaluation Plan :</label>
	<table class="table" style="margin-top:30px">
		
        <thead>
            <tr>
                <th scope="col" style=" width: 100px; ">
                    Sr. No
                </th>
                <th scope="col">
                  Activity
                </th>
                <th scope="col">
                   What to Monitor
                </th>
                <th scope="col">
                  How to Mointor
                </th>
				 <th scope="col">
                   Status
                </th>       
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>01</td>
                <td>Teacher Training</td>
                <td>
				<ol>
				<li>Whether teacher training conducted as per schedule.</li>
                <li>No. of teachers attended.</li>
                <li>Whether expected results achieved.</li>
				</ol>
				</td>
				<td>
				<ol>
	            <li>Whether a training schedule exist & copy of the same.</li>
                <li>Workshop attendance sheet.</li>
                <li>Workshop report.</li>
				</ol>
				</td>
				<td>Yes</td>
            </tr>
        </tbody>
    </table>
	</div>
				   </div>
				   <div class="thruout_year">
				   <label class="control-label" style="color:#000;">Funds Received</label>
				   <p><label>Details of funds received through corporates under CSR programee, crowdfunding, external CSR funds added by you till now are listed below.</label></p>
					<script src="https://code.highcharts.com/highcharts.js"></script>
					<script src="https://code.highcharts.com/modules/exporting.js"></script>
					<script src="https://code.highcharts.com/modules/export-data.js"></script>
					<script src="https://code.highcharts.com/modules/accessibility.js"></script>
					<figure class="highcharts-figure">
						<div id="container"></div>
					</figure>
					<div class="pro_rep evalu_plan">
					<label class="control-label" style="color:#000;float: none;">Funds Received (CSR & Crowdfundding)</label>
					<table class="table" style="margin-top:10px">
						
						<thead>
							<tr>
								<th scope="col">
									funded by
								</th>
								<th scope="col">
								  Source
								</th>
								<th scope="col">
								   COMMITtED (₹)
								</th>
								<th scope="col">
								   RECEiVED (₹)
								</th>
								 <th scope="col">
								   BALANCE (₹)
								</th>       
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Bajaj</td>
								<td>trucsr</td>
								<td>2,40,00,000</td>
								<td>1,20,00,000</td>
								<td>1,20,00,000</td>
							</tr>
							<tr>
								<td>Godrej and Boyce</td>
								<td>trucsr</td>
								<td>2,40,00,000</td>
								<td>1,20,00,000</td>
								<td>1,20,00,000</td>
							</tr>
							<tr>
								<td>Unilever</td>
								<td>trucsr</td>
								<td>2,40,00,000</td>
								<td>1,20,00,000</td>
								<td>1,20,00,000</td>
							</tr>
							<tr>
								<td>Individual Donors</td>
								<td>Crowdfunding</td>
								<td>-</td>
								<td>12,00,000</td>
								<td>-</td>
							</tr>
						</tbody>
					</table>
					</div>
					<div class="pro_rep total">
				   <div class="row">
				   <div class="col-md-4">
				   <div class="boxes_2">
				   <label class="control-label" style="color:#000;">Total CSR Committed</label>
				   <input type="text" class="form-control" name="CSR Committed" id="CSRCommitted">
				   </div>
				   </div>
				   <div class="col-md-4">
				   <div class="boxes_2">
				   <label class="control-label" style="color:#000;">Total CSR Received</label>
				   <input type="text" class="form-control" name="CSR Received" id="CSRReceived">
				   </div>
				   </div>
				   <div class="col-md-4">
				   <div class="boxes_2">
				   <label class="control-label" style="color:#000;">Total CSR Balance</label>
				   <input type="text" class="form-control" name="CSR Balance" id="CSRBalance">
				   </div>
				   </div>
				   <div class="col-md-4">
				   <div class="boxes_2">
				   <label class="control-label" style="color:#000;">Crowdfunded</label>
				   <input type="text" class="form-control" name="Crowdfunded" id="Crowdfunded">
				   </div>
				   </div>
				   <div class="col-md-4">
				   <div class="boxes_2">
				   <label class="control-label" style="color:#000;">Total Funds Received</label>
				   <input type="text" class="form-control" name="Funds Received" id="FundsReceived">
				   </div>
				   </div>
				   </div>
				   </div>
					</div>
					
					 <div class="thruout_year">
				   <label class="control-label" style="color:#000;">Capital Assetss Created :</label>
				   <p><label>Please provide details of Capital Assets proposed to be created as part of the project :</label></p>
				   <table class="table" style="margin-top:30px">
		
        <thead>
            <tr>
                <th scope="col" style=" width: 100px; ">
                    Sr. No.
                </th>
                <th scope="col">
                  Short particulars of property or asset(s)
                </th>
                <th scope="col">
                   Pin code of property/ asset
                </th>
                <th scope="col">
                  Budget(₹)
                </th>
				 <th scope="col">
                   Created
                </th>  
				<th scope="col">
					 Date of Creation
					</th>  
				<th scope="col">
					  Amount of CSR spent(₹)
					</th>  
				<th scope="col">
					  CSR Registration Number
					</th> 
				<th scope="col">
					  Name
					</th>
				<th scope="col">
					  Registered address
					</th>					
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>01</td>
                <td>Foundation of school building</td>
                <td>411001</td>
				<td>1,00,00,000</td>
				<td>Created</td>
				<td>11/11/2022</td>
				<td>95,00,000</td>
				<td>CSR12345678</td>
				<td>truCSR Foundation</td>
				<td>Nariman Point, Mumbai</td>
            </tr>
        </tbody>
    </table>
				   </div>
				   
				   <div class="thruout_year utilisation">
				   <label class="control-label" style="color:#000;">Funds Utilisation</label>
				   <p><label>Details of how fund utilisation has taken place over the reporting period, Upload Utilisation Certificate certified 
by empanelled CA, <a href="#">listed here.</a></label></p>
				   <table class="table" style="margin-top:30px">
		
        <thead>
            <tr>
                <th scope="col" style=" width: 100px; ">
                    Sr. No
                </th>
                <th scope="col">
                  Expense Description as per Budget
                </th>
                <th scope="col">
                   Budgeted Amount (₹)
                </th>
                <th scope="col">
                  Amount Spent till Last Month (₹)
                </th>
				 <th scope="col">
                  Spent During the Month (₹) *
                </th>  
				<th scope="col">
					Total Cumulative Spend
				</th>  					
            </tr>
        </thead>
        <tbody>
		   <tr>
			<th colspan="6" style="text-align:left;">
					Project Activity Expense
				</th> 
			</tr>
            <tr>
                <td>01</td>
                <td>Teacher Training</td>
                <td>1,00,000</td>
				<td>20,000</td>
				<td>10,000</td>
				<td>30,000</td>
            </tr>
			<tr>
                <td>01</td>
                <td>School Building Foundation (Capital Assets)</td>
                <td>1,00,00,000</td>
				<td>91,00,000</td>
				<td>1,00,000</td>
				<td>92,00,000</td>
            </tr>
			<th colspan="6" style="text-align:left;">
					Project Admin  Expense
				</th> 
			</tr>
            <tr>
                <td>01</td>
                <td>Travel expense</td>
                <td>25,000</td>
				<td>15,000</td>
				<td>5,000</td>
				<td>20,000</td>
            </tr>
			<tr>
                <td colspan="2" style="text-align:left;">Total</td>
                <td>1,01,25,000</td>
                <td>91,35,000</td>
				<td>1,15,000</td>
				<td>92,50,000</td>
            </tr>
        </tbody>
    </table>
	<a href="#" class="utili_cert">View Utilisation Certificate</a>
	
	 <div class="pro_rep total">
				   <div class="row">
				   <div class="col-md-4">
				   <div class="boxes_2">
				   <label class="control-label" style="color:#000;">Total Amount Received</label>
				   <input type="text" class="form-control" name="Received" id="Received">
				   </div>
				   </div>
				   <div class="col-md-4">
				   <div class="boxes_2">
				   <label class="control-label" style="color:#000;">Total Amount Spent</label>
				   <input type="text" class="form-control" name="Spent" id="Spent">
				   </div>
				   </div>
				   <div class="col-md-4">
				   <div class="boxes_2">
				   <label class="control-label" style="color:#000;">Total UnSpent Balance</label>
				   <input type="text" class="form-control" name="UnSpent" id="UnSpent">
				   </div>
				   </div>
				   </div>
				   </div>
				   </div>
				  <div class="additional_information">
					<h2>Additional Information</h2>
					<p class="case_stu">Case Study</p>
					<p style=" margin-bottom: 15px; ">A detailed case study realted to activities completed during selected reporting period.</p>
					<div class="write_report write_add_info">
						<p><label>Case Study Title *</label></p>
						<p style=" margin-bottom: 15px; ">
							Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard 
						</p>
						<p><label>Case Study Description</label></p>
						<p style=" margin-bottom: 15px; ">
							Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
<br><br>
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
						</p>

						<div class="conclussion">
							<p><label>Conclusion</label></p>
							<p style=" margin-bottom: 15px; ">
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
							</p>

						</div>			
							<div class="add_images">
								<p><label>Case Study Images </label></p>
								<div class="upload_imgs">
									<img src="<?php echo SKIN_URL; ?>/images/actvit.png">
								</div>
								<div id="preview-container"></div>
							</div>
						</div>

				</div>
				   </div>
				   <div class="save_btns">
		<div class="col-sm-12">
			<div class="wrap_flex_btn">
				<div class="form-group">
					<a href="#" class="cancelBtn">Back</a>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary saveBtn">Download</button>
				</div>
			</div>
		</div>
	</div>
				</div>
			</div>
			<link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/jquery.multiselect.css">
            <script>
const colors = Highcharts.getOptions().colors.map((c, i) =>
    Highcharts.color(Highcharts.getOptions().colors[0])
        .brighten((i - 3) / 7)
        .get()
);

// Build the chart
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            colors,
            borderRadius: 5,
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                distance: -50,
                filter: {
                    property: 'percentage',
                    operator: '>',
                    value: 4
                }
            }
        }
    },
    series: [{
        name: 'Share',
        data: [
            { name: 'Balance Amount', y: 60 },
            { name: 'Received', y: 40 },
            
        ]
    }]
});
</script>
			<script>
			$(function () { 
			$('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip('show');
			}); 
			$(".progress-bar").each(function(){
			each_bar_width = $(this).attr('aria-valuenow');
			$(this).width(each_bar_width + '%');
			});
			</script>
			<script src="<?php echo SKIN_URL; ?>js/jquery.multiselect.js"></script>
			<script type="text/javascript" src="<?php echo SKIN_URL . 'js/discover.js?v=' . JS_CSC_V; ?>"></script>
			<script type="text/javascript" src="<?php echo SKIN_URL . 'js/implementor.js?v=' . JS_CSC_V; ?>"></script>
			<script type="text/javascript" src="<?php echo SKIN_URL . 'js/compliance.js?v=' . JS_CSC_V; ?>"></script>
			<script type="text/javascript" src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
			<?php $this->load->view('common/footer_js'); ?>
		</body>