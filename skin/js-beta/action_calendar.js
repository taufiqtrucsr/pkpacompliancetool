

jQuery(document).ready(function() { 
	$('[data-toggle="tooltip"]').tooltip();  
	
	/*----------------Allow only Numeric ---: Start--------------*/

    $(".membercount, .min_price, .max_price, .validate-number").keydown(function (event) {


            if (event.shiftKey == true) {
                event.preventDefault();
            }

            if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

            } else {
                event.preventDefault();
            }
            
            if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
                event.preventDefault();

        });
	/*----------------Allow only Numeric ---: End--------------*/
	
	
    $( ".datepicker").datepicker({ 
        dateFormat: 'yy-mm-dd',
		//startDate: new Date($('#min_date').val()),
		//endDate: new Date($('#max_date').val()),
        beforeShowDay: function(date){
         var d = date;
		 var month=date.getMonth();
		 var day=("0" + date.getDate()).slice(-2);
		  month=("0" + (month + 1)).slice(-2);
         var curr_date = day;
         var curr_month = month; //Months are zero based
         var curr_year = d.getFullYear();
         var formattedDate = curr_year + "-" + curr_month + "-" + curr_date;

         if ($.inArray(formattedDate, active_dates) != -1){
           return {
              classes: 'date-highlight'			 
           };
         }
		 
		   //$( ".datepicker" ).datepicker( "option", "minDate", new Date('<?php echo $min_date; ?>') );
		}
    }).on('changeDate', function(e){
		
		var date = new Date(e.date);
	
		if (date) {
			var month=date.getMonth();
			month=("0" + (month + 1)).slice(-2);
			var day=("0" + date.getDate()).slice(-2);
			var formattedDate = date.getFullYear() + "-" + 
								month + "-" + day;
			
		}
		$('#select_date').val(formattedDate);
		var current_tab=$('#current_tab').val();
		RefreshContent(current_tab);
	}); 
	
	$('.cancel').click(function(){
		$('#goal-detail-modal').modal('hide');
		//hideModalBody();
		
	});
	
	

		
		$('.update_goal_action_msg').editable({
           url: BASE_URL+'goal/update_goal_action_msg',
           type: 'textarea',
		   inputclass: 'action_textarea',
		   mode:'popup',
		   placement:'bottom',
		   placeholder:'What can you do on this day to move one step closer to your goal?',
           pk: 1,
		   validate: function(value) {
				if($.trim(value) == '') {
					return 'Please enter valid action message';
				}
			}
			
			
		});
		
		$('.update_goal_action_msg').on('save', function(e, params) {
				var current_page=$('#current_page').val();
				var goal_id=$('#current_goal_id').val();
				
				var current_tab=$('#current_tab').val();
				if(current_page=='action_calendar' && current_tab=='my_actions'){
					RefreshContent(current_tab);
				}else if(current_page=='action_calendar' && current_tab=='my_goals'){
					goaldetailpopup(goal_id);
				}else{
					RefreshGoal(goal_id,'');
				}
		});
			
		$('.update_goal_action_msg').on('shown', function(e, editable) {
			var current_value=$(this).html();
			
		   
			
			var str2 = "Schedule action for day";
			if(current_value.indexOf(str2) != -1){				
				editable.input.$input.attr("placeholder", "What can you do on this day to move one step closer to your goal?");
				editable.input.$input.val('');
			}
			else{
				
			}
		});
		
		
		$('#surprise-ok').click(function(){
			
			$('#surprise-popup').modal('hide');
			hideModalBody();
			
		});

		
		

	
	
	
});

function RefreshContent(value)
{
	var select_date=$('#select_date').val();
	$('#current_tab').val(value);
	
	if(value=='my_actions')
	{
		$('#cmyaction_link').addClass('active');
		$('#cmentoredgoal_link').removeClass('active');
		$('#cmygoal_link').removeClass('active');
	}
	else if(value=='my_goals')
	{
		$('#cmyaction_link').removeClass('active');
		$('#cmentoredgoal_link').removeClass('active');
		$('#cmygoal_link').addClass('active');
	}
	else if(value=='mentored_goals')
	{
		$('#cmyaction_link').removeClass('active');
		$('#cmygoal_link').removeClass('active');
		$('#cmentoredgoal_link').addClass('active');
	}
	
	$.ajax({
				type: "POST",
				datatype: "html",
				//async:false,
				url: BASE_URL+"goal/refreshactioncalendar/",
				beforeSend: function () { 
						var mini_loader='<div class="loader" id="actioncalendar_loader"></div>';
						$('#actions-calendar-right').html(mini_loader);
						$('.loader').show(); 
				},
				complete: function () { 
						$('#actioncalendar_loader').remove(); 
				},
				data: {date:select_date,type:value},
				success: function(result) {
					$('#actions-calendar-right').html(result);					
				}
		});
}

function goaldetailpopup(goal_id)
{
	var current_tab=$('#current_tab').val();
	var current_page=$('#current_page').val();
	var extra_param='';
	

	//$('#goal-detail').html('');	
	$.ajax({
				type: "POST",
				datatype: "html",
				
				url: BASE_URL+"goal/goaldetailpopup/",
				beforeSend: function () { 
						/*var mini_loader_gd='<div class="loader" id="goalz_'+goal_id+'"></div>';
						$(mini_loader_gd).insertBefore('#goalz_'+goal_id);
						$('#goalz_'+goal_id).show(); */
				},
				complete: function () { 
						//$('#goalz_'+goal_id).remove(); 
				},
				data: {goal_id:goal_id,current_tab:current_tab,current_page:current_page},
				success: function(result) {
					
					
					$('#goal-detail').html(result);	
					$('#goal-detail-modal').modal('show');	
							
					$(".ac-table").mCustomScrollbar({
						theme:"dark"
					});
					
					
					var current_tab=$('#current_tab').val();
					if(current_tab=='mentored_goals')
					{
						$('.edit-ac').hide();
						$('.delete-ac').hide();
						$('.reminder-ac').hide();
						//$('.progress-btn').hide();
						$(".update-row-column").addClass('avoid-clicks');	
						$(".action-table-mtg").addClass('avoid-clicks');	
						
						
					}
					
					var current_action_id=$('#current_action_id').val();
					
					if(current_action_id!='')
					{ 
						$("#goal-action-list").mCustomScrollbar("scrollTo", scrollToOffset("#action_msg_"+current_action_id));
					}
					
				}
		});
}



function ACfieldsaveToDatabase(element,db_column,id,element_type)
{
	//var goal_id=$('#current_goal_id').val();
	if(element_type=='input')
	{
		var current_value=element.value;
	}
	else{
		var current_value=element.innerHTML;
		
	}
	
	
$.ajax({
		type: "POST",
		dataType: "html",
		//async:false,
		url: BASE_URL+"goal/saveinlinefield/",
		beforeSend: function () { 
			var mini_loader='<div class="loader" id="ac_mini_loader_'+id+'"></div>';
		
			$(mini_loader).insertBefore('#tabel-checkbox'+id);
			$('#ac_mini_loader_'+id).show(); 
		},
		complete: function () { 
			
		},   
		data: { id: id, db_column:db_column,field_value:current_value},
		success: function(result) {
				var current_page=$('#current_page').val();
				var current_tab=$('#current_tab').val();
				if(current_page=='action_calendar' && current_tab=='my_actions'){
					RefreshContent(current_tab);
				}else if(current_page=='action_calendar' && current_tab=='my_goals'){
					goaldetailpopup(goal_id);
				}else{
					RefreshGoal(goal_id,'');
				}
			
		}
	});
	
	
	
}


function ACUpdateGoalAction(id,goal_id)
{
	var element=$('#tabel-checkbox'+id).prop('checked');
	
	var status='';
	if($('#tabel-checkbox' + id).is(":checked"))
		{
			status='1';
		}
		else{
			status='0';
		}
				
		$.ajax({
				type: "POST",
				dataType: "html",
				//async:false,
				beforeSend: function () { 
					var mini_loader='<div class="loader" id="ac_mini_loader_'+id+'"></div>';
					$(mini_loader).insertBefore('#tabel-checkbox'+id);
					$('#ac_mini_loader_'+id).show(); 
				},
				complete: function () { 
					
				},   
				
				url: BASE_URL+"goal/updategoalaction/",
				data: { id: id, goal_id:goal_id,status:status},
				success: function(result) {
					if(id!='')
					{
						$("#ac_mini_loader_"+id).remove(); 
					}
					
					var current_page=$('#current_page').val();
					var current_tab=$('#current_tab').val();
					if(current_page=='action_calendar' && current_tab=='my_actions'){
						RefreshContent(current_tab);
					}else if(current_page=='action_calendar' && current_tab=='my_goals'){
						goaldetailpopup(goal_id);
					}else{
						RefreshGoal(goal_id,'');
					}
		
				}
			});
		
	
			
}


$(window).on("load",function(){
	$(".ac-table").mCustomScrollbar({
		theme:"dark"
	});
});


$(window).load(function(){
	$(window).scroll(function(event) {
		
		// height of the document (total height)
		var d = $(document).height();
		
		// height of the window (visible page)
		var w = $(window).height();
		
		// scroll level
		var s = $(this).scrollTop();
		
		// bottom bound - or the width of your 'big footer'
		var bottomBound = 52;
		
		// are we beneath the bottom bound?
		if(d - (w + s) < bottomBound) {
			// if yes, start scrolling our own way, which is the
			// bottom bound minus where we are in the page
			$('.action-delete-footer').css({
				bottom: bottomBound - (d - (w + s))
			});
		} else {
			// if we're beneath the bottom bound, then anchor ourselves
			// to the bottom of the page in traditional footer style
			$('.action-delete-footer').css({
				bottom: 0
			});            
		}
	});
});//]]> 

function hideModalBody() {

  $(".modal-backdrop").remove();
  $('body').removeClass('modal-open');
  $('body').css('padding-right', '');
}


function ACRepeatAction(id,goal_id)
{

		
		
		if(goal_id)
		{
			
			$.ajax({
					type: "POST",
					datatype: "html",
					//async:false,
					beforeSend: function () { 
						var status_mini_loader='<div class="loader" id="mini_loader_'+id+'"></div>';
						$(status_mini_loader).insertBefore('#tabel-checkbox'+id);
						$('#mini_loader_'+id).show(); 
					},
					complete: function () { 
						//$('#mini_loader_'+id).remove(); 
					},   
					url: BASE_URL+"goal/openrepeataction/",
					data: {goal_id:goal_id,id:id},
					success: function(result) {
						$('#mini_loader_'+id).remove(); 
						$('#goal-repeat-action').html(result);	
						$('#GoalRepeatAction').modal('show');		
						
					}
			});
			
		
		}else{
			return false;
		}
}


function SurpriseProcessPopup()
{
	$('#surprise-popup').modal('show');	
}

function scrollToOffset(el){
	
    var offset=0;
    var elTop=$(el).offset().top-$("#goal-action-list .mCSB_container").offset().top;
    return elTop-offset;
}

