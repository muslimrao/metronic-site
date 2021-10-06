

// Class definition

var modal_form_Pilot_Fields =  {
    first_name: {
        validators: {
            notEmpty: {
                message: 'First Name is required'
            }
        }
    },
    last_name: {
        validators: {
            notEmpty: {
                message: 'Last Name is required'
            }
        }
    },
    
};



if ( $(".modal_form").length > 0 )
{
    
    for (var i =0;  i <  $(".modal_form").length; i++ )
    {
        
        const demoForm = $(".modal_form")[i];

     

        var formFields = {}

        switch(demoForm.id ) {
            case "pilotForsm":
                formFields = modal_form_Pilot_Fields;
                break;
           
            default:
                // code block
        }

        console.log(formFields);
        const loginButton =  demoForm.querySelector(".btn_Ajax_Request"); //document.getElementById('loginButton');
        const fv = FormValidation.formValidation(demoForm, {
            fields: formFields,

               
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: '.fv-row'
                }),


                // trigger: new FormValidation.plugins.Trigger(),
                // tachyons: new FormValidation.plugins.Tachyons(),
                icon: new FormValidation.plugins.Icon({
                    valid: 'fa fa-check',
                    invalid: 'fa fa-times',
                    validating: 'fa fa-refresh'
                }),
            },
        }).on('core.form.validating', function() {
            //loginButton.innerHTML = 'Validating ...';
        });

        loginButton.addEventListener('click', function() {

            
            fv.validate().then(function(status) {


                if (status == 'Valid') {

                    
                    handle_validation_response(loginButton, function( success_result ){
                        
                        show_alert(success_result.message, "success", "Ok, got it!", "btn-primary", function(){

                          
                            show_hide_loading_modal();

                            
                            window.location = window.location.href;

                        });
                        
                    }, function( error_result ){

                    });
                    
                   
                } else {

                    show_alert("Sorry, looks like there are some errors detected, please try again.", "error", "Ok, got it!", "font-weight-bold btn-light-primary");

                }


                // loginButton.innerHTML = (status === 'Valid') ? 'Form is validated. Logging in ...' : 'Please try again';
            });
        });





        const modal = new bootstrap.Modal(demoForm);
        // Close button handler
        const closeButton = demoForm.querySelector('[data-kt-users-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to close?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, close it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    modal.hide(); // Hide modal				
                } 
            });
        });

    }


 

}