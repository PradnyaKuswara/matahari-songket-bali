<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo_icon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Icon -->
    <script src="https://kit.fontawesome.com/b1f0352e54.js" crossorigin="anonymous"></script>

    <script async src="https://www.google.com/recaptcha/api.js">
        // Add recaptcha script
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const recaptchaObserver = new MutationObserver(() => {
                const recaptchaFrame = document.querySelector(".g-recaptcha iframe");
                if (recaptchaFrame) {
                    recaptchaFrame.style.zIndex = "9999"; // atau nilai yang cukup besar
                }

                const recaptchaChallenge = document.querySelector(
                    ".g-recaptcha .recaptcha-checkbox-border");
                if (recaptchaChallenge) {
                    recaptchaChallenge.style.zIndex = "9999"; // atau nilai yang cukup besar
                }
            });

            recaptchaObserver.observe(document.body, {
                childList: true,
                subtree: true
            });
        });
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('analytics.measurement_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', '{{ config('analytics.measurement_id') }}');
    </script>

    @stack('css')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('page-title')</title>
</head>

<body data-theme>
    <header class="no-print">
        <x-header></x-header>
    </header>

    <main>
        {{-- @dd($status) --}}
        <x-toaster-hub /> <!-- 👈 -->
        @yield('content')
    </main>

    <x-footer></x-footer>

    <script type="text/javascript" src="{{ asset('assets/js/navbar-swap.js') }}"></script>
    <script>
        localStorage.removeItem('x_modal_create')
        localStorage.removeItem('x_modal_edit')
        localStorage.removeItem('x_modal_edit_id')
    </script>
    @stack('scripts')
</body>

</html>
