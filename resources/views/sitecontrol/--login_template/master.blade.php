<!DOCTYPE html>
<html>
@include("sitecontrol.login_template._head")

<body class="hold-transition login-page">

    <div class="login-box">
        <div class="row">
            <div class="col-md-12">
                @include("sitecontrol.template._show_messages")
            </div>
        </div>
        <div class="login-logo">
            <a href="{{ URL::to('/') }}">
                <img src="{{ asset(config('constants.LOGO_IMG')) }}" height="50">
                <b>DOT</b> FMC
            </a>
        </div>
        @yield('_pageview')
    </div>

    @include("sitecontrol.login_template._footer")

</body>

</html>