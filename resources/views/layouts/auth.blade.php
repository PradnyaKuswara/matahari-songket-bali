<!DOCTYPE html>
<html lang="en" data-sidebar-color="light" data-topbar-color="dark" data-sidebar-view="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="title" content="Matahari Songket Bali">
    <meta name="type" content="website">
    <meta name="image" content="{{ asset('assets/images/logo_icon.png') }}">
    <meta name="url" content="{{ request()->url ?? route('index') }}">
    <meta name="description"
        content="{{ $meta_desc ?? 'Matahari Songket Bali - Explore and shop authentic Balinese songket, handcrafted with traditional techniques. Discover our exclusive collection of cultural heritage textiles and read insightful articles about the rich history of songket.' }}">
    <meta name="site_name" content="Matahari Songket Bali">
    <meta name="author" content="Matahari Songket Bali">
    <meta name="keywords"
        content="{{ $meta_keyword ??'songket, balinese songket, songket bali, matahari songket bali, matahari songket, songket indonesia, songket bali online, songket bali shop, songket bali online shop, songket bali dress, songket bali fabric, songket bali price, songket bali motif, songket bali modern, songket bali tradisional, songket bali terbaru, songket bali terbaik, songket bali asli, songket bali murah, songket bali motif bunga, songket bali motif daun, songket bali motif pohon, songket bali motif burung, songket bali motif kupu-kupu, songket bali motif naga, songket bali motif wayang, songket bali motif bali, songket bali motif tradisional, songket bali motif modern, songket bali motif terbaru, songket bali motif terbaik, songket bali motif asli, songket bali motif murah, songket bali motif bunga terbaru, songket bali motif bunga terbaik, songket bali motif bunga asli, songket bali motif bunga murah, songket bali motif bunga modern, songket bali motif bunga tradisional, songket bali motif bunga terbaru 2021, songket bali motif bunga terbaik 2021, songket bali motif bunga asli 2021, songket bali motif bunga murah 2021, songket bali motif bunga modern 2021, songket bali motif bunga tradisional 2021, songket bali motif bunga terbaru 2022, songket bali motif bunga terbaik 2022, songket bali motif bunga asli 2022, songket bali motif bunga murah 2022, songket bali motif bunga modern 2022, songket bali motif bunga tradisional 2022, songket bali motif bunga terbaru 2023, songket bali motif bunga terbaik 2023, songket bali motif bunga asli 2023' }}">

    <meta name="google-site-verification" content="s_dIkrwKMP9NRfAD6m6CeNHakLzCQh_1-2jgdONp9us" />

    <meta property="og:title" content="Matahari Songket Bali">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('assets/images/logo_icon.png') }}">
    <meta property="og:url" content="{{ request()->url ?? route('index') }}">
    <meta property="og:description"
        content="{{ $meta_desc ?? 'Matahari Songket Bali - Explore and shop authentic Balinese songket, handcrafted with traditional techniques. Discover our exclusive collection of cultural heritage textiles and read insightful articles about the rich history of songket.' }}">
    <meta property="og:site_name" content="Matahari Songket Bali">
    <meta property="og:locale" content="id_ID">
    <meta property="og:locale:alternate" content="en_US">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Matahari Songket Bali">
    <meta name="twitter:description"
        content="{{ $meta_desc ?? 'Matahari Songket Bali - Explore and shop authentic Balinese songket, handcrafted with traditional techniques. Discover our exclusive collection of cultural heritage textiles and read insightful articles about the rich history of songket.' }}">
    <meta name="twitter:image" content="{{ asset('assets/images/logo_icon.png') }}">
    <meta name="twitter:site" content="@mataharisongketbali">
    <meta name="twitter:creator" content="@mataharisongketbali">

    <title>@yield('title')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo_icon.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Poppins&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'" />
    <noscript>
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet" type="text/css" />
    </noscript>

    <!-- Icon -->
    <script async src="https://kit.fontawesome.com/b1f0352e54.js" crossorigin="anonymous"></script>

    <script async src="https://www.google.com/recaptcha/api.js"></script>
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            font-weight: 400
        }

        .btn {
            font-family: 'Poppins', sans-serif;
        }

        .g-recaptcha-bubble-arrow+div {
            position: absolute !important;
            z-index: 3000000000 !important;
        }

        .grecaptcha-badge {
            z-index: 9999;
            /* atau nilai yang cukup besar */
        }

        iframe[title="recaptcha challenge"] {
            position: absolute !important;
            z-index: 3000000000 !important;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="hero-bg-light lg:h-screen w-screen flex justify-center items-center">
    <x-toaster-hub /> <!-- 👈 -->
    @yield('content')

    @stack('scripts')
</body>

</html>
