$(document).ready(function(){
	
	
				/* $('#proSector').multiselect({
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
						placeholder: 'Choose the beneficiarie/s',
						}
					}); */
					
					
	
	           $("#con_form_submit").click(function(){
					if ($('input:checkbox').filter(':checked').length < 1){
						//alert("Check at least one Checkbox!");
						$('#notification').css('display','block').delay(5000).fadeOut('slow');;
						return false;
					}
					else
					{
					   $("#edit-profile-step-1-btn").removeClass('btn-primary').addClass('btn-default');
					   $("#edit-profile-step-2-btn").removeClass('btn-default').addClass('btn-primary');
					   $("#edit-profile-step-1-btn").attr('disabled', 'disabled');
					   $("#edit-profile-step-2-btn").removeAttr('disabled');
					   $("#edit-profile-step-2-btn").attr('href', '#editproject-step-2');
					   $("#editprofile-step-1").css("display", "none");
					   $("#editprofile-step-2").css("display", "block");
					}
                 });
				 
				 
				$("input[name='proType']").change(function() {
					if(this.checked) {
						var val = $(this).val();
						//alert(val)
						if( val == 1){
							$('#proTargetBlock').hide();
							$('#proScheduleBlock').show();
							// $('#proDateFrom').valid();
							// $('#proDateTo').valid();
						}
			
						if( val == 2 ){
							$('#proTargetBlock').show();
							$('#proScheduleBlock').hide();
							// $('#proTarget').valid();
							// $('#proTargetText').valid();
							// $('#proTargetFrequency').valid();
						}
					}
				});
			   
			   
                $('#con_name').change(function(){
      	               $('#companyname').toggle();
                });
				$('#con_logo').change(function(){
      	               $('#companylogo').toggle();
                });
				$('#con_add').change(function(){
      	                $('#companyadd1').toggle();
					   $('#companyadd2').toggle();
                });
				$('#con_pincode').change(function(){
      	               $('#company_pin_code').toggle();
                });
				$('#con_state').change(function(){
      	              $('#company_state').toggle();
                });
				$('#con_district').change(function(){
      	               $('#company_district').toggle();
                });
				$('#con_city').change(function(){
      	               $('#company_city').toggle();
                });
				$('#con_org_type').change(function(){
      	               $('#company_org_type').toggle();
                });
				$('#con_about').change(function(){
      	               $('#aboutcompany').toggle();
                });
				
				
				//file upload fields start 
				
				$('#inco_certi').change(function(){
      	               $('#incorpCertificate').toggle();
                });
			
				$('#gst_certi').change(function(){
      	               $('#gstCertificate').toggle();
                });
				$('#pan_card').change(function(){
      	               $('#panCertificate').toggle();
                });
				
				
				//file upload fields end
				
				/* $('#ms-list-1').click(function(){
		        $('#proSector').valid();
				});
	
				$('#ms-list-2').click(function(){
				$('#proBeneficiary').valid();
				}); */
				console.log('contributor js called ...');
				
				

				/* if ($('#financial_reports').is(':checked')) {
					
					var org_year_1 = $('#org_year_1').val();
					
					if(org_year_1 != '')
					{ 
						$('.financial-table tr:eq(1) input[type=file]').attr('required',true);
						$('.financial-table tr:eq(1) input[type=text]').attr('required',true);
					}
					else{
						$('.financial-table tr:eq(1) input[type=file]').attr('required',false);
						$('.financial-table tr:eq(1) input[type=text]').attr('required',false);
						$('.financial-table tr:eq(1) input[type=file]').val('');
						$('.financial-table tr:eq(1) input[type=text]').val('');
					}
					
				
					//console.log(org_year_1);	
					
				} */


				
				
				
				$("#companyeditrequest-form-1").validate({
					
					ignore: ':hidden',
					rules: 
					{
						comName: {
							required: function() {
							return $('[name="con_name_check"]:checked').val() == 1;
							},
							maxlength: 20
						 },
						 comLogo: {
							required: function() {
							return $('[name="con_logo_check"]:checked').val() == 1;
							}, 
							extension: "jpg|jpeg|png"
						},
						comAddress1: {
							required: function() {
							return $('[name="con_add_check"]:checked').val() == 1;
							}, 
							maxlength: 300
						},
						comAddress2: {
							required: function() {
							return $('[name="con_add_check"]:checked').val() == 1;
							}, 
							maxlength: 300
						},
						comPincode: {
							required: function() {
							return $('[name="con_pincode_check"]:checked').val() == 1;
							},
							number: true,	
							minlength:6,
							maxlength: 6
						},
						comState: {
							required: function() {
							return $('[name="con_state_check"]:checked').val() == 1;
							},        
						},
						comDistrict: {
							required: function() {
							return $('[name="con_district_check"]:checked').val() == 1; 
							},        
						},
						comCity: {
							required:  function() {
							return $('[name="con_city_check"]:checked').val() == 1; 
							},        	      
						},
						comOrgType: {
							required:  function() {
							return $('[name="con_org_type_check"]:checked').val() == 1; 
							},        	      
						},
						comAbout: {
						required:  function() {
							return $('[name="con_about_check"]:checked').val() == 1; 
							},        	      
						},
						
						com_cin_file: {
							required: function() {
							return $('[name="con_inco_certi_check"]:checked').val() == 1;
							},
							
							extension: "jpg|jpeg|pdf|png" 
						},
						com_cin_number: {
							required: function() {
							return $('[name="con_inco_certi_check"]:checked').val() == 1;
							},
							
						},
						com_gst_file: {
							required: function() {
							return $('[name="con_gst_certi_check"]:checked').val() == 1;
							}, 
							extension: "jpg|jpeg|pdf|png" 		  
						},
						com_gst_number: {
							required: function() {
							return $('[name="con_gst_certi_check"]:checked').val() == 1;
							}, 		  
						},
						com_pan_file: {
							required: function() {
							return $('[name="con_pan_card_check"]:checked').val() == 1;
							},
							extension: "jpg|jpeg|pdf|png" 
						},
						com_pan_number: {
							required: function() {
							return $('[name="con_pan_card_check"]:checked').val() == 1;
							},
							minlength: 1
						}
						
					},
					messages: {
						comPincode: {
						  number: "Please enter only number.",
						  minlength: "Please enter at least 6 number.",
						  maxlength: "Please enter only 6 number."
						}
					},	
            submitHandler: function(form) { 
			
			var formData = new FormData($('#companyeditrequest-form-1')[0]);
			
			var com_logo_file = $('#comLogo').prop('files')[0];
			var com_cin_file = $('#com_cin_file').prop('files')[0];
			var com_gst_file = $('#com_gst_file').prop('files')[0];
			var com_pan_file = $('#com_pan_file').prop('files')[0];
			
			//console.log(org_logo_file); // undefined
			
			if(com_logo_file != "undefined")
			{
				formData.append('com_logo', com_logo_file);
			}
			else if(com_cin_file != "undefined")
			{
				formData.append('com_cin_file', com_cin_file);
			}
			else if(com_gst_file != "undefined")
			{
				formData.append('com_gst_file', com_gst_file);
			}
			else if(com_pan_file != "undefined")
			{
				formData.append('com_pan_file', com_pan_file);
			}
			
			
			//formData.append('file', $('input[type=file]')[0].files[0]);
			//var fd = new FormData($('ngoeditrequest-form-1')[0]);
			 
             var company_id = $('#company_id').val();
			 

             $.ajax({
                url: form.action,
                type: 'POST',
                method: form.method,
                dataType: 'json',
                contentType: false,
                processData: false,
                data:formData,       
                success: function(response) {
					console.log(response);
                    if(response.flag == 1){
                         //console.log("success");
						 //location.href = BASE_URL+'myprofile';
						 
                       $.toast({
						heading: '',
						text: response.msg,
						showHideTransition: 'slide',
						icon: 'success'
						})
					setTimeout(function() {
					
					window.location.href = BASE_URL+'myprofile';
					
					}, 3000);
					
								    

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
			
    		    
 });	
 



