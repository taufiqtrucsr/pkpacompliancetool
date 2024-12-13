$(document).ready(function () { 
	if(location.hash =="#contracts"){
		$('#contract').trigger( "click" );	
		//document.location.hash = '';
		history.pushState('', '', window.location.pathname);
		//document.location.href.replace('#', '');//remove hash
	}
	// * for all
	// $("a").click(function(e){
	   // e.preventDefault();
	   // e.stopPropagation();
	   // //alert($(this).text());
	   // aText = $(this).text();
	   
	   // if(aText != 'Download All'){
		  	 // $('#check_all_signed').prop('checked',false);
			// $('.chk_box_signed').each(function(){
				// this.checked = false;
			// });
			
			// $('#check_all_unsigned').prop('checked',false);
			// $('.chk_box_unsigned').each(function(){
				// this.checked = false;
			// });
			
			
	   // }return true;
	// });
	
	$('input[type="checkbox"]').prop("checked", false);
	
	$('.contract-tab').on('click',function(){
		//alert($(this).attr('href'));
		hrefVal = $(this).attr('href');
		if(hrefVal == '#received'){
			$('#check_all_signed').prop('checked',false);
			$('.chk_box_signed').each(function(){
				this.checked = false;
			});
		}else{
			$('#check_all_unsigned').prop('checked',false);
			$('.chk_box_unsigned').each(function(){
				this.checked = false;
			});
		}
	});
	 
	$('#check_all_unsigned').on('click',function(){
        if(this.checked){
            $('.chk_box_unsigned').each(function(){
                this.checked = true;
            });
        }else{
             $('.chk_box_unsigned').each(function(){
                this.checked = false;
            });
        }
		
		$('#check_all_signed').prop('checked',false);
		$('.chk_box_signed').each(function(){
			this.checked = false;
		});
    });
    
    $('.chk_box_unsigned').on('click',function(){
        if($('.chk_box_unsigned:checked').length == $('.chk_box_unsigned').length){
            $('#check_all_unsigned').prop('checked',true);
            
        }else{
            $('#check_all_unsigned').prop('checked',false);
        }
		
		$('#check_all_signed').prop('checked',false);
		$('.chk_box_signed').each(function(){
			this.checked = false;
		});
    });
	
	$('#check_all_signed').on('click',function(){
        if(this.checked){
            $('.chk_box_signed').each(function(){
                this.checked = true;
            });
			
        }else{
             $('.chk_box_signed').each(function(){
                this.checked = false;
            });
        }
		$('#check_all_unsigned').prop('checked',false);
		$('.chk_box_unsigned').each(function(){
			this.checked = false;
		});
    });
    
    $('.chk_box_signed').on('click',function(){
        if($('.chk_box_signed:checked').length == $('.chk_box_signed').length){
            $('#check_all_signed').prop('checked',true);
        }else{
            $('#check_all_signed').prop('checked',false);
        }
		
		$('#check_all_unsigned').prop('checked',false);
		$('.chk_box_unsigned').each(function(){
			this.checked = false;
		});
    });	
});

function uploadContract(id,contract_unique_id) {
	//alert(id)
	//alert(contract_unique_id)
	if(id == '' && contract_unique_id == ''){
		return false;
	}else{
		$.ajax({
			type: 'POST',	
			url: BASE_URL+"dashboard/showUploadContract",
			data: {
				id : id,contract_unique_id:contract_unique_id
			},
			success: function(data) {
				$('#uploadContractBlock').html(data);
				$('#contractDetailsBlock').hide();
			}
		});
	}
}

function downloadContractFile(id,contract_unique_id)
{
	if(id!='' && contract_unique_id!=''){
		$('#truCSRModalView').modal();
		$.ajax({
			type : "POST",
			url  : BASE_URL + "dashboard/viewContractFile",
			dataType : "JSON",
			data : {id:id,contract_unique_id:contract_unique_id},
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
		//location.href = BASE_URL+'dashboard/downloadContractFile/'+id+'/'+contract_unique_id;
	}
}

function downloadAllContracts(){
	//var development_id=$('#hidden_development_id').val();
	var contract_ids = [];
	$('.chk_box_unsigned:checked').each(function(i, e) {
		contract_ids.push($(this).val());
	});
	
	$('.chk_box_signed:checked').each(function(i, e) {
		contract_ids.push($(this).val());
	});
	//console.log(contract_ids);
	if(contract_ids==''){
		 $.toast({
			heading: '',
			text: 'Please select at least one checkbox',
			showHideTransition: 'slide',
			icon: 'error'
		});
		return false;
	}
	
	$.ajax({
		type: 'POST',	
		url: BASE_URL+'dashboard/downloadAllContracts',
		dataType: 'json',
		data: {contract_ids:contract_ids},
		success: function(response) {
			console.log(response);
			if(response.flag == 1) {
				location.href = BASE_URL+'public/uploads/contract/logs/'+response.msg;
				//console.log(location.href);
			}else{
				$.toast({
					heading: '',
					text: response.msg,
					showHideTransition: 'slide',
					icon: 'error'
				})
			}				
		}
		
	});
}


function downloadPayslipFile(id,file_name)
{
	if(id!='' && file_name!=''){
		$('#truCSRModalView').modal();
		$.ajax({
			type : "POST",
			url  : BASE_URL + "dashboard/viewPayslipFile",
			dataType : "JSON",
			data : {id:id,file_name:file_name},
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
		//location.href = BASE_URL+'dashboard/downloadPayslipFile/'+id+'/'+file_name;
	}
}

//Transaction popup - Display
function openTransactionPopup(id) {
	if(id == ''){
		return false;
	}else{
		$.ajax({
			type: 'POST',	
			dataType: 'html',
			url: BASE_URL+'dashboard/openTransactionPopup',
			data: {id : id},
			success: function (response) {
				$('#truCSRModalContent').html(response);
				$('#truCSRModal').modal({show:true});
			}
		});
	}
}

function readPaymentURL(input) {
	
    if (input.files && input.files[0]) {
		var file = input.files[0];
		var extension = file.name.split('.').pop().toLowerCase();
        
        console.log(file);
		console.log(extension);
		
		if ( /\.(jpe?g|png|pdf)$/i.test(file.name) ) {
            var reader = new FileReader();
            var pdfImage = BASE_URL+'skin/images/pdf-icon.png';
          
			reader.onload = function(e) {
				//if(extension == 'pdf'){
					$("#payment_upload_name").html("<span class=\"upload-contract-file\">" + "<span class=\"file-name\">" + file.name + "</span><span class=\"remove-contract\">X</span>" + "</span>");
					$("#payment_upload").hide();
				// }else{
					// $("#payment_upload_name").html("<span class=\"upload-payment-file\">" + "<span class=\"file-name\">" + file.name + "</span><span class=\"remove-payment\">X</span>" + "</span>");
					// $("#payment_upload").hide();
				// }
			  
				$(".remove-contract").click(function(){
					$(this).parent(".upload-contract-file").remove();
					$("#payment_upload").val('');
					$("#payment_upload").show();
				});
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