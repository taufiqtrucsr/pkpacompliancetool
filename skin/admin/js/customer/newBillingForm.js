//================= Add new customer billing FORM AND Remove START =============//
function addForm(baseUrl,Cid)
{
	var ni = document.getElementById('billingFormId');
	var numi = document.getElementById('theValue');

	var num = (document.getElementById("theValue").value -1)+ 2;
	numi.value = num;
	var divIdName = "my"+num+"Div";
	var newdiv	= document.createElement('div');
	document.getElementById('newBillingListSaveId').style.display = 'none'; 
	billingList(baseUrl,'addForm',Cid);
	$.ajax({
			type:'POST',
			url: baseUrl+'admin.php/customer/ajaxAddNewBillingDetail',
			data:'index='+num+'&divName='+divIdName+'&id='+Cid,
			success: function(form){
			newdiv.setAttribute("id",divIdName);
			newdiv.innerHTML = '<br/><hr> <div><b>New billing </b></div>'+form;
			ni.appendChild(newdiv);
			}
		 });
	return false;
}

function removeElement(divNum) {
  var d = document.getElementById('billingFormId');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}

//================= Add new customer billing FORM AND Remove END =============//

//================= Add new customer billing detail START =============//

function addBillingDetail(baseUrl,index,divName,Cid) 
{
	var title		= document.getElementById('titleId'+index).value;
	var first_name	= document.getElementById('first_nameId'+index).value;
	var last_name	= document.getElementById('last_nameId'+index).value;
	var gender		= document.getElementById('genderId'+index).value;
	var address		= document.getElementById('addressId'+index).value;
	var country		= document.getElementById('countryId'+index).value;
	var state		= document.getElementById('stateId'+index).value;
	var city		= document.getElementById('cityId'+index).value;
	var pincode		= document.getElementById('pincodeId'+index).value;
	var mobile		= document.getElementById('mobileId'+index).value;
	var phSTD		= document.getElementById('phSTDID'+index).value;
	var phNo		= document.getElementById('phNoID'+index).value;
	var error		= document.getElementById('error'+index);
	var msg			= document.getElementById('newBillingListSaveId');
	$.ajax({
			type:'POST',
			url: baseUrl+'admin.php/customer/ajaxBilling',
			data:'id='+Cid+'&title='+title+'&fname='+first_name+'&lname='+last_name+'&gender='+gender+'&add='+address+'&country='+country+'&state='+state+'&city='+city+'&pincode='+pincode+'&mobile='+mobile+'&phSTD='+phSTD+'&phNo='+phNo,
			success: function(data){
				//document.getElementById('error').style.display = 'block';
	
				if(data == 'true'){
					
					document.getElementById('newBillingListSaveId').style.display = 'block';
					msg.innerHTML ='<ul style="margin-top: 10px;" id = "success"><li>New Billing successfully save!</li></ul>';
					document.getElementById('success').style.background = 'none repeat scroll 0 0 #CEFACA';
					document.getElementById('success').style.border = '1px solid #4AFE3B';
					document.getElementById('customerBillingListId').style.display	= 'none';
					document.getElementById(divName).style.display	= 'none';
					var msgFrom = 'addBilling';
					billingList(baseUrl,msgFrom,Cid);
				}else if(data == 'false'){
					error.innerHTML	= '<ul style="margin-bottom: 0 padding-bottom: 0" class="error" ><li>Error in New billing !</li></ul>';			
				}else{
					error.innerHTML	= data;
				}
			}
		 });
	return false;
}

function saveCustomerListBilling(baseUrl,index,Bid,Cid)
{
	var title		= document.getElementById('titleId'+index).value;
	var first_name	= document.getElementById('first_nameId'+index).value;
	var last_name	= document.getElementById('last_nameId'+index).value;
	var gender		= document.getElementById('genderId'+index).value;
	var address		= document.getElementById('addressId'+index).value;
	var country		= document.getElementById('countryId'+index).value;
	var state		= document.getElementById('stateId'+index).value;
	var city		= document.getElementById('cityId'+index).value;
	var pincode		= document.getElementById('pincodeId'+index).value;
	var mobile		= document.getElementById('mobileId'+index).value;
	var phSTD		= document.getElementById('phSTDID'+index).value;
	var phNo		= document.getElementById('phNoID'+index).value;
	var error		= document.getElementById('error'+index);

	$.ajax({
			type:'POST',
			url: baseUrl+'admin.php/customer/ajaxUpdateBilling',
			data:'id='+Cid+'&title='+title+'&fname='+first_name+'&lname='+last_name+'&gender='+gender+'&add='+address+'&country='+country+'&state='+state+'&city='+city+'&pincode='+pincode+'&mobile='+mobile+'&phSTD='+phSTD+'&phNo='+phNo+'&Bid='+Bid,
			success: function(data){
				//document.getElementById('error').style.display = 'block';
				document.getElementById('newBillingListSaveId').style.display = 'none';
				document.getElementById('error').style.display = 'none';
				if(data == 'true'){
					
					error.innerHTML	= '<ul style="margin-bottom: 0 padding-bottom: 0" id = "success'+index+'"><li>Billing detail successfully updated!</li></ul>';
					document.getElementById('success'+index).style.background = 'none repeat scroll 0 0 #CEFACA';
					document.getElementById('success'+index).style.border = '1px solid #4AFE3B';
					
				}else if(data == 'false'){
					error.innerHTML	= '<ul style="margin-bottom: 0 padding-bottom: 0" class="error"><li>Error in updating billing detail!</li></ul>';			
				}else{
					error.innerHTML	= data;
				}
			}
		 });
	return false;
}
//================= Add new customer billing detail END =============//