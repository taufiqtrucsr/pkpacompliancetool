function f1(objButton){
    var donate_amount =  objButton.value;
    // $("#txt_name").val(donate_amount); 
    $("#proDonationAmt").val(donate_amount);
    // let donate_submit = "Proceed to donate ₹  ";
    var donta_value =document.getElementById("myTextBoxResult").value=donate_submit.concat(donate_amount);
// alert(objButton.value);   
    }
    // code for 80 G option start here
    // ORIGINAL CODE COMMENTED BECASUE ADDED CHECKBOX FEATURE 
    // $(document).ready(function(){
    //     $(".optional_container").hide();
    //         $(".80g_option").click(function() {
    //         if($(this).is(":checked")) {
    //             $(".optional_container").fadeIn(500);
    //         } 
            
    //     });
        
    // });

    // CODE ADDED CHECKBOX FEATURE 
    $(document).ready(function(){
        $(".optional_container").hide();
            $(".80g_option").click(function() {
            if($(this).is(":checked")) {
                $(".optional_container").fadeIn(500);
            } else{
                if($(this).not(":checked")) {
                    $(".optional_container").fadeOut(500);
                    } 
            }
            
        });
        
    });

    $(document).ready(function(){
        // CODE COMMENTED DUE TO CHECKBOX FEATURE 
        // Code commented be casuse condition has changes on 29 December 2021
        // $(".optional_container").hide();
        //     $(".anyonymous_option").click(function() {
        //     if($(this).is(":checked")) {
        //         $(".optional_container").fadeOut(400);
        //     } 
            
        // });

       

        $('.other_amt').hide();
        $('.other').click(function(){
            $(".other").hide();
            $(".other_amt").show();
            // $("#txt_name").animate({ width: "100%" }, 600);
            $("#proDonationAmt").animate({ width: "100%" }, 600);
            $(".other_amt").dblclick();
        });

        $(document).ready(function() {
            // $("#txt_name").keyup(function() {
            $("#proDonationAmt").keyup(function() {
               // alert($(this).val());
        var other_donate_amount = $(this).val();
        var donate_submit = "Proceed to donate ₹  ";
        var donta_value =document.getElementById("myTextBoxResult").value=donate_submit.concat(other_donate_amount);
            });
        })

        $(document).ready(function(){
            $(".amt_btn").click(function(){
                 $("#amt_btn").animate({ width: "40%"},300);
                $(".other_amt").hide();
                $(".other").show();
                $(".ohter").animate({width:"400%"},1000);
            });
        });

    });
// code for donate now button active color 
    $('.amt_btn').click(function() {
        var value = $(this).attr('id');
        // alert(value);
        if (value == "amt") {
            $('.menu').removeClass("current");
            $(this).addClass("current");
        }
    
    });

    $(".donate_now_btn").click(function(){
    //    var donate_now_amount = $('.donate_amtt').val();
    var donate_now_amount = $('.current_amount').val();
       if(donate_now_amount>0){
        $(".other").hide();
        $(".other_amt").show();
        // $("#txt_name").val(donate_now_amount).animate({ width: "100%"},1000);
        $("#proDonationAmt").val(donate_now_amount).animate({ width: "100%"},1000);
        $("#myTextBoxResult").val("Proceed to donate ₹  "+ donate_now_amount);
        $(".amt_btn").removeClass("current");
        

       }
       else if(donate_now_amount<0){
        alert("The amount value is wrong , You can select another amount....!");
        //$(".donate_amt").reset();

       }
       

    });

    $(".donate_amt").click(function(){
        var value = $(this).attr('id');
        //  alert(value);
        if (value == "dnt_now") {
            $('.menu').removeClass("current_amount");
            $(this).addClass("current_amount");
        }
    });


    // code for dependent dropdown list

    // $(function () {
    //     $("#ddlPassport").change(function () {
    //         if ($(this).val() == "pand_card") {
    //             alert("THIS IS PAND CARD");
    //             // $("#dvPassport").show();
    //         } else {
    //             alert("this is not pan card");
    //             // $("#dvPassport").hide();
    //         }
    //     });
    // });


    $(document).ready(function(){
        $("select").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue){
                    $(".box").not("." + optionValue).hide();
                    $("." + optionValue).show();
                    $(".address_row").show();
                } else{
                    $(".box").hide();
                }
            });
        }).change();
    });


    // code for and hide pand card details
    function myFunction() {
        // alert("testing");
        // var donation_amount = document.getElementById("txt_name");
        var donation_amount = document.getElementById("proDonationAmt");
        var value_donation = donation_amount.value;
        var limit_donation = 50000;
        // alert(limit_donation);
        if(value_donation > 49999){
        // if(donation_amount.value >= 50000){
            //  alert("testing value is greater than 50000");
            $(".documents"). prop('disabled', true);     
            $('.documents option[value="pan_number"]').prop('selected', 'selected').change();
            $('.documents option[value="pan_number"]').trigger( 'click' );
            $('.documents option[value="pan_number"]').click(); 
        
        }else{
            $(".documents"). prop('disabled', false); 
            $('.documents option[value="select_id_proof"]').prop('selected', 'selected').change();
            $('.documents option[value="select_id_proof"]').trigger( 'click' );
            $('.documents option[value="select_id_proof"]').click();   
        }
    }


    function lower_to_upperFunction(classId) {
        
        // var x = document.getElementById("pan_number");
        var x = document.getElementById(classId);
        x.value = x.value.toUpperCase();
      }

    //   code for query injection 

    function allowAlphaNumericSpace(e) {
    var code = ('charCode' in e) ? e.charCode : e.keyCode;
    if (!(code == 32) && // space
        !(code > 47 && code < 58) && // numeric (0-9)
        !(code > 64 && code < 91) && // upper alpha (A-Z)
        !(code > 96 && code < 123)) { // lower alpha (a-z)
        e.preventDefault();
    }
    }

    function allowOnlyNumeric(e) {
        var code = ('charCode' in e) ? e.charCode : e.keyCode;
        if (!(code == 32) && // space
            !(code > 47 && code < 58)){ // numeric (0-9)
            e.preventDefault();
        }
        }

    function allownumberandcomma(e) {
        var code = ('charCode' in e) ? e.keyCode : e.keycode;
        if (!(code == 32) && // space
            !(code > 47 && code < 58) && // numeric (0-9)
            !(code > 64 && code < 91) && // upper alpha (A-Z)
            !(code > 96 && code < 123)) { // lower alpha (a-z)
            e.preventDefault();
        }
        }

        function allowonlyalphabets(e) {
            var code = ('charCode' in e) ? e.keyCode : e.keycode;
            if 
                (!(code == 32) && // space
                    !(code > 64 && code < 91) && // upper alpha (A-Z)
                !(code > 96 && code < 123)) { // lower alpha (a-z)
                e.preventDefault();
            }
            }
    

        $('#donor_address').keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z , . 0-9]");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
    
            e.preventDefault();
            return false;
        });

        $('#donor_fname_and_lname').keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z ]");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
    
            e.preventDefault();
            return false;
        });

        


    

       
       

    
    // code for dependent dropdownl list ends here





        
        
