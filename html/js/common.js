$(document).ready(function() {
	$('#countdown').hide();
	start_countdown();
    // setTimeout(function(){
        checkCookie();
    // }, 1000);

    $('.close-cookie').click(function () {
        cookie_pop_up = 'cookie_pop_up';
        setCookie("cookie_pop_up", cookie_pop_up, 365);
        closeCookiePop();
    });
    
	$.validator.addMethod('mypassword', function(value, element) {
        return this.optional(element) || (value.match(/[a-zA-Z]/) && value.match(/[0-9]/) && value.match(/[!@#$%^&*():;?_~+=]/));
    },
    'Password must contain at least one alphabetic, one numeric and one special character.');

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
    
    $('.validate-char').on('keypress', function(key) {
        //alert(111111)
		if((key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45 && key.charCode != 32 && key.charCode != 0)) {
			return false;	
		}
	});

    $("#signup-user").validate({
        ignore: ':hidden:not("#hiddenRecaptcha")',
        //ignore: ".ignore",
        rules: {
            inputFname: {
                required: true,
            },
            inputLname: {
                required: true,
            },
            inputEmail: {
                required: true,
                email: true
            },
            inputMobile: {
                required: true,
                digits: true,
                minlength: 10,
                minlength: 10

            },
            inputPassword: {
                required: true,
                minlength: 8,
				mypassword: true
            },
            inputConfPassword: {
                equalTo: "#inputPassword"
            },
            hiddenRecaptcha: {
                required: function() {
                    if (grecaptcha.getResponse() == '') {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        },
        messages: {
            inputMobile: { "minlength": "Please enter 10 digit number." },
            inputPassword: { "minlength": "Please enter 8 or more characters." },
            confirmpassword: "Confirm Password does not match."
        },
        submitHandler: function(form) {

            var phone_no = $("#inputMobile").val();

            $.ajax({
                url: form.action,
                type: 'ajax',
                method: form.method,
                dataType: 'json',
                data: $(form).serialize(),
                success: function(response) {

                    if (response.flag == 1) {

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
                        setTimeout(function() {

                        }, 1000);

                    } else {
						grecaptcha.reset();
                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'error'
                        })
                        setTimeout(function() {}, 1000);
                    }
                }
            });
        }
    });


    $("#send_message").validate({
        ignore: ":hidden",        
        rules: {
            inputFullName: {
                required: true,
            },
            inputEmail: {
                required: true,
                email: true
            },
            inputOrganization: {
                required: true,
            },
            inputContactNumber: {
                required: true,
                digits: true,
                minlength: 8

            },
            inputMessage: {
                required: true,
            },

        },
        messages: {
            inputContactNumber: { "minlength": "Please enter 8 digit number." },
        },
        submitHandler: function(form) {

            // var phone_no = $("#inputMobile").val();
            $.ajax({
                url: form.action,
                type: 'ajax',
                method: form.method,
                dataType: 'json',
                data: $(form).serialize(),
                success: function(response) {
                    //let obj = JSON.parse(response);                   
                    if (response.status == 200) {
                        $.toast({
                            heading: '',
                            text: 'Thank you for contacting US!',
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        setTimeout(function() {
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

    $("#login-user").validate({
        ignore: ':hidden:not("#hiddenRecaptcha")',		
        //ignore: ".ignore",
        rules: {
            inputMobile: {
                required: true,
                digits: true,
                minlength: 10,
                minlength: 10

            },
            inputPassword: {
                required: true,
                minlength: 8,
				mypassword: true
            },
            hiddenRecaptcha: {
                required: function() {
                    if (grecaptcha.getResponse() == '') {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        },
        messages: {
            inputMobile: { "minlength": "Please enter 10 digit number." },
            inputPassword: { "minlength": "Please enter 8 or more characters." }
        },
        submitHandler: function(form) {

            $.ajax({
                url: form.action,
                type: 'ajax',
                method: form.method,
                dataType: 'json',
                data: $(form).serialize(),
                success: function(response) {
                    console.log(response);
                    if (response.flag == 1) {

                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        setTimeout(function() {
                            window.location.href = response.redirect;

                        }, 1000);

                    } else {
						grecaptcha.reset();
                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'error'
                        })
                        setTimeout(function() {}, 1000);
                    }
                }
            });
        }
    });


    $("#verify-otp").validate({
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
        /*submitHandler: function(e) {

			e.preventDefault();
			return;
			
            var otpNumber = $("#otpNumber").val();
            var phone = $("#otp-phone").val();
            var inputFname = $("#inputFname").val();
            var inputLname = $("#inputLname").val();
            var inputEmail = $("#inputEmail").val();
            var inputMobile = $("#inputMobile").val();
            var inputPassword = $("#inputPassword").val();


            $.ajax({
                url: form.action,
                type: 'ajax',
                method: form.method,
                dataType: 'json',
                data: { otpNumber: otpNumber, phone: phone, inputFname: inputFname, inputLname: inputLname, inputEmail: inputEmail, inputMobile: inputMobile, inputPassword: inputPassword },

                success: function(response) {

                    if (response.flag == 1) {

                        $("#signup-user")[0].reset();
                        $("#verify-otp")[0].reset();

                        $('#login_form').hide();
                        $('#otp_form').hide();
                        $("#success-otp").show();


                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                      

                    } else {
                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'error'
                        })
                        
                    }
                }
            });
        }*/
    });


	$('#verify-otp').submit(function (e) {

    e.preventDefault();

    var otpNumber = $("#otpNumber").val();
    var phone = $("#otp-phone").val();
	 var inputFname = $("#inputFname").val();
	var inputLname = $("#inputLname").val();
	var inputEmail = $("#inputEmail").val();
	var inputMobile = $("#inputMobile").val();
	var inputPassword = $("#inputPassword").val();
	
	 $.ajax({
                url: BASE_URL+"signup/verifyOtp",
                type: 'ajax',
                method: "POST",
                dataType: 'json',
                data: { otpNumber: otpNumber, phone: phone, inputFname: inputFname, inputLname: inputLname, inputEmail: inputEmail, inputMobile: inputMobile, inputPassword: inputPassword },

                success: function(response) {

                    if (response.flag == 1) {

                        $("#signup-user")[0].reset();
                        $("#verify-otp")[0].reset();

                        $('#login_form').hide();
                        $('#otp_form').hide();
                        $("#success-otp").show();


                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                      

                    } else {
                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'error'
                        })
                        
                    }
                }
            });
    
  });


    $(document).on('click', '.toggle-password', function() {

        $(this).toggleClass("fa-eye fa-eye-slash");

        var input = $("#inputPassword");
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
    });

    $(document).on('click', '.toggle-Confpassword', function() {

        $(this).toggleClass("fa-eye fa-eye-slash");

        var input = $("#inputConfPassword");
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
    });

    $(document).on('click', '.toggle-Newpassword', function() {

        $(this).toggleClass("fa-eye fa-eye-slash");

        var input = $("#inputNewPassword");
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
    });

    $(document).on('click', '.toggle-Repassword', function() {

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
        submitHandler: function(form) {
            var phone_no = $("#inputMobile").val();

            $.ajax({
                url: form.action,
                type: 'ajax',
                method: form.method,
                dataType: 'json',
                data: $(form).serialize(),
                success: function(response) {
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
                        setTimeout(function() {
                            //window.location.href = response.redirect;

                        }, 1000);

                    } else {
                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'error'
                        })
                        setTimeout(function() {}, 1000);
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
        submitHandler: function(form) {

            var otpNumber = $("#otpNumber").val();
            var phone = $("#otp-phone").val();

            $.ajax({
                url: form.action,
                type: 'ajax',
                method: form.method,
                dataType: 'json',
                data: { otpNumber: otpNumber, phone: phone },

                success: function(response) {

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
                        setTimeout(function() {

                        }, 1000);

                    } else {
                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'error'
                        })
                        setTimeout(function() {}, 1000);
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
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: 'ajax',
                method: form.method,
                dataType: 'json',
                data: $(form).serialize(),
                success: function(response) {
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
                        setTimeout(function() {}, 1000);

                    } else {
                        $.toast({
                            heading: '',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'error'
                        })
                        setTimeout(function() {}, 1000);
                    }
                }
            });
        }
    });
    
    $(document).on('click', '.globalmsg_closebtn', function() {
        $(this).parent().hide();
    });
    
    $("#gallery-carousel").owlCarousel({
     
        //autoPlay: 3000, //Set AutoPlay to 3 seconds
        navigation : true,
        margin : 50,
        loop : true,
        dots : false,
        items : 2,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3]
     
    });

});

function resendOtp() {

    var phone = $("#otp-phone").val();

    $.ajax({
        url: BASE_URL + "signup/resendOtp",
        type: 'ajax',
        method: 'POST',
        dataType: 'json',
        data: { phone: phone },
        success: function(response) {

            if (response.flag == 1) {

                $.toast({
                    heading: '',
                    text: response.msg,
                    showHideTransition: 'slide',
                    icon: 'success'
                })
                setTimeout(function() {


                }, 1000);

            } else {
                $.toast({
                    heading: '',
                    text: response.msg,
                    showHideTransition: 'slide',
                    icon: 'error'
                })
                setTimeout(function() {}, 1000);
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
        success: function(response) {

            if (response.flag == 1) {

                $.toast({
                    heading: '',
                    text: response.msg,
                    showHideTransition: 'slide',
                    icon: 'success'
                })
                setTimeout(function() {


                }, 1000);

            } else {
                $.toast({
                    heading: '',
                    text: response.msg,
                    showHideTransition: 'slide',
                    icon: 'error'
                })
                setTimeout(function() {}, 1000);
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
        
        if ( /\.(jpe?g|png|pdf)$/i.test(file.name) ) {
            var reader = new FileReader();
            var pdfImage = BASE_URL+'skin/images/pdf-icon.png';

            reader.onload = function(e) {
                if(extension == 'pdf'){
                    $('#upload_img').attr('src', pdfImage);
                }else{
                    $('#upload_img').attr('src', e.target.result);
                }
            }

            reader.readAsDataURL(input.files[0]);
        }else{
            $.toast({
			heading: '',
			text: "Please select valid file type. The supported file types are .jpg , .png , .pdf",
			showHideTransition: 'slide',
			icon: 'error'
		  })
		   setTimeout(function() {}, 1000);
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

//Verification popup - Select Ngo / Corporate action
function updateOrgType() {
    var org_type = $("input[name='org_type']:checked").val()
    if (org_type == '') {
        alert('error');
    } else {
        $.ajax({
            url: BASE_URL + "discover/updateOrgType",
            type: 'ajax',
            method: 'POST',
            dataType: 'json',
            data: { org_type: org_type },
            success: function(response) {

                if (response.flag == 1) {

                    $.toast({
                        heading: '',
                        text: response.msg,
                        showHideTransition: 'slide',
                        icon: 'success'
                    })
                    setTimeout(function() {
                        window.location.href = response.redirect;
                    }, 1000);

                } else {
                    $.toast({
                        heading: '',
                        text: response.msg,
                        showHideTransition: 'slide',
                        icon: 'error'
                    })
                    setTimeout(function() {}, 1000);
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
		$("#"+input.id).parent('.reciept-upload').hide();
		var file = input.files[0];
		var extension = file.name.split('.').pop().toLowerCase();
        
        console.log(file);
		console.log(extension);
		if ( /\.(jpe?g|png|pdf)$/i.test(file.name) ) {
			var reader = new FileReader();
			var pdfImage = BASE_URL+'skin/images/pdf-icon.png';
			
			reader.onload = function(e) {
				//$('#upload_img_' + input.id).attr('src', e.target.result);
				if(extension == 'pdf'){
					$("#upload_img_" + input.id).html("<span class=\"upload-file\">" + "<img class=\"imageThumb\" src=\"" + pdfImage + "\" width=\"100\" hieght=\"100\" title=\"" + file.name + "\"/>" + "<br/><span class=\"file-name\">" + file.name + "</span><span class=\"remove\">X</span>" + "</span>");
				}else{
					$("#upload_img_" + input.id).html("<span class=\"upload-file\">" + "<img class=\"imageThumb\" src=\"" + e.target.result + "\" width=\"100\" hieght=\"100\" title=\"" + file.name + "\"/>" + "<br/><span class=\"file-name\">" + file.name + "</span><span class=\"remove\">X</span>" + "</span>");
				}
				
				 $('#upload_img_' + input.id + " .remove").click(function(){
					// alert(input.id);
					// alert(111111111)
					$(this).parent(".upload-file").remove();
					$("#" + input.id).val('');
					$("#" + input.id).parent('.reciept-upload').show();
				  });
			}

			reader.readAsDataURL(input.files[0]);
		}else{
			$.toast({
			heading: '',
			text: "Please select valid file type. The supported file types are .jpg, .png, .pdf",
			showHideTransition: 'slide',
			icon: 'error'
		  })
		   setTimeout(function() {}, 1000);
		}
    }
}

function removeReciept(inputId){
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
		var pdfImage = BASE_URL+'skin/images/pdf-icon.png';
		
        reader.onload = function(e) {
			if(extension == 'pdf'){
				$("#uploadCoverImage").html("<span class=\"upload-file\">" + "<img class=\"imageThumb\" src=\"" + pdfImage + "\" width=\"100\" hieght=\"100\" title=\"" + file.name + "\"/>" + "<br/><span class=\"file-name\">" + file.name + "</span><span class=\"remove\">X</span>" + "</span>");
			}else{
				$("#uploadCoverImage").html("<span class=\"upload-file\">" + "<img class=\"imageThumb\" src=\"" + e.target.result + "\" width=\"100\" hieght=\"100\" title=\"" + file.name + "\"/>" + "<br/><span class=\"file-name\">" + file.name + "</span><span class=\"remove\">X</span>" + "</span>");
			}
          
          $(".remove").click(function(){
            $(this).parent(".upload-file").remove();
			$("#coverImage").val('');
			$(".cover-upload").show('');
          });
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function removeCoverImage(){
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
		
		if ( /\.(pdf)$/i.test(file.name) ) {
            var reader = new FileReader();
            var pdfImage = BASE_URL+'skin/images/pdf-icon.png';
          
			reader.onload = function(e) {
				if(extension == 'pdf'){
					$("#contract_upload_name").html("<span class=\"upload-contract-file\">" + "<span class=\"file-name\">" + file.name + "</span><span class=\"remove-contract\">X</span>" + "</span>");
				}else{
					$("#contract_upload_name").html("<span class=\"upload-contract-file\">" + "<span class=\"file-name\">" + file.name + "</span><span class=\"remove-contract\">X</span>" + "</span>");
				}
			  
				$(".remove-contract").click(function(){
					$(this).parent(".upload-contract-file").remove();
					$("#contract_upload").val('');
				});
			}

            reader.readAsDataURL(input.files[0]);
        }else{
            $.toast({
			heading: '',
			text: "Please select valid file type. The supported file type is .pdf",
			showHideTransition: 'slide',
			icon: 'error'
		  })
		   setTimeout(function() {}, 1000);
        }
    }
}

function readBoardURL(input) {
	
    if (input.files && input.files[0]) {
		var file = input.files[0];
		var extension = file.name.split('.').pop().toLowerCase();
        
        console.log(file);
		console.log(extension);
		
		if ( /\.(jpe?g|png|pdf)$/i.test(file.name) ) {
            var reader = new FileReader();
            var pdfImage = BASE_URL+'skin/images/pdf-icon.png';
          
			reader.onload = function(e) {
				if(extension == 'pdf'){
					$("#board_upload_name").html("<span class=\"upload-board-file\">" + "<span class=\"file-name\">" + file.name + "</span><span class=\"remove-board\">X</span>" + "</span>");
				}else{
					$("#board_upload_name").html("<span class=\"upload-board-file\">" + "<span class=\"file-name\">" + file.name + "</span><span class=\"remove-board\">X</span>" + "</span>");
				}
			  
				$(".remove-board").click(function(){
					$(this).parent(".upload-board-file").remove();
					$("#board_upload").val('');
				});
			}

            reader.readAsDataURL(input.files[0]);
        }else{
            $.toast({
			heading: '',
			text: "Please select valid file type. The supported file types are .jpg , .png , .pdf",
			showHideTransition: 'slide',
			icon: 'error'
		  })
		   setTimeout(function() {}, 1000);
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

function start_countdown()
{
 //var counter=60*60;
 myVar= setInterval(function()
 { 
   $.ajax
   ({
     type:'get',
     url:BASE_URL+'user/checkSession',
     data:{
      //logout:"logout"
     },
     success:function(response) 
     {
	  if(response == "logout"){
		window.location = BASE_URL+'logout';  
	  }else{
		  if(response != ""){
			$('#countdown').show();
			//$('#countdown').html(response);
			$('#countdown').html('<a data-toggle="tooltip" title="Your session will expire in!">' + response +'</a>');
	  }else{
			$('#countdown').hide();
			$('#countdown').html('');
	  }
	  }
     }
   });
   //counter--;
 }, 1000)
}