function billingList(baseUrl,msgFrom,Cid)
{
	var billingForm		= document.getElementById('customerBillingListId');
	if(msgFrom == 'List' || msgFrom == 'addForm' ){
		document.getElementById('newBillingListSaveId').style.display = 'none';
	}else{
		document.getElementById('newBillingListSaveId').style.display = 'block';
	}
	$('#customerBillingListId').toggle();
	$.ajax({
			type:'POST',
			url: baseUrl+'admin.php/customer/ajaxBillingList',
			data:'id='+Cid,
			success: function(data){
				document.getElementById('error').style.display = 'none';
				//billingForm.style.display	=	'block';
				billingForm.innerHTML	= data;
			}
		 });
	return false;
}

function deleteBillingDetail(baseUrl,index,Bid,Cid)
{
	var billingListDiv	=	document.getElementById('billingListDiv'+Bid);
	var error			=	document.getElementById('error'+index);
	var msg				=	document.getElementById('newBillingListSaveId');
	$.ajax({
			type:'POST',
			url: baseUrl+'admin.php/customer/ajaxDeleteBilling/',
			data:'id='+Bid,
			success: function(data){
				if(data == 'true'){
					msg.style.display	= 'block';
					msg.innerHTML		=	'<ul  style="margin-top: 10px;" id="success"><li>Billing detail successfully deleted </li><ul>';
					document.getElementById('success').style.background = 'none repeat scroll 0 0 #CEFACA';
					document.getElementById('success').style.border = '1px solid #4AFE3B';
					var msgFrom = 'delete';
					billingList(baseUrl,msgFrom,Cid);
					billingListDiv.style.display	= 'none'; 
					document.getElementById('customerBillingListId').style.display	= 'block';	
				}else{
					error.innerHTML = '<ul class="error"><li>Record not deleted</li><ul>';
				};
			}
		 });
}