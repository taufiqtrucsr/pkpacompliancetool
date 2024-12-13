$(document).ready(function () {
  $("#profile-info").validate({
    //ignore: ":hidden",
    ignore: ".ignore",
    rules: {
      inputFname: {
        required: true,
      },
      inputLname: {
        required: true,
      },
      inputEmail: {
        required: true,
        email: true,
      },
      inputMobile: {
        required: true,
        digits: true,
        minlength: 10,
        minlength: 10,
      },
      inputPassword: {
        required: true,
        minlength: 8,
        mypassword: true,
      },

      /* hiddenRecaptcha: {
                required: function() {
                    if (grecaptcha.getResponse() == '') {
                        return true;
                    } else {
                        return false;
                    }
                }
            }*/
    },
    messages: {
      inputMobile: { minlength: "Please enter 10 digit number." },
      inputPassword: { minlength: "Please enter 8 or more characters." },
    },
    submitHandler: function (form) {
      var phone = $("#otp-phone").val();

      $.ajax({
        url: form.action,
        type: "ajax",
        method: form.method,
        dataType: "json",
        data: $(form).serialize(),
        success: function (response) {
          console.log(response);
          if (response.flag == 1) {
            $.toast({
              heading: "",
              text: response.msg,
              showHideTransition: "slide",
              icon: "success",
            });
            setTimeout(function () {
              window.location.href = response.redirect;
            }, 1000);
          } else {
            $.toast({
              heading: "",
              text: response.msg,
              showHideTransition: "slide",
              icon: "error",
            });
            setTimeout(function () {}, 1000);
          }
        },
      });
    },
  });

  $("#verifymobile-profile").validate({
    ignore: ":hidden",
    rules: {
      inputMobile: {
        required: true,
        digits: true,
        minlength: 10,
        minlength: 10,
      },
    },
    messages: {
      inputMobile: { minlength: "Please enter 10  digit number." },
    },
    submitHandler: function (form) {
      var phone_no = $("#inputMobile").val();

      $.ajax({
        url: form.action,
        type: "ajax",
        method: form.method,
        dataType: "json",
        data: $(form).serialize(),
        success: function (response) {
          //console.log(response);
          if (response.flag == 1) {
            $("#verifymobileprofile_form").hide();
            $("#otp_form").show();
            $("#phn-label").html(phone_no);
            $("#otp-phone").val(phone_no);
            $("#password-phone").val(phone_no);

            $.toast({
              heading: "",
              text: response.msg,
              showHideTransition: "slide",
              icon: "success",
            });
            setTimeout(function () {
              //window.location.href = response.redirect;
            }, 1000);
          } else {
            $.toast({
              heading: "",
              text: response.msg,
              showHideTransition: "slide",
              icon: "error",
            });
            setTimeout(function () {}, 1000);
          }
        },
      });
    },
  });

  $("#changepwd-otp").validate({
    ignore: ":hidden",
    rules: {
      otpNumber: {
        required: true,
        digits: true,
        minlength: 4,
        maxlength: 4,
      },
    },
    messages: {
      otpNumber: {
        minlength: "Please enter 4 digit pin.",
        maxlength: "Please enter 4 digit pin.",
      },
    },
    tooltip_options: {
      otpNumber: { placement: "right", html: true },
    },
    submitHandler: function (form) {
      var otpNumber = $("#otpNumber").val();
      var phone = $("#otp-phone").val();

      $.ajax({
        url: form.action,
        type: "ajax",
        method: form.method,
        dataType: "json",
        data: { otpNumber: otpNumber, phone: phone },

        success: function (response) {
          if (response.flag == 1) {
            $("#verifymobile-profile")[0].reset();
            $("#changepwd-otp")[0].reset();

            $("#verifymobileprofile_form").hide();
            $("#otp_form").hide();
            $("#changepassword_form").show();
            //$("#success-otp").show();

            $.toast({
              heading: "",
              text: response.msg,
              showHideTransition: "slide",
              icon: "success",
            });
            setTimeout(function () {}, 1000);
          } else {
            $.toast({
              heading: "",
              text: response.msg,
              showHideTransition: "slide",
              icon: "error",
            });
            setTimeout(function () {}, 1000);
          }
        },
      });
    },
  });

  $("#setpassword-profile").validate({
    ignore: ":hidden",
    rules: {
      inputNewPassword: {
        required: true,
        minlength: 8,
        mypassword: true,
      },
      inputRePassword: {
        equalTo: "#inputNewPassword",
      },
    },
    messages: {
      inputPassword: { minlength: "Please enter 8 or more characters." },
      confirmpassword: "Confirm Password does not match.",
    },
    submitHandler: function (form) {
      $.ajax({
        url: form.action,
        type: "ajax",
        method: form.method,
        dataType: "json",
        data: $(form).serialize(),
        success: function (response) {
          //console.log(response);
          if (response.flag == 1) {
            $("#verifymobileprofile_form").hide();
            $("#otp_form").hide();
            $("#changepassword_form").hide();
            $("#success-changepassword").show();

            $.toast({
              heading: "",
              text: response.msg,
              showHideTransition: "slide",
              icon: "success",
            });
            setTimeout(function () {}, 1000);
          } else {
            $.toast({
              heading: "",
              text: response.msg,
              showHideTransition: "slide",
              icon: "error",
            });
            setTimeout(function () {}, 1000);
          }
        },
      });
    },
  });

  $("#verifychangemobile-profile").validate({
    ignore: ":hidden",
    rules: {
      inputMobile: {
        required: true,
        digits: true,
        minlength: 10,
        minlength: 10,
      },
      inputNewMobile: {
        required: true,
        digits: true,
        minlength: 10,
        minlength: 10,
      },
      inputPassword: {
        required: true,
        minlength: 8,
        mypassword: true,
      },
    },
    messages: {
      inputMobile: { minlength: "Please enter 10 digit number." },
      inputNewMobile: { minlength: "Please enter 10 digit number." },
      inputPassword: { minlength: "Please enter 8 or more characters." },
    },
    submitHandler: function (form) {
      var phone_no = $("#inputNewMobile").val();

      $.ajax({
        url: form.action,
        type: "ajax",
        method: form.method,
        dataType: "json",
        data: $(form).serialize(),
        success: function (response) {
          //console.log(response);
          if (response.flag == 1) {
            $("#verifychangemobile_form").hide();
            $("#otp_form").show();
            $("#phn-label").html(phone_no);
            $("#otp-phone").val(phone_no);

            $.toast({
              heading: "",
              text: response.msg,
              showHideTransition: "slide",
              icon: "success",
            });
            setTimeout(function () {
              //window.location.href = response.redirect;
            }, 1000);
          } else {
            $.toast({
              heading: "",
              text: response.msg,
              showHideTransition: "slide",
              icon: "error",
            });
            setTimeout(function () {}, 1000);
          }
        },
      });
    },
  });

  $("#changemobile-otp").validate({
    ignore: ":hidden",
    rules: {
      otpNumber: {
        required: true,
        digits: true,
        minlength: 4,
        maxlength: 4,
      },
    },
    messages: {
      otpNumber: {
        minlength: "Please enter 4 digit pin.",
        maxlength: "Please enter 4 digit pin.",
      },
    },
    tooltip_options: {
      otpNumber: { placement: "right", html: true },
    },
    submitHandler: function (form) {
      var otpNumber = $("#otpNumber").val();
      var phone = $("#otp-phone").val();

      $.ajax({
        url: form.action,
        type: "ajax",
        method: form.method,
        dataType: "json",
        data: { otpNumber: otpNumber, phone: phone },

        success: function (response) {
          if (response.flag == 1) {
            $("#verifychangemobile-profile")[0].reset();
            $("#changemobile-otp")[0].reset();

            $("#verifychangemobile_form").hide();
            $("#otp_form").hide();
            //$('#changepassword_form').show();
            $("#success-changemobile").show();

            $.toast({
              heading: "",
              text: response.msg,
              showHideTransition: "slide",
              icon: "success",
            });
            setTimeout(function () {}, 1000);
          } else {
            $.toast({
              heading: "",
              text: response.msg,
              showHideTransition: "slide",
              icon: "error",
            });
            setTimeout(function () {}, 1000);
          }
        },
      });
    },
  });

  //Start Line New User Creation
  $("#storeUser").validate({
    ignore: ":hidden",
    rules: {
      email: {
        required: true,
      },
      phone: {
        minlength: 10,
        maxlength: 10,
        required: true,
      },
      name: {
        required: true,
      },
      password: {
        required: true,
        minlength: 5,
      },
    },
    messages: {
      email: "Please enter valid email address.",
      phone: "Please enter valid phone number.",
    },
    submitHandler: function (form) {
      $.ajax({
        url: form.action,
        type: "ajax",
        method: form.method,
        dataType: "json",
        data: $(form).serialize(),
        success: function (response) {
          if (response.flag == 1) {
            $.toast({
              heading: "",
              text: response.msg,
              showHideTransition: "slide",
              icon: "success",
            });
          } else {
            $.toast({
              heading: "",
              text: response.msg,
              showHideTransition: "slide",
              icon: "error",
            });
          }
        },
      });
    },
  });
  //End Line New User Creation
});

function changepwdresendOtp() {
  var phone = $("#otp-phone").val();

  $.ajax({
    url: BASE_URL + "myprofile/resendOtp",
    type: "ajax",
    method: "POST",
    dataType: "json",
    data: { phone: phone },
    success: function (response) {
      if (response.flag == 1) {
        $.toast({
          heading: "",
          text: response.msg,
          showHideTransition: "slide",
          icon: "success",
        });
        setTimeout(function () {}, 1000);
      } else {
        $.toast({
          heading: "",
          text: response.msg,
          showHideTransition: "slide",
          icon: "error",
        });
        setTimeout(function () {}, 1000);
      }
    },
  });
}

function changemobileresendOtp() {
  var phone = $("#otp-phone").val();

  $.ajax({
    url: BASE_URL + "myprofile/mobileresendOtp",
    type: "ajax",
    method: "POST",
    dataType: "json",
    data: { phone: phone },
    success: function (response) {
      if (response.flag == 1) {
        $.toast({
          heading: "",
          text: response.msg,
          showHideTransition: "slide",
          icon: "success",
        });
        setTimeout(function () {}, 1000);
      } else {
        $.toast({
          heading: "",
          text: response.msg,
          showHideTransition: "slide",
          icon: "error",
        });
        setTimeout(function () {}, 1000);
      }
    },
  });
}
$(document).on("click", ".editBasicDetailsK", function () {
  let EditHTML = $(".editBasictHTML").html();
  $(".editSectionUrl").html(EditHTML);
});

$(document).on("click", ".uploadDocumentTabClick", function () {
  let EditHTML = $(".editDocumentHTML").html();
  $(".editSectionUrl").html(EditHTML);
});
$(document).on("click", ".uploadFinancialTabClick", function () {
  let EditHTML = $(".editFinancialReport").html();
  $(".editSectionUrl").html(EditHTML);
});

$(document).on("click", ".uploadBoardTabClick", function () {
  let EditHTML = $(".editBoardtHTML").html();
  $(".editSectionUrl").html(EditHTML);
});
$(document).on("click", ".uploadImplementationexp", function () {
  let EditHTML = $(".editImplementationexp").html();
  $(".editSectionUrl").html(EditHTML);
});

$(document).ready(function () {
  $(".custom-tab-container .custom-tab-link").on("click", function (e) {
    e.preventDefault();

    // Remove active class from all tabs and content
    $(".custom-tab-container .custom-tab-link").removeClass("active");
    $(".custom-tab-container .custom-tab-pane").removeClass("active");

    // Add active class to the clicked tab and corresponding content
    $(this).addClass("active");
    var target = $(this).attr("href");
    $(target).addClass("active");
  });
});

$(document).ready(function () {
  $("#toggle-checkbox").change(function () {
    if (this.checked) {
    } else {
    }
  });
  $("#toggle-checkbox_one").change(function () {
    if (this.checked) {
    }
  });
  $("#toggle-checkbox_two").change(function () {
    if (this.checked) {
    }
  });
  $("#toggle-checkbox_three").change(function () {
    if (this.checked) {
    }
  });
  $("._add-user-roles").click(function () {
    $(".listuser").hide();
    $("._addInfo").show();
    $(".fullwidthSubmitAddRoles").show();
  });
  $(".cancelBtnAddRoles").click(function () {
    $(".listuser").show();
    $("._addInfo").hide();
    $(".fullwidthSubmitAddRoles").hide();
  });

  //   Transaction history - CSR Facilitation
  $('input[name="dat_range"]').daterangepicker({
    autoUpdateInput: false,
    locale: {
      cancelLabel: "Clear",
    },
  });

  $('input[name="dat_range"]').on(
    "apply.daterangepicker",
    function (ev, picker) {
      $(this).val(
        picker.startDate.format("MM/DD/YYYY") +
          " - " +
          picker.endDate.format("MM/DD/YYYY")
      );
    }
  );

  $('input[name="dat_range"]').on(
    "cancel.daterangepicker",
    function (ev, picker) {
      $(this).val("");
    }
  );
  $('#filter_proj').change(function () {
    if($(this).val() == "") $(this).addClass("empty");
    else $(this).removeClass("empty")
  });
  $("#filter_proj").change();

  // edit finantial report
  $('#ngo-step-1 form input[type="date"]').datetimepicker();
});
