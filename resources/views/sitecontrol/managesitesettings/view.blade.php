@include( $_directory . '_common_header')

{!! 
Form::open(
    array(
    "url" => route('managesitesettings.save'),
    "method" => "post",
    "enctype" => "multipart/form-data",
    )
) 
!!}


    <div class="card">

        <div class="card-header">

            <div class="card-title fs-3 fw-bolder">Project Settings</div>

        </div>


            <div class="card-body p-9">

                <div class="row mb-5">

                    <div class="col-xl-3">
                        <div class="fs-6 fw-bold mt-2 mb-3">Airline Logo</div>
                    </div>


                    <div class="col-lg-8">

                        @php
                        $image_upload_array = array(
                        "file_input_name" => "file_logo",
                        "hidden_input_name" => "logo",
                        "hidden_input_value" => GeneralHelper::set_value("logo", get_airline_DATA('logo')),

                        "image_title" => "Profile Photo",
                        "image_types" => GeneralHelper::set_value("images_types",
                        $images_types),
                        );
                        @endphp

                        @include($admin_path . "template._image_upload",
                        $image_upload_array)

                        {!! GeneralHelper::form_error($errors, 'logo') !!}



                    </div>

                </div>


                <div class="row mb-8">
                    <div class="col-xl-3">
                        <div class="fs-6 fw-bold mt-2 mb-3">Airline Name</div>
                    </div>

                    <div class="col-xl-9 fv-row">
                        {!! Form::text ('airline_name', GeneralHelper::set_value("airline_name",
                        get_airline_DATA('airline_name')),
                        ["class"=> "form-control form-control-lg form-control-solid ",
                        "placeholder" => "", "autocomplete" => "off"] ) !!}

                        {!! GeneralHelper::form_error($errors, 'airline_name') !!}

                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-3">
                        <div class="fs-6 fw-bold mt-2 mb-3">About Airline</div>
                    </div>

                    <div class="col-xl-9 fv-row">
                        {!! Form::textarea('about', GeneralHelper::set_value("about", get_airline_DATA('about') )
                        ,["id" => "about", 'class'=>'form-control ckeditor', 'rows' => 2, 'cols' => 40]) !!}

                        {!! GeneralHelper::form_error($errors, 'about') !!}

                    </div>
                </div>


                <div class="row mb-8">
                    <div class="col-xl-3">
                        <div class="fs-6 fw-bold mt-2 mb-3">Currency Type</div>
                    </div>

                    <div class="col-xl-9 fv-row fv-plugins-icon-container">
                        <div class="position-relative d-flex align-items-center">
                
                            {!! Form::select('currency_type',
                            DropdownHelper::currency_dropdown(),
                            GeneralHelper::set_value('currency_type',get_airline_DATA('currency_type')), ["class" =>
                            "form-control form-select form-control-lg form-control-solid", "autocomplete" =>
                            "off"] ) !!}
                            
                            {!! GeneralHelper::form_error($errors, 'currency_type') !!}

                        </div>


                    </div>



                </div>


                <div class="row mb-8">
                    <div class="col-xl-3">
                        <div class="fs-6 fw-bold mt-2 mb-3">Measurement Type</div>
                    </div>

                    <div class="col-xl-9 fv-row">
                        {!! Form::text ('measurement_type', GeneralHelper::set_value("measurement_type",
                        get_airline_DATA('measurement_type')),
                        ["class"=> "form-control form-control-lg form-control-solid ",
                        "placeholder" => "", "autocomplete" => "off"] ) !!}

                        {!! GeneralHelper::form_error($errors, 'measurement_type') !!}

                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-3">
                        <div class="fs-6 fw-bold mt-2 mb-3">Timezone</div>
                    </div>

                    <div class="col-xl-9 fv-row">

                    

                        {!! Form::select('timezone',
                        DropdownHelper::timezones_dropdown(),
                        GeneralHelper::set_value('timezone',get_airline_DATA('timezone')), ["class" =>
                        "form-control form-select form-control-lg form-control-solid", "autocomplete" =>
                        "off"] ) !!}

                        {!! GeneralHelper::form_error($errors, 'timezone') !!}


                    </div>
                </div>


            </div>


            <div class="card-footer d-flex justify-content-end py-6 px-9">
                {!! Form::save_ajax($_controller) !!}
            </div>


    </div>


    {!! Form::options( "managesitesettings.projectsettings" ) !!}


{!! Form::close() !!}