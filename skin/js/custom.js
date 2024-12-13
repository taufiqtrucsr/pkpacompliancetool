jQuery(document).ready(function () {
    jQuery(".slideRegister input[type='radio']").click(function () {
        var radioValue = $("input[name='radio']:checked").val();
        if (radioValue == "individual") {
            jQuery("#enityType").val(2);
            jQuery("#enityName").val("NULL");
            jQuery(".entity").hide();
            jQuery(".entity_type").hide();
            jQuery('.entity_type option:first').prop('selected',true);

        }
        else {
            jQuery("#enityName").val("");
            jQuery("#enityName-error").show();
            jQuery("#enityName-error").html("This field is required.");
            jQuery("#enityType").val(1);
            jQuery(".entity").show();
            jQuery(".entity_type").show();
        }


    });
    jQuery(".slideLogin input[type='radio']").click(function () {
        var radioValue1 = $(".slideLoginTab input[name='radio_1']:checked").val();
        if (radioValue1 == "individual") {
            jQuery("#enityTypeLogin").val(2);
        }
        else {
            jQuery("#enityTypeLogin").val(1);
        }
    });
    jQuery(".slide_click_1").click(function () {

        jQuery(".slide_1").hide();
        jQuery(".slide_2").addClass("slide_2_animation");
        jQuery(".slide_2").show();

    });
    jQuery(".slide_click_2").click(function () {

        jQuery(".slide_2").hide();
        jQuery(".slide_1").show();

    });

});
$(function () {
    $("#ImpentityType").change(function () {
        let Impentity_id = $(this).val();
        Impentity_id == 7 ? $(".govActS").hide() : $(".govActS").show();
    });
});



