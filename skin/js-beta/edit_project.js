$(document).ready(function () {
	
	$('#proSector').multiselect({
		//search: true,
		//selectAll: true
		texts    : {
        placeholder: 'Select Sector/s',
    }
	});
	 
	$('#proBeneficiary').multiselect({
		//search: true,
		//selectAll: true
		texts    : {
        placeholder: 'Select Beneficiary/ies',
    }
	});
	
	/*$('#reset').click( function(e){
		e.preventDefault();
		alert(11111111111);
		 $('option', $('#proSector')).each(function (element) {
                $(this).removeAttr('selected').prop('selected', false);
            });
            $('#proSector').multiselect('reload');
		//$('#proSector').multiselect('reload');
	});*/
	
	convertToINRFormat($("#proTotalCost").val(),$("#proTotalCost"));	
	
	convertToINRFormat($("#proDonationAmt").val(),$("#proDonationAmt"));	
	
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
	
	$("input[name='proType']").change(function() {
		if(this.checked) {
			var val = $(this).val();
			//alert(val)
			if( val == 1){  //1 - Specific 
				$('#proTargetBlock').hide();
				$('#proScheduleBlock').show();
				$('#installment-container').show();
				// $('#proDateFrom').valid();
				// $('#proDateTo').valid();
			}
			
			if( val == 2 ){ //2- Reccurring
				$('#proTargetBlock').show();
				$('#installment-container').hide();
				$('#proScheduleBlock').hide();
				// $('#proTarget').valid();
				// $('#proTargetText').valid();
				// $('#proTargetFrequency').valid();
			}
		}
	});
	
	$("#pro-edit-form-1").validate({

		ignore: ':hidden:not("#proSector,#proBeneficiary")',
    	rules: { 
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
			  //maxlength: 3000
			  wordCount: 500
	        },
	        proType: {
	          required: true,        
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
			proTarget: {
	          required: function() {
					return $('[name="proType"]:checked').val() == 2; 
				},        
	        },
			proTargetText: {
	          required:  function() {
					return $('[name="proType"]:checked').val() == 2; 
				},        	      
	        },
			proTargetFrequency: {
	          required:  function() {
					return $('[name="proType"]:checked').val() == 2; 
				},        	      
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
			"proSector[]": {
	          required: true,
				minlength: 1
	        },
			proTotalCost: {
	          required: true, 
			  proTotalCost: '#proDonationAmt'			  
	        },
			"proBeneficiary[]": {
	          required: true,
				minlength: 1
	        },
			proDonationAmt: {
	          required: true, 
			  proDonationAmt: '#proTotalCost'			  
	        }
    	},
		onfocusout: function(element){ return false; },
    	submitHandler: function(form) { 	
		
			var project_id = $('#ngo_project_id').val();
    		var fd = new FormData($('#pro-edit-form-1')[0]);
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
                   $("#pro-step-1-btn").removeClass('btn-primary').addClass('btn-default');
                   $("#pro-step-2-btn").removeClass('btn-default').addClass('btn-primary');
                   $("#pro-step-1-btn").attr('disabled', 'disabled');
                   $("#pro-step-2-btn").removeAttr('disabled');
				   $("#pro-step-2-btn").attr('href', '#project-step-2');
                   $("#project-step-1").css("display", "none");
                   $("#project-step-2").css("display", "block");
                       
                  var noHashURL = window.location.href.replace(/#.*$/, '');

				   setTimeout(function() {
							window.location.href =noHashURL+'#project-step-2';
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
	
	$('#proFormbtn1').on('click', function() {
		// alert(111111)
		isValid = $('#proSector').valid();
		if(!(isValid)){
			$('#ms-list-1').find('button').addClass("error");
		}else{
			$('#ms-list-1').find('button').removeClass("error");
		}
		
		isValid1 = $('#proBeneficiary').valid();
		if(!(isValid1)){
			$('#ms-list-2').find('button').addClass("error");
		}else{
			$('#ms-list-2').find('button').removeClass("error");
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
		isValid = $('#proBeneficiary').valid();
		if(!(isValid)){
			$(this).find('button').addClass("error");
		}else{
			$(this).find('button').removeClass("error");
		}
	});
	
	$('#proDateFrom').datepicker({
		format: "dd-mm-yyyy",
		autoclose: true,
		todayHighlight: true,
		toggleActive: true,	
	}).on('changeDate', function(e){
		var date = new Date(e.date);
		if (date) {
			
			//$('#proDateFrom').datepicker('setStartDate', new Date(e.date));	
			$('#proDateTo').datepicker('setStartDate', new Date(date.setDate(date.getDate() + 1)));	
			formattedDate = ('0' + date.getDate()).slice(-2) + '/'
                        + ('0' + (date.getMonth()+1)).slice(-2) + '/'
                        + date.getFullYear();
						
			$(this).valid(); 
			
			$('.bootstrap-select').removeClass('error');
			
			//$('#goal_end_date').val('');
			$('#proDateTo').val('').datepicker('update');
			
			if (formattedDate=='NaN-aN-aN') {
				
				$('#proDateTo').val('').datepicker('update');
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
			
			$(this).valid(); 
		}
	
	});
	
	// $("#pro-edit-form-2").on('click',function(){
		// isValid = $('.fund-type-chk-box').valid();
		
		// var boxes = $('.fund-type-chk-box')
		// if (boxes.filter(':checked').length < 1){
			// //$('.payment-error').css('display','block');
			// // $('.fund-type-chk-box').focus();
			// alert("Check at least one Game!");
			// return false;
		// }else{
			
		// }
    // });

	$("#pro-edit-form-2").validate({

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
			// "foundedBy[]": {
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
			// "comitted[]": {
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
				// // lesserThan: "#totalDonationAmt",
				// // greaterThan: "#minimumDonationAmt",
				// //minlength: 1	
	        // },
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
			"installmentPaymentType[]": {required: ""},
			//"reciept[]": {required: ""},
		},
		// errorPlacement: function (error, el) {
			
			// if (el.attr('name') === 'installmentPaymentType[]') {
				// //alert(111111111)
				// error.appendTo('#itemErrors');
			// } else {
				// error.appendAfter(el);
			// }
		// },
		
		// errorPlacement: function(error, element) {
			// console.log(error)
			// console.log(element) 
			// error.appendTo(element.next().next());
		// },

    	submitHandler: function(form) { 		
    		
			var project_id = $('#ngo_project_id').val();
			var fd = new FormData($('#pro-edit-form-2')[0]);
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
                   $("#pro-step-2-btn").removeClass('btn-primary').addClass('btn-default');
                   $("#pro-step-3-btn").removeClass('btn-default').addClass('btn-primary');
                   $("#pro-step-2-btn").attr('disabled', 'disabled');
                   $("#pro-step-3-btn").removeAttr('disabled');
				   $("#pro-step-3-btn").attr('href', '#project-step-3');
                   $("#project-step-2").css("display", "none");
                   $("#project-step-3").css("display", "block");
				   
				   var noHashURL = window.location.href.replace(/#.*$/, '');

				   setTimeout(function() {
							window.location.href =noHashURL+'#project-step-3';
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
	
	$('#add-entry-button').on('click', function() {
		// alert(111111)
		$("[name='foundedBy[]']").valid();
		$("[name='comitted[]']").valid();
		//$("[name='reciept[]']").valid();
	});	
	
	$("#pro-edit-form-3").validate({
        ignore: ":hidden",
        rules: {
            coverImage: {
                required: true,
                extension: "jpg|jpeg|png"
            }
        }, 
        submitHandler: function(form) { 
		
			var fd = new FormData($('#pro-edit-form-3')[0]);
            var files = $('#coverImage')[0].files[0];
            var project_id = $('#ngo_project_id').val();
			
            fd.append('coverImage',files);
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
				  
                    if(response.flag == 1){

                        $("#pro-step-3-btn").removeClass('btn-primary').addClass('btn-default');
					   $("#pro-step-4-btn").removeClass('btn-default').addClass('btn-primary');
					   $("#pro-step-3-btn").attr('disabled', 'disabled');
					   $("#pro-step-4-btn").removeAttr('disabled');
					   $("#pro-step-4-btn").attr('href', '#project-step-4');
					   $("#project-step-3").css("display", "none");
					   $("#project-step-4").css("display", "block");
					   
					   var noHashURL = window.location.href.replace(/#.*$/, '');

					   setTimeout(function() {
								window.location.href =noHashURL+'#project-step-4';
						}); 			    

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

	
	$("#pro-edit-form-4").validate({

    ignore: ':hidden', 
       rules: {
            prblmDescription: {
                required: true,
                //maxlength: 300
				wordCount: 150
            },
            "goalName[]": {
              required: true,
              minlength: 1
            },
            "goalDescription[]": {
              required: true,
              minlength: 1,
			  maxlength: 750
            },
			// "goal_img[]": {
              // required: true,
              // minlength: 1
            // },
			//"SDGSType[]": {
              //required: true,
              //minlength: 1
            //}
        },
		messages: {
			// firstname: "Enter your firstname",
			// lastname: "Enter your lastname",
			//"SDGSType[]": {
				//required: "",
				//minlength: jQuery.format("Enter at least {0} characters"),
			//}
		},	
		onfocusout: function(element){ return false; },
      submitHandler: function(form) {     
        var fd = new FormData($('#pro-edit-form-4')[0]);
        var project_id = $('#ngo_project_id').val();
        
        var myCheckboxes = [];
        $('input[name="SDGSType[]"]').each(function() {
           myCheckboxes.push($(this).val());
        });
        
        fd.append('ngo_project_id',project_id);
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
              $("#pro-step-4-btn").removeClass('btn-primary').addClass('btn-default');
              $("#pro-step-5-btn").removeClass('btn-default').addClass('btn-primary');
              $("#pro-step-4-btn").attr('disabled', 'disabled');
              $("#pro-step-5-btn").removeAttr('disabled');
              $("#pro-step-5-btn").attr('href', '#project-step-5');
              $("#project-step-4").css("display", "none");
              $("#project-step-5").css("display", "block");
              
              var noHashURL = window.location.href.replace(/#.*$/, '');

              setTimeout(function() {
                window.location.href =noHashURL+'#project-step-5';
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

	$("#pro-edit-form-5").validate({

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
        var fd = new FormData($('#pro-edit-form-5')[0]);
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
	
	$("#pro-edit-form-6").validate({
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
        var fd = new FormData($('#pro-edit-form-6')[0]);
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
             $.toast({
                heading: '',
                text: response.msg,
                showHideTransition: 'slide',
                icon: 'success'
              })
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
		isValid = $('#pro-edit-form-6').valid();
		if(isValid){
			$('#termsConditionsPopup').modal();
		}
	});	
	
	hash = window.location.hash;
	
	if(hash=='#project-step-2')
	{

	  //alert("ee");
	   $("#pro-step-2-btn").removeClass('btn-default').addClass('btn-primary');
	   $("#pro-step-1-btn").removeClass('btn-primary').addClass('btn-default');
	   $("#pro-step-2-btn").removeAttr('disabled');
	   $("#pro-step-1-btn").attr('disabled', 'disabled');
	   $("#pro-step-1-btn").removeAttr('href');
		$("#project-step-1").css("display", "none");
	   $("#project-step-2").css("display", "block");
	}
	
	if(hash=='#project-step-3')
	{

	  //alert("ee");
	   $("#pro-step-3-btn").removeClass('btn-default').addClass('btn-primary');
	   $("#pro-step-2-btn").removeClass('btn-primary').addClass('btn-default');
	   $("#pro-step-1-btn").removeClass('btn-primary').addClass('btn-default');
	   $("#pro-step-3-btn").removeAttr('disabled');
	   $("#pro-step-2-btn").attr('disabled', 'disabled');
	   $("#pro-step-2-btn").removeAttr('href');
		$("#project-step-2").css("display", "none");
		 $("#pro-step-1-btn").attr('disabled', 'disabled');
	   $("#pro-step-1-btn").removeAttr('href');
		$("#project-step-1").css("display", "none");
	   $("#project-step-3").css("display", "block");
	}
	
	if(hash=='#project-step-4')
	{

	  //alert("ee");
	   $("#pro-step-4-btn").removeClass('btn-default').addClass('btn-primary');
	   $("#pro-step-2-btn").removeClass('btn-primary').addClass('btn-default');
	   $("#pro-step-3-btn").removeClass('btn-primary').addClass('btn-default');
	   $("#pro-step-1-btn").removeClass('btn-primary').addClass('btn-default');
	   $("#pro-step-4-btn").removeAttr('disabled');
	   $("#pro-step-2-btn").attr('disabled', 'disabled');
	   $("#pro-step-2-btn").removeAttr('href');
	   $("#pro-step-3-btn").removeAttr('href');
		$("#project-step-2").css("display", "none");
		$("#project-step-3").css("display", "none");
		 $("#pro-step-1-btn").attr('disabled', 'disabled');
	   $("#pro-step-1-btn").removeAttr('href');
	    $("#pro-step-3-btn").attr('disabled', 'disabled');
	   $("#pro-step-3-btn").removeAttr('href');
		$("#project-step-1").css("display", "none");
	   $("#project-step-4").css("display", "block");
	}
	
	if(hash=='#project-step-5')
	{

	  //alert("ee");
	   $("#pro-step-5-btn").removeClass('btn-default').addClass('btn-primary');
	   $("#pro-step-2-btn").removeClass('btn-primary').addClass('btn-default');
	   $("#pro-step-3-btn").removeClass('btn-primary').addClass('btn-default');
	   $("#pro-step-1-btn").removeClass('btn-primary').addClass('btn-default');
	   $("#pro-step-4-btn").removeClass('btn-primary').addClass('btn-default');
	   $("#pro-step-5-btn").removeAttr('disabled');
	   $("#pro-step-2-btn").attr('disabled', 'disabled');
	   $("#pro-step-2-btn").removeAttr('href');
	   $("#pro-step-3-btn").removeAttr('href');
	   $("#pro-step-4-btn").removeAttr('href');
		$("#project-step-2").css("display", "none");
		$("#project-step-3").css("display", "none");
		 $("#pro-step-1-btn").attr('disabled', 'disabled');
		 $("#pro-step-4-btn").attr('disabled', 'disabled');
	   $("#pro-step-1-btn").removeAttr('href');
	   $("#pro-step-4-btn").removeAttr('href');
	    $("#pro-step-3-btn").attr('disabled', 'disabled');
	   $("#pro-step-3-btn").removeAttr('href');
		$("#project-step-1").css("display", "none");
		$("#project-step-4").css("display", "none");
	   $("#project-step-5").css("display", "block");
	}
	
	if(hash=='#project-step-6')
	{

	  //alert("ee");
	   $("#pro-step-6-btn").removeClass('btn-default').addClass('btn-primary');
	   $("#pro-step-5-btn").removeClass('btn-primary').addClass('btn-default');
	   $("#pro-step-2-btn").removeClass('btn-primary').addClass('btn-default');
	   $("#pro-step-3-btn").removeClass('btn-primary').addClass('btn-default');
	   $("#pro-step-1-btn").removeClass('btn-primary').addClass('btn-default');
	   $("#pro-step-4-btn").removeClass('btn-primary').addClass('btn-default');
	   $("#pro-step-6-btn").removeAttr('disabled');
	   $("#pro-step-5-btn").attr('disabled', 'disabled');
	   $("#pro-step-2-btn").attr('disabled', 'disabled');
	   $("#pro-step-2-btn").removeAttr('href');
	   $("#pro-step-3-btn").removeAttr('href');
	   $("#pro-step-4-btn").removeAttr('href');
		$("#project-step-2").css("display", "none");
		$("#project-step-3").css("display", "none");
		 $("#pro-step-1-btn").attr('disabled', 'disabled');
		 $("#pro-step-4-btn").attr('disabled', 'disabled');
	   $("#pro-step-1-btn").removeAttr('href');
	   $("#pro-step-4-btn").removeAttr('href');
	    $("#pro-step-3-btn").attr('disabled', 'disabled');
	   $("#pro-step-3-btn").removeAttr('href');
		$("#project-step-1").css("display", "none");
		$("#project-step-4").css("display", "none");
		$("#project-step-5").css("display", "none");
	   $("#project-step-6").css("display", "block");
	}
	
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
});

function saveAsDraft(pro_step)
{	
	var project_id = $('#ngo_project_id').val();
	var fd = new FormData($('#pro-edit-form-'+pro_step)[0]);
	
	fd.append('ngo_project_id',project_id);
	
	$.ajax({
	url: BASE_URL+'project/proEditForm'+pro_step,
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

$.validator.addMethod('proTotalCost', function(value, element, param) {
		value = value.replace(/\D/g, "");
      return parseInt(value) > parseInt($(param).val().replace(/\D/g, ""));
}, 'Total cost can not be lesser than or equal to donation amount');

$.validator.addMethod('proDonationAmt', function(value, element, param) {
		value = value.replace(/\D/g, "");
      return parseInt(value) < parseInt($(param).val().replace(/\D/g, ""));
}, 'Min donation amount can not be greater than or equal to total cost');

$.validator.addMethod("wordCount", function(value, element, wordCount) {
    return value.split(' ').length <= wordCount;
}, 'Exceeded word count');