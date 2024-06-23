@extends('layouts.app')

@section('page-title')
    What's New | Matahari Songket Bali
@endsection

@push('css')
    <style>
        #preview-container>img {
            width: 380px;
            height: 180px;
            /* border: 2px solid rgb(219, 219, 219); */
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
    <section id="hero">
        <div
            class="hero hero-bg-light w-full 2xl:max-w-screen-xl lg:max-w-screen-lg lg:mx-auto pt-28 md:px-14 lg:px-0 lg:pt-32">
            <div class="hero-content text-center">
                <div x-data="{ intersect: false }" x-intersect:enter="intersect=true" x-intersect:leave="intersect=false"
                    class="max-w-xl">
                    <h1 class="text-3xl md:text-5xl font-bold w-full "
                        :class="intersect ? 'animate-fade-down' : 'opacity-0'">Discover
                        the Beauty of Bali's Songket</h1>
                    <p class="py-6 text-sm md:text-base leading-5 ":class="intersect ? 'animate-fade-right' : 'opacity-0'">
                        Explore our collection of
                        articles showcasing the rich tradition and exquisite craftsmanship of Bali's traditional songket.
                        Immerse yourself in the stories behind these beautiful pieces of artistry.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="article">
        <div
            class="min-h-screen 2xl:max-w-screen-xl lg:max-w-screen-lg lg:mx-auto md:px-14 lg:px-0 lg:py-2 animate-fade-right">
            <div class="swiper swiperArticle">
                <div class="swiper-wrapper max-w-screen-lg mx-auto mb-8">
                    @forelse ($articlesSwiper as $articleItem)
                        <a href="{{ route('whats-new.detail', $articleItem) }}"
                            class="swiper-slide card  md:card-side bg-base-100 w-full ">
                            <figure id="">
                                <img src="{{ $articleItem->thumbnail() }}" class="w-96 object-cover" alt="Album" />
                            </figure>
                            <div class="card-body w-96 gap-4">
                                <div class="flex justify-between">
                                    <div
                                        class="badge badge-primary animate-pulse py-3 px-3 badge-outline text-xs p-2 md:text-base">
                                        New
                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <span class="mdi mdi-eye text-sm text-gray-500"></span>
                                        <p class="text-sm text-gray-500">
                                            {{ visits(\App\Models\Visitor::TYPE_ARTICLE, $articleItem)->getVisitorCountPerSite() }}
                                        </p>
                                    </div>
                                </div>

                                <h2 class="card-title font-bold">{{ $articleItem->title }}
                                </h2>
                                <p class="text-sm 2xl:w-8/12">{!! Str::limit(strip_tags($articleItem->content), 250) !!}
                                </p>
                                <div class="flex gap-3 iitem-center mt-4">
                                    <div class="flex flex-col">
                                        <div class="avatar">
                                            <div class="w-8 rounded-full">
                                                <img src="{{ $articleItem->user->avatar ? $articleItem->user->avatar() : 'https://eu.ui-avatars.com/api/?name=' . $articleItem->user->username . '&size=150' }}"
                                                    alt="Avatar Tailwind CSS Component" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex gap-4">
                                        <div class="flex flex-col">
                                            <p class="text-xs">By: {{ $articleItem->user->name }}</p>
                                            <p class="text-xs">{{ $articleItem->published_at->format('d F Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                    @endforelse
                </div>
                <div class="swiper-pagination"></div>
            </div>

            <div id="article-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 my-10 animate-fade-down">
                @include('pages.whats-new-data')
            </div>
            @if ($articles->isEmpty())
                <div class="flex justify-center align-items-center col-span-4">
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-center">No Article Found</h3>
                    </div>
                </div>
            @endif

            @if ($articles->hasMorePages())
                <div class="flex flex-col item-center justify-center mx-auto w-52 mb-10">
                    <button id="load-more" class="btn btn-primary btn-outline">Load More</button>
                </div>
            @endif
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        const article = @json($articles);
        let endpoint = "{{ route('whats-new.index') }}";
        let page = 1;

        console.log(article);

        $(document).on('click', '#load-more', function() {
            page++;
            loadMoreData(page);

            if (page >= article.last_page) {
                $('#load-more').hide();
            }
        });

        function loadMoreData(page) {
            $.ajax({
                url: endpoint + '?page=' + page,
                type: 'get',
                beforeSend: function() {
                    $('#load-more').text('Loading...');
                }
            }).done(function(data) {
                if (data.html == "") {
                    $('#load-more').hide();
                    return;
                }
                $('#article-list').append(data.html);
                $('#load-more').text('Load More');
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('server not responding...');
            });
        }
    </script>
@endpush
