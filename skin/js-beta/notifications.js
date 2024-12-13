$(document).ready(function(){
	//alert("mno");
$('#dropdownMenuButton').click(function(){
	 $.ajax({
        type:"POST",
        url: BASE_URL+"homepage/countUpdate",
        success:function(resopnse){
			$('.notification-counter').css('display','none');
			//console.log("abc");
			//location.reload();
        } 
    });
});

});

function notificationUpdateD(id){
	//alert("ddeg");
	//alert(id);

	 $.ajax({
        type:"POST",
        url: BASE_URL+"homepage/notificationUpdate",
        data:'id='+id,
        success:function(data){
			console.log(id);
            location.reload();
        } 
    });
	
}