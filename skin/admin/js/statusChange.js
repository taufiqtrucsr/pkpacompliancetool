function changeStatus(baseUrl,rId,index,productName)
{
	var status = ''; 
	var status = document.getElementById('status'+index).value;

	$.ajax({
			type:'POST',
			url: baseUrl+'admin.php/product_review/statusUpdate',
			data:'status='+status+'&id='+rId,
			success: function(data){
				if(data)
				{
					$(".statusMsg").html('<b style="color:#008000;">Status for product'+' '+productName+' '+' updated successfully</b>');
					document.getElementById("t1").refresh(); 
				}
				else
				{
					$(".statusMsg").html('<b style="color:#ff0000;">Status updating error for product '+' '+productName+' !</b>');
				}	
			}
		 });
}