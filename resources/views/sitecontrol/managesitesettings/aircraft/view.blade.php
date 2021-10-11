@include( $_root_dir . '_common_header')

{!!
Form::open(
array(
"url" => route('managesitesettings.options'),
"method" => "post",
"enctype" => "multipart/form-data",
)
)
!!}


<div class="card">

    <div class="card-header">

        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                            transform="rotate(45 17.0365 15.1223)" fill="black" />
                        <path
                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                            fill="black" />
                    </svg>
                </span>
                <input type="text" data-kt-user-table-filter="search"
                    class="form-control form-control-solid w-250px ps-14" placeholder="Search Aircraft" />
            </div>

        </div>


        <div class="card-toolbar">

            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

               {!! Form::add( route('managesitesettings.aircraft.add') , $_controller, $_heading ) !!}



            </div>


            <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                <div class="fw-bolder me-5">
                    <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
                </div>

        
                {!! Form::delete_selected( $_controller, 'delete_selected_aircraft' ) !!}       


            </div>







        </div>

    </div>


    <div class="card-body pt-0">

        <table class="table align-middle table-row-dashed fs-6 gy-5 datatable " id="kt_table_users">

            <thead>

                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">

                    @if ( RoleManagement::if_Allowed( $_controller, 'delete' ) )
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" name="select_all" value="1" />
                        </div>
                    </th>
                    @endif

                    <th class="">Aircraft Name</th>

                    @if ( RoleManagement::if_Allowed( $_controller, 'edit' ) || RoleManagement::if_Allowed( $_controller, 'delete' ) )
                        <th class="text-end min-w-100px">Actions</th>
                    @endif
                </tr>

            </thead>


            <tbody class="text-gray-600 fw-bold">


                @foreach ($table_record->get() as $result)
                <tr>

                    @if ( RoleManagement::if_Allowed( $_controller, 'delete' ) )
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" name="checkbox_options[]" type="checkbox"
                                value="{!! $result->id !!}" />
                        </div>
                    </td>
                    @endif


                    <td>{!! $result->aircraft_name !!}</td>



                    @if ( RoleManagement::if_Allowed( $_controller, 'edit' ) || RoleManagement::if_Allowed( $_controller, 'delete' ) )
                    <td class="text-end">
                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">Actions

                            <span class="svg-icon svg-icon-5 m-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                        fill="black" />
                                </svg>
                            </span>
                        </a>

                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                            data-kt-menu="true">

                            {!! Form::edit(  url( route('managesitesettings.aircraft.edit', array("aircraft_id" => $result->id )) ), $_controller ) !!} 

                            
                            {!! Form::delete_single( $_controller, 'delete_aircraft' ) !!} 


                        </div>

                    </td>
                    @endif

                </tr>

                @endforeach
            </tbody>

        </table>

    </div>



</div>


{!! Form::options( GeneralHelper::set_value("option", "$option") ) !!}


{!! Form::close() !!}