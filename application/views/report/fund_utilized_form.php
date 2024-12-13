<?php 
$counter=isset($fund_utilized_counter)?$fund_utilized_counter:1;
?>
<?php if(isset($proReportUtilizedData) && count($proReportUtilizedData)>0){
$i=1; //echo "if condition";
foreach($proReportUtilizedData as $value){
	// print_r($value);
	setlocale(LC_MONETARY, 'en_IN');
	$amount_spent = str_replace('INR ','',money_format('%i', $value->amount_spent));	
?>
<tr id="tr_<?php echo $i; ?>">
	<td class="grey-td">
		<span><?php echo $i; ?></span>
	</td>
	<td class="big-td">
		<input class="form-control" type="text" name="fund_description[]" id="fundDescription_<?php echo $i; ?>" value="<?php echo $value->utilize_description;?>" placeholder="We are aiming to make the villiage"> 
	</td>
	<td class="big-td">
		<div class="select-box">
			<select id="category_<?php echo $counter;?>" name="category[]" class="form-control">
			<?php  //echo "<pre>"; print_r($contributorsList); echo "</pre>";// if(isset($contributorsList) && count($contributorsList) > 0) {
				foreach($contributorsList as $contributorFund) { ?>
			<option value="<?php echo $contributorFund->id;?>"><?php echo $contributorFund->funded_by;?></option>
			<?php } //} ?>
			</select> 
		</div>
	</td>
	<td class="medium-td rupee-box">
		<input type="text" class="form-control amount-number validate-number" name="amount_spent[]" id="amountSpent_<?php echo $i; ?>" value="<?php echo $amount_spent;?>">
	</td>
	<td>
		<div class="incp-sec" id="upload_img_reciept_<?php echo $i;?>" >
			<span class="upload-file" style="<?php echo ($value->utilize_document != '')?'display:block':'display:none'?>">
				<?php
					$ext = pathinfo(FUND_UTILIZED_IMG_PATH.$value->utilize_document, PATHINFO_EXTENSION);
					if($ext == 'pdf'){
						$imageSrc=SKIN_URL.'images/pdf-icon.png';
					}else{
						$imageSrc=FUND_UTILIZED_IMG_URL.$value->utilize_document;
					}
				?>
				<img class="imageThumb" src="<?php echo $imageSrc;?>" width="100" height="100">
				<span class="file-name" id="org_cin_file_name"><?php echo $value->utilize_document?></span>					
				<span class="remove" onclick="removeReciept('reciept_<?php echo $i; ?>');">X</span>
			</span>
		</div>
		<div class="reciept-upload" style="<?php echo ($value->utilize_document == '')?'display:block':'display:none'?>">
			<input class="upload-receipt" type="file" name="reciept[]" id="reciept_<?php echo $i; ?>" onchange="readRecieptURL(this);">
		</div>	
	</td>
	<?php if($i > 1) { ?>
	<td>
		<span class="remove-link" onclick="removeLink('<?php echo $i; ?>');">Remove</span>
	</td>
	<?php } ?>
	
	<input type="hidden" name="hiddenReciept[]" id="hiddenreciept_<?php echo $i; ?>" value="<?php echo $value->utilize_document;?>">
	<input type="hidden" name="hiddenRecieptId[]" id="hiddenreciept_<?php echo $i; ?>" value="<?php echo $value->id;?>">
</tr>

<?php $i++;} }else{   //$contributorsList = $this->ReportModel->getContributorsOfProject($progress_details->project_id);
		?>
<tr id="tr_<?php echo $counter; ?>">
	<td class="grey-td">
		<span><?php echo $counter; // echo "hibvjsh sb s jwbd jgvwh h"; ?></span>
	</td>
	<td class="big-td">
		<input type="text" class="form-control" id="fundDescription_<?php echo $counter; ?>" name="fund_description[]" placeholder="We are aiming to make the villiage">
	</td>
	<td class="big-td">
		<div class="select-box">
			<select id="category_<?php echo $counter;?>" name="category[]" class="form-control">
			<?php //echo "<pre>"; print_r($contributorsList); echo "</pre>";// if(isset($contributorsList) && count($contributorsList) > 0) {
				foreach($contributorsList as $contributorfunding) { ?>
			<option value="<?php echo $contributorfunding->id;?>"><?php echo $contributorfunding->funded_by;?></option>
			<?php } // } ?>
			</select> 
		</div>
	</td>
	<td class="medium-td rupee-box">
		<input type="text" class="form-control amount-number validate-number" name="amount_spent[]" id="amountSpent_<?php echo $counter; ?>">
	</td>
	<td>
		<div class="incp-sec" id="upload_img_reciept_<?php echo $counter;?>"></div>
		<div class="reciept-upload" style="display:block">
			<input class="upload-receipt" type="file" name="reciept[]" id="reciept_<?php echo $counter; ?>" onchange="readRecieptURL(this);">
		</div>	
	</td>
	<?php if($counter > 1) { ?>
	<td>
		<span class="remove-link" onclick="removeLink('<?php echo $counter; ?>');">Remove</span>
	</td>
	<?php } ?>
</tr>

<?php } ?>
<script>
$(document).ready(function () {
 	$('.validate-char').on('keypress', function(key) {
        //alert(111111)
		if((key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45 && key.charCode != 32 && key.charCode != 0)) {
			return false;	
		}
	});
	
	$(".validate-number").keydown(function(event) {
		if (event.shiftKey == true) {
            event.preventDefault();
        }

        if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

        } else {
            event.preventDefault();
        }

        if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
            event.preventDefault();

    });
	
	$('input.amount-number').keyup(function(event) {
		// skip for arrow keys
  		if(event.which >= 37 && event.which <= 40) return;
	
  		// format number
  		convertToINRFormat($(this).val(),$(this));
	});
});	
</script>