<footer class="footer footer-center bg-primary text-primary-content py-6 lg:px-36 no-print">
    {{-- <nav class="grid grid-flow-col gap-4">
        <a href="{{ route('index') }}" class="link link-hover text-xs md:text-base">Home</a>
        <a href="{{ route('products') }}" class="link link-hover text-xs md:text-base">Product</a>
        <a href="{{ route('whats-new') }}" class="link link-hover text-xs md:text-base">Whats news</a>
        <a href="{{ route('about') }}" class="link link-hover text-xs md:text-base">About us</a>
    </nav> --}}
    <nav>
        <div class="grid grid-flow-col gap-6 text-primary-content">
            <a href="https://www.facebook.com/gusti.ayusri.5?locale=id_ID"><i
                    class="fas fa-brands fa-facebook fa-2x"></i></a>
            <a href="https://www.instagram.com/matahari_songket_bali/"><i
                    class="fas fa-brands fa-instagram fa-2x"></i></a>
            <a href="mailto:mataharisongketbali@gmail.com"><i class="fas fa-envelope fa-2x"></i></a>
        </div>
    </nav>
</footer>
<footer class="footer px-4 lg:px-14 py-6 border-t bg-primary text-primary-content border-base-300 no-print">
    <aside class="items-center grid-flow-col">
        <img class="h-8" src="{{ asset('assets/images/logo2.png') }}" alt="logo">
        <p class="text-xs">Matahari Songket Bali <br>Your Gateway to Authentic Balinese Songket Fabric since 1992</p>
    </aside>
    <nav class="md:place-self-center md:justify-self-end">
        <div class="grid grid-flow-col gap-4">
            <p class="text-xs">Copyright © {{ now()->format('Y') }} - All right reserved by Matahari Songket Bali</p>
        </div>
    </nav>
</footer>
