$(document).ready(function () {
    $('#countdown').hide();
    start_countdown();
    // setTimeout(function(){
    checkCookie();
    // }, 1000);
    if(typeof fileOne !== 'undefined'){
        fileOne.onchange = evt => {
            const [file] = fileOne.files;
            if (file && file.type == 'application/pdf') {
            //$(targetOne).closest('div').find('.file-name').text($(this).val().replace(/C:\\fakepath\\/i, ''));
            targetOne.href = URL.createObjectURL(file);
            $(targetOne).closest('div').find('.file-error').text('');
            $('#targetOne').css('display','block');
            }else{
                fileOne.value = '';
                $('#targetOne').css('display','none');
                $(targetOne).closest('div').find('.file-error').text('Only PDF Allowed.');
            }
        }
    }
    function validateFile(fn){
       var validExtensions = ['jpg','png','jpeg']; 
        var fileNameExt = fn.substr(fn.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1)
            return false;
        else
            return true;
    }
    $(document).on('change','.multiple-file-api',function(e){
        if(this.files.length>0 && validateFile(this.files[0].name)){
            $(this).parent().prepend(`<svg class="cross-icon"xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>`);
            $(this).parent().find('img').attr('src',URL.createObjectURL(this.files[0]));
            $(this).parent().find('input').css('display','none');
            $('.preview-container').append(`<div class="upload_imgs">
                                                <input type="file" name="case_study_image[]" accept="" class="upload __upload multiple-file-api">
                                                <img src="`+SKIN_URL+`/images/add_more.png">
                                            </div>`);
        }else{
                $(this).parent().find('img').attr('src',SKIN_URL+'/images/add_more.png');
                if(this.files.length>0)
                    $(this).parent().prepend(`<span class="error-image-span">jpg,png allowed</span>`);

                $(this).val('');

        }
    });
    $(document).on('click','.cross-icon',function(e){
        $(this).parent().remove();
    });
    $(document).on('click','.cross-icon-x',function(e){
        $(this).parent().find('.file-api').val('');
        $(this).parent().find('img').attr('src',SKIN_URL+'/images/add_more.png');
        $(this).remove();
    });
    $(document).on('click','.event-delete-testimonial',function(e){
        $(this).closest('.testimonails-count').remove();
    });
    $(document).on('click','.remove-case-study-file',function(e){
        var t = $(this).data('id');
        $('[name="case_study_file_removed"]').val(function(i,val) { 
                return val + (!val ? '' : ',') + t;
        });
    });
    $(document).on('click','.file-api,.multiple-file-api',function(e){
        $(this).parent().find('span').remove();
    });
    $(document).on('change','.file-api',function(e){
        if(this.files.length>0 && validateFile(this.files[0].name)){
            $(this).parent().prepend(`<svg class="cross-icon-x" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>`);
                $(this).parent().find('img').attr('src',URL.createObjectURL(this.files[0]));
        }else{
            $(this).parent().find('img').attr('src',SKIN_URL+'/images/add_more.png');
            if(this.files.length>0)
                $(this).parent().prepend(`<span class="error-image-span">jpg,png allowed</span>`);

            $(this).val('');
        }
    });
    $('.close-cookie').click(function () {
        cookie_pop_up = 'cookie_pop_up';
        setCookie("cookie_pop_up", cookie_pop_up, 365);
        closeCookiePop();
    });

    $.validator.addMethod('mypassword', function (value, element) {
        return this.optional(element) || (value.match(/[a-zA-Z]/) && value.match(/[0-9]/) && value.match(/[!@#$%^&*():;?_~+=]/));
    },
        'Password must contain at least one alphabetic, one numeric and one special character.');

    $(document).on("keydown",".validate-number",function (event) {


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
    $(document).on("keypress",".validate-char",function (key) {
        if ((key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45 && key.charCode != 32 && key.charCode != 0)) {
            return false;
        }
    });

    $(document).on("change",".validate-char",function () {
        var e =$(this).val();
        var regex =  /^([A-Za-z ]+$)/;
        if(regex.test(e)==false){
            $(this).val('');
        } 
    });
	
	/*	Sanjay oraon
		26/06/2023
		Email And Entity Validation Function
	*/
	jQuery.validator.addMethod("emailFormat", function(value, element) {
		var regex =  /^([a-zA-Z])+([a-zA-Z|0-9._-])+\@(([a-zA-Z-])+\.)+([a-zA-Z]{2,4})+$/;
		return regex.test(value);
	}, "Please Enter A Valid Email Address.");
	jQuery.validator.addMethod("entityFormat", function(value, element) {
		var regex =  /^([a-zA-Z])+[a-zA-Z|0-9.\s]+$/;
		return regex.test(value);
	}, "Please Enter A Valid Entity Name.");
	/*	-------------- */
	
    jQuery.validator.addMethod("noSpace", function(value, element) { 
        return value == '' || value.trim().length != 0;  
    }, "No space please and don't leave it empty");
	  
    $("#signup-user").validate({
        ignore: ':hidden:not("#hiddenRecaptcha")',
        rules: {
            enityType: {
                required: true,
            },
            inputFname: {
                required: true,
                noSpace:true
            },
            inputMiddle: {
                required: true,
                noSpace:true
            },
            inputLname: {
                required: true,
                noSpace:true
            },
            inputEmail: {
                required: true,
                email: true,
				emailFormat : true // Sanjay oraon 26/06/2023 Email Validation Function
            },
            enityName: {
                required: true,
                noSpace: true,
                maxlength: 100,
				entityFormat : true // Sanjay oraon 26/06/2023 Entity Validation Function
            },
            entityType: {
                required: true,
            },
            orgType: {
                required: true,
            },
            inputMobile: {
                required: true,
                digits: true,
                minlength: 10,
                minlength: 10
            },
            CheckTerms: {
                required: true,
            },
            hiddenRecaptcha: {
                required: function () {
                    if (grecaptcha.getResponse() == '') {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
        },
        messages: {
            inputMobile: { "minlength": "Please enter 10 digit number." }
        },
        submitHandler: function (form) {
            $.ajax({
                url:baseUrl+'register/isExist',
                type: 'ajax',
                method: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                success: function (response) {
                    if (response.flag == 1) {
                        jQuery("#TermsConditionKYC").modal('toggle');
                    } else {
                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'error'
                        })
                        setTimeout(function () { }, 1000);
                    }
                }
            }); 
        }
    });
	
	$("#sidebar-menu-list-box a").each(function() {
        if (this.href == window.location.href) {
            $(this).closest('li').addClass("active");
        }
    });
	
	/* 
		sanjay oraon 
		27/06/2023 
		Accept Term And Condition
	*/
	jQuery("#AcceptTerm").click(function(){
		if($("#AcceptTerm").prop("checked") == true)
			$(".AcceptTermError").hide();
	});
    jQuery(document).on('click','.event-delete-row',function(){
		$(this).closest('tr').remove();
	});
    jQuery(".iconsent").click(function(){
		if($("#AcceptTerm").prop("checked") == true){ 
			let form_action = jQuery("#signup-user").attr('action');
			let form_method = jQuery("#signup-user").attr('method');
			let form = jQuery("#signup-user");
			var phone_no = $("#inputMobile").val();
			$.ajax({
				url:form_action,
				type: 'ajax',
				method: form_method,
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (response.flag == 1) {
						jQuery("#TermsConditionKYC").modal('toggle');
						$('#login_form').hide();
						$('#otp_form').show();
						$('#phn-label').html(phone_no);
						$('#otp-phone').val(phone_no);
						$.toast({
							heading: '',
							text: response.msg,
							showHideTransition: 'slide',
							icon: 'success'
						})
						setTimeout(function () {
						}, 1000);

					} else {
						//grecaptcha.reset();
						$.toast({
							heading: '',
							text: response.msg,
							showHideTransition: 'slide',
							icon: 'error'
						})
						setTimeout(function () { }, 1000);
					}
				}
			});
		}else{
			$(".AcceptTermError").show();
			return false;
		}
    });
	/*-----------------------------*/
    /*	Sanjay oraon
		22/09/2023
		Email Validation Function
	*/
	/*jQuery.validator.addMethod("emailFormat", function(value, element) {
		var regex =  /^([a-zA-Z])+([a-zA-Z|0-9])+\@(([a-zA-Z-])+\.)+([a-zA-Z]{2,4})+$/;
		return regex.test(value);
	}, "Please Enter A Valid Email Address.");*/

    $.validator.addMethod("noSpecialChars", function(value, element) {
        return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
      }, "Please enter only alphabets.");
    $("#send_message").validate({
        ignore: ":hidden",
        rules: {
            inputFullName: {
                required: true,
                noSpace:true,
                noSpecialChars: true
            },
            inputEmail: {
                required: true,
                email: true,
                emailFormat : true // Sanjay oraon 22/09/2023 Email Validation Function
               
            },
            inputOrganization: {
                required: true,
                noSpace:true,
            },
            inputContactNumber: {
                required: true,
                noSpace:true,
                digits: true,
                minlength: 10
            },
            inputMessage: {
                required: true,
                noSpace:true
            },
        },
        messages: {
            inputContactNumber: { "minlength": "It should be accept only 10 numbers." },
        },
        submitHandler: function (form) {
            $.ajax({
                url: form.action,
                type: 'ajax',
                method: form.method,
                dataType: 'json',
                data: $(form).serialize(),
                success: function (response) {               
                    if (response.status == 200) {
                        $.toast({
                            heading: '',
                            text: 'Thank you for contacting US!',
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'danger'
                        })
                    }
                }
            });
        }
    });

    jQuery.validator.addMethod("userEmailFormat", function(value, element) {
		var regex =  /^([a-zA-Z])+([a-zA-Z|0-9])+\@(([a-zA-Z-])+\.)+([a-zA-Z]{2,4})+$/;
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if(!numberRegex.test(value)) {
            return regex.test(value);
        }else{
            return true;
        }
	}, "Please Enter A Valid Email Address.");
    jQuery.validator.addMethod("userPhoneFormat", function(value, element) {
        var regex =  /^([0-9]{10})+$/;
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if(numberRegex.test(value)) {
            return regex.test(value);
        }else{
            return true;
        }
	}, "Please Enter 10 Digit Valid Phone Number.");

    $("#login-user").validate({
        ignore: ':hidden:not("#hiddenRecaptcha")',
        //ignore: ".ignore",
        rules: {
            inputMobileLogin: {
                required: true,
                minlength: 3,
                userEmailFormat : true, // Sanjay oraon 26/06/2023 Email Function
                userPhoneFormat : true // Sanjay oraon 26/06/2023 Phone Function

            },
            inputPasswordLogin: {
                required: true,
                minlength: 8,
                mypassword: true
            },
            hiddenRecaptcha: {
                required: function () {
                    if (grecaptcha.getResponse() == '') {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        },
        messages: {
            inputMobileLogin: { "minlength": "Please Enter Email ID Or Mobile Number" },
            inputPasswordLogin: { "minlength": "Please enter 8 or more characters." }
        },
        submitHandler: function (form) {
            $.ajax({
                url: form.action,
                type: 'ajax',
                method: form.method,
                dataType: 'json',
                data: $(form).serialize(),
                success: function (response) {
            
                    if (response.flag == 1) {

                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        setTimeout(function () {
                            window.location.href = response.redirect;

                        }, 1000);

                    } else {
                       
                        //grecaptcha.reset();
                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'error'
                        })
                        setTimeout(function () { }, 1000);
                    }
                }
            });
        }
    });


    $("#verify-otp").validate({
        ignore: ":hidden",
        rules: {
            inputPassword: {
                required: true,
                noSpace :true,
                minlength: 8,
                mypassword: true,
             
            },
            inputConfPassword: {
                equalTo: "#inputPasswordOTP"
            },
            otpNumber: {
                required: true,
                digits: true,
                minlength: 4,
                maxlength: 4

            },
        },
        messages: {
            inputPassword: { "minlength": "Please enter 8 or more characters." },
            confirmpassword: "Confirm Password does not match.",
            otpNumber: { "minlength": "Please enter 4 digit pin.", "maxlength": "Please enter 4 digit pin." },
        },
        tooltip_options: {
            otpNumber: { placement: 'right', html: true }
        },
        submitHandler: function(form) {
        $('#loader').show();
        var otpNumber = $("#otpNumber").val();
        var phone = $("#otp-phone").val();
        var inputFname = $("#inputFname").val();
        var inputLname = $("#inputLname").val();
        var inputMiddle = $("#inputMiddle").val();
        var inputEmail = $("#inputEmail").val();
        var inputMobile = $("#inputMobile").val();
        var inputPassword = $("#inputPasswordOTP").val();
        var enityName = $("#enityName").val();
        var enityType = $("#enityType").val();
        var orgType = $("#orgType").val();
        $.ajax({
            url: BASE_URL + "signup/verifyOtp",
            type: 'ajax',
            method: "POST",
            dataType: 'json',
            data: {
                otpNumber: otpNumber,
                phone: phone,
                inputFname: inputFname,
                inputLname: inputLname,
                inputMiddle: inputMiddle,
                inputEmail: inputEmail,
                inputMobile: inputMobile,
                inputPassword: inputPassword,
                enityName: enityName,
                enityType: enityType,
                orgType: orgType,
            },
            success: function (response) {
                if (response.flag == 1) {
                    window.location.href = response.redirect;
                    // $("#signup-user")[0].reset();
                    // $("#verify-otp")[0].reset();

                    // $('#login_form').hide();
                    // $('#otp_form').hide();
                    // $("#success-otp").show();


                    $.toast({
                        heading: '',
                        text: response.msg,
                        showHideTransition: 'slide',
                        icon: 'success'
                    })


                } else {
                    $('#loader').hide();
                    $.toast({
                        heading: '',
                        text: response.msg,
                        showHideTransition: 'slide',
                        icon: 'error'
                    })

                }
            }
        });
        }
    });


    // $('#verify-otp').submit(function (e) {

    //     e.preventDefault();

    //     var otpNumber = $("#otpNumber").val();
    //     var phone = $("#otp-phone").val();
    //     var inputFname = $("#inputFname").val();
    //     var inputLname = $("#inputLname").val();
    //     var inputMiddle = $("#inputMiddle").val();
    //     var inputEmail = $("#inputEmail").val();
    //     var inputMobile = $("#inputMobile").val();
    //     var inputPassword = $("#inputPasswordOTP").val();
    //     var enityName = $("#enityName").val();
    //     var enityType = $("#enityType").val();
    //     var orgType = $("#orgType").val();
    //     $.ajax({
    //         url: BASE_URL + "signup/verifyOtp",
    //         type: 'ajax',
    //         method: "POST",
    //         dataType: 'json',
    //         data: {
    //             otpNumber: otpNumber,
    //             phone: phone,
    //             inputFname: inputFname,
    //             inputLname: inputLname,
    //             inputMiddle: inputMiddle,
    //             inputEmail: inputEmail,
    //             inputMobile: inputMobile,
    //             inputPassword: inputPassword,
    //             enityName: enityName,
    //             enityType: enityType,
    //             orgType: orgType,
    //         },
    //         success: function (response) {
    //             if (response.flag == 1) {
    //                 window.location.href = response.redirect;
    //                 // $("#signup-user")[0].reset();
    //                 // $("#verify-otp")[0].reset();

    //                 // $('#login_form').hide();
    //                 // $('#otp_form').hide();
    //                 // $("#success-otp").show();


    //                 $.toast({
    //                     heading: '',
    //                     text: response.msg,
    //                     showHideTransition: 'slide',
    //                     icon: 'success'
    //                 })


    //             } else {
    //                 $.toast({
    //                     heading: '',
    //                     text: response.msg,
    //                     showHideTransition: 'slide',
    //                     icon: 'error'
    //                 })

    //             }
    //         }
    //     });

    // });


    $(document).on('click', '.toggle-password', function () {

        $(this).toggleClass("fa-eye fa-eye-slash");

        var input = $("#inputPassword");

        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
    });


    $(document).on('click', '.toggle-password-login', function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#inputPasswordLogin");
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
    });

    $(document).on('click', '.toggle-password-otp', function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#inputPasswordOTP");
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
    });
    /*$(document).on('click', '.sector-img-sec-sdgs img', function () {
        if($(this).closest('div').find('input[type=checkbox]').prop('checked')==true){
            $(this).removeClass("active");
            $(this).css("filter",'grayscale(1)');
            $(this).closest('div').find('input[type=checkbox]').attr('checked',false);
        }else{
            $(this).addClass("active");
            $(this).css("filter",'none');
            $(this).closest('div').find('input[type=checkbox]').attr('checked',true);
        }
    });*/

    $(document).on('click', '.toggle-Confpassword', function () {

        $(this).toggleClass("fa-eye fa-eye-slash");

        var input = $("#inputConfPassword");
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
    });

    $(document).on('click', '.toggle-Newpassword', function () {

        $(this).toggleClass("fa-eye fa-eye-slash");

        var input = $("#inputNewPassword");
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
    });

    $(document).on('click', '.toggle-Repassword', function () {

        $(this).toggleClass("fa-eye fa-eye-slash");

        var input = $("#inputRePassword");
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
    });

    $(".form_datetime").datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
        todayHighlight: true,
        toggleActive: true,
    });


    $("#verifymobile-user").validate({
        ignore: ":hidden",
        rules: {
            inputMobile: {
                required: true,
                digits: true,
                minlength: 10,
                minlength: 10

            }
        },
        messages: {
            inputMobile: { "minlength": "Please enter 10 digit number." }

        },
        submitHandler: function (form) {
            var phone_no = $("#inputMobile").val();

            $.ajax({
                url: form.action,
                type: 'ajax',
                method: form.method,
                dataType: 'json',
                data: $(form).serialize(),
                success: function (response) {
                    //console.log(response);
                    if (response.flag == 1) {

                        $('#verifymobile_form').hide();
                        $('#otp_form').show();
                        $('#phn-label').html(phone_no);
                        $('#otp-phone').val(phone_no);
                        $('#password-phone').val(phone_no);


                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        setTimeout(function () {
                            //window.location.href = response.redirect;

                        }, 1000);

                    } else {
                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'error'
                        })
                        setTimeout(function () { }, 1000);
                    }
                }
            });
        }
    });


    $("#forgotpwd-otp").validate({
        ignore: ":hidden",
        rules: {
            otpNumber: {
                required: true,
                digits: true,
                minlength: 4,
                maxlength: 4
            },
        },
        messages: {
            otpNumber: { "minlength": "Please enter 4 digit pin.", "maxlength": "Please enter 4 digit pin." },
        },
        tooltip_options: {
            otpNumber: { placement: 'right', html: true }
        },
        submitHandler: function (form) {

            var otpNumber = $("#otpNumber").val();
            var phone = $("#otp-phone").val();

            $.ajax({
                url: form.action,
                type: 'ajax',
                method: form.method,
                dataType: 'json',
                data: { otpNumber: otpNumber, phone: phone },

                success: function (response) {

                    if (response.flag == 1) {

                        $("#verifymobile-user")[0].reset();
                        $("#forgotpwd-otp")[0].reset();

                        $('#verifymobile_form').hide();
                        $('#otp_form').hide();
                        $('#password_form').show();
                        //$("#success-otp").show();


                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        setTimeout(function () {

                        }, 1000);

                    } else {
                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'error'
                        })
                        setTimeout(function () { }, 1000);
                    }
                }
            });
        }
    });


    $("#setpassword-user").validate({
        ignore: ":hidden",
        rules: {
            inputNewPassword: {
                required: true,
                minlength: 8,
                mypassword: true
            },
            inputRePassword: {
                equalTo: "#inputNewPassword"
            }

        },
        messages: {
            inputPassword: { "minlength": "Please enter 8 or more characters." },
            confirmpassword: "Confirm Password does not match."

        },
        submitHandler: function (form) {
            $.ajax({
                url: form.action,
                type: 'ajax',
                method: form.method,
                dataType: 'json',
                data: $(form).serialize(),
                success: function (response) {
                    //console.log(response);
                    if (response.flag == 1) {

                        $('#verifymobile_form').hide();
                        $('#otp_form').hide();
                        $('#password_form').hide();
                        $("#success-password").show();

                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        setTimeout(function () { }, 1000);

                    } else {
                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'error'
                        })
                        setTimeout(function () { }, 1000);
                    }
                }
            });
        }
    });

    $(document).on('click', '.globalmsg_closebtn', function () {
        $(this).parent().hide();
    });

    $("#gallery-carousel").owlCarousel({

        //autoPlay: 3000, //Set AutoPlay to 3 seconds
        navigation: true,
        margin: 50,
        loop: true,
        dots: false,
        items: 2,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3]

    });

    //new added

    $(".swtich-account").click(function () {
        $(".swtich-account-item").toggle();
    });
    $(".click-profile").click(function () {
        $(".profile-listing-top").toggle();
        $(".swtich-account-item").hide();
    });

    if ($('#example5').length)         // use this if you are using id to check
    {
        $('#example5').sliderPro({
            width: 900,
            height: 300,
            orientation: 'vertical',
            loop: true,
            arrows: true,
            buttons: false,
            autoplay: true,
            thumbnailsPosition: 'right',
            thumbnailPointer: true,
            thumbnailWidth: 300,
            breakpoints: {
                800: {
                    thumbnailsPosition: 'bottom',
                    thumbnailWidth: 400,
                    thumbnailHeight: 100
                },
                500: {
                    thumbnailsPosition: 'bottom',
                    thumbnailWidth: 300,
                    thumbnailHeight: 100
                }
            }
        });
    }

});

function resendOtp() {
    var phone = $("#otp-phone").val();
    $("#otpNumber").val('');
    //$("#verify-otp")[0].reset();
    $.ajax({
        url: BASE_URL + "signup/resendOtp",
        type: 'ajax',
        method: 'POST',
        dataType: 'json',
        data: { phone: phone },
        success: function (response) {

            if (response.flag == 1) {
                $.toast({
                    heading: '',
                    text: response.msg,
                    showHideTransition: 'slide',
                    icon: 'success'
                })
                setTimeout(function () {

                }, 1000);

            } else {
                $.toast({
                    heading: '',
                    text: response.msg,
                    showHideTransition: 'slide',
                    icon: 'error'
                })
                setTimeout(function () { }, 1000);
            }

        }
    })
}


function forgotpwdresendOtp() {

    var phone = $("#otp-phone").val();

    $.ajax({
        url: BASE_URL + "forgotpassword/resendOtp",
        type: 'ajax',
        method: 'POST',
        dataType: 'json',
        data: { phone: phone },
        success: function (response) {

            if (response.flag == 1) {

                $.toast({
                    heading: '',
                    text: response.msg,
                    showHideTransition: 'slide',
                    icon: 'success'
                })
                setTimeout(function () {


                }, 1000);

            } else {
                $.toast({
                    heading: '',
                    text: response.msg,
                    showHideTransition: 'slide',
                    icon: 'error'
                })
                setTimeout(function () { }, 1000);
            }

        }
    })
}

function readURL(input) {
    $('#logo').addClass('upload-img');
    if (input.files && input.files[0]) {
        var file = input.files[0];
        var extension = file.name.split('.').pop().toLowerCase();

        console.log(file);
        console.log(extension);

        if (/\.(jpe?g|png|pdf)$/i.test(file.name)) {
            var reader = new FileReader();
            var pdfImage = BASE_URL + 'skin/images/pdf-icon.png';

            reader.onload = function (e) {
                if (extension == 'pdf') {
                    $('#upload_img').attr('src', pdfImage);
                } else {
                    $('#upload_img').attr('src', e.target.result);
                }
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            $.toast({
                heading: '',
                text: "Please select valid file type. The supported file types are .jpg , .png , .pdf",
                showHideTransition: 'slide',
                icon: 'error'
            })
            setTimeout(function () { }, 1000);
        }
    }
}

function recaptchaCallback() {
    $('#hiddenRecaptcha').valid();
};

//Verification popup - Display
function openVerificationPopup() {
    $('#orgVerifyPopup').modal();
}

//Verification ampaign popup - Display
function openCampaignPopup() {
    $('#campVerifyPopup').modal();
}
//Krishna developer start 
function UserType() {
    var org_type = $(".current_act_btn input[type='radio']").val();
    if (org_type == '') {
        alert('error');
    }
    else {
        $.ajax({
            url: BASE_URL + "discover/updateOrgType",
            type: 'ajax',
            method: 'POST',
            dataType: 'json',
            data: { org_type: org_type },
            success: function (response) {
                if (response.flag == 1) {
                    $.toast({
                        heading: '',
                        text: response.msg,
                        showHideTransition: 'slide',
                        icon: 'success'
                    })
                    setTimeout(function () {
                        window.location.href = response.redirect;
                    }, 1000);
                } else {
                    $.toast({
                        heading: '',
                        text: response.msg,
                        showHideTransition: 'slide',
                        icon: 'error'
                    })
                    setTimeout(function () { }, 1000);
                }
            }
        });
    }
}
//krishna developer end
//Verification popup - Select Ngo / Corporate action
function SaveSessionPurposeType() {
    var org_type = $("input[name='user_type']").val();
    if (!$("input[name='purpose_entity_1']").prop('checked') && !$("input[name='purpose_entity_2']").prop('checked')) {
        $('.error').show();
        return false;
    }
    $('.error').hide();
    var purpose_entity_1 = jQuery("input[name='purpose_entity_1']:checked").val();
    var purpose_entity_2 = jQuery("input[name='purpose_entity_2']:checked").val();
   
    $.ajax({
        url: BASE_URL + "discover/SaveSessionPurposeType",
        type: 'ajax',
        method: 'POST',
        dataType: 'json',
        data: { Purpose_entity_1: purpose_entity_1, Purpose_entity_2: purpose_entity_2, org_type: org_type},
        success: function (response) {
            if (response.flag == 1) {

                $.toast({
                    heading: '',
                    text: response.msg,
                    showHideTransition: 'slide',
                    icon: 'success'
                })
                setTimeout(function () {
                    window.location = response.redirect;
                }, 1000);

            } else {
                $.toast({
                    heading: '',
                    text: response.msg,
                    showHideTransition: 'slide',
                    icon: 'error'
                })
                setTimeout(function () { }, 1000);
            }

        }
    });
}

//Verification popup - Select Motivator / Fundraiser action
function updateUserType() {
    var user_type = $("input[name='user_type']:checked").val();
    console.log(user_type);
    if (user_type == '') {
        alert('error');
    } else {
        $.ajax({
            url: BASE_URL + "homepage/updateUserType",
            type: 'ajax',
            method: 'POST',
            dataType: 'json',
            data: { user_type: user_type },
            success: function (response) {

                if (response.flag == 1) {

                    $.toast({
                        heading: '',
                        text: response.msg,
                        showHideTransition: 'slide',
                        icon: 'success'
                    })
                    setTimeout(function () {
                        window.location.href = response.redirect;
                    }, 1000);

                } else {
                    $.toast({
                        heading: '',
                        text: response.msg,
                        showHideTransition: 'slide',
                        icon: 'error'
                    })
                    setTimeout(function () { }, 1000);
                }

            }
        });
    }
}

// Create Project Reciept start //

function readRecieptURL(input) {
    console.log(input.id);
    console.log(input.files);

    if (input.files && input.files[0]) {
        $("#" + input.id).parent('.reciept-upload').hide();
        var file = input.files[0];
        var extension = file.name.split('.').pop().toLowerCase();

        console.log(file);
        console.log(extension);
        if (/\.(jpe?g|png|pdf)$/i.test(file.name)) {
            var reader = new FileReader();
            var pdfImage = BASE_URL + 'skin/images/pdf-icon.png';

            reader.onload = function (e) {
                //$('#upload_img_' + input.id).attr('src', e.target.result);
                if (extension == 'pdf') {
                    $("#upload_img_" + input.id).html("<span class=\"upload-file\">" + "<img class=\"imageThumb\" src=\"" + pdfImage + "\" width=\"100\" hieght=\"100\" title=\"" + file.name + "\"/>" + "<br/><span class=\"file-name\">" + file.name + "</span><span class=\"remove\">X</span>" + "</span>");
                } else {
                    $("#upload_img_" + input.id).html("<span class=\"upload-file\">" + "<img class=\"imageThumb\" src=\"" + e.target.result + "\" width=\"100\" hieght=\"100\" title=\"" + file.name + "\"/>" + "<br/><span class=\"file-name\">" + file.name + "</span><span class=\"remove\">X</span>" + "</span>");
                }

                $('#upload_img_' + input.id + " .remove").click(function () {
                    // alert(input.id);
                    // alert(111111111)
                    $(this).parent(".upload-file").remove();
                    $("#" + input.id).val('');
                    $("#" + input.id).parent('.reciept-upload').show();
                });
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            $.toast({
                heading: '',
                text: "Please select valid file type. The supported file types are .jpg, .png, .pdf",
                showHideTransition: 'slide',
                icon: 'error'
            })
            setTimeout(function () { }, 1000);
        }
    }
}

function removeLink(counter) {
    $('#tr_' + counter).remove();
}

function removeReciept(inputId) {
    // alert(inputId);
    // alert(2222222222222)
    $('#upload_img_' + inputId).empty();
    $("#" + inputId).val('');
    $("#hidden" + inputId).val('');
    $("#hiddenGoalImage_" + inputId).val('');
    $("#" + inputId).parent('.reciept-upload').show();
}

function readCoverURL(input) {
    $(".cover-upload").hide('');
    console.log(input);
    console.log(input.files);

    if (input.files && input.files[0]) {
        var file = input.files[0];
        var extension = file.name.split('.').pop().toLowerCase();

        console.log(file);
        console.log(extension);

        var reader = new FileReader();
        var pdfImage = BASE_URL + 'skin/images/pdf-icon.png';

        reader.onload = function (e) {
            if (extension == 'pdf') {
                $("#uploadCoverImage").html("<span class=\"upload-file\">" + "<img class=\"imageThumb\" src=\"" + pdfImage + "\" width=\"100\" hieght=\"100\" title=\"" + file.name + "\"/>" + "<br/><span class=\"file-name\">" + file.name + "</span><span class=\"remove\">X</span>" + "</span>");
            } else {
                $("#uploadCoverImage").html("<span class=\"upload-file\">" + "<img class=\"imageThumb\" src=\"" + e.target.result + "\" width=\"100\" hieght=\"100\" title=\"" + file.name + "\"/>" + "<br/><span class=\"file-name\">" + file.name + "</span><span class=\"remove\">X</span>" + "</span>");
            }

            $(".remove").click(function () {
                $(this).parent(".upload-file").remove();
                $("#coverImage").val('');
                $(".cover-upload").show('');
            });
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function removeCoverImage() {
    $("#uploadCoverImage").empty();
    $("#coverImage").val('');
    $(".cover-upload").show('');
}

// Create Project Reciept end //

function readContractURL(input) {

    if (input.files && input.files[0]) {
        var file = input.files[0];
        var extension = file.name.split('.').pop().toLowerCase();

        console.log(file);
        console.log(extension);

        if (/\.(pdf)$/i.test(file.name)) {
            var reader = new FileReader();
            var pdfImage = BASE_URL + 'skin/images/pdf-icon.png';

            reader.onload = function (e) {
                if (extension == 'pdf') {
                    $("#contract_upload_name").html("<span class=\"upload-contract-file\">" + "<span class=\"file-name\">" + file.name + "</span><span class=\"remove-contract\">X</span>" + "</span>");
                } else {
                    $("#contract_upload_name").html("<span class=\"upload-contract-file\">" + "<span class=\"file-name\">" + file.name + "</span><span class=\"remove-contract\">X</span>" + "</span>");
                }

                $(".remove-contract").click(function () {
                    $(this).parent(".upload-contract-file").remove();
                    $("#contract_upload").val('');
                });
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            $.toast({
                heading: '',
                text: "Please select valid file type. The supported file type is .pdf",
                showHideTransition: 'slide',
                icon: 'error'
            })
            setTimeout(function () { }, 1000);
        }
    }
}

function readBoardURL(input) {

    if (input.files && input.files[0]) {
        var file = input.files[0];
        var extension = file.name.split('.').pop().toLowerCase();

        console.log(file);
        console.log(extension);

        if (/\.(jpe?g|png|pdf)$/i.test(file.name)) {
            var reader = new FileReader();
            var pdfImage = BASE_URL + 'skin/images/pdf-icon.png';

            reader.onload = function (e) {
                if (extension == 'pdf') {
                    $("#board_upload_name").html("<span class=\"upload-board-file\">" + "<span class=\"file-name\">" + file.name + "</span><span class=\"remove-board\">X</span>" + "</span>");
                } else {
                    $("#board_upload_name").html("<span class=\"upload-board-file\">" + "<span class=\"file-name\">" + file.name + "</span><span class=\"remove-board\">X</span>" + "</span>");
                }

                $(".remove-board").click(function () {
                    $(this).parent(".upload-board-file").remove();
                    $("#board_upload").val('');
                });
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            $.toast({
                heading: '',
                text: "Please select valid file type. The supported file types are .jpg , .png , .pdf",
                showHideTransition: 'slide',
                icon: 'error'
            })
            setTimeout(function () { }, 1000);
        }
    }
}
// Convert Number to INR
function convertToINRFormat(value, inputField) {
    var number = Number(value.replace(/,/g, ""));

    // India uses thousands/lakh/crore separators
    $(inputField).val(number.toLocaleString('en-IN'));
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function checkCookie() {
    var cookie_pop_up = getCookie("cookie_pop_up");
    if (cookie_pop_up != "") {
        // alert("Welcome again " + cookie_pop_up);
        closeCookiePop();

    } else {
        // cookie_pop_up = prompt("Please enter your name:", "");
        //cookie_pop_up = 'cookie_pop_up';
        if (cookie_pop_up != "" && cookie_pop_up != null) {
            //setCookie("cookie_pop_up", cookie_pop_up, 365);
            showCookiePop();
        }
    }
}
// document.cookie = "cookie_pop_up=";
function showCookiePop() {
    $('.cookie-policy').slideDown();
}
function closeCookiePop() {
    //$('.cookie-policy').slideUp();
    $('.cookie-policy').hide();
}

//Info Freezed popup - Display
function openFreezedInfoPopup() {
    $('#orgFreezedInfoPopup').modal();
}

function start_countdown() {
    //var counter=60*60;
    myVar = setInterval(function () {
        $.ajax
            ({
                type: 'get',
                url: BASE_URL + 'user/checkSession',
                data: {
                    //logout:"logout"
                },
                success: function (response) {
                    if (response == "logout") {
                        window.location = BASE_URL + 'logout';
                    } else {
                        if (response != "") {
                            $('#countdown').show();
                            $('#countdown').html('<a data-toggle="tooltip" title="Your session will expire in!">' + response + '</a>');
                        } else {
                            $('#countdown').hide();
                            $('#countdown').html('');
                        }
                    }
                }
            });
        //counter--;
    }, 1000)
}

// var currentSessionValue = 1;
// // pseudo code
// setTimeout(checkSession, 5000);
// function checkSession() {
	 // $.ajax({
		// url: BASE_URL+'/user/check_session', //Change this URL as per your settings
		// success: function(newVal) {
			// if (newVal != currentSessionValue);
				// currentSessionValue = newVal;
				// alert('Session expired.');
				// window.location = 'logout';
			// }
	 // });
// }
function initializeValidation(){

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

    $('.validate-char').on('keypress', function (key) {
        if ((key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45 && key.charCode != 32 && key.charCode != 0)) {
            return false;
        }
    });
    
}

$.validator.addMethod("dateNotGreaterThanToday", function(value, element) {
var inputDate = new Date(value);
var today = new Date();
today.setHours(0, 0, 0, 0); // Set the time to midnight for comparison
return inputDate <= today;
}, "Date must not be greater than today.");

// Alpha Numeric
$(document).ready(function() {
    $(document).on('input','#cin_no,orgName,#cinNumber,.alpha_numeric', function() {
        var inputVal = $(this).val();
        $(this).val(inputVal.replace(/[^a-zA-Z0-9]/g, ''));
    });
	$('.alpha_numeric_space').on('input', function() {
        var inputVal = $(this).val();
        $(this).val(inputVal.replace(/[^a-zA-Z0-9_ ]/g, ''));
    });
});
// Alpha Numeric
function handleAYVisibility(radio) {
    var fromAYFields = document.querySelectorAll('.fromAY');
    if (radio.value === 'YES') {
      fromAYFields.forEach(function(field) {
        field.style.display = 'block';
      });
    } else {
      fromAYFields.forEach(function(field) {
        field.style.display = 'none';
      });
    }
}
function handleDirextorVisibility(radio) {
    var fromAYFields = document.querySelectorAll('.registration-box');
    if (radio.value === 'YES') {
      fromAYFields.forEach(function(field) {
        field.style.display = 'block';
      });
    } else {
      fromAYFields.forEach(function(field) {
        field.style.display = 'none';
      });
    }
}
function handletwelveAYVisibility(radio) {
    var fromAYFields = document.querySelectorAll('.twelveAY');
    if (radio.value === 'YES') {
      fromAYFields.forEach(function(field) {
        field.style.display = 'block';
      });
    } else {
      fromAYFields.forEach(function(field) {
        field.style.display = 'none';
      });
    }
}
function handleFcraVisibility(radio) {
    var fromAYFields = document.querySelectorAll('.fcra_visible');
    if (radio.value === 'YES') {
      fromAYFields.forEach(function(field) {
        field.style.display = 'block';
      });
    } else {
      fromAYFields.forEach(function(field) {
        field.style.display = 'none';
      });
    }
}
function handleNgoDarpanVisibility(radio) {
    var fromAYFields = document.querySelectorAll('.ngodarpanVisible');
    if (radio.value === 'YES') {
      fromAYFields.forEach(function(field) {
        field.style.display = 'block';
      });
    } else {
      fromAYFields.forEach(function(field) {
        field.style.display = 'none';
      });
    }
}
function handleGSTVisibility(radio) {
    var fromAYFields = document.querySelectorAll('.gst_visible');
    if (radio.value === 'YES') {
      fromAYFields.forEach(function(field) {
        field.style.display = 'block';
      });
    } else {
      fromAYFields.forEach(function(field) {
        field.style.display = 'none';
      });
    }
}
function handleAdditional_1_Visibility(checkbox) {
    var validTillElement = document.querySelector('.validtill_additional_1');
  
    if (checkbox.checked) {
      validTillElement.style.display = 'none';
    } else {
      validTillElement.style.display = 'block';
    }
  }
  function handleAdditional_2_Visibility(checkbox) {
    var validTillElement = document.querySelector('.validtill_additional_2');
  
    if (checkbox.checked) {
      validTillElement.style.display = 'none';
    } else {
      validTillElement.style.display = 'block';
    }
  }
  function handleAdditional_3_Visibility(checkbox) {
    var validTillElement = document.querySelector('.validtill_additional_3');
  
    if (checkbox.checked) {
      validTillElement.style.display = 'none';
    } else {
      validTillElement.style.display = 'block';
    }
  }
  $.validator.addMethod("filesize", function(value, element, param) {
    if (typeof File !== "undefined") {
      var file = element.files[0];
      if(file){
        return file.size <= param;
      }
    }
    return true;
  });
  function countChar(ele) {
    var len = ele.value.length;
    var pointer = $(ele).data('pointer');
    var maximum = $(ele).data('maximum');
    if (len >= maximum) {
        ele.value = ele.value.substring(0, maximum);
    }
    $(ele).parent().find('.'+pointer).text(len+'/'+maximum+' characters');
  };
$(document).on('change', '.file-upload-preview', function (e) {
    if(this.files.length>0){
              $(this).parent().find('.preview').attr('href',URL.createObjectURL(this.files[0]));
              $(this).parent().find('.preview').show();
      }else{
            $(this).parent().find('.preview').hide();
            $(this).val('');
    }
  });
  $(document).on('change', '.file-upload-preview-img', function (e) {
    if(this.files.length>0){
              $(this).parent().find('.preview-img').attr('src',URL.createObjectURL(this.files[0]));
              $(this).parent().find('.preview-img').show();
      }else{
            $(this).parent().find('.preview-img').hide();
            $(this).val('');
    }
  });