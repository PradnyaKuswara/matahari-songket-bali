<!DOCTYPE html>
<html lang="en">

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
</head>

<body>
    <div class="app-wrapper">

        <div class="app-content">
            <main>
                @yield('content')
            </main>

        </div>
</body>

</html>
