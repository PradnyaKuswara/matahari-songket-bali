@extends('layouts.app')

@section('page-title')
    What's New Detail | Matahari Songket Bali
@endsection

@push('css')
    <style>
        figure.image figcaption {
            margin: 6px 8px 6px 8px;
            text-align: center;
            font-size: 0.7rem;
            color: #a0aec0;
        }

        #preview-container>img {
            width: 380px;
            height: 180px;
            /* border: 2px solid rgb(219, 219, 219); */
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
    <section class="2xl:max-w-screen-xl lg:max-w-screen-lg lg:mx-auto mx-4 pt-28 md:px-14 lg:px-0 pb-16">
        <div class="flex flex-col gap-6 justify-center max-w-screen-md mx-auto">
            <div class="flex flex-col gap-4 animate-fade mt-4">
                <h1 class="text-2xl md:text-3xl font-extrabold">{{ $article->title }}</h1>
                <p>{{ $article->keyword }}</p>
            </div>
            <div class="flex justify-between items-center gap-8">

                <div class="flex gap-3 item-center">
                    <div class="flex flex-col animate-fade-right">
                        <div class="avatar">
                            <div class="w-8 rounded-full">
                                <img src="{{ $article->user->avatar ? $article->user->avatar() : 'https://eu.ui-avatars.com/api/?name=' . $article->user->username . '&size=150' }}"
                                    alt="Avatar Tailwind CSS Component" />
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-4 animate-fade-down ">
                        <div class="flex flex-col">
                            <p class="text-xs">By: {{ $article->user->name }}</p>
                            <p class="text-xs">{{ $article->published_at->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-2 items-center">
                    <span class="mdi mdi-eye text-sm text-gray-500"></span>
                    <p class="text-sm text-gray-500">
                        {{ visits(\App\Models\Visitor::TYPE_ARTICLE, $article)->getVisitorCountPerSite() }}
                    </p>
                </div>
            </div>
            <div class="flex flex-col gap-10 animate-fade mt-4">
                {!! $article->content !!}
            </div>
        </div>
    </section>

    @if ($articles->count() > 0)
        <section class="2xl:max-w-screen-xl lg:max-w-screen-lg mx-2 md:mx-8 lg:mx-auto pb-16">
            <div class="flex flex-col gap-8 lg:gap-4">
                <div class="text-2xl md:text-4xl font-bold">Maybe you interested</div>
                <div class="grid md:grid-cols-3 gap-4">
                    @foreach ($articles as $article)
                        <x-article :article="$article" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif


@endsection
