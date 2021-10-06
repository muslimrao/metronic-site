<div>

    @include($_directory . "_common_header")




    <div class="card mb-5 mb-xl-10">

        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true"
            aria-controls="kt_account_profile_details">

            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">Profile Details</h3>
            </div>

        </div>


        <div id="kt_account_profile_details" class="collapse show">

            {!! Form::open( array("url" => $_directory . "save", "method" => "post", "enctype" => "multipart/form-data",
            "id" => "kt_account_profile_details_form", "class" => "form") ) !!}

            {!! Form::unique_formid( ) !!}

            <div class="card-body border-top p-9">

                <!-- <div class="row mb-6">
                    <?php
                    $_messageBundle = $_messageBundle_2;
                    ?>
                    @include("sitecontrol.template._show_messages")
                </div> -->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span class="">Airline Name</span>
                    </label>
                    <div class="col-lg-8 fv-row">


                        {!! Form::text("airline_name", GeneralHelper::set_value("airline_name", get_airline_DATA('airline_name')),
                        array("class" => "form-control form-control-lg form-control-solid", "placeholder" => "",
                        "readonly" => "readonly")) !!}
                    </div>
                </div>


                <div class="row mb-6">

                    <label class="col-lg-4 col-form-label fw-bold fs-6">Profile Picture</label>



                    <div class="col-lg-8">

                        @php
                        $image_upload_array = array(
                        "file_input_name" => "file_user_image",
                        "hidden_input_name" => "user_image",
                        "hidden_input_value" => GeneralHelper::set_value("user_image", $user_image),

                        "image_title" => "Profile Photo",
                        "image_types" => GeneralHelper::set_value("images_types", $images_types),
                        );
                        @endphp

                        @include($admin_path . "template._image_upload", $image_upload_array)
                    </div>
                </div>


                <div class="row mb-6">

                    <label class="col-lg-4 col-form-label required fw-bold fs-6">First Name</label>

                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6 fv-row">
                                {!! Form::text("first_name", GeneralHelper::set_value("first_name", $first_name),
                                array("class" => "form-control form-control-lg form-control-solid mb-3 mb-lg-0",
                                "placeholder" => "First Name")) !!}
                                {!! GeneralHelper::form_error($errors, 'first_name') !!}

                            </div>

                            <div class="col-lg-6 fv-row">
                                {!! Form::text("last_name", GeneralHelper::set_value("last_name", $last_name),
                                array("class" => "form-control form-control-lg form-control-solid", "placeholder" =>
                                "Last Name")) !!}
                                {!! GeneralHelper::form_error($errors, 'last_name') !!}
                            </div>

                        </div>
                    </div>

                </div>


                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label  fw-bold fs-6">Bio</label>
                    <div class="col-lg-8 fv-row">
                        {!! Form::textarea("bio", GeneralHelper::set_value("bio", $bio), array("class" =>
                        "form-control form-control-lg form-control-solid", "rows" => 4, "placeholder" => "Type your
                        bio.")) !!}
                        {!! GeneralHelper::form_error($errors, 'bio') !!}
                    </div>
                </div>


                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span class="">Call Sign</span>
                    </label>
                    <div class="col-lg-8 fv-row">
                        {!! Form::text("call_sign", GeneralHelper::set_value("call_sign", $call_sign),
                        array("class" => "form-control form-control-lg form-control-solid", "placeholder" => "Call
                        Sign")) !!}
                        {!! GeneralHelper::form_error($errors, 'call_sign') !!}
                    </div>
                </div>


                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span class="">Number Flights</span>
                    </label>
                    <div class="col-lg-8 fv-row">
                        {!! Form::text("number_flights", GeneralHelper::set_value("number_flights", $number_flights),
                        array("class" => "form-control form-control-lg form-control-solid", "placeholder" =>
                        "Number Flights")) !!}
                        {!! GeneralHelper::form_error($errors, 'number_flights') !!}
                    </div>
                </div>


                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span class="">Vatsim ID</span>
                    </label>
                    <div class="col-lg-8 fv-row">
                        {!! Form::number("vatsim_id", GeneralHelper::set_value("vatsim_id", $vatsim_id),
                        array("class" => "form-control form-control-lg form-control-solid", "placeholder" => "Vatsim
                        ID")) !!}
                        {!! GeneralHelper::form_error($errors, 'vatsim_id') !!}
                    </div>
                </div>


                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span class="">Rank</span>
                    </label>
                    <div class="col-lg-8 fv-row">
                        {!! Form::select('rank_id',
                        DropdownHelper::rank_dropdown(FALSE),
                        GeneralHelper::set_value('rank_id',$rank_id), ["class" =>
                        "form-select form-control form-control-lg form-control-solid", "autocomplete" =>
                        "off"] ) !!}
                        {!! GeneralHelper::form_error($errors, 'rank_id') !!}
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span class="">Notifications</span>
                    </label>
                    <div class="col-lg-8 fv-row">
                        {!! Form::text("notifications", GeneralHelper::set_value("notifications", $notifications),
                        array("class" => "form-control form-control-lg form-control-solid", "placeholder" =>
                        "Notifications")) !!}
                        {!! GeneralHelper::form_error($errors, 'notifications') !!}
                    </div>
                </div>



            </div>


           
            @if ( RoleManagement::if_Allowed( "managemyaccount", 'save' ) )
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button name="save_profile" type="button" class="btn btn-primary me-2 px-6 btn_Ajax_Request ">
                    <span class="indicator-label"> Save Changes</span>
                    <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
            @endif
          


            <input type="hidden" name="option" value="{{ GeneralHelper::set_value("option", $option) }}">
            {!! Form::close() !!}

        </div>

    </div>


    <div class="card mb-5 mb-xl-10">

        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_signin_method">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">Update Credentials</h3>
            </div>
        </div>


        <div id="kt_account_signin_method" class="collapse show">

            <div class="card-body border-top p-9">

                <div class="d-flex flex-wrap align-items-center">

                    <div id="kt_signin_email">
                        <div class="fs-6 fw-bolder mb-1">Email Address</div>
                        <div class="fw-bold text-gray-600">{{ $email }}</div>
                    </div>


                    <div id="kt_signin_email_edit" class="flex-row-fluid d-none">

                        {!! Form::open( array("url" => $_directory . "save", "method" => "post", "enctype" =>
                        "multipart/form-data",
                        "id" => "kt_signin_change_email", "class" => "form") ) !!}

                        {!! Form::unique_formid( ) !!}

                        <div class="row mb-6">
                            <div class="col-lg-6 mb-4 mb-lg-0">
                                <div class="fv-row mb-0">
                                    <label for="email" class="form-label fs-6 fw-bolder mb-3">Enter New Email
                                        Address</label>
                                    {!! Form::text("email", GeneralHelper::set_value("email", $email), array("class"
                                    => "form-control form-control-lg form-control-solid", "placeholder" => "Email
                                    Address")) !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="fv-row mb-0">
                                    <label for="confirm_password" class="form-label fs-6 fw-bolder mb-3">Your Current
                                        Password to Confirm</label>
                                    {!! Form::password("confirm_password", array("class" => "form-control
                                    form-control-lg form-control-solid")) !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">

                            @if ( RoleManagement::if_Allowed( "managemyaccount", 'save' ) )
                            <button type="button" class="btn btn-primary me-2 px-6 btn_Ajax_Request">
                                <span class="indicator-label"> Update Credentials</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            @endif


                            <input type="hidden" name="option" value="update_credentials">

                            <button id="kt_signin_cancel" type="button"
                                class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel</button>
                        </div>
                        {!! Form::close() !!}

                    </div>


                    <div id="kt_signin_email_button" class="ms-auto">
                        <button class="btn btn-light btn-active-light-primary">Change Email</button>
                    </div>

                </div>

                <div class="separator separator-dashed my-6"></div>

                <div class="d-flex flex-wrap align-items-center mb-10">

                    <div id="kt_signin_password">
                        <div class="fs-6 fw-bolder mb-1">Password</div>
                        <div class="fw-bold text-gray-600">************</div>
                    </div>


                    <div id="kt_signin_password_edit" class="flex-row-fluid d-none">

                        {!! Form::open( array("url" => $_directory . "save", "method" => "post", "enctype" =>
                        "multipart/form-data",
                        "id" => "kt_signin_change_password", "class" => "form") ) !!}

                        {!! Form::unique_formid( ) !!}

                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <div class="fv-row mb-0">
                                    <label for="current_password" class="form-label fs-6 fw-bolder mb-3">Current
                                        Password</label>
                                    {!! Form::password("current_password", array("class" => "form-control
                                    form-control-lg form-control-solid", "id" => "current_password")) !!}

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fv-row mb-0">
                                    <label for="new_password" class="form-label fs-6 fw-bolder mb-3">New
                                        Password</label>
                                    {!! Form::password("new_password", array("class" => "form-control
                                    form-control-lg form-control-solid", "id" => "new_password")) !!}

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fv-row mb-0">
                                    <label for="confirm_password" class="form-label fs-6 fw-bolder mb-3">Confirm New
                                        Password</label>
                                    {!! Form::password("confirm_password", array("class" => "form-control
                                    form-control-lg form-control-solid", "id" => "confirm_password")) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-text mb-5">Password must be at least 8 character and contain symbols</div>
                        <div class="d-flex">

                            <input type="hidden" name="option" value="change_password">

                            @if ( RoleManagement::if_Allowed( "managemyaccount", 'save' ) )
                            <button type="button" class="btn btn-primary me-2 px-6 btn_Ajax_Request">Update Password</button>
                            @endif


                            <button id="kt_password_cancel" type="button"
                                class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel</button>
                        </div>
                        {!! Form::close() !!}

                    </div>


                    <div id="kt_signin_password_button" class="ms-auto">
                        <button class="btn btn-light btn-active-light-primary">Reset Password</button>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {!! Form::open( array("url" => $_directory . "save", "method" => "post", "enctype" =>
    "multipart/form-data",
    "id" => "", "class" => "form") ) !!}

    {!! Form::unique_formid( ) !!}

        <div class="card mb-5 mb-xl-10">
            
            <div class="card-header border-0 cursor-pointer">
                <div class="card-title">
                    <h3 class="fw-bolder m-0">Updates</h3>
                </div>
            </div>
            
            
            <div class="card-body border-top p-9 ">
        
                
                <div class="py-2">
                    
                    <div class="d-flex flex-stack">
                        <div class="d-flex">
                            <div class="d-flex flex-column">
                                <a href="#" class="fs-5 text-dark text-hover-primary fw-bolder">Hub</a>
                                <div class="fs-6 fw-bold text-muted">Assign Hub</div>
                            </div>
                        </div>
                        <div class="col-5 d-flex justify-content-end">
                            
                            <label class="col-12 ">
                                
                                {!! Form::select('hub_id',
                                DropdownHelper::hub_dropdown(FALSE),
                                GeneralHelper::set_value('hub_id',$hub_id), ["class" =>
                                "form-select form-control form-control-lg form-control-solid", "autocomplete" =>
                                "off"] ) !!}
                                {!! GeneralHelper::form_error($errors, 'hub_id') !!}
                                
                                
                            </label>
                            
                        </div>
                    </div>
                    
                    <div class="separator separator-dashed my-5"></div>
                    
                    <div class="d-flex flex-stack">
                        <div class="d-flex">
                            <div class="d-flex flex-column">
                                <a href="#" class="fs-5 text-dark text-hover-primary fw-bolder">Rank</a>
                                <div class="fs-6 fw-bold text-muted">Assign Rank</div>
                            </div>
                        </div>
                        
                        <div class="col-5 d-flex justify-content-end">
                            
                            <label class="col-12 ">
                                
                                {!! Form::select('rank_id',
                                DropdownHelper::rank_dropdown(FALSE),
                                GeneralHelper::set_value('rank_id',$rank_id), ["class" =>
                                " form-select form-control form-control-lg form-control-solid", "autocomplete" =>
                                "off"] ) !!}
                                {!! GeneralHelper::form_error($errors, 'rank_id') !!}
                                
                            </label>
                           
                        </div>
                    </div>
                    
        
                    
                </div>
                
            </div>
            
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                

                @if ( RoleManagement::if_Allowed( "managemyaccount", 'save' ) )
                <button type="button" class="btn btn-primary btn_Ajax_Request"  >Save Changes</button>
                @endif

            </div>
            
        </div>

        <input type="hidden" name="option" value="update_hub_and_rank">

    {!! Form::close() !!}




    <div class="card mb-5 mb-xl-10" style="display: none;">

        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_notifications" aria-expanded="true" aria-controls="kt_account_notifications">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">Notifications</h3>
            </div>
        </div>


        <div id="kt_account_notifications" class="collapse show">

            <form class="form">

                <div class="card-body border-top px-9 pt-3 pb-4">

                    <div class="table-responsive">
                        <table class="table table-row-dashed border-gray-300 align-middle gy-6">
                            <tbody class="fs-6 fw-bold">

                                <tr>
                                    <td class="min-w-250px fs-4 fw-bolder"></td>
                                    <td class="w-125px">
                                        <div class="form-check form-check-solid">

                                            {!! Form::checkbox("notifications[email][new_pilots]", 1, FALSE, [
                                            "data-kt-check" => "true", "data-kt-check-target" =>
                                            "[data-kt-settings-notification=email]", "id" =>
                                            "kt_settings_notification_email", "class" => "form-check-input",
                                            "data-kt-settings-notification" => "email"] ) !!}
                                            {!! Form::label("kt_settings_notification_email", "Email", [ "class" =>
                                            "form-check-label ps-2" ]) !!}

                                        </div>
                                    </td>
                                    <td class="w-125px">
                                        <div class="form-check form-check-solid">

                                            {!! Form::checkbox("notifications[phone][new_pilots]", 1, FALSE, [
                                            "data-kt-check" => "true", "data-kt-check-target" =>
                                            "[data-kt-settings-notification=phone]", "id" =>
                                            "kt_settings_notification_phone", "class" => "form-check-input",
                                            "data-kt-settings-notification" => "phone"] ) !!}
                                            {!! Form::label("kt_settings_notification_phone", "Phone", [ "class" =>
                                            "form-check-label ps-2" ]) !!}

                                        </div>
                                    </td>
                                </tr>



                                <tr>
                                    <td>New Pilots</td>
                                    <td>
                                        <div class="form-check form-check-solid">
                                            {!! Form::checkbox("notifications[email][new_pilots]", 1, FALSE, ["class" =>
                                            "form-check-input", "data-kt-settings-notification" => "email"] ) !!}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-check-solid">
                                            {!! Form::checkbox("notifications[email][new_pilots]", 1, FALSE, ["class" =>
                                            "form-check-input", "data-kt-settings-notification" => "phone"] ) !!}
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td>Completed Projects</td>
                                    <td>
                                        <div class="form-check form-check-solid">
                                            {!! Form::checkbox("notifications[email][completed_projects]", 1, FALSE,
                                            ["class" => "form-check-input", "data-kt-settings-notification" => "email"]
                                            ) !!}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-check-solid">
                                            {!! Form::checkbox("notifications[email][completed_projects]", 1, FALSE,
                                            ["class" => "form-check-input", "data-kt-settings-notification" => "phone"]
                                            ) !!}
                                        </div>
                                    </td>
                                </tr>




                            </tbody>
                        </table>
                    </div>

                </div>


                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button class="btn btn-light btn-active-light-primary me-2">Discard</button>
                    <button class="btn btn-primary px-6">Save Changes</button>
                </div>

            </form>

        </div>

    </div>

    <!-- 
    <div class="card">

        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_deactivate" aria-expanded="true" aria-controls="kt_account_deactivate">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">Deactivate Account</h3>
            </div>
        </div>


        <div id="kt_account_deactivate" class="collapse show">

            <form id="kt_account_deactivate_form" class="form">

                <div class="card-body border-top p-9">

                    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">


                        <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                                <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)"
                                    fill="black" />
                                <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)"
                                    fill="black" />
                            </svg>
                        </span>



                        <div class="d-flex flex-stack flex-grow-1">

                            <div class="fw-bold">
                                <h4 class="text-gray-900 fw-bolder">You Are Deactivating Your Account</h4>
                                <div class="fs-6 text-gray-700">For extra security, this requires you to confirm your
                                    email or phone number when you reset yousignr password.
                                    <br />
                                    <a class="fw-bolder" href="#">Learn more</a>
                                </div>
                            </div>

                        </div>

                    </div>


                    <div class="form-check form-check-solid fv-row">
                        <input name="deactivate" class="form-check-input" type="checkbox" value="" id="deactivate" />
                        <label class="form-check-label fw-bold ps-2 fs-6" for="deactivate">I confirm my account
                            deactivation</label>
                    </div>

                </div>


                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button id="kt_account_deactivate_account_submit" type="submit"
                        class="btn btn-danger fw-bold">Deactivate Account</button>
                </div>

            </form>

        </div>

    </div> -->



</div>


@section('script')
<script src="{{ asset('assets/js/custom/account/settings/signin-methods.js') }}"></script>
@endsection