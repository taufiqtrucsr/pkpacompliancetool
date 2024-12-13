$(document).ready(function () {
	
	/*$('#proSector').multiselect({
	//search: true,
	//selectAll: true
	texts    : {
	placeholder: 'Select Sector/s',
}
});*/
 
/*$('#proBeneficiary').multiselect({
	//search: true,
	//selectAll: true
	texts    : {
	placeholder: 'Select Beneficiary/ies',
}
});*/

$('input.amount-number').keyup(function(event) {

  // skip for arrow keys
  if(event.which >= 37 && event.which <= 40) return;

  // format number
  convertToINRFormat($(this).val(),$(this));
  // $(this).val(function(index, value) {
	// return value
	// .replace(/\D/g, "")
	// .replace(/(\d)(?=(\d\d)+\d$)/g, "$1,")
	// ;
  // });
});

proTypeVal = $("input[type=radio][name='proType']:checked").val();
if( proTypeVal == 1){  //1 - Specific 
	$('#proTargetBlock').hide();
	$('#programmeswitch').hide();
	$('#proScheduleBlock').show();
	$('#installment-container').show();
	$('.projectjsswitch').show();
	$('.programmejsswitch').hide();
	// $('#proDateFrom').valid();
	// $('#proDateTo').valid();
}

$("input[name='proType']").change(function() {
	if(this.checked) {
		var val = $(this).val();
		//alert(val)
		if( val == 1){  //1 - Specific 
			$('#proTargetBlock').hide();
			$('#programmeswitch').hide();
			$('#proScheduleBlock').show();
			$('#installment-container').show();
			$('.projectjsswitch').show();
			$('.programmejsswitch').hide();
			// $('#proDateFrom').valid();
			// $('#proDateTo').valid();
		}
		
		if( val == 2 ){ //2- Reccurring
			$('#proTargetBlock').show();
			$('#programmeswitch').show();
			$('.programmejsswitch').show();
			$('.projectjsswitch').hide();
			$('#installment-container').hide();
			$('#proScheduleBlock').hide();
			// $('#proTarget').valid();
			// $('#proTargetText').valid();
			// $('#proTargetFrequency').valid();
		}
	}
});
 
	/*function backstep1(){
			   $("#pro-step-2-btn").removeClass('btn-primary').addClass('btn-default');
			   $("#pro-step-1-btn").removeClass('btn-default').addClass('btn-primary');
			   $("#pro-step-2-btn").attr('disabled', 'disabled');
			   $("#pro-step-2-btn").removeAttr('href');
			   $("#pro-step-1-btn").removeAttr('disabled');
			   $("#pro-step-1-btn").attr('href', '#project-step-1');
			   $("#project-step-2").css("display", "none");
			   $("#project-step-1").css("display", "block");
	}
	function backstep2(){
			   $("#pro-step-3-btn").removeClass('btn-primary').addClass('btn-default');
			   $("#pro-step-2-btn").removeClass('btn-default').addClass('btn-primary');
			   $("#pro-step-3-btn").attr('disabled', 'disabled');
			   $("#pro-step-3-btn").removeAttr('href');
			   $("#pro-step-2-btn").removeAttr('disabled');
			   $("#pro-step-2-btn").attr('href', '#project-step-2');
			   $("#project-step-3").css("display", "none");
			   $("#project-step-2").css("display", "block");
	}
	function backstep3(){
			   $("#pro-step-4-btn").removeClass('btn-primary').addClass('btn-default');
			   $("#pro-step-3-btn").removeClass('btn-default').addClass('btn-primary');
			   $("#pro-step-4-btn").attr('disabled', 'disabled');
			   $("#pro-step-4-btn").removeAttr('href');
			   $("#pro-step-3-btn").removeAttr('disabled');
			   $("#pro-step-3-btn").attr('href', '#project-step-3');
			   $("#project-step-4").css("display", "none");
			   $("#project-step-3").css("display", "block");
	}
	function backstep4(){
			   $("#pro-step-5-btn").removeClass('btn-primary').addClass('btn-default');
			   $("#pro-step-4-btn").removeClass('btn-default').addClass('btn-primary');
			   $("#pro-step-5-btn").attr('disabled', 'disabled');
			   $("#pro-step-5-btn").removeAttr('href');
			   $("#pro-step-4-btn").removeAttr('disabled');
			   $("#pro-step-4-btn").attr('href', '#project-step-4');
			   $("#project-step-5").css("display", "none");
			   $("#project-step-4").css("display", "block");
	}
	function backstep5(){
			   $("#pro-step-6-btn").removeClass('btn-primary').addClass('btn-default');
			   $("#pro-step-5-btn").removeClass('btn-default').addClass('btn-primary');
			   $("#pro-step-6-btn").attr('disabled', 'disabled');
			   $("#pro-step-6-btn").removeAttr('href');
			   $("#pro-step-5-btn").removeAttr('disabled');
			   $("#pro-step-5-btn").attr('href', '#project-step-5');
			   $("#project-step-6").css("display", "none");
			   $("#project-step-5").css("display", "block");
	}*/
	
$("#pro-form-1").validate({

	ignore: ':hidden:not("#proSector")',
	rules: { 
		"proSector[]": {
			required: true,
			minlength: 1
		},
		fundType: {
			required: true,        
		},
		is_capital_asset: {
			required: true,        
		},
		proName: {
			  required: true,
			maxlength: 250 
		  },
		proShortDescription: {
		  required: true, 
		  maxlength: 250
		},
		proDescription: {
		  required: true, 
		//   maxlength: 500,
		  wordCount: 500
		},
		project_duration: {
			required: true,        
		},
		proPincode: {
			required: true,      
			number: true,
			minlength:6,
			maxlength: 6	
		},
		proState: {
			required: true,        
		},
		proDistrict: {
			required: true,        
		},
		proCity: {
			required: true,        
		},
		proTotalCost: {
			required: true, 
			proTotalCost: '#proDonationAmt'			  
		  },
		proDonationAmt: {
			required: true, 
			proDonationAmt: '#proTotalCost'			  
		},
		min_csr_amt: {
			required: true,        
		},
		tax_exemption_applicable: {
			required: true,        
		},
		proType: {
			required: true,        
		},
		document: {
			required: function() {
				  return $('[name="proType"]:checked').val() == 1; 
			  },        
		},
		document_number: {
			required: function() {
				  return $('[name="proType"]:checked').val() == 1; 
			  },        
		},
		project_name_as_per_notification: {
			required: function() {
				  return $('[name="proType"]:checked').val() == 1; 
			  },        
		},
		project_budget_as_per_notification: {
			required: function() {
				  return $('[name="proType"]:checked').val() == 1; 
			  },        
		},
		proDateFrom: {
		  required: function() {
				return $('[name="proType"]:checked').val() == 1; 
			},        
		},
		proDateTo: {
		  required:  function() {
				return $('[name="proType"]:checked').val() == 1; 
			},        	      
		},
		"proBeneficiary[]": {
			required: true,
			minlength: 1
		},
	},
	onfocusout: function(element){ return false; },
	submitHandler: function(form) { 		

		var fd = new FormData($('#pro-form-1')[0]);
		
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
				window.location = hitUrl+'project/detailedInformation/'+response.currentInsertId;
			   /*$("#pro-step-1-btn").removeClass('btn-primary').addClass('btn-default');
			   $("#pro-step-2-btn").removeClass('btn-default').addClass('btn-primary');
			   $("#pro-step-1-btn").attr('disabled', 'disabled');
			   $("#pro-step-1-btn").removeAttr('href');
			   $("#pro-step-2-btn").removeAttr('disabled');
			   $("#pro-step-2-btn").attr('href', '#project-step-2');
			   $("#project-step-1").css("display", "none");
			   $("#project-step-2").css("display", "block");
				   
			   $("#ngo_project_id").val(response.currentInsertId);
			   //alert($("#proTotalCost").val())
			   
			   $("#totalDonationAmt").val($("#proTotalCost").val().replace(/,/g, ""));
			   $("#minimumDonationAmt").val($("#proDonationAmt").val().replace(/,/g, ""));
			   $("#totalText").text($("#proTotalCost").val());
			   $("#minText").text($("#proDonationAmt").val());
			   
			   addMilestone();*/
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

	

$('#ms-list-1').click(function(){
	isValid = $('#proSector').valid();
	if(!(isValid)){
		$(this).find('button').addClass("error");
	}else{
		$(this).find('button').removeClass("error");
	}
	
});

$('#ms-list-2').click(function(){
	/*isValid = $('#proBeneficiary').valid();
	if(!(isValid)){
		$(this).find('button').addClass("error");
	}else{
		$(this).find('button').removeClass("error");
	}*/
});

$('#proDateFrom').datepicker({
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
							
		//$('#proDateFrom').datepicker('setStartDate', new Date(e.date));	
		$('#proDateTo').datepicker('setStartDate', new Date(date.setDate(date.getDate() + 1)));	
		formattedDate = ('0' + date.getDate()).slice(-2) + '/'
					+ ('0' + (date.getMonth()+1)).slice(-2) + '/'
					+ date.getFullYear();
					
		
		
		$('#hiddenStartDate').val(newformattedDate);
		
		//alert(formattedDate)			
		//alert(newformattedDate)			
					
		$(this).valid(); 
		
		$('.bootstrap-select').removeClass('error');
		
		//$('#goal_end_date').val('');
		$('#proDateTo').val('').datepicker('update');
		
		if (formattedDate=='NaN-aN-aN' &&  newformattedDate == 'NaN-aN-aN') {
			
			$('#proDateTo').val('').datepicker('update');
			$('#hiddenStartDate').val('');
		}
			
	}
			
});

$('#proDateTo').datepicker({
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


$("#crowdfundingpay").change(function() {
	if($(this).is(":checked")) {
		$('#crowdfundingpay-container').show();
		// $('#crowdfundingpay_input').prop('required',true);

	} else {
		$('#crowdfundingpay-container').hide();
		// $('#crowdfundingpay_input').prop('required',false);
	}
});

$("#pro-form-2").validate({

	ignore: ':hidden', 
	rules: { 
		oneTimePayment: {
			require_from_group: [1, '.fund-type-chk-box']
		  },
		installmentPayment: {
			require_from_group: [1, '.fund-type-chk-box']
		},
		milestonePayment: {
			require_from_group: [1, '.fund-type-chk-box']
		},
		// crowdfunding_pay: {
		// 	require_from_group: [1, '.fund-type-chk-box']
  //       },
  //       "donation_amount": {
		// 	required: function(element) {
		// 		if ($("#crowdfunding_pay").val() == 0) {
		// 			return false;
		// 		} else {
		// 			return true;
		// 		}
		// 	},	
  //       },
		"installmentPaymentType[]": {
			required: function(element) {
				if ($("#installmentPayment").val() == 0) {
					return false;
				} else {
					return true;
				}
			},
		  minlength: 1		
		},
		// "reciept[]": {
			// required:  function() {
				// $("#add-entry-button").click(function(){
					// var $this = $(this);
					// if($this.data('clicked')) {
						// return false;
					// }
					// else {
						// $this.data('clicked', true);
						// return true;
					// }
				// });
			// },
			// //minlength: 1	
		// },
	},
	messages: {
		oneTimePayment:{require_from_group: ""},
		installmentPayment: {require_from_group: ""},
		milestonePayment: {require_from_group: ""},
		// crowdfunding_pay: {require_from_group: ""},
		// "donation_amount": {required: ""},
		"installmentPaymentType[]": {required: ""},
		//"reciept[]": {required: ""},
	},

	submitHandler: function(form) { 		

		var fd = new FormData($('#pro-form-2')[0]);
		//fd=fd+'&project_id='+$('#ngo_project_id').val();
		if($('#crowdfundingpay').is(':checked')){
				var crowddonation = $('#crowdfundingpay_input').val();
				if (crowddonation < 1){
					// swal({
					// 	icon: "error",
					// 	text: 'Donation Amount form cannot be blank',
					// 	buttons: false,
					// 	timer: 3000
					// })
					// return false;	
					
					$.toast({
						heading: '',
						text: 'Donation Amount form cannot be blank',
						showHideTransition: 'slide',
						icon: 'error'
					  })
					return false;
					setTimeout(function() {                        
					  }, 1000);
				}
			}
		var myCheckboxes = [];
		$('input[name="installmentPaymentType[]"]').each(function() {
		   myCheckboxes.push($(this).val());
		});
		
		console.log(myCheckboxes);
		
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
			   /*$("#pro-step-2-btn").removeClass('btn-primary').addClass('btn-default');
			   $("#pro-step-3-btn").removeClass('btn-default').addClass('btn-primary');
			   $("#pro-step-2-btn").attr('disabled', 'disabled');
			   $("#pro-step-2-btn").removeAttr('href');
			   $("#pro-step-3-btn").removeAttr('disabled');
			   $("#pro-step-3-btn").attr('href', '#project-step-3');
			   $("#project-step-2").css("display", "none");
			   $("#project-step-3").css("display", "block");*/
			   
			   //var noHashURL = window.location.href.replace(/#.*$/, '');

			   window.location = hitUrl+'project/bankDetails/'+response.currentInsertId;
			   
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

$('#add-entry-button').on('click', function() {
	// alert(111111)
	$("[name='foundedBy[]']").valid();
	$("[name='comitted[]']").valid();
	//$("[name='reciept[]']").valid();
});		

$("#pro-form-3").validate({
	ignore: ":hidden",
	rules: {}, 
	submitHandler: function(form) { 
	
		var fd = new FormData($('#pro-form-3')[0]);
		/*var project_id = $('#ngo_project_id').val();
		
		fd.append('ngo_project_id',project_id);*/

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
			  
				if(response.flag == 1){
					window.location = hitUrl+'project/fundAcquisition/'+response.currentInsertId;
				   /* $("#pro-step-3-btn").removeClass('btn-primary').addClass('btn-default');
				   $("#pro-step-4-btn").removeClass('btn-default').addClass('btn-primary');
				   $("#pro-step-3-btn").attr('disabled', 'disabled');
				   $("#pro-step-3-btn").removeAttr('href');
				   $("#pro-step-4-btn").removeAttr('disabled');
				   $("#pro-step-4-btn").attr('href', '#project-step-4');
				   $("#project-step-3").css("display", "none");
				   $("#project-step-4").css("display", "block");
				   
				   var noHashURL = window.location.href.replace(/#.*$/, '');

				   setTimeout(function() {
							window.location.href =noHashURL+'#project-step-4';
					}); 	*/		    

				} else{
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


$("#pro-form-4").validate({

ignore: ':hidden', 
   rules: {
		problem_statement: {
		  required: true,
		},
		project_goal: {
		  required: true,
		},
		project_objective: {
			required: true,
		},
		project_description: {
			required: true,
		},
		expected_result: {
			required: true,
		},
		need_volunteer: {
			required: true,
		},
	},
	messages: {},			
	onfocusout: function(element){return false; },
  submitHandler: function(form) {     
	var fd = new FormData($('#pro-form-4')[0]);
	/*var project_id = $('#ngo_project_id').val();
	
	var myCheckboxes = [];
	$('input[name="SDGSType[]"]').each(function() {
	   myCheckboxes.push($(this).val());
	});
	
	fd.append('ngo_project_id',project_id);
	console.log(myCheckboxes);*/
  
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
			window.location = hitUrl+'project/uploadImages/'+response.id;
		 /* $("#pro-step-4-btn").removeClass('btn-primary').addClass('btn-default');
		  $("#pro-step-5-btn").removeClass('btn-default').addClass('btn-primary');
		  $("#pro-step-4-btn").attr('disabled', 'disabled');
		  $("#pro-step-4-btn").removeAttr('href');
		  $("#pro-step-5-btn").removeAttr('disabled');
		  $("#pro-step-5-btn").attr('href', '#project-step-5');
		  $("#project-step-4").css("display", "none");
		  $("#project-step-5").css("display", "block");
		  
		  var noHashURL = window.location.href.replace(/#.*$/, '');

		  setTimeout(function() {
			window.location.href =noHashURL+'#project-step-5';
		  }); */
			   
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

$("#pro-form-5").validate({
ignore: ':hidden', 
   rules: {
		"reportingFrequencyType[]": {
		  required: true,
		  minlength: 1
		}
	}, 
	messages: {
		"reportingFrequencyType[]": {required: ""},
	},

  submitHandler: function(form) {     
	var fd = new FormData($('#pro-form-5')[0]);
	var project_id = $('#ngo_project_id').val();
	
	fd.append('ngo_project_id',project_id);
   
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
		  $("#pro-step-5-btn").removeClass('btn-primary').addClass('btn-default');
		  $("#pro-step-6-btn").removeClass('btn-default').addClass('btn-primary');
		  $("#pro-step-5-btn").attr('disabled', 'disabled');
		  $("#pro-step-5-btn").removeAttr('href');
		  $("#pro-step-6-btn").removeAttr('disabled');
		  $("#pro-step-6-btn").attr('href', '#project-step-6');
		  $("#project-step-5").css("display", "none");
		  $("#project-step-6").css("display", "block");
		  
		  var noHashURL = window.location.href.replace(/#.*$/, '');

		  setTimeout(function() {
			window.location.href =noHashURL+'#project-step-6';
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

$("#pro-form-6").validate({
	ignore: ':hidden', 
	rules: {
		bankName: {
			required: true,
		},
		holderName: {
			required: true,
		},
		accountNo: {
			required: true,
		},
		ifscCode: {
			required: true,
		},
	},

	submitHandler: function(form) {     
	var fd = new FormData($('#pro-form-6')[0]);
	var project_id = $('#ngo_project_id').val();
	
	fd.append('ngo_project_id',project_id);
   
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
			$('#ngo_project_id').val(response.project_id);

		 $.toast({
			heading: '',
			text: response.msg,
			showHideTransition: 'slide',
			icon: 'success'
		  })
		//   previewProject(response.project_id);
		  
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
$('#pro-step-6-submit').click(function(){
	if($('[name="account_selected"]').is(':checked')) { 
		$('#termsConditionsPopup').modal();
	}else{
		$.toast({
			heading: '',
			text: 'Please select bank account.',
			showHideTransition: 'slide',
			icon: 'error'
		})
	 }
});	

hash = window.location.hash;

$("#installmentPayment").change(function() {
	if($(this).is(":checked")) {
		$('.group-chk').show();
	} else {
		$('.group-chk').hide();
	}
});

$("#milestonePayment").change(function() {
	if($(this).is(":checked")) {
		$('#pay-milestone-container').show();
	} else {
		$('#pay-milestone-container').hide();
	}
});

$("#crowdfunding").change(function() {
	if($(this).is(":checked")) {
		$('.pay-Crowfunding-containers').show();
	} else {
		$('.pay-Crowfunding-containers').hide();
	}
});
});
function previewProject(project_id)
{	
console.log('previewProject');
$.ajax({
	url: BASE_URL+'preview-project/' + project_id,
	type: 'POST',
	dataType: 'json',
	data:{project_id:project_id}, 
	success: function(response) {
	console.log(response);
	if(response.flag == 1) {
	 $.toast({
		heading: '',
		text: response.msg,
		showHideTransition: 'slide',
		icon: 'success'
	  });
	  
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
function saveAsDraft(pro_step)
{	
var project_id = $('#ngo_project_id').val();
var fd = new FormData($('#pro-form-'+pro_step)[0]);

fd.append('ngo_project_id',project_id);
		
$.ajax({
url: BASE_URL+'project/proPostForm'+pro_step,
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
		
		if(pro_step == 1){
			$("#ngo_project_id").val(response.currentInsertId);
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

// $.validator.addMethod('proTotalCost', function(value, element, param) {
	// value = value.replace(/\D/g, "");
  // return parseInt(value) > parseInt($(param).val().replace(/\D/g, ""));
// }, 'Total cost can not be lesser than or equal to donation amount');

// $.validator.addMethod('proDonationAmt', function(value, element, param) {
	// value = value.replace(/\D/g, "");
  // return parseInt(value) < parseInt($(param).val().replace(/\D/g, ""));
// }, 'Min donation amount can not be greater than or equal to total cost');

$.validator.addMethod('proTotalCost', function(value, element, param) {
value = value.replace(/\D/g, "");
var hi = parseInt($(param).val().replace(/\D/g, ""));
if (isNaN(hi)){
	return true;
}else{
	return parseInt(value) > hi; 
}
}, 'Total cost can not be lesser than or equal to donation amount'); 


$.validator.addMethod('proDonationAmt', function(value, element, param) {
value = value.replace(/\D/g, "");
var hi = parseInt($(param).val().replace(/\D/g, ""));
if (isNaN(hi)){
	return true;
}else{
	return parseInt(value) < hi;
}
}, 'Min donation amount can not be greater than or equal to total cost');

$.validator.addMethod("wordCount", function(value, element, wordCount) {
return value.split(' ').length <= wordCount;
}, 'Exceeded word count');

$(document).on('click','#submit-handler-global',function(){
	var field = $(document).find('.global-input');
	validator(field);
 });
 $(document).on('keyup keypress change','.global-input',function(){
	var field =  $(document).find('.global-input');
	validator(field);
 });
 function validator(field){
	var flag = false;
	field.each(function(){
	  if($(this).val() == ''){
		  $(this).addClass('error');
		  var len = $(this).parent().find('.error-msg').length;
		  if(len == 0){
			 $(this).parent().append('<label class="error-msg">This field is required.</label>');
		  }else{
			 $(this).parent().find('.error-msg').show();
		  }
		  flag = true;
	  }else{
		  var l = $(this).val().length;
		  var m = $(this).attr("minlength");
		  if(l < m){
			 flag = true;
			 $(this).parent().find('.error-msg').text('Please enter at least '+m+' characters.');
			 $(this).parent().find('.error-msg').show();
		  }else{
			 $(this).removeClass('error');
			 $(this).parent().find('.error-msg').hide();
		  }
	  }
	});
	if(flag)
		  return false;
 }