@extends('layouts.app')

@section('page-title')
    Product | Matahari Songket Bali
@endsection

@push('css')
    <style>
        .swiper-scrollbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 10px;
            background: rgba(0, 0, 0, .1);

            .swiper-scrollbar-drag {
                height: 100%;
                transition: transform .5s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
                background: rgb(70, 0, 255);
            }
        }
    </style>
@endpush

@section('content')
    <section class="min-h-screen xl:max-w-screen-xl lg:max-w-screen-lg lg:mx-auto mx-4 pt-28 md:px-14 lg:px-0 pb-16">
        <div class="flex flex-col gap-6">
            <div x-data="{ intersect: false }" x-intersect:enter="intersect=true" x-intersect:leave="intersect=false"
                class="flex flex-col md:flex-row px-4 lg:px-0">
                <h1 class="text-4xl font-bold " :class="intersect ? 'animate-fade-right' : 'opacity-0'">For you</h1>
            </div>

            <div class="flex flex-col-reverse lg:flex-row justify-between items-start lg:items-center gap-6 lg:gap-0">
                <div class="swiper lg:px-0 lg:ml-0 swiperCategory w-11/12 md:w-9/12 lg:w-5/12 ">
                    <div x-data="{ isActive: null }"" x-init="isActive = 'all'" class="swiper-wrapper w-2/12 mb-5">
                        <x-button-link class="btn lg:btn-sm swiper-slide" @click="isActive='all'"
                            ::class="isActive == 'all' ? 'btn-neutral' : 'btn-outline'">All</x-button-link>
                        <x-button-link class="btn lg:btn-sm  swiper-slide" @click="isActive='newest'"
                            ::class="isActive == 'newest' ? 'btn-neutral' : 'btn-outline'">Newest</x-button-link>
                        <x-button-link class="btn lg:btn-sm  swiper-slide" @click="isActive='popular'"
                            ::class="isActive == 'popular' ? 'btn-neutral' : 'btn-outline'">Popular</x-button-link>
                        <x-button-link class="btn lg:btn-sm  swiper-slide" @click="isActive='kamen'"
                            ::class="isActive == 'kamen' ? 'btn-neutral' : 'btn-outline'">Kamen</x-button-link>
                        <x-button-link class="btn lg:btn-sm  swiper-slide" @click="isActive='udeng'"
                            ::class="isActive == 'udeng' ? 'btn-neutral' : 'btn-outline'">Udeng</x-button-link>
                        <x-button-link class="btn lg:btn-sm  swiper-slide" @click="isActive='slendang'"
                            ::class="isActive == 'slendang' ? 'btn-neutral' : 'btn-outline'">Slendang</x-button-link>
                    </div>
                    <div class="swiper-scrollbar"></div>
                </div>

                <div class="flex flex-row gap-4 lg:mx-0 w-full lg:w-3/12">
                    <label class="input input-bordered input-primary flex items-center gap-2 w-full mx-4 lg:mx-0 ">
                        <input type="text" class="grow" placeholder="Search" />
                        <i class="fas fa-search"></i>
                    </label>
                </div>

            </div>

            <div x-data="{ loading: false, card: false }" x-init="loading = false, card = true"
                class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-4 lg:gap-x-6 gap-y-10 animate-fade-down">
                @for ($i = 0; $i < 6; $i++)
                    <x-product-card class="shadow-md "></x-product-card>
                @endfor
                <x-loading-card></x-loading-card>

            </div>
            <x-pagination></x-pagination>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="module">
        const swiperCategory = new Swiper('.swiperCategory', {
            slidesPerView: 'auto',
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-navigation .swiper-button-next',
                prevEl: '.swiper-navigation .swiper-button-prev',
            },
            scrollbar: {
                el: '.swiper-scrollbar',
                draggable: true,
                dragSize: 30,
            },
        });
    </script>
@endpush
