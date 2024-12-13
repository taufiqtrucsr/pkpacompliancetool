$(document).ready(function(){
			$('#orgSector').multiselect({
				//search: true,
				//selectAll: true
				texts    : {
				placeholder: 'Select Sector/s',
			}
			});
			
			$('#primarySourceType').multiselect({
				//search: true,
				//selectAll: true
				texts    : {
					placeholder: 'Select primary source type',
				}
			});
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
					
					
	
	           $("#part_form_submit").click(function(){
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
			   
			   
                $('#org_name').change(function(){
      	               $('#orgname').toggle();
                });
				$('#org_logo').change(function(){
      	               $('#orglogo').toggle();
                });
				$('#org_add').change(function(){
      	                $('#orgadd1').toggle();
					   $('#orgadd2').toggle();
                });
				$('#pincode').change(function(){
      	               $('#org_pin_code').toggle();
                });
				$('#state').change(function(){
      	              $('#org_state').toggle();
                });
				$('#district').change(function(){
      	               $('#org_district').toggle();
                });
				$('#city').change(function(){
      	               $('#org_city').toggle();
                });
				$('#about_org').change(function(){
      	               $('#aboutorg').toggle();
                });
				$('#org_type').change(function(){
      	               $('#orgtype').toggle();
                });
				$('#loc_of_op').change(function(){
      	               $('#orgloc').toggle();
                });
				$('#date_of_incorp').change(function(){
      	               $('#orgincodate').toggle();
                });
				$('#sec_of_op').change(function(){
      	               $('#secofoperation').toggle();
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
				$('#certi_80g').change(function(){
      	               $('#80GCertificate').toggle();
                });
				$('#fcra_certi').change(function(){
      	               $('#fcraCertificate').toggle();
                });
				$('#certi_35ac').change(function(){
      	               $('#35acCertificate').toggle();
                });
				$('#certi_12a').change(function(){
      	               $('#12aCertificate').toggle();
                });
				
				$('#financial_reports').change(function(){
      	               $('#ngo-step-3').toggle();
                });
				
				//file upload fields end
				
				/* $('#ms-list-1').click(function(){
		        $('#proSector').valid();
				});
	
				$('#ms-list-2').click(function(){
				$('#proBeneficiary').valid();
				}); */
				console.log('js called ...');
				
				

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


				
				
				
				$("#ngoeditrequest-form-1").validate({
					
					ignore: ':hidden',
					rules: 
					{
						orgName: {
							required: function() {
							return $('[name="org_name_check"]:checked').val() == 1;
							},
							maxlength: 20
						 },
						 orgLogo: {
							required: function() {
							return $('[name="org_logo_check"]:checked').val() == 1;
							}, 
							minlength: 1
						},
						orgAddress1: {
							required: function() {
							return $('[name="org_add_check"]:checked').val() == 1;
							}, 
							maxlength: 300
						},
						orgAddress2: {
							required: function() {
							return $('[name="org_add_check"]:checked').val() == 1;
							}, 
							maxlength: 300
						},
						orgPincode: {
							required: function() {
							return $('[name="pincode_check"]:checked').val() == 1;
							},
							number: true,	
							minlength: 6,
							maxlength: 6
						},
						orgState: {
							required: function() {
							return $('[name="state_check"]:checked').val() == 1;
							},        
						},
						orgDistrict: {
							required: function() {
							return $('[name="district_check"]:checked').val() == 1; 
							},        
						},
						orgCity: {
							required:  function() {
							return $('[name="city_check"]:checked').val() == 1; 
							},        	      
						},
						orgAbout: {
						required:  function() {
							return $('[name="about_org_check"]:checked').val() == 1; 
							},        	      
						},
						orgType: {
							required: function() {
							return $('[name="org_type_check"]:checked').val() == 1;
							},        
						},
						orgLocation: {
							required: function() {
							return $('[name="loc_of_op_check"]:checked').val() == 1;
							},        
						},
						orgDateIncorporation: {
							required: function() {
							return $('[name="date_of_incorp_check"]:checked').val() == 1;
							},        
						},
						"orgSector[]": {
							required: function() {
							return $('[name="sec_of_op_check"]:checked').val() == 1;
							},
							minlength: 1
						},
						org_cin_file: {
							required: function() {
							return $('[name="inco_certi_check"]:checked').val() == 1;
							},
							
							extension: "jpg|jpeg|pdf|png" 
						},
						org_cin_number: {
							required: function() {
							return $('[name="inco_certi_check"]:checked').val() == 1;
							},
							
						},
						org_gst_file: {
							required: function() {
							return $('[name="gst_certi_check"]:checked').val() == 1;
							}, 
							extension: "jpg|jpeg|pdf|png" 		  
						},
						org_gst_number: {
							required: function() {
							return $('[name="gst_certi_check"]:checked').val() == 1;
							}, 		  
						},
						org_pan_file: {
							required: function() {
							return $('[name="pan_card_check"]:checked').val() == 1;
							},
							extension: "jpg|jpeg|pdf|png" 
						},
						org_pan_number: {
							required: function() {
							return $('[name="pan_card_check"]:checked').val() == 1;
							},
							minlength: 1
						},
						org_80g_file: {
							required: function() {
							return $('[name="certi_80g_check"]:checked').val() == 1;
							}, 
							extension: "jpg|jpeg|pdf|png" 
						},
						org_80g_number: {
							required: function() {
							return $('[name="certi_80g_check"]:checked').val() == 1;
							},
							minlength: 1
						},
						org_fcra_file: {
							required: function() {
							return $('[name="fcra_certi_check"]:checked').val() == 1;
							},
							extension: "jpg|jpeg|pdf|png" 
						},
						org_fcra_number: {
							required: function() {
							return $('[name="fcra_certi_check"]:checked').val() == 1;
							},
							
						},
						org_35ac_file: {
							required: function() {
							return $('[name="certi_35ac_check"]:checked').val() == 1;
							},
							extension: "jpg|jpeg|pdf|png" 
						},
						org_35ac_number: {
							required: function() {
							return $('[name="certi_35ac_check"]:checked').val() == 1;
							},
							
						},
						org_12a_file: {
							required: function() {
							return $('[name="certi_12a_check"]:checked').val() == 1;
							},
							extension: "jpg|jpeg|pdf|png" 
						},
						org_12a_number: {
							required: function() {
							return $('[name="certi_12a_check"]:checked').val() == 1;
							},
							
						},
						primarySourceType: {
						  required: false,        
						},
						org_year_1_file: {     
							required: false,               
							extension: "jpg|jpeg|pdf|png"        
						}, 
						year1_net_worth: {     
							required: false
						},
						year1_turnover: {     
							required: false   
						},
						year1_net_profit: {     
							required: false  
						},
						org_year_2_file: {     
							required: false,               
							extension: "jpg|jpeg|pdf|png"        
						}, 
						org_year_3_file: {     
							required: false,               
							extension: "jpg|jpeg|pdf|png"        
						}, 
						org_year_4_file: {     
							required: false,               
							extension: "jpg|jpeg|pdf|png"        
						}, 
						org_year_5_file: {     
							required: false,               
							extension: "jpg|jpeg|pdf|png"        
						}, 
						org_year_6_file: {     
							required: false,               
							extension: "jpg|jpeg|pdf|png"        
						}			
					},
					messages: {
						orgPincode: {
						  number: "Please enter only number.",
						  minlength: "Please enter at least 6 number.",
						  maxlength: "Please enter only 6 number."
						}
					},	
            submitHandler: function(form) { 
			
			var formData = new FormData($('#ngoeditrequest-form-1')[0]);
			
			var org_logo_file = $('#orgLogo').prop('files')[0];
			var org_cin_file = $('#org_cin_file').prop('files')[0];
			var org_gst_file = $('#org_gst_file').prop('files')[0];
			var org_pan_file = $('#org_pan_file').prop('files')[0];
			var org_80g_file = $('#org_80g_file').prop('files')[0];
			var org_fcra_file = $('#org_fcra_file').prop('files')[0];
			var org_35ac_file = $('#org_35ac_file').prop('files')[0];
			var org_12a_file = $('#org_12a_file').prop('files')[0];
			//console.log(org_logo_file); // undefined
			
			if(org_logo_file != "undefined")
			{
				formData.append('org_logo', org_logo_file);
			}
			else if(org_cin_file != "undefined")
			{
				formData.append('org_cin_file', org_cin_file);
			}
			else if(org_gst_file != "undefined")
			{
				formData.append('org_gst_file', org_gst_file);
			}
			else if(org_pan_file != "undefined")
			{
				formData.append('org_pan_file', org_pan_file);
			}
			else if(org_80g_file != "undefined")
			{
				formData.append('org_80g_file', org_80g_file);
				
			}else if(org_fcra_file != "undefined")
			{
				formData.append('org_fcra_file', org_fcra_file);
				
			}else if(org_35ac_file != "undefined")
			{
				formData.append('org_35ac_file', org_35ac_file);
				
			}else if(org_12a_file != "undefined")
			{
				formData.append('org_12a_file', org_12a_file);
			}
			
			
			//formData.append('file', $('input[type=file]')[0].files[0]);
			//var fd = new FormData($('ngoeditrequest-form-1')[0]);
			 
             var organization_id = $('#ngo_org_id').val();

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
                         //console.log("dhshdh");
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
 



