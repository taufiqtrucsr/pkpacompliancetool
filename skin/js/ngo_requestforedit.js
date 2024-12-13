$(document).ready(function(){	
	$( "#request-edit-ngo-form").validate({

		ignore: ':hidden:not("#orgSector")',
    	rules: {   
		
			orgLogo: { 
                required: false,
                extension: "jpg|jpeg|png"
            },
    		orgName: {
          		required: true,
          	},
	        orgAddress1: {
	          required: true, 
	        },
			orgAddress2: {
	          required: true, 
	        },
			orgAddProof: {
                required: false,
                extension: "jpg|jpeg|pdf|png"
            },
	        orgCity: {
	          required: true,        
	        },
			orgDistrict: {
	          required: true,        
	        },
			orgPincode: {
	          required: true,        
	          number: true,
			  minlength: 6,
			  maxlength: 6	
	        },
			orgState: {
	          required: true,        
	        },
			orgType: {
	          required: true,        
	        },
			orgLocation: {
	          required: true,        
	        },
			orgDateIncorporation: {
	          required: true,        
	        },
			"orgSector[]": {
	          required: true,  
			  minlength: 1			  
	        },
			orgAbout: {
	          required: true,        
	        },
			 org_cin_file: {
                required: true,
                extension: "jpg|jpeg|pdf|png"
            },
            org_cin_number: {
                required: true,
                //regex_cin: /^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/
            },
			org_gst_file: {
                required:  function() {
					$org_gst_number = $("#org_gst_number").val();
					if($org_gst_number!=""){
						return true;
					}else{
						return false;
					}					
				},
                extension: "jpg|jpeg|pdf|png"
            },
            org_gst_number: {
                //regex_gst :/^([01-35]{2})([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})([1-9A-Z]{1})([zZ]{1})([0-9A-Z]{1})$/
				required:  function() {
					$org_gst_file = $("#org_gst_file").val();
					if($org_gst_file!=""){
						return true;
					}else{
						return false;
					}					
				},
				regex_gst :true
            },
            org_pan_file: {
                required: true,
                extension: "jpg|jpeg|pdf|png"
            },
            org_pan_number: { 
                required: true,
                regex_pan: /^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/
            },
			org_80g_file: {
				required:  function() {
					$org_80g_number = $("#org_80g_number").val();
					if($org_80g_number!=""){
						return true;
					}else{
						return false;
					}					
				}, 
                extension: "jpg|jpeg|pdf|png"
            },
            org_80g_number: { 
                required:  function() {
					$org_80g_file = $("#org_80g_file").val();
					if($org_80g_file!=""){
						return true;
					}else{
						return false;
					}					
				}, 
            },
			org_fcra_file: {
				required:  function() {
					$org_fcra_number = $("#org_fcra_number").val();
					if($org_fcra_number!=""){
						return true;
					}else{
						return false;
					}					
				},
                extension: "jpg|jpeg|pdf|png"
            },
			org_fcra_number:{
				required:  function() {
					$org_fcra_file = $("#org_fcra_file").val();
					if($org_fcra_file!=""){
						return true;
					}else{
						return false;
					}					
				}
			},
			org_35ac_file: {
                required:  function() {
					$org_35ac_number = $("#org_35ac_number").val();
					if($org_35ac_number!=""){
						return true;
					}else{
						return false;
					}					
				},
                extension: "jpg|jpeg|pdf|png"
            },
			org_35ac_number:{
				required:  function() {
					$org_35ac_file = $("#org_35ac_file").val();
					if($org_35ac_file!=""){
						return true;
					}else{
						return false;
					}					
				}
			},
			org_12a_file: {
                required: true,
                extension: "jpg|jpeg|pdf|png"
            },
            org_12a_number: { 
                required: true,
            },
			org_trustee_file: {
                required: true,
                extension: "jpg|jpeg|pdf|png"
            },
			csr_file: {
                required:  function() {
					$csr_number = $("#csr_number").val();
					if($csr_number!=""){
						return true;
					}else{
						return false;
					}					
				},
                extension: "jpg|jpeg|pdf|png"
            },
            csr_number: {
				required:  function() {
					$csr_file = $("#csr_file").val();
					if($csr_file!=""){
						return true;
					}else{
						return false;
					}					
				},
				number: true,
				regex_csr :/^[A-Za-z0-9]+$/
            },
            org_trustee_number: { 
                required: true,
            },
			primarySourceType: {
	          required: true,        
	        },
			org_year_1_file: {     
                // required:  function() {
				// 	/*dt1 = new Date($('#hiddenIncorporationDate').val());
				// 	dt2 = new Date('<?php echo date("Y,n,j"); ?>');
				// 	diff = diff_months(dt1, dt2);
				// 	if (diff < 18) {
				// 		return false;
				// 	} else {
				// 		return true;
				// 	}*/
				// 	return false;
				// },    
				required:  function() {
					$year1_turnover = $("#year1_turnover").val();
					$year1_net_profit = $("#year1_net_profit").val();
					$year1_net_worth = $("#year1_net_worth").val();
					if($year1_turnover!="" || $year1_net_profit!="" || $year1_net_worth!="" ){
						return true;
					}else{
						return false;
					}					
				},             
                extension: "jpg|jpeg|pdf|png"        
            }, 
			year1_net_worth: {     
                required:  function() {
					/*dt1 = new Date($('#hiddenIncorporationDate').val());
					dt2 = new Date('<?php echo date("Y,n,j"); ?>');
					diff = diff_months(dt1, dt2);
					if (diff < 18) {
						return false;
					} else {
						return true;
					}*/
					return false;
				}, 
				number: true
            },
			year1_turnover: {     
                // required:  function() {
				// 	/*dt1 = new Date($('#hiddenIncorporationDate').val());
				// 	dt2 = new Date('<?php echo date("Y,n,j"); ?>');
				// 	diff = diff_months(dt1, dt2);
				// 	if (diff < 18) {
				// 		return false;
				// 	} else {
				// 		return true;
				// 	}*/
				// 	return false;
				// }, 
				required:  function() {
					$year1_turnover = $("#year1_turnover").val();
					$year1_net_profit = $("#year1_net_profit").val();
					$org_year_1_file = $("#org_year_1_file").val();
					if($year1_turnover!="" || $year1_net_profit!="" || $org_year_1_file!=""){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true   
            },
			year1_net_profit: {     
                // required:  function() {
				// 	/*dt1 = new Date($('#hiddenIncorporationDate').val());
				// 	dt2 = new Date('<?php echo date("Y,n,j"); ?>');
				// 	diff = diff_months(dt1, dt2);
				// 	if (diff < 18) {
				// 		return false;
				// 	} else {
				// 		return true;
				// 	}*/
				// 	return false;
				// }, 
				required:  function() {
					$year1_net_worth = $("#year1_net_worth").val();
					$year1_turnover = $("#year1_turnover").val();
					$org_year_1_file = $("#org_year_1_file").val();
					if($year1_net_worth!="" || $year1_turnover!="" || $org_year_1_file!="" ){
						return true;
					}else{
						return false;
					}					
				},
				number: true  
            },
			org_year_2_file: {     
                required:  function() {
					$year2_turnover = $("#year2_turnover").val();
					$year2_net_profit = $("#year2_net_profit").val();
					$year2_net_worth = $("#year2_net_worth").val();
					if($year2_turnover!="" || $year2_net_profit!="" || $year2_net_worth!="" ){
						return true;
					}else{
						return false;
					}					
				},    //it was required:false,                 
                extension: "jpg|jpeg|pdf|png"        
            }, 
			// code srtart here
			year2_net_worth: {     
				required:  function() {
					$year2_turnover = $("#year2_turnover").val();
					$year2_net_profit = $("#year2_net_profit").val();
					$org_year_2_file = $("#org_year_2_file").val();
					if($year2_turnover!="" || $year2_net_profit!="" || $org_year_2_file!=""){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true
			},
			year2_turnover: {     
				required:  function() {
					$year2_net_worth = $("#year2_net_worth").val();
					$year2_net_profit = $("#year2_net_profit").val();
					$org_year_2_file = $("#org_year_2_file").val();
					if($year2_net_worth!="" || $year2_net_profit!="" || $org_year_2_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true   
			},
			year2_net_profit: {     
				required:  function() {
					$year2_net_worth = $("#year2_net_worth").val();
					$year2_turnover = $("#year2_turnover").val();
					$org_year_2_file = $("#org_year_2_file").val();
					if($year2_net_worth!="" || $year2_turnover!="" || $org_year_2_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true  
			},
			// code ends here
			org_year_3_file: {     
                required:  function() {
					$year3_turnover = $("#year3_turnover").val();
					$year3_net_profit = $("#year3_net_profit").val();
					$year3_net_worth = $("#year3_net_worth").val();
					if($year3_turnover!="" || $year3_net_profit!="" || $year3_net_worth!="" ){
						return true;
					}else{
						return false;
					}					
				},               
                extension: "jpg|jpeg|pdf|png"        
            }, 
			// code start here
			year3_net_worth: {     
				required:  function() {
					$year3_turnover = $("#year3_turnover").val();
					$year3_net_profit = $("#year3_net_profit").val();
					$org_year_3_file = $("#org_year_3_file").val();
					if($year3_turnover!="" || $year3_net_profit!="" || $org_year_3_file!=""){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true
			},
			year3_turnover: {     
				required:  function() {
					$year3_net_worth = $("#year3_net_worth").val();
					$year3_net_profit = $("#year3_net_profit").val();
					$org_year_3_file = $("#org_year_3_file").val();
					if($year3_net_worth!="" || $year3_net_profit!="" || $org_year_3_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true   
			},
			year3_net_profit: {     
				required:  function() {
					$year3_net_worth = $("#year3_net_worth").val();
					$year3_turnover = $("#year3_turnover").val();
					$org_year_3_file = $("#org_year_3_file").val();
					if($year3_net_worth!="" || $year3_turnover!="" || $org_year_3_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true  
			},
			// code ends here
			org_year_4_file: {     
				required:  function() {
					$year4_turnover = $("#year4_turnover").val();
					$year4_net_profit = $("#year4_net_profit").val();
					$year4_net_worth = $("#year4_net_worth").val();
					if($year4_turnover!="" || $year4_net_profit!="" || $year4_net_worth!="" ){
						return true;
					}else{
						return false;
					}					
				},                 
                extension: "jpg|jpeg|pdf|png"        
            }, 
			// code start here
			year4_net_worth: {     
				required:  function() {
					$year4_turnover = $("#year4_turnover").val();
					$year4_net_profit = $("#year4_net_profit").val();
					$org_year_4_file = $("#org_year_4_file").val();
					if($year4_turnover!="" || $year4_net_profit!="" || $org_year_4_file!=""){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true
			},
			year4_turnover: {     
				required:  function() {
					$year4_net_worth = $("#year4_net_worth").val();
					$year4_net_profit = $("#year4_net_profit").val();
					$org_year_4_file = $("#org_year_4_file").val();
					if($year4_net_worth!="" || $year4_net_profit!="" || $org_year_4_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true   
			},
			year4_net_profit: {     
				required:  function() {
					$year4_net_worth = $("#year4_net_worth").val();
					$year4_turnover = $("#year4_turnover").val();
					$org_year_4_file = $("#org_year_4_file").val();
					if($year4_net_worth!="" || $year4_turnover!="" || $org_year_4_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true  
			},
			// code ends here
			org_year_5_file: {     
				required:  function() {
					$year5_turnover = $("#year5_turnover").val();
					$year5_net_profit = $("#year5_net_profit").val();
					$year5_net_worth = $("#year5_net_worth").val();
					if($year5_turnover!="" || $year5_net_profit!="" || $year5_net_worth!="" ){
						return true;
					}else{
						return false;
					}					
				},                  
                extension: "jpg|jpeg|pdf|png"        
            }, 
			// code start here
			year5_net_worth: {     
				required:  function() {
					$year5_turnover = $("#year5_turnover").val();
					$year5_net_profit = $("#year5_net_profit").val();
					$org_year_5_file = $("#org_year_5_file").val();
					if($year5_turnover!="" || $year5_net_profit!="" || $org_year_5_file!=""){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true
			},
			year5_turnover: {     
				required:  function() {
					$year5_net_worth = $("#year5_net_worth").val();
					$year5_net_profit = $("#year5_net_profit").val();
					$org_year_5_file = $("#org_year_5_file").val();
					if($year5_net_worth!="" || $year5_net_profit!="" || $org_year_5_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true   
			},
			year5_net_profit: {     
				required:  function() {
					$year5_net_worth = $("#year5_net_worth").val();
					$year5_turnover = $("#year5_turnover").val();
					$org_year_5_file = $("#org_year_5_file").val();
					if($year5_net_worth!="" || $year5_turnover!="" || $org_year_5_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true  
			},
			//code ends here
			org_year_6_file: {     
                required:  function() {
					$year6_turnover = $("#year6_turnover").val();
					$year6_net_profit = $("#year6_net_profit").val();
					$year6_net_worth = $("#year6_net_worth").val();
					if($year6_turnover!="" || $year6_net_profit!="" || $year6_net_worth!="" ){
						return true;
					}else{
						return false;
					}					
				},                  
                extension: "jpg|jpeg|pdf|png"        
            },
			// code start here
			year6_net_worth: {     
				required:  function() {
					$year6_turnover = $("#year6_turnover").val();
					$year6_net_profit = $("#year6_net_profit").val();
					$org_year_6_file = $("#org_year_6_file").val();
					if($year6_turnover!="" || $year6_net_profit!="" || $org_year_6_file!=""){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true
			},
			year6_turnover: {     
				required:  function() {
					$year6_net_worth = $("#year6_net_worth").val();
					$year6_net_profit = $("#year6_net_profit").val();
					$org_year_6_file = $("#org_year_6_file").val();
					if($year6_net_worth!="" || $year6_net_profit!="" || $org_year_6_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true   
			},
			year6_net_profit: {     
				required:  function() {
					$year6_net_worth = $("#year6_net_worth").val();
					$year6_turnover = $("#year6_turnover").val();
					$org_year_6_file = $("#org_year_6_file").val();
					if($year6_net_worth!="" || $year6_turnover!="" || $org_year_6_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true  
			},
			// code ends here
			"fullName[]": {
				required: true,
	        },
			"email[]": {
				required: true,
				email:true
	        },
			"contactNo[]": {
				required: true,
				digits: true,
                minlength: 10,
                minlength: 10
	        },
			"photograph[]": {
				//required: true,
	        },
    	},
		messages: {
			orgPincode: {
			  number: "Please enter only number.",
			  minlength: "Please enter at least 6 number.",
			  maxlength: "Please enter only 6 number."
			}
		},
    	submitHandler: function(form) { 		

    		var fd = new FormData($('#request-edit-ngo-form')[0]);
    		var files = $('#orgLogo')[0].files[0];
			
    		var files2 = $('#orgAddProof')[0].files[0];
			var files3 = $('#org_cin_file')[0].files[0];
            var files4 = $('#org_gst_file')[0].files[0];
            var files5 = $('#org_pan_file')[0].files[0];
			
			var files6 = $('#org_80g_file')[0].files[0];
			var files7 = $('#org_fcra_file')[0].files[0];
			var files8 = $('#org_35ac_file')[0].files[0];
			var files9 = $('#org_12a_file')[0].files[0];           
			var files10 = $('#org_trustee_file')[0].files[0];  
			
			fd.append('orgLogo',files);
        	fd.append('orgAddProof',files2);
			fd.append('org_cin_file',files3);
            fd.append('org_gst_file',files4);
            fd.append('org_pan_file',files5);
			
			fd.append('org_80g_file',files6);
			fd.append('org_fcra_file',files7);
			fd.append('org_35ac_file',files8);
			fd.append('org_12a_file',files9);      
			fd.append('org_trustee_file',files10); 
			
			var files11 = $('#org_year_1_file')[0].files[0];        
			var files12 = $('#org_year_2_file')[0].files[0];       
			var files13 = $('#org_year_3_file')[0].files[0];		
			var files14 = $('#org_year_4_file')[0].files[0];	
			var files15 = $('#org_year_5_file')[0].files[0];	
			var files16 = $('#org_year_6_file')[0].files[0];    
			
			fd.append('org_year_1_file',files11);       
            fd.append('org_year_2_file',files12);          
            fd.append('org_year_3_file',files13);			
            fd.append('org_year_4_file',files14);		
            fd.append('org_year_5_file',files15);	
            fd.append('org_year_6_file',files16); 
			
			var deleted_member_ids='';
			if($('#deleted_member_ids').val() !=''){
				var deleted_member_ids=$('#deleted_member_ids').val().split(',');
				$.each(deleted_member_ids,function(i){
				   deleted_member_ids[i];
				});
			}
			
			fd.append('deleted_member_ids',deleted_member_ids);
      
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
					$.toast({
					heading: '',
					text: response.msg,
					showHideTransition: 'slide',
					icon: 'success'
				})
				setTimeout(function() {
					window.location.href = BASE_URL+'ngo/view';
			   
				}, 1000); 

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
	
	// $('#request-edit-step-1-btn').click(function(){
		// //alert(535435);
		
		// isValid = $('#orgName').valid();
		// isValidAdd1 = $('#orgAddress1').valid();
		// isValidAdd2 = $('#orgAddress2').valid();
		// isValidProof = $('#orgAddProof').valid();
		// isValidCity = $('#orgCity').valid();
		// isValidDistrict = $('#orgDistrict').valid();
		// isValidPincode = $('#orgPincode').valid();
		// isValidState = $('#orgState').valid();
		// isValid = $('#orgType').valid();
		// isValidLocation = $('#orgLocation').valid();
		// isValid = $('#orgDateIncorporation').valid();
		// isValidSector = $('#orgSector').valid();
		// isValidAbout = $('#orgAbout').valid();
		
		// if(isValidAdd1 && isValidAdd2 && isValidProof && isValidCity && isValidDistrict && isValidPincode && isValidState && isValidLocation && isValidSector && isValidAbout){
			// $("#ngo-step-1-btn").removeClass('btn-primary btn-default').addClass('btn-complete');
			// $("#ngo-step-2-btn").removeClass('btn-default btn-complete').addClass('btn-primary');
			// $("#ngo-step-1-btn").attr('disabled', 'disabled');
			// $("#ngo-step-2-btn").removeAttr('disabled');
			// $("#ngo-step-1").css("display", "none");
			// // $("#ngo-step-1").css("height", 0);
			// //$("#ngo-step-1").css("display", "flex");
			// $("#ngo-step-2").css("display", "block");
			   
			// var noHashURL = window.location.href.replace(/#.*$/, '');

			// setTimeout(function() {
				// window.location.href =noHashURL+'#ngo-step-2/';
			// });
		// }
		// console.info($('#request-edit-ngo-form').valid());
		
	// }); 
	
	// $('#request-edit-step-2-btn').click(function(){
		// //alert(22222222);
		
		// isValidCINFile = $('#org_cin_file').valid();
		// isValidCINNumber = $('#org_cin_number').valid();
		// isValidGSTFile = $('#org_gst_file').valid();
		// isValidGSTNumber = $('#org_gst_number').valid();
		// isValid = $('#org_pan_file').valid();
		// isValid = $('#org_pan_number').valid();
		// isValid80GFile = $('#org_80g_file').valid();
		// isValid80GNumber = $('#org_80g_number').valid();
		// isValidFCRAFile = $('#org_fcra_file').valid();
		// isValid34ACFile = $('#org_35ac_file').valid();
		// isValid = $('#org_12a_file').valid();
		// isValid = $('#org_12a_number').valid();
		// isValid = $('#org_trustee_file').valid();
		// isValidNumber = $('#org_trustee_number').valid();
		
		// if(isValidGSTFile && isValidGSTNumber && isValid80GFile && isValid80GNumber && isValidFCRAFile && isValid34ACFile && isValidNumber){
			// $("#ngo-step-2-btn").removeClass('btn-primary btn-default').addClass('btn-complete');
			// $("#ngo-step-3-btn").removeClass('btn-default btn-complete').addClass('btn-primary');
			// $("#ngo-step-2-btn").attr('disabled', 'disabled');
			// $("#ngo-step-3-btn").removeAttr('disabled');
			// $("#ngo-step-2").css("display", "none");
			// $("#ngo-step-3").css("display", "block");

			// var noHashURL = window.location.href.replace(/#.*$/, '');

			// setTimeout(function() {
					// window.location.href =noHashURL+'#ngo-step-3/';
			// });
		// }
		// console.info($('#request-edit-ngo-form').valid());
		
	// });

	// $('#request-edit-step-3-btn').click(function(){
		// //alert(33333333333);
		
		// isValidType = $('#primarySourceType').valid();
		// isValidY1File = $('#org_year_1_file').valid();
		// isValidY1NW = $('#year1_net_worth').valid();
		// isValidY1T = $('#year1_turnover').valid();
		// isValidY1NP = $('#year1_net_profit').valid();
		// isValidY2File = $('#org_year_2_file').valid();
		// isValidY3File = $('#org_year_3_file').valid();
		// isValidY4File = $('#org_year_4_file').valid();
		// isValidY5File = $('#org_year_5_file').valid();
		// isValidY6File = $('#org_year_6_file').valid();
		
		// if(isValidType && isValidY1File && isValidY1NW && isValidY1T && isValidY1NP && isValidY2File && isValidY3File && isValidY4File && isValidY5File && isValidY6File){
			// $("#ngo-step-3-btn").removeClass('btn-primary btn-default').addClass('btn-complete');
			// $("#ngo-step-4-btn").removeClass('btn-default btn-complete').addClass('btn-primary');
			// $("#ngo-step-3-btn").attr('disabled', 'disabled');
			// $("#ngo-step-4-btn").removeAttr('disabled');
			// $("#ngo-step-3").css("display", "none");
			// $("#ngo-step-4").css("display", "block");

			// var noHashURL = window.location.href.replace(/#.*$/, '');

			// setTimeout(function() {
					// window.location.href =noHashURL+'#ngo-step-4/';
			// });
		// }
		// console.info($('#request-edit-ngo-form').valid());
		
	// });
	
	// $('#request-edit-step-4-btn').click(function(){
		// //alert(44444444);
		
		// isValidName = $("input[name='fullName[]']").valid();
		// isValidEmail = $("[name='email[]']").valid();
		// isValidContact = $("[name='contactNo[]']").valid();
		
		// console.info($('#request-edit-ngo-form').valid());
		
	// });
	
	
	$( "#request-edit-ngo-form-1").validate({

		ignore: ':hidden:not("#orgSector")',
    	rules: {   
		
			orgLogo: { 
                required: false,
                extension: "jpg|jpeg|png"
            },
    		orgName: {
          		required: true,
          	},
	        orgAddress1: {
	          required: true, 
	        },
			orgAddress2: {
	          required: true, 
	        },
			/*orgWebsite: {
	          required: false, 
			  url: true
	        },*/
			orgAddProof: {
                required: false,
                extension: "jpg|jpeg|pdf|png"
            },
	        orgCity: {
	          required: true,        
	        },
			orgDistrict: {
	          required: true,        
	        },
			orgPincode: {
	          required: true,        
	          number: true,
			  minlength: 6,
			  maxlength: 6	
	        },
			orgState: {
	          required: true,        
	        },
			orgType: {
	          required: true,        
	        },
			orgLocation: {
	          required: true,        
	        },
			orgDateIncorporation: {
	          required: true,        
	        },
			"orgSector[]": {
	          required: true,        
	        },
			orgAbout: {
	          required: true,        
	        },
    	},
		messages: {
			orgPincode: {
			  number: "Please enter only number.",
			  minlength: "Please enter at least 6 number.",
			  maxlength: "Please enter only 6 number."
			}
		},
    	submitHandler: function(form) { 		

    		var fd = new FormData($('#request-edit-ngo-form-1')[0]);
    		var files = $('#orgLogo')[0].files[0];
    		var files2 = $('#orgAddProof')[0].files[0];
      
        	fd.append('orgLogo',files);
        	fd.append('orgAddProof',files2);

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
                   $("#ngo-step-1-btn").removeClass('btn-primary btn-default').addClass('btn-complete');
                   $("#ngo-step-2-btn").removeClass('btn-default btn-complete').addClass('btn-primary');
                   $("#ngo-step-1-btn").attr('disabled', 'disabled');
                   $("#ngo-step-2-btn").removeAttr('disabled');
                   $("#ngo-step-1").css("display", "none");
                  // $("#ngo-step-1").css("height", 0);
                   //$("#ngo-step-1").css("display", "flex");
                   $("#ngo-step-2").css("display", "block");
                       
                   var noHashURL = window.location.href.replace(/#.*$/, '');

				   setTimeout(function() {
							window.location.href =noHashURL+'#ngo-step-2/';
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
	
	
	$("#request-edit-ngo-form-2").validate({
        ignore: ":hidden",
        rules: {
            org_cin_file: {
                required: true,
                extension: "jpg|jpeg|pdf|png"
            },
            org_cin_number: {
                required: true,
                //regex_cin: /^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/
            },
			org_gst_file: {
                // required: false,
				required:  function() {
					$org_gst_number = $("#org_gst_number").val();
					if($org_gst_number!=""){
						return true;
					}else{
						return false;
					}					
				},
                extension: "jpg|jpeg|pdf|png"
            },
            org_gst_number: {
                //regex_gst :/^([01-35]{2})([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})([1-9A-Z]{1})([zZ]{1})([0-9A-Z]{1})$/
				// required: false,
				required:  function() {
					$org_gst_file = $("#org_gst_file").val();
					if($org_gst_file!=""){
						return true;
					}else{
						return false;
					}					
				},  
				regex_gst :true
				
            },
            org_pan_file: {
                required: true,
                extension: "jpg|jpeg|pdf|png"
            },
            org_pan_number: { 
                required: true,
                regex_pan: /^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/
            },
			org_80g_file: {
                // required: false,
				required:  function() {
					$org_80g_number = $("#org_80g_number").val();
					if($org_80g_number!=""){
						return true;
					}else{
						return false;
					}					
				},  
                extension: "jpg|jpeg|pdf|png"
            },
            org_80g_number: { 
                // required: false,
				required:  function() {
					$org_80g_file = $("#org_80g_file").val();
					if($org_80g_file!=""){
						return true;
					}else{
						return false;
					}					
				}, 
            },
			org_fcra_file: {
                required:  function() {
					$org_fcra_number = $("#org_fcra_number").val();
					if($org_fcra_number!=""){
						return true;
					}else{
						return false;
					}					
				},
                extension: "jpg|jpeg|pdf|png"
            },
			org_fcra_number:{
				required:  function() {
					$org_fcra_file = $("#org_fcra_file").val();
					if($org_fcra_file!=""){
						return true;
					}else{
						return false;
					}					
				}
			},
			org_35ac_file: {
				required:  function() {
					$org_35ac_number = $("#org_35ac_number").val();
					if($org_35ac_number!=""){
						return true;
					}else{
						return false;
					}					
				},
                extension: "jpg|jpeg|pdf|png"
            },
			org_35ac_number:{
				required:  function() {
					$org_35ac_file = $("#org_35ac_file").val();
					if($org_35ac_file!=""){
						return true;
					}else{
						return false;
					}					
				}
			},
			org_12a_file: {
                required: true,
                extension: "jpg|jpeg|pdf|png"
            },
            org_12a_number: { 
                required: true,
            },
			org_12a_start_date:{
				required:true,
			},
			org_12a_end_date:{
				required:true,
			},
			org_trustee_file: {
                required: true,
                extension: "jpg|jpeg|pdf|png"
            },
            org_trustee_number: { 
                required: true,
            },
			officialseal_file: {
                required: true,
                extension: "jpg|jpeg|pdf|png",
            },
			signature_file: {
                required: true,
                extension: "jpg|jpeg|pdf|png"
            },
			csr_file: {
				required:  function() {
					$csr_number = $("#csr_number").val();
					if($csr_number!=""){
						return true;
					}else{
						return false;
					}					
				},
                extension: "jpg|jpeg|pdf|png"
            },
            csr_number: {
				required:  function() {
					$csr_file = $("#csr_file").val();
					if($csr_file!=""){
						return true;
					}else{
						return false;
					}					
				},
				regex_csr :/^[A-Za-z0-9]+$/
            }
			// csr_file: {
            //     required: true,
            //     extension: "jpg|jpeg|pdf|png"
            // },
            // csr_number: {
			// 	required: true,
			// 	regex_csr :/^[A-Za-z0-9]+$/
            // }
        }, 
        submitHandler: function(form) { 
			
			var fd = new FormData($('#request-edit-ngo-form-2')[0]);
            var files = $('#org_cin_file')[0].files[0];
            var files2 = $('#org_gst_file')[0].files[0];
            var files3 = $('#org_pan_file')[0].files[0];
			
			var files4 = $('#org_80g_file')[0].files[0];
			var files5 = $('#org_fcra_file')[0].files[0];
			var files6 = $('#org_35ac_file')[0].files[0];
			var files7 = $('#org_12a_file')[0].files[0];           
			var files8 = $('#org_trustee_file')[0].files[0];           
			var files9 = $('#officialseal_file')[0].files[0];           
			var files10 = $('#signature_file')[0].files[0];           
			var files11 = $('#csr_file')[0].files[0];           
      
            fd.append('org_cin_file',files);
            fd.append('org_gst_file',files2);
            fd.append('org_pan_file',files3);
			
			fd.append('org_80g_file',files4);
			fd.append('org_fcra_file',files5);
			fd.append('org_35ac_file',files6);
			fd.append('org_12a_file',files7);      
			fd.append('org_trustee_file',files8);      
			fd.append('officialseal_file',files9);      
			fd.append('signature_file',files10);      
			fd.append('csr_file',files11);      

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

                        $("#ngo-step-2-btn").removeClass('btn-primary btn-default').addClass('btn-complete');
					    $("#ngo-step-3-btn").removeClass('btn-default btn-complete').addClass('btn-primary');
					    $("#ngo-step-2-btn").attr('disabled', 'disabled');
					    $("#ngo-step-3-btn").removeAttr('disabled');
					    $("#ngo-step-2").css("display", "none");
					    $("#ngo-step-3").css("display", "block");

						var noHashURL = window.location.href.replace(/#.*$/, '');

                        setTimeout(function() {
                                window.location.href =noHashURL+'#ngo-step-3/';
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
	
	$("#request-edit-ngo-form-3").validate({   
        ignore: ":hidden",   
         rules: { 
			primarySourceType: {
	          required: false,        
	        },
			org_year_1_file: {     
                // required:  function() {
				// 	/*dt1 = new Date($('#hiddenIncorporationDate').val());
				// 	dt2 = new Date('<?php echo date("Y,n,j"); ?>');
				// 	diff = diff_months(dt1, dt2);
				// 	if (diff < 18) {
				// 		return false;
				// 	} else {
				// 		return true;
				// 	}*/
				// 	return false;
				// },      
				required:  function() {
					$year1_turnover = $("#year1_turnover").val();
					$year1_net_profit = $("#year1_net_profit").val();
					$year1_net_worth = $("#year1_net_worth").val();
					if($year1_turnover!="" || $year1_net_profit!="" || $year1_net_worth!="" ){
						return true;
					}else{
						return false;
					}					
				},          
                extension: "jpg|jpeg|pdf|png"        
            }, 
			year1_net_worth: {     
                // required:  function() {
				// 	/*dt1 = new Date($('#hiddenIncorporationDate').val());
				// 	dt2 = new Date('<?php echo date("Y,n,j"); ?>');
				// 	diff = diff_months(dt1, dt2);
				// 	if (diff < 18) {
				// 		return false;
				// 	} else {
				// 		return true;
				// 	}*/
				// 	return false;
				// }, 
				required:  function() {
					$year1_turnover = $("#year1_turnover").val();
					$year1_net_profit = $("#year1_net_profit").val();
					$org_year_1_file = $("#org_year_1_file").val();
					if($year1_turnover!="" || $year1_net_profit!="" || $org_year_1_file!=""){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true
            },
			year1_turnover: {     
                // required:  function() {
				// 	/*dt1 = new Date($('#hiddenIncorporationDate').val());
				// 	dt2 = new Date('<?php echo date("Y,n,j"); ?>');
				// 	diff = diff_months(dt1, dt2);
				// 	if (diff < 18) {
				// 		return false;
				// 	} else {
				// 		return true;
				// 	}*/
				// 	return false;
				// }, code commend on 17th august
				required:  function() {
					$year1_net_worth = $("#year1_net_worth").val();
					$year1_net_profit = $("#year1_net_profit").val();
					$org_year_1_file = $("#org_year_1_file").val();
					if($year1_net_worth!="" || $year1_net_profit!="" || $org_year_1_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true   
            },
			year1_net_profit: {     
                // required:  function() {
				// 	/*dt1 = new Date($('#hiddenIncorporationDate').val());
				// 	dt2 = new Date('<?php echo date("Y,n,j"); ?>');
				// 	diff = diff_months(dt1, dt2);
				// 	if (diff < 18) {
				// 		return false;
				// 	} else {
				// 		return true;
				// 	}*/
				// 	return false;
				// }, code commented on 17 august 2022
				required:  function() {
					$year1_net_worth = $("#year1_net_worth").val();
					$year1_turnover = $("#year1_turnover").val();
					$org_year_1_file = $("#org_year_1_file").val();
					if($year1_net_worth!="" || $year1_turnover!="" || $org_year_1_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true  
            },
			org_year_2_file: {     
                required:  function() {
					$year2_turnover = $("#year2_turnover").val();
					$year2_net_profit = $("#year2_net_profit").val();
					$year2_net_worth = $("#year2_net_worth").val();
					if($year2_turnover!="" || $year2_net_profit!="" || $year2_net_worth!="" ){
						return true;
					}else{
						return false;
					}					
				},                 
                extension: "jpg|jpeg|pdf|png"        
            }, 
			// code srtart here
			year2_net_worth: {     
				required:  function() {
					$year2_turnover = $("#year2_turnover").val();
					$year2_net_profit = $("#year2_net_profit").val();
					$org_year_2_file = $("#org_year_2_file").val();
					if($year2_turnover!="" || $year2_net_profit!="" || $org_year_2_file!=""){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true
			},
			year2_turnover: {     
				required:  function() {
					$year2_net_worth = $("#year2_net_worth").val();
					$year2_net_profit = $("#year2_net_profit").val();
					$org_year_2_file = $("#org_year_2_file").val();
					if($year2_net_worth!="" || $year2_net_profit!="" || $org_year_2_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true   
			},
			year2_net_profit: {     
				required:  function() {
					$year2_net_worth = $("#year2_net_worth").val();
					$year2_turnover = $("#year2_turnover").val();
					$org_year_2_file = $("#org_year_2_file").val();
					if($year2_net_worth!="" || $year2_turnover!="" || $org_year_2_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true  
			},
			// code ends here
			org_year_3_file: {     
                required:  function() {
					$year3_turnover = $("#year3_turnover").val();
					$year3_net_profit = $("#year3_net_profit").val();
					$year3_net_worth = $("#year3_net_worth").val();
					if($year3_turnover!="" || $year3_net_profit!="" || $year3_net_worth!="" ){
						return true;
					}else{
						return false;
					}					
				},                
                extension: "jpg|jpeg|pdf|png"        
            }, 
			// code start here
			year3_net_worth: {     
				required:  function() {
					$year3_turnover = $("#year3_turnover").val();
					$year3_net_profit = $("#year3_net_profit").val();
					$org_year_3_file = $("#org_year_3_file").val();
					if($year3_turnover!="" || $year3_net_profit!="" || $org_year_3_file!=""){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true
			},
			year3_turnover: {     
				required:  function() {
					$year3_net_worth = $("#year3_net_worth").val();
					$year3_net_profit = $("#year3_net_profit").val();
					$org_year_3_file = $("#org_year_3_file").val();
					if($year3_net_worth!="" || $year3_net_profit!="" || $org_year_3_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true   
			},
			year3_net_profit: {     
				required:  function() {
					$year3_net_worth = $("#year3_net_worth").val();
					$year3_turnover = $("#year3_turnover").val();
					$org_year_3_file = $("#org_year_3_file").val();
					if($year3_net_worth!="" || $year3_turnover!="" || $org_year_3_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true  
			},
			// code ends here
			org_year_4_file: {     
                required:  function() {
					$year4_turnover = $("#year4_turnover").val();
					$year4_net_profit = $("#year4_net_profit").val();
					$year4_net_worth = $("#year4_net_worth").val();
					if($year4_turnover!="" || $year4_net_profit!="" || $year4_net_worth!="" ){
						return true;
					}else{
						return false;
					}					
				},                 
                extension: "jpg|jpeg|pdf|png"        
            }, 
			// code start here
			year4_net_worth: {     
				required:  function() {
					$year4_turnover = $("#year4_turnover").val();
					$year4_net_profit = $("#year4_net_profit").val();
					$org_year_4_file = $("#org_year_4_file").val();
					if($year4_turnover!="" || $year4_net_profit!="" || $org_year_4_file!=""){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true
			},
			year4_turnover: {     
				required:  function() {
					$year4_net_worth = $("#year4_net_worth").val();
					$year4_net_profit = $("#year4_net_profit").val();
					$org_year_4_file = $("#org_year_4_file").val();
					if($year4_net_worth!="" || $year4_net_profit!="" || $org_year_4_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true   
			},
			year4_net_profit: {     
				required:  function() {
					$year4_net_worth = $("#year4_net_worth").val();
					$year4_turnover = $("#year4_turnover").val();
					$org_year_4_file = $("#org_year_4_file").val();
					if($year4_net_worth!="" || $year4_turnover!="" || $org_year_4_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true  
			},
			// code ends here
			org_year_5_file: {     
                required:  function() {
					$year5_turnover = $("#year5_turnover").val();
					$year5_net_profit = $("#year5_net_profit").val();
					$year5_net_worth = $("#year5_net_worth").val();
					if($year5_turnover!="" || $year5_net_profit!="" || $year5_net_worth!="" ){
						return true;
					}else{
						return false;
					}					
				},                   
                extension: "jpg|jpeg|pdf|png"        
            }, 
			// code start here
			year5_net_worth: {     
				required:  function() {
					$year5_turnover = $("#year5_turnover").val();
					$year5_net_profit = $("#year5_net_profit").val();
					$org_year_5_file = $("#org_year_5_file").val();
					if($year5_turnover!="" || $year5_net_profit!="" || $org_year_5_file!=""){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true
			},
			year5_turnover: {     
				required:  function() {
					$year5_net_worth = $("#year5_net_worth").val();
					$year5_net_profit = $("#year5_net_profit").val();
					$org_year_5_file = $("#org_year_5_file").val();
					if($year5_net_worth!="" || $year5_net_profit!="" || $org_year_5_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true   
			},
			year5_net_profit: {     
				required:  function() {
					$year5_net_worth = $("#year5_net_worth").val();
					$year5_turnover = $("#year5_turnover").val();
					$org_year_5_file = $("#org_year_5_file").val();
					if($year5_net_worth!="" || $year5_turnover!="" || $org_year_5_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true  
			},
			//code ends here
			org_year_6_file: {     
                required:  function() {
					$year6_turnover = $("#year6_turnover").val();
					$year6_net_profit = $("#year6_net_profit").val();
					$year6_net_worth = $("#year6_net_worth").val();
					if($year6_turnover!="" || $year6_net_profit!="" || $year6_net_worth!="" ){
						return true;
					}else{
						return false;
					}					
				},    
                extension: "jpg|jpeg|pdf|png"        
            },
			// code start here
			year6_net_worth: {     
				required:  function() {
					$year6_turnover = $("#year6_turnover").val();
					$year6_net_profit = $("#year6_net_profit").val();
					$org_year_6_file = $("#org_year_6_file").val();
					if($year6_turnover!="" || $year6_net_profit!="" || $org_year_6_file!=""){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true
			},
			year6_turnover: {     
				required:  function() {
					$year6_net_worth = $("#year6_net_worth").val();
					$year6_net_profit = $("#year6_net_profit").val();
					$org_year_6_file = $("#org_year_6_file").val();
					if($year6_net_worth!="" || $year6_net_profit!="" || $org_year_6_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true   
			},
			year6_net_profit: {     
				required:  function() {
					$year6_net_worth = $("#year6_net_worth").val();
					$year6_turnover = $("#year6_turnover").val();
					$org_year_6_file = $("#org_year_6_file").val();
					if($year6_net_worth!="" || $year6_turnover!="" || $org_year_6_file!="" ){
						return true;
					}else{
						return false;
					}					
				}, 
				number: true  
			},
			// code ends here
        },       
        submitHandler: function(form) { 		
    	var fd = new FormData($('#request-edit-ngo-form-3')[0]);       

        var files = $('#org_year_1_file')[0].files[0];        
        var files2 = $('#org_year_2_file')[0].files[0];       
        var files3 = $('#org_year_3_file')[0].files[0];		
        var files4 = $('#org_year_4_file')[0].files[0];	
        var files5 = $('#org_year_5_file')[0].files[0];	
        var files6 = $('#org_year_6_file')[0].files[0];               
           fd.append('org_year_1_file',files);       
            fd.append('org_year_2_file',files2);          
            fd.append('org_year_3_file',files3);			
            fd.append('org_year_4_file',files4);		
            fd.append('org_year_5_file',files5);	
            fd.append('org_year_6_file',files6);     
            
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
                            $("#ngo-step-3-btn").removeClass('btn-primary btn-default').addClass('btn-complete');
							$("#ngo-step-4-btn").removeClass('btn-default btn-complete').addClass('btn-primary');
							$("#ngo-step-3-btn").attr('disabled', 'disabled');
							$("#ngo-step-4-btn").removeAttr('disabled');
							$("#ngo-step-3").css("display", "none");
							$("#ngo-step-4").css("display", "block");

							var noHashURL = window.location.href.replace(/#.*$/, '');

							setTimeout(function() {
									window.location.href =noHashURL+'#ngo-step-4/';
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
	
	$("#request-edit-ngo-form-4").validate({   
        ignore: ":hidden",   
         rules: { 
			"fullName[]": {
				required: true,
	        },
			"email[]": {
				required: true,
				email:true
	        },
			"contactNo[]": {
				required: true,
				digits: true,
                minlength: 10,
	        },
			"photograph[]": {
				//required: true,
				required: false,
	        },				
        }, 
		messages: {
			//"photograph[]": {required: ""},
		},	
        submitHandler: function(form) { 		
    	var fd = new FormData($('#request-edit-ngo-form-4')[0]); 
		var deleted_member_ids='';
		if($('#deleted_member_ids').val() !=''){
			var deleted_member_ids=$('#deleted_member_ids').val().split(',');
			$.each(deleted_member_ids,function(i){
			   deleted_member_ids[i];
			});
		}
		
		fd.append('deleted_member_ids',deleted_member_ids);		

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
					$.toast({
					heading: '',
					text: response.msg,
					showHideTransition: 'slide',
					icon: 'success'
				})
				setTimeout(function() {
					window.location.href = response.redirect;
			   
				}, 1000); 

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
	
	jQuery.validator.addMethod(
	  "regex_csr",
	   function(value, element, regexp) {
		   if (regexp.constructor != RegExp)
			  regexp = new RegExp(regexp);
		   else if (regexp.global)
			  regexp.lastIndex = 0;
			  return this.optional(element) || regexp.test(value);
	   },"Only Alphabets and Numbers allowed"
	);

 });	






 