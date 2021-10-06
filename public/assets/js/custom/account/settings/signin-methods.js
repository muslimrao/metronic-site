"use strict";

// Class definition
var KTAccountSettingsSigninMethods = function () {
    // Private functions
    var initSettings = function () {

        // UI elements
        var signInMainEl = document.getElementById('kt_signin_email');
        var signInEditEl = document.getElementById('kt_signin_email_edit');
        var passwordMainEl = document.getElementById('kt_signin_password');
        var passwordEditEl = document.getElementById('kt_signin_password_edit');

        // button elements
        var signInChangeEmail = document.getElementById('kt_signin_email_button');
        var signInCancelEmail = document.getElementById('kt_signin_cancel');
        var passwordChange = document.getElementById('kt_signin_password_button');
        var passwordCancel = document.getElementById('kt_password_cancel');

        // toggle UI
        signInChangeEmail.querySelector('button').addEventListener('click', function () {
            toggleChangeEmail();
        });

        signInCancelEmail.addEventListener('click', function () {
            toggleChangeEmail();
        });

        passwordChange.querySelector('button').addEventListener('click', function () {
            toggleChangePassword();
        });

        passwordCancel.addEventListener('click', function () {
            toggleChangePassword();
        });

        var toggleChangeEmail = function () {
            signInMainEl.classList.toggle('d-none');
            signInChangeEmail.classList.toggle('d-none');
            signInEditEl.classList.toggle('d-none');
        }

        var toggleChangePassword = function () {
            passwordMainEl.classList.toggle('d-none');
            passwordChange.classList.toggle('d-none');
            passwordEditEl.classList.toggle('d-none');
        }
    }

    var handleChangeEmail = function (e) {
        var validation;

        // // form elements
        // var signInForm = document.getElementById('kt_signin_change_email');

        // validation = FormValidation.formValidation(
        //     signInForm,
        //     {
        //         fields: {
        //             email: {
        //                 validators: {
        //                     notEmpty: {
        //                         message: 'Email is required'
        //                     },
        //                     emailAddress: {
        //                         message: 'The value is not a valid email address'
        //                     }
        //                 }
        //             },

        //             confirm_password: {
        //                 validators: {
        //                     notEmpty: {
        //                         message: 'Password is required'
        //                     }
        //                 }
        //             }
        //         },

        //         plugins: { //Learn more: https://formvalidation.io/guide/plugins
        //             trigger: new FormValidation.plugins.Trigger(),
        //             bootstrap: new FormValidation.plugins.Bootstrap5({
        //                 rowSelector: '.fv-row'
        //             })
        //         }
        //     }
        // );


        
        
        // signInForm.querySelector('#kt_signin_submit').addEventListener('click', function (e) {
        //     e.preventDefault();
           

        //     validation.validate().then(function (status) {

        //         if (status == 'Valid') {


        //             handle_validation_response("#kt_signin_submit", function( success_result ){
        //                 $("#kt_signin_email .fw-bold").html( $("#kt_signin_email_edit input[name='email']").val() );
        //             }, function( error_result ){

        //             });
                    
                   
        //         } else {

        //             show_alert("Sorry, looks like there are some errors detected, please try again.", "error", "Ok, got it!", "font-weight-bold btn-light-primary");

        //         }
        //     });
        // });
    
    }

    var handleChangePassword = function (e) {
        var validation;

        // form elements
        // var passwordForm = document.getElementById('kt_signin_change_password');

        // validation = FormValidation.formValidation(
        //     passwordForm,
        //     {
        //         fields: {
        //             current_password: {
        //                 validators: {
        //                     notEmpty: {
        //                         message: 'Current Password adad is required'
        //                     }
        //                 }
        //             },

        //             new_password: {
        //                 validators: {
        //                     notEmpty: {
        //                         message: 'New Password is required'
        //                     }
        //                 }
        //             },

        //             confirm_password: {
        //                 validators: {
        //                     notEmpty: {
        //                         message: 'Confirm Password is required'
        //                     },
        //                     identical: {
        //                         compare: function() {
        //                             return passwordForm.querySelector('[name="new_password"]').value;
        //                         },
        //                         message: 'The password and its confirm are not the same'
        //                     }
        //                 }
        //             },
        //         },

        //         plugins: { //Learn more: https://formvalidation.io/guide/plugins
        //             trigger: new FormValidation.plugins.Trigger(),
        //             bootstrap: new FormValidation.plugins.Bootstrap5({
        //                 rowSelector: '.fv-row'
        //             })
        //         }
        //     }
        // );

        // passwordForm.querySelector('#kt_password_submit').addEventListener('click', function (e) {
        //     e.preventDefault();
        //     console.log('click');

        //     validation.validate().then(function (status) {

        //         if (status == 'Valid') {


        //             handle_validation_response("#kt_password_submit", function( success_result ){
                      
        //             }, function( error_result ){

        //             });
                    
                   
        //         } else {

        //             show_alert("Sorry, looks like there are some errors detected, please try again.", "error", "Ok, got it!", "font-weight-bold btn-light-primary");

        //         }
 
        //     });
        // });


    }


    var handleEditProfile = function (e) {
        var validation;

        // // form elements
        // var editProfileForm = document.getElementById('kt_account_profile_details_form');

        // validation = FormValidation.formValidation(
        //     editProfileForm,
        //     {
        //         fields: {
        //             first_name: {
        //                 validators: {
        //                     notEmpty: {
        //                         message: 'First Name is required'
        //                     }
        //                 }
        //             },

        //             last_name: {
        //                 validators: {
        //                     notEmpty: {
        //                         message: 'Last Name is required'
        //                     }
        //                 }
        //             },


                   
        //         },

        //         plugins: { //Learn more: https://formvalidation.io/guide/plugins
        //             trigger: new FormValidation.plugins.Trigger(),
        //             bootstrap: new FormValidation.plugins.Bootstrap5({
        //                 rowSelector: '.fv-row'
        //             })
        //         }
        //     }
        // );

        // editProfileForm.querySelector('#kt_account_profile_details_submit').addEventListener('click', function (e) {
        //     e.preventDefault();
        //     console.log('click');

        //     validation.validate().then(function (status) {

        //         if (status == 'Valid') {


        //             handle_validation_response("#kt_account_profile_details_submit", function( success_result ){
                      
        //             }, function( error_result ){

        //             });
                    
                   
        //         } else {

        //             show_alert("Sorry, looks like there are some errors detected, please try again.", "error", "Ok, got it!", "font-weight-bold btn-light-primary");

        //         }
 
        //     });
        // });
    }

    // Public methods
    return {
        init: function () {
            initSettings();
            handleChangeEmail();
            handleChangePassword();
            handleEditProfile();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTAccountSettingsSigninMethods.init();
});
