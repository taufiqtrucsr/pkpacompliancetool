<style>
div#uploadReportImage {
    width: 100% !important;
}
#uploadReportImage img.imageThumb {
    width: 100%;
    height: auto;
    padding: 0;
    border: none;
    border-radius: 0;
}
div#uploadReportImage .upload-file span.remove {
    position: absolute;
    top: 18px;
    right: 10px;
}
</style>
<div class="image-sec">
			<div id="add-image-div">	
			<?php
			if(isset($proReportImageData) && count($proReportImageData)>0){
				foreach($proReportImageData as $value){
					echo '<div class="col-sm-12 create-report-img-sec">';
						echo '<div class="col-sm-2 image-s">';
							echo '<label class="control-label">IMAGE</label>';
							echo '<div class="add-image">';
								echo '<img  class="imageThumb" src="'.REP_IMG_URL.$value->image_path.'" width="100" height="100">';
							echo '</div>';
						echo '</div>';
						echo '<div class="col-sm-10 descp-s">';
							echo '<label class="control-label">DESCRIPTION <span>*</span> <span class="remove-link" onclick="remove_image('.$value->id.')">Remove</span></label>';
							echo '<textarea class="form-control" disabled>'.$value->image_description.'</textarea>';
						echo '</div>';
					echo '</div>';
				}
			}
			?>
		    </div>
		    <div class="col-sm-12 create-report-img-sec" id="add-image-div">	
				<div class="col-sm-2 image-s">
					<label class="control-label">ACTIVITY IMAGE <span>*</span></label>
					<div class="add-image">
						<div class="incp-sec" id="uploadReportImage"></div>
						<div class="reciept-upload">
							<input type="file" name="image_path" id="image_path" onchange="readCoverImg(this);" required>
						</div>
					</div>
				</div>	
				<div class="col-sm-10 descp-s">
					<label class="control-label">ACTIVITY DESCRIPTION <span>*</span></label>
					<textarea class="form-control" id="image_description" name="image_description" placeholder="Enter description for the image"></textarea>
				</div>
				<p class="pad-5"></p>
			</div>
			
			<!-- code commented here for temporary purpose -->
				<div class="button-set add-another-img">
				<button class="add-entry-button" id="add_another_image" type="button" onclick="add_image()"> + Add another image</button>
			</div>
</div><!-- image-sec -->
<script>

function readCoverImg(input) {
	$(".reciept-upload").hide('');
	console.log(input);
	console.log(input.files);
  
    if (input.files && input.files[0]) {
		var file = input.files[0];
		var extension = file.name.split('.').pop().toLowerCase();
        
        console.log(file);
		console.log(extension);
		
        var reader = new FileReader();
		var pdfImage = BASE_URL+'skin/images/pdf-icon.png';
		
        reader.onload = function(e) {
			if(extension == 'pdf'){
				$("#uploadReportImage").html("<span class=\"upload-file\">" + "<img class=\"imageThumb\" src=\"" + pdfImage + "\" width=\"100\" height=\"100\" title=\"" + file.name + "\"/>" + "<br/><span class=\"file-name\">" + file.name + "</span><span class=\"remove cover\">X</span>" + "</span>");
			}else{
				$("#uploadReportImage").html("<span class=\"upload-file\">" + "<img class=\"imageThumb\" src=\"" + e.target.result + "\" width=\"100\" height=\"100\" title=\"" + file.name + "\"/>" + "<br/><span class=\"remove cover\">X</span>" + "</span>");
			}
          
			$(".remove.cover").click(function(){
				$(this).parent(".upload-file").remove();
				$("#coverImage").val('');
				$(".reciept-upload").show('');
			});
        }

        reader.readAsDataURL(input.files[0]);
    }
}
	function add_image(){
		console.log('add_image');
		var form_data = new FormData();                  
	    form_data.append('image_path', $('#image_path').prop('files')[0]);                  
	    form_data.append('image_description', $('#image_description').val());                  
	    form_data.append('project_report_id', $('#report_id').val());
		console.log(form_data);
	    $.ajax({
	        url: BASE_URL+"reports/add_image",
			type: 'ajax',
            method: "POST",
			dataType: 'json',
			data: form_data,
			processData: false,
            contentType: false,
			success: function(response) {
				console.log(response);
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
					$('#image_path').val('');
					$('#image_description').val('');
					$(".upload-file").remove();
					$(".reciept-upload").show('');
				    $('#add-image-div').html('');
                    $('#add-image-div').html(response.imageHtml);
					setTimeout(function() {
						location.reload();
				  	}, 10);
				}
			}
	    });
	}


	function remove_image(id){
		if (confirm('Are you sure that want to delete this Image?')){
			project_report_id=$('#report_id').val();
			$.ajax({
		        url: BASE_URL+"reports/remove_image",
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
					    $('#add-image-div').html('');
	                    $('#add-image-div').html(response.imageHtml);
						setTimeout(function() {
							location.reload();
						}, 10);
					}
				}
		    });
	    }
	}


	// code added here for save as draft  / Below code is added because after reload data gets disaapear

	$("#add_another_image").click(function(){
		var fd = new FormData($('#reportForm')[0]);
		fd.append('report_type','Draft');	
		$.ajax({
			url: BASE_URL+'reports/save_draft_report',
			type: 'POST',
			method: 'POST',
			dataType: 'json',
			contentType: false,
			processData: false,
			data:fd,
			beforeSend: function() {
				var spinner = $('#loader');
				$('#loader').show();
			},
			complete: function() {
				$('#loader').hide();
			},
			success: function(response) {
				console.log(response);
		  		if(response.flag == 1) {
		  			$.toast({
				        heading: '',
				        text: response.msg,
				        showHideTransition: 'slide',
				        icon: 'success'
				    })
					setTimeout(function() {
						window.location.href = response.redirect;
				  	}, 1000);
				}else{
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
	});

	// code ends here for save as draft 
</script>