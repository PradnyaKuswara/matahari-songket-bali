<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    <title>@yield('title')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

    <!-- App css -->
    <link href="{{ asset('assets/lunoz/css/theme.css') }}" rel="stylesheet" type="text/css">

    <!-- Head Js -->
    <script src="{{ asset('assets/lunoz/js/head.js') }}"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('css')


</head>

<body>
    <x-toaster-hub /> <!-- 👈 -->
    <div class="app-wrapper">

        <x-dashboard.sidebar></x-dashboard.sidebar>


        <div class="app-content">

            <x-dashboard.topbar></x-dashboard.topbar>

            <main class="p-6 bg-[#F1F5F9] min-h-screen">

                @if (!auth()->user()->hasVerifiedEmail())
                    <div role="alert" class="alert alert-primary mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="stroke-current shrink-0 w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Please verify you account. We’ve sent you a verification link to
                            the email address <span
                                class="font-medium text-indigo-500">{{ auth()->user()->email }}</span> or click beside
                            button to
                            resend email verification</span>
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-sm btn-primary w-50 rounded px-5 py-3 font-medium text-white shadow-md shadow-indigo-500/20">Resend
                                Verification Email</button>
                        </form>
                    </div>
                @endif
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

    @stack('scripts')
</body>

</html>
