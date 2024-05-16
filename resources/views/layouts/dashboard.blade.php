<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo.png') }}" />
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
    <x-toaster-hub /> <!-- 👈 -->

    <!-- sidebar menu overlay -->
    <div x-cloak class="fixed inset-0 z-50 bg-[black]/60 lg:hidden" :class="{ 'hidden': !$store.app.sidebar }"
        @click="$store.app.toggleSidebar()"></div>

    <!-- screen loader -->
    <div
        class="screen_loader animate__animated fixed inset-0 z-[60] grid place-content-center bg-[#fafafa] dark:bg-[#060818]">
        <img src="{{ asset('assets/images/logo_icon.png') }}" alt="Logo Icon"
            class="w-20 h-20 animate-rotate-y animate-infinite">
    </div>

    <!-- scroll to top button -->
    <div class="fixed bottom-6 z-50 ltr:right-6 rtl:left-6" x-data="scrollToTop">
        <template x-if="showTopButton">
            <button type="button"
                class="btn btn-primary text-primary-content btn-sm animate-pulse rounded-full  p-2  dark:bg-[#060818] dark:hover:bg-primary"
                @click="goToTop">
                <svg width="24" height="24" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 20.75C12.4142 20.75 12.75 20.4142 12.75 20L12.75 10.75L11.25 10.75L11.25 20C11.25 20.4142 11.5858 20.75 12 20.75Z"
                        fill="currentColor" />
                    <path
                        d="M6.00002 10.75C5.69667 10.75 5.4232 10.5673 5.30711 10.287C5.19103 10.0068 5.25519 9.68417 5.46969 9.46967L11.4697 3.46967C11.6103 3.32902 11.8011 3.25 12 3.25C12.1989 3.25 12.3897 3.32902 12.5304 3.46967L18.5304 9.46967C18.7449 9.68417 18.809 10.0068 18.6929 10.287C18.5768 10.5673 18.3034 10.75 18 10.75L6.00002 10.75Z"
                        fill="currentColor" />
                </svg>
            </button>
        </template>
    </div>

    <div class="main-container min-h-screen text-black dark:text-white-dark" :class="[$store.app.navbar]">
        <x-dashboard.sidebar></x-dashboard.sidebar>

        <div class="main-content flex min-h-screen flex-col lg:p-4">
            <x-dashboard.topbar></x-dashboard>

                <!-- start main content section -->
                <div class="dvanimation animate__animated p-4 lg:p-6" :class="[$store.app.animation]">
                    @if (!auth()->user()->hasVerifiedEmail())
                        <div role="alert" class="alert alert-primary mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="stroke-current shrink-0 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Please verify you account. We’ve sent you a verification link to
                                the email address <span
                                    class="font-medium text-indigo-500">{{ auth()->user()->email }}</span> or click
                                beside
                                button to
                                resend email verification</span>
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit"
                                    class="btn btn-sm btn-primary w-50 rounded px-5 font-medium text-white shadow-md shadow-indigo-500/20">Resend
                                    Verification Email</button>
                            </form>
                        </div>
                    @endif
                    <div>
                        @yield('content')
                    </div>
                </div>
                <!-- end main content section -->

                <!-- start footer section -->
                <x-dashboard.footer></x-dashboard.footer>
                <!-- end footer section -->
        </div>
    </div>

    <script src="{{ asset('assets/vristo/assets/js/alpine-collaspe.min.js') }}"></script>
    <script src="{{ asset('assets/vristo/assets/js/alpine-persist.min.js') }}"></script>
    <script defer src="{{ asset('assets/vristo/assets/js/alpine-ui.min.js') }}"></script>
    <script defer src="{{ asset('assets/vristo/assets/js/alpine-focus.min.js') }}"></script>
    <script defer src="{{ asset('assets/vristo/assets/js/alpine.min.js') }}"></script>
    <script src="{{ asset('assets/vristo/assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/vristo/assets/js/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/alpine-init.js') }}"></script>
    <script src="{{ asset('assets/vristo/assets/js/alpine-mask.min.js') }}"></script>

    @stack('scripts')
</body>

</html>
