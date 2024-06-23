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
    <section class="min-h-screen xl:max-w-screen-xl lg:max-w-screen-lg lg:mx-auto pt-28 md:px-14 lg:px-0 pb-16">
        <div class="flex flex-col gap-6" x-data="products">
            <div x-data="{ intersect: false }" x-intersect:enter="intersect=true" x-intersect:leave="intersect=false"
                class="flex flex-col md:flex-row px-4 lg:px-0">
                <h1 class="text-4xl font-bold " :class="intersect ? 'animate-fade-right' : 'opacity-0'">For you</h1>
            </div>

            <div class="flex flex-col-reverse lg:flex-row justify-between items-start lg:items-center gap-6 lg:gap-0">
                <div class="swiper lg:px-0 lg:ml-0 swiperCategory w-11/12 md:w-9/12 lg:w-5/12 ">
                    <div class="swiper-wrapper w-2/12 mb-5">
                        <x-button-link class="btn w-20 lg:btn-sm swiper-slide" @click="categoriesAll()"
                            ::class="isActive == 'all' ? 'btn-neutral' : 'btn-outline'">All</x-button-link>
                        <x-button-link class="btn w-20 lg:btn-sm  swiper-slide" @click="categoriesPopular()"
                            ::class="isActive == 'popular' ? 'btn-neutral' : 'btn-outline'">Popular</x-button-link>
                        <x-button-link class="btn w-20 lg:btn-sm  swiper-slide" @click="categoriesOldest()"
                            ::class="isActive == 'oldest' ? 'btn-neutral' : 'btn-outline'">Oldest</x-button-link>
                        <x-button-link class="btn w-20 lg:btn-sm  swiper-slide" @click="categoriesCheapest()"
                            ::class="isActive == 'cheapest' ? 'btn-neutral' : 'btn-outline'">Cheapest</x-button-link>
                        <x-button-link class="btn w-20 lg:btn-sm  swiper-slide" @click="categoriesExpensive()"
                            ::class="isActive == 'expensive' ? 'btn-neutral' : 'btn-outline'">Expensive</x-button-link>

                    </div>
                    <div class="swiper-scrollbar"></div>
                </div>

                <div class="flex flex-row gap-4 lg:mx-0 w-full lg:w-3/12">
                    <label class="input input-bordered input-primary flex items-center gap-2 w-full mx-4 lg:mx-0 ">
                        <input type="text" id="search" class="grow" placeholder="Search by product name"
                            @if (session('keyword')) value="{{ session('keyword') }}" @endif />
                        <i class="fas fa-search"></i>
                    </label>
                </div>

            </div>

            <div>
                <div id="product-list"
                    class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-2 lg:gap-x-6 gap-y-10 animate-fade-down">
                    @include('pages.product-data')
                </div>
                @if ($products->isEmpty())
                    <div class="flex justify-center align-items-center col-span-4">
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-center">No Product Found</h3>
                        </div>
                    </div>
                @endif

                @if ($products->hasMorePages())
                    <div class="flex flex-col item-center justify-center mx-auto w-52 mb-10 mt-10">
                        <button id="load-more" @click="loadMore()" class="btn btn-primary btn-outline">Load More</button>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('products', () => ({
                init() {
                    this.loading = false;
                    this.card = true;
                    this.isActive = 'all';
                },
                products: @json($products),
                loading: false,
                card: false,
                page: 1,
                isActive: null,
                endpointIndex: "{{ route('products.indexFront') }}",
                endpointOldest: "{{ route('products.categoriesOldest') }}",
                endPointPopular: "{{ route('products.categoriesPopular') }}",
                endpointCheapest: "{{ route('products.categoriesCheapest') }}",
                endpointExpensive: "{{ route('products.categoriesExpensive') }}",
                loadMore() {
                    let url;
                    this.page++;

                    if (this.isActive == 'all') {
                        url = this.endpointIndex;
                    } else if (this.isActive == 'popular') {
                        url = this.endPointPopular;
                    } else if (this.isActive == 'oldest') {
                        url = this.endpointOldest;
                    } else if (this.isActive == 'cheapest') {
                        url = this.endpointCheapest;
                    } else if (this.isActive == 'expensive') {
                        url = this.endpointExpensive;
                    } else {
                        url = this.endpointIndex;
                    }

                    $.ajax({
                        url: url + '?page=' + this.page,
                        type: 'get',
                        beforeSend: () => {
                            this.card = false;
                            this.loading = true;
                        },
                    }).done((data) => {
                        if (data.html == "") {
                            $('#load-more').hide();
                            this.loading = false;
                            this.card = true;
                            return;
                        }
                        $('#product-list').append(data.html);
                        this.loading = false;
                        this.card = true;

                        if (this.page >= this.products.last_page) {
                            $('#load-more').hide();
                        }
                    }).fail((jqXHR, ajaxOptions, thrownError) => {
                        alert('server not responding...');
                    });
                },

                categoriesAll() {
                    this.isActive = 'all';
                    this.resetLoadMore();

                    $.ajax({
                        url: this.endpointAll,
                        type: 'get',
                        beforeSend: () => {
                            this.card = false;
                            this.loading = true;
                        },
                    }).done((data) => {
                        $('#product-list').html(data.html);
                        this.loading = false;
                        this.card = true;
                    }).fail((jqXHR, ajaxOptions, thrownError) => {
                        alert('server not responding...');
                    });
                },
                categoriesPopular() {
                    this.isActive = 'popular';
                    this.resetLoadMore();

                    $.ajax({
                        url: this.endPointPopular,
                        type: 'get',
                        beforeSend: () => {
                            this.card = false;
                            this.loading = true;
                        },
                    }).done((data) => {
                        $('#product-list').html(data.html);
                        this.loading = false;
                        this.card = true;
                    }).fail((jqXHR, ajaxOptions, thrownError) => {
                        alert('server not responding...');
                    });
                },
                categoriesOldest() {
                    this.isActive = 'oldest';
                    this.resetLoadMore();

                    $.ajax({
                        url: this.endpointOldest,
                        type: 'get',
                        beforeSend: () => {
                            this.card = false;
                            this.loading = true;
                        },
                    }).done((data) => {
                        $('#product-list').html(data.html);
                        this.loading = false;
                        this.card = true;
                    }).fail((jqXHR, ajaxOptions, thrownError) => {
                        alert('server not responding...');
                    });
                },
                categoriesCheapest() {
                    this.isActive = 'cheapest';
                    this.resetLoadMore();

                    $.ajax({
                        url: this.endpointCheapest,
                        type: 'get',
                        beforeSend: () => {
                            this.card = false;
                            this.loading = true;
                        },
                    }).done((data) => {
                        $('#product-list').html(data.html);
                        this.loading = false;
                        this.card = true;
                    }).fail((jqXHR, ajaxOptions, thrownError) => {
                        alert('server not responding...');
                    });
                },
                categoriesExpensive() {
                    this.isActive = 'expensive';
                    this.resetLoadMore();

                    $.ajax({
                        url: this.endpointExpensive,
                        type: 'get',
                        beforeSend: () => {
                            this.card = false;
                            this.loading = true;
                        },
                    }).done((data) => {
                        $('#product-list').html(data.html);
                        this.loading = false;
                        this.card = true;
                    }).fail((jqXHR, ajaxOptions, thrownError) => {
                        alert('server not responding...');
                    });
                },
                resetLoadMore() {
                    this.page = 1;
                    $('#load-more').show();
                }
            }));
        });
    </script>

    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script>
        search("search", "product-list", "{{ url('products/search?') }}")
    </script>
@endpush
