<div class="modal fade modal_form " id="{!! $_modal_form_id !!}"   tabindex="-1" aria-hidden="true">
    {!! Form::open( array("url" => $_modal_form_url, "method" => "post", "enctype" => "multipart/form-data", "class" => "form") ) !!}

        {!! Form::unique_formid( ) !!}

        
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header" id="{!! $_modal_form_id !!}_header">
                        <h2 class="fw-bolder">{!!  $_Add_Text !!}</h2>


                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                        </div>
                    </div>


                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">

                       

                            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="{!! $_modal_form_id !!}_scroll"
                                data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#{!! $_modal_form_id !!}_header"
                                data-kt-scroll-wrappers="{!! $_modal_form_id !!}_scroll"
                                data-kt-scroll-offset="300px">
                                
                                @include($_modal_form_file)                            

                            </div>


                            <div class="text-center pt-15">
                                <!-- <button type="reset" class="btn btn-light me-3"  data-kt-users-modal-action="cancel">Discard</button> -->

                                <button type="button" class="btn btn-primary btn_Ajax_Request " data-kt-users-modal-action="submit">
                                    <span class="indicator-label">{!!  $_Add_Text !!}</span>
                                    <span class="indicator-progress">Please wait...
                                        <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>

                 

                    </div>

                </div>

            </div>

    


    {!! Form::close() !!}
</div>