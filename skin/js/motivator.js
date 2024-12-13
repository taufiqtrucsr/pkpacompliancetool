$(document).ready(function () {
	 
	 		// $('select[multiple]').multiselect();
	 		// jQuery('#denials').multiselect( )
		// 	jQuery('#campaign_projects').multiselect({
		// 	texts    : {
		//         placeholder: 'Select the project/s that match your purpose',
		//     }
		// });


		// $('#ms-list-2').click(function(){
		// 	$('#campaign_projects').valid();
			
		// });
		// $('#campaign_projects').multiselect({
		// 	texts    : {
		//         placeholder: 'Select the project/s that match your purpose',
		//     }
		// });

		// $('#ms-list-1').click(function(){
		// 	isValid = $('#campaign_projects').valid();
		// 	if(!(isValid)){
		// 		$(this).find('button').addClass("error");
		// 	}else{
		// 		$(this).find('button').removeClass("error");
		// 	}
			
		// });

		// $('#ms-list-2').click(function(){
		// 	$('#campaign_projects').valid();
			
		// });
	$("#campaign_projects").multiselect({
	    //search: true,
	    //selectAll: true
	    texts: {
	        placeholder: 'Select the project/s that match your purpose',
	    },
	});
	$("#campaignSector").multiselect({
	    //search: true,
	    //selectAll: true
	    texts: {
	      placeholder: "Select Sector/s",
	    },
	});
	$("#campaignState").multiselect({
	    //search: true,
	    //selectAll: true
	    texts: {
	      placeholder: "Select State/s",
	    },
	});
	$("#campaignDistrict").multiselect({
	    //search: true,
	    //selectAll: true
	    texts: {
	      placeholder: "Select District/s",
	    },
	});

	$("#motivator-form-1").validate({
			// ignore: ':hidden:not("#campaign_projects")',
			ignore: ':hidden',
	    	rules: { 	    		
				campaignSector: {
		          required: true,        
		        },
				campaignState: {
		          required: true,        
		        },
				campaignDistrict: {
		          required: true,        
		        },
				"campaign_projects[]": {
		          required: true,
					minlength: 1
		        },
				// RequiredAmt: {
		  //         required: true, 
				//   RequiredAmt: '#campaignFundingAmount',		  
		  //       },
				campaignFundingAmount: {
		          required: true, 
				  campaignFundingAmount: '#campaignThresholdAmount',
				  // campaignFundingAmountLessThanRequiredAmt: ' #RequiredAmt'		  
		        },
				campaignThresholdAmount: {
		          required: true, 
				  campaignThresholdAmount: '#campaignFundingAmount'			  
		        },
				campaign_name: {
	          		required: true,
					  minlength:5,
					maxlength: 250,
					wordCount: 250		  
		        },
				campaign_about: {
			        required: true, 
					  minlength:5,
				 	maxlength: 500,
					wordCount: 500		  
		        },
				campaignDateFrom: {
		          required: true		  
		        },
				campaignDateTo: {
		          required: true		  
		        },
				Campaign_continue: {
		          required: false		  
		        }
	    	},
			onfocusout: function(element){ return false; },
	    	submitHandler: function(form) { 		

	    		var fd = new FormData($('#motivator-form-1')[0]);
				
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
	            	console.log('success response#motivator-form-1');            
	              
	                if(response.flag == 1) {
	                   $("#campaign-step-1-btn").removeClass('btn-primary').addClass('btn-default');
	                   $("#campaign-step-2-btn").removeClass('btn-default').addClass('btn-primary');
	                   $("#campaign-step-1-btn").attr('disabled', 'disabled');
	                   $("#campaign-step-1-btn").removeAttr('href');
	                   $("#campaign-step-2-btn").removeAttr('disabled');
					   $("#campaign-step-2-btn").attr('href', '#campaign-step-2');
	                   $("#campaign-step-1").css("display", "none");
	                   $("#campaign-step-2").css("display", "block");
	                       
	       //             $("#campaign-step-1-btn").removeClass('btn-primary').addClass('btn-default');
	       //             $("#campaign-step-3-btn").removeClass('btn-default').addClass('btn-primary');
	       //             $("#campaign-step-1-btn").attr('disabled', 'disabled');
	       //             $("#campaign-step-1-btn").removeAttr('href');
	       //             $("#campaign-step-3-btn").removeAttr('disabled');
					   // $("#campaign-step-3-btn").attr('href', '#campaign-step-3');
	       //             $("#campaign-step-1").css("display", "none");
	       //             $("#campaign-step-3").css("display", "block");
	                       
	                   $("#campaign_id").val(response.currentInsertId);
	                   $("#popup_campaign_id").val(response.currentInsertId);
	                   $("#CSV_popup_campaign_id").val(response.currentInsertId);
					   //alert($("#campaignFundingAmount").val())
					   
	                   // $("#totalDonationAmt").val($("#campaignFundingAmount").val().replace(/,/g, ""));
	                   // $("#minimumDonationAmt").val($("#campaignThresholdAmount").val().replace(/,/g, ""));
	                   // $("#totalText").text($("#campaignFundingAmount").val());
	                   // $("#minText").text($("#campaignThresholdAmount").val());
					   
					   // addImages();
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

		// jQuery('#ms-list-1').click(function(){
		// 	var isValid = $('#campaign_projects').valid();
		// 	console.log('enter valid var');
		// 	if(!(isValid)){
		// 		$(this).find('button').addClass("error");
		// 		console.log('error, notvalid var');
		// 	}else{
		// 		$(this).find('button').removeClass("error");
		// 		console.log('valid var');
		// 	}			
		// });

	
	$('#campaignDateFrom').datepicker({
		format: "dd-mm-yyyy",
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
			var newformattedDate = date.getFullYear() + "-" + 
								month + "-" + day;
								
			//$('#campaignDateFrom').datepicker('setStartDate', new Date(e.date));	
			$('#campaignDateTo').datepicker('setStartDate', new Date(date.setDate(date.getDate() + 1)));	
			formattedDate = ('0' + date.getDate()).slice(-2) + '/'
                        + ('0' + (date.getMonth()+1)).slice(-2) + '/'
                        + date.getFullYear();

			$('#hiddenStartDate').val(newformattedDate);
			
			//alert(formattedDate)			
			//alert(newformattedDate)			
						
			$(this).valid(); 
			
			$('.bootstrap-select').removeClass('error');
			
			//$('#goal_end_date').val('');
			$('#campaignDateTo').val('').datepicker('update');
			
			if (formattedDate=='NaN-aN-aN' &&  newformattedDate == 'NaN-aN-aN') {
				
				$('#campaignDateTo').val('').datepicker('update');
				$('#hiddenStartDate').val('');
			}
				
		}
				
	});
	
	$('#campaignDateTo').datepicker({
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


function saveAsDraft(camp_step)
{	
	var campaign_id = $('#campaign_id').val();
	var fd = new FormData($('#motivator-form-'+camp_step)[0]);
	
	fd.append('campaign_id',campaign_id);
			
	$.ajax({
		url: BASE_URL+'motivator/motivatorForm'+camp_step,
		type: 'POST',
		method: 'POST',
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
				if(camp_step == 1){
					$("#campaign_id").val(response.currentInsertId);
				}		   		   
				if(response.redirect != ''){
					setTimeout(function() {
						window.location.href = response.redirect;
					}, 1000);
				}
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
function validateNumber(e) {
	const pattern = /^[0-9]$/;

	return pattern.test(e.key )
}

function validateName(e) {
	const Namepattern = /^[A-Za-z]+$/;
	
	return Namepattern.test(e.key )
}

$.validator.addMethod('campaignFundingAmount', function(value, element, param) {
	value = value.replace(/\D/g, "");
	var hi = parseInt($(param).val().replace(/\D/g, ""));
	if (isNaN(hi)){
		return true;
	}else{
		return parseInt(value) > hi; 
	}
}, 'Funding Amount can not be lesser than or equal to Threshold Amount'); 

$.validator.addMethod('campaignThresholdAmount', function(value, element, param) {
	value = value.replace(/\D/g, "");
	var hi = parseInt($(param).val().replace(/\D/g, ""));
	if (isNaN(hi)){
		return true;
	}else{
		return parseInt(value) < hi;
	}
}, 'Threshold Amount can not be greater than or equal to Funding Amount');

$.validator.addMethod("wordCount", function(value, element, wordCount) {
    return value.split(' ').length <= wordCount;
}, 'Exceeded word count');
///////   form 2
		
$("#motivator-form-2").validate({
	// ignore: ':hidden:not("#campaign_projects")',
	ignore: ':hidden',
	rules: {
		campVideourl: {
          required: true,        
        },
		// Campaign_Description: {
  //         required: true,
		//   wordCount: 500     
        // }
	},
	onfocusout: function(element){ return false; },
	submitHandler: function(form) { 
		var fd = new FormData($('#motivator-form-2')[0]);	
        // var campaign_id = $('#campaign_id').val();
        // fd.append('campaign_id',campaign_id);			
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
            	console.log('success response#motivator-form-2');           
                if(response.flag == 1) {
                   $("#campaign-step-2-btn").removeClass('btn-primary').addClass('btn-default');
                   $("#campaign-step-3-btn").removeClass('btn-default').addClass('btn-primary');
                   $("#campaign-step-2-btn").attr('disabled', 'disabled');
                   $("#campaign-step-2-btn").removeAttr('href');
                   $("#campaign-step-3-btn").removeAttr('disabled');
				   $("#campaign-step-3-btn").attr('href', '#campaign-step-3');
                   $("#campaign-step-2").css("display", "none");
                   $("#campaign-step-3").css("display", "block");
                 //            $.toast({
                 //        heading: '',
                 //        text: response.msg,
                 //        showHideTransition: 'slide',
                 //        icon: 'success'
	                // })
                 //    setTimeout(function() {                        
                 //    }, 1000);
	                   $("#campaign_id_3").val(response.currentInsertId);
                	// var convertint = parseInt(response.currentInsertId);
					// $("#campaign_id").val(convertint); 
            	// console.log(convertint);   
            	// console.log(campaign_id);        
				   // alert(campaign_id);			   
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

///////   form 3
		
$("#motivator-form-3").validate({
	// ignore: ':hidden:not("#campaign_projects")',
	ignore: ':hidden',
	rules: {
		Campaign_Objective: {
          	required: true,
		 	 minlength:5,
			maxlength: 250        
        },
		Campaign_Description: {
          required: true,
		 	 minlength:5,
			maxlength: 250,
		  	wordCount: 500     
        }
	},
	onfocusout: function(element){ return false; },
	submitHandler: function(form) { 
		var fd = new FormData($('#motivator-form-3')[0]);				
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
            	console.log('success response#motivator-form-3');           
                if(response.flag == 1) {                			   		
        			console.log(response.redirect);     
					$.toast({
	                heading: '',
	                text: response.msg,
	                showHideTransition: 'slide',
	                icon: 'success'
	              })
	              setTimeout(function() {
	                window.location.href =response.redirect;
	              });                 
       //             $("#campaign-step-2-btn").removeClass('btn-primary').addClass('btn-default');
       //             $("#campaign-step-3-btn").removeClass('btn-default').addClass('btn-primary');
       //             $("#campaign-step-2-btn").attr('disabled', 'disabled');
       //             $("#campaign-step-2-btn").removeAttr('href');
       //             $("#campaign-step-3-btn").removeAttr('disabled');
				   // $("#campaign-step-3-btn").attr('href', '#campaign-step-3');
       //             $("#campaign-step-2").css("display", "none");
       //             $("#campaign-step-3").css("display", "block");
                 //            $.toast({
                 //        heading: '',
                 //        text: response.msg,
                 //        showHideTransition: 'slide',
                 //        icon: 'success'
	                // })
                 //    setTimeout(function() {                        
                 //    }, 1000);               
                   // $("#campaign_id").val(response.currentInsertId);
				   //alert($("#campaignFundingAmount").val())				   
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