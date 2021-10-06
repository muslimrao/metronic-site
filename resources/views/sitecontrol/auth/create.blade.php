<form class="form w-100" method="post" novalidate="novalidate" id="kt_sign_up_form" enctype="multipart/form-data" >

@csrf
<div class="mb-10 text-center">

    <h1 class="text-dark mb-3">Create an Account</h1>


    <div class="text-gray-400 fw-bold fs-4">Already have an account?
        <a href="{{ route('domainuser.login') }}" class="link-primary fw-bolder">Sign in here</a>
    </div>

</div>

<!-- 
<button type="button" class="btn btn-light-primary fw-bolder w-100 mb-10">
    <img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3" />Sign in with Google</button> -->


<div class="d-flex align-items-center mb-10">
    <!-- <div class="border-bottom border-gray-300 mw-50 w-100"></div>
    <span class="fw-bold text-gray-400 fs-7 mx-2">OR</span> -->
    <div class="border-bottom border-gray-300 col-12"></div>
</div>



@include("sitecontrol.template._show_messages")



<div class="text-center fv-row mb-7">
    @php
    $image_upload_array = array(
    "file_input_name" => "file_user_image",
    "hidden_input_name" => "user_image",
    "hidden_input_value" => GeneralHelper::set_value("user_image"),

    "image_title" => "Profile Photo",
    "image_types" => GeneralHelper::set_value("images_types",
    $images_types),
    );
    @endphp

    @include($admin_path . "template._image_upload",
    $image_upload_array)

    {!! GeneralHelper::form_error($errors, 'user_image') !!}

</div>


<div class="row fv-row mb-7">

    <div class="col-xl-6">
        <label class="form-label fw-bolder text-dark fs-6">First Name</label>

        {!! Form::text ('first_name', GeneralHelper::set_value("first_name"), ["class"=> "form-control form-control-lg form-control-solid", "placeholder" => "", "autocomplete" => "off"] ) !!}
        {!! GeneralHelper::form_error($errors, 'first_name') !!}
    </div>


    <div class="col-xl-6">
        <label class="form-label fw-bolder text-dark fs-6">Last Name</label>

        {!! Form::text ('last_name', GeneralHelper::set_value("last_name"), ["class"=> "form-control form-control-lg form-control-solid", "placeholder" => "", "autocomplete" => "off"] ) !!}
        {!! GeneralHelper::form_error($errors, 'last_name') !!}
    </div>

</div>


<div class="row fv-row mb-7">

    <div class="col-xl-6">

        <label class="form-label fw-bolder text-dark fs-6">Vatsim ID</label>

        {!! Form::text ('vatsim_id', GeneralHelper::set_value("vatsim_id"), ["class"=> "form-control form-control-lg form-control-solid", "placeholder" => "", "autocomplete" => "off"] ) !!}
        {!! GeneralHelper::form_error($errors, 'vatsim_id') !!}

    </div>

    <div class="col-xl-6">

        <label class="form-label fw-bolder text-dark fs-6">Email</label>


        {!! Form::text ('email', GeneralHelper::set_value("email"), ["class"=> "form-control form-control-lg form-control-solid", "placeholder" => "", "autocomplete" => "off"] ) !!}
        {!! GeneralHelper::form_error($errors, 'email') !!}
    </div>

</div>




<div class="mb-10 fv-row" data-kt-password-meter="true">

    <div class="mb-1">

        <label class="form-label fw-bolder text-dark fs-6">Password</label>


        <div class="position-relative mb-3">


            {!! Form::password ('password', ["class"=> "form-control form-control-lg form-control-solid", "placeholder" => "", "autocomplete" => "off"] ) !!}
            {!! GeneralHelper::form_error($errors, 'password') !!}


            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                <i class="bi bi-eye-slash fs-2"></i>
                <i class="bi bi-eye fs-2 d-none"></i>
            </span>
        </div>


        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
        </div>

    </div>


    <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp;
        symbols.</div>

</div>


<div class="fv-row mb-5">
    <label class="form-label fw-bolder text-dark fs-6">Confirm Password</label>

    {!! Form::password ('confirm_password', ["class"=> "form-control form-control-lg form-control-solid", "placeholder" => "", "autocomplete" => "off"] ) !!}

    {!! GeneralHelper::form_error($errors, 'confirm_password') !!}

</div>


<div class="fv-row mb-10">
    <label class="form-check form-check-custom form-check-solid form-check-inline">
        <input class="form-check-input" type="checkbox" name="toc" value="1" />
        <span class="form-check-label fw-bold text-gray-700 fs-6">I Agree
            <a href="#" class="ms-1 link-primary">Terms and conditions</a>.</span>
    </label>

    {!! GeneralHelper::form_error($errors, 'toc') !!}

</div>


<div class="text-center">
    <button type="submit" class="btn btn-lg btn-primary">
        <span class="indicator-label">Submit</span>
        <span class="indicator-progress">Please wait...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
    </button>
</div>

</form>


<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/authentication/sign-up/general.js')}}"></script>
