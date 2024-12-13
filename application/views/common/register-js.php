<script>
$("#org_80g_number").blur(function(){
	$value = $("#org_80g_number").val();
	if($value!=""){
		$(".80g_date_range").css("display","block");
		$("#org_80g_start_date").attr("required","true");
		$("#org_80g_end_date").attr("required","true");
	}else{
		$("#org_80g_start_date").val('');
		$("#org_80g_end_date").val('');
		$("#org_80g_start_date").removeClass("error");
		$("#org_80g_end_date").removeClass("error");
		$("#org_80g_start_date").removeAttr("required");
		$("#org_80g_end_date").removeAttr("required");
		$("#org_80g_start_date-error").css("display","none");
		$("#org_80g_end_date-error").css("display",'none');
		$(".80g_date_range").css("display","none");

	}
});


$("#org_fcra_number").blur(function(){
	$value = $("#org_fcra_number").val();
	if($value!=""){
		$(".fcra_date_range").css("display","block");
		$("#org_fcra_start_date").attr("required","true");
		$("#org_fcra_end_date").attr("required","true");
	}else{
		$("#org_fcra_start_date").val('');
		$("#org_fcra_end_date").val('');
		$("#org_fcra_start_date").removeClass("error");
		$("#org_fcra_end_date").removeClass("error");
		$("#org_fcra_start_date").removeAttr("required");
		$("#org_fcra_end_date").removeAttr("required");
		$("#org_fcra_start_date-error").css("display","none");
		$("#org_fcra_end_date-error").css("display",'none');
		$(".fcra_date_range").css("display","none");

	}
});

$("#org_35ac_number").blur(function(){
	$value = $("#org_35ac_number").val();
	if($value!=""){
		$(".35ac_date_range").css("display","block");
		$("#org_35ac_start_date").attr("required","true");
		$("#org_35ac_end_date").attr("required","true");
	}else{
		$("#org_35ac_start_date").val('');
		$("#org_35ac_end_date").val('');
		$("#org_35ac_start_date").removeClass("error");
		$("#org_35ac_end_date").removeClass("error");
		$("#org_35ac_start_date").removeAttr("required");
		$("#org_35ac_end_date").removeAttr("required");
		$("#org_35ac_start_date-error").css("display","none");
		$("#org_35ac_end_date-error").css("display",'none');
		$(".35ac_date_range").css("display","none");

	}
});



$("#org_12a_number").blur(function(){
	$value = $("#org_12a_number").val();
	if($value!=""){
		$(".12a_date_range").css("display","block");
		$("#org_12a_start_date").attr("required","true");
		$("#org_12a_end_date").attr("required","true");
	}else{
		$("#org_12a_start_date").val('');
		$("#org_12a_end_date").val('');
		$("#org_12a_start_date").removeClass("error");
		$("#org_12a_end_date").removeClass("error");
		$("#org_12a_start_date").removeAttr("required");
		$("#org_12a_end_date").removeAttr("required");
		$("#org_12a_start_date-error").css("display","none");
		$("#org_12a_end_date-error").css("display",'none');
		$(".12a_date_range").css("display","none");

	}
});



$(document).ready(function(){
	$80g_number = $("#org_80g_number").val();
	$fcra_number = $("#org_fcra_number").val();
	$35ac_number = $("#org_35ac_number").val();
	$12a_number = $("#org_12a_number").val();

	if($80g_number!=""){
		$("#org_80g_start_date").attr("required","true");
		$("#org_80g_end_date").attr("required","true");
		$(".80g_date_range").css("display","block");
	}else{
		$("#org_80g_start_date").val('');
		$("#org_80g_end_date").val('');
		$("#org_80g_start_date").removeClass("error");
		$("#org_80g_end_date").removeClass("error");
		$("#org_80g_start_date").removeAttr("required");
		$("#org_80g_end_date").removeAttr("required");
		// $(".80g_date_range").css("display","none");

	}

	if($fcra_number!=""){
		$("#org_fcra_start_date").attr("required","true");
		$("#org_fcra_end_date").attr("required","true");
		$(".fcra_date_range").css("display","block");
	}else{
		$("#org_fcra_start_date").val('');
		$("#org_fcra_end_date").val('');
		$("#org_fcra_start_date").removeClass("error");
		$("#org_fcra_end_date").removeClass("error");
		$("#org_fcra_start_date").removeAttr("required");
		$("#org_fcra_end_date").removeAttr("required");
		// $(".fcra_date_range").css("display","none");

	}

	if($35ac_number!=""){
		$("#org_35ac_start_date").attr("required","true");
		$("#org_35ac_end_date").attr("required","true");
		$(".35ac_date_range").css("display","block");
	}else{
		$("#org_35ac_start_date").val('');
		$("#org_35ac_end_date").val('');
		$("#org_35ac_start_date").removeClass("error");
		$("#org_35ac_end_date").removeClass("error");
		$("#org_35ac_start_date").removeAttr("required");
		$("#org_35ac_end_date").removeAttr("required");
		// $(".35ac_date_range").css("display","none");

	}

	if($12a_number!=""){
		$("#org_12a_start_date").attr("required","true");
		$("#org_12a_end_date").attr("required","true");
		$(".12a_date_range").css("display","block");
	}else{
		$("#org_12a_start_date").val('');
		$("#org_12a_end_date").val('');
		$("#org_12a_start_date").removeClass("error");
		$("#org_12a_end_date").removeClass("error");
		$("#org_12a_start_date").removeAttr("required");
		$("#org_12a_end_date").removeAttr("required");
		// $(".12a_date_range").css("display","none");

	}
});





//$.noConflict();
$(document).ready(function () {
	console.log( "document loaded" );
	
	$('[data-toggle="tooltip"]').tooltip();
	
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
	
	var date = new Date();
	$("#orgDateIncorporation").datepicker({
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
	
	$( "#register-company-form-1").validate({

		ignore: ":hidden",
    	rules: {

    		companyLogo: { 
                required: false,
                extension: "jpg|jpeg|png",
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
                extension: "jpg|jpeg|pdf|png",
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

    		var fd = new FormData($('#register-company-form-1')[0]);
    		var files = $('#companyLogo')[0].files[0];
    		var files2 = $('#companyAddProof')[0].files[0];
      
        	fd.append('companyLogo',files);
        	fd.append('companyAddProof',files2);

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
	
// date code start here
var date = new Date();
$('#org_80g_start_date').datepicker({
		// format: "dd-mm-yyyy",
		format: "d MM yyyy",
		endDate: new Date(date.setDate(date.getDate() - 0)),
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
								
			// $('#proDateFrom').datepicker('setStartDate', new Date(e.date));	
			// $('#end_date').datepicker('setStartDate', new Date(date.setDate(date.getDate() + 1)));	
            $('#org_80g_end_date').datepicker('setStartDate', new Date(date.setDate(date.getDate() + 1)));	
			formattedDate = ('0' + date.getDate()).slice(-2) + '/'
						+ ('0' + (date.getMonth()+1)).slice(-2) + '/'
						+ date.getFullYear();
						
			
			
			$('#hiddenStartDate').val(newformattedDate);
			
			//alert(formattedDate)			
			//alert(newformattedDate)			
						
			 
			
			$('.bootstrap-select').removeClass('error');
			
			//$('#goal_end_date').val('');
			$('#CampDetailEnddate').val('').datepicker('update');
			
			if (formattedDate=='NaN-aN-aN' &&  newformattedDate == 'NaN-aN-aN') {
				
				$('#proDateTo').val('').datepicker('update');
				$('#hiddenStartDate').val('');
			}
				
		}
				
	});
	
	$('#org_80g_end_date').datepicker({
		// format: "dd-mm-yyyy",
		format:"d MM yyyy",
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
			
			 
		}
	
	});


	// code start for end date validation
	$("#org_80g_end_date").click(function(){
		var curr_date = $('#org_80g_start_date').datepicker('getDate', '+1d'); 
		mydate  = curr_date.setDate(curr_date.getDate()+1); 
		$('#org_80g_end_date').datepicker('setStartDate', new Date(mydate));	
	});
	// code ends for end date validation 

// date code ends here


// facra date validation start here
var date = new Date();
$('#org_fcra_start_date').datepicker({
		// format: "dd-mm-yyyy",
		format: "d MM yyyy",
		endDate: new Date(date.setDate(date.getDate() - 0)),
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
								
			// $('#proDateFrom').datepicker('setStartDate', new Date(e.date));	
			// $('#end_date').datepicker('setStartDate', new Date(date.setDate(date.getDate() + 1)));	
            $('#org_fcra_end_date').datepicker('setStartDate', new Date(date.setDate(date.getDate() + 1)));	
			formattedDate = ('0' + date.getDate()).slice(-2) + '/'
						+ ('0' + (date.getMonth()+1)).slice(-2) + '/'
						+ date.getFullYear();
						
			
			
			$('#hiddenStartDate').val(newformattedDate);
			
			//alert(formattedDate)			
			//alert(newformattedDate)			
						
			 
			
			$('.bootstrap-select').removeClass('error');
			
			//$('#goal_end_date').val('');
			$('#CampDetailEnddate').val('').datepicker('update');
			
			if (formattedDate=='NaN-aN-aN' &&  newformattedDate == 'NaN-aN-aN') {
				
				$('#proDateTo').val('').datepicker('update');
				$('#hiddenStartDate').val('');
			}
				
		}
				
	});
	
	$('#org_fcra_end_date').datepicker({
		// format: "dd-mm-yyyy",
		format:"d MM yyyy",
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
			
			 
		}
	
	});

	// code start for end date validation
	$("#org_fcra_end_date").click(function(){
		var curr_date = $('#org_fcra_start_date').datepicker('getDate', '+1d'); 
		mydate  = curr_date.setDate(curr_date.getDate()+1); 
		$('#org_fcra_end_date').datepicker('setStartDate', new Date(mydate));	
	});
	// code ends for end date validation 
	
// fcra date validation ends here

// 35ac date validation start here
var date = new Date();
$('#org_35ac_start_date').datepicker({
		// format: "dd-mm-yyyy",
		format: "d MM yyyy",
		endDate: new Date(date.setDate(date.getDate() - 0)),
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
								
			// $('#proDateFrom').datepicker('setStartDate', new Date(e.date));	
			// $('#end_date').datepicker('setStartDate', new Date(date.setDate(date.getDate() + 1)));	
            $('#org_35ac_end_date').datepicker('setStartDate', new Date(date.setDate(date.getDate() + 1)));	
			formattedDate = ('0' + date.getDate()).slice(-2) + '/'
						+ ('0' + (date.getMonth()+1)).slice(-2) + '/'
						+ date.getFullYear();
						
			
			
			$('#hiddenStartDate').val(newformattedDate);
			
			//alert(formattedDate)			
			//alert(newformattedDate)			
						
			 
			
			$('.bootstrap-select').removeClass('error');
			
			//$('#goal_end_date').val('');
			$('#CampDetailEnddate').val('').datepicker('update');
			
			if (formattedDate=='NaN-aN-aN' &&  newformattedDate == 'NaN-aN-aN') {
				
				$('#proDateTo').val('').datepicker('update');
				$('#hiddenStartDate').val('');
			}
				
		}
				
	});
	
	$('#org_35ac_end_date').datepicker({
		// format: "dd-mm-yyyy",
		format:"d MM yyyy",
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
			
			 
		}
	
	});

	// code start for end date validation
	$("#org_35ac_end_date").click(function(){
		var curr_date = $('#org_35ac_start_date').datepicker('getDate', '+1d'); 
		mydate  = curr_date.setDate(curr_date.getDate()+1); 
		$('#org_35ac_end_date').datepicker('setStartDate', new Date(mydate));	
	});
	// code ends for end date validation 
// 35ac date validation ends here

// 12a date validation start here
// date code start here
var date = new Date();
$('#org_12a_start_date').datepicker({
		// format: "dd-mm-yyyy",
		format: "d MM yyyy",
		endDate: new Date(date.setDate(date.getDate() - 0)),
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
								
			// $('#proDateFrom').datepicker('setStartDate', new Date(e.date));	
			// $('#end_date').datepicker('setStartDate', new Date(date.setDate(date.getDate() + 1)));	
            $('#org_12a_end_date').datepicker('setStartDate', new Date(date.setDate(date.getDate() + 1)));	
			formattedDate = ('0' + date.getDate()).slice(-2) + '/'
						+ ('0' + (date.getMonth()+1)).slice(-2) + '/'
						+ date.getFullYear();
						
			
			
			$('#hiddenStartDate').val(newformattedDate);
			
			//alert(formattedDate)			
			//alert(newformattedDate)			
						
			 
			
			$('.bootstrap-select').removeClass('error');
			
			//$('#goal_end_date').val('');
			$('#CampDetailEnddate').val('').datepicker('update');
			
			if (formattedDate=='NaN-aN-aN' &&  newformattedDate == 'NaN-aN-aN') {
				
				$('#proDateTo').val('').datepicker('update');
				$('#hiddenStartDate').val('');
			}
				
		}
				
	});
	
	$('#org_12a_end_date').datepicker({
		// format: "dd-mm-yyyy",
		format:"d MM yyyy",
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
			
			 
		}
	
	});

	// code start for end date validation
	$("#org_12a_end_date").click(function(){
		var curr_date = $('#org_12a_start_date').datepicker('getDate', '+1d'); 
		mydate  = curr_date.setDate(curr_date.getDate()+1); 
		$('#org_12a_end_date').datepicker('setStartDate', new Date(mydate));	
	});
	// code ends for end date validation 


	var date = new Date();
	$("#org_trustee_number").datepicker({
        // format: "dd-mm-yyyy",
		format: "yyyy-mm-dd",
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
		$('#hiddenIncorporationDate').val(newformattedDate);
		//alert(newformattedDate);
		}
	});
// date code ends here
// 12a date validaiton ends here

    $( "#register-company-form-2").validate({
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
	  
	$("#register-company-form-3").validate({   
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
                minlength: 10
	        },
			"photograph[]": {
				required: true,
				// required: false,
	        },			
        }, 
		messages: {
			//"photograph[]": {required: ""},
		},	
        submitHandler: function(form) { 		
    	var fd = new FormData($('#register-company-form-3')[0]);       

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
			  minlength: 1
	        },
			orgAbout: {
	          required: true,        
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

    		var fd = new FormData($('#register-ngo-form-1')[0]);
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
			org_trustee_file: {
                required: true,
                extension: "jpg|jpeg|pdf|png"
            },
            org_trustee_number: { 
                required: true,
            },
			officialseal_file: {
				// required: true,
                required: false,
                extension: "jpg|jpeg|pdf|png",
            },
			signature_file: {
                // required: true,
				required: false,
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
            }
			// csr_file: { 
            //     required: true,
            //     extension: "jpg|jpeg|pdf|png"
            // },
            // csr_number: {
			// 	required: true,
			// 	regex_csr :/^[A-Za-z0-9]+$/
            // }
			// Above code commented by neerajkumar on 22-04-2022
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
			// primarySourceType: {
	        //   required: true,        
	        // },
			"primarySourceType[]": {
				required: true,
				minlength: 1
			},
			org_year_1_file: {     
                //  required:  function() {
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
                //  required:  function() {
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
                //  required:  function() {
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
                //  required:  function() {
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

	$("#register-ngo-form-4").validate({   
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
                minlength: 10
	        },
			"photograph[]": {
				//required: true,
				required: false,
	        },	
			/*"password[]": {
				required: true,
	        },	
			"designation[]": {
				required: true,
	        },	
			"role[]": {
				required: true,
	        },	
			"status[]": {
				required: true,
	        },*/		
        }, 
		messages: {
			//"photograph[]": {required: ""},
		},	
        submitHandler: function(form) { 		
    	var fd = new FormData($('#register-ngo-form-4')[0]);       

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

      $( "#edit-company-form-1").validate({

        ignore: ":hidden",
          rules: {

            companyLogo: { 
				required: false,
				extension: "jpg|jpeg|png",
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
                extension: "jpg|jpeg|pdf|png",
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

            var fd = new FormData($('#edit-company-form-1')[0]);
            var files = $('#companyLogo')[0].files[0];
            var files2 = $('#companyAddProof')[0].files[0];
          
              fd.append('companyLogo',files);
              fd.append('companyAddProof',files2);

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

      $( "#edit-company-form-2").validate({
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
	  
	$("#edit-company-form-3").validate({   
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
                minlength: 10
	        },
			"photograph[]": {
				required: true,
				// required: false,
	        },			
        }, 
		messages: {
			//"photograph[]": {required: ""},
		},	
        submitHandler: function(form) { 		
    	var fd = new FormData($('#edit-company-form-3')[0]); 
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

    		var fd = new FormData($('#edit-ngo-form-1')[0]);
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
	
	
	$("#edit-ngo-form-2").validate({
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
			org_trustee_file: {
                required: true,
                extension: "jpg|jpeg|pdf|png"
            },
            org_trustee_number: { 
                required: true,
            },
			officialseal_file: {
                // required: true,
				required:false,
                extension: "jpg|jpeg|pdf|png",
            },
			signature_file: {
                // required: true,
				required:false,
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
			// Above code commented by neerajkumar on 22-04-2022
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
	
	$("#edit-ngo-form-3").validate({   
        ignore: ":hidden",   
         rules: { 
			// primarySourceType: {
	        //   required: true,        
	        // },
			"primarySourceType[]": {
				required: true,
				minlength: 1
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
				// }, 
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
	
	$("#edit-ngo-form-4").validate({   
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
                minlength: 10
	        },
			"photograph[]": {
				//required: true,
				required: false,
	        },	
			/*"password[]": {
				required: true,
	        },	
			"designation[]": {
				required: true,
	        },	
			"role[]": {
				required: true,
	        },	
			"status[]": {
				required: true,
	        },*/			
        }, 
		messages: {
			//"photograph[]": {required: ""},
		},	
        submitHandler: function(form) { 		
    	var fd = new FormData($('#edit-ngo-form-4')[0]); 
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
	
	$('#add_org_form1').on('click', function() {
		// alert(111111)
		isValid = $('#orgSector').valid();
		if(!(isValid)){
			$('#ms-list-1').find('button').addClass("error");
		}else{
			$('#ms-list-1').find('button').removeClass("error");
		}
	});	
	
	$('#ms-list-1').click(function(){
		isValid = $('#orgSector').valid();
		if(!(isValid)){
			$('#ms-list-1').find('button').addClass("error");
		}else{
			$('#ms-list-1').find('button').removeClass("error");
		}
		
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

	/*jQuery.validator.addMethod(
	  "regex_gst",
	   function(value, element, regexp) {
		   if (regexp.constructor != RegExp)
			  regexp = new RegExp(regexp);
		   else if (regexp.global)
			  regexp.lastIndex = 0;
			  return this.optional(element) || regexp.test(value);
	   },"Invalid GST Number"
	);*/
	
	jQuery.validator.addMethod("regex_gst", function(value3, element3) {
		var gst_value = value3.toUpperCase();
		//var reg = /^([0-9]{2}[a-zA-Z]{4}([a-zA-Z]{1}|[0-9]{1})[0-9]{4}[a-zA-Z]{1}([a-zA-Z]|[0-9]){3}){0,15}$/;
        var reg = /^([0-9]{2}[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}([a-zA-Z]{1}|[0-9]{1})){0,15}$/;
		if (this.optional(element3)) {
			return true;
		}
		if (gst_value.match(reg)) {
			return true;
		} else {
			return false;
		}

	}, "Please specify a valid GSTTIN Number");

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
			$("#"+input.id).parent('.org-doc-upload').show();
			$.toast({
			heading: '',
			text: "Please select valid file type. The supported file types are .png, .jpg , .pdf",
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

function editcompanystep1(){
	 var lastinsertid = $("#step-2-current-id").val();
	 //alert(lastinsertid);
	 window.location.href = BASE_URL+"company/edit/"+lastinsertid+"/#company-step-1";
}

function editcompanystep2(){
	 var lastinsertid = $("#step-2-current-id").val();
	 //alert(lastinsertid);
	 window.location.href = BASE_URL+"company/edit/"+lastinsertid+"/#company-step-2";
}

function editngostep1(){
	 var lastinsertid = $("#org-step-2-current-id").val();
	 //alert(lastinsertid);
	 window.location.href = BASE_URL+"ngo/edit/"+lastinsertid+"/#ngo-step-1";
}

function editngostep2(){
	 var lastinsertid = $("#org-step-2-current-id").val();
	 //alert(lastinsertid);
	 window.location.href = BASE_URL+"ngo/edit/"+lastinsertid+"/#ngo-step-2";
}

function editngostep3(){
	 var lastinsertid = $("#org-step-2-current-id").val();
	 //alert(lastinsertid);
	 window.location.href = BASE_URL+"ngo/edit/"+lastinsertid+"/#ngo-step-3";
}

function addMemberEntry(form_id) {	
	
	if(!$("#"+form_id).valid()){
		return false;
	}
	
	var total_team_members=$('#total_team_members').val();
	var new_total_team_members=$('#total_team_members').val();
	if(total_team_members=='')
	{
		new_total_fund_recieved=1;
	}
	$('#total_team_members').val(new_total_team_members);
	
	var i = 1;
	for(i;i<=new_total_team_members;i++){
		fullName = $("#fullName_"+i).val();
		email = $("#email_"+i).val();
		contactNo = $("#contactNo"+i).val();
		photograph = $("#photograph_"+i).val();
		hiddenPhotograph = $("#hiddenphotograph_"+i).val();

		password = $("#password_"+i).val();
		designation = $("#designation_"+i).val();
		role = $("#role_"+i).val();
		status = $("#status_"+i).val();
		
		//if(fullName == '' || email == '' || contactNo == '' || (photograph == '' && hiddenPhotograph == '') || (photograph == '' && typeof(hiddenPhotograph) === "undefined")){
		//if(fullName == '' || email == '' || contactNo == ''){
		if(fullName == ''){
		$.toast({
			heading: '',
			text: 'Cannot be blank',
			showHideTransition: 'slide',
			icon: 'error'
		  });	
			return false;	
		}
	}
		
	new_total_team_members=parseInt(new_total_team_members) + parseInt(1);
	$('#total_team_members').val(new_total_team_members);
	// $('#totalFunds_block').show();
	// $('#totalFunds').val(totalFunds);
			
	$.ajax({
		type: 'POST',	
		url: BASE_URL+"Register/addMemberEntry",
		data: {
			counter:new_total_team_members,
			ngo_id:$('#step-4-current-id').val()
		},
		success: function(data) {
			
			$('#team-member-block').append(data);
			
			
		}
	});

}

function diff_months(dt2, dt1) 
{
	var diff =(dt2.getTime() - dt1.getTime()) / 1000;
	diff /= (60 * 60 * 24 * 7 * 4);
	return Math.abs(Math.round(diff));
}

function readAddProofURL(input) {
    $('#add-proof').addClass('upload-proof');
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
                    $('#upload_proof').attr('src', pdfImage);
                }else{
                    $('#upload_proof').attr('src', e.target.result);
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

function removeMember(thislement,id){
	if(id!='')
	{
		//$(thislement).parent().remove();
		//alert(id)
		$('#member_'+id).remove();
		var deleted_image_value = $('#deleted_member_ids').val();
		if(deleted_image_value == ''){
			$('#deleted_member_ids').val(id);
		}else{
			var new_value = deleted_image_value+','+id;
			$('#deleted_member_ids').val(new_value);
		}
	}
}

function removeTempMember(thislement,id){
	if(id!='')
	{
		$('#member_'+id).remove();
	}
}

function validateNumber(e) {
	const pattern = /^[0-9]$/;

	return pattern.test(e.key )
}

function validateName(e) {
	const Namepattern = /^[A-Za-z]+$/;
	
	return Namepattern.test(e.key )
}




</script>
