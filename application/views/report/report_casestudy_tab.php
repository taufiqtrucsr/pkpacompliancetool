<?php 
//echo "<pre>";print_r($progress_details);echo "</pre>";
// echo "<pre>";print_r($reportCaseStudyData);echo "</pre>";
?>
<div class="form-group"> 
	<p class="second-heading">CASE STUDY</p>
	<!-- code commented from line 8 to 42 and it was already commented line 12,27 and 40  -->
	<div id="case-study-images-div">
		<?php
			// $caseStudyImageHtml="";
			// if(isset($reportCaseStudyData) && count($reportCaseStudyData)>0){
			//	// echo "<pre>";print_r($reportCaseStudyData);echo "</pre>";
			// 	foreach($reportCaseStudyData as $value){ 
			// $caseStudyImageHtml.= '<div class="case-study-add-block">';
			// 	$caseStudyImageHtml.= '<div class="case-study-label form-group">';
			// 		$caseStudyImageHtml.= '<p class="second-heading"><span class="remove-link" onclick="remove_casestudy_image('.$value->id.')">Remove</span></p>';
			// 		$caseStudyImageHtml.= '<label class="control-label">TITLE OF THE CASE STUDY </label>';
			// 		$caseStudyImageHtml.= '<input type="text" class="form-control" value="'.$value->case_study_title.'" readonly>';
			// 	$caseStudyImageHtml.= '</div><!-- case-study-label -->';
			// 	$caseStudyImageHtml.= '<div class="upload-img form-group">	';
			// 		$caseStudyImageHtml.= '<label class="control-label">IMAGES</label>';
			// 		$caseStudyImageHtml.= '<div class="upload-img-section">';
			// 			$caseStudyImageHtml.= '<div class="gallery_box">';
						
							// $caseStudyImageHtml.= '<div class="gallery-image">';
							// 	$caseStudyImageHtml.= '<img src="'.REP_CASE_STUDY_URL.$value->case_study_image.'" height="100" width="100" class="thumbnail" title="">';
							//	// $caseStudyImageHtml.= '<span onclick="remove_casestudy_image('.$value->id.')" class="remove-cross">X</span>';
		// 					$caseStudyImageHtml.= '</div>';
		// 				$caseStudyImageHtml.= '</div>';
		// 			$caseStudyImageHtml.= '</div><!-- upload-img-section-->';
		// 		$caseStudyImageHtml.= '</div><!-- upload-img -->';
		// 		$caseStudyImageHtml.= '<div class="add-descp-block form-group">';
		// 			$caseStudyImageHtml.= '<label class="control-label">WRITE CASE STUDY HERE <span class="normal-font">(50 characters min & 5000 characters max) *</span></label>';
		// 			$caseStudyImageHtml.= '<textarea class="form-control write-case-textares" placeholder="Write case study here" maxlength="5000" minlength="50" readonly>'.$value->case_study.'</textarea>';
		// 		$caseStudyImageHtml.= '</div><!-- add-descp-block -->';
		// 	$caseStudyImageHtml.= '</div>';
		// 	}
		// 	echo $caseStudyImageHtml;
		// }
	// // }
		?>
	</div>
	<div class="case-study-add-block" id="case-study-add-block">
		<div class="case-study-label form-group">
			<label class="control-label">TITLE OF THE CASE STUDY </label>
			<input type="text" class="form-control" id="case_study_title" name="case_study_title" value="<?php echo $progress_details->case_study_title?$progress_details->case_study_title:'';?>">
		</div><!-- case-study-label -->
		<div class="upload-img form-group">	
			<label class="control-label">IMAGES</label>
			<div class="upload-img-section">
				<div class="gallery_box">
					<?php
					// $caseStudyImageHtml="";
					// if(isset($reportCaseStudyData) && count($reportCaseStudyData)>0){
					// 	//echo "<pre>";print_r($reportCaseStudyData);echo "</pre>";
					//     foreach($reportCaseStudyData as $value){
					//         $caseStudyImageHtml.= '<div class="gallery-image">';
					// 	        $caseStudyImageHtml.= '<img src="'.REP_CASE_STUDY_URL.$value->case_study_image.'" height="100" width="100" class="thumbnail" title="">';
					// 	        $caseStudyImageHtml.= '<span onclick="remove_casestudy_image('.$value->id.')" class="remove-cross">X</span>';
					//         $caseStudyImageHtml.= '</div>';
					//     }
					//     echo $caseStudyImageHtml;
					// }
					?>
				</div>
			</div><!-- upload-img-section-->
			<div class="incp-sec" id="uploadCoverImage">
				<?php 
				if(isset($reportCaseStudyData) && count($reportCaseStudyData)>0){
					foreach($reportCaseStudyData as $value){?>
						<span class="upload-file" style="margin-bottom:10px;">
							<img class="imageThumb" src="<?php echo REP_CASE_STUDY_URL.$value->case_study_image;?>" name="case_study_image" width="100" hieght="100" title="<?php echo $value->case_study_image;?>">
							<br>
							<br>
							<span class="file-name"><?php $value->case_study_image;?></span>
							<span class="remove">X</span>
						</span>
					<?php }
				}
				?>
			</div>
			<div class="org-logo-upload">
				<input type="file" id="case_study_image" name="case_study_image" onchange="readCoverURL(this);">
			</div>
		</div><!-- upload-img -->
		<!-- <div class="add-descp-block form-group"> -->
			<!-- <label class="control-label">WRITE CASE STUDY HERE <span class="normal-font">(50 characters min & 5000 characters max) *</span></label> -->
			<!-- <textarea class="form-control write-case-textares" id="case_study" name="case_study" placeholder="Write case study here" maxlength="5000" minlength="50" onkeyup="myFunction()"></textarea> -->
			<!-- <textarea class="form-control write-case-textares" id="case_study" name="case_study" placeholder="Write case study here"  maxlength="5000" minlength="50" onkeyup="myFunction()"><?php echo $progress_details->case_study?$progress_details->case_study:'';?></textarea>
			<p style="text-align:right;"><b id="main_div_val" style="color:none;"><span id="current_val" >0</span>/5000</p></b>
			<p style="text-align:left;margin-top:-10px;display:none;" class="text-danger" id="warning_msg">You reach the maximum limit</p> -->
			
			
			<!-- code start here -->
			
			<!-- code ends here -->
		<!-- </div> -->
		<!-- add-descp-block -->
	</div>
	<div class="add-descp-block form-group col-sm-12">
		<!-- <label class="control-label">WRITE CASE STUDY HERE<span class="normal-font">(500 words max) *</span></label> -->
		<label class="control-label">WRITE CASE STUDY HERE<span class="normal-font">(5000 Character max) </span></label>
		<textarea class="form-control quilljs-textarea" id="case_study" name="case_study" onkeyup="myFunction()"  placeholder="<?php echo "Enter csae study description here"? "Enter case study description here ." : "Enter case study description here." ;?>" maxlength="10" minlength="50"><?php echo $progress_details->case_study?$progress_details->case_study:'';?></textarea>
		<br>
		<p style="text-align:left;margin-top:-10px;display:none;" class="text-danger" id="warning_msg">You reach the maximum limit</p>
		<div id="counter" class="normal-font"></div>
	</div>
</div>
<script type="text/javascript">
	// code start here
	function myFunction() {
	var x = $("#case_study").val();
	var count = x.length;
	if(count<4500){
		$("#warning_msg").css("display","none");
		$("#main_div_val").css("color", "#218838");
	}else if(count >4501 && count < 5000){
		$("#warning_msg").css("display","none");
		$("#main_div_val").css("color", "#ffc107");
	// }else if(count > 4999 && count <= 5000){
	}else if(count = 5000){
		$("#warning_msg").css("display","block");
		$("#main_div_val").css("color", "#c82333");
	}

	// if(count > 4999 && count<5000){
	// 	alert("neeraj");
	// 	$(".valid").addClass('error');
	// 	$("#warning_msg").css("display","block");
	// }
	// $("#current_val").val(count)
	$("#current_val").text(count);
	// document.getElementById("current_val").value = count;
	// window.document.getElementById("current_val").value = "neerajkumar";
	// alert(x.length);
	// x.value = x.value.toUpperCase();
	}
	// code ends here
	function add_casestudy(){
		var form_data = new FormData();                  
	    form_data.append('case_study_image', $('#case_study_image').prop('files')[0]);                   
	    form_data.append('case_study_title', $('#case_study_title').val());                 
	    form_data.append('case_study', $('#case_study').val());                  
	    form_data.append('project_report_id', $('#report_id').val()); 
	    $.ajax({
	        url: BASE_URL+"reports/add_casestudy",
			type: 'ajax',
            method: "POST",
			dataType: 'json',
			data: form_data,
			processData: false,
            contentType: false,
			success: function(response) {
				if(response.flag == 0){
				    $.toast({
				        heading: '',
				        text: response.msg,
				        showHideTransition: 'slide',
				        icon: 'error'
				    });
				    setTimeout(function() {}, 1000);
				}else if(response.flag == 1) {
					$.toast({
				        heading: '',
				        text: response.msg,
				        showHideTransition: 'slide',
				        icon: 'success'
				    });
				    $('#case-study-images-div').html('');
                    $('#case-study-images-div').html(response.caseStudyImageHtml);
					$('#case_study').val('');
					// $('#uploadCoverImage').val('');
					$('#case_study_image').val('');
					$('#case_study_title').val('');
                    // $('#case_study_title').val(response.case_study_title);
                    // $('#case_study').val(response.case_study);
					setTimeout(function() {
						location.reload();
					}, 10);
				}
			}
	    });
	}

	function remove_casestudy_image(id){
		if (confirm('Are you sure that want to delete this Case Study?')){
			var project_report_id=$('#report_id').val();
			$.ajax({
		        url: BASE_URL+"reports/remove_casestudy_image",
				type: 'ajax',
	            method: "POST",
				dataType: 'json',
				data: {id:id,project_report_id:project_report_id},
				success: function(response) {
					if(response.flag == 0){
					    $.toast({
					        heading: '',
					        text: response.msg,
					        showHideTransition: 'slide',
					        icon: 'error'
					    });
					    setTimeout(function() {}, 1000);
					}else if(response.flag == 1) {
						$.toast({
					        heading: '',
					        text: response.msg,
					        showHideTransition: 'slide',
					        icon: 'success'
					    });
					    $('#case-study-images-div').html('');
	                    $('#case-study-images-div').html(response.caseStudyImageHtml);
					}
				}
		    });
	    }
	}
</script>
