$(document).ready(function(){
		   
				$('#proSector').multiselect({
						//search: true,
						//selectAll: true
						texts    : {
						placeholder: 'Select Sector/s',
						}
					});
	 
				$('#proBeneficiary').multiselect({
						//search: true,
						//selectAll: true
						texts    : {
						placeholder: 'Choose the beneficiarie/s',
						}
					});
				
				$('input.amount-number').keyup(function(event) {

				  // skip for arrow keys
				  if(event.which >= 37 && event.which <= 40) return;
				
				  // format number
				  convertToINRFormat($(this).val(),$(this));
				  // $(this).val(function(index, value) {
					// return value
					// .replace(/\D/g, "")
					// .replace(/(\d)(?=(\d\d)+\d$)/g, "$1,")
					// ;
				  // });
				});
	
	           $("#continueEditBtn").click(function(){
					if ($('input:checkbox').filter(':checked').length < 1){
						//alert("Check at least one Checkbox!");
						//$('.edit-request-err').css('display','block');
						$('#notification').css('display','block').delay(5000).fadeOut('slow');;
						return false;
					}
					else{
					
				   $("#editpro-step-1-btn").removeClass('btn-primary').addClass('btn-default');
                   $("#editpro-step-2-btn").removeClass('btn-default').addClass('btn-primary');
                   $("#editpro-step-1-btn").attr('disabled', 'disabled');
                   $("#editpro-step-2-btn").removeAttr('disabled');
				   //$("#editpro-step-2-btn").attr('href', '#editproject-step-2');
                   $("#editproject-step-1").css("display", "none");
                   $("#editproject-step-2").css("display", "block");
					}
                 });
				 
				 
				$("input[name='proType']").change(function() {
					if(this.checked) {
						var val = $(this).val();
						//alert(val)
						if( val == 1){
							$('#proTargetBlock').hide();
							$('#proScheduleBlock').show();
							// $('#proDateFrom').valid();
							// $('#proDateTo').valid();
						}
			
						if( val == 2 ){
							$('#proTargetBlock').show();
							$('#proScheduleBlock').hide();
							// $('#proTarget').valid();
							// $('#proTargetText').valid();
							// $('#proTargetFrequency').valid();
						}
					}
				});
			   
			   
                $('#checkbx_name').change(function(){
      	               $('#pname').toggle();
                });
				$('#checkbx_shortdes').change(function(){
      	               $('#pshortdescription').toggle();
                });
				$('#checkbx_des').change(function(){
      	               $('#pdescription').toggle();
                });
				$('#checkbx_pitype').change(function(){
      	               $('#ppick_type').toggle();
                });
				$('#checkbx_location').change(function(){
      	               $('#plocation').toggle();
					   $('#plocationdv').toggle();
                });
				$('#checkbx_secimpact').change(function(){
      	               $('#psector_impact').toggle();
                });
				$('#checkbx_beneficiary').change(function(){
      	               $('#pbeneficiary').toggle();
                });
				$('#checkbx_budget').change(function(){
      	               $('#pbudget').toggle();
                });
				$('#checkbx_donationamt').change(function(){
      	               $('#pdonationamt').toggle();
                });
				$('#checkbx_statement').change(function(){
      	               $('#pstatement').toggle();
                });
				$('#checkbx_projectgoal').change(function(){
      	               $('#pproject_goal').toggle();
                });
				$('#checkbx_sdgoal').change(function(){
      	               $('#psdg_goal').toggle();
                });
				
				
				$('#ms-list-1').click(function(){
		        $('#proSector').valid();
				});
	
				$('#ms-list-2').click(function(){
				$('#proBeneficiary').valid();
				});
				
				
			$("#peditrequest-form-1").validate({
				ignore: ':hidden',
				rules: {
				proName: {
					required: function() {
					return $('[name="checkbx_name"]:checked').val() == 1;
					},
					maxlength: 250
				 },
				proShortDescription: {
	                required: function() {
					return $('[name="checkbx_shortdes"]:checked').val() == 1;
					}, 
			        maxlength: 250
	            },
				proDescription: {
	                required: function() {
					return $('[name="checkbx_des"]:checked').val() == 1;
					}, 
			        //maxlength: 3000
			        wordCount: 500
	            },
				proType: {
					required: function() {
					return $('[name="checkbx_pitype"]:checked').val() == 1;
					},        
				},
				proDateFrom: {
					required: function() {
					return $('[name="proType"]:checked').val() == 1;
					},        
				},
				proDateTo: {
					required: function() {
					return $('[name="proType"]:checked').val() == 1;
					},        
				},
				proTarget: {
					required: function() {
					return $('[name="proType"]:checked').val() == 2; 
					},        
				},
				proTargetText: {
					required:  function() {
					return $('[name="proType"]:checked').val() == 2; 
					},        	      
				},
				proTargetFrequency: {
				required:  function() {
					return $('[name="proType"]:checked').val() == 2; 
					},        	      
				},
				proPincode: {
					required: function() {
					return $('[name="checkbx_location"]:checked').val() == 1;
					},        
				},
				proState: {
					required: function() {
					return $('[name="checkbx_location"]:checked').val() == 1;
					},        
				},
				proDistrict: {
					required: function() {
					return $('[name="checkbx_location"]:checked').val() == 1;
					},        
				},
				proCity: {
					required: function() {
					return $('[name="checkbx_location"]:checked').val() == 1;
					},        
				},
				"proSector[]": {
					required: function() {
					return $('[name="checkbx_secimpact"]:checked').val() == 1;
					},
					minlength: 1
				},
				proTotalCost: {
					required: function() {
					return $('[name="checkbx_budget"]:checked').val() == 1;
					}, 
					proTotalCost: '#proDonationAmt'			  
				},
				"proBeneficiary[]": {
					required: function() {
					return $('[name="checkbx_beneficiary"]:checked').val() == 1;
					},
					minlength: 1
				},
				proDonationAmt: {
					required: function() {
					return $('[name="checkbx_donationamt"]:checked').val() == 1;
					}, 
					proDonationAmt: '#proTotalCost'			  
				},
				prblmDescription: {
					required: function() {
					return $('[name="checkbx_statement"]:checked').val() == 1;
					},
					//maxlength: 100
					wordCount: 150
				},
				"goalName[]": {
					required: function() {
					return $('[name="checkbx_projectgoal"]:checked').val() == 1;
					},
					minlength: 1
				},
				"goalDescription[]": {
					required: function() {
					return $('[name="checkbx_projectgoal"]:checked').val() == 1;
					},
					minlength: 1
				},
				// "goal_img[]": {
					// required: function() {
					// return $('[name="checkbx_projectgoal"]:checked').val() == 1;
					// },
					// minlength: 1
				// },
				"SDGSType[]": {
					required: function() {
					return $('[name="checkbx_sdgoal"]:checked').val() == 1;
					},
					minlength: 1
				}
				}, 
            submitHandler: function(form) { 
		
			 var fd = new FormData($('#peditrequest-form-1')[0]);
             var project_id = $('#ngo_project_id').val();

             $.ajax({
                url: form.action,
                type: 'POST',
                method: form.method,
                dataType: 'json',
                contentType: false,
                processData: false,
                data:fd,       
                success: function(response) {
					console.log(response);
                    if(response.flag == 1){
                         console.log("dhshdh");
                       $.toast({
						heading: '',
						text: response.msg,
						showHideTransition: 'slide',
						icon: 'success'
						})
					setTimeout(function() {
					window.location.href =response.redirect;
					}); 			    

                    } else{
                         $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'error'
                        })
                        setTimeout(function() {                        
                        }, 1000);

                    }					
                }
            });

         }   

      });
			
    		    
 });	
 

$.validator.addMethod('proTotalCost', function(value, element, param) {
	value = value.replace(/\D/g, "");
			var hi = parseInt($(param).val().replace(/\D/g, ""));
			if (isNaN(hi))
			{
				return true;
			}
			else
			{
				return parseInt(value) > hi; 
			}
}, 'Total cost can not be lesser than or equal to donation amount'); 


$.validator.addMethod('proDonationAmt', function(value, element, param) {
	value = value.replace(/\D/g, "");
			var hi = parseInt($(param).val().replace(/\D/g, ""));
			if (isNaN(hi))
			{
			    return true;
			}
			else
			{
			    return parseInt(value) < hi;
			}
}, 'Min donation amount can not be greater than or equal to total cost');

$.validator.addMethod("wordCount", function(value, element, wordCount) {
    return value.split(' ').length <= wordCount;
}, 'Exceeded word count');

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