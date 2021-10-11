@php
$attributes = array(
"method" => "post",
"enctype" => "multipart/form-data"
);
@endphp


{!! 
Form::open(
    array(
    "url" => route("managepilots.save"),
    "method" => "post",
    "enctype" => "multipart/form-data",
    )
) 
!!}

<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-body p-0">
                <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
                    <div class="col-xl-12 col-xxl-7">
                        
                            <div class="pb-5">
                                <h3 class="mb-10 font-weight-bold text-dark">
                                    
                                    @if ( GeneralHelper::set_value("id", $id) != "" )
                                        Edit {{ $_heading }} (# {{ GeneralHelper::set_value("id", $id) }})
                                    @else 
                                        Add {{ $_heading }}
                                    @endif

                                    
                            
                                </h3>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>

                                            <div class="col-lg-9 col-xl-9">

                                                <div class="fv-row mb-7">
                                                    @php
                                                    $image_upload_array = array(
                                                    "file_input_name" => "file_user_image",
                                                    "hidden_input_name" => "user_image",
                                                    "hidden_input_value" => GeneralHelper::set_value("user_image",
                                                    $user_image),

                                                    "image_title" => "Profile Photo",
                                                    "image_types" => GeneralHelper::set_value("images_types",
                                                    $images_types),
                                                    );
                                                    @endphp

                                                    @include($admin_path . "template._image_upload",
                                                    $image_upload_array)

                                                    {!! GeneralHelper::form_error($errors, 'user_image') !!}

                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('first_name', 'First Name', array('class' => 'required
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('first_name', GeneralHelper::set_value("first_name", $first_name),
                                                ["class"=> "form-control form-control-lg form-control-solid",
                                                "placeholder" => "First Name", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'first_name') !!}

                                            </div>

                                        </div>


                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('last_name', 'Last Name', array('class' => 'required
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('last_name', GeneralHelper::set_value("last_name", $last_name),
                                                ["class"=> "form-control form-control-lg form-control-solid ",
                                                "placeholder" => "Last Name", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'last_name') !!}

                                            </div>

                                        </div>



                                        <div class="form-group row fv-plugins-icon-container mb-6">
                                            {!! Form::label('email', 'Email', array('class' => 'required col-xl-3
                                            col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('email', GeneralHelper::set_value("email", $email), ["class"=>
                                                "form-control form-control-lg form-control-solid", "placeholder" =>
                                                "Email", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'email') !!}

                                            </div>
                                        </div>




                                        <div class="form-group row fv-plugins-icon-container mb-6">
                                            {!! Form::label(
                                                            'password', 
                                                            'Password', 
                                                            array('class' => (GeneralHelper::set_value("id", $id) == '' ? ' required' : '' ) . ' col-xl-3 col-lg-3 col-form-label')
                                                            
                                                            ) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::password ('password', ["class"=> "form-control form-control-lg
                                                form-control-solid", "placeholder" => "Password", "autocomplete" =>
                                                "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'password') !!}

                                            </div>
                                        </div>




                                        <div class="form-group row fv-plugins-icon-container mb-6">
                                            {!! Form::label('pilot_role_id', 'Role', array('class' => 'required col-xl-3
                                            col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::select('pilot_role_id',
                                                DropdownHelper::pilot_roles_dropdown(),
                                                GeneralHelper::set_value('pilot_role_id',$pilot_role_id), ["class" =>
                                                "form-select form-control form-control-lg form-control-solid", "autocomplete" =>
                                                "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'pilot_role_id') !!}

                                            </div>
                                        </div>



                                        <div class="form-group row fv-plugins-icon-container mb-6">
                                            {!! Form::label('bio', 'Bio', array('class' => ' col-xl-3 col-lg-3
                                            col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('bio', GeneralHelper::set_value("bio", $bio), ["class"=>
                                                "form-control form-control-lg form-control-solid", "placeholder" =>
                                                "Bio", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'Bio') !!}

                                            </div>
                                        </div>




                                        <div class="form-group row fv-plugins-icon-container mb-6">
                                            {!! Form::label('call_sign', 'Call Sign', array('class' => '
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('call_sign', GeneralHelper::set_value("call_sign", $call_sign),
                                                ["class"=> "form-control form-control-lg form-control-solid",
                                                "placeholder" => "Call Sign", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'call_sign') !!}

                                            </div>

                                        </div>



                                        <div class="form-group row fv-plugins-icon-container mb-6">
                                            {!! Form::label('number_flights', 'Number Flights', array('class' =>
                                            ' col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('number_flights',
                                                GeneralHelper::set_value("number_flights", $number_flights), ["class"=> "form-control
                                                form-control-lg form-control-solid", "placeholder" => "Number Flights",
                                                "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'number_flights') !!}

                                            </div>

                                        </div>


                                        <div class="form-group row fv-plugins-icon-container mb-6">
                                            {!! Form::label('vatsim_id', 'Vatsim ID', array('class' => '
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('vatsim_id', GeneralHelper::set_value("vatsim_id", $vatsim_id),
                                                ["class"=> "form-control form-control-lg form-control-solid",
                                                "placeholder" => "Vatsim ID", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'vatsim_id') !!}

                                            </div>
                                        </div>

                                        <div class="form-group row fv-plugins-icon-container mb-6">
                                            {!! Form::label('hub_id', 'Hub', array('class' => '
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::select('hub_id',
                                                DropdownHelper::hub_dropdown(),
                                                GeneralHelper::set_value('hub_id',$hub_id), ["class" =>
                                                "form-select form-control form-control-lg form-control-solid", "autocomplete" =>
                                                "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'hub_id') !!}

                                            </div>
                                        </div>

                                        <div class="form-group row fv-plugins-icon-container mb-6">
                                            {!! Form::label('rank_id', 'Rank', array('class' => '
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::select('rank_id',
                                                DropdownHelper::rank_dropdown(FALSE),
                                                GeneralHelper::set_value('rank_id',$rank_id), ["class" =>
                                                "form-select form-control form-control-lg form-control-solid", "autocomplete" =>
                                                "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'rank_id') !!}

                                            </div>
                                        </div>


                                        <div class="form-group row fv-plugins-icon-container mb-6">
                                            {!! Form::label('notifications', 'Notifications', array('class' => '
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('notifications',
                                                GeneralHelper::set_value("notifications", $notifications), ["class"=> "form-control
                                                form-control-lg form-control-solid", "placeholder" => "Notifications",
                                                "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'notifications') !!}

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between border-top pt-10">

                            
                                <div class="mr-2">
                                    {!! Html::link( route("managepilots.view") , 'Cancel', array('class' => 'btn btn btn-light font-weight-bolder text-uppercase px-9 py-4')) !!}
                                </div>
                                <div>
                                    {!! Form::save( $_controller ) !!}                                
                                </div>
                            </div>
                            <div></div>
                            <div></div>
                            <div></div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


{!! Form::options( GeneralHelper::set_value("option", "$option") ) !!}
<input type="hidden" name="id" value="{{ GeneralHelper::set_value("id", $id) }}">


{!! Form::close() !!}