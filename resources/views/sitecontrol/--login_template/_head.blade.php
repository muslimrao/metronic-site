<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $_pagetitle }} {!! Config::get('constants.SITE_TITLE') !!}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <script>
            var SITE_KEY                                = "SITE_KEY";
    </script>
    <style>
        .protected-note > p {
                color: #b9bcbe;
                font-weight: 100;
                /* font-family: Montserrat-Medium; */
            }

            .protected-note {
                padding: 5px 10px;
            }

            .card {
                margin-bottom: 0px !important;
            }
    </style>
    @include("sitecontrol.login_template._includes")
</head>