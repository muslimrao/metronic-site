@include($admin_path . "/template._head")

<?php

use App\Http\Helpers\GeneralHelper;

$_header_bg_image =  asset('assets/media/patterns/header-bg.jpg');
if ( GeneralHelper::is_localhost() and get_airline_ID() == 2 )
{
    $_header_bg_image =  asset('assets/media/patterns/header-bg-dark.png');
}
?>
<body id="kt_body" style="background-image: url({{ $_header_bg_image }})"
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">

    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">

            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

                @include($admin_path . "/template._header")
                @include($admin_path . "/template._toolbar")


                <!--begin::Container-->
                <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                    <!--begin::Post-->
                    <div class="content flex-row-fluid" id="kt_content">

                        @include("sitecontrol.template._show_messages")



                        <!-- Page View -->
                        @include($_pageview)

                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Container-->



                @include($admin_path . "/template._footer")




            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->


    @include($admin_path . "/template._footer_sections")
    @include($admin_path . "/template._foot")





</body>
<!--end::Body-->

</html>