$(document).ready(function () {
	var date = new Date();
	var today = new Date(date.getFullYear(), (date.getMonth() - 1), date.getDate());
	var end = new Date(date.getFullYear());

	// var get_date = new Date();
	// get_date.setDate(get_date.getDate()-6);
	
	$("#chequeDate").datepicker({
		autoclose: true,
		todayHighlight: true,
		format: "dd-mm-yyyy",
		startDate : today,
		//endDate: '+1y',
		toggleActive: true
    });
	
	var paymentTypeRadio = $('input:radio[name=paymentType]');
    if(paymentTypeRadio.is(':checked') === false) {
        // paymentTypeRadio.filter('[value=1]').attr('checked', true); //original code commented here
		paymentTypeRadio.filter('[value=2]').attr('checked', true);
		//getPaymentRightBlock(1) //original code commented
		getPaymentRightBlock(2)
		$('#terms-block').show();
		$('#payment-btn-block').show();
		$('#razor-pay').show();
		$('#other-pay').hide();
    }
	
	$("input[name='paymentType']").change(function() {
		
		if(this.checked) {
			var val = $(this).val();
			if( val == 1){
				//$('#onlinePaymentBlock').show();
				$('#NEFTPaymentBlock').hide();
				$('#chequePaymentBlock').hide();
				$('#razor-pay').show();
				$('#other-pay').hide();
			}else if( val == 2 ){
				$('#onlinePaymentBlock').hide();
				$('#NEFTPaymentBlock').show();
				$('#chequePaymentBlock').hide();
				$('#razor-pay').hide();
				$('#other-pay').show();
			}else if( val == 3 ){
				$('#onlinePaymentBlock').hide();
				$('#NEFTPaymentBlock').hide();
				$('#chequePaymentBlock').show();
				$('#razor-pay').hide();
				$('#other-pay').show();
			}
			
			$('#terms-block').show();
			$('#payment-btn-block').show();
			
			getPaymentRightBlock(val)
			/*$.ajax({
				type: 'POST',	
				url: BASE_URL+"payment/getPaymentRightBlock",
				data: {
					paymentType:val,
					//hiddenProjectId:hiddenProjectId,
					//installmentFundAmount:installmentFundAmount
				},
				success: function(data) {
					
					$(".right-side-bar-payment").html(data);
					
					
				}
			});*/
			
		}else{
			$('#onlinePaymentBlock').hide();
			$('#NEFTPaymentBlock').hide();
			$('#chequePaymentBlock').hide();
		}
	});
	
	$("#payment-form").validate({

		ignore: ':hidden:not("#payableAmount")',
    	rules: { 
			transRefNo: {
          		required: function() {
					return $('[name="paymentType"]:checked').val() == 2; 
				}, 
				number:true,
				//minlength:16,
				//maxlength:16,
          	},
			transDate: {
          		required: function() {
					return $('[name="paymentType"]:checked').val() == 2; 
				},
          	},
			// cvv: {
          		// required: function() {
					// return $('[name="paymentType"]:checked').val() == 1; 
				// },
				// number:true,
				// minlength:3,
				// maxlength:3,
          	// },
			bankName: {
          		required: function() {
					return $('[name="paymentType"]:checked').val() == 2; 
				},
          	},
			neftAmount: {
          		required: function() {
					return $('[name="paymentType"]:checked').val() == 2; 
				},
				neftAmount: '#payableAmount'
          	},
			accountNo: {
          		required: function() {
					return $('[name="paymentType"]:checked').val() == 3; 
				},
				number:true,
          	},
			ifscCode: {
          		required: function() {
					return $('[name="paymentType"]:checked').val() == 3; 
				}, 
				minlength:11,
				maxlength:11,
          	},
			payorName: {
          		required: function() {
					return $('[name="paymentType"]:checked').val() == 3; 
				},
          	},
			chequeDate: {
          		required: function() {
					return $('[name="paymentType"]:checked').val() == 3; 
				},
          	},
			chequeImage: {
          		required: function() {
					return $('[name="paymentType"]:checked').val() == 3; 
				},
				extension: "jpg|jpeg|png|pdf"
          	},
			chequeAmount: {
          		required: function() {
					return $('[name="paymentType"]:checked').val() == 3; 
				},
				chequeAmount: '#payableAmount'
          	},
    	},

    	submitHandler: function(form) { 
			 
			var fd = new FormData($('#payment-form')[0]);
			
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
			// beforeSend: function() {
				// var mini_loader = '<label class="attachment-loading" id="attachment-loading">Loading...</label>';
				// $('.white-bg').html((mini_loader));

			// },
			// complete: function() {
				// $('#attachment-loading').remove();
			// },			
            success: function(response) {
				//event.preventDefault();
            	console.log(response);
				if(response.flag == 1) {
					// $.toast({
						// heading: '',
						// text: response.msg,
						// showHideTransition: 'slide',
						// icon: 'success'
					// })
					
					var noHashURL = window.location.href.replace(/#.*$/, '');
				  
					// setTimeout(function() {
							// window.location.href =noHashURL+'#status';
							// location.reload();
					// });
					setTimeout(function() {
						window.location.href =response.redirect;
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
	
	$.validator.addMethod('neftAmount', function(value, element, param) {
		 return parseInt(value) == parseInt($(param).val());
	},'Paid amount has to be equal payable amount');
	
	$.validator.addMethod('chequeAmount', function(value, element, param) {
		 return parseInt(value) == parseInt($(param).val());
	},'Paid amount has to be equal payable amount');

});	

function getPaymentRightBlock(paymentType){
	//alert(1111111111)
	$.ajax({
		type: 'POST',	
		url: BASE_URL+"payment/getPaymentRightBlock",
		data: {
			paymentType:paymentType,
			//hiddenProjectId:hiddenProjectId,
			//installmentFundAmount:installmentFundAmount
		},
		success: function(data) {
			
			$(".right-side-bar-payment").html(data);
			
			
		}
	});
}

function readChequeImageURL(input) {
    $('#chequeImageBlock').addClass('upload-img');
    if (input.files && input.files[0]) {
        var file = input.files[0];
		var extension = file.name.split('.').pop().toLowerCase();
        
        console.log(file);
		console.log(extension);
        
        if ( /\.(jpe?g|png|pdf)$/i.test(file.name) ) {
            var reader = new FileReader();
            var pdfImage = BASE_URL+'skin/images/pdf-icon.png';

            reader.onload = function(e) {
                if(extension == 'pdf'){
                    $('#upload_img').html("<span class=\"upload-file\">" + "<img class=\"imageThumb\" src=\"" + pdfImage + "\" width=\"100\" hieght=\"100\" title=\"" + file.name + "\"/>" + "</span>");
                }else{
                    $('#upload_img').html("<span class=\"upload-file\">" + "<img class=\"imageThumb\" src=\"" + e.target.result + "\" width=\"100\" hieght=\"100\" title=\"" + file.name + "\"/>" + "</span>");
                }
            }

            reader.readAsDataURL(input.files[0]);
        }else{
            $.toast({
			heading: '',
			text: "Please select valid file type. The supported file types are .jpg , .png , .pdf",
			showHideTransition: 'slide',
			icon: 'error'
		  })
		   setTimeout(function() {}, 1000);
        }
    }
}


// code start for trans date
var date = new Date();
	$("#transDate").datepicker({
        format: "dd-mm-yyyy",
		endDate: new Date(date.setDate(date.getDate() - 0)),
		autoclose: true,
		todayHighlight: true,
		toggleActive: true,
		// startDate: '+0d',
    }).on('changeDate', function(e){
		var date = new Date(e.date);
		if (date) {
			
		var month=date.getMonth();
		month=(month + 1);
		var day=date.getDate();
		var newformattedDate = date.getFullYear() + "," + 
							month + "," + day;
		// $('#hiddenIncorporationDate').val(newformattedDate);
		//alert(newformattedDate);
		}
	});
// code ends for trans date
