@extends('layouts.app')

@section('page-title')
    What's New Detail | Matahari Songket Bali
@endsection

@section('content')
    <section class="2xl:max-w-screen-xl lg:max-w-screen-lg lg:mx-auto mx-4 pt-28 md:px-14 lg:px-0 pb-16">
        <div class="flex flex-col gap-6 justify-center max-w-screen-md mx-auto">
            <div class="flex justify-between items-center gap-8">
                <div class="flex gap-3 item-center mt-4 ">
                    <div class="flex flex-col animate-fade-right">
                        <div class="avatar">
                            <div class="w-8 rounded-full">
                                <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-4 animate-fade-down ">
                        <div class="flex flex-col">
                            <p class="text-xs">By: Matahari Songket Bali</p>
                            <p class="text-xs">18 Jun 2022</p>
                        </div>
                    </div>
                </div>
                <div class="badge badge-neutral py-3 px-3 badge-outline text-xs md:text-xs animate-fade-left">Songket</div>
            </div>
            <div class="w-full animate-fade">
                <img src="{{ asset('assets/images/hero2.jpg') }}" class=" rounded-md" alt="">
            </div>
            <div class="flex flex-col gap-10 animate-fade">
                <h1 class="text-2xl text-center md:text-3xl font-extrabold">There are many variations of passages of Lorem
                    Ipsum
                    available</h1>
                <p class="text-sm">There are many variations of passages of Lorem Ipsum available, but the majority have
                    suffered alteration in some form, by injected humour, or randomised words which don't look even slightly
                    believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything
                    embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat
                    predefined chunks as necessary, making this the first true generator on the Internet. It uses a
                    dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate
                    Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition,
                    injected humour, or non-characteristic words etc.

                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                    alteration in some form, by injected humour, or randomised words which don't look even slightly
                    believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything
                    embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat
                    predefined chunks as necessary, making this the first true generator on the Internet. It uses a
                    dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate
                    Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition,
                    injected humour, or non-characteristic words etc.

                </p>
            </div>
        </div>
    </section>

    <section class="xl:max-w-screen-xl lg:max-w-screen-lg mx-2 md:mx-8 lg:mx-auto pb-16">
        <div class="flex flex-col gap-8 lg:gap-4">
            <div class="text-2xl md:text-4xl font-bold">Maybe you interested</div>
            <div class="grid md:grid-cols-3 gap-4">
                @for ($i = 0; $i < 3; $i++)
                    <x-article class="shadow-md"></x-article>
                @endfor
            </div>
        </div>

    </section>
@endsection
