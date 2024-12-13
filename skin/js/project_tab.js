$(document).ready(function() {
	
	// $(".chk-box").change(function() {
		// if(this.checked) {
			// $(this).val(1);
		// }else{
			// $(this).val(0);
		// }
	// });
	
	/*if (window.File && window.FileList && window.FileReader) {
    $("#coverImage").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
		  //alert(f.name);
          $("<span class=\"pip\">" + "<img class=\"imageThumb\" src=\"" + e.target.result + "\" width=\"100\" hieght=\"100\" title=\"" + f.name + "\"/>" + "<br/><span class=\"remove\">Remove image</span>" + "</span>").insertAfter("#coverImage");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
			$("#coverImage").val('');
          });
          
         
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }*/
	
	$('#galleryImages').change(function() {
		console.log(1111111111);
	 	var project_id = $('#ngo_project_id').val();
        var files = $('#galleryImages')[0].files;
        var error = '';
        var form_data = new FormData();
        for (var count = 0; count < files.length; count++) {
            var name = files[count].name;
            var extension = name.split('.').pop().toLowerCase();
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                error += "Invalid file format please upload only images"
            } else {
                form_data.append("galleryImages[]", files[count]);
            }
        }
		
		form_data.append('ngo_project_id',project_id);


        if (error == '') {
            $.ajax({
                url: BASE_URL+"project/uploadTempGalleryImages", 
                method: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
					var spinner = $('#loader');
					$('#loader').show();
				},
				complete: function() {
					$('#loader').hide();
				},
                success: function(data) {
					$('#gallery_box').find('.default-image').remove();
                    if ($('#gallery_box').is(':empty')) {
						
                        $('#gallery_box').html(data);
                    } else {
						
                        $('#gallery_box').append(data);
                    }

                    $('#galleryImages').val('');
                }
            })
        } else {
            $.toast({
			heading: '',
			text: "Please select valid file type. The supported file types are .jpg , .png ",
			showHideTransition: 'slide',
			icon: 'error'
		  })
		   setTimeout(function() {}, 1000);
        }
    });
});


function addMilestone(flag="") {
	
	var total_milestone=$('#total_milestone').val();
	var new_total_milestone=$('#total_milestone').val();
	var total_budget_percent=$('#total_budget_percent').val();
	
	if(total_milestone=='')
	{
		new_total_milestone=1;
	}
	
	if(total_budget_percent=='')
	{
		$('#total_budget_percent').val(0);
	}
	
	$('#total_milestone').val(new_total_milestone);
	if(flag != ''){
	var new_budget_percent= 0;
	var i = 1;
	for(i;i<=new_total_milestone;i++){
		milestoneTitle = $("#milestoneTitle_"+i).val();
		milestoneBudget = $("#milestoneBudget_"+i).val();
		milestoneDateFrom = $("#milestoneDateFrom_"+i).val();
		milestoneDateTo_ = $("#milestoneDateTo_"+i).val();
		// alert(milestoneBudget);
		new_budget_percent += parseInt(milestoneBudget);
		// alert(new_budget_percent);
		
		if(milestoneTitle == '' || milestoneBudget == '' || milestoneDateFrom == '' || milestoneDateTo_ == ''){
		$.toast({
			heading: '',
			text: 'Milestone form cannot be blank',
			showHideTransition: 'slide',
			icon: 'error'
		  });	
			return false;	
		}
		
		$("#remove_"+i).show();
		
	}
	
	if(new_budget_percent >= 100){
		$.toast({
		heading: '',
		text: 'Budget percent can not be more than 100%',
		showHideTransition: 'slide',
		icon: 'error'
	  });	
		return false;	
	}
	
	new_total_milestone=parseInt(new_total_milestone) + parseInt(1);
	$('#total_milestone').val(new_total_milestone);
	}		
	$.ajax({
		type: 'POST',	
		url: BASE_URL+"project/addMilestone",
		data: {
			counter:new_total_milestone,
			project_id:$('#ngo_project_id').val()
		},
		success: function(data) {
			
			$('#payment-mile-block').append(data);
			
			
		}
	});

}

function removePaymentMilestone(elem,id) {
	
	$('#payment_mile_'+id).remove();
	var total_milestone=$('#total_milestone').val();
	var new_total_milestone=$('#total_milestone').val();
	if(total_milestone=='')
	{
		new_total_milestone=1;
	}else
	{
		new_total_milestone=parseInt(new_total_milestone) - parseInt(1);
	}
	$('#total_milestone').val(new_total_milestone);
	
}

function addFundRecievedEntry() {	
	
	var totalDonationAmt = $("#totalDonationAmt").val();
	var minDonationAmt = $("#minimumDonationAmt").val();
	
	var total_fund_recieved=$('#total_fund_recieved').val();
	var new_total_fund_recieved=$('#total_fund_recieved').val();
	if(total_fund_recieved=='')
	{
		new_total_fund_recieved=1;
	}
	$('#total_fund_recieved').val(new_total_fund_recieved);
	var totalFunds = 0;
	
	var i = 1;
	for(i;i<=new_total_fund_recieved;i++){
		foundedBy = $("#foundedBy_"+i).val();
		comitted = $("#comitted_"+i).val();
		recieved = $("#recieved_"+i).val();
		balance = $("#balance_"+i).val();
		reciept = $("#reciept_"+i).val();
		totalFunds += parseInt(recieved);
		
		if(foundedBy == '' || comitted == '' || recieved == '' || balance == '' ){
		$.toast({
			heading: '',
			text: 'Cannot be blank',
			showHideTransition: 'slide',
			icon: 'error'
		  });	
			return false;	
		}
		
		var time = parseInt($.trim(comitted.replace(/,/g, "")),10);
		Number.prototype.between = function(min,max){
			var num = parseInt(this,10);
			return num >= min && num <= max;
		}
		if(!(time).between(minDonationAmt,totalDonationAmt)){
			var msg = 'Comitted amount can not be greater than Total Project cost and not less than minumum donation amount.';
			$.toast({
				heading: '',
				text: msg,
				showHideTransition: 'slide',
				icon: 'error'
			  });
			return false; 
		}
		
		// if(comitted != '' && comitted.replace(/,/g, "") >= totalDonationAmt){
			// var msg = 'Comitted amount can not be greater than Total Project cost.';
			// $.toast({
				// heading: '',
				// text: msg,
				// showHideTransition: 'slide',
				// icon: 'error'
			  // });
			// return false; 
		// }
		
		// if(comitted != '' && comitted.replace(/,/g, "") < minDonationAmt){
			// var msg = 'Comitted amount can not be less than minumum donation amount.';
			// $.toast({
				// heading: '',
				// text: msg,
				// showHideTransition: 'slide',
				// icon: 'error'
			  // });
			// return false; 
		// }
		
		// if(reciept == ''){
			// return false;	
		// }
	}
	
	new_total_fund_recieved=parseInt(new_total_fund_recieved) + parseInt(1);
	$('#total_fund_recieved').val(new_total_fund_recieved);
	// $('#totalFunds_block').show();
	// $('#totalFunds').val(totalFunds);
			
	$.ajax({
		type: 'POST',	
		url: BASE_URL+"project/addFundRecievedEntry",
		data: {
			counter:new_total_fund_recieved,
			project_id:$('#ngo_project_id').val()
		},
		success: function(data) {
			
			$('#fund-mile-block').append(data);
			
			
		}
	});

}

function getBalanceAmt(counter='')
{
	var msg = '';
	
	if(counter != ''){
		var comitted = $("#comitted_"+counter).val();
		var recieved = $("#recieved_"+counter).val();
		if(comitted == ''){
			var msg = 'Comitted can not be blank.';
			$.toast({
				heading: '',
				text: msg,
				showHideTransition: 'slide',
				icon: 'error'
			  });
			 return false; 
		}
	
		if(recieved == ''){
			$("#recieved_"+counter).val('0');
			recieved = $("#recieved_"+counter).val();
			
			/*var msg = 'Recieved can not be blank.';
			$.toast({
				heading: '',
				text: msg,
				showHideTransition: 'slide',
				icon: 'error'
			  });
			  return false;*/ 
		}
		
		if(recieved == 0){
			$("#recieved_"+counter).val(recieved);
		}
		
		balanceAmt = parseInt(comitted.replace(/,/g, "")) - parseInt(recieved.replace(/,/g, ""));
		if(balanceAmt > 0){
			$("#balance_"+counter).val(balanceAmt);
			convertToINRFormat($("#balance_"+counter).val(),$("#balance_"+counter));	
		}else{
			$("#balance_"+counter).val(0);
		}
		
		var total_fund_recieved=$('#total_fund_recieved').val();
		
		var totalFunds = 0;
		var i = 1;
		for(i;i<=total_fund_recieved;i++){
			foundedBy = $("#foundedBy_"+i).val();
			comitted = $("#comitted_"+i).val();
			recieved = $("#recieved_"+i).val();
			balance = $("#balance_"+i).val();
			reciept = $("#reciept_"+i).val();
			hiddenReciept = $("#hiddenreciept_"+i).val();
			totalFunds += parseInt(recieved.replace(/,/g, ""));
		}
		
		$('#totalFunds_block').show();
		$('#totalFunds').val(totalFunds);
		convertToINRFormat($("#totalFunds").val(),$("#totalFunds"));
	}
}

function RemoveTempGalleryImage(thislement,id) {
	 var project_id = $('#ngo_project_id').val();
	if(id!='')
	{
		$.ajax({
			type: 'POST',	
			url: BASE_URL+"project/removeTempGalleryImage",
			data: {
				id : id,ngo_project_id:project_id
			},
			success: function(data) {
				if(data=='success')
				{
					$(thislement).parent().remove();
					$('#galleryImages').val('');
					if (!($('#gallery_box')).children().length) {
						$('#gallery_box').html('');
					}
				}
			}
		});
	}
}

function addGoalEntry() { 
  
  var total_goal_recieved=$('#total_goal_added').val();
  if(total_goal_recieved=='')
  {
    total_goal_recieved=1;
    $('#total_goal_added').val(total_goal_recieved);
  }
  
  var i = 1;
  for(i;i<=total_goal_recieved;i++){
    goalName = $("#goalName_"+i).val();
    goalDescription = $("#goalDescription_"+i).val();
    goalImg = $("#goal_"+i).val();
    
    if(goalName == '' || goalDescription == ''){
    $.toast({
      heading: '',
      text: 'Cannot be blank',
      showHideTransition: 'slide',
      icon: 'error'
      }); 
      return false; 
    }
  }
  
  new_total_goal_recieved=parseInt(total_goal_recieved) + parseInt(1);
  $('#total_goal_added').val(new_total_goal_recieved);
      
  $.ajax({
    type: 'POST', 
    url: BASE_URL+"project/addGoalEntry",
    data: {
      counter:new_total_goal_recieved,
      project_id:$('#ngo_project_id').val()
    },
    success: function(data) {
      $('#goal-add-block').append(data);
    }
  });

}