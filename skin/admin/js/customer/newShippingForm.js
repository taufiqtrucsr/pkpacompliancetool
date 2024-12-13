//================= Add new customer shipping FORM AND Remove START =============//
function addForm(baseUrl,Cid)
{
	var ni = document.getElementById('shippingFormId');
	var numi = document.getElementById('theValue');

	var num = (document.getElementById("theValue").value -1)+ 2;
	numi.value = num;
	var divIdName = "my"+num+"Div";
	var newdiv	= document.createElement('div');
	document.getElementById('newShippingListSaveId').style.display = 'none'; 
	shippingList(baseUrl,'addForm',Cid);
	$.ajax({
			type:'POST',
			url: baseUrl+'admin.php/customer/ajaxAddNewShippingDetail',
			data:'index='+num+'&divName='+divIdName+'&id='+Cid,
			success: function(form){
			newdiv.setAttribute("id",divIdName);
			newdiv.innerHTML = '<br/><hr> <div><b>New shipping </b></div>'+form;
			ni.appendChild(newdiv);
			}
		 });
	return false;
}

function removeElement(divNum) {
  var d = document.getElementById('shippingFormId');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}

//================= Add new customer shipping FORM AND Remove END =============//

//================= Add new customer shipping detail START =============//

function addShippingDetail(baseUrl,index,divName,Cid) 
{
	//var title		= document.getElementById('titleId'+index).value;
	var first_name	= document.getElementById('first_nameId'+index).value;
	var last_name	= document.getElementById('last_nameId'+index).value;
	var gender		= document.getElementById('genderId'+index).value;
	var address		= document.getElementById('addressId'+index).value;
	var country		= document.getElementById('countryId'+index).value;
	var landmark	= document.getElementById('landmarkId'+index).value;
	var state		= document.getElementById('stateId'+index).value;
	var city		= document.getElementById('cityId'+index).value;
	var pincode		= document.getElementById('pincodeId'+index).value;
	var mobile		= document.getElementById('mobileId'+index).value;
	var phSTD		= document.getElementById('phSTDID'+index).value;
	var phNo		= document.getElementById('phNoID'+index).value;
	var error		= document.getElementById('error'+index);
	var msg			= document.getElementById('newShippingListSaveId');
	$.ajax({
			type:'POST',
			url: baseUrl+'admin.php/customer/ajaxShipping',
			//data:'id='+Cid+'&title='+title+'&fname='+first_name+'&lname='+last_name+'&gender='+gender+'&add='+address+'&country='+country+'&state='+state+'&city='+city+'&pincode='+pincode+'&mobile='+mobile+'&phSTD='+phSTD+'&phNo='+phNo,
			data:'landmark='+landmark+'&id='+Cid+'&fname='+first_name+'&lname='+last_name+'&gender='+gender+'&add='+address+'&country='+country+'&state='+state+'&city='+city+'&pincode='+pincode+'&mobile='+mobile+'&phSTD='+phSTD+'&phNo='+phNo,
			success: function(data){
				//document.getElementById('error').style.display = 'block';
	
				if(data == 'true'){
					
					document.getElementById('newShippingListSaveId').style.display = 'block';
					msg.innerHTML ='<ul style="margin-top: 10px;" id = "success"><li>New Shipping successfully save!</li></ul>';
					document.getElementById('success').style.background = 'none repeat scroll 0 0 #CEFACA';
					document.getElementById('success').style.border = '1px solid #4AFE3B';
					document.getElementById('customerShippingListId').style.display	= 'none';
					document.getElementById(divName).style.display	= 'none';
					var msgFrom = 'addShipping';
					shippingList(baseUrl,msgFrom,Cid);
				}else if(data == 'false'){
					error.innerHTML	= '<ul style="margin-bottom: 0 padding-bottom: 0" class="error" ><li>Error in New shipping !</li></ul>';			
				}else{
					error.innerHTML	= data;
				}
			}
		 });
	return false;
}

function saveCustomerListShipping(baseUrl,index,Bid,Cid)
{
	//var title		= document.getElementById('titleId'+index).value;
	var first_name	= document.getElementById('first_nameId'+index).value;
	var last_name	= document.getElementById('last_nameId'+index).value;
	var gender		= document.getElementById('genderId'+index).value;
	var address		= document.getElementById('addressId'+index).value;
	var country		= document.getElementById('countryId'+index).value;
	var landmark	= document.getElementById('landmarkId'+index).value;
	var state		= document.getElementById('stateId'+index).value;
	var city		= document.getElementById('cityId'+index).value;
	var pincode		= document.getElementById('pincodeId'+index).value;
	var mobile		= document.getElementById('mobileId'+index).value;
	var phSTD		= document.getElementById('phSTDID'+index).value;
	var phNo		= document.getElementById('phNoID'+index).value;
	var error		= document.getElementById('error'+index);

	$.ajax({
			type:'POST',
			url: baseUrl+'admin.php/customer/ajaxUpdateShipping',
			//data:'id='+Cid+'&title='+title+'&fname='+first_name+'&lname='+last_name+'&gender='+gender+'&add='+address+'&country='+country+'&state='+state+'&city='+city+'&pincode='+pincode+'&mobile='+mobile+'&phSTD='+phSTD+'&phNo='+phNo+'&Bid='+Bid,
			data:'landmark='+landmark+'&id='+Cid+'&fname='+first_name+'&lname='+last_name+'&gender='+gender+'&add='+address+'&country='+country+'&state='+state+'&city='+city+'&pincode='+pincode+'&mobile='+mobile+'&phSTD='+phSTD+'&phNo='+phNo+'&Bid='+Bid,
			success: function(data){
				//document.getElementById('error').style.display = 'block';
				document.getElementById('newShippingListSaveId').style.display = 'none';
				document.getElementById('error').style.display = 'none';
				if(data == 'true'){
					
					error.innerHTML	= '<ul style="margin-bottom: 0 padding-bottom: 0" id = "success'+index+'"><li>Shipping detail successfully updated!</li></ul>';
					document.getElementById('success'+index).style.background = 'none repeat scroll 0 0 #CEFACA';
					document.getElementById('success'+index).style.border = '1px solid #4AFE3B';
					
				}else if(data == 'false'){
					error.innerHTML	= '<ul style="margin-bottom: 0 padding-bottom: 0" class="error"><li>Error in updating shipping detail!</li></ul>';			
				}else{
					error.innerHTML	= data;
				}
			}
		 });
	return false;
}
//================= Add new customer shipping detail END =============//