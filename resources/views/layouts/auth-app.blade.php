<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="Analytics Dashboard">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="{{ asset('backend/css/vendors.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/app.bundle.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('backend/img/favicon/favicon.png') }}">
    <link rel="mask-icon" href="{{ asset('backend/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="stylesheet" href="{{ asset('backend/css/miscellaneous/reactions/reactions.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/miscellaneous/fullcalendar/fullcalendar.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/miscellaneous/jqvmap/jqvmap.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('/backend/css/page-login.css') }}">
    <style>
        #mydiv {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            position: fixed;
        }
        .bg-img {
            position: fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>

<body class="hold-transition theme-primary bg-img" style="background-image: url({{ asset('backend/img/bg-16.jpg') }})">
    @yield('content')
    </div>
    {{-- @endsection --}}


    <script src="{{ asset('backend/js/vendors.bundle.js') }}"></script>
    <script src="{{ asset('backend/js/app.bundle.js') }}"></script>
</body>

</html>
