@extends('sitecontrol.login_template.master')
@section('_pageview') 
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg"></p>
        <form method="post" action="{{ route('getchangepassword').'?'.$forgot_password_token_field.'='.$forgot_password_token }}">
            @csrf
            <small class="text-danger">{{ 'Password must be atleast 8 characters long.' }}</small>
            <div class="input-group mb-3">
            <input type="hidden" name="AdminID" class="form-control" value="{{ GeneralHelper::set_value('AdminID',$AdminID) }}">
                <input type="password" name="Password" class="form-control" placeholder="Password*">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                <div class="input-group mb-3">
                    {!! GeneralHelper::form_error($errors, 'Password') !!}
                </div>
            </div> 
            <div class="input-group mb-3">
            <input type="password" name="Confirm_Password" class="form-control" placeholder="Confirm Password*">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                <div class="input-group mb-3">
                    {!! GeneralHelper::form_error($errors, 'Confirm_Password') !!}
                    {!! GeneralHelper::form_error($errors, 'recaptcha') !!}
                </div>
            </div> 
            <div class="row"> 
                    <div class="col-12">
                        <input type="hidden" name="recaptcha" id="_recaptcha">
                        <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                    </div> 
                </div>
        </form> 
    </div>
</div> 

@endsection