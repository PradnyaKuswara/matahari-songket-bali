@extends('layouts.app')

@section('page-title')
    Home | Matahari Songket Bali
@endsection

@push('css')
    <style>
        .swiper-wrapper {
            display: flex;
            transition: transform .5s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
        }

        .swiper-scrollbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 10px;
            background: rgba(0, 0, 0, .1);

            .swiper-scrollbar-drag {
                height: 100%;
                transition: transform .5s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
                background: rgba(0, 0, 0, .4);
            }
        }
    </style>
@endpush

@section('content')
    <div class="pt-10 hero-bg-light" id="hero">
        <div class=" flex flex-col justify-between w-screen px-4 mx-auto md:pt-16 md:flex-row md:px-8 lg:max-w-screen-lg">
            <div class="pt-16 mb-16 lg:mb-0 lg:pt-32  md: max-w-md lg:max-w-lg lg:pr-5">
                <div class="w-full mb-6 flex flex-col justify-center">
                    <div>
                        <p
                            class="animate-widen w-32 py-[0.1rem] mb-4 text-xs font-semibold tracking-wider text-primary-content uppercase rounded-full bg-primary">
                        </p>
                    </div>
                    <div data-aos="fade-right" data-aos-duration="1500">
                        <h2
                            class="w-full mb-6 font-sans text-5xl font-bold tracking-tight text-gray-900 sm:text-5xl sm:leading-none">
                            Matahari <span class="text-primary">Songket Bali</span>
                        </h2>
                        <p class="text-base text-gray-700 md:text-lg">
                            Immerse yourself in the rich cultural heritage
                            of Bali with
                            Matahari
                            Songket Bali. Our exquisite collection showcases the finest examples of traditional Balinese
                            songket, a
                            luxurious fabric handwoven with intricate patterns and vibrant colors.
                        </p>
                    </div>

                </div>
                <div class="flex items-center gap-4 a w-20" data-aos="fade-up" data-aos-duration="1500">
                    <x-button-link link="#why-do-we-use-it"
                        class=" btn-neutral shadow-md text-white ">Explore</x-button-link>
                    <x-button-link :link="route('products.indexFront')" class=" btn-primary text-white  animate-pulse animate-infinite">See
                        Product</x-button-link>
                </div>
            </div>
            <div data-aos="fade" data-aos-duration="1500">
                <img src="{{ asset('assets/images/image_hero-removebg-preview.png') }}"
                    class="object-cover object-bottom w-full lg:rounded-full h-64 mx-auto md:h-auto xl:mr-24 md:max-w-sm"
                    alt="" />
            </div>
        </div>
    </div>


    <section id="why-do-we-use-it" class="lg:max-w-screen-lg mx-auto pt-24">
        <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-20 w-full " data-aos="fade-up">
            <div class="w-10/12 md:w-8/12">
                <div class="text-4xl md:text-5xl font-bold mb-5">Why do we use it?</div>
                <div class="text-base md:text-base mt-8 leading-6 text-justify">Matahari Songket Bali offers a stunning
                    collection of
                    traditional Balinese
                    songket products, meticulously handcrafted for special occasions such as weddings, cultural ceremonies,
                    formal events, and more. Each piece showcases the exquisite artistry and rich heritage of Bali, making
                    it a perfect choice for those seeking to add a touch of elegance and tradition to their attire." on
                    indonesia. </div>
                {{-- <img src="{{ asset('assets/images/photographer 1.png') }}" class="" /> --}}
            </div>

            <div class="relative hidden md:flex ">
                <img src="{{ asset('assets/images/photographer 1.png') }}" class=" rounded-lg w-64 h-96" />

                <div class="absolute -bottom-10 -left-16">
                    <img src="{{ asset('assets/images/photographer 2.png') }}" class="w-1/2 rounded-lg shadow-2xl" />
                </div>
                <div class="absolute -top-10 -right-16 flex justify-end ">
                    <img src="{{ asset('assets/images/photographer 5.png') }}" class="w-1/2 rounded-lg shadow-2xl" />
                </div>
            </div>
        </div>
    </section>

    <section id="our-categories" class=" lg:max-w-screen-lg mx-auto py-24 lg:mt-10">
        <div class="flex flex-col md:gap-10 gap-10 " x-data="{ intersect: false }" x-intersect:enter="intersect=true"
            x-intersect:leave="intersect=false">
            <div class="flex flex-col md:flex-row justify-center px-4 lg:px-0">
                <h1 class="text-4xl font-bold ms-4 lg:ms-0">Our Categories</h1>
            </div>

            <div class="hidden lg:grid place-items-center md:grid-cols-3 gap-4">
                @forelse ($productCategories as $productCategory)
                    <img src="{{ $productCategory->image ? $productCategory->image() : '' }}"
                        class="w-9/12 md:w-full rounded-lg shadow-2xl {{ $loop->iteration % 2 == 0 ? 'md:mt-0' : 'md:mt-40' }} ":class="intersect ? 'animate-fade-up animate-duration-[2000ms]':'opacity-0'" />
                @empty
                    <div class="text-center">No data available</div>
                @endforelse
            </div>

            <div class="lg:hidden flex flex-col justify-center items-center mx-auto md:flex-row gap-4 max-w-xs">

                @forelse ($productCategories as $productCategory)
                    <div class=" {{ $loop->iteration % 2 == 0 ? 'flex flex-row-reverse gap-4 items-center justify-end' : ' mx-auto flex items-center gap-4' }}"
                        :class="intersect ? 'animate-fade-up animate-duration-[2000ms]' : 'opacity-0'">
                        <img src="{{ $productCategory->image ? $productCategory->image() : '' }}"
                            class="w-6/12 md:w-full rounded-lg shadow-2xl md:mt-40  {{ $loop->iteration % 2 == 0 ? 'md:mt-0 -rotate-12' : 'md:mt-40 rotate-12' }} " />
                        <h1 class="text-primary font-bold">Kain Songket</h1>
                    </div>
                @empty
                    <div class="text-center">No data available</div>
                @endforelse
            </div>

            <div class="text-base flex justify-center text-center px-10 font-bold ">
                This category encompasses a variety of products that are currently in stock and available for purchase.
            </div>
        </div>
    </section>


    <section id="popular-for-you" class="max-w-screen min-h-[30rem] bg-neutral text-primary-content  ">
        <div class="swiper-container">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide bg-secondary text-secondary-content h-screen flex justify-center items-center">
                        <div class=" font-black  grid text-center place-content-center">
                            <div class=" text-6xl md:text-8xl font-black text-center ">
                                <p>MATAHARI SONGKET BALI</p>
                            </div>
                            <div class="flex justify-center mt-4">
                                <img class="h-10" src="{{ asset('assets/images/logo.png') }}" alt="">
                            </div>
                            {{-- <div class="flex justify-center mt-4">
                                <iframe src="{{ asset('assets/videos/Video produk.mp4') }}" width="640" height="360"
                                    frameborder="0" allowfullscreen></iframe>
                            </div> --}}
                        </div>

                    </div>
                    <div class="swiper-slide bg-base-200 text-red-300 h-screen flex justify-center items-center">
                        <div class="grid text-center place-content-center">
                            <div class="text-5xl md:text-8xl font-black text-center mt-4 mx-2 lg:mx-0">
                                <p>Let's See Our Product :)</p>
                            </div>
                            <div class="flex justify-center mt-4">
                                <img class="h-10" src="{{ asset('assets/images/logo.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-scrollbar"></div>
            </div>
        </div>


        <div class="popular grid lg:grid-cols-2 w-full gap-8 py-40 lg:ps-40">
            <div class="mx-8 lg:mx-0">
                <x-string-typing idType="typed-3" idStringElement="typed-title-3"
                    class="text-3xl md:text-5xl font-bold mb-5">Popular for you</x-string-typing>
                <div class="text-base mt-8 leading-6">These products are popular or highly sought after by the community.
                    They are in
                    high demand due to their quality, uniqueness, or relevance to current trends. Customers frequently seek
                    out these products for their exceptional features or value, making them a prominent choice in the
                    market.
                </div>
            </div>

            <div x-data="{}" x-init="$nextTick(() => {
                let ul = $refs.logos;
                ul.insertAdjacentHTML('afterend', ul.outerHTML);
                ul.nextSibling.setAttribute('aria-hidden', 'true');
            })"
                class="lg:w-full max-w-full-xs inline-flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)]">
                <ul x-ref="logos"
                    class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll">
                    <li>
                        <img class="w-52 h-72 rounded-md" src="{{ asset('assets/images/product 1.png') }}"
                            alt="Facebook" />
                    </li>
                    <li>
                        <img class="w-52 h-72 rounded-md" src="{{ asset('assets/images/product 2.png') }}"
                            alt="Facebook" />
                    </li>
                    <li>
                        <img class="w-52 h-72 rounded-md" src="{{ asset('assets/images/product 3.png') }}"
                            alt="Facebook" />
                    </li>
                    <li>
                        <img class="w-52 h-72 rounded-md" src="{{ asset('assets/images/product 4.png') }}"
                            alt="Facebook" />
                    </li>
                    <li>
                        <img class="w-52 h-72 rounded-md" src="{{ asset('assets/images/product 1.png') }}"
                            alt="Facebook" />
                    </li>
                    <li>
                        <img class="w-52 h-72 rounded-md" src="{{ asset('assets/images/product 2.png') }}"
                            alt="Facebook" />
                    </li>
                    <li>
                        <img class="w-52 h-72 rounded-md" src="{{ asset('assets/images/product 3.png') }}"
                            alt="Facebook" />
                    </li>
                    <li>
                        <img class="w-52 h-72 rounded-md" src="{{ asset('assets/images/product 4.png') }}"
                            alt="Facebook" />
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section id="newest-product" class=" lg:max-w-screen-lg md:px-14 lg:px-0 mx-auto py-20 md:py-20" data-aos="fade-up">
        <div class="flex flex-col md:gap-16 gap-10 ">
            <div class="flex flex-col md:flex-row px-4 lg:px-0">
                <h1 class="text-4xl font-bold">Newest product</h1>
            </div>
            <div x-data="{ loading: false, card: false }" x-init="loading = true, card = true"
                class="grid grid-cols-2 lg:grid-cols-3 gap-x-4 lg:gap-x-6 gap-y-10 lg:mx-0">
                @foreach ($products as $product)
                    <x-product-card :product="$product" class="shadow-md">
                    </x-product-card>
                @endforeach
            </div>

            <div class="flex flex-col justify-center items-center">
                <x-button-link
                    class="btn-primary text-xs md:text-base btn-outline w-1/3 animate-shake animate-infinite animate-duration-[2000ms]"
                    link="{{ route('products.indexFront') }}">See another
                    product</x-button-link>
            </div>
        </div>
    </section>

    <section id="testimony" class="relative isolate overflow-hidden bg-white px-6 pb-20 md:pb:14 lg:px-8"
        data-aos="fade-right">
        <div
            class="absolute inset-0 -z-10 bg-[radial-gradient(45rem_50rem_at_top,theme(colors.indigo.100),white)] opacity-20">
        </div>
        <div
            class="absolute inset-y-0 right-1/2 -z-10 mr-16 w-[200%] origin-bottom-left skew-x-[-30deg] bg-white shadow-xl shadow-indigo-600/10 ring-1 ring-indigo-50 sm:mr-28 lg:mr-0 xl:mr-16 xl:origin-center">
        </div>

        <div class="swiper-container ">
            <div class="swiper mySwiper2">
                <div class="swiper-wrapper mb-16">
                    <div class="swiper-slide">
                        <div class="mx-auto max-w-2xl lg:max-w-4xl">
                            <figure class="mt-10">
                                <blockquote
                                    class="text-center text-base font-semibold leading-8 text-gray-900 sm:text-xl sm:leading-9 ">
                                    <p>“Saya merasa senang sekali belanja di Matahari Songket bali
                                        Karena produksinya bagus-bagus dan berkualitas serta tahan lama.
                                        Motif dan warnanya sangat serasi
                                        Dan saya akan terus berlanganan di sini. Semoga Matahari Songket Bali memproduksi
                                        songket yg motifnya baru dan warna nya bagus selalu. Semoga Matahari Songket Bali
                                        lebih maju dan bisa memasarkan sampe keluar bali
                                        ”</p>
                                </blockquote>
                                <figcaption class="mt-10">
                                    <img class="mx-auto h-10 w-10 rounded-full object-cover"
                                        src="{{ asset('assets/images/Testimoni 1.jpg') }}" alt="">
                                    <div class="mt-4 flex items-center justify-center space-x-3 text-base">
                                        <div class="font-semibold text-gray-900">Dayu Dili</div>
                                        <svg viewBox="0 0 2 2" width="3" height="3" aria-hidden="true"
                                            class="fill-gray-900">
                                            <circle cx="1" cy="1" r="1" />
                                        </svg>
                                        <div class="text-gray-600">Dayu Dili Salon</div>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="mx-auto max-w-2xl lg:max-w-4xl">
                            <figure class="mt-10">
                                <blockquote
                                    class="text-center text-xl font-semibold leading-8 text-gray-900 sm:text-2xl sm:leading-9">
                                    <p>“Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo expedita voluptas
                                        culpa sapiente alias
                                        molestiae. Numquam corrupti in laborum sed rerum et corporis.”</p>
                                </blockquote>
                                <figcaption class="mt-10">
                                    <img class="mx-auto h-10 w-10 rounded-full"
                                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="">
                                    <div class="mt-4 flex items-center justify-center space-x-3 text-base">
                                        <div class="font-semibold text-gray-900">Judith Black</div>
                                        <svg viewBox="0 0 2 2" width="3" height="3" aria-hidden="true"
                                            class="fill-gray-900">
                                            <circle cx="1" cy="1" r="1" />
                                        </svg>
                                        <div class="text-gray-600">CEO of Workcation</div>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <div x></div>
@endsection

@push('scripts')
    <script>
        let lastScrollTop = 0;

        function isScrollingUp() {
            const st = window.pageYOffset || document.documentElement.scrollTop;
            const scrollingUp = st < lastScrollTop;
            lastScrollTop = st <= 0 ? 0 : st;
            return scrollingUp;
        }
    </script>

    <script type="module">
        const swiper = new Swiper('.mySwiper', {
            slideToClickedSlide: true,
            slidePerView: "auto",
            freeMode: {
                enabled: true,
                sticky: false,
                momentumBounce: false,
            },
            scrollbar: {
                el: '.swiper-scrollbar',
                draggable: true,
                dragSize: 100,
            },
            mousewheel: {
                enabled: true,
                sensitivity: 3,
                releaseOnEdges: true,
                eventsTarged: '.swiper-scrollba',
            },
        });
    </script>

    <script type="module">
        const swiper = new Swiper('.mySwiper2', {
            slideToClickedSlide: true,
            slidePerView: 1,
            autoplay: {
                delay: 3000,
            },
            pagination: {
                el: '.swiper-pagination',
            },
        });
    </script>
@endpush
