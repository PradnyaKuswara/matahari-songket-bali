<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo_icon.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" type="text/css" media="screen"
        href="{{ asset('assets/vristo/assets/css/perfect-scrollbar.min.css') }}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/vristo/assets/css/style.css') }}" />
    <link defer rel="stylesheet" type="text/css" media="screen"
        href="{{ asset('assets/vristo/assets/css/animate.css') }}" />
    <script src="{{ asset('assets/vristo/assets/js/perfect-scrollbar.min.js') }}"></script>
    {{-- <script defer src="{{ asset('assets/vristo/assets/js/perfect-scrollbar.min.js') }}"></script> --}}
    <script defer src="{{ asset('assets/vristo/assets/js/popper.min.js') }}"></script>
    <script defer src="{{ asset('assets/vristo/assets/js/tippy-bundle.umd.min.js') }}"></script>
    <script defer src="{{ asset('assets/vristo/assets/js/sweetalert.min.js') }}"></script>

    @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])

    @stack('css')
</head>

<body x-data="main" class="relative overflow-x-hidden font-nunito text-sm font-normal antialiased"
    :class="[$store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme === 'dark' || $store.app.isDarkMode ? 'dark' : '',
        $store.app.menu, $store.app.layout, $store.app.rtlClass
    ]">

    <div class="main-container min-h-screen text-black dark:text-white-dark" :class="[$store.app.navbar]">
        <div class="main-content flex min-h-screen flex-col">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('assets/vristo/assets/js/alpine-collaspe.min.js') }}"></script>
    <script src="{{ asset('assets/vristo/assets/js/alpine-persist.min.js') }}"></script>
    <script defer src="{{ asset('assets/vristo/assets/js/alpine-ui.min.js') }}"></script>
    <script defer src="{{ asset('assets/vristo/assets/js/alpine-focus.min.js') }}"></script>
    <script defer src="{{ asset('assets/vristo/assets/js/alpine.min.js') }}"></script>
    <script src="{{ asset('assets/vristo/assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/alpine-init.js') }}"></script>
</body>

</html>
