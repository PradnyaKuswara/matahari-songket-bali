@extends('layouts.app')

@section('page-title')
    About | Matahari Songket Bali
@endsection

@section('content')
    <section id="hero">
        <div class="hero w-full p-20  lg:mx-auto pt-28 md:px-14 lg:px-0 lg:pt-32"
            style="background-image: url({{ asset('assets/images/hero2.jpg') }}); ">
            <div class="hero-content text-center">
                <div x-data="{ intersect: false }" x-intersect:enter="intersect=true" x-intersect:leave="intersect=false"
                    class="max-w-xl text-white">
                    <h1 class="text-2xl md:text-5xl font-bold w-full "
                        :class="intersect ? 'animate-fade-down' : 'opacity-0'">What is
                        Lorem Ipsum?</h1>
                    <p class="py-6 text-xs md:text-base ":class="intersect ? 'animate-fade-right' : 'opacity-0'">Lorem
                        Ipsum is simply dummy
                        text of the printing and typesetting
                        industry. Lorem Ipsum
                        has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                        galle</p>
                </div>
            </div>
        </div>
    </section>

    <section class=" max-w-screen-lg lg:mx-auto pt-16 mx-4 md:mx-0 md:px-14 lg:px-0 lg:pt-20">
        <div class="grid grid-cols-2 gap-8">
            <div class="flex flex-col items-center gap-8">
                <img src="{{ asset('assets/images/hero2.jpg') }}" class=" w-96 rounded-lg shadow-2xl" />
                <p class="text-xs md:text-base">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley</p>
            </div>
            <div class="flex flex-col items-center gap-8">
                <img src="{{ asset('assets/images/hero2.jpg') }}" class=" w-96 rounded-lg shadow-2xl" />
                <p class="text-xs md:text-base">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley</p>
            </div>
            <div class="flex flex-col items-center gap-8">
                <img src="{{ asset('assets/images/hero2.jpg') }}" class=" w-96 rounded-lg shadow-2xl" />
                <p class="text-xs md:text-base">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley</p>
            </div>
            <div class="flex flex-col items-center gap-8">
                <img src="{{ asset('assets/images/hero2.jpg') }}" class=" w-96 rounded-lg shadow-2xl" />
                <p class="text-xs md:text-base">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley</p>
            </div>
        </div>
    </section>

    <section class="max-w-screen-md lg:mx-auto mx-6 py-10 md:px-14 lg:px-0 lg:py-20 " id="faq">
        <div class="flex flex-col item-center justify-center gap-10">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold ">Drop Us a Line - We're Here to Help</h1>
                <p>I'm here to listen, advise, and help you</p>
            </div>
            <form action="{{ route('about.faq') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-8">
                    <div class="flex flex-col gap-4">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="input input-bordered"
                            placeholder="Name" />
                        @error('name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="input input-bordered"
                            placeholder="Email" />
                        @error('email')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="question">Question</label>
                        <textarea name="question" id="question" class="textarea textarea-bordered" placeholder="Write your question"
                            rows="5"></textarea>
                        @error('question')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-4">
                        <!-- Google Recaptcha -->
                        <div class="g-recaptcha" data-sitekey={{ config('recaptcha.google_recaptcha_key') }}></div>
                        @error('g-recaptcha-response')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>

        </div>
    </section>
@endsection
