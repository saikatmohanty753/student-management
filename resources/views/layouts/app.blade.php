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
    <link rel="stylesheet" href="{{ asset('backend/css/vendors.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/app.bundle.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/img/favicon/apple-touch-icon.png') }}">
    <link rel="mask-icon" href="{{ asset('backend/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="stylesheet" href="{{ asset('backend/css/miscellaneous/reactions/reactions.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/miscellaneous/fullcalendar/fullcalendar.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/miscellaneous/jqvmap/jqvmap.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/formplugins/select2/select2.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/datagrid/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('backend/css/notifications/toastr/toastr.css') }}">
    @livewireStyles

</head>

<body class="mod-bg-1 ">

    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">
            <!-- BEGIN Left Aside -->
            <aside class="page-sidebar">
                <div class="page-logo">
                    <a href="#"
                        class="page-logo-link press-scale-down d-flex align-items-center position-relative"
                        data-toggle="modal" data-target="#modal-shortcut">
                        <img src="{{ asset('backend/img/favicon/favicon.png') }}" alt=" Utkal University of Culture"
                            aria-roledescription="logo">
                        <span class="page-logo-text mr-1"> Utkal University of Culture</span>
                        <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                        {{-- <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i> --}}
                    </a>
                </div>
                @include('layouts.navbar')

            </aside>
            <!-- END Left Aside -->
            <div class="page-content-wrapper">
                @include('layouts.header')


                <!-- Main Content -->
                <main id="js-page-content" role="main" class="page-content">
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Student Portal</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span
                                class="js-get-date"></span></li>
                    </ol>

                    @yield('content')
                </main>

                @include('layouts.footer')
            </div>
        </div>
    </div>

    @include('layouts.bottom-icon')
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
