<div class="card mb-9">
    <div class="card-body pt-9 pb-0">

        <div class="d-flex flex-wrap flex-sm-nowrap mb-6">

            <div
                class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                <img class="mw-50px mw-lg-75px" src="{{ asset( get_airline_DATA('logo') ) }}" alt="image" />
            </div>


            <div class="flex-grow-1">

                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">

                    <div class="d-flex flex-column">

                        <div class="d-flex align-items-center mb-1">
                            <a href="#"
                                class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3">{{ get_airline_DATA('airline_name') }}</a>
                            <span class="badge badge-light-success me-auto">{{ $site_owner->full_name }}</span>
                        </div>


                        <div class="d-flex flex-wrap fw-bold mb-4 fs-5 text-gray-400">
                            {!! get_airline_DATA('about') !!}
                        </div>

                    </div>



                </div>


                <div class="d-flex flex-wrap justify-content-start">

                    <div class="d-flex flex-wrap">

                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="fs-4 fw-bolder">{{ $registered_users_count->get()->count() }}</div>
                            </div>
                            <div class="fw-bold fs-6 text-gray-400"># Registered Users</div>
                        </div>


                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">

                            <div class="d-flex align-items-center">
                                <div class="fs-4 fw-bolder">{{ $selected_aircrafts_count->get()->count() }}</div>
                            </div>


                            <div class="fw-bold fs-6 text-gray-400">Selected Aircrafts</div>

                        </div>



                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">

                            <div class="d-flex align-items-center">
                                <div class="fs-4 fw-bolder">{{ $user_roles_count->get()->count() }}</div>
                            </div>


                            <div class="fw-bold fs-6 text-gray-400"># User Role</div>

                        </div>




                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">

                            <div class="d-flex align-items-center">
                                <div class="fs-4 fw-bolder">{{ $ranks_count->get()->count() }}</div>
                            </div>


                            <div class="fw-bold fs-6 text-gray-400"># Ranks</div>

                        </div>


                    </div>

                    <!-- 
                    <div class="symbol-group symbol-hover mb-3">

                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Alan Warden">
                            <span class="symbol-label bg-warning text-inverse-warning fw-bolder">A</span>
                        </div>


                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Michael Eberon">
                            <img alt="Pic" src="assets/media/avatars/150-12.jpg" />
                        </div>


                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                            title="Michelle Swanston">
                            <img alt="Pic" src="assets/media/avatars/150-13.jpg" />
                        </div>


                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Francis Mitcham">
                            <img alt="Pic" src="assets/media/avatars/150-5.jpg" />
                        </div>


                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Susan Redwood">
                            <span class="symbol-label bg-primary text-inverse-primary fw-bolder">S</span>
                        </div>


                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Melody Macy">
                            <img alt="Pic" src="assets/media/avatars/150-3.jpg" />
                        </div>


                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Perry Matthew">
                            <span class="symbol-label bg-info text-inverse-info fw-bolder">P</span>
                        </div>


                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Barry Walter">
                            <img alt="Pic" src="assets/media/avatars/150-7.jpg" />
                        </div>


                        <a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_view_users">
                            <span class="symbol-label bg-dark text-inverse-dark fs-8 fw-bolder" data-bs-toggle="tooltip"
                                data-bs-trigger="hover" title="View more users">+42</span>
                        </a>

                    </div> -->

                </div>

            </div>

        </div>

        <div class="separator"></div>


        <div class="d-flex overflow-auto h-55px">

            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">

                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ $active_user_groups == true ? 'active' : '' }}" href="../../demo2/dist/pages/projects/project.html">User Groups</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ $active_ranks == true ? 'active' : '' }}" href="{{ route('managesitesettings.ranks.view') }}">Ranks</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ $active_aircraft == true ? 'active' : '' }}" href="{{ route('managesitesettings.aircraft.view') }}">Aircraft</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ $active_overview == true ? 'active' : '' }}"
                        href="../../demo2/dist/pages/projects/settings.html">Project Settings</a>
                </li>

            </ul>

        </div>



    </div>
</div>
