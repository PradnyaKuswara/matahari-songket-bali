<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/theme-change@2.0.2/index.js"></script>
    @stack('css')


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('page-title')</title>
</head>

<body data-theme>
    <header>
        <x-header></x-header>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>

    </footer>

    <script src="{{ asset('assets/js/color-mode.js') }}"></script>
    <script src="{{ asset('assets/js/navbar-swap.js') }}"></script>
    <script src="{{ asset('assets/js/hero-swap.js') }}"></script>
    @stack('script')
</body>

</html>
