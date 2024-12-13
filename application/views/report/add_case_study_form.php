<?php 
// $random_id=generateUniqueID(10,'Numeric');
$counter=isset($case_study_counter)?$case_study_counter:1;
?>
<?php if(isset($reportCaseStudyData) && count($reportCaseStudyData)>0){
$i=1;
foreach($reportCaseStudyData as $value){
	setlocale(LC_MONETARY, 'en_IN');
?>
<div class="case-study-label form-group">
	<p class="second-heading">CASE STUDY</p>
	<label class="control-label">TITLE OF THE CASE STUDY </label>
	<input type="text" class="form-control" value="<?php echo $value->case_study_title;?>" id="caseStudyTitle_<?php echo $i; ?>" name="caseStudyTitle[]">
</div><!-- case-study-label -->
<div class="upload-img form-group">	
	<div class="incp-sec" id="upload_img_caseStudy_img_<?php echo $i;?>">
		<span class="upload-file" style="<?php echo ($value->case_study_image != '')?'display:block':'display:none'?>">
			<?php
				$ext = pathinfo(REP_CASE_STUDY_PATH.$value->case_study_image, PATHINFO_EXTENSION);
				if($ext == 'pdf'){
					$imageSrc=SKIN_URL.'images/pdf-icon.png';
				}else{
					$imageSrc=REP_CASE_STUDY_URL.$value->case_study_image;
				}
			?>
			<img class="imageThumb" src="<?php echo $imageSrc;?>" width="100" height="100">
			<span class="file-name" id="org_cin_file_name"><?php echo $value->case_study_image?></span>					
			<span class="remove" onclick="removeReciept('reciept_<?php echo $i; ?>');">X</span>
		</span>
	</div>
	<div class="reciept-upload org-logo-upload" style="<?php echo ($value->case_study_image == '')?'display:block':'display:none'?>">
		<input type="file" class="" name="case_study_img[]" id="caseStudy_img_<?php echo $i; ?>" onchange="readRecieptURL(this);">
	</div>
</div>

<div class="add-descp-block form-group">
	<label class="control-label">WRITE CASE STUDY HERE </label>
	<textarea class="form-control write-case-textares" id="caseStudyDescription_<?php echo $i; ?>" name="caseStudyDescription[]" placeholder="Write case study here" maxlength="500" minlength="50"><?php echo $value->case_study;?></textarea>
</div><!-- add-descp-block -->

<input type="hidden" name="hiddenCaseStudy[]" id="hiddencasestudy_<?php echo $i; ?>" value="<?php echo $value->case_study_image;?>">
<input type="hidden" name="hiddenCaseStudyId[]" id="hiddencasestd_<?php echo $i; ?>" value="<?php echo $value->id;?>">


<?php $i++;} }else{?>
<div class="case-study-label form-group">
	<p class="second-heading">CASE STUDY</p>
	<label class="control-label">TITLE OF THE CASE STUDY </label>
	<input type="text" class="form-control" value="" id="caseStudyTitle_<?php echo $counter; ?>" name="caseStudyTitle[]">
</div><!-- case-study-label -->

<div class="upload-img form-group">	
	<div id="upload_img_caseStudy_img_<?php echo $counter;?>">
		
	</div>
	<div class="reciept-upload org-logo-upload">
		<input type="file" class="" name="case_study_img[]" id="caseStudy_img_<?php echo $counter; ?>" onchange="readRecieptURL(this);">
	</div>
</div>

<div class="add-descp-block form-group">
	<label class="control-label">WRITE CASE STUDY HERE </label>
	<textarea class="form-control write-case-textares" id="caseStudyDescription_<?php echo $counter; ?>" name="caseStudyDescription[]" placeholder="Write case study here" maxlength="500" minlength="50"></textarea>
</div><!-- add-descp-block -->

<?php } ?>