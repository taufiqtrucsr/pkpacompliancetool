function shippingList(baseUrl,msgFrom,Cid)
{
	var shippingForm		= document.getElementById('customerShippingListId');
	if(msgFrom == 'List' || msgFrom == 'addForm' ){
		document.getElementById('newShippingListSaveId').style.display = 'none';
	}else{
		document.getElementById('newShippingListSaveId').style.display = 'block';
	}
	$('#customerShippingListId').toggle();
	$.ajax({
			type:'POST',
			url: baseUrl+'admin.php/customer/ajaxShippingList',
			data:'id='+Cid,
			success: function(data){
				document.getElementById('error').style.display = 'none';
				//shippingForm.style.display	=	'block';
				shippingForm.innerHTML	= data;
			}
		 });
	return false;
}

function deleteShippingDetail(baseUrl,index,Bid,Cid)
{
	var shippingListDiv	=	document.getElementById('shippingListDiv'+Bid);
	var error			=	document.getElementById('error'+index);
	var msg				=	document.getElementById('newShippingListSaveId');
	$.ajax({
			type:'POST',
			url: baseUrl+'admin.php/customer/ajaxDeleteShipping/',
			data:'id='+Bid,
			success: function(data){
				if(data == 'true'){
					msg.style.display	= 'block';
					msg.innerHTML		=	'<ul  style="margin-top: 10px;" id="success"><li>Shipping detail successfully deleted </li><ul>';
					document.getElementById('success').style.background = 'none repeat scroll 0 0 #CEFACA';
					document.getElementById('success').style.border = '1px solid #4AFE3B';
					var msgFrom = 'delete';
					shippingList(baseUrl,msgFrom,Cid);
					shippingListDiv.style.display	= 'none'; 
					document.getElementById('customerShippingListId').style.display	= 'block';	
				}else{
					error.innerHTML = '<ul class="error"><li>Record not deleted</li><ul>';
				};
			}
		 });
}