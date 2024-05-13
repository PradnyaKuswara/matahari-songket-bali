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
    <section id="hero" class="hero hero-bg-light ">
        <div x-data="{ intersect: false }" x-intersect:enter="intersect=true" x-intersect:leave="intersect=false"
            class="hero-content items-center flex-col-reverse lg:flex-row-reverse w-full min-h-screen lg:max-w-screen-lg lg:mx-auto pt-28 md:px-14 lg:px-0 lg:py-0 ">
            <img src="{{ asset('assets/images/image_hero-removebg-preview.png') }}"
                class="lg:w-[24rem] lg:h-[35rem] rounded-lg " :class="intersect ? 'animate-fade-left' : 'opacity-0'" />
            <div class="w-full mt-4">
                <h1 class="text-7xl font-extrabold mb-5 " :class="intersect ? 'animate-fade-right' : 'opacity-0'">Matahari
                    Songket
                    <span class="text-accent">Bali</span>
                </h1>

                <h1 class="text-base mt-8 font-[500]">Immerse yourself in the rich cultural heritage of Bali with Matahari
                    Songket Bali. Our exquisite collection showcases the finest examples of traditional Balinese songket, a
                    luxurious fabric handwoven with intricate patterns and vibrant colors. Each piece tells a story of
                    craftsmanship and artistry, passed down through generations.</h1>

                <section class="grid gap-4 grid-cols-2 md:grid-cols-4 md:gap-1 mt-8">
                    @foreach ($dataCounter as $index => $counter)
                        <x-counter :counter="$counter">
                        </x-counter>
                    @endforeach
                </section>

                <div class="flex items-center my-5 gap-4">
                    <x-button-link link="#why-do-we-use-it" class="bg-accent text-white ">Explore</x-button-link>
                    <x-button-link :link="route('products.indexFront')" class="bg-primary text-white  animate-pulse animate-infinite">See
                        Product</x-button-link>
                </div>
            </div>
        </div>
    </section>

    <section id="why-do-we-use-it" class="lg:max-w-screen-lg mx-auto py-20">
        <div class="flex flex-col lg:flex-row items-center gap-20 w-full ">
            <div class="w-10/12 md:w-8/12">
                <div class="text-5xl font-bold mb-5">Why do we use it?</div>
                <div class="text-base mt-8">It is a long established fact that a reader will be distracted by the
                    readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a
                    more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making
                    it look like readable English.</div>
            </div>

            <div class="relative">
                <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                    class=" rounded-lg shadow-2xl" />

                <div class="absolute -bottom-10 -left-10">
                    <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                        class="w-1/2 rounded-lg shadow-2xl" />
                </div>
                <div class="absolute -top-10 -right-10 flex justify-end">
                    <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                        class="w-1/2 rounded-lg shadow-2xl" />
                </div>
            </div>
        </div>
    </section>

    <section id="our-categories" class=" lg:max-w-screen-lg md:px-14 lg:px-0 mx-auto py-20 md:py-20">
        <div class="flex flex-col md:gap-16 gap-10 " x-data="{ intersect: false }" x-intersect:enter="intersect=true"
            x-intersect:leave="intersect=false">
            <div class="flex flex-col md:flex-row justify-center px-4 lg:px-0">
                <h1 class="text-4xl font-bold">Our Categories</h1>
            </div>

            <div class="grid place-items-center md:grid-cols-4 gap-4">
                <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                    class="w-9/12 md:w-full rounded-lg shadow-2xl md:mt-40 ":class="intersect ? 'animate-fade-up animate-duration-[2000ms]':'opacity-0'" />
                <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                    class="w-9/12 md:w-full rounded-lg shadow-2xl md:mt-0 ":class="intersect ? 'animate-fade-down animate-duration-[2000ms]':'opacity-0'" />
                <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                    class="w-9/12 md:w-full rounded-lg shadow-2xl md:mt-40 ":class="intersect ? 'animate-fade-up animate-duration-[2000ms]':'opacity-0'" />
                <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                    class="w-9/12 md:w-full rounded-lg shadow-2xl md:mt-0 ":class="intersect ? 'animate-fade-down animate-duration-[2000ms]':'opacity-0'" />
            </div>

            <div class="text-base flex justify-center px-10 ">
                It is a long established fact that a reader will be distracted by the readable content of a page when
                looking at its layout.
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


        <div class="popular flex flex-col lg:flex-row items-center w-full justify-between gap-8 py-40 lg:ps-40">

            <div class="w-8/12">
                <x-string-typing idType="typed-3" idStringElement="typed-title-3"
                    class="text-3xl md:text-5xl font-bold mb-5">Popular for you</x-string-typing>
                <div class="text-base mt-8">It is a long established fact that a reader will be distracted by the readable
                    content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a
                    more-or-less
                    normal distribution of letters, as opposed to using 'Content here, content here', making it look like
                    readable English.</div>
            </div>

            <div x-data="{}" x-init="$nextTick(() => {
                let ul = $refs.logos;
                ul.insertAdjacentHTML('afterend', ul.outerHTML);
                ul.nextSibling.setAttribute('aria-hidden', 'true');
            })"
                class="w-full inline-flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)]">
                <ul x-ref="logos"
                    class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll">
                    <li>
                        <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                            alt="Facebook" />
                    </li>
                    <li>
                        <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                            alt="Disney" />
                    </li>
                    <li>
                        <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                            alt="Airbnb" />
                    </li>
                    <li>
                        <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                            alt="Apple" />
                    </li>
                    <li>
                        <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                            alt="Spark" />
                    </li>
                    <li>
                        <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                            alt="Samsung" />
                    </li>
                    <li>
                        <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                            alt="Quora" />
                    </li>
                    <li>
                        <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                            alt="Sass" />
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section id="newest-product" class=" lg:max-w-screen-lg md:px-14 lg:px-0 mx-auto py-20 md:py-20">
        <div class="flex flex-col md:gap-16 gap-10 ">
            <div class="flex flex-col md:flex-row px-4 lg:px-0">
                <h1 class="text-4xl font-bold">Newest product</h1>
            </div>
            <div x-data="{ loading: false, card: false }" x-init="loading = true, card = true"
                class="grid grid-cols-2 lg:grid-cols-3 gap-x-4 lg:gap-x-6 gap-y-10 mx-4 lg:mx-0">
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

    <section id="testimony" class="relative isolate overflow-hidden bg-white px-6 pb-20 md:pb:14 lg:px-8">
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
                            <img class="mx-auto h-12"
                                src="https://tailwindui.com/img/logos/workcation-logo-indigo-600.svg" alt="">
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
                    <div class="swiper-slide">
                        <div class="mx-auto max-w-2xl lg:max-w-4xl">
                            <img class="mx-auto h-12"
                                src="https://tailwindui.com/img/logos/workcation-logo-indigo-600.svg" alt="">
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
            pagination: {
                el: '.swiper-pagination',
            },
        });
    </script>
@endpush
