<?php
defined("BASEPATH") or exit("No direct script access allowed");
error_reporting(0);
?>
<?php $this->load->view("common/head_common"); ?>
<link rel="stylesheet" media="all" href="<?php echo SKIN_URL; ?>/css/implementor.css" />
<style>
  /* Sanjan CSS */
  .modal-backdrop.in {
    opacity: 0;
    position: unset;
  }
  .form-check-wrapper {
    display: flex;
    width: 100%;
  }
  .progress_bar{
    display:none;
  }
  .saveBtn {
    padding: 0 10px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .mb-7{
    margin-bottom: 7px;
  }
  .mt-40{
  margin-top: 40px;
}
.page{
    width: 100%;
    margin: 10px;
    box-shadow: 0px 0px 5px #000;
    animation: pageIn 1s ease;
    transition: all 1s ease, width 0.2s ease;
}
.preview-pdf{
  width:100px;
  height: 100px;
  overflow: hidden;
}
  .cross-icons-logo{
		position: absolute;
		color: white;
		background: #ff0000c2;
		border-radius: 3px;
		margin-left: 69px;
		margin-top: 5px;
		z-index:10;
    cursor: pointer;
	}
  #entityLogo-error{
    position: absolute;
    text-align: start;
    margin-top: 100px!important;
  }
  .cross-icons{
		position: absolute;
		color: white;
		background: #ff0000c2;
		border-radius: 3px;
		margin-left: 69px;
		margin-top: 5px;
		z-index:10;
    cursor: pointer;
	}
  /* taufiq */
  .col-lg-12 .form-group.col-sm-6:nth-child(odd){
    padding-right: 20px;
  }
  .select-box select, .registration-flow-setup .select-box select{
    background: #fff url(<?php echo SKIN_URL; ?>/images/Dropdown_black.png) no-repeat !important;
    background-position: right 3% center !important;
    margin-top: 0;
    background-size: 11px !important;
  }
  /* end taufiq */
</style>
<body class="full-page">
<form action="<?php echo base_url(); ?>Register/ngoEditFormStep2" enctype="multipart/form-data"
id="edit-ngo-form-2" method="POST">
  <?php
    $this->load->view('common/header');
  ?>
  <div class="container" style="padding:50px;">
    <?php
     if (isset($_SESSION["UserId"])) {
        $UserDetails = $this->UserModel->GetUserById($_SESSION["UserId"]);
        $select_entity_id = $UserDetails->entity_type;
        $query = $this->db->query("SELECT * FROM `state_master`");
        $state = $query->result_array();
        $sector_query = $this->db->query("SELECT * FROM `sector_master`");
        $sector = $sector_query->result_array();
        $sdgs_query = $this->db->query("SELECT * FROM `sdgs_master`");
        $sdgs = $sdgs_query->result_array();
    }
    ?>
    <div class="text-center">
      <P class="main_title">Complete Your Entity Profile</P>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="edit-ngo-page organisation-main-steps" id="entity-step-form">
          <div class="col-12">
            <div class="tab-content">
              <div id="ngo-register" class="tab-pane fade in active">
                <div class="stepwizard col-md-offset-3">
                  <div class="stepwizard-row setup-panel" style="justify-content: center !important; display: flex;">
                  <div class="stepwizard-step">
                  <a href="#ngo-step-1" id="ngo-step-1-btn" type="button" class="btn btn-primary btn-circle"><span
                  class="step-count"><img src="<?php echo SKIN_URL; ?>images/checkimp.svg"></span> KYC</a>
                  </div>
                  <div class="stepwizard-step">
                  <a href="#ngo-step-2" id="ngo-step-2-btn" type="button" class="btn btn-default btn-circle"
                  disabled="disabled"><span class="step-count" style="background: #36c;color:#fff!important">2</span> Profile Details</a>
                  </div>
                </div>
  <!-- USER PROFILE STEP 2 START -->
  <div id="ngo-step-2">
<form action="<?php echo base_url(); ?>Register/ngoEditFormStep1"
enctype="multipart/form-data" id="edit-ngo-form-1" method="POST"
novalidate="novalidate">
  <input type="hidden" name="usersprofileID"       id="usersprofile"            value="<?= $UserDetails->profile_id_display ?>">
  <input type="hidden" name="select_entity_id"     id="select_entity_id"        value="<?= $select_entity_id ?>">
  <input type="hidden" name="step_1_address_type"  id="step_1_address_type"    value="<?= $usersprofile->address_proof_type ?>">
  <input type="hidden" name="step_1_address_proof" id="step_1_address_proof"   value="<?= $usersprofile->address_proof ?>">
  <div class="container">
    <div class="row setup-content registration-flow-setup">
    <div class="row">
      <div class="col-lg-12">
        <!-- taufiq -->
        <div class="form-group col-sm-12" style="margin-bottom:50px">
        
          <h1 class="_heading">Enter Profile Details</h1>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group col-sm-12">
          <label class="form-label control-label" style="display:flex;align-items:center">Entity Logo *
            <a href="javascript:void(0)" class="info-tool-box"><img style="width:30px" src="<?php echo SKIN_URL; ?>images/file-edit-alert.png"><span>Please upload a 100x100 px image for best results</span></a>
          </label>
        </div>
        <div class="form-group col-sm-12" style="margin-bottom:20px">
          <div class="image_area custom_file_box">
              <svg class="cross-icons-logo"xmlns="http://www.w3.org/2000/svg" style="<?=(!$UserDetails->entity_logo)? 'display:none':''?>"  width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
              </svg>
              <input type="file" style="<?=($UserDetails->entity_logo)? 'display:none' : 'display:block'?>" name="entityLogo" <?=(!$UserDetails->entity_logo)? 'required':''?> id="entityLogo"
              accept="image/jpg, image/png" title="This Field Is Required.Accepts only .JPG, .PNG format"/>
              <input type="hidden" name="old_logo" value="<?php echo $UserDetails->entity_logo; ?>">
              <img src="<?=($UserDetails->entity_logo)? NGO_LOGO.''. $UserDetails->entity_logo : SKIN_URL.'images/uploadbtn.png'?>"  id="preview-box-target" height="90px" width="100px">
          </div>
        </div>
      <!-- end taufiq -->
        <div class="form-group col-sm-12 wrap_image">
          <!--<img id="uploaded_image_prev" width="100px" class="img-responsive img-circle" />-->
        </div>
        <input type="hidden" name="crop_step2_file" id="crop_step2_file">
      </div>
        <div class="col-md-4">
            <div class="modal fade" id="CropImage" tabindex="-1" role="dialog"
            aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg crop_logo_modal" role="document">
              <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Crop Image Before Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="img-container">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="result"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer wrap_flex_btn">
              <button type="button" id="crop" class="btn btn-primary">Crop</button>
              <button type="button" class="btn btn-secondary"
              data-dismiss="modal">Cancel</button>
              </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12" style="margin-bottom:10px">

        <div class="form-group col-sm-6" id="email_error_div">
          <label class="control-label" for="entityAltEmail">Entity Alternate Email (Optional)</label>
          <input type="text" placeholder="Entity email apart from MCA" class="form-control" id="entityAltEmail" name="entityAltEmail" value="<?= $usersprofile->alternate_email_id ?>" />
        </div>
        <div class="form-group col-sm-6" id="website_error_div">
          <label class="control-label" for="website">Website (Optional)</label>
          <input type="text" onChange="this.value=this.value.toLowerCase();" placeholder="http://www.abc.com/" class="form-control" id="website"
          name="website" value="<?= $usersprofile->website ?>" />
          <label id="websiteerror" class="error" for=""></label>
        </div>
       
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <label class="control-label" for="entityAbout">About Entity (Optional)</label>
            <textarea for="entityAbout" class="form-control" name="about_entity" placeholder="Tell us more about your organisation in minimum 150 characters."><?=$usersprofile->about_entity?></textarea>
          </div>
        </div>
        <div class="col-lg-12">
        <div class="form-group billing_address_flex">
        <h3>Billing Address</h3>
        <div class="addr">
        <input type="hidden" name="billingaddressCheck" id="billingaddressCheck" value="0">
        <input type="checkbox" id="billingaddresss"> <label>Same as registered address</label>
        </div>
        </div>
        </div>
        <div class="col-lg-12 billingAddress">
        <div class="form-group col-sm-6" style="margin-bottom:20px">
        <label class="control-label" for="address">Address</label>
        <input type="text" placeholder="Enter address here" class="form-control alpha_numeric_space" id="baddress"
        name="b_address" value="<?= $usersprofile->b_entity_address ?>">
        </div>
        <div class="form-group col-sm-6" style="margin-bottom:20px">
        <label class="control-label" for="pincode">Pincode</label>
        <input type="text" placeholder="Enter Pincode here" class="form-control validate-number" minlength="6" maxlength="6" id="bpincode"
        name="b_pincode" value="<?=$usersprofile->b_pincode ?>">
        </div>
        <div class="form-group col-sm-6" style="margin-bottom:20px">
        <label class="control-label" for="bstate">State</label>
        <div class="select-box" style="margin-bottom:0px;">
        <select id="bstate" name="b_state" class="form-control b_state_step2 mb-7">
        <option value="">Select State</option>
        <?php foreach ($state as $key => $value) {
          if($value['id'] == 38 || $value['id'] == 37){
            continue;
        }
          echo '<option value="' .
            $value["id"] .
            '"> ' .
            $value["st_name"] .
            "</option>";
        } ?>
        </select>
        </div>
        </div>
        <div class="form-group col-sm-6" style="margin-bottom:20px">
        <label class="control-label" for="district">District</label>
        <div class="select-box">
        <select id="bcityOrDistrict" name="b_cityOrDistrict"
        class="form-control b_cityOrDistrict_step2 mb-7">
        </select>
        </div>
        </div>
        <div class="form-group col-sm-6" style="margin-bottom:20px">
        <label class="control-label" for="city">City</label>
        <div class="select-box">
          <input placeholder="Enter City here" type="text" class="form-control validate-char" id="city" name="b_city" required="">
        </div>
        </div>
        <div class="form-group col-sm-6 step-2-address">
          <label class="control-label">Upload Address Proof *</label>
          <div class="select-box">
          <input type="hidden" name="b_address_proof_existed" id="address_proof_name"
          class="form-control" value="<?= $usersprofile->b_address_proof ?>">
          <select id="b_addressProof_type" name="b_addressProof_type"
          class="form-control add_proof mb-7">
          <option value="">Select Address Proof Doc and Upload</option>
          <option value="1">Rent Agreement</option>
          <option value="2">Electricity Bill</option>
          <option value="3">Phone Bill</option>
          </select>
          </div>
          <label class="error" id="b_addressProof_type-error"></label>
          <div class="progress_bar custom_file_box">
          <svg class="cross-icons"xmlns="http://www.w3.org/2000/svg" style="<?=(empty($usersprofile->b_address_proof))? 'display:none':''?>;margin-left: 99px;"  width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
          </svg>
          <input type="file" id="file-uploader"class="file-upload-preview-img file_upload_common" name="b_uploadedAddressProof"
          style="display:none;" accept="image/jpg, image/png,application/pdf">
            <?php if(!empty($usersprofile->b_address_proof)){ ?>
                <embed src="<?php  echo NGO_CIN_URL.''.$usersprofile->b_address_proof; ?>"></embed>
            <?php }?>
            <div class="preview-pdf"></div>
            <img class="preview-img" src="" style="width:100px;height:100px;"/>
          </div>
        </div>
        </div>
        <div class="sameasregisteredAddress">
        </div>
        <div class="col-lg-12" >
        
        <div class="col-lg-12 a_of_b_o defaultsc" style="padding-left: 5px;">
          <label class="control-label"> Area of Business Operations (State/UT,District) *</label>
          <input type="hidden" id="area_of_business_op" value="1">
          <div class="form-check-wrapper" style="margin-bottom:15px">
          <div class="form-check">
          <input class="form-check-input" type="radio" name="panIndia" id="flexRadioDefault1" value="1" checked>
          <label class="form-check-label" for="flexRadioDefault1"> Select State/UT & District </label>
          </div>
          <div class="form-check">
          <input class="form-check-input" type="radio" name="panIndia" id="flexRadioDefault2" value="0"> 
          <label class="form-check-label" for="flexRadioDefault1">Pan India</label>
          </div>
          </div>
        </div>  
        <div id="addmore-state" class="_addmore-state">
          <div class="row _areaofsB area_of_buisness_state">
            <div class="form-group col-sm-6 wrap_distCity">
              <select name="areaofbuisness[0][state]" class="form-control area_of_service_state" required>
                <option value="">Select State</option>
                <?php foreach ($state as $key => $value) {
                  if($value["st_code"] != 'OGL'){
                        echo '<option value="'.$value["st_code"].'">'.$value["st_name"]."</option>";
                }
                } ?>  
              </select>
            </div>
            <div class="form-group col-sm-6 col-sm-select">
              <select class="form-control" name="abcity[]" required>
                <option  value="">Select District</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group" style="position: relative;left: -15px; margin-bottom:40px">
            <a href="javascript:void(0)" class="btn add-more-state-btn" onclick="addMoreState()"><span>+</span> Add State/UT</a>
        </div>
          <!-- SECTOR AND SDG ASSOCIATD -->
        <div class="form-group col-lg-12"  style="">
              <h1 class="_heading">Select sectors preference (Optional)</h1>
          </div>
          <div class="form-group col-lg-12" style="">
            <?php 
            foreach ($sector as $key => $value) 
            {
              echo '<div class="sector-img-sec gallery"> <input type="checkbox" data-id="' .
              $value["id"] .
              '" sdg-id="' .
              $value["sector_image"] .
              '" name="sector_pref[' .
              $value["id"] .
              ']"  ';
              if (in_array($value["id"], $sector_prefences)) {
                echo "checked";
              }
              echo "/>";
              echo '<img src="' .
              base_url() .
              "/public/uploads/project/sector_image/" .
              $value["sector_image"] .
              '" alt="sector-img" class="';
              if (in_array($value["id"], $sector_prefences)) 
              {
                echo "active";
              }
                echo '"></div>';
            }
            ?> 
          </div> 
          <div class="form-group col-lg-12 mt-40">
            <p class="sdgs-heading">Sustainable Development Goals (SDGs)</p><br>
            <p class="sdgs-label">Choose the SDGs that your project addresses</p>
          </div>
          <div class="form=group col-lg-12">
            <?php 
            foreach ($sdgs as $key => $value) 
            {
              echo '<div class="sector-img-sec-sdgs gallery">
              <input type="checkbox" data-id="' .
              $value["id"] .
              '" value="' .
              $value["id"] .
              '" sdg-id="' .
              $value["image"] .
              '" name="sdgs_pref[' .
              $value["id"] .
              ']" 
              ';
              if (in_array($value["id"], $sdgs_prefences)) {
                echo "checked";
              }
              echo '>
              <img src="' .
              base_url() .
              "/public/uploads/project/sdg_image/" .
              $value["image"] .
              '" alt="img">
              </div>';
            } 
            ?> 
          </div>
        </div>
        <!-- SECTOR AND SDG ASSOCIATD -->
    </div>


  <div class="full-width">
    <div class="col-sm-12">
        <div class="wrap_flex_btn">
          <div class="form-group">
            <a href="<?php echo base_url(); ?>register/entity_type#ngo-step-1"
            class="cancelBtn">
            Back</a>
          </div>
          <div class="form-group">
            <button class="btn btn-primary saveBtn" type="submit" style="margin-left: 15px;">Save &
            Continue</button>
          </div>
      </div>
</div>


</div>
</div>
</div>
</div>
</div>





<!-- FORM SUBMIT  -->
<!-- <div class="full-width-footer">

</div> -->




</div>
</div>
</div>
<!-- Terms and condition modal -->
<?php
   $this->load->view('term/contributor');
?>
</form>
</div>
<!-- USER PROFILE STEP 2 END -->
</div>
</div>
</div>
<!-- STEP FORM END -->
</div>
</div>
</div>
</div>
</div>





</form>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js"></script>
<!--
<link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
<script src="https://unpkg.com/dropzone"></script>
<script src="https://unpkg.com/cropperjs"></script>-->
<!-- jQuery library -->
<!-- JS & CSS library of MultiSelect plugin -->
<link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/jquery.multiselect.css">
<script src="<?php echo SKIN_URL; ?>js/jquery.multiselect.js"></script>
<script src="<?php echo SKIN_URL; ?>js/jquery.contributorcsr.js"></script>
<?php $this->load->view("common/footer_js"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.2/pdf.js"></script>
<script>
  let SKIN_URL = '<?php echo SKIN_URL; ?>';
          function validateFile(fn){
            var validExtensions = ['pdf']; 
              var fileNameExt = fn.substr(fn.lastIndexOf('.') + 1);
              if ($.inArray(fileNameExt, validExtensions) == -1)
                  return false;
              else
                  return true;
          }
          $(document).on('click','.cross-icons',function(){
            $('[name="b_addressProof_type"]').val('');
            $(this).hide();
            $(this).parent().find('embed').remove();
            $(this).parent().find('.preview-pdf').empty();
            $(this).parent().find('.preview-img').hide();
            $(this).parent().find('.file_upload_common').val('');
            $(this).parent().find('.file_upload_common').attr('required',true);
          });
          $(document).on('change', '.file_upload_common', function (e) {
            $(this).parent().find('.cross-icons').show();
            if(this.files.length>0){
            if(validateFile(this.files[0].name)){
                  $(this).parent().find('.preview-img').hide();
                  $(this).parent().find('.preview-pdf').show();
                  var $this = $(this);
                  $this.parent().find('.preview-pdf').empty();
                  var file = e.target.files[0];
                  var fileReader = new FileReader();  

                  fileReader.onload = function() {
                    var typedarray = new Uint8Array(this.result);

                    pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
                            for (var i = 0; i < pdf.numPages; i++) {
                                (function(pageNum){
                                pdf.getPage(i+1).then(function(page) {
                                // you can now use *page* here
                                var viewport = page.getViewport(2.0);
                                var pageNumDiv = document.createElement("div");
                                pageNumDiv.className = "pageNumber";
                                //pageNumDiv.innerHTML = "Page " + pageNum;
                                var canvas = document.createElement("canvas");
                                canvas.className = "page";
                                canvas.title = "Page " + pageNum;
                                $this.parent().find('.preview-pdf').append(pageNumDiv);
                                $this.parent().find('.preview-pdf').append(canvas);
                                canvas.height = viewport.height;
                                canvas.width = viewport.width;


                                page.render({
                                    canvasContext: canvas.getContext('2d'),
                                    viewport: viewport
                                }).promise.then(function(){
                                    console.log('Page rendered');
                                });
                                page.getTextContent().then(function(text){
                                    console.log(text);
                                });
                                });
                                })(i+1);
                                break;
                            }
                    });
                  };
                  fileReader.readAsArrayBuffer(file);

            }else{
              $(this).parent().find('.preview-img').show();
              $(this).parent().find('.preview-pdf').hide();
            }
          }else{
            $('#b_addressProof_type').val('');
          }
          });
	jQuery.validator.addMethod("emailOptionalFormat", function(value, element) {
		if(value == '') return true;
		var regex =  /^([a-zA-Z])+([a-zA-Z|0-9])+\@(([a-zA-Z-])+\.)+([a-zA-Z]{2,4})+$/;
		return regex.test(value);
	}, "Please Enter A Valid Email Address.");
	jQuery.validator.addMethod("urlFormat", function(value, element) {
		if(value == '') return true;
		var regex =  /^((http|https):\/\/)?(www\.)?([a-zA-Z]{1,})+([a-zA-Z]{1,})+(.(com|in))$/;
		return regex.test(value);
	}, "Please Enter A Valid Url. Only .com |.in top-level domain supported.");
	
  $("#edit-ngo-form-2").validate({
    ignore: ':hidden',
    rules: {
        image: {
            required : true // Sanjay oraon 26/06/2023 Email Validation Function
        },
        b_address: {
            required : true // Sanjay oraon 26/09/2023 
        },
        b_cityOrDistrict: {
            required : true // Sanjay oraon 26/09/2023 
        },
        b_state: {
            required : true // Sanjay oraon 26/09/2023 
        },
        b_addressProof_type: {
            required : true // Sanjay oraon 26/09/2023 
        },
        entityAltEmail: {
            emailOptionalFormat : true // Sanjay oraon 26/06/2023 Email Validation Function
        },
        about_entity:{
          minlength: 150,
        },
        website: {
            urlFormat: true // Sanjay oraon 26/06/2023 Url Validation Function
        },
        b_pincode: {
            required:true,
            maxlength:6,
            digits: true,
        }
    },
    messages: {
      image: {
                "required": "Entity Logo Is Required."
            },
    },
    submitHandler: function (form) {
        jQuery("#TermsConditionKYC").modal('show');
        jQuery('#acceptbutton').click(function(){
            if (jQuery("#CheckTerms").is(":checked")) {
                form.submit();
            }else{
				$("#checkbox_error").show();
			}
        });
    }
}); 
jQuery("#CheckTerms").click(function(){
		if($("#CheckTerms").prop("checked") == true)
			$("#checkbox_error").hide();
		else
			$("#checkbox_error").show();
});
</script>
<!-- SECTOR AND SDG ASSOCIATED -->
  <script>
         jQuery(".sector-img-sec.gallery").click(function () {
            if ($(this).find('input').prop('checked') == true) {
                $(this).find('input').attr('checked', false); // Checks it
                jQuery(this).find('img').removeClass("active");
                let sectorID = jQuery(this).find('input').attr('data-id');
                $.ajax({
                  type: "POST",
                  dataType: "json",
                  url: BASE_URL + "register/getassociatedsdg/",
                  data: { sectorID: sectorID },
                  success: function (response) {
                    var temp = new Array();
                    temp = response.split(',');
                    for (a in temp ) {
                    
                   jQuery(".sector-img-sec-sdgs input[value='" + parseInt(temp[a], 10) + "']").attr('checked', false);
                   jQuery(".sector-img-sec-sdgs input[value='" + parseInt(temp[a], 10) + "']").next('img').removeClass('active');

                    }
                  }
                }); 
            } 
            else 
            {
             let sectorID = jQuery(this).find('input').attr('data-id');
              $.ajax({
              type: "POST",
              dataType: "json",
              url: BASE_URL + "register/getassociatedsdg/",
              data: { sectorID: sectorID },
              success: function (response) {
              var temp = new Array();
              temp = response.split(',');
              for (a in temp ) {
                jQuery(".sector-img-sec-sdgs input[value='" + parseInt(temp[a], 10) + "']").attr('checked', true);
                jQuery(".sector-img-sec-sdgs input[value='" + parseInt(temp[a], 10) + "']").next('img').addClass('active');
               }
              }
              });
              $(this).find('input').attr('checked', true); 
              jQuery(this).find('img').addClass("active");
             }
        });

        jQuery(".sector-img-sec-sdgs.gallery").click(function () {
          if ($(this).find('input').prop('checked') == true) {
              jQuery(this).find('input').prop('checked', false); // Checks it
              jQuery(this).find('img').removeClass("active");
          } else {
             jQuery(this).find('input').attr('checked', true); // Checks it
             jQuery(this).find('img').addClass("active");
          }
        });
  </script>
  <!-- SECTOR AND SDG ASSOCIATED -->
<!-- Terms and conditions -->
  <script>
    const terms = document.querySelector(".terms-and-conditions");
    const termsLastElement = terms.lastElementChild;
    const scrollToBottom = document.querySelector(".scroll-to-bottom");
    const acceptButton = document.querySelector(".accept-button");

    scrollToBottom.addEventListener("click", function (e) {
      termsLastElement.scrollIntoView({
        block: "start",
        behavior: "smooth",
        inline: "nearest"
      });
    });

    function obCallback(payload) {
      if (payload[0].isIntersecting) {
        scrollToBottom.setAttribute("aria-hidden", true);
        acceptButton.setAttribute("aria-hidden", false);
        observer.unobserve(termsLastElement);
      }
    }
    const observer = new IntersectionObserver(obCallback, { root: terms, threshold: 0.1 });
    observer.observe(termsLastElement);
  </script>
<!-- Terms and conditions -->
  <script>
    // Add the following code if you want the name of the file appear on select
   /* $('.custom_file_box').click(function () {
      $("#entityLogo").trigger('click');
    })
    $("#entityLogo").on("change", function () {
      var fileName = $(this).val().split("\\").pop();
      $(".custom-file-label").text(fileName);
    });*/
  function deleteSector(sec) {
    console.log(sec);
    sec.parentElement.remove();
  }
  
  $(document).ready(function() {
        $("input[type='file']").change(function() {
          $('#upload_image-error').hide();
        });
  });
  </script>


</body>

</html>