$(document).ready(function () {
	
	/*
    if($("#contributors").length == 0) {
		$("#contributors").multiselect({
		    //search: true,
		    //selectAll: true
		    texts: {
		      placeholder: "Select Contributer/s",
		    },
		});

    }
    */

	$("#contributors").multiselect({
	    //search: true,
	    //selectAll: true
	    texts: {
	    //   placeholder: "Select Contributer/s",
		placeholder: "Select Contributors",
	    },
	});
	
	$("#pro-report-form").validate({
		//ignore: ':hidden:not("#proSector,#proBeneficiary")',
    	rules: { 
    		"contributors[]": {
	          required: true,
				minlength: 1
	        },
    		work_description: {
          		required: true,
				minlength: 50, 
				maxlength: 500 
          	},
	        no_of_beneficiaries: {
	          required: true, 
	        },
			"rep_img[]": {
	          required: true,
	          minlength: 1,
	          extension: "jpg|jpeg|png"
			},
	        "ImageDescription[]": {
	          required: true,
	          minlength:50,
	          maxlength: 250        
	        },
			"fund_description[]": {
	          required: true,
	          minlength:50,
	          maxlength: 300       
	        },
			"amount_spent[]": {
	          required: true,
	        },
			"caseStudyDescription[]": {
	          required: false,
	          minlength:50,
	          maxlength: 500       
	        },
		},
		onfocusout: function(element){ return false; },
		submitHandler: function(form) { 		
			
    		var fd = new FormData($('#pro-report-form')[0]);
			fd.append('report_type','Submitted');

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
});

function saveAsDraft()
{	
	var fd = new FormData($('#pro-report-form')[0]);
	fd.append('report_type','Draft');
			
	$.ajax({
		url: BASE_URL+'reports/reportPostForm',
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

function showReportslist(identifier){
	if(identifier!=''){
		$.ajax({
			type : "POST",
			url  : BASE_URL + "reports/reportListings",
			dataType : "html",
			data : {identifier:identifier},
			success: function(response){
				console.log(response);
				$('#due-report').html(response);
			},
			error:function(response){
				console.log(response);
			}
		});
	}
}


