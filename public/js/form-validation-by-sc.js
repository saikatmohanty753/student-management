/**
 * JQuery Form Validation
 *
 *
 *
 */

/* classes to use for validation checking */

/*
 .chk_blank : for blank field validation
 .chk_email : for email field validation
 .chk_phone : for phone number field validation
 .chk_alphanumeric  :  for alphanumeric only field validation [a-z] [1-9]
 .chk_alphanumeric_with_dash  :  for alphanumeric values with dash only field validation  [a-z] [1-9] [-]
 .chk_aadhaar : for aadhaar number
 */

$.fn.scvalidateform = function(options) {
    // debugger;

    var settings = $.extend({
        formId: 'add_data', // id of the form for validation
        errorClass: 'val-error',
        containerClass: 'input-cont', // class of the input field container
        errorMsgClass: 'error-msg', // class of error message container
        blankValidationMsg: 'Please fill this field.', // error message on blank field validation
        emailValidationMsg: 'Please enter a valid email address.', // error message on email validation
        phoneValidationMsg: 'Please enter a valid phone number.', // error phone number validation
        alphanumericValidationMsg: 'Please enter alphanumeric values only.', // error alphanumeric validation
        alphanumericWithDashValidationMsg: 'Please enter the following values only. (a-z) (1-9) (-)', // error file type alphanumeric with hash
        doctypeValidationMsg: 'Please check file type.', // error document type
        imagetypeValidationMsg: 'Please check file type.', // error image type
        urlValidationMsg: 'Please check the URL.',
        characterLength200ValidationMsg: 'Maximum 250 characters allowed.', // error character length
        docsizeValidationMsg: 'Maximum 500kb file size allowed.',
        chkdoctypeValidationMsg: ".jpg, .png, .jpeg, .pdf file allowed",
        pdfsizeValidationMsg: 'Maximum 5MB file size allowed.',
        chkpdfdocValidationMsg: "Only pdf file allowed",
        docsizetypeValidationMsg: 'Please check file type and size.',
        characterLeng150thValidationMsg: 'Maximum 150 characters allowed.', // error character length,
        passwordValidationMsg: 'Enter a valid password.',
        mobileValidationMsg: 'Please enter 10 digit mobile number.',
        digitValidationMsg: 'Please enter a valid digit.',
        blankfileValidationMsg: 'Please upload a file.',
        zipValidationMsg: 'Please enter a valid zip number.',
        ifscValidationMsg: 'Please enter a valid IFSC number.',
        alphabetValidationMsg: 'Only characters are allowed.',
        aadhaarnoValidationMsg: 'Please enter a valid aadhaar number.',
    }, options);

    /* define an array */
    var validation = [];
    $('.error-msg').css('color', '#fd3995');
    var chosenval = $('.chosen_select').val();

    /* blank file field validation starts */
    /* check if no_file class found inside the form */
    if ($('.chk_blank_file').length) {

        /* check the value of all inputs elements with no_file class and return false if input field is blank else return true */
        /* then insert the return value in an array */
        $('#' + settings.formId).find('.chk_blank_file').each(function() {

            /* go through all inputs having class .no_file and show error if input value is blank */
            if ($.trim($(this).val()) === '') {
                validation.push('false');
                $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.blankfileValidationMsg);
            } else {
                validation.push('true');
                if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                    $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                } else {
                    /* do nothing */
                }

            }
        });
    };
    /* blank file validation ends */

    /* blank field validation starts */
    /* check if no_blank class found inside the form */
    if ($('.chk_blank').length) {
        /* check the value of all inputs elements with no_blank class and return false if input field is blank else return true */
        /* then insert the return value in an array */
        $('#' + settings.formId).find('.chk_blank').each(function() {

            /* go through all inputs having class .no_blank and show error if input value is blank */
            if ($.trim($(this).val()) === '') {
                validation.push('false');
                $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.blankValidationMsg);
            } else {
                validation.push('true');
                if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                    $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                    $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(' ');
                } else {
                    /* do nothing */
                }
            }
        });
    };
    /* blank field validation ends */

    /* check doc size end */
    if ($('.chk_doc_size').length) {

        /* check the value of all inputs elements with chk_img_size class and return false if input field is blank else return true */
        /* then insert the return value in an array */
        $('#' + settings.formId).find('.chk_doc_size').each(function() {

            // calculate image size
            var imgsize = $(this)[0].files[0].size / 1024;
            var imgsize = (Math.round((imgsize / 1024) * 100) / 100);
            // var ext = $(this).val().split('.').pop().toLowerCase();

            // console.log('img size-' + imgsize);
            if ($.trim($(this).val()) !== '') {
                if (imgsize > 5) {
                    validation.push('false');
                    $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                    $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.docsizeValidationMsg);
                } else {
                    validation.push('true');
                    if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                        $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                    } else {
                        /* do nothing */
                    }
                }
            } else {
                /* do nothing */
            }


        });
    };

    /* check image size end */


    /* email validation starts */
    if ($('.chk_email').length) {

        var email_pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;

        $('#' + settings.formId).find('.chk_email').each(function() {
            if (!email_pattern.test($.trim($(this).val()))) {
                validation.push('false');
                $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.emailValidationMsg);
            } else {
                validation.push('true');
                if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                    $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                } else {
                    /* do nothing */
                }
            }
        });
    };




    /* email validation ends */



    /* phone number validation starts */

    if ($('.chk_phone').length) {
        var phone_number_pattern = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
        $('#' + settings.formId).find('.chk_phone').each(function() {
            if (!phone_number_pattern.test($.trim($(this).val()))) {
                validation.push('false');
                $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.phoneValidationMsg);
            } else {
                validation.push('true');
                if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                    $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                } else {
                    /* do nothing */
                }
            }
        });
    };



    /* phone number validation ends */



    /* zip validation starts */

    if ($('.chk_zip').length) {
        var zip_number_pattern = /^[1-9][0-9]{5}$/;
        $('#' + settings.formId).find('.chk_zip').each(function() {
            if (!zip_number_pattern.test($.trim($(this).val()))) {
                validation.push('false');
                $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.zipValidationMsg);
            } else {
                validation.push('true');
                if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                    $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                    $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html('');
                } else {
                    /* do nothing */
                }
            }
        });
    };
    /* zip validation ends */


    /* alpha numeric validation starts */



    if ($('.chk_alphanumeric').length) {


        // regular expression for alphanumeric pattern
        var alphanumeric_pattern = /^[a-zA-Z0-9]+$/;
        // var alphanumeric_pattern =/^[A-Za-z][0-9]/;

        $('#' + settings.formId).find('.chk_alphanumeric').each(function() {
            if (!alphanumeric_pattern.test($.trim($(this).val()))) {
                validation.push('false');
                $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.alphanumericValidationMsg);
            } else {
                validation.push('true');
                if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                    $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                } else {
                    /* do nothing */
                }
            }
        });
    };



    /* alpha numeric validation ends */


    /* alpha numeric with dash validation starts */

    var alphanumeric_with_dash_pattern = /^[A-Za-z0-9-]+$/;

    if ($('.chk_alphanumeric_with_dash').length) {
        $('#' + settings.formId).find('.chk_alphanumeric_with_dash').each(function() {
            if (!alphanumeric_with_dash_pattern.test($.trim($(this).val()))) {
                validation.push('false');
                $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.alphanumericWithDashValidationMsg);
            } else {
                validation.push('true');
                if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                    $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                } else {
                    /* do nothing */
                }
            }
        });
    };




    /* alpha numeric with dash validation ends */



    /* check doc type */


    if ($('.chk_pdf_type').length) {

        var fileExtension = ['pdf'];
        /* check the value of all inputs elements with no_blank class and return false if input field is blank else return true */
        /* then insert the return value in an array */
        $('#' + settings.formId).find('.chk_pdf_type').each(function() {

            var ext = $(this).val().split('.').pop().toLowerCase();

            if ($.trim($(this).val()) != '') {

                if ($.inArray(ext, ['pdf']) == -1) {

                    validation.push('false');
                    $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                    $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.doctypeValidationMsg);
                } else {
                    validation.push('true');
                    if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                        $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                    } else {
                        /* do nothing */
                    }
                }
            } else {
                /* do nothing */
            }


        });
    };


    /* check doc type end */





    /* check image type */


    if ($('.chk_image_type').length) {
        var fileExtension = ['jpg', 'jpeg', 'png'];
        /* check the value of all inputs elements with no_blank class and return false if input field is blank else return true */
        /* then insert the return value in an array */
        $('#' + settings.formId).find('.chk_image_type').each(function() {




            var ext = $(this).val().split('.').pop().toLowerCase();


            if ($.trim($(this).val()) != '') {
                if ($.inArray(ext, ['jpg', 'jpeg', 'png']) == -1) {
                    validation.push('false');
                    $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                    $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.imagetypeValidationMsg);
                } else {
                    validation.push('true');
                    if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                        $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                    } else {
                        /* do nothing */
                    }
                }
            } else {
                /* do nothing */
            }


        });
    };


    /* check image type end */





    /* check image size and type */
    if ($('.chk_img_size_type').length) {

        /* check the value of all inputs elements with chk_img_size class and return false if input field is blank else return true */
        /* then insert the return value in an array */
        $('#' + settings.formId).find('.chk_img_size_type').each(function() {

            // calculate image size
            var imgsize = $(this)[0].files[0].size / 1024;
            var imgsize = (Math.round((imgsize / 1024) * 100) / 100);
            var ext = $(this).val().split('.').pop().toLowerCase();
            // console.log('img size-' + imgsize);
            if ($.trim($(this).val()) !== '') {
                if (imgsize > 4 || $.inArray(ext, ['jpg']) == -1) {
                    validation.push('false');
                    if (imgsize > 2 && $.inArray(ext, ['jpg']) != -1) {
                        $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                        $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.docsizeValidationMsg);
                    } else if (imgsize < 2 && $.inArray(ext, ['jpg']) == -1) {
                        $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                        $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.doctypeValidationMsg);
                    } else {
                        $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                        $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.docsizetypeValidationMsg);
                    }
                } else {
                    validation.push('true');
                    if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                        $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                    } else {
                        /* do nothing */
                    }
                }
            } else {
                /* do nothing */
            }


        });
    };

    /* check image size and type end */



    /* URL validation starts */



    if ($('.chk_url').length) {


        // regular expression for alphanumeric pattern
        var url_pattern = //^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;

            $('#' + settings.formId).find('.chk_url').each(function() {
                if (!url_pattern.test($.trim($(this).val()))) {
                    validation.push('false');
                    $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                    $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.urlValidationMsg);
                } else {
                    validation.push('true');
                    if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                        $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                    } else {
                        /* do nothing */
                    }
                }
            });
    };



    /* URL validation ends */


    /* Input character limit validation */
    /* check if no_blank class found inside the form */
    if ($('.chk_char_250').length) {

        /* check the value of all inputs elements with no_blank class and return false if input field is blank else return true */
        /* then insert the return value in an array */
        $('#' + settings.formId).find('.chk_char_250').each(function() {
            if ($.trim($(this).val()) != '') {
                /* go through all inputs having class .no_blank and show error if input value is blank */
                if ($.trim($(this).val().length) > 250) {
                    validation.push('false');
                    $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                    $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.characterLength200ValidationMsg);
                } else {
                    validation.push('true');
                    if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                        $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                    } else {
                        /* do nothing */
                    }

                }
            } else {
                /* do nothing */
            }

        });
    };


    if ($('.chk_char_150').length) {

        /* check the value of all inputs elements with no_blank class and return false if input field is blank else return true */
        /* then insert the return value in an array */
        $('#' + settings.formId).find('.chk_char_150').each(function() {

            /* go through all inputs having class .no_blank and show error if input value is blank */
            if ($.trim($(this).val().length) > 150) {
                validation.push('false');
                $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.characterLeng150thValidationMsg);
            } else {
                validation.push('true');
                if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                    $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                } else {
                    /* do nothing */
                }

            }
        });
    };

    /* password validation starts */

    if ($('.chk_password').length) {
        var password_pattern = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
        $('#' + settings.formId).find('.chk_password').each(function() {
            if (!password_pattern.test($.trim($(this).val()))) {
                validation.push('false');
                $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.passwordValidationMsg);
            } else {
                validation.push('true');
                if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                    $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                } else {
                    /* do nothing */
                }
            }
        });
    };


    // Mobile number validation

    if ($('.chk_mobile').length) {
        var mobile_pattern = /^[0-9]{10,10}$/;
        $('#' + settings.formId).find('.chk_mobile').each(function() {
            if (!mobile_pattern.test($.trim($(this).val()))) {
                validation.push('false');
                $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.mobileValidationMsg);
            } else {
                validation.push('true');
                if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                    $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                    $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html('');
                } else {
                    /* do nothing */
                }
            }
        });
    };

    // Aadhaar number validation

    if ($('.chk_aadhaar').length) {
        var aadhaar_pattern = /^[0-9]{12,12}$/;
        $('#' + settings.formId).find('.chk_aadhaar').each(function() {
            if (!aadhaar_pattern.test($.trim($(this).val()))) {
                validation.push('false');
                $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.aadhaarnoValidationMsg);
            } else {
                validation.push('true');
                if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                    $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                    $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html('');
                } else {
                    /* do nothing */
                }
            }
        });
    };



    /* check pdf  type file &&  file size */

    // Mobile number validation

    if ($('.chk_digit').length) {

        var digit_pattern = /^[0-9]+$/;
        $('#' + settings.formId).find('.chk_digit').each(function() {
            //  console.log($(this).val());
            if (!digit_pattern.test($.trim($(this).val()))) {
                validation.push('false');
                $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.digitValidationMsg);
            } else {
                validation.push('true');
                if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                    $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                } else {
                    /* do nothing */
                }
            }
        });
    };


    /* check pdf  type file &&  file size */

    if ($('.chk_pdf_file').length) {

        var fileExtension = ['pdf', 'jpg', 'png', 'jpeg'];
        /* check the value of all inputs elements with no_blank class and return false if input field is blank else return true */
        /* then insert the return value in an array */
        $('#' + settings.formId).find('.chk_pdf_file').each(function() {

            var ext = $(this).val().split('.').pop().toLowerCase();

            if ($.trim($(this).val()) != '') {

                if ($.inArray(ext, ["pdf", "jpg", "png", "jpeg"]) == -1) {
                    validation.push("false");
                    $(this)
                        .closest("." + settings.containerClass)
                        .addClass(settings.errorClass);
                    $(this)
                        .closest("." + settings.containerClass)
                        .find("." + settings.errorMsgClass)
                        .html(settings.chkdoctypeValidationMsg);
                } else if ($(".chk_pdf_file").length) {
                    // calculate image size
                    var imgsize = $(this)[0].files[0].size / 1024;
                    var imgsize = Math.round((imgsize / 1024) * 100) / 100;
                    // var ext = $(this).val().split('.').pop().toLowerCase();

                    //console.log("img size-" + imgsize);

                    if ($.trim($(this).val()) !== "") {
                        if (imgsize > 0.5) {
                            validation.push("false");
                            $(this)
                                .closest("." + settings.containerClass).addClass(settings.errorClass);
                            $(this).closest("." + settings.containerClass).find("." + settings.errorMsgClass)
                                .html(settings.docsizeValidationMsg);
                        } else {
                            validation.push("true");
                            if (
                                $(this)
                                .closest("." + settings.containerClass)
                                .hasClass(settings.errorClass)
                            ) {
                                $(this)
                                    .closest("." + settings.containerClass)
                                    .removeClass(settings.errorClass);
                            } else {
                                /* do nothing */
                            }
                        }
                    } else {
                        /* do nothing */
                    }
                } else {
                    validation.push("true");
                    if ($(this).closest("." + settings.containerClass).hasClass(settings.errorClass)) {
                        $(this).closest("." + settings.containerClass).removeClass(settings.errorClass);
                        $(this)
                            .closest("." + settings.containerClass).find("." + settings.errorMsgClass).html(settings.chkdoctypeValidationMsg);
                    } else {
                        /* do nothing */
                    }
                }
            } else {
                /* do nothing */
            }


        });
    };
    if ($('.chk_pdf_only').length) {

        var fileExtension = ['pdf'];
        $('#' + settings.formId).find('.chk_pdf_only').each(function() {

            var ext = $(this).val().split('.').pop().toLowerCase();

            if ($.trim($(this).val()) != '') {

                if ($.inArray(ext, ["pdf"]) == -1) {
                    validation.push("false");
                    $(this)
                        .closest("." + settings.containerClass)
                        .addClass(settings.errorClass);
                    $(this)
                        .closest("." + settings.containerClass)
                        .find("." + settings.errorMsgClass)
                        .html(settings.chkpdfdocValidationMsg);
                } else if ($(".chk_pdf_only").length) {
                    // calculate image size
                    var imgsize = $(this)[0].files[0].size / 1024;
                    var imgsize = Math.round((imgsize / 1024) * 100) / 100;
                    // var ext = $(this).val().split('.').pop().toLowerCase();

                    //console.log("img size-" + imgsize);

                    if ($.trim($(this).val()) !== "") {
                        if (imgsize > 5) {
                            validation.push("false");
                            $(this)
                                .closest("." + settings.containerClass).addClass(settings.errorClass);
                            $(this).closest("." + settings.containerClass).find("." + settings.errorMsgClass)
                                .html(settings.pdfsizeValidationMsg);
                        } else {
                            validation.push("true");
                            if (
                                $(this)
                                .closest("." + settings.containerClass)
                                .hasClass(settings.errorClass)
                            ) {
                                $(this)
                                    .closest("." + settings.containerClass)
                                    .removeClass(settings.errorClass);
                            } else {
                                /* do nothing */
                            }
                        }
                    } else {
                        /* do nothing */
                    }
                } else {
                    validation.push("true");
                    if ($(this).closest("." + settings.containerClass).hasClass(settings.errorClass)) {
                        $(this).closest("." + settings.containerClass).removeClass(settings.errorClass);
                        $(this)
                            .closest("." + settings.containerClass).find("." + settings.errorMsgClass).html(settings.chkpdfdocValidationMsg);
                    } else {
                        /* do nothing */
                    }
                }
            } else {
                /* do nothing */
            }


        });
    };

    /* ifsc validation starts */
    if ($('.chk_ifsc').length) {

        // var ifsc_pattern = /^[A-Za-z]{4}\d{7}$/; upper case lower case
        var ifsc_pattern = /^[A-Z]{4}\d{7}$/;

        $('#' + settings.formId).find('.chk_ifsc').each(function() {
            //  console.log($(this).val());
            if (!ifsc_pattern.test($.trim($(this).val()))) {
                validation.push('false');
                $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.ifscValidationMsg);
            } else {
                validation.push('true');
                if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                    $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                } else {
                    /* do nothing */
                }
            }
        });
    };
    /* ifsc validation ends */


    /* ifsc validation starts */
    if ($('.chk_alpha').length) {

        // regular expression for alphabet
        var ifsc_pattern = /^[a-zA-Z ]*$/;

        $('#' + settings.formId).find('.chk_alpha').each(function() {
            if (!ifsc_pattern.test($.trim($(this).val()))) {
                validation.push('false');
                $(this).closest('.' + settings.containerClass).addClass(settings.errorClass);
                $(this).closest('.' + settings.containerClass).find('.' + settings.errorMsgClass).html(settings.alphabetValidationMsg);
            } else {
                validation.push('true');
                if ($(this).closest('.' + settings.containerClass).hasClass(settings.errorClass)) {
                    $(this).closest('.' + settings.containerClass).removeClass(settings.errorClass);
                } else {
                    /* do nothing */
                }
            }
        });
    };
    /* ifsc validation ends */


    /*$('.chk_blank').on('change', function () {
     check_validation();
     });*/
    /*$('input').bind('focusout', function () {
     check_validation();
     });*/






    function check_validation() {
        console.log('hi');
        var chk_validation = $('#add_data').scvalidateform({
            formId: settings.formId
        });
        alert('hii');
    };

    return validation;

};
