<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Analytics Dashboard">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/vendors.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/app.bundle.css') }}">

    <link rel="mask-icon" href="{{ asset('backend/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="stylesheet" href="{{ asset('backend/css/miscellaneous/reactions/reactions.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/miscellaneous/fullcalendar/fullcalendar.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/miscellaneous/jqvmap/jqvmap.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('backend/css/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/css/formplugins/select2/select2.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/datagrid/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('backend/css/notifications/toastr/toastr.css') }}">
    @livewireStyles

    <style>
        .notification {
	height: 317px !important;
}
    </style>

</head>

<body class="mod-bg-1 ">
    <div class="cover-spin"></div>

    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">
            <div class="page-content-wrapper">
                <!-- Main Content -->
                <main id="js-page-content" role="main" class="page-content">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    @include('layouts.script')
    @livewireScripts
    @yield('js')
    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 100,
                "timeOut": 5000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            @if (session('success'))
                toastr["success"]("{{ session('success') }}");
            @endif
            @if (session('error'))
                toastr["error"]("{{ session('error') }}");
            @endif

        })
    </script>
</body>

</html>
