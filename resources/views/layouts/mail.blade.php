<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/lunoz/images/favicon.ico') }}">

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

            <div class="hero p-20 md:p-32"
                style="background-image: url({{ asset('assets/images/hero2.jpg') }});">
                <div class="hero-overlay bg-opacity-60"></div>
                {{-- <div class="hero-content text-center text-neutral-content">
                    <div class="max-w-md">
                        <h1 class="mb-5 text-5xl font-bold">Hello there</h1>
                        <p class="mb-5">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi
                            exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
                        <button class="btn btn-primary">Get Started</button>
                    </div>
                </div> --}}
            </div>

            <main class="p-6">
                @yield('content')
            </main>

        </div>
</body>

</html>
