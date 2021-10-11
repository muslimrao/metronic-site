@php
$attributes = array(
"method" => "post",
"enctype" => "multipart/form-data"
);
@endphp


{!! 
Form::open(
    array(
    "url" => route('manageflightshistory.save'),
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
                       

                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('pilot_id', 'Pilot', array('class' => ' required col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::select('pilot_id',
                                                DropdownHelper::pilot_dropdown( FALSE ),
                                                GeneralHelper::set_value('pilot_id',$pilot_id), ["class" =>
                                                "form-select form-control form-control-lg form-control-solid", "autocomplete" =>
                                                "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'pilot_id') !!}

                                            </div>

                                        </div>


                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('flight_number', 'Flight Number', array('class' => '
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('flight_number', GeneralHelper::set_value("flight_number", $flight_number),
                                                ["class"=> "form-control form-control-lg form-control-solid ",
                                                "placeholder" => "Flight Number", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'flight_number') !!}

                                            </div>

                                        </div>



                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('aircraft_id', 'Aircraft', array('class' => '
                                                required col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">

                                                {!! Form::select('aircraft_id',
                                                DropdownHelper::aircraft_dropdown( ),
                                                GeneralHelper::set_value('aircraft_id',$aircraft_id), ["class" =>
                                                "form-select form-control form-control-lg form-control-solid", "autocomplete" =>
                                                "off"] ) !!}


                                                {!! GeneralHelper::form_error($errors, 'aircraft_id') !!}

                                            </div>

                                        </div>



                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('report', 'Report', array('class' => '
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('report', GeneralHelper::set_value("report", $report),
                                                ["class"=> "form-control form-control-lg form-control-solid ",
                                                "placeholder" => "Report", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'report') !!}

                                            </div>

                                        </div>



                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('airport_depart', 'Airport Depart', array('class' => '
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('airport_depart', GeneralHelper::set_value("airport_depart", $airport_depart),
                                                ["class"=> "form-control form-control-lg form-control-solid ",  "data-datemode" => 'start_1',
                                                "placeholder" => "Airport Depart", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'airport_depart') !!}

                                            </div>

                                        </div>


                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('airport_arrive', 'Airport Arrive', array('class' => '
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('airport_arrive', GeneralHelper::set_value("airport_arrive", $airport_arrive),
                                                ["class"=> "form-control form-control-lg form-control-solid ", "data-datemode" => 'end_1',
                                                "placeholder" => "Airport Arrive", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'airport_arrive') !!}

                                            </div>

                                        </div>



                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('route', 'Route', array('class' => '
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('route', GeneralHelper::set_value("route", $route),
                                                ["class"=> "form-control form-control-lg form-control-solid ",
                                                "placeholder" => "Route", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'route') !!}

                                            </div>

                                        </div>



                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('status', 'Status', array('class' => '
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">

                                                {!! Form::select('status',
                                                DropdownHelper::YesNo_dropdown( ),
                                                GeneralHelper::set_value('status',$status), ["class" =>
                                                "form-select form-control form-control-lg form-control-solid", "autocomplete" =>
                                                "off"] ) !!}




                                                {!! GeneralHelper::form_error($errors, 'status') !!}

                                            </div>

                                        </div>


                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('flight_data', 'Flight Data', array('class' => '
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('flight_data', GeneralHelper::set_value("flight_data", $flight_data),
                                                ["class"=> "form-control form-control-lg form-control-solid ",
                                                "placeholder" => "Flight Data", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'flight_data') !!}

                                            </div>

                                        </div>


                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('landing_rate', 'Landing Rate', array('class' => '
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('landing_rate', GeneralHelper::set_value("landing_rate", $landing_rate),
                                                ["class"=> "form-control form-control-lg form-control-solid ",
                                                "placeholder" => "Landing Rate", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'landing_rate') !!}

                                            </div>

                                        </div>




                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('miles', 'Miles', array('class' => '
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('miles', GeneralHelper::set_value("miles", $miles),
                                                ["class"=> "form-control form-control-lg form-control-solid ",
                                                "placeholder" => "Miles", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'miles') !!}

                                            </div>

                                        </div>


                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('fuel', 'Fuel', array('class' => '
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('fuel', GeneralHelper::set_value("fuel", $fuel),
                                                ["class"=> "form-control form-control-lg form-control-solid ",
                                                "placeholder" => "Fuel", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'fuel') !!}

                                            </div>

                                        </div>



                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('flight_time', 'Flight Time', array('class' => '
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('flight_time', GeneralHelper::set_value("flight_time", $flight_time),
                                                ["class"=> "form-control form-control-lg form-control-solid ",
                                                "placeholder" => "Flight Time", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'flight_time') !!}

                                            </div>

                                        </div>



                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('passengers', 'Passengers', array('class' => '
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('passengers', GeneralHelper::set_value("passengers", $passengers),
                                                ["class"=> "form-control form-control-lg form-control-solid ",
                                                "placeholder" => "Passengers", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'passengers') !!}

                                            </div>

                                        </div>




                                       

                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between border-top pt-10">

                            
                                <div class="mr-2">
                                    {!! Html::link( route('manageflightshistory.view') , 'Cancel', array('class' => 'btn btn btn-light font-weight-bolder text-uppercase px-9 py-4')) !!}
                                </div>
                                <div>
                                    {!! Form::save( $_directory ) !!}                                
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