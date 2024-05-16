<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Icon -->
    <script src="https://kit.fontawesome.com/b1f0352e54.js" crossorigin="anonymous"></script>

    @stack('css')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('page-title')</title>
</head>

<body data-theme>
    <header>
        <x-header></x-header>
    </header>

    <main>
        <x-toaster-hub /> <!-- 👈 -->
        @yield('content')
    </main>

    <x-footer></x-footer>

    <script type="text/javascript" src="{{ asset('assets/js/navbar-swap.js') }}"></script>
    @stack('scripts')
</body>

</html>
