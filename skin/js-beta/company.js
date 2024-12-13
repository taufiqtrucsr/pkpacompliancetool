function downloadForm(company_id){
	if(company_id!=''){
		location.href = BASE_URL+'company/downloadForm/'+company_id;
	}
}

function downloadFile(company_id,file_name)
{
	if(company_id!='' && file_name!=''){
		$('#truCSRModalView').modal();
		$.ajax({
			type : "POST",
			url  : BASE_URL + "company/viewFile",
			dataType : "JSON",
			data : {id:company_id,file_name:file_name},
			success: function(response){
				// console.log(response);
				if (response.flag == '1') {
					src = response.url;
					$('#iframe').attr("src", src);
					//console.log(response.data);
				}
			},
			error:function(response){
				console.log(response);
			}
		});
		//location.href = BASE_URL+'company/downloadFile/'+company_id+'/'+file_name;
	}
}

function downloadBoardFile(id)
{
	if(id!=''){
		$('#truCSRModalView').modal();
		$.ajax({
			type : "POST",
			url  : BASE_URL + "company/viewFile",
			dataType : "JSON",
			data : {id:id},
			success: function(response){
				// console.log(response);
				if (response.flag == '1') {
					src = response.url;
					$('#iframe').attr("src", src);
					//console.log(response.data);
				}
			},
			error:function(response){
				console.log(response);
			}
		});
		//location.href = BASE_URL+'company/downloadFile/'+id;
	}
}

//Terms popup - Display
function openTermsConditionsPopup() {
    $('#termsConditionsPopup').modal();
}

function sendForVerification(user_id){
	if(user_id!=''){
		$('#termsConditionsPopup').modal('hide');
		$.ajax({
			url: BASE_URL+"company/sendForVerification",
            type: 'ajax',
			method: 'POST',
			dataType: 'json',
			data: {
				user_id:user_id
			},
			success: function(response) {

            	if(response.flag == 1) {
                	
					$.toast({
                        heading: '',
                        text: response.msg,
                        showHideTransition: 'slide',
                        icon: 'success'
                      })
                      setTimeout(function() {
						window.location.href = response.redirect;
                      }, 1000);
					
				} else {
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
}