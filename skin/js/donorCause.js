$(document).ready(function () {
	
	// var pathname = window.location.pathname; // Returns path only (/path/example.html)
	// var url      = window.location.href;     // Returns full URL (https://example.com/path/example.html)
	// var origin   = window.location.origin;   // Returns base URL (https://example.com)
	
	// $('.project-details-tab-menu a[href^="#"]').on('click', function(event) {
 //        var target = $(this.getAttribute('href'));
 //        if( target.length ) {
 //            event.preventDefault();
 //            $('html, body').stop().animate({
 //                scrollTop: target.offset().top
 //            }, 1000);
 //        }
 //    });

	$('#searchSector').multiselect({		
		texts    : {
        placeholder: 'Select Sector',
    }
	});
	 
	$('#searchBeneficiary').multiselect({		
		texts    : {
        placeholder: 'Select beneficiary',
    }
	});
	
	$('#search_project_keyword').keypress(function(e){
		if(e.which == 13){//Enter key pressed
			SearchFilterProjectsList();
		}
	});
	
	$( "#donation_slider_range" ).slider({
      range: true,
      min: 0,
      max: 10000000,
      values: [ 0, 10000000 ],
      slide: function( event, ui ) {		  
		  
        $( "#donation_min_amount" ).val( ui.values[ 0 ] );
		convertToINRFormat($("#donation_min_amount").val(),$("#donation_min_amount"));
		$( "#donation_max_amount" ).val( ui.values[ 1 ] );
		convertToINRFormat($("#donation_max_amount").val(),$("#donation_max_amount"));
		
		SearchFilterProjectsList();
      }
	  
    });
	
	var min_donation = parseInt($("#donation_min_amount_hide").val());	
	var max_donation = parseInt($("#donation_max_amount_hide").val());	
	
	$( "#donation_slider_range" ).slider( "option", "min", min_donation );
	$( "#donation_slider_range" ).slider( "option", "max", max_donation );	
	$( "#donation_slider_range" ).slider( "values", 0, min_donation );
    $( "#donation_slider_range" ).slider( "values", 1, max_donation );	
		
	$( "#donation_min_amount" ).val( $( "#donation_slider_range" ).slider( "values", 0 ) );
	convertToINRFormat($("#donation_min_amount").val(),$("#donation_min_amount"));	
	$( "#donation_max_amount" ).val( $( "#donation_slider_range" ).slider( "values", 1 ) );
	convertToINRFormat($("#donation_max_amount").val(),$("#donation_max_amount"));
});

function SearchFilterProjectsList()
{
	var search = $.trim($('#search_project_keyword').val());
	
	var pt_project = '';
	var pt_program = '';
	var ft_onetime = '';
	var ft_instpay = '';
	var ft_milestone = '';
	
	var damt_1 = '';
	var damt_2 = '';
	var damt_3 = '';
	var damt_4 = '';
		
	if($('#pt_project').prop('checked')) {	
		pt_project = $('#pt_project').val();
	}	
	if($('#pt_program').prop('checked')) {	
		pt_program = $('#pt_program').val();
	}
	
	if($('#ft_onetime').prop('checked')) {	
		ft_onetime = $('#ft_onetime').val();
	}
	if($('#ft_instpay').prop('checked')) {	
		ft_instpay = $('#ft_instpay').val();
	}
	if($('#ft_milestone').prop('checked')) {	
		ft_milestone = $('#ft_milestone').val();
	}
	
	if($('#damt_1').prop('checked')) {	
		damt_1 = $('#damt_1').val();
	}
	if($('#damt_2').prop('checked')) {	
		damt_2 = $('#damt_2').val();
	}
	if($('#damt_3').prop('checked')) {	
		damt_3 = $('#damt_3').val();
	}
	if($('#damt_4').prop('checked')) {	
		damt_4 = $('#damt_4').val();
	}
	
	var search_by_loc = $.trim($('#search_by_loc').val());	
	
	var search_sector = $('#searchSector').val();
	var search_beneficiary = $('#searchBeneficiary').val();
	
	var donation_min_amount = $('#donation_min_amount').val();
	var donation_max_amount = $('#donation_max_amount').val();
		
	var flag = "search";
	
	$.ajax({
	type: "POST",
	dataType: "html",
	url: BASE_URL+"donor/ListProjects/",
	data: {search:search, pt_project:pt_project, pt_program:pt_program, ft_onetime:ft_onetime, ft_instpay:ft_instpay, ft_milestone:ft_milestone, damt_1:damt_1, damt_2:damt_2, damt_3:damt_3, damt_4:damt_4, search_by_loc:search_by_loc, search_sector:search_sector, search_beneficiary:search_beneficiary, donation_min_amount:donation_min_amount, donation_max_amount:donation_max_amount, flag:flag},
	
	success: function(response) {
			$("#main_projects_listing").html(response);
		}
	});
}

function loadmoreProjects()
{
	var search = $.trim($('#search_project_keyword').val());
	
	var pt_project = '';
	var pt_program = '';
	var ft_onetime = '';
	var ft_instpay = '';
	var ft_milestone = '';
	
	var damt_1 = '';
	var damt_2 = '';
	var damt_3 = '';
	var damt_4 = '';
		
	if($('#pt_project').prop('checked')) {	
		pt_project = $('#pt_project').val();
	}	
	if($('#pt_program').prop('checked')) {	
		pt_program = $('#pt_program').val();
	}
	
	if($('#ft_onetime').prop('checked')) {	
		ft_onetime = $('#ft_onetime').val();
	}
	if($('#ft_instpay').prop('checked')) {	
		ft_instpay = $('#ft_instpay').val();
	}
	if($('#ft_milestone').prop('checked')) {	
		ft_milestone = $('#ft_milestone').val();
	}
	
	if($('#damt_1').prop('checked')) {	
		damt_1 = $('#damt_1').val();
	}
	if($('#damt_2').prop('checked')) {	
		damt_2 = $('#damt_2').val();
	}
	if($('#damt_3').prop('checked')) {	
		damt_3 = $('#damt_3').val();
	}
	if($('#damt_4').prop('checked')) {	
		damt_4 = $('#damt_4').val();
	}
	
	var search_by_loc = $.trim($('#search_by_loc').val());	
	
	var search_sector = $('#searchSector').val();
	var search_beneficiary = $('#searchBeneficiary').val();
	
	var donation_min_amount = $('#donation_min_amount').val();
	var donation_max_amount = $('#donation_max_amount').val();
		
	var offset = $('.show_more_projects').attr('id');
	
	$('.show_more_projects').hide();
	
	$.ajax({
	type: "POST",
	dataType: "html",
	url: BASE_URL+"donor/SeeMoreProjects/",	
	data: {search:search, pt_project:pt_project, pt_program:pt_program, ft_onetime:ft_onetime, ft_instpay:ft_instpay, ft_milestone:ft_milestone, damt_1:damt_1, damt_2:damt_2, damt_3:damt_3, damt_4:damt_4, search_by_loc:search_by_loc, search_sector:search_sector, search_beneficiary:search_beneficiary, donation_min_amount:donation_min_amount, donation_max_amount:donation_max_amount, offset:offset},
	
	success: function(response) {
			$('.show_more_projects').remove();
			$("#main_projects_listing .project-cards").append(response);
		}
	});
}

function convertToINRFormat(value, inputField) {
  var number = Number(value.replace(/,/g, ""));
  // India uses thousands/lakh/crore separators
  $(inputField).val(number.toLocaleString('en-IN'));
}

function clearfilters(flag, field_id=false, field_val=false) {
	if(flag == 1) { // Clear Search
		$('#search_project_keyword').val('');
		SearchFilterProjectsList();
	}		
	else if(flag == 2) { // Clear all filters
		$("#pt_project"). prop("checked", false);
		$("#pt_program"). prop("checked", false);
		
		$("#ft_onetime"). prop("checked", false);
		$("#ft_instpay"). prop("checked", false);
		$("#ft_milestone"). prop("checked", false);
		
		$("#damt_1"). prop("checked", false);
		$("#damt_2"). prop("checked", false);
		$("#damt_3"). prop("checked", false);
		$("#damt_4"). prop("checked", false);
		
		$('#search_by_loc').val('');
		
		//var donation_min_amount_hide = $('#donation_min_amount_hide').val();
		//var donation_max_amount_hide = $('#donation_max_amount_hide').val();	

		var min_donation = parseInt($("#donation_min_amount_hide").val());	
		var max_donation = parseInt($("#donation_max_amount_hide").val());	
	
		$( "#donation_slider_range" ).slider( "option", "min", min_donation );
		$( "#donation_slider_range" ).slider( "option", "max", max_donation );	
		$( "#donation_slider_range" ).slider( "values", 0, min_donation );
		$( "#donation_slider_range" ).slider( "values", 1, max_donation );
	
	
		//$('#donation_min_amount').val(min_donation);
		//$('#donation_max_amount').val(max_donation);
		
		$( "#donation_min_amount" ).val( $( "#donation_slider_range" ).slider( "values", 0 ) );
		convertToINRFormat($("#donation_min_amount").val(),$("#donation_min_amount"));	
		$( "#donation_max_amount" ).val( $( "#donation_slider_range" ).slider( "values", 1 ) );
		convertToINRFormat($("#donation_max_amount").val(),$("#donation_max_amount"));

		$('option', $('#searchSector')).each(function(element) {
			$(this).removeAttr('selected').prop('selected', false);
		});
		$("#searchSector").multiselect('reload');
		
		$('option', $('#searchBeneficiary')).each(function(element) {
			$(this).removeAttr('selected').prop('selected', false);
		});
		$("#searchBeneficiary").multiselect('reload');  
		
		SearchFilterProjectsList();
	} else if(flag == 3) { // Clear individual filters
		if(field_id == 'pt_project') {
			$("#pt_project"). prop("checked", false);
		} else if(field_id == 'pt_program') {
			$("#pt_program"). prop("checked", false);
		} else if(field_id == 'ft_onetime') {
			$("#ft_onetime"). prop("checked", false);
		} else if(field_id == 'ft_instpay') {
			$("#ft_instpay"). prop("checked", false);
		} else if(field_id == 'ft_milestone') {
			$("#ft_milestone"). prop("checked", false);
		} else if(field_id == 'damt_1') {
			$("#damt_1"). prop("checked", false);
		} else if(field_id == 'damt_2') {
			$("#damt_2"). prop("checked", false);
		} else if(field_id == 'damt_3') {
			$("#damt_3"). prop("checked", false);
		} else if(field_id == 'damt_4') {
			$("#damt_4"). prop("checked", false);
		} else if(field_id == 'search_by_loc') {
			$('#search_by_loc').val('');
		} else if(field_id == 'donation_range') {
			var min_donation = parseInt($("#donation_min_amount_hide").val());	
			var max_donation = parseInt($("#donation_max_amount_hide").val());	
	
			$( "#donation_slider_range" ).slider( "option", "min", min_donation );
			$( "#donation_slider_range" ).slider( "option", "max", max_donation );	
			$( "#donation_slider_range" ).slider( "values", 0, min_donation );
			$( "#donation_slider_range" ).slider( "values", 1, max_donation );
		
			//var donation_min_amount_hide = $('#donation_min_amount_hide').val();
			//var donation_max_amount_hide = $('#donation_max_amount_hide').val();
			
			//$('#donation_min_amount').val(min_donation);
			//$('#donation_max_amount').val(max_donation);
			
			$( "#donation_min_amount" ).val( $( "#donation_slider_range" ).slider( "values", 0 ) );
			convertToINRFormat($("#donation_min_amount").val(),$("#donation_min_amount"));	
			$( "#donation_max_amount" ).val( $( "#donation_slider_range" ).slider( "values", 1 ) );
			convertToINRFormat($("#donation_max_amount").val(),$("#donation_max_amount"));
	
	
		} else if(field_id == 'search_sector') {
			var sector_option = $('#searchSector option[value="'+ field_val +'"]');
			sector_option.prop('selected', false);	
			$("#searchSector").multiselect('reload');			
		} else if(field_id == 'search_beneficiary') {
			var beneficiary_option = $('#searchBeneficiary option[value="'+ field_val +'"]');
			beneficiary_option.prop('selected', false);	
			$("#searchBeneficiary").multiselect('reload');
		}		
		SearchFilterProjectsList();
	} else { }
}

function filterSectorProjectsList()
{
	var projectId = $('#projectId').val();
	var proSector = $('#proSector').val();
	
	$.ajax({
	type: "POST",
	dataType: "html",
	url: BASE_URL+"donor/filterSectorProjectsList/",
	data: {projectId:projectId, proSector:proSector},
	
	success: function(response) {
			$("#sector_projects_listing").html(response);
		}
	});
}	

//Info popup - Display
function openInfoPopup() {
    $('#orgInfoPopup').modal();
}