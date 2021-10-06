@if ( $_show_default_title )
	@if ( $_pagetitle != "" )
		@php ($_pagetitle		.= " - ")	
	@endif
    
    
    @php ($_pagetitle				.= Session::get('site_settings.SITE_TITLE') )
    
@else

	@php ($_pagetitle				.= "")
    
@endif
<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
    <base href="{!! URL::to('/') !!}" />

    <title>{!! $_pagetitle !!} {{ get_airline_DATA('airline_name')  }}</title>
    <meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    
    @include("frontend.template._includes_head")

</head>