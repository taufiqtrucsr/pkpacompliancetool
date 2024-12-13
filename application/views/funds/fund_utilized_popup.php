<form id="fundUtilizedForm" name="fundUtilizedForm" method="post" enctype="multipart/form-data">
	<input type="hidden" name="project_contributor_fund_id" id="project_contributor_fund_id" value="<?=$projectContributorFundDetails['id']?>">	
	<input type="hidden" name="project_id" id="project_id" value="<?=$projectContributorFundDetails['project_id']?>">	
	<input type="hidden" name="type" id="type" value="utilized">
	<!-- Modal - add-the-amount-utilized-popup -->
	<div class="modal fade" id="add-the-amount-utilized-popup" role="dialog">
	    <div class="modal-dialog add-fund-recieved-details-popup ">
	        <!-- Modal content-->
	        <div class="modal-content  ">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h2> Add the amount utilized</h2>
		        </div>
		        <div class="modal-body registration-flow-setup add-amt-utilized-content">
					<div class="col-sm-12"><div class="col-sm-6"><p class="second-heading">FUNDS UTILIZED</p></div></div>
					<div class="col-sm-12">
						<div class="row">
							<div class="form-group col-sm-6 amt-recvd" >
								<label class="control-label grey-txt">DESCRIPTION</label>
								<input type="text" placeholder="" class="form-control  " value="" id="amount_description" name="amount_description">
							</div>
							<div class="form-group col-sm-4 " >
								<label class="control-label grey-txt">AMOUNT SPENT</label>
								<div class="rupee-box">
								    <input type="text" placeholder="" class="form-control amount-number validate-number" value="" id="amount" name="amount">
								</div>
							</div>
							<div class="form-group col-sm-2 " >
								<label class="control-label grey-txt">DOCUMENT</label>
								<span class="upload-utilized-doc"><input type="file" class="upload-receipt" placeholder="" id="documentFile" name="documentFile"></span>
							</div>
						</div>
					</div>
			        <div class="modal-btn-sec">
						<div class="form-group col-sm-6">
							<button class="btn border-btn" data-dismiss="modal">CANCEL</button>
						</div>
						<div class="form-group col-sm-6">
							<button class="btn btn-primary" type="submit">SAVE</button>
						</div>
			        </div>
		        </div>
	        </div>
	    </div>
	</div>
</form>
<script>
	$(document).ready(function () {
	    $("#fundUtilizedForm").validate({
			ignore: ':hidden', 
			rules: {
				amount_description: {
					required: true
				},
				amount: {
					required: true,
					pattern: /^[0-9,]+$/,
					minlength: 3
					//minStrict: 99
				},
				document: {
					required: true
				},
				
			},
			messages: {
			   amount_description: 'Enter correct/valid details',
			   amount: 'Enter correct/valid details',
			   document: 'Enter correct/valid details',
			},
			submitHandler: function(form) { 
				var project_contributor_fund_id = $("#project_contributor_fund_id").val();
				var type = $("#type").val();
				var amount = $("#amount").val();
				var document_file = $("#document").val();
				var amount_description = $("#amount_description").val();
				var project_id = $("#project_id").val();   
                var form_data = new FormData($("#fundUtilizedForm")[0]);
				$.ajax({
					url: BASE_URL+"funds/add_contributor_fund_utilized",
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
						    window.location.href =response.redirect;
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
	});
</script>

