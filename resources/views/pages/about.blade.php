@extends('layouts.app')

@section('page-title')
    About | Matahari Songket Bali
@endsection

@push('css')
    <style>
        .grecaptcha-badge {
            z-index: 9999;
            /* atau nilai yang cukup besar */
        }
    </style>
@endpush

@section('content')
    <section id="hero">
        <div class="hero min-h-screen" style="background-image: url({{ asset('assets/images/about-hero.jpg') }});">
            <div class="hero-overlay bg-opacity-70"></div>
            <div class="text-white">
                <div class="lg:max-w-[60rem] mx-4 md:mx-6 lg:mx-0">
                    <x-string-typing idType="typed-1" idStringElement="typed-title-1"
                        class="mb-5 text-5xl lg:text-7xl font-bold">Discover our story.</x-string-typing>
                    <p class="text-sm lg:text-base mb-5 mt-5 leading-6 lg:leading-7">Matahari Songket Bali is your gateway to
                        the vibrant heritage of Bali's
                        traditional
                        songket. Our artisans meticulously weave each piece, combining time-honored techniques with modern
                        elegance. Experience the rich culture and exquisite craftsmanship that define our unique songket
                        products, perfect for any occasion.</p>
                    <a href="{{ route('about.index') }}/#about" class="btn btn-neutral text-neutral-content px-8">Find Out
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class=" max-w-screen-lg lg:mx-auto pt-16 mx-4 md:mx-0 md:px-14 lg:px-0 lg:pt-20">
        <div class="grid grid-cols-1 gap-8">
            <div class="flex flex-col lg:flex-row items-center gap-8" data-aos="fade-right" data-aos-delay="200">
                <img src="{{ asset('assets/images/about-1.jpg') }}"
                    class="w-96 rounded-lg shadow-2xl aspect-square object-cover" />
                <div class="flex-col">
                    <div class="w-32 py-[0.1rem] bg-primary mb-4 animate-widen"></div>
                    <p class="text-sm md:text-base text-justify">Imagine the heart of Matahari Songket Bali, where the owner
                        engages in meaningful discussions with the skilled artisans. This setting reveals the deep
                        collaboration and shared expertise that go into each unique piece of songket. It’s a testament to
                        the dedication and teamwork that uphold the brand's high standards and commitment to quality.</p>
                    <div class="flex justify-end mt-4">
                        <div class="w-32 py-[0.1rem] bg-primary mb-4  animate-widen"></div>
                    </div>
                </div>

            </div>
            <div class="flex flex-col lg:flex-row-reverse items-center gap-8"data-aos="fade-left" data-aos-delay="300">
                <img src="{{ asset('assets/images/about-2.jpg') }}"
                    class="w-96 rounded-lg shadow-2xl aspect-square object-cover object-center" />
                <div class="flex-col">
                    <div class="w-32 py-[0.1rem] bg-primary mb-4 animate-widen"></div>
                    <p class="text-sm md:text-base text-justify">Picture the seller of Matahari Songket Bali, standing
                        proudly with a meticulously woven songket in hand. This moment captures the pride and joy that come
                        from presenting such intricate work. It symbolizes the connection between the creators and the
                        customers, showcasing the personal touch and heartfelt passion embedded in every piece of songket.
                    </p>
                    <div class="flex justify-end mt-4">
                        <div class="w-32 py-[0.1rem] bg-primary mb-4  animate-widen"></div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col lg:flex-row items-center gap-8" data-aos="fade-right" data-aos-delay="400">
                <img src="{{ asset('assets/images/about-3.jpg') }}"
                    class=" w-96 rounded-lg shadow-2xl aspect-square object-cover" />
                <div class="flex-col">
                    <div class="w-32 py-[0.1rem] bg-primary mb-4 animate-widen"></div>
                    <p class="text-sm md:text-base text-justify">Step behind the scenes where ongoing interactions between
                        the owner and artisans take place. These moments of dialogue and quality control ensure that each
                        songket meets the brand’s excellence. This insight into their process builds transparency and trust,
                        reinforcing the authenticity and meticulous care taken in creating each masterpiece.</p>
                    <div class="flex justify-end mt-4">
                        <div class="w-32 py-[0.1rem] bg-primary mb-4  animate-widen"></div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col lg:flex-row-reverse items-center gap-8" data-aos="fade-left" data-aos-delay="500">
                <img src="{{ asset('assets/images/about-4.jpg') }}"
                    class=" w-96 rounded-lg shadow-2xl aspect-square object-cover" />
                <div class="flex-col">
                    <div class="w-32 py-[0.1rem] bg-primary mb-4 animate-widen"></div>
                    <p class="text-sm md:text-base text-justify">Visualize a skilled weaver at the loom, weaving the
                        intricate patterns of a songket. This scene highlights the meticulous craftsmanship and rich
                        tradition that define Matahari Songket Bali. It offers a glimpse into the detailed and
                        time-intensive process, celebrating the artistry and dedication that go into every handwoven piece.
                    </p>
                    <div class="flex justify-end mt-4">
                        <div class="w-32 py-[0.1rem] bg-primary mb-4  animate-widen"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-screen-md lg:mx-auto mx-6 py-10 md:px-14 lg:px-0 lg:py-20 " id="faq" data-aos="fade-up">
        <div class="flex flex-col item-center justify-center gap-10">
            <div class="text-center">
                <h1 class="text-3xl lg:text-6xl font-extrabold ">Drop Us a Line - We're Here to Help</h1>
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
                    <button type="submit" class="btn btn-neutral">Send</button>
                </div>
            </form>

        </div>
    </section>
@endsection
