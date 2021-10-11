@php
$attributes = array(
"method" => "post",
"enctype" => "multipart/form-data"
);
@endphp


{!! 
Form::open(
    array(
    "url" => route("managerolespermissions.save"),
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
                    <div class="col-xl-12 col-xxl-12">
                        
                            <div class="pb-5">
                                <h3 class="mb-10 font-weight-bold text-dark">{{ $_heading }} Details:</h3>
                                <div class="row">
                                    <div class="col-xl-12">

                                
                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            {!! Form::label('pilot_role', 'Pilot Role', array('class' => 'required
                                            col-xl-3 col-lg-3 col-form-label')) !!}
                                            <div class="col-lg-9 col-xl-9">

                                                @if ( GeneralHelper::set_value("id", $id) != "" )
                                                    {!! Form::select('pilot_role_id', DropdownHelper::pilot_roles_dropdown(TRUE, array( array( 'id', $pilot_role_id ))  ) , GeneralHelper::set_value('pilot_role_id', $pilot_role_id), ["class" => "form-control"] ) !!}
                                                @else 
                                                    {!! Form::select('pilot_role_id', DropdownHelper::pilot_roles_dropdown(false, array( array("slug", "!=", "owner")), array(array("id",  $_already_roles_added)) ) , GeneralHelper::set_value('pilot_role_id', $pilot_role_id), ["class" => "form-control"] ) !!}
                                                @endif

                                                


                                                {!! GeneralHelper::form_error($errors, 'pilot_role_id') !!}

                                            </div>

                                        </div>


                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                        {!! Form::label('redirect_after_login', 'Redirect After Login', array('class' => 'required
                                        col-xl-3 col-lg-3 col-form-label')) !!}
                                        <div class="col-lg-9 col-xl-9">

                                            {!! Form::select('redirect_after_login', $redirect_after_login_dropdown , GeneralHelper::set_value('redirect_after_login', $redirect_after_login), ["class" => "form-control"] ) !!}

                                            


                                            {!! GeneralHelper::form_error($errors, 'redirect_after_login') !!}

                                        </div>

                                        </div>



                                        <div class="form-group row fv-plugins-icon-container mb-6">

                                            
                                            @if (count($_left_pages_array) > 0 )
                                            <table width="100%" class="table table-hover">
                                                <tr>
                                                    <td>&nbsp;</td>
                                                
                                                    @foreach (GeneralHelper::role_permissions_operations() as $k => $v)
                                                        <td align="center"><strong>{!! ucfirst($v) !!}</strong></td>
                                                    @endforeach
                                                    
                                                    <td align="center"><strong>EXTRA options</strong></td>
                                                    
                                                </tr>
                                                
                                            
                                                @foreach ($_left_pages_array as $page )
                                                <tr>
                                                    <td><strong>{!! $page['text'] !!}</strong></td>
                                                    
                                                    @foreach (GeneralHelper::role_permissions_operations() as $k => $v)
                                                        <td align="center">
                                                            <?php $is_show 				= '' ?>
                                                            @if ( $v == "show" )
                                                                <?php $is_show 			= 'is_show' ?>
                                                            @endif
                                                            
                                                            
                                                            
                                                            <!-- check to check textbox in dont_include KEY -->
                                                            <?php $draw_textbox 		= TRUE ?>
                                                        
                                                            
                                            
                                                            @if ( array_key_exists("dont_include", $page ) )
                                                                
                                                                @if ( in_array($v, $page['dont_include'] ) )
                                                                    <?php $draw_textbox					= FALSE ?>
                                                                    
                                                                    
                                                                @endif
                                                            @endif
                                                            
                                                            
                                                            
                                                            @if ( $draw_textbox )
                                                                
                                                                {!! Form::checkbox ("tableArray[{$page['directory']}][$v]", 1 , GeneralHelper::set_value("tableArray.{$page['directory']}.$v", $tableArray[$page['directory']][$v]  ) , ["class"=> "form-control form-check-input $is_show"] ) !!}
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                    
                                                    <td>
                                                    
                                                    @if ( array_key_exists("extra_conditions", $page) )
                                                        @foreach ( $page['extra_conditions'] as $index => $conditions )
                                                            
                                                            @if ( $conditions['input_type'] == "multiple_select" )
                                                            
                                                                <table class="table ">
                                                                    <tr>
                                                                        <td align="center">
                                                                        <strong><small>{!! $conditions['text'] !!}</small></strong>
                                                                        <br />
                                                                        <div class="input-group col-xs-12" style="text-align:center">
                                                                        {!! Form::select("tableArray[{$page['directory']}][extra_condition][{$conditions['key']}][]", DropdownHelper::roles_dropdown(TRUE) , GeneralHelper::set_value("tableArray.{$page['directory']}.extra_condition.{$conditions['key']}", $tableArray[$page['directory']]['extra_condition'][$conditions['key']]), ["class" => "form-control", "size" => "5", "multiple" => "multiple"] ) !!}
                                                                        </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            @elseif ( $conditions['input_type'] == "single_checkbox" )
                                                            
                                                                <table class="table ">
                                                                    <tr>
                                                                        <td align="center">
                                                                        <strong><small>{!! $conditions['text'] !!}</small></strong>
                                                                        <br />
                                                                        <div class="input-group col-xs-12" style="text-align:center;">
                                                                        {!! Form::checkbox ("tableArray[{$page['directory']}][extra_condition][{$conditions['key']}]", 1 , GeneralHelper::set_value("tableArray.{$page['directory']}.extra_condition.{$conditions['key']}", $tableArray[$page['directory']]['extra_condition'][$conditions['key']]) , ["class"=> "form-control "] ) !!}
                                                                        </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            @else
                                                            
                                                            
                                                            
                                                            @endif
                                                            
                                                            
                                                            
                                                            
                                                        @endforeach
                                                        
                                                        
                                                    @endif
                                                    </td>

                                                </tr>
                                                @endforeach
                                                
                                                
                                            


                                            </table>
                                    
                                            @endif
                                        
                                        </div>




                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between border-top pt-10">

                            
                                <div class="mr-2">
                                    {!! Html::link( route( "managerolespermissions.view" ), 'Cancel', array('class' => 'btn btn btn-light font-weight-bolder text-uppercase px-9 py-4')) !!}
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