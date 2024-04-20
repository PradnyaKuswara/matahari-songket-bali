<!DOCTYPE html>
<html lang="en" data-sidebar-color="" data-topbar-color="" data-sidebar-view="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

    <!-- App css -->
    <link href="{{ asset('assets/lunoz/css/theme.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/lunoz/css/icons.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Head Js -->
    <script src="{{ asset('assets/lunoz/js/head.js') }}"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('css')
</head>

<body>
    <div class="app-wrapper">

        <x-dashboard.sidebar></x-dashboard.sidebar>

        <div class="app-content">

            <x-dashboard.topbar></x-dashboard.topbar>

            <main class="p-6">
                @yield('content')
            </main>

            <x-dashboard.footer></x-dashboard.footer>
        </div>
        <!-- End Page content -->

    </div>

    <!-- Plugin Js -->
    <script src="{{ asset('assets/lunoz/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/lunoz/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/lunoz/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/lunoz/libs/@frostui/tailwindcss/frostui.js') }}"></script>

    <!-- App Js -->
    <script src="{{ asset('assets/lunoz/js/app.js') }}"></script>

    <!-- Apexcharts js -->
    <script src="{{ asset('assets/lunoz/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Morris Js-->
    <script src="{{ asset('assets/lunoz/libs/morris.js/morris.min.js') }}"></script>

    <!-- Raphael Js-->
    <script src="{{ asset('assets/lunoz/libs/raphael/raphael.min.js') }}"></script>

    <!-- Dashboard Project Page js -->
    <script src="{{ asset('assets/lunoz/js/pages/dashboard.js') }}"></script>

</body>

</html>
