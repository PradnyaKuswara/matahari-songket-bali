<!DOCTYPE html>
<html lang="en" data-sidebar-color="light" data-topbar-color="dark" data-sidebar-view="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    <title>@yield('title')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo_icon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Icon -->
    <script src="https://kit.fontawesome.com/b1f0352e54.js" crossorigin="anonymous"></script>

    <script async src="https://www.google.com/recaptcha/api.js"></script>
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            font-weight: 400
        }

        .btn {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class=" lg:h-screen w-screen flex justify-center items-center">
    <x-toaster-hub /> <!-- 👈 -->
    <div class="2xl:w-1/2 xl:w-7/12 lg:w-10/12 md:w-10/12 w-full">
        @yield('content')
    </div>

    @stack('scripts')
</body>

</html>
