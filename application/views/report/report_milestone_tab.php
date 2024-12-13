<?php if(isset($proMilestoneData) && count($proMilestoneData) > 0){ ?>
<div class="form-group  fund-received-table">
	<p class="second-heading">MILESTONE SUMMARY</p>
	<div class="financial-table overflow-table wid-300  white-box" id="milestoneSummaryDiv">
		<?php
		//echo "<pre>";print_r($proMilestoneData);echo "</pre>";
		echo '<table cellpadding="0" cellspacing="0" align="center">';
			echo '<tbody>';
				echo '<tr>';
					echo '<th>MILESTONE</th>';
					echo '<th>START DATE</th>';
					echo '<th>END DATE</th>';
					echo '<th>AMOUNT ALLOTED</th>';
					echo '<th>STATUS</th>';
				echo '</tr>';
				if(isset($proMilestoneData) && count($proMilestoneData) > 0){
					foreach ($proMilestoneData as $key => $value) {
						$milstoneAmt=($progress_details->total_project_cost*$value->budget_percent)/100;
						echo '<tr>';
							echo '<td>'.$value->milestone.'</td>';
							echo '<td>'.date('d-m-Y', $value->start_date).'</td>';
							echo '<td>'.date('d-m-Y', $value->end_date).'</td>';
							echo '<td><i class="fa fa-inr"></i> '.number_format($milstoneAmt).' ('.$value->budget_percent.'%)</td>';
							echo '<td>';
								    echo '<select class="form-control">';
								           if($value->status=="Not Started"){
								                echo '<option selected>Not Started</option>';
								           }else{
								                echo '<option>Not Started</option>';
								           }
								           if($value->status=="Completed"){
								                echo '<option selected>Completed</option>';
								           }else{
								                echo '<option>Completed</option>';
								           }
								           if($value->status=="In-Progress"){
								                echo '<option selected>In-Progress</option>';
								           }else{
								                echo '<option>In-Progress</option>';
								           }
								    echo '</select>';	
							echo '</td>';
						echo '</tr>';
						echo '<input type="hidden" id="projects_funds_milestone_id'.$value->id.'" value="'.$value->id.'">';
						echo '<input type="hidden" id="milstoneAmt'.$value->id.'" value="'.$milstoneAmt.'">';
						echo '<tr>';
							echo '<th class="wid-300"></th>';
							echo '<th>ACTUAL START DATE</th>';
							echo '<th>ACTUAL END DATE</th>';
							echo '<th>ACTUAL AMOUNT SPENT</th>';
							echo '<th></th>';
						echo '</tr>';
                        echo '<tr>';
                        echo '<td class="full-table-new" colspan="5">';
                        echo '<div id="proReportMilestoneDiv'.$value->id.'">';
                        echo '<table cellpadding="0" cellspacing="0" align="center">';
			            echo '<tbody>';
						$proReportMilestoneData = $this->ReportModel->getReportMilestoneData($value->id);
						if(isset($proReportMilestoneData) && count($proReportMilestoneData) > 0){
					        foreach ($proReportMilestoneData as $val) {
					        	$amountSpentPercent=($val->actual_amount_spent/$milstoneAmt)*100;
					        	echo '<tr>';
									echo '<td></td>';
									echo '<td class="big-td">';
										    echo '<input type="text" class="form-control actual_start_date" value="'.date('d-m-Y', $val->actual_start_date).'" disabled>';
								    echo '</td>';
									echo '<td class="big-td">';
										    echo '<input type="text" class="form-control actual_end_date" value="'.date('d-m-Y', $val->actual_end_date).'" disabled>';
									echo '</td>';
									echo '<td class="big-td rupee-box">';
									        echo '<input type="text" class="form-control amount-number"  value="'.$val->actual_amount_spent.'" disabled>';
									echo '</td>';
									echo '<td class="big-td"  align="center" valign="top"><span class="remove-link" onclick="remove_milestone_spent('.$val->id.','.$value->id.')">Remove</span></td>';
								echo '</tr>';
								echo '<tr>';
									echo '<td></td>';
									echo '<td colspan="3" class="big-td add-descp-report">';
											echo '<label class="control-label">ADD DESCRIPTION </label>';
											echo '<textarea class="form-control" disabled>'.$val->milestone_description.'</textarea>';
									echo '</td>';
									echo '<td></td>';
								echo '</tr>';
					        }
					    }
					    echo '</tbody>';
		                echo '</table>';
					    echo '</div>';
					    echo '</td>';
					    echo '</tr>';
						echo '<tr>';
							echo '<td></td>';
							echo '<td>';
								echo '<div class="date-box">';
								    echo '<input type="text" class="form-control actual_start_date" placeholder="DD MM YYYY" id="actual_start_date'.$value->id.'" name="actual_start_date'.$value->id.'">';
								echo '</div>';
						    echo '</td>';
							echo '<td>';
								echo '<div class="date-box">';
								    echo '<input type="text" class="form-control actual_end_date" placeholder="DD MM YYYY" id="actual_end_date'.$value->id.'" name="actual_end_date'.$value->id.'">';
								echo '</div>';
							echo '</td>';
							echo '<td class="medium-td rupee-box">';
							        echo '<input type="text" class="form-control amount-number " name="actual_amount_spent'.$value->id.'" id="actual_amount_spent'.$value->id.'">';
							echo '</td>';
							echo '<td align="center" valign="top"></td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td></td>';
							echo '<td colspan="3" class="add-descp-report">';
								echo '<div class="add-descp-block form-group">';
									echo '<label class="control-label">ADD DESCRIPTION </label>';
									echo '<textarea class="form-control" placeholder="Enter decription here" name="milestone_description'.$value->id.'" id="milestone_description'.$value->id.'"></textarea>';
									echo '<div class="button-set"><button class="add-entry-button" type="button" onclick="add_milestone_spent('.$value->id.')">+ Add another</button></div>';
								echo '</div>';
							echo '</td>';
							echo '<td></td>';
						echo '</tr>';
						echo "<script type='text/javascript'>
							$(document).ready(function () {
								$('.actual_start_date').datepicker({
									format: 'dd-mm-yyyy',
									autoclose: true,
									todayHighlight: true,
									toggleActive: true,
									startDate: '+0d',
								}).on('changeDate', function(e){
									var date = new Date(e.date);
									if (date) {
										var month=date.getMonth();
										month=(month + 1);
										var day=date.getDate();
										var newformattedDate = date.getFullYear() + '-' + 
															month + '-' + day;	
										$('.actual_end_date').datepicker('setStartDate', new Date(date.setDate(date.getDate() + 1)));	
										formattedDate = ('0' + date.getDate()).slice(-2) + '/'
													+ ('0' + (date.getMonth()+1)).slice(-2) + '/'
													+ date.getFullYear();
						
										$('#actual_start_date".$value->id."').val(newformattedDate);
										
										$(this).valid(); 
										
										$('.bootstrap-select').removeClass('error');
										
										$('#actual_end_date".$value->id."').val('').datepicker('update');
										
										if (formattedDate=='NaN-aN-aN' &&  newformattedDate == 'NaN-aN-aN') {
											
											$('#actual_end_date".$value->id."').val('').datepicker('update');
											$('#actual_start_date".$value->id."').val('');
										}
											
									}
											
								});
								
								$('.actual_end_date').datepicker({
									format: 'dd-mm-yyyy',
									autoclose: true,
									todayHighlight: true,
									toggleActive: true,	
								}).on('changeDate', function(e){
									var date = new Date(e.date);											
									if (date) {										
										var month=date.getMonth();
										month=(month + 1);
										var day=date.getDate();
										var newformattedDate = date.getFullYear() + '-' + month + '-' + day;
										$('#actual_end_date".$value->id."').val(newformattedDate);
										
										$(this).valid(); 
									}
								
								});
							
							});
						</script>";

				    }
			    }
			echo '</tbody>';
		echo '</table>';
		?>
	</div>
</div><!-- fund-received-table -->
<?php } ?>
<script type="text/javascript">
	
	function add_milestone_spent(id){
		var form_data = new FormData();                   
	    form_data.append('project_id', $('#project_id').val());                   
	    form_data.append('project_report_id', $('#report_id').val());                 
	    form_data.append('projects_funds_milestone_id', $('#projects_funds_milestone_id'+id).val());
	    form_data.append('milstoneAmt', $('#milstoneAmt'+id).val());
	    form_data.append('actual_start_date', $('#actual_start_date'+id).val());
	    form_data.append('actual_end_date', $('#actual_end_date'+id).val());
	    form_data.append('actual_amount_spent', $('#actual_amount_spent'+id).val());
	    form_data.append('milestone_description', $('#milestone_description'+id).val());
	    $.ajax({
	        url: BASE_URL+"reports/add_milestone_spent",
			type: 'ajax',
            method: "POST",
			dataType: 'json',
			data: form_data,
			processData: false,
            contentType: false,
			success: function(response) {
				console.log(response);
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
				    $('#proReportMilestoneDiv'+response.projects_funds_milestone_id).html('');
                    $('#proReportMilestoneDiv'+response.projects_funds_milestone_id).html(response.milestoneSummaryHtml);
				}
			}
	    });
	}

	function remove_milestone_spent(id,projects_funds_milestone_id){
		if (confirm('Are you sure that want to delete this milestone amount spent?')){
			var project_id=$('#project_id').val();
			var project_report_id=$('#report_id').val();
			var milstoneAmt=$('#milstoneAmt'+projects_funds_milestone_id).val();
			$.ajax({
		        url: BASE_URL+"reports/remove_milestone_spent",
				type: 'ajax',
	            method: "POST",
				dataType: 'json',
				data: {id:id,project_id:project_id,project_report_id:project_report_id,projects_funds_milestone_id:projects_funds_milestone_id,milstoneAmt:milstoneAmt},
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
				        $('#proReportMilestoneDiv'+response.projects_funds_milestone_id).html('');
                        $('#proReportMilestoneDiv'+response.projects_funds_milestone_id).html(response.milestoneSummaryHtml);
					}
				}
		    });
	    }
	}
</script>