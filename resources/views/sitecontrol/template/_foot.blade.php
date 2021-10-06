<script>
    var DIRECTORY = '{!! $_directory !!}';
    var CONTROLLER = '{!! $_controller !!}';
    var SITE_URL = "{!! url('/') . '/'  !!}";
    var CSRF_TOKEN = "{{ csrf_token() }}";
    var EDITORS = [];
</script>

<script src="{{ asset('assets/js/custom_validations.js') }}"></script>

<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('assets/js/custom/modals/create-app.js') }}"></script>
<script src="{{ asset('assets/js/custom/modals/upgrade-plan.js') }}"></script>

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<!-- <script src="{{ asset('assets/js/apps/managepilots/table.js') }}"></script> -->
<!--end::Page Custom Javascript-->
<!--end::Javascript-->

@yield('datatable_scripts')


<script src="https://toby.tasteofblue.com/public/assets/widgets/jquery-ui-1.11.1.custom/jquery-ui.js" type="text/javascript"></script>
<link href="https://toby.tasteofblue.com/public/assets/admincms/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
<link href="https://toby.tasteofblue.com/public/assets/admincms/css/jQueryUI/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css" />


<link href="https://toby.tasteofblue.com/public/assets/admincms/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
<script src="https://toby.tasteofblue.com/public/assets/admincms/js/bootstrap-timepicker.js" type="text/javascript"></script>


<!-- <script src="{{ asset('assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script> -->

<!-- <script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script> -->

<!-- <script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script> -->
<!-- <script src="{{ asset('assets/js/custom/documentation/editors/ckeditor/classic.js') }}"></script> -->

<script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>

<script src="{{ asset('assets/js/site.js?t=' . strtotime('now') ) }}"></script>
<script src="{{ asset('assets/js/modal-form.js') }}"></script>
<script src="{{ asset('assets/js/datatable-script.js') }}"></script>


@yield('script')