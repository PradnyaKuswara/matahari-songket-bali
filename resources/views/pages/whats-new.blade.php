@extends('layouts.app')

@section('page-title')
    What's New | Matahari Songket Bali
@endsection

@section('content')
    <section id="hero">
        <div
            class="hero hero-bg-light w-full 2xl:max-w-screen-xl lg:max-w-screen-lg lg:mx-auto pt-28 md:px-14 lg:px-0 lg:pt-32">
            <div class="hero-content text-center">
                <div x-data="{ intersect: false }" x-intersect:enter="intersect=true" x-intersect:leave="intersect=false"
                    class="max-w-xl">
                    <h1 class="text-5xl font-bold w-full " :class="intersect ? 'animate-fade-down' : 'opacity-0'">What is
                        Lorem Ipsum?</h1>
                    <p class="py-6 ":class="intersect ? 'animate-fade-right' : 'opacity-0'">Lorem Ipsum is simply dummy
                        text of the printing and typesetting
                        industry. Lorem Ipsum
                        has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                        galley</p>
                </div>
            </div>
        </div>
    </section>
    <section id="article">
        <div
            class="min-h-screen 2xl:max-w-screen-xl lg:max-w-screen-lg lg:mx-auto md:px-14 lg:px-0 lg:py-2 animate-fade-right">
            <div class="swiper swiperArticle">
                <div class="swiper-wrapper max-w-screen-lg mx-auto mb-8">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="swiper-slide card  md:card-side bg-base-100 w-full ">
                            <figure><img src="{{ asset('assets/images/hero2.jpg') }}" class="w-96 rounded-md"
                                    alt="Album" />
                            </figure>
                            <div class="card-body w-96 gap-4">
                                <div class="badge badge-neutral py-3 px-3 badge-outline text-xs p-2 md:text-base">Songket
                                </div>
                                <h2 class="card-title font-bold">There are many variations of passages of Lorem Ipsum
                                    available
                                </h2>
                                <p class="text-sm 2xl:w-8/12">There are many variations of passages of Lorem Ipsum available. There are
                                    many
                                    variations of passages
                                    of Lorem Ipsum available. There are many variations of passages of Lorem Ipsum
                                    available....
                                </p>
                                <div class="flex gap-3 iitem-center mt-4">
                                    <div class="flex flex-col">
                                        <div class="avatar">
                                            <div class="w-8 rounded-full">
                                                <img
                                                    src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex gap-4">
                                        <div class="flex flex-col">
                                            <p class="text-xs">By: Matahari Songket Bali</p>
                                            <p class="text-xs">18 Jun 2022</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="swiper-pagination"></div>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 my-10 animate-fade-down">
                @for ($i = 0; $i < 6; $i++)
                    <x-article class="shadow-md" />
                @endfor
            </div>
            <div class="flex flex-col item-center mb-10">
                <x-pagination></x-pagination>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="module">
        const swiperArticle = new Swiper('.swiperArticle', {
            slidesPerView: 1,
            spaceBetween: 10,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
            },
        });
    </script>
@endpush
