<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ URL::to('/') }}" class="brand-link" target="_blank">
        <img src="{{ asset(config('constants.LOGO_IMG')) }}" class="brand-image img-circle elevation-3" height="50"
            style="opacity:0.8" alt="AdminLTE">
        <span class="brand-text font-weight-light"><b>{{ Session::get("SiteSetting.ADMIN_TITLE") != "" ? Session::get("SiteSetting.ADMIN_TITLE") : 'DOT FMC ADMIN PANEL' }}</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->



        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">

                @if ( Session::get('logged_in_user_image') != "" )
                <img src="{!! URL::to(Session::get('logged_in_user_image')) !!}" class="img-circle elevation-2"
                    alt="User Image" />
                @endif

            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::guard('admin')->user()->first_name }} {{ Auth::guard('admin')->user()->last_name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard.view') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{trans("general_lang.left_menu_dashboard")}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('viewCompany') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{trans("general_lang.left_menu_manage_companies")}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('viewRepresentative') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{trans("general_lang.left_menu_manage_representatives")}}
                        </p>
                    </a>
                </li> 
                <li class="nav-item">
                    <a href="{{ route('viewTruckDriver') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{trans("general_lang.left_menu_manage_truck_driver")}}
                        </p>
                    </a>
                </li> 


                <li class="nav-item">
                    <a href="{!! URL::to( $admin_path . 'managefaqs/view') !!}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{trans("general_lang.left_menu_manage_faqs")}}
                        </p>
                    </a>
                </li> 


                <li class="nav-item">
                    <a href="{!! URL::to( $admin_path . 'managecmspages/view') !!}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{trans("general_lang.left_menu_manage_cms_page")}}
                        </p>
                    </a>
                </li> 



                </li>

                <li class="nav-header"><strong>TOOLS / SETTINGS</strong></li>

                <li class="nav-item">
                    <a href="{!! URL::to( $admin_path . 'manageconfigurationsettings/view') !!}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>{{trans("general_lang.left_menu_manage_configuration_settings")}}</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{!! URL::to( $admin_path . 'managemyaccount/view') !!}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{trans("general_lang.left_menu_manage_my_account")}}
                        </p>
                    </a>
                </li>
                <!--
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Tools / Settings <i class="fas fa-angle-left right"></i></p>
                    </a>

                    <ul class="nav nav-treeview" style="display: none;">

                    
                        


                    </ul>
                </li>
                -->

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>