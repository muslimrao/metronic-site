@if ($_messageBundle !== FALSE)

    @if ( ($_messageBundle['_TEXT_show_messages'] != '') and ($_messageBundle['_ALERT_mode'] == "") )

    <!--begin::Alert-->
    <div class="alert alert-{{ $_messageBundle['_CSS_show_messages'] }}">
        <!--begin::Icon-->
        
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column">
            <!--begin::Title-->
            <h4 class="mb-1 text-dark">{{ $_messageBundle['_HEADING_show_messages'] }}</h4>
            <!--end::Title-->
            <!--begin::Content-->
            <span>{!! $_messageBundle['_TEXT_show_messages'] !!}</span>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Alert-->

    @elseif (Session::has('_flash_data_inline') and Session::has('_flash_messages_content') != "")

    <!--begin::Alert-->
    <div class="alert alert-{{Session::get('_flash_messages_type')}}">
        <!--begin::Icon-->
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column">
            <!--begin::Title-->
            <h4 class="mb-1 text-dark">{{Session::get('_flash_messages_title')}}</h4>
            <!--end::Title-->
            <!--begin::Content-->
            <span>{!! Session::get('_flash_messages_content') !!}</span>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Alert-->

    @endif

@endif