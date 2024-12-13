function dateValidate()
{	
		var valid = true;
		var error = '';
		var startdate = document.getElementById('startdate').value;
		var expiredate = document.getElementById('expiredate').value;

		
		var startdateArray		= startdate.split('-');
		var expiredateArray		= expiredate.split('-');
	
		var startdateYear		= startdateArray[2];
		var expiredateYear		= expiredateArray[2];

		var startdateMoth		= startdateArray[1];
		var expiredateMonth		= expiredateArray[1];

		var startdateDay		= startdateArray[0];
		var expiredateDay		= expiredateArray[0];
		
		var startdate	=	startdateMoth +"/"+ startdateDay +"/"+ startdateYear;
		var expiredate	=	expiredateMonth +"/"+ expiredateDay +"/"+ expiredateYear;

		var currentdate = new Date().getDate();
		var startdate	= new Date(startdate).getDate();
		var expiredate	= new Date(expiredate).getDate();
	
		if( startdate < currentdate || expiredate < currentdate ){
			error = 'Please enter valid date';
			valid = false;
		}else if(startdate > expiredate){
			valid = false;
			error = 'Start date should be less than expire date!';
		}

		if(!valid){
			alert(error);
		}
		return valid;
}