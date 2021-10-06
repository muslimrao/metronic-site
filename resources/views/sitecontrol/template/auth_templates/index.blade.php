<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="{!! url('/') !!}">
    <title>{{ $_pagetitle }} {{ get_airline_DATA('airline_name') }}</title>
    <meta name="description"
        content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ get_airline_DATA('airline_name') }}" />
    <link rel="canonical" href="{{ url()->current()  }}" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>


<body id="kt_body" class="bg-body">

    <div class="d-flex flex-column flex-root">

       

        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
            style="background-image: url({{ asset('assets/media/illustrations/sigma-1/14.png') }}">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <a href="{{ URL::to('/') }}" class="mb-12">
                    <img alt="Logo" src="{{ asset( get_airline_DATA('logo') ) }}" class="h-40px" />
                </a>


                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">


                    @include($_pageview)

                </div>


                </div>

            <div class="d-flex flex-center flex-column-auto p-10">

                <div class="d-flex align-items-center fw-bold fs-6">
                    <a href="{{ route('dashboard.view') }}" class="text-muted text-hover-primary px-2">Dashboard</a>
                    <a href="{{ route('about-us.view') }}" class="text-muted text-hover-primary px-2">About Us</a>

                </div>
            </div>
        </div>
    </div>

</body>

</html>