<script src="{{ URL::asset('/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('/bootstrap/js/adminlte.min.js')}}"></script>
@if(Config::get("constants.APP_ENV") == "production")
    <script src="https://www.google.com/recaptcha/api.js?render={{ $SITE_KEY }}"></script>
@endif