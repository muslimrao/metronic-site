<div class="content flex-row-fluid" id="kt_content">

    @php
    $attributes = array(
    "method" => "post",
    "enctype" => "multipart/form-data"
    );
    @endphp


    {!! Form::open(
    array(
    "url" => $_directory.'options',
    "method" => "post",
    "enctype" => "multipart/form-data",
    "id" => "datatable_form"
    )
    ) !!}
    <div class="card">

        <div class="card-header border-0 pt-6">

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
                        class="form-control form-control-solid w-250px ps-14" placeholder="Search {!! $_heading !!}" />
                </div>

            </div>


            <div class="card-toolbar">

                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                    <!-- <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">

                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                        fill="black" />
                                </svg>
                            </span>
                            Filter</button>

                        <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">

                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                            </div>


                            <div class="separator border-gray-200"></div>


                            <div class="px-7 py-5" data-kt-user-table-filter="form">

                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">Role:</label>
                                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                        data-placeholder="Select option" data-allow-clear="true"
                                        data-kt-user-table-filter="role" data-hide-search="true">
                                        <option></option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Analyst">Analyst</option>
                                        <option value="Developer">Developer</option>
                                        <option value="Support">Support</option>
                                        <option value="Trial">Trial</option>
                                    </select>
                                </div>


                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">Two Step Verification:</label>
                                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                        data-placeholder="Select option" data-allow-clear="true"
                                        data-kt-user-table-filter="two-step" data-hide-search="true">
                                        <option></option>
                                        <option value="Enabled">Enabled</option>
                                    </select>
                                </div>


                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6"
                                        data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset</button>
                                    <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true"
                                        data-kt-user-table-filter="filter">Apply</button>
                                </div>

                            </div>

                        </div> -->



                    <!-- <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_export_users">

                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1"
                                        transform="rotate(90 12.75 4.25)" fill="black" />
                                    <path
                                        d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z"
                                        fill="black" />
                                    <path
                                        d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z"
                                        fill="#C4C4C4" />
                                </svg>
                            </span>
                            Export</button> -->

                    
                    {!! Form::add( url($_directory . 'controls/add'), $_controller, $_heading ) !!}



                </div>


                <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                    <div class="fw-bolder me-5">
                        <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
                    </div>

                    {!! Form::delete_selected( $_controller ) !!}       

                </div>


                <div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered mw-650px">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h2 class="fw-bolder">Export Users</h2>


                                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                    data-kt-users-modal-action="close">

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


                                <div class="fv-row mb-10">

                                    <label class="fs-6 fw-bold form-label mb-2">Select Roles:</label>


                                    <select name="role" data-control="select2" data-placeholder="Select a role"
                                        data-hide-search="true" class="form-select form-select-solid fw-bolder">
                                        <option></option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Analyst">Analyst</option>
                                        <option value="Developer">Developer</option>
                                        <option value="Support">Support</option>
                                        <option value="Trial">Trial</option>
                                    </select>

                                </div>


                                <div class="fv-row mb-10">

                                    <label class="required fs-6 fw-bold form-label mb-2">Select Export
                                        Format:</label>


                                    <select name="format" data-control="select2" data-placeholder="Select a format"
                                        data-hide-search="true" class="form-select form-select-solid fw-bolder">
                                        <option></option>
                                        <option value="excel">Excel</option>
                                        <option value="pdf">PDF</option>
                                        <option value="cvs">CVS</option>
                                        <option value="zip">ZIP</option>
                                    </select>

                                </div>


                                <div class="text-center">
                                    <button type="reset" class="btn btn-light me-3"
                                        data-kt-users-modal-action="cancel">Discard</button>
                                    <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>



                            </div>

                        </div>

                    </div>

                </div>






            </div>

        </div>


        <div class="card-body pt-0">

            <table class="table align-middle table-row-dashed fs-6 gy-5 datatable " id="">

                <thead>

                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">

                        @if ( RoleManagement::if_Allowed( $_controller, 'delete' ) )
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">

                                    <input class="form-check-input" type="checkbox" name="select_all" value="1" />
                                </div>
                            </th>
                        @endif


                        <th class="">Flight Number</th>
                        <th class="">Pilot Name</th>
                        <th class="">Aircraft</th>
                        <th class="">Airport Depart</th>
                        <th class="">Airport Arrive</th>
                        <th class="">Flight Time</th>
                        <th class="">Status</th>

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

                        <td>{!! $result->flight_number !!}</td>

                        <td>{!! $result->pilot_name !!}</td>


                        <td>{!! $result->aircraft_name !!}</td>

                      
                        <td>{!! GeneralHelper::format_date( $result->airport_depart, "d-m-Y") !!}</td>
                        <td>{!! GeneralHelper::format_date( $result->airport_arrive, "d-m-Y") !!}</td>

                        <td>{!!  $result->flight_time !!}</td>

                        <td>{!! DropdownHelper::YesNo_dropdown($result->status) !!}</td>


                        @if ( RoleManagement::if_Allowed( $_controller, 'edit' ) || RoleManagement::if_Allowed( $_controller, 'delete' ) )
                        <td class="text-end">
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions

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

                                {!! Form::edit(  url( $_directory . 'edit/' . $result->id ), $_controller ) !!} 
                                {!! Form::delete_single( $_controller ) !!} 


                            </div>

                        </td>
                        @endif

                    </tr>

                    @endforeach
                </tbody>

            </table>

        </div>

    </div>


    {!! Form::options('') !!}

    {!! Form::close() !!}



    <!-- Modal Form  -->
    @include( "sitecontrol.template.modal.index", array( "_modal_form_file" => $_directory . "edit", "_modal_form_id" =>
    "pilotForm", "_modal_form_url" => $_directory . "save" ))
</div>