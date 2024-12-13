<!-- Modal - add-fund-recieved-details-popup -->
<div class="modal fade" id="add-fund-recieved-details-popup" role="dialog">
	<form id="contributorFundForm" name="contributorFundForm" method="POST">
    <input type="hidden" name="project_id" id="project_id" value="<?=$project_id?>">	
    <input type="hidden" name="total_project_amount" id="total_project_amount" value="<?=$totalProjectAmount;?>">
    <input type="hidden" name="project_type" id="project_type" value="<?=$projectData->project_type?>">	
    <input type="hidden" name="project_start_date" id="project_start_date" value="<?=$projectData->project_date_from?>">	
    <input type="hidden" name="project_end_date" id="project_end_date" value="<?=$projectData->project_date_to?>">
    
    <div class="modal-dialog add-fund-recieved-details-popup ">
	    <!-- Modal content-->
	    <div class="modal-content  ">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h2> Add Details</h2>
	        </div>
	        <div class="modal-body registration-flow-setup">
				<div class="col-sm-12">
					<div class="row">
						<div class="form-group col-sm-6">
							<label class="control-label grey-txt" for="funded_by">FUNDED BY</label>
							<input placeholder="Enter the contributor name" type="text" class="form-control" value="" id="funded_by" name="funded_by" list="ice-cream-flavors">
						</div>
						<div class="form-group col-sm-6">
							<label class="control-label grey-txt">SOURCE</label>
							<div class="select-box">
							<select id="source" name="source" placeholder="Select the source of funding" class="form-control">
								<option value="">Select the source of funding</option>
								<!-- <option value="truCSR">truCSR</option> -->
								<option value="Outside" selected>Outside</option>
							</select> 
							</div>
						</div>
						<div class="form-group col-sm-6">
							<label class="control-label grey-txt">START DATE</label>
							<div class="date-box">
							    <input type="text" class="form-control" placeholder="DD MM YYYY" value="" id="start_date" name="start_date" readonly="">
							</div>
						</div>
						<div class="form-group col-sm-6">
							<label class="control-label grey-txt">END DATE</label>
							<div class="date-box">
							    <input type="text" class="form-control" placeholder="DD MM YYYY" value="" id="end_date" name="end_date" readonly="">
							</div>
						</div>
						<div class="form-group col-sm-6">
							<label class="control-label grey-txt">AMOUNT COMMITTED</label>
							<div class="rupee-box">
							    <input type="text" placeholder="" class="form-control amount-number validate-number" value="" id="committed_amount" name="committed_amount">
								<!-- <input type="text" placeholder="" class="form-control amount-number" value="" id="committed_amount" > code written for remove the validation of commited amount-->
							</div>
						</div>
						<div class="form-group col-sm-6">
							<label class="control-label grey-txt">AMOUNT RECEIVED</label>
							<div class="rupee-box">
							    <input type="text" placeholder="" class="form-control amount-number validate-number" value="" id="received_amount" name="received_amount">
								<!-- <input type="text" placeholder="" class="form-control amount-number" value="" id="received_amount">  code writeen for remoe the received amount of received amount-->
							</div>
						</div>
					</div>
				</div>
		        <div class="modal-btn-sec">
					<div class="form-group col-sm-6">
						<button class="btn border-btn" data-dismiss="modal">CANCEL</button>
					</div>
					<div class="form-group col-sm-6">
						<button class="btn btn-primary" type="submit">SAVE</a></button>
					</div>
		        </div>
	        </div>
	    </div>
    </div>
    <datalist id="ice-cream-flavors">
    	<?php 
		    if(isset($allActiveContributor) && count($allActiveContributor)>0) { 
			    foreach($allActiveContributor as $value) {
			    	echo "<option value='".$value['company_name']."'>";
		        } 
		    }
		?>
	</datalist>

    </form>
</div>

<script>
	$(document).ready(function () {
	    $("#contributorFundForm").validate({
			ignore: ':hidden', 
			rules: {
				funded_by: {
				    required: true
				},
				source: {
				    required: true
				},
				start_date: {
				    required: true
				},
				end_date: {
				    required: true
				},
				committed_amount: {
					required: true,
					pattern: /^[0-9,]+$/,
					minlength: 3
					//minStrict: 99
				},
				received_amount: {
					required: true,
					pattern: /^[0-9,]+$/,
					minlength: 3
					//minStrict: 99
				},
			},
			messages: {
			   funded_by: 'Enter correct/valid details',
			   source: 'Enter correct/valid details',
			   start_date: 'Enter correct/valid details',
			   end_date: 'Enter correct/valid details',
			   committed_amount: 'Enter correct/valid details',
			   received_amount: 'Enter correct/valid details',
			},
			submitHandler: function(form) { 
				var funded_by = $("#funded_by").val();
				var source = $("#source").val();
				var start_date = $("#start_date").val();
				var end_date = $("#end_date").val();
				var committed_amount = $("#committed_amount").val();
				var received_amount = $("#received_amount").val();
				var project_id = $("#project_id").val();
				var project_type = $("#project_type").val();
				var project_start_date = $("#project_start_date").val();
				var project_end_date = $("#project_end_date").val();
				var total_project_amount = $("#total_project_amount").val();
				$.ajax({
					url: BASE_URL+"funds/add_contributor_fund",
					type: 'ajax',
	                method: "POST",
					dataType: 'json',
					data: { funded_by: funded_by, source: source, start_date: start_date, end_date: end_date, committed_amount: committed_amount, received_amount: received_amount, total_project_amount: total_project_amount, project_id:project_id, project_type:project_type, project_start_date:project_start_date, project_end_date:project_end_date},
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
						    setTimeout(function() { $('#projectFundForm').submit(); }, 1000);
						}
					}
				});	
			}
		});	

	
	 	$('.validate-char').on('keypress', function(key) {
	        //alert(111111)
			if((key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45 && key.charCode != 32 && key.charCode != 0)) {
				return false;	
			}
		});
		
		$(".validate-number").keydown(function(event) {


	        if (event.shiftKey == true) {
	            event.preventDefault();
	        }

	        if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

	        } else {
	            event.preventDefault();
	        }

	        if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
	            event.preventDefault();

	    });
		
		$('#start_date').datepicker({
			format: "dd-mm-yyyy",
			autoclose: true,
			todayHighlight: true,
			toggleActive: true,
		}).on('changeDate', function(e){
			var date = new Date(e.date);
			if (date) {
				
				var month=date.getMonth();
				month=(month + 1);
				var day=date.getDate();
				var newformattedDate = date.getFullYear() + "-" + 
									month + "-" + day;	
				$('#end_date').datepicker('setStartDate', new Date(date.setDate(date.getDate() + 1)));	
				formattedDate = ('0' + date.getDate()).slice(-2) + '/'
							+ ('0' + (date.getMonth()+1)).slice(-2) + '/'
							+ date.getFullYear();

				$('#hiddenStartDate').val(newformattedDate);
				
				//alert(formattedDate)			
				//alert(newformattedDate)			
							
				$(this).valid(); 
				
				$('.bootstrap-select').removeClass('error');
				
				//$('#goal_end_date').val('');
				$('#end_date').val('').datepicker('update');
				
				if (formattedDate=='NaN-aN-aN' &&  newformattedDate == 'NaN-aN-aN') {
					
					$('#end_date').val('').datepicker('update');
					$('#hiddenStartDate').val('');
				}
					
			}
					
		});
		
		$('#end_date').datepicker({
			format: "dd-mm-yyyy",
			autoclose: true,
			todayHighlight: true,
			toggleActive: true,	
		}).on('changeDate', function(e){
			var date = new Date(e.date);	
					
			if (date) {
				
				var month=date.getMonth();
				month=(month + 1);
				var day=date.getDate();
				var newformattedDate = date.getFullYear() + "-" + 
									month + "-" + day;
				$('#hiddenEndDate').val(newformattedDate);
				
				$(this).valid(); 
			}
		
		});
	
	});
</script>