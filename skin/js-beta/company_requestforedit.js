$(document).ready(function(){	
	$( "#request-edit-company-form-1").validate({

		ignore: ":hidden",
    	rules: {

    		companyLogo: { 
                required: false,
                extension: "jpg|jpeg|png"
            },
    		companyName: {
          		required: true,
          	},
	        companyAddress1: {
	          required: true, 
	        },
			companyAddress2: {
                required: true, 
            },
			companyAddProof: {
                required: false,
                extension: "jpg|jpeg|pdf|png"
            },
			companyCity: {
	          required: true,        
	        },
			companyDistrict: {
	          required: true,        
	        },
			companyPincode: {
	          required: true,        
	          number: true,
			  minlength:6,
			  maxlength: 6	
	        },
			companyState: {
	          required: true,        
	        },
			companyOrgType: {
	          required: true,        
	        },
	        companyAbout: {
	          required: true,        
	        }
    	},
		messages: {
			companyPincode: {
			  number: "Please enter only number.",
			  minlength: "Please enter at least 6 number.",
			  maxlength: "Please enter only 6 number."
			}
		},
    	submitHandler: function(form) { 

    		var fd = new FormData($('#request-edit-company-form-1')[0]);
    		
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
                   $("#company-step-1-btn").removeClass('btn-primary btn-default').addClass('btn-complete');
                   $("#company-step-2-btn").removeClass('btn-default btn-complete').addClass('btn-primary');
                   $("#company-step-1-btn").attr('disabled', 'disabled');
                   $("#company-step-2-btn").removeAttr('disabled');
                   $("#company-step-1").css("display", "none");
                   // $("#company-step-1").css("height", 0);
                   // $("#company-step-1").css("display", "flex");
                   $("#company-step-2").css("display", "block");
                       
                   var noHashURL = window.location.href.replace(/#.*$/, '');

				   setTimeout(function() {
							window.location.href =noHashURL+'#company-step-2';
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

    $( "#request-edit-company-form-2").validate({
        ignore: ":hidden",
        rules: {
            cin_certificate_file: {
                required: true,
                extension: "jpg|jpeg|pdf|png"
            },
            cin_certificate_number: {
                required: true,
                //regex_cin: /^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/
            },
			gst_certificate_file: {
                required: false,
                extension: "jpg|jpeg|pdf|png"
            },
            gst_certificate_number: {
                //regex_gst :/^([01-35]{2})([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})([1-9A-Z]{1})([zZ]{1})([0-9A-Z]{1})$/
				required: false,
                regex_gst :true
            },
            pan_card_file: {
                required: true,
                extension: "jpg|jpeg|pdf|png"
            },
            pan_card_number: { 
                required: true,
                regex_pan: /^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/
            }

        }, 
        submitHandler: function(form) { 

            var fd = new FormData($('#request-edit-company-form-2')[0]);
           
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

                        $("#company-step-2-btn").removeClass('btn-primary btn-default').addClass('btn-complete');
						$("#company-step-3-btn").removeClass('btn-default btn-complete').addClass('btn-primary');
						$("#company-step-2-btn").attr('disabled', 'disabled');
						$("#company-step-3-btn").removeAttr('disabled');
						$("#company-step-2").css("display", "none");
						// $("#company-step-1").css("height", 0);
						// $("#company-step-1").css("display", "flex");
						$("#company-step-3").css("display", "block");
						
						var noHashURL = window.location.href.replace(/#.*$/, '');

						setTimeout(function() {
								window.location.href =noHashURL+'#company-step-3';
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
	  
	$("#request-edit-company-form-3").validate({   
        ignore: ":hidden",   
         rules: { 
			"fullName[]": {
				required: true,
	        },
			"email[]": {
				//required: true,
				email:true
	        },
			"contactNo[]": {
				//required: true,
				digits: true,
                minlength: 10,
                minlength: 10
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
    	var fd = new FormData($('#request-edit-company-form-3')[0]);       
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
 });	