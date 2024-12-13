$(document).ready(function () { 

	$('#orgSector').multiselect({
		//search: true,
		//selectAll: true
		texts    : {
		placeholder: 'Select Sector/s',
		}
	});

	 $('#proceed-btn').on('click',function(){
		 var ngo_id= "<?php echo $ngoData->id; ?>";
		 status = $("input:radio[name='status']:checked").val();
		 
		if (ngo_id != '' && status != '')
		{
			//alert(ngo_id);false;
			$.ajax({
				type: "POST",
				url: BASE_URL+"/admin.php/partner/updateStatus",
				dataType: 'json',
				//data: {status:statusvalue,user_id:id},
				data: 'status='+status+'&ngo_id='+ngo_id,
				success: function(response)
				{
					if (response.flag == '1') {
						$('#assessmentPopup').modal('hide');	
						swal({
							icon: "success",
							text: response.msg,
							buttons: false,						
						})
						setTimeout(function() {
							//window.location.href = response.redirect;
							location.reload();
						}, 1000);
					} 
					else {
						swal({
							icon: "error",
							text: response.msg,
							buttons: false,
						})
						setTimeout(function() {
							location.reload();
						}, 1000);
					}					
				}
		
			}); 
		}				
	});
	
	
	$('#submit-btn').on('click',function(){
		 var ngo_id= "<?php echo $ngoData->id; ?>";
		 status = $("input:radio[name='f-status']:checked").val();
		 
		if (ngo_id != '' && status != '')
		{
			//alert(ngo_id);false;
			$.ajax({
				type: "POST",
				url:  BASE_URL+"/admin.php/partner/updateStatus",
				dataType: 'json',
				//data: {status:statusvalue,user_id:id},
				data: 'status='+status+'&ngo_id='+ngo_id,
				success: function(response)
				{
					if (response.flag == '1') {
						$('#assessmentPopup').modal('hide');	
						swal({
							icon: "success",
							text: response.msg,
							buttons: false,						
						})
						setTimeout(function() {
							//window.location.href = response.redirect;
							location.reload();
						}, 1000);
					} 
					else {
						swal({
							icon: "error",
							text: response.msg,
							buttons: false,
						})
						setTimeout(function() {
							location.reload();
						}, 1000);
					}					
				}
		
			}); 
		}				
	});
	
	$('#conclude').on('click',function(){
		$('#assessmentPopup').modal('show');
	})
	
	$('.chk-radio').on('click',function(){
		statusRadio = $("input:radio[name='status']").is(":checked");
		if (statusRadio) {
			$('#proceed-btn').removeAttr('disabled');
			$('#submit-btn-blk').show();
		}
	})
	
	$('.f-chk-radio').on('click',function(){
		statusRadio = $("input:radio[name='f-status']").is(":checked");
		if (statusRadio) {
			$('#submit-btn-blk').show();
		}
	})
	
	$('#edit-ngo-details').on('click',function(){
		$('#editDetailsPopup').modal('show');
	})
	
	$("#editDetailsForm").validate({

		ignore: ':hidden:not("#orgSector")',
		rules: { 
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
			  maxlength: 6,       
			  minength: 6,       
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
			
		},

		submitHandler: function(form) { 		

			var fd = new FormData($('#editDetailsForm')[0]);
			
			$.ajax({
			type: "POST",
			url:  BASE_URL+"/admin.php/partner/updateStatusS",
			dataType: 'json',
			//contentType: false,
			//processData: false,
			data:fd,       
			success: function(response) {
				console.log(response);
			  
			  
				if(response.flag == 1) {
				}else{

					
				}
			}
			
			});	
			
		}
	});
	
});


function downloadFile(ngo_id,file_name)
{
	//console.log('testing function');

	if(ngo_id!='' && file_name!='')
	{
		console.log(ngo_id);
		console.log(file_name);
		console.log(BASE_URL);
		
		//location.href = BASE_URL+'ngo/downloadFile/'+ngo_id+'/'+file_name;
		location.href = BASE_URL+'admin.php/partner/downloadFile/'+ngo_id+'/'+file_name;
		
	}
}

function viewProofDocs(ngo_id)
{
	window.location=BASE_URL+'admin.php/partner/view-proof-documents/'+ngo_id;
}

function assignTo(assign_to_id,ngo_id){
	console.log(assign_to_id);
	console.log(ngo_id);
	console.log("<?php echo $this->session->userdata('LoginID');?>");

	if (confirm('Are you sure that want to Assign?'))
	{
		$.ajax({
		type: "POST",
		url:  BASE_URL+"/admin.php/partner/assign",
		//data: {status:statusvalue,user_id:id},
		data: 'assign_to_id='+assign_to_id+'&ngo_id='+ngo_id+'&flag=',
		success: function(msg){
			location.reload();
		}

		});  
	}
}
