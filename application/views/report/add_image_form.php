<?php 
	$counter=isset($image_recieved_counter)?$image_recieved_counter:1;
?>
<?php if(isset($proReportImageData) && count($proReportImageData)>0){ 
$i=1;
foreach($proReportImageData as $value){?>
<div class="col-sm-2 image-s">
	<label class="control-label">IMAGE</label>
	<div class="<?php echo ($value->image_path != '')?'add-image':'';?>" id="upload_img_rep_img_<?php echo $i;?>">
		<?php
		$imageSrc = '';
		if($value->image_path != ''){
			$ext = pathinfo(REP_IMG_PATH.$value->image_path, PATHINFO_EXTENSION);
			if($ext == 'pdf'){
				$imageSrc=SKIN_URL.'images/pdf-icon.png';
			}else{
				$imageSrc=REP_IMG_URL.$value->image_path;
			}
		?>
		<img  class="imageThumb" src="<?php echo $imageSrc;?>" width="100" height="100">
		<span class="file-name" id="org_cin_file_name"><?php echo $value->image_path?></span>					
		<span class="remove-cross" onclick="removeReciept('rep_img_<?php echo $i; ?>');">X</span>
		<?php } ?>
	</div>
	<div class="reciept-upload" style="<?php echo ($imageSrc == '')?'display:block':'display:none'?>">
		<input type="file" class="" name="rep_img[]" id="rep_img_<?php echo $i; ?>" onchange="readRecieptURL(this);">
	</div>
	<input type="hidden" name="hiddenRepImage[]" id="hiddenGoalImage_rep_img_<?php echo $i; ?>" value="<?php echo ($value->image_path != '')?$value->image_path:'';?>">
	<input type="hidden" name="hiddenImageId[]" id="hiddenImageId_<?php echo $i; ?>" value="<?php echo ($value->id != '')?$value->id:'';?>">
</div>

<div class="col-sm-10 descp-s">
	<label class="control-label">DESCRIPTION <span>*</span></label>
	<textarea class="form-control" id="ImageDescription_<?php echo $i; ?>" name="ImageDescription[]" placeholder="Enter description for the image"><?php echo $value->image_description;?></textarea>
	<div id="goal-counter_<?php echo $i; ?>"></div>
	<input type="hidden" id="total_goal-counter" value="<?php echo count($proReportImageData); ?>">
</div>
	
<?php $i++;} }else{?>
<div class="col-sm-2 image-s">
	<label class="control-label">IMAGE <span>*</span></label>
	<div class="add-image">
		<div id="upload_img_rep_img_<?php echo $counter;?>"></div>
		<div class="reciept-upload">
			<input type="file" class="" name="rep_img[]" id="rep_img_<?php echo $counter; ?>" onchange="readRecieptURL(this);">
		</div>
	</div>
	<input type="hidden" name="hiddenRepImage[]" id="hiddenGoalImage_rep_img_<?php echo $counter; ?>" value="">
	<input type="hidden" name="hiddenImageId[]" id="hiddenImageId_<?php echo $counter; ?>" value="">
</div>
<div class="col-sm-10 descp-s">
	<label class="control-label">DESCRIPTION <span>*</span></label>
	<textarea class="form-control" id="ImageDescription_<?php echo $counter; ?>" name="ImageDescription[]" placeholder="Enter description for the image"></textarea>
	<div id="image-add-counter_<?php echo $counter; ?>" class="normal-font"></div>
	<input type="hidden" id="total_addImage-counter" value="<?php echo $counter; ?>">
</div>
<?php } ?>
