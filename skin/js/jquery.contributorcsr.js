
var $modal = $('#CropImage');
let result = document.querySelector('.result'),
cropper = '';

// on change show image with crop options
$(document).on('change','#entityLogo',function(e){
  if (e.target.files.length) {
		// start file reader
    const reader = new FileReader();
    reader.onload = (e)=> {
      if(e.target.result){
				// create new image
				let img = document.createElement('img');
				img.id = 'image';
				img.src = e.target.result
				// clean result before
				result.innerHTML = '';
				// append new image
                result.appendChild(img);
				// init cropper
				cropper = new Cropper(img,{
                    viewMode: 1,
                    preview: '.image-preview',
                    autoCropArea: 1,
                    movable: false,
                    cropBoxResizable: true,
                    minContainerWidth: 568,
                    minContainerHeight: 320
                });
      }
    };
    reader.readAsDataURL(e.target.files[0]);
    $modal.modal('show');
  }
  $(this).val("");
});
// save on click
$(document).on('click','#crop',function(e){
  e.preventDefault();
  $('#loader').show();
  // get result to data uri
  let imgSrc = cropper.getCroppedCanvas().toDataURL();
  jQuery("#preview-box-target").attr('src',imgSrc);
  jQuery('#crop_step2_file').val(imgSrc);
  $modal.modal('hide'); 

  $('#entityLogo').attr('required',true);
          $('#entityLogo').css('display','none');
          $('.cross-icons-logo').show();
          $('#entityLogo-error').hide();
          setTimeout(function() {
            $('#loader').hide();
          }, 2000); // 10000 milliseconds = 10 seconds
});
$(document).on('click','.cross-icons-logo',function(){
    jQuery("#preview-box-target").attr('src','');
    $('#loader').show();
    $('#entityLogo').css('display','block');
    $(this).hide();
    jQuery("#preview-box-target").attr('src',SKIN_URL+'/images/add_more.png');
    $('#entityLogo').attr('required',true);
    $('#entityLogo').val('');
    $('#crop_step2_file').val('');
    setTimeout(function() {
        $('#loader').hide();
      }, 2000); // 10000 milliseconds = 10 seconds
  });
jQuery(document).ready(function(){
    jQuery("#billingaddresss").click(function(){

        let usersprofile         = jQuery("#usersprofile").val();
        let entity_Type          = jQuery("#select_entity_id").val();
        let Addresswontneed      = ['2','3','4','5','12','13'];
        let addresschekc         = Addresswontneed.includes(entity_Type);

        if(addresschekc == true){
            //jQuery(".step-2-address").hide();
            let step_1_address = jQuery("#step_1_address_proof").val();
            jQuery("#address_proof_name").val(step_1_address);
            let num = jQuery("#step_1_address_type").val();
            jQuery("#b_addressProof_type option").each(function(){
                if(jQuery(this).val()==num){ 
                    jQuery(this).attr("selected", true);    
                }
            });
        }

        if (jQuery(this).prop('checked')) {
      

            jQuery("#billingaddressCheck").val(1);
            $.ajax({
                type: "POST",
                dataType: "text",
                url: BASE_URL+"register/getcontributoraddress/",
                data: {usersprofile:usersprofile},
                success: function(response) {
                    jQuery(".sameasregisteredAddress").show();
                    jQuery(".sameasregisteredAddress").html(response);
                    jQuery(".billingAddress").hide();

                }
            });
        }
        else{

            jQuery("#b_addressProof_type option").each(function(){
                let num = jQuery("#step_1_address_type").val();
                if(jQuery(this).val()==num){ 
                    jQuery(this).attr("selected", false);    
                }
            });

            jQuery("#billingaddressCheck").val(0);
            jQuery(".billingAddress").show();
            jQuery(".sameasregisteredAddress").hide();
          //  jQuery(".step-2-address").show();
        }
    });
    jQuery("#bstate").change(function(){
        let stID = jQuery(this).val();
        if(stID){
            $.ajax({
                type: "POST",
                dataType: "text",
                url: BASE_URL+"register/getalldistrictbystateid/",
                data: {stID:stID},
                success: function(response) {
                   $("#bcityOrDistrict").html(response);
                  //  $("#bcityOrDistrict").prop("disabled", false);
                }
            });
        }
    });
});

var i = 0;
function addMoreState() {
    i = $(document).find('.area_of_service_state').length;
    $.ajax({
        type: "POST",
        dataType: "text",
        url: BASE_URL+"register/getareaofbusinessoperation/",
        data: {count:i},
        success: function(response) {
            jQuery(response).appendTo('#addmore-state');
            callareaofsB(i);
        }
    });
}
function callareaofsB(){
    jQuery("._areaofsB select").change(function(){
        let stcode  = jQuery(this).val();
        let classid = jQuery(this).next().attr('class');
        let $this = $(this);
            $.ajax({
                type: "POST",
                dataType: "text",
                url: BASE_URL+"register/getalldistrictbystatecodeAjax/",
                data: {stcode:stcode,count:i},
                success: function(response) {
                  $this.closest('.area_of_buisness_state').find('.col-sm-select').html(response);
                  $this.closest('.area_of_buisness_state').find('.col-sm-select select').multiselect({
                    columns: 1,
                    placeholder: 'Select District',
                    search: true,
                    selectAll: true,
                  });
                  if(stcode){
                    $this.closest('.area_of_buisness_state').find('.col-sm-select select').attr('required',true);
                  }
                  $this.closest('.area_of_buisness_state').find('.col-sm-select select').css('display','block');
                  $this.closest('.area_of_buisness_state').find('.col-sm-select select').css('visibility','hidden');
                }
            });
    });
}
jQuery(document).on('change', '.selector-dist', function() {
    if($(this).val() != ''){
        $(this).closest('div').find('.error').css('display','none');
    }else{
        $(this).closest('div').find('.error').css('display','block');
    }
});
jQuery("._areaofsB .area_of_service_state").change(function(){
    console.log('ABC');
    let stcode  = jQuery(this).val();
    let classid = jQuery(this).next().attr('class');
    let $this = $(this);
        $.ajax({
            type: "POST",
            dataType: "text",
            url: BASE_URL+"register/getalldistrictbystatecodeAjax/",
            data: {stcode:stcode,count:i},
            success: function(response) {
              $this.closest('.area_of_buisness_state').find('.col-sm-select').html(response);
              $this.closest('.area_of_buisness_state').find('.col-sm-select select').multiselect({
                columns: 1,
                placeholder: 'Select District',
                search: true,
                selectAll: true,
              });
              if(stcode){
                $this.closest('.area_of_buisness_state').find('.col-sm-select select').attr('required',true);
              }
              $this.closest('.area_of_buisness_state').find('.col-sm-select select').css('display','block');
              $this.closest('.area_of_buisness_state').find('.col-sm-select select').css('visibility','hidden');
            }
        });
});
jQuery(".a_of_b_o input[type='radio']").click(function () {
    var radioValue = $("input[name='panIndia']:checked").val();
    if (radioValue == "1") {
        //jQuery(".area_of_buisness_state select").prop("disabled", false);
        jQuery(".area_of_buisness_state select").prop("required", true);
        jQuery(".add-more-state-btn").show();
        jQuery(".area_of_buisness_state select").prop("disabled", false);
    }
    else {
        //jQuery(".area_of_buisness_state select").prop("disabled", true);
        jQuery(".area_of_buisness_state select").prop("required", false);
        jQuery(".add-more-state-btn").hide();
        jQuery(".area_of_buisness_state select").prop("disabled", true);
        jQuery(".area_of_buisness_state select").val('');
    }
    jQuery(".area_of_buisness_state").find(".col-sm-select select").multiselect('reload');
});
/*
    Sanjay Oraon
    Date 21-09-2023
    on submit validation function
*/
function opertermsandcondition(){
    $("#edit-ngo-form-2").submit();
}
// function opertermsandcondition() {

//     let bemail   = $("#entityAltEmail").val();
//     let bwebsite = $("#website").val();
//     let flag     = true;

//     if(bemail.length <= 0){
//         jQuery("#entityAltEmail").addClass("error");
//         jQuery("#emailerror").html('This field is required.');
//         $('html,body').animate({
//         scrollTop: $("#entityAltEmail").offset().top},
//             'slow');
//         flag = false;
//     } 
//     else if(bemail.length > 0){
//         var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
//         if(bemail.match(mailformat))
//         {
//             jQuery("#emailerror").html('');
//             jQuery("#entityAltEmail").removeClass("error");
//         }
//         else
//         {
//             jQuery("#entityAltEmail").addClass("error");
//             jQuery(".email_error").html('This field is required.');
//             $('html,body').animate({
//             scrollTop: $("#entityAltEmail").offset().top},
//                 'slow');
//             flag = false;
//         }
//     }
//      if(bwebsite == null || bwebsite ==""){
//         jQuery("#website").addClass("error");
//         jQuery("#websiteerror").html('This field is required.');
//         $('html,body').animate({
//         scrollTop: $("#website_error_div").offset().top},
//             'slow');
//         flag = false;
//      }
//      else if(bwebsite.length > 0){

//          if(!is_valid_url(bwebsite)){
//             jQuery("#website").addClass("error");
//             jQuery("#websiteerror").html('Invalid');
//             flag = false;
//          }
//          else{
//             jQuery("#website").removeClass("error");
//             jQuery("#websiteerror").html('');  
//          }
//     }
//     else{
//         jQuery("#website").removeClass("error");
//         jQuery("#websiteerror").html('');
//     }

//     if(flag == true){
//         $('#TermsConditionKYC').modal();
//     }
// }
// function is_valid_url(url) {
//     return /^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(url);
// }

           
        




jQuery("#b_addressProof_type").change(function(){
    let uploadname = jQuery(this).val();
    if(uploadname){
         //jQuery(".progress_bar").show();
         jQuery('#file-uploader').trigger('click');
         jQuery("#address_proof_name").val(uploadname);
         //jQuery("#b_addressProof_type").val('');
    }
    else{
        jQuery("#address_proof_name").val();
        jQuery('.custom_file_box').hide();
        jQuery('.custom_file_box,.file-exist,.not-file-exist').hide();
    }
});

const fileUploader = document.getElementById('file-uploader');
const feedback = document.getElementById('feedback');
const progress = document.getElementById('progress');
const readers = new FileReader();
fileUploader.addEventListener('change', (event) => {
  const files = event.target.files;
  const file = files[0];
  readers.readAsDataURL(file);
  
  /*readers.addEventListener('progress', (event) => {
    if (event.loaded && event.total) {
      const percent = (event.loaded / event.total) * 100;
      progress.value = percent;
      document.getElementById('progress-label').innerHTML = Math.round(percent) + '%';
      
      if (percent === 100) {
        let msg = `<span style="color:green;">File <u><b>${file.name}</b></u> has been uploaded successfully.</span>`;
        feedback.innerHTML = msg;
      }
    }
  });*/

    var validExtensions = ['jpg','png','pdf']; 
    var fileName = event.target.files[0].name;
    var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
    
    if ($.inArray(fileNameExt, validExtensions) == -1){
            jQuery("#b_addressProof_type").val('');
            jQuery(".progress_bar").hide();
            jQuery("#b_addressProof_type-error").text('Address proof should be .jpg, .png and .pdf format');
    }else{
            jQuery("#b_addressProof_type-error").text('');
            jQuery(".progress_bar").show();
            //jQuery("#b_addressProof_type").val(jQuery("#address_proof_name").val());
    }

});
function deleteBusinessOperation(){
    const element = document.getElementById("area_of_buisness_state_id");
    element.remove();
}
