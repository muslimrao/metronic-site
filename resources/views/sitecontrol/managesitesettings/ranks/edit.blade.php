@include( $_root_dir . '_common_header')


{!! 
Form::open(
    array(
    "url" => route('managesitesettings.ranks.save'),
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

                                            {!! Form::label('rank_name', 'Rank Name', array('class' => 'required
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::text ('rank_name', GeneralHelper::set_value("rank_name", $rank_name),
                                                ["class"=> "form-control form-control-lg form-control-solid",
                                                "placeholder" => "", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'rank_name') !!}

                                            </div>

                                        </div>


                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('hours_to_rank', 'Hours to Rank', array('class' => 'required
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::number ('hours_to_rank', GeneralHelper::set_value("hours_to_rank", $hours_to_rank),
                                                [ "class"=> "form-control form-control-lg form-control-solid",
                                                "placeholder" => "", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'hours_to_rank') !!}

                                            </div>

                                        </div>

                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('num_flights', 'Number of Flights', array('class' => 'required
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">
                                                {!! Form::number ('num_flights', GeneralHelper::set_value("num_flights", $num_flights),
                                                ["class"=> "form-control form-control-lg form-control-solid",
                                                "placeholder" => "", "autocomplete" => "off"] ) !!}

                                                {!! GeneralHelper::form_error($errors, 'num_flights') !!}

                                            </div>

                                        </div>


            


                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between border-top pt-10">

                            
                                <div class="mr-2">
                                    {!! Html::link( route('managesitesettings.ranks.view'), 'Cancel', array('class' => 'btn btn btn-light font-weight-bolder text-uppercase px-9 py-4')) !!}
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