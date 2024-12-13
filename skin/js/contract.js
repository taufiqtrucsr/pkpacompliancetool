$(document).ready(function () {
	$("#pro-fund-form").validate({

		ignore: ':hidden:not("#minDonationAmt")',
    	rules: { 
    		paymentType: {
          		required: true,
          	},
			fundAmount: {
          		required: true,
				fundAmount: '#minDonationAmt'
          	},
			installmentFundAmount: {
          		required: true,
				installmentFundAmount: '#minDonationAmt'
          	},
			milestoneFundAmount: {
          		required: true,
				milestoneFundAmount: '#minDonationAmt'
          	},
			installmentType: {
          		required: true,
          	},
    	},

    	submitHandler: function(form) { 
			 
			var fd = new FormData($('#pro-fund-form')[0]);
			
    		$.ajax({
            url: form.action,
            type: 'POST',
            method: form.method,
            dataType: 'json',
        	contentType: false,
        	processData: false,
            data:fd,
			beforeSend: function() {
				var spinner = $('#loader');
				$('#loader').show();
			},
			complete: function() {
				$('#loader').hide();
			},			
            success: function(response) {
				//event.preventDefault();
            	console.log(response);
				if(response.flag == 1) {
					$("#fund-step-3-btn").removeClass('btn-default').addClass('btn-primary');
					$("#fund-step-2-btn").removeClass('btn-primary').addClass('btn-default');
					$("#fund-step-1-btn").removeClass('btn-primary').addClass('btn-default');
					$("#fund-step-3-btn").removeAttr('disabled');
					$("#fund-step-2-btn").attr('disabled', 'disabled');
					$("#fund-step-2-btn").removeAttr('href');
					$("#fund-step-2").css("display", "none");
					$("#fund-step-1-btn").attr('disabled', 'disabled');
					$("#fund-step-1-btn").removeAttr('href');
					$("#fund-step-1").css("display", "none");
					$("#fund-step-3").css("display", "block");
					
					$("#contract_id").val(response.contractId);					
					$("#contract_unique_id").val(response.contractUniqueId);	
					
					var noHashURL = window.location.href.replace(/#.*$/, '');
				  
					setTimeout(function() {
							window.location.href =noHashURL+'#fund-step-3';
					});  
				}else{

                    $.toast({
                        heading: '',
                        text: response.msg,
                        showHideTransition: 'slide',
                        icon: 'error'
                      })
                      setTimeout(function() {                        
                      }, 1000);

                }
			}
			});
		}
	});

	
	$('#continueBtn').on('click', function() {
		if ($("#pro-fund-form").valid()) {
		
			// do something here when the form is valid
		
			$("#fund-step-1-btn").removeClass('btn-primary').addClass('btn-default');
			$("#fund-step-2-btn").removeClass('btn-default').addClass('btn-primary');
			$("#fund-step-1-btn").attr('disabled', 'disabled');
			$("#fund-step-1-btn").removeAttr('href');
			$("#fund-step-2-btn").removeAttr('disabled');
			$("#fund-step-2-btn").attr('href', '#fund-step-2');
			$("#fund-step-1").css("display", "none");
			$("#fund-step-2").css("display", "block");
			   
			var noHashURL = window.location.href.replace(/#.*$/, '');
		  
			setTimeout(function() {
					window.location.href =noHashURL+'#fund-step-2';
			});
		}
	});	
	
	// $('#generateContractBtn').on('click', function() {
		// if ($("#pro-fund-form-1").valid()) {
			// // do something here when the form is valid
			// hash = window.location.hash;
			// if(hash == '#fund-step-2'){
				 
			// }
		// }
	// });	
	
	$("input[name='paymentType']").change(function() {
		if(this.checked) {
			var val = $(this).val();
			if( val == 1){
				$('#oneTimePaymentBlock').show();
				$('#installmentPaymentBlock').hide();
				$('#milestoneBasedPaymentBlock').hide();
			}else if( val == 2 ){
				$('#oneTimePaymentBlock').hide();
				$('#installmentPaymentBlock').show();
				$('#milestoneBasedPaymentBlock').hide();
			}else if( val == 3 ){
				$('#oneTimePaymentBlock').hide();
				$('#installmentPaymentBlock').hide();
				$('#milestoneBasedPaymentBlock').show();
			}
		}else{
			$('#oneTimePaymentBlock').hide();
			$('#installmentPaymentBlock').hide();
			$('#milestoneBasedPaymentBlock').hide();
		}
	});
	
	$.validator.addMethod('fundAmount', function(value, element, param) {
		 return parseInt(value) >= parseInt($(param).val());
	},'fund amount has to be equal to or more than min. CSR amount');
	
	$.validator.addMethod('installmentFundAmount', function(value, element, param) {
		 return parseInt(value) >= parseInt($(param).val());
	},'fund amount has to be equal to or more than min. donation amount');
	
	$.validator.addMethod('milestoneFundAmount', function(value, element, param) {
		 return parseInt(value) >= parseInt($(param).val());
	},'fund amount has to be equal to or more than min. donation amount');
	
	$("#fundAmount").on("input", function(){
        // Print entered value in a div box

		//code for fund amount start here
		$fund_amt = $('#fundAmount').val();
		$total_bal_amt =$('#total_bal_funding_amt').val();
		if(parseInt($fund_amt) > parseInt($total_bal_amt)){
			$("#fund_raised_warning").css("display","block");
			// $("#fundAmount").addClass("error");
		}else{
			$("#fund_raised_warning").css("display","none");
			// $("#fundAmount").removeClass("error");
		}
		// code ends here for amount

        $("#amount").text($(this).val());
        $("#totalAmount").text($(this).val());

    });
	
	$("#installmentFundAmount").on("input", function(){
        // Print entered value in a div box
		
		var isChecked = $("input[name='installmentType']").is(':checked');
		if(isChecked){
			var installmentType = $("input[name='installmentType']:checked").val();
		}else{
			var installmentType = '';
		}
		
		var hiddenProjectId = $("#hiddenProjectId").val();
		var installmentFundAmount = $(this).val();
		//alert(installmentType)
		
		if(installmentType == '' || hiddenProjectId == '' || installmentFundAmount == ''){
			return false;
		}else{
			$.ajax({
				type: 'POST',	
				url: BASE_URL+"contract/calculateInstallment",
				data: {
					installmentType:installmentType,
					hiddenProjectId:hiddenProjectId,
					installmentFundAmount:installmentFundAmount
				},
				beforeSend: function() {
					var spinner = $('#loader');
					$('#loader').show();
				},
				complete: function() {
					$('#loader').hide();
				},
				success: function(data) {
					
					$("#summary-block").html(data);
					
					
				}
			});
		}
		
        $("#installmentAmount").text($(this).val());
        $("#installmentTotalAmount").text($(this).val());

    });
	
	$("#milestoneFundAmount").on("input", function(){
        // Print entered value in a div box
		var totalMilestone = $('#totalMilestone').val();
		var milestoneFundAmount = $('#milestoneFundAmount').val();
		
		for(i=1;i<=totalMilestone;i++){
			budgetPercent = $("#budgetPercent_"+i).val();
			calBudgetFund = (milestoneFundAmount/100)*budgetPercent;
			$("#budgetFund_"+i).val(calBudgetFund);
			
			budgetFund = $("#budgetFund_"+i).val();
			totalBudgetFund += parseInt(budgetFund);
		}
		// alert(totalBudgetFund)
		$("#totalBudgetFund").text($(this).val());
        $("#milestoneAmount").text($(this).val());
        $("#milestoneTotalAmount").text($(this).val());

    });
	
	$("input[name='installmentType']").change(function() {
		var installmentType = $(this).val();
		var hiddenProjectId = $("#hiddenProjectId").val();
		var installmentFundAmount = $("#installmentFundAmount").val();
		//alert(installmentFundAmount)
		
		if(installmentType == '' || hiddenProjectId == '' || installmentFundAmount == ''){
			return false;
		}else{
			$.ajax({
				type: 'POST',	
				url: BASE_URL+"contract/calculateInstallment",
				data: {
					installmentType:installmentType,
					hiddenProjectId:hiddenProjectId,
					installmentFundAmount:installmentFundAmount
				},
				beforeSend: function() {
					var spinner = $('#loader');
					$('#loader').show();
				},
				complete: function() {
					$('#loader').hide();
				},
				success: function(data) {
					
					$("#summary-block").html(data);
					
					
				}
			});
		}
	});
		
	//hash = window.location.hash; 
	
	$( "#trigger-contract-upload" ).click(function() {
		$('#contract_upload').click();
	});
	
	/*$('#contract_upload').change(function() {
		//alert(222222222222)
		id = $("#contract_id").val();					
		contract_unique_id = $("#contract_unique_id").val();
		
		if( id != '' && contract_unique_id != '' ){
			
			var fd = new FormData();
			var files = $('#contract_upload')[0].files[0];
  
			fd.append('contract_upload_file',files);
			fd.append('id',id);
			fd.append('contract_unique_id',contract_unique_id);
		
			$.ajax({
				type: 'POST',	
				url: BASE_URL+"dashboard/updateContract",
				dataType: 'json',
				processData: false,
				contentType: false,
				cache: false,
				data: fd,
				beforeSend: function() {
                    var spinner = $('#loader');
					$('#loader').show();
                },
                complete: function() {
                    $('#loader').hide();
                },	
				success: function(response) {
					
					if(response.flag == 1) {
						
						location.href=BASE_URL+"dashboard/contracts";
						//location.reload();
						
						//$('#uploadContractBlock').html('');
						//$('#contractDetailsBlock').show();

					}else{

						$.toast({
							heading: '',
							text: response.msg,
							showHideTransition: 'slide',
							icon: 'error'
						  })
						  setTimeout(function() {                        
						  }, 1000);

					}
				}
			});
		}
	});*/
	
	$( "#update-fund-form").validate({

		ignore: ":hidden",
		rules: {
			contract_upload: { 
				required: true,
				extension: "pdf"
			},
			board_upload: {
				required: true,
				extension: "jpg|jpeg|pdf|png"
			},
		},
		submitHandler: function(form) { 
			
			id = $("#contract_id").val();					
			contract_unique_id = $("#contract_unique_id").val();
		
			var fd = new FormData();
			var files = $('#contract_upload')[0].files[0];
			var files2 = $('#board_upload')[0].files[0];
  
			fd.append('contract_upload_file',files);
			fd.append('board_upload_file',files2);
			fd.append('id',id);
			fd.append('contract_unique_id',contract_unique_id);

			$.ajax({
			url: form.action,
			type: 'POST',
			method: form.method,
			dataType: 'json',
			contentType: false,
			processData: false,
			data:fd,
			beforeSend: function() {
				var spinner = $('#loader');
				$('#loader').show();
			},
			complete: function() {
				$('#loader').hide();
			},					
			success: function(response) {
				console.log(response);              
			  
				if(response.flag == 1) {
						
					location.href=BASE_URL+"dashboard/contracts";
					//location.reload();
					
					//$('#uploadContractBlock').html('');
					//$('#contractDetailsBlock').show();

				}else{

					$.toast({
						heading: '',
						text: response.msg,
						showHideTransition: 'slide',
						icon: 'error'
					  })
					  setTimeout(function() {                        
					  }, 1000);

				}
			}
			
			});	
		}
	});	
});

function downloadContractFile()
{
	id = $("#contract_id").val();					
	contract_unique_id = $("#contract_unique_id").val();
	
	if(id!='' && contract_unique_id!=''){
		
		$('#uploadContractBlock').show();
		$('#downloadContractBlock').hide();
		$('#truCSRModalView').modal();
		$.ajax({
			type : "POST",
			url  : BASE_URL + "dashboard/viewContractFile",
			dataType : "JSON",
			data : {id:id,contract_unique_id:contract_unique_id},
			success: function(response){
				// console.log(response);
				if (response.flag == '1') {
					src = response.url;
					$('#iframe').attr("src", src);
					//console.log(response.data);
				}
			},
			error:function(response){
				console.log(response);
			}
		});		
		//location.href = BASE_URL+'dashboard/downloadContractFile/'+id+'/'+contract_unique_id;
	}
}