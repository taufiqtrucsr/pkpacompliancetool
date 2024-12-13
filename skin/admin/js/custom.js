$(document).ready(function() {
	$('#countdown').hide();
	start_countdown();
	
	$(".validate-number").keydown(function(event) {


        if (event.shiftKey == true) {
            event.preventDefault();
        }

        if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

        } else {
            event.preventDefault();
        }

        if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
            event.preventDefault();

    });
	
	$('.validate-char').on('keypress', function(key) {
        //alert(111111)
		if((key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45 && key.charCode != 32 && key.charCode != 0)) {
			return false;	
		}
	});
});
function InvalidCharachter(type, testField)
{
	switch(type)
	{
		case 'text' : 
				var invalidChars = '0123456789`~!@#$%^&*()[]\{\}\-_+=/\'\\"<>,.;:?^|';
				for (i=0; i<invalidChars.length; i++) {
					if (testField.indexOf(invalidChars.charAt(i),0) > -1)
					{
						return false;			
					}
				}
				break;
		case 'number' :
				var invalidNumbers = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz`~!@#$%^&*()[]\{\}\-_=/\'\\"<>,.;:?^|';
				for (i=0; i<invalidNumbers.length; i++) {
					if (testField.indexOf(invalidNumbers.charAt(i),0) > -1)
					{
						return false;			
					}
				}
				break;
		default : 
				return false;
				break;
	}
}


function IsNumeric(strString)
{
	var strValidChars = "0123456789";
	var strChar;
	var blnResult = true;

	if (strString.length == 0) return false;

	for (i = 0; i < strString.length && blnResult == true; i++)
	  {
	  strChar = strString.charAt(i);
	  if (strValidChars.indexOf(strChar) == -1)
		 {
		 blnResult = false;
		 }
	  }
	return blnResult;
}


/**************** Validate Admin user ******************************/
function validateuser()
{
	
	var first_name			= document.getElementById("first_name").value;
	var last_name			= document.getElementById("last_name").value;
	var username			= document.getElementById("user_name").value;
	var user_type			= document.getElementById("user_type").value;
	var password			= document.getElementById("password").value;
	var confirm_password	= document.getElementById("confirm_password").value;
	var email_id			= document.getElementById("email_id").value;

	var error			= document.getElementById('error');
	var regMail		= /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

	var errorMsg = '';
	document.getElementById('error').style.display = 'block';

	
	if(first_name == "")
	{
		errorMsg += "Please enter first name";
		document.getElementById("first_name").focus();
		
	}
	else if(last_name == "")
	{
		errorMsg += "Please enter Lastname";
		document.getElementById("last_name").focus();
		
	}
	else if(username == "")
	{
		errorMsg += "Please enter username";
		document.getElementById("user_name").focus();
		
	}
	else if(user_type == "")
	{
		errorMsg += "Please select user type";
		document.getElementById("user_type").focus();
		
	}
	else if(password == "")
	{
		errorMsg += "Please enter password";
		document.getElementById("password").focus();
		
	}
	else if(confirm_password == "")
	{
		errorMsg += "Please enter Confirm password ";
		document.getElementById("confirm_password").focus();
		
	}
	else if(confirm_password != "" && password != confirm_password)
	{
		errorMsg += "Please enter password and Confirm password must be same";
		document.getElementById("confirm_password").focus();
		
	}
	else if(email_id == "")
	{
		errorMsg += "Please enter valid Email";
		document.getElementById("email_id").focus();
		
	}
	else if(!regMail.test(email_id) && email_id != '' ){
		errorMsg += 'Please enter valid Email ID.'; 
		document.getElementById('email_id').focus();
	}

	if(errorMsg != '')
	{
		error.innerHTML = errorMsg;
		return false;
	}
		
	return true;
	
}


/************************ Validate customer **********************************/

function validate_customer()
{
	
	var first_name			= document.getElementById("first_name").value;
	var lastname			= document.getElementById("last_name").value;
	
	var email_id			= document.getElementById("email_id").value;
	var phone				= document.getElementById("phone").value;

	var error				= document.getElementById('error');
	var regMail				= /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

	var errorMsg = '';
	document.getElementById('error').style.display = 'block';


	
	if(first_name == "")
	{
		errorMsg += "Please enter first name";
		document.getElementById("first_name").focus();
		
	}
	else if(lastname == "")
	{
		errorMsg += "Please enter Lastname";
		document.getElementById("last_name").focus();
		
	}
	else if(email_id == "")
	{
		errorMsg += "Please enter valid Email";
		document.getElementById("email_id").focus();
		
	}
	else if(!regMail.test(email_id) && email_id != '' ){
		errorMsg += 'Please enter valid Email ID.'; 
		document.getElementById('email_id').focus();
	}

	
	else if(phone == "")
	{
		errorMsg += "Please enter valid phone number ";
		document.getElementById("phone").focus();
		
	}
	
	if(errorMsg != ''){
		error.innerHTML = errorMsg;
		return false;
	}
		
	return true;
	
}


/************************ Validate Buyer **********************************/

function validate_buyer()
{
	
	var first_name			= document.getElementById("first_name").value;
	var lastname			= document.getElementById("last_name").value;
	var username			= document.getElementById("username").value;
	var password			= document.getElementById("password").value;
	var confirm_password	= document.getElementById("confirm_password").value;
	var email_id			= document.getElementById("email_id").value;
	var phone				= document.getElementById("phone").value;
	var website_url			= document.getElementById("website_url").value;

	var error			= document.getElementById('error');
	var regMail		= /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

	var errorMsg = '';
	document.getElementById('error').style.display = 'block';

	if(first_name == "")
	{
		errorMsg += "Please enter first name";
		document.getElementById("first_name").focus();
		
	}
	else if(lastname == "")
	{
		errorMsg += "Please enter Lastname";
		document.getElementById("last_name").focus();
		
	}
	else if(email_id == "")
	{
		errorMsg += "Please enter valid Email";
		document.getElementById("email_id").focus();
		
	}
	else if(!regMail.test(email_id) && email_id != '' ){
		errorMsg += 'Please enter valid Email ID.'; 
		document.getElementById('email_id').focus();
	}

	else if(username == "")
	{
		errorMsg += "Please enter username";
		document.getElementById("username").focus();
		
	}
	else if(password == "")
	{
		errorMsg += "Please enter password";
		document.getElementById("password").focus();
		
	}
	else if(confirm_password == "")
	{
		errorMsg += "Please enter Confirm password ";
		document.getElementById("confirm_password").focus();
		
	}
	else if(phone == "")
	{
		errorMsg += "Please enter valid phone number ";
		document.getElementById("phone").focus();
		
	}
	else if(website_url == "")
	{
		errorMsg += "Please enter valid website url ";
		document.getElementById("website_url").focus();
		
	}

	if(errorMsg != ''){
		error.innerHTML = errorMsg;
		return false;
	}
		

	
}

/************************* Validate category*************************************/

function validate_category()
{
	var category_name		= document.getElementById("category_name").value;

	var error			= document.getElementById('error');
	var regMail		= /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

	var errorMsg = '';
	document.getElementById('error').style.display = 'block';


	if(category_name == "")
	{
		errorMsg += "Please enter category name.";
		document.getElementById("category_name").focus();
		
	}

	if(errorMsg != ''){
		error.innerHTML = errorMsg;
		return false;
	}
		
	return true;
	
}



/******** Add Product Validaton ******** Start *******************/

function ValidateProduct()
{
	var P_Name			= document.getElementById("name").value;
	var P_Cat			= document.getElementById("category").value;
	var P_Desc			= document.getElementById("message").value;
	var P_MetaTitle		= document.getElementById("meta_title").value;
	var P_MetaKeyword	= document.getElementById("meta_keyword").value;
	var P_MetaDesc		= document.getElementById("meta_description").value;
	var P_MainSku		= document.getElementById("main_sku").value;
	var P_Image1		= document.getElementById("image1").value;
	var p_qty			= document.getElementById("p_qty").value;
	var unit_price		= document.getElementById("unit_price").value;

	var error			= document.getElementById('error');
	var regMail		= /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

	var errorMsg = '';
	document.getElementById('error').style.display = 'block';


	if(P_Name == "")
	{
		errorMsg +=  "Please enater product name";
		document.getElementById("name").focus();
	}
	else if(P_Cat == "")
	{
		errorMsg += "Please select category";
		document.getElementById("category").focus();
	}
	else if(P_Desc == "")
	{
		errorMsg += "Please enter description";
		document.getElementById("message").focus();
	}
	else if(P_MetaTitle == "")
	{
		errorMsg +=  "Please enter meta title";
		document.getElementById("meta_title").focus();
		
	}
	else if(P_MetaKeyword == "")
	{
		errorMsg +=  "Please enter meta keyword";
		document.getElementById("meta_keyword").focus();
		
	}
	else if(P_MetaDesc == "")
	{
		errorMsg += "Please enter meta description";
		document.getElementById("meta_description").focus();
		
	}
	else if(P_MainSku == "")
	{
		errorMsg += "Please enate main sku";
		document.getElementById("main_sku").focus();
		
	}
	else if(P_Image1 == "")
	{
		errorMsg +=  "Please Select image";
		document.getElementById("image1").focus();

	}
	else if(p_qty == "")
	{
		errorMsg += "Please enetr quantity";
		document.getElementById("p_qty").focus();
	
	}
	else if(unit_price == "")
	{
		errorMsg +=  "Please enetr proper unit price";
		document.getElementById("unit_price").focus();
		
	}

	if(errorMsg != ''){
		error.innerHTML = errorMsg;
		return false;
	}
	
	
}

/**************** Validate Banner**********************************/

function validate_banner()
{
	var banner_image		= document.getElementById("hidden_image").value;


	var error			= document.getElementById('error');
	var regMail		= /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

	var errorMsg = '';
	document.getElementById('error').style.display = 'block';


	if(banner_image == "")
	{
		errorMsg += "Please Select proper image.";
		document.getElementById("banner_image").focus();
		
	}

	if(errorMsg != ''){
		error.innerHTML = errorMsg;
		return false;
	}
		
	return true;
	
}

/***************************************************/

function validate_cms()
{
	var P_Name			= document.getElementById("p_name").value;
	var p_title			= document.getElementById("p_title").value;
	var p_meta_title	= document.getElementById("p_meta_title").value;
	var p_meta_keyword	= document.getElementById("p_meta_keyword").value;
	var p_meta_description= document.getElementById("p_meta_description").value;
	var message		    = document.getElementById("message").value;

	var error			= document.getElementById('error');
	var regMail		= /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

	var errorMsg = '';
	document.getElementById('error').style.display = 'block';


	if(P_Name == "")
	{
		errorMsg +=  "Please enater page name";
		document.getElementById("p_name").focus();
	}
	else if(p_title == "")
	{
		errorMsg += "Please select page title";
		document.getElementById("p_title").focus();
	}
	else if(p_meta_title == "")
	{
		errorMsg += "Please enter page meta title";
		document.getElementById("p_meta_title").focus();
	}
	
	else if(p_meta_keyword == "")
	{
		errorMsg +=  "Please enter meta keyword";
		document.getElementById("p_meta_keyword").focus();
		
	}
	else if(p_meta_description == "")
	{
		errorMsg += "Please enter meta description";
		document.getElementById("p_meta_description").focus();
		
	}
	else if(message == "")
	{
		errorMsg += "Please enter description";
		document.getElementById("message").focus();
		
	}


	if(errorMsg != ''){
		error.innerHTML = errorMsg;
		return false;

	}
	
}
	
function validate_faq()
{
	var type = document.getElementById("type").value;
	var question = document.getElementById("question").value;
	var answer	= document.getElementById("answer").value;
	var errorMsg = '';
	document.getElementById('error').style.display = 'block';


	if(type == "")
	{
		errorMsg +=  "Please enater FAQ type";
		document.getElementById("type").focus();
	}
	else if(question == "")
	{
		errorMsg += "Please select FAQ question";
		document.getElementById("question").focus();
	}
	else if(answer == "")
	{
		errorMsg += "Please enter FAQ answer";
		document.getElementById("answer").focus();
	}

	if(errorMsg != ''){
		error.innerHTML = errorMsg;
		return false;
	}
}

function validate_global_msg()
{
	var msg = document.getElementById("global_msg").value;
	var msg_identifier = document.getElementById("global_msg_identifier").value;
	var msg_flag	= document.getElementById("global_msg_flag").value;
	var errorMsg = '';
	document.getElementById('error').style.display = 'block';


	if(msg == "")
	{
		errorMsg +=  "Please enter Message";
		document.getElementById("global_msg").focus();
	}
	else if(msg_identifier == "")
	{
		errorMsg += "Please enter message identifier for message";
		document.getElementById("global_msg_identifier").focus();
	}
	else if(msg_flag == "")
	{
		errorMsg += "Please select flag for the global message";
		document.getElementById("global_msg_flag").focus();
	}

	if(errorMsg != ''){
		error.innerHTML = errorMsg;
		return false;
	}
}

function validate_global_msg_add()
{
	var msg = document.getElementById("global_msg").value;
	var msg_identifier = document.getElementById("global_msg_identifier").value;
	var msg_flag	= document.getElementById("global_msg_flag").value;
	var errorMsg = '';
	document.getElementById('error').style.display = 'block';


	if(msg == "")
	{
		errorMsg +=  "Please enter Message";
		document.getElementById("global_msg").focus();
	}
	else if(msg_identifier == "")
	{
		errorMsg += "Please enter message identifier for message";
		document.getElementById("global_msg_identifier").focus();
	}
	else if(msg_flag == "")
	{
		errorMsg += "Please select flag for the global message";
		document.getElementById("global_msg_flag").focus();
	}

	if(errorMsg != ''){
		error.innerHTML = errorMsg;
		return false;
	}
}

function validate_expert()
{
	var expert_name = document.getElementById("expert_name").value;
	var designation = document.getElementById("designation").value;
	var profile_pic	= document.getElementById("profile_pic").value;
	var description	= document.getElementById("description").value;
	var position	= document.getElementById("position").value;
	var errorMsg = '';
	document.getElementById('error').style.display = 'block';


	if(expert_name == "")
	{
		errorMsg +=  "Please enter expert name";
		document.getElementById("expert_name").focus();
	}
	else if(designation == "")
	{
		errorMsg += "Please enter designation";
		document.getElementById("designation").focus();
	}
	else if(description == "")
	{
		errorMsg += "Please enter description";
		document.getElementById("description").focus();
	}
	else if(position == "")
	{
		errorMsg += "Please enter position";
		document.getElementById("position").focus();
	}

	if(errorMsg != ''){
		error.innerHTML = errorMsg;
		return false;
	}
}

function validate_lookbook()
{
	var title = document.getElementById("title").value;
	var sub_title = document.getElementById("sub_title").value;
	var tag = document.getElementById("tag").value;
	var description	= document.getElementById("description").value;
	var short_description = document.getElementById("short_description").value;
	var video_link = document.getElementById("video_link").value;
	var regex_url = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
	var profile_pic	= document.getElementById("profile_pic").value;
	var profile_pic_home = document.getElementById("profile_pic_home").value;
	var products_used	= document.getElementById("products_used").value;
	var position	= document.getElementById("position").value;
	var errorMsg = '';
	document.getElementById('error').style.display = 'block';


	if(title == "")
	{
		errorMsg +=  "Please enter title";
		document.getElementById("title").focus();
	}
	else if(sub_title == "")
	{
		errorMsg += "Please enter sub title";
		document.getElementById("sub_title").focus();
	}
	else if(tag == "")
	{
		errorMsg += "Please enter tag";
		document.getElementById("tag").focus();
	}
	else if(description == "")
	{
		errorMsg += "Please enter description";
		document.getElementById("description").focus();
	}
	else if(short_description == "")
	{
		errorMsg += "Please enter short designation";
		document.getElementById("short_description").focus();
	}
	else if(video_link == "")
	{
		errorMsg += "Please enter video";
		document.getElementById("video_link").focus();
	}
    else if(!video_link.match(regex_url)){
        errorMsg += "Please enter correct url";
		document.getElementById("video_link").focus();
    }
	else if(profile_pic == "")
	{
		errorMsg += "Please select profile pic";
		document.getElementById("profile_pic").focus();
	}
	else if(profile_pic_home == "")
	{
		errorMsg += "Please select profile pic home";
		document.getElementById("profile_pic_home").focus();
	}
	else if(products_used == "")
	{
		errorMsg += "Please select products";
		document.getElementById("products_used").focus();
	}	
	else if(position == "")
	{
		errorMsg += "Please enter position";
		document.getElementById("position").focus();
	}

	if(errorMsg != ''){
		error.innerHTML = errorMsg;
		return false;
	}
}

function validate_lookbook_edit()
{
	var title = document.getElementById("title").value;
	var sub_title = document.getElementById("sub_title").value;
	var tag = document.getElementById("tag").value;
	var description	= document.getElementById("description").value;
	var short_description = document.getElementById("short_description").value;
	var video_link = document.getElementById("video_link").value;
	var regex_url = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
	var profile_pic	= document.getElementById("profile_pic").value;
	var hidden_image	= document.getElementById("hidden_image").value;
	var profile_pic_home = document.getElementById("profile_pic_home").value;
	var hidden_image_home = document.getElementById("hidden_image_home").value;
	var products_used	= document.getElementById("products_used").value;
	var position	= document.getElementById("position").value;
	var errorMsg = '';
	document.getElementById('error').style.display = 'block';


	if(title == "")
	{
		errorMsg +=  "Please enter title";
		document.getElementById("title").focus();
	}
	else if(sub_title == "")
	{
		errorMsg += "Please enter sub title";
		document.getElementById("sub_title").focus();
	}
	else if(tag == "")
	{
		errorMsg += "Please enter tag";
		document.getElementById("tag").focus();
	}
	else if(description == "")
	{
		errorMsg += "Please enter description";
		document.getElementById("description").focus();
	}
	else if(short_description == "")
	{
		errorMsg += "Please enter short designation";
		document.getElementById("short_description").focus();
	}
	else if(video_link == "")
	{
		errorMsg += "Please enter video";
		document.getElementById("video_link").focus();
	}
    else if(!video_link.match(regex_url)){
        errorMsg += "Please enter correct url";
		document.getElementById("video_link").focus();
    }
	else if(hidden_image == "")
	{
		errorMsg += "Please select profile pic";
		document.getElementById("profile_pic").focus();
	}
	else if(hidden_image_home == "")
	{
		errorMsg += "Please select profile pic home";
		document.getElementById("profile_pic_home").focus();
	}
	else if(products_used == "")
	{
		errorMsg += "Please select products";
		document.getElementById("products_used").focus();
	}	
	else if(position == "")
	{
		errorMsg += "Please enter position";
		document.getElementById("position").focus();
	}

	if(errorMsg != ''){
		error.innerHTML = errorMsg;
		return false;
	}
}

function validate_product()
{
	var name = document.getElementById("name").value;
	var title = document.getElementById("title").value;
	var sub_title = document.getElementById("sub_title").value;
	var sku = document.getElementById("sku").value;
	var price = document.getElementById("price").value;
	var check_num = /\d+(?:\.\d{1,2})?/;
	//var gp_point = document.getElementById("gp_point").value;
	var quantity = document.getElementById("quantity").value;
	var category = document.getElementById("category").value;
	var sub_category= document.getElementById("sub_category").value;
	var hair_type = document.getElementById("hair_type").value;
	var product_type = document.getElementById("product_type").value;
	var concerns = document.getElementById("concerns").value;
	var result = document.getElementById("result").value;
	var simple_products = document.getElementById("simple_products").value
	var short_description = document.getElementById("short_description").value;;
	var long_description	= document.getElementById("long_description").value;
	var ingredients	= document.getElementById("ingredients").value;
	var how_to	= document.getElementById("how_to").value;
	var video_title = document.getElementById("video_title").value;
	var video_url = document.getElementById("video_url").value;
	var regex_url = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
	var product_image1	= document.getElementById("product_image1").value;
	var errorMsg = '';
	document.getElementById('error').style.display = 'block';
	//alert(product_image1);

	if(name == "")
	{
		errorMsg +=  "Please enter name";
		document.getElementById("name").focus();
	}
	else if(title == "")
	{
		errorMsg +=  "Please enter title";
		document.getElementById("title").focus();
	}
	else if(sub_title == "")
	{
		errorMsg += "Please enter sub title";
		document.getElementById("sub_title").focus();
	}
	else if(sku == "")
	{
		errorMsg += "Please enter sku";
		document.getElementById("sku").focus();
	}
	else if(price == "")
	{
		errorMsg +=  "Please enter price";
		document.getElementById("price").focus();
	}
	else if (!check_num.test(price)) 
	{ 
		errorMsg += "Please enter numeric value for price";
		document.getElementById("price").focus();
	}
	else if(quantity == "")
	{
		errorMsg += "Please enter quantity";
		document.getElementById("quantity").focus();
	}
	else if (!check_num.test(quantity)) 
	{ 
		errorMsg += "Please enter numeric value for quantity";
		document.getElementById("quantity").focus();
	}	
	else if(category == "")
	{
		errorMsg += "Please select category";
		document.getElementById("category").focus();
	}
	else if(sub_category == "")
	{
		errorMsg += "Please select sub category";
		document.getElementById("sub_category").focus();
	}
	else if(hair_type == "")
	{
		errorMsg += "Please select hair type";
		document.getElementById("hair_type").focus();
	}
	else if(product_type == "")
	{
		errorMsg += "Please select product type";
		document.getElementById("product_type").focus();
	}
	else if(concerns == "")
	{
		errorMsg += "Please enetr concerns";
		document.getElementById("concerns").focus();
	}
	else if(long_description == "")
	{
		errorMsg += "Please enter long description";
		document.getElementById("long_description").focus();
	}
	else if(product_image1 == "")
	{
		errorMsg += "Please select image";
		document.getElementById("product_image1").focus();
	}
	else if(video_url != "")
	{
		if(!video_url.match(regex_url)){
        errorMsg += "Please enter correct url";
		document.getElementById("video_url").focus();
		}
    }

	if(errorMsg != ''){
		error.innerHTML = errorMsg;
		return false;
	}
}

function validate_product_edit()
{
	var name = document.getElementById("name").value;
	var title = document.getElementById("title").value;
	var sub_title = document.getElementById("sub_title").value;
	var sku = document.getElementById("sku").value;
	var price = document.getElementById("price").value;
	var check_num = /\d+(?:\.\d{1,2})?/;
	//var gp_point = document.getElementById("gp_point").value;
	var quantity = document.getElementById("quantity").value;
	var category = document.getElementById("category").value;
	var sub_category= document.getElementById("sub_category").value;
	var hair_type = document.getElementById("hair_type").value;
	var product_type = document.getElementById("product_type").value;
	var concerns = document.getElementById("concerns").value;
	var result = document.getElementById("result").value;
	var simple_products = document.getElementById("simple_products").value
	var short_description = document.getElementById("short_description").value;;
	var long_description	= document.getElementById("long_description").value;
	var ingredients	= document.getElementById("ingredients").value;
	var how_to	= document.getElementById("how_to").value;
	var video_title = document.getElementById("video_title").value;
	var video_url = document.getElementById("video_url").value;
	var regex_url = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
	var product_image1	= document.getElementById("product_image1").value;
	var hidden_product_image1	= document.getElementById("hidden_product_image1").value;
	var errorMsg = '';
	document.getElementById('error').style.display = 'block';
	

	if(name == "")
	{
		errorMsg +=  "Please enter name";
		document.getElementById("name").focus();
	}
	else if(title == "")
	{
		errorMsg +=  "Please enter title";
		document.getElementById("title").focus();
	}
	else if(sub_title == "")
	{
		errorMsg += "Please enter sub title";
		document.getElementById("sub_title").focus();
	}
	else if(sku == "")
	{
		errorMsg += "Please enter sku";
		document.getElementById("sku").focus();
	}
	else if(price == "")
	{
		errorMsg +=  "Please enter price";
		document.getElementById("price").focus();
	}
	else if (!check_num.test(price)) 
	{ 
		errorMsg += "Please enter numeric value for price";
		document.getElementById("price").focus();
	}
	else if(quantity == "")
	{
		errorMsg += "Please enter quantity";
		document.getElementById("quantity").focus();
	}
	else if (!check_num.test(quantity)) 
	{ 
		errorMsg += "Please enter numeric value for quantity";
		document.getElementById("quantity").focus();
	}	
	else if(category == "")
	{
		errorMsg += "Please select category";
		document.getElementById("category").focus();
	}
	else if(sub_category == "")
	{
		errorMsg += "Please select sub category";
		document.getElementById("sub_category").focus();
	}
	else if(hair_type == "")
	{
		errorMsg += "Please select hair type";
		document.getElementById("hair_type").focus();
	}
	else if(product_type == "")
	{
		errorMsg += "Please select product type";
		document.getElementById("product_type").focus();
	}
	else if(concerns == "")
	{
		errorMsg += "Please enetr concerns";
		document.getElementById("concerns").focus();
	}
	else if(long_description == "")
	{
		errorMsg += "Please enter long description";
		document.getElementById("long_description").focus();
	}
	else if(hidden_product_image1 == "")
	{
		if(product_image1 == "")
		{
			errorMsg += "Please select image";
			document.getElementById("product_image1").focus();
		}
	}
	else if(video_url != "")
	{
		if(!video_url.match(regex_url)){
        errorMsg += "Please enter correct url";
		document.getElementById("video_url").focus();
		}
    }

	if(errorMsg != ''){
		error.innerHTML = errorMsg;
		return false;
	}
}

function start_countdown()
{
	myVar= setInterval(function()
	{ 
	$.ajax
	   ({
		type:'get',
		url:BASE_URL+'admin.php/common/checkSession',
		data:{
		  //logout:"logout"
		},
		success:function(response) 
		{
			if(response == "logout"){
			window.location = BASE_URL+'admin.php/user/logout';  
			}else{
				if(response != ""){
					$('#countdown').show();
					//$('#countdown').html(response);
					$('#countdown').html('<a data-toggle="tooltip" title="Your session will expire in!">' + response +'</a>');
				}else{
					$('#countdown').hide();
					$('#countdown').html('');
				}
			}
		}
	   });
	}, 1000)
}


$(document).ready(function(){
	if(window.location.href.includes('#Sates'))
	{
		document.getElementById('Sates-tab').click();	
		// $('#Sates-tab')[0].click(); 
	}
	if(window.location.href.includes('#Governing'))
	{ 
		document.getElementById('Governing-tab').click();
	}
	if(window.location.href.includes('#Beneficiaries'))
	{
		document.getElementById('Beneficiaries-tab').click();	
	}

	if(window.location.href.includes('#Sectors'))
	{
		document.getElementById('Sectors-tab').click();
	}
	$('#roleEntity').multiselect({		
		texts    : {
			placeholder: 'Select Sector',
		},
	});
	$('#sdgselect').multiselect({		
		texts    : {
			placeholder: 'Select SDG',
		},
	});
	$('#Beneficiarysector').multiselect({		
		texts    : {
			placeholder: 'Select Sector',
		},
	});
});


//Sanjan Dev Start
jQuery(document).on('click','.updateState',function(){
	let st_id=jQuery(this).attr('data-id');
	$.ajax
	({
		type:'post',
		url:BASE_URL+'admin.php/master/get_master_state',
		data:{
		 'id':st_id
		},
		dataType:'json',
		success:function(response) 
		{	
			jQuery('#updateState_st_id').val(response[0].id);
			jQuery('#updateState_st_name').val(response[0].st_name);
			jQuery('#updateState_st_code').val(response[0].st_code);
		}
	});	 
 });
 jQuery(document).on('click','.updateDistrict',function(){
	 let dst_id=jQuery(this).attr('data-id');
	 $.ajax
	 ({
		 type:'post',
		 url:BASE_URL+'admin.php/master/get_master_district',
		 data:{
		  'id':dst_id
		 },
		 dataType:'json',
		 success:function(response) 
		 {	
			 var html ='<option value="">Select State</option>';
			 response.master_st.forEach(state => {
				 var selected=(state.st_code==response.master_dst[0].st_code)?'selected':'';
				 html+='<option value="'+state.st_code+'" '+selected+'>'+state.st_name+'</option>';
			 });
			 jQuery('#updateDistrict_st_code').html(html)
			 jQuery('#updateDistrict_dst_id').val(response.master_dst[0].id);
			 jQuery('#updateDistrict_dst_name').val(response.master_dst[0].dst_name);
			 jQuery('#updateDistrict_dst_code').val(response.master_dst[0].dst_code);
		 }
	 });
		 
 });
 jQuery(document).on('click','.updateGoverning',function(){
	let id=jQuery(this).attr('data-id');

	$.ajax
	({
		type:'post',
		url:BASE_URL+'admin.php/master/get_governing_act',
		data:{
			'id': id
		   },
		dataType:'json',
		success:function(response) 
		{	
			console.log(response.governing_act);
			 var html ='<option value="">Select Entity Name to list under</option>';
			 response.get_all_org_type.forEach(org_type => {
				var selected=(org_type.id==response.governing_act[0].entity_id)?'selected':'';
				html+='<option value="'+org_type.id+'" '+selected+'>'+org_type.org_type+'</option>';
			 });
			 jQuery('#entityidField').html(html);
			 
			 var html ='<option value="">Select State</option>';
			 response.master_state.forEach(state => {
				var selected=(state.id == response.governing_act[0].st_id)?'selected':'';		
				html+='<option value="'+state.id+'" '+selected+'>'+state.st_name+'</option>';
			 });

			 jQuery('#master_state_id').html(html);
			 jQuery('#governing_id_id').val(response.governing_act[0].id);
			 jQuery('#governing_act_id').val(response.governing_act[0].governing_act);
		}
	});	 
 });

 jQuery(document).on('click','.updateBeneficiary',function(){
	let b_id=jQuery(this).attr('data-id');
	$.ajax
	({
		type:'post',
		url:BASE_URL+'admin.php/master/edit_benificiary',
		data:{
		 'id':b_id
		},
		dataType:'json',
		success:function(response) 
		{
		      jQuery('#updateBenefi').html(response)
			  jQuery('#updateBeneficiary_sector').multiselect(); 
		}
	});	
});

jQuery(document).on('click','.updateSDG',function(){
	let sdg_id=jQuery(this).attr('data-id');
	console.log("sdg",sdg_id);
	$.ajax
	({
		type:'post',
		url:BASE_URL+'admin.php/master/edit_SDG',
		data:{
		 'id':sdg_id
		},
		dataType:'json',
		success:function(response) 
		{
		    jQuery('#updateSDGForm').html(response);
		}
	});
		
});

jQuery(document).on('click','.updateSector',function(){
	let sector_id=jQuery(this).attr('data-id');

	$.ajax
	({
		type:'post',
		url:BASE_URL+'admin.php/master/edit_SDG',
		data:{
		 'id':sector_id
		},
		dataType:'json',
		success:function(response) 
		{
			   
		   jQuery('#updatesdgselect').multiselect(); 
		}
	});
		
});




// krishna braiamaze developer start


jQuery(document).ready(function(){
	jQuery(".switchpopup").change(function(){
		if(jQuery(this).prop('checked')  == true) {
			jQuery(this).val(1);
		} else {
			jQuery(this).val(0);
		}
	});
});


jQuery(document).ready(function(){
	jQuery(".btn_delete").click(function(){
		let flag = confirm("Are you sure want to delete");
		if(flag == true){
			return true;
		}
		else{
			return false;
		}
	});

	jQuery(".switch_status_master_role").click(function(){
		let data_id=jQuery(this).attr('data-id');
		var csr_eligible = 0;
		if(jQuery(this).prop('checked')  == true) {
			csr_eligible = 1;
		} else {
			csr_eligible = 0;
		}
		$.ajax
		({
			type:'post',
			url:BASE_URL+'admin.php/master/switch_status_master_role',
			data:{
			 'id':data_id,
			 'csr_eligible':csr_eligible
			},
			dataType:'json',
			success:function(response) 
			{
				console.log(response);

			}
		});
	});
// Switch for sector fall
	jQuery(".switch_sector_fall").click(function(){
		let data_id=jQuery(this).attr('data-id');
		var status = 0;
		if(jQuery(this).prop('checked')  == true) {
			 status = 1;
		} else {
			status = 0;
		}
		$.ajax
		({
			type:'post',
			url:BASE_URL+'admin.php/master/switch_sector_fall_toggle',
			data:{
			 'id':data_id,
			 'status':status
			},
			dataType:'json',
			success:function(response) 
			{
				console.log(response);
			}
		});
	});
// Switch for sector fall



 });

jQuery(document).on('click','.EditSector',function(){
	let b_id=jQuery(this).attr('data-id');
	$.ajax
	({
		type:'post',
		url:BASE_URL+'admin.php/master/editSector',
		data:{
		 'id':b_id
		},
		dataType:'json',
		success:function(response) 
		{
		      jQuery('#updateSectorForm').html(response)
			  jQuery('#editSector_sector').multiselect(); 
		}
	});	
});

jQuery(document).on('change','#assign_srm', function() {
	var to = $(this).val();
	Swal.fire({
		title: "Are you sure?",
		text: "Are you sure that want to Assign!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes"
	  }).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				type: "POST",
				url: baseUrl+'/assign',
				data: {
						'to' : to,
						'key' :1,
						'meta' : meta,
				},
				success: function(msg) {
					Swal.fire({
						title: "Allocated!",
						text: "Account has been successfully allocated.",
						icon: "success"
					  }).then((result) => {
						loadRm(to);
					  });
				}
			});
		}
	  });

});
jQuery(document).on('change','#assign_rm', function() {
	var to = $(this).val();
	Swal.fire({
		title: "Are you sure?",
		text: "Are you sure that want to Assign!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes"
	  }).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				type: "POST",
				url: baseUrl+'/assign',
				data: {
						'to' : to,
						'key' :2,
						'meta' : meta,
				},
				success: function(msg) {
					Swal.fire({
						title: "Allocated!",
						text: "Account has been successfully allocated.",
						icon: "success"
					  });
				}
			});
		}
	});
	
});

function loadRm($id){
	if($id != ''){
		$.ajax({
			type: "POST",
			url: baseUrl+'/loadRm',
			data: {
					'key' : $id,
			},
			success: function(response) {
				$('#assign_rm').empty();
				$('#assign_rm').append('<option value="">Please Select RM</option>');
				$.each(response, function (key, val) {
					$('#assign_rm').append('<option '+((rmID == val.id)?"selected":"")+' value="'+val.id+'">'+val.first_name+'</option>');
				});
			}
		});
	}
}

//krishna developer End

//Sanjan Dev Start

//Sanjan Dev Start