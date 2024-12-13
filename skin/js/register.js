//$.noConflict();
$(document).ready(function () {
	console.log( "document loaded" );
	$('#orgSector').multiselect({
		//search: true,
		//selectAll: true
		texts    : {
        placeholder: 'Select Sector/s',
    }
	});
	
	$( "#register-company-form-1").validate({

		ignore: ":hidden",
    	rules: {

    		companyLogo: { 
                required: false,
                extension: "jpg|jpeg"
            },
    		companyName: {
          		required: true,
          	},
	        companyAddress1: {
	          required: true, 
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
			  maxlength: "Please enter at least 6 number."
			}
		},
    	submitHandler: function(form) { 

    		var fd = new FormData($('#register-company-form-1')[0]);
    		var files = $('#companyLogo')[0].files[0];
      
        	fd.append('companyLogo',files);

    		$.ajax({
            url: form.action,
            type: 'POST',
            method: form.method,
            dataType: 'json',
        	contentType: false,
        	processData: false,
            data:fd,       
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
                       
                   $("#step-2-current-id").val(response.currentInsertId);

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

    $( "#register-company-form-2").validate({
        ignore: ":hidden",
        rules: {
            cin_certificate_file: {
                required: true,
                extension: "jpg|jpeg|pdf"
            },
            cin_certificate_number: {
                required: true,
                regex_cin: /^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/
            },
            gst_certificate_number: {
                regex_gst :/^([01-35]{2})([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})([1-9A-Z]{1})([zZ]{1})([0-9A-Z]{1})$/
            },
            pan_card_file: {
                required: true,
                extension: "jpg|jpeg|pdf"
            },
            pan_card_number: { 
                required: true,
                regex_pan: /^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/
            }

        }, 
        submitHandler: function(form) { 

            var fd = new FormData($('#register-company-form-2')[0]);
            var files = $('#cin_certificate_file')[0].files[0];
            var files2 = $('#gst_certificate_file')[0].files[0];
            var files3 = $('#pan_card_file')[0].files[0];
           
      
            fd.append('cin_certificate_file',files);
            fd.append('gst_certificate_file',files2);
            fd.append('pan_card_file',files3);
           

            $.ajax({
                url: form.action,
                type: 'POST',
                method: form.method,
                dataType: 'json',
                contentType: false,
                processData: false,
                data:fd,       
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
                            window.location.href = BASE_URL+'company/view';
                       
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
	  
	  
	  
	  $( "#register-ngo-form-1").validate({

		ignore: ':hidden:not("#orgSector")',
    	rules: {   
		
			orgLogo: { 
                required: false,
                extension: "jpg|jpeg"
            },
    		orgName: {
          		required: true,
          	},
	        orgAddress1: {
	          required: true, 
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
	        }			
    	},
		messages: {
			orgPincode: {
			  number: "Please enter only number.",
			  minlength: "Please enter at least 6 number.",
			  maxlength: "Please enter at least 6 number."
			}
		},
    	submitHandler: function(form) { 		

    		var fd = new FormData($('#register-ngo-form-1')[0]);
    		var files = $('#orgLogo')[0].files[0];
      
        	fd.append('orgLogo',files);

    		$.ajax({
            url: form.action,
            type: 'POST',
            method: form.method,
            dataType: 'json',
        	contentType: false,
        	processData: false,
            data:fd,       
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
                       
                   $("#org-step-2-current-id").val(response.currentInsertId);

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
	
	
	$("#register-ngo-form-2").validate({
        ignore: ":hidden",
        rules: {
            org_cin_file: {
                required: true,
                extension: "jpg|jpeg|pdf"
            },
            org_cin_number: {
                required: true,
                regex_cin: /^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/
            },
            org_gst_number: {
                regex_gst :/^([01-35]{2})([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})([1-9A-Z]{1})([zZ]{1})([0-9A-Z]{1})$/
            },
            org_pan_file: {
                required: true,
                extension: "jpg|jpeg|pdf"
            },
            org_pan_number: { 
                required: true,
                regex_pan: /^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/
            },
			org_80g_file: {
                required: true,
                extension: "jpg|jpeg|pdf"
            },
            org_80g_number: { 
                required: true,
            },
			org_fcra_file: {
                required: false,
                extension: "jpg|jpeg|pdf"
            },
			org_35ac_file: {
                required: false,
                extension: "jpg|jpeg|pdf"
            },
			
			org_12a_file: {
                required: true,
                extension: "jpg|jpeg|pdf"
            },
            org_12a_number: { 
                required: true,
            }

        }, 
        submitHandler: function(form) { 
		
			var fd = new FormData($('#register-ngo-form-2')[0]);
            var files = $('#org_cin_file')[0].files[0];
            var files2 = $('#org_gst_file')[0].files[0];
            var files3 = $('#org_pan_file')[0].files[0];
			
			var files4 = $('#org_80g_file')[0].files[0];
			var files5 = $('#org_fcra_file')[0].files[0];
			var files6 = $('#org_35ac_file')[0].files[0];
			var files7 = $('#org_12a_file')[0].files[0];           
      
            fd.append('org_cin_file',files);
            fd.append('org_gst_file',files2);
            fd.append('org_pan_file',files3);
			
			fd.append('org_80g_file',files4);
			fd.append('org_fcra_file',files5);
			fd.append('org_35ac_file',files6);
			fd.append('org_12a_file',files7);      

            $.ajax({
                url: form.action,
                type: 'POST',
                method: form.method,
                dataType: 'json',
                contentType: false,
                processData: false,
                data:fd,       
                success: function(response) {
                  console.log(response);
				  
                    if(response.flag == 1){

                        $("#ngo-step-2-btn").removeClass('btn-primary btn-default').addClass('btn-complete');
					    $("#ngo-step-3-btn").removeClass('btn-default btn-complete').addClass('btn-primary');
					    $("#ngo-step-2-btn").attr('disabled', 'disabled');
					    $("#ngo-step-3-btn").removeAttr('disabled');
					    $("#ngo-step-2").css("display", "none");
					    $("#ngo-step-3").css("display", "block");				    

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

	$("#register-ngo-form-3").validate({   
        ignore: ":hidden",   
         rules: {          
			org_year_1_file: {     
                required: true,               
                extension: "jpg|jpeg|pdf"        
            }, 
			year1_net_worth: {     
                required: true
            },
			year1_turnover: {     
                required: true   
            },
			year1_net_profit: {     
                required: true  
            },
			org_year_2_file: {     
                required: false,               
                extension: "jpg|jpeg|pdf"        
            }, 
			org_year_3_file: {     
                required: false,               
                extension: "jpg|jpeg|pdf"        
            }, 
			org_year_4_file: {     
                required: false,               
                extension: "jpg|jpeg|pdf"        
            }, 
			org_year_5_file: {     
                required: false,               
                extension: "jpg|jpeg|pdf"        
            }, 
			org_year_6_file: {     
                required: false,               
                extension: "jpg|jpeg|pdf"        
            }			
        },       
        submitHandler: function(form) { 		
    	var fd = new FormData($('#register-ngo-form-3')[0]);       

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



      $( "#edit-company-form-1").validate({

        ignore: ":hidden",
          rules: {

            companyLogo: { 
                    required: false,
                    extension: "jpg|jpeg"
                },
            companyName: {
                  required: true,
                },
              companyAddress1: {
                required: true, 
              },
			  companyCity: {
	          required: true,        
	        },
			companyDistrict: {
	          required: true,        
	        },
			companyPincode: {
	          required: true,        
	        },
			companyState: {
	          required: true,        
	        },
              companyAbout: {
                required: true,        
              }
          },

          submitHandler: function(form) { 

            var fd = new FormData($('#edit-company-form-1')[0]);
            var files = $('#companyLogo')[0].files[0];
          
              fd.append('companyLogo',files);

            $.ajax({
                url: form.action,
                type: 'POST',
                method: form.method,
                dataType: 'json',
                contentType: false,
                processData: false,
                data:fd,       
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
                                window.location.href =noHashURL+'#company-step-2/';
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

      $( "#edit-company-form-2").validate({
        ignore: ":hidden",
        rules: {
            cin_certificate_file: {
                required: false,
                extension: "jpg|jpeg|pdf"
            },
            
            cin_certificate_number: {
                required: true,
                regex_cin: /^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/
            },
            gst_certificate_number: {
                regex_gst :/^([01-35]{2})([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})([1-9A-Z]{1})([zZ]{1})([0-9A-Z]{1})$/
            },
            pan_card_file: {
                required: false,
                extension: "jpg|jpeg|pdf"
            },
            pan_card_number: { 
                required: true,
                regex_pan: /^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/
            }

        }, 
        submitHandler: function(form) { 

            var fd = new FormData($('#edit-company-form-2')[0]);
            var files = $('#cin_certificate_file')[0].files[0];
            var files2 = $('#gst_certificate_file')[0].files[0];
            var files3 = $('#pan_card_file')[0].files[0];

          
      
            fd.append('cin_certificate_file',files);
            fd.append('gst_certificate_file',files2);
            fd.append('pan_card_file',files3);
           

            $.ajax({
                url: form.action,
                type: 'POST',
                method: form.method,
                dataType: 'json',
                contentType: false,
                processData: false,
                data:fd,       
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
                            window.location.href = BASE_URL+'company/view';
                       
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
	  
	$( "#edit-ngo-form-1").validate({

		ignore: ':hidden:not("#orgSector")',
    	rules: {   
		
			orgLogo: { 
                required: false,
                extension: "jpg|jpeg"
            },
    		orgName: {
          		required: true,
          	},
	        orgAddress1: {
	          required: true, 
	        },
	        orgCity: {
	          required: true,        
	        },
			orgDistrict: {
	          required: true,        
	        },
			orgPincode: {
	          required: true,        
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
	        }
			
    	},

    	submitHandler: function(form) { 		

    		var fd = new FormData($('#edit-ngo-form-1')[0]);
    		var files = $('#orgLogo')[0].files[0];
      
        	fd.append('orgLogo',files);

    		$.ajax({
            url: form.action,
            type: 'POST',
            method: form.method,
            dataType: 'json',
        	contentType: false,
        	processData: false,
            data:fd,       
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
	
	
	$("#edit-ngo-form-2").validate({
        ignore: ":hidden",
        rules: {
            org_cin_file: {
                required: false,
                extension: "jpg|jpeg|pdf"
            },
            org_cin_number: {
                required: true,
                regex_cin: /^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/
            },
            org_gst_number: {
                regex_gst :/^([01-35]{2})([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})([1-9A-Z]{1})([zZ]{1})([0-9A-Z]{1})$/
            },
            org_pan_file: {
                required: false,
                extension: "jpg|jpeg|pdf"
            },
            org_pan_number: { 
                required: true,
                regex_pan: /^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/
            },
			org_80g_file: {
                required: false,
                extension: "jpg|jpeg|pdf"
            },
            org_80g_number: { 
                required: true,
            },
			org_fcra_file: {
                required: false,
                extension: "jpg|jpeg|pdf"
            },
			org_35ac_file: {
                required: false,
                extension: "jpg|jpeg|pdf"
            },
			
			org_12a_file: {
                required: false,
                extension: "jpg|jpeg|pdf"
            },
            org_12a_number: { 
                required: true,
            }

        }, 
        submitHandler: function(form) { 
		
			var fd = new FormData($('#edit-ngo-form-2')[0]);
            var files = $('#org_cin_file')[0].files[0];
            var files2 = $('#org_gst_file')[0].files[0];
            var files3 = $('#org_pan_file')[0].files[0];
			
			var files4 = $('#org_80g_file')[0].files[0];
			var files5 = $('#org_fcra_file')[0].files[0];
			var files6 = $('#org_35ac_file')[0].files[0];
			var files7 = $('#org_12a_file')[0].files[0];           
      
            fd.append('org_cin_file',files);
            fd.append('org_gst_file',files2);
            fd.append('org_pan_file',files3);
			
			fd.append('org_80g_file',files4);
			fd.append('org_fcra_file',files5);
			fd.append('org_35ac_file',files6);
			fd.append('org_12a_file',files7);      

            $.ajax({
                url: form.action,
                type: 'POST',
                method: form.method,
                dataType: 'json',
                contentType: false,
                processData: false,
                data:fd,       
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
	  
	$("#edit-ngo-form-3").validate({   
        ignore: ":hidden",   
         rules: {          
			org_year_1_file: {     
                required: false,               
                extension: "jpg|jpeg|pdf"        
            }, 
			year1_net_worth: {     
                required: true
            },
			year1_turnover: {     
                required: true   
            },
			year1_net_profit: {     
                required: true  
            },
			org_year_2_file: {     
                required: false,               
                extension: "jpg|jpeg|pdf"        
            }, 
			org_year_3_file: {     
                required: false,               
                extension: "jpg|jpeg|pdf"        
            }, 
			org_year_4_file: {     
                required: false,               
                extension: "jpg|jpeg|pdf"        
            }, 
			org_year_5_file: {     
                required: false,               
                extension: "jpg|jpeg|pdf"        
            }, 
			org_year_6_file: {     
                required: false,               
                extension: "jpg|jpeg|pdf"        
            }			
        },       
        submitHandler: function(form) { 		
    	var fd = new FormData($('#edit-ngo-form-3')[0]);       

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
	
	$('#ms-list-1').click(function(){
		$('#orgSector').valid();
		
	});  
	
	jQuery.validator.addMethod(
	  "regex_pan",
	   function(value, element, regexp) {
		   if (regexp.constructor != RegExp)
			  regexp = new RegExp(regexp);
		   else if (regexp.global)
			  regexp.lastIndex = 0;
			  return this.optional(element) || regexp.test(value);
	   },"Invalid PAN Number"
	);

	jQuery.validator.addMethod(
	  "regex_gst",
	   function(value, element, regexp) {
		   if (regexp.constructor != RegExp)
			  regexp = new RegExp(regexp);
		   else if (regexp.global)
			  regexp.lastIndex = 0;
			  return this.optional(element) || regexp.test(value);
	   },"Invalid GST Number"
	);

	jQuery.validator.addMethod(
	  "regex_cin",
	   function(value, element, regexp) {
		   if (regexp.constructor != RegExp)
			  regexp = new RegExp(regexp);
		   else if (regexp.global)
			  regexp.lastIndex = 0;
			  return this.optional(element) || regexp.test(value);
	   },"Invalid CIN Number"
	);


});

function readFileURL(input) {
	$('#logo').addClass('upload-img');
	if (input.files && input.files[0]) {
		$("#"+input.id).parent('.org-doc-upload').hide();
		var file = input.files[0];
		var extension = file.name.split('.').pop().toLowerCase();
		// console.log("Show type of image: ", file.type.split("/")[1]);
		//if(file.type == 'application/pdf')
		console.log(file);
		console.log(extension);
		
		if ( /\.(jpe?g|png|pdf)$/i.test(file.name) ) {
			
			var reader = new FileReader();
			var pdfImage = BASE_URL+'skin/images/pdf-icon.png';
			reader.onload = function(e) {
				if(extension == 'pdf'){
					$('#upload_' + input.id).html("<span class=\"upload-file\">" + "<img class=\"imageThumb\" src=\"" + pdfImage + "\" width=\"100\" hieght=\"100\" title=\"" + file.name + "\"/>" + "<br/><span class=\"file-name\">" + file.name + "</span><span class=\"remove\">X</span>" + "</span>");
				}else{
					$('#upload_' + input.id).html("<span class=\"upload-file\">" + "<img class=\"imageThumb\" src=\"" + e.target.result + "\" width=\"100\" hieght=\"100\" title=\"" + file.name + "\"/>" + "<br/><span class=\"file-name\">" + file.name + "</span><span class=\"remove\">X</span>" + "</span>");
				}
				//alert('#upload_' + input.id + " .remove")
				 $('#upload_' + input.id + " .remove").click(function(){
					// alert(input.id);
					// alert(111111111)
					$(this).parent(".upload-file").remove();
					$("#" + input.id).val('');
					$("#" + input.id).parent('.org-doc-upload').show();
				  });
				
			}

			reader.readAsDataURL(input.files[0]);
		}else{
			$.toast({
			heading: '',
			text: "Please select valid file type. The supported file types are .jpg , .pdf",
			showHideTransition: 'slide',
			icon: 'error'
		  })
		   setTimeout(function() {}, 1000);
		}
	}
}

function removImage(inputId){
	// alert(inputId);
	// alert(2222222222222)
	$('#upload_' + inputId).empty();
	$("#" + inputId).val('');
	$("#" + inputId + 'Hidden').val('');
	$("#" + inputId).parent('.org-doc-upload').show();
}
