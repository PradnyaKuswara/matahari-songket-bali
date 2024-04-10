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
    <section class=" max-w-screen-lg lg:mx-auto pt-28 md:px-14 lg:px-0 lg:pt-20">
        <div class="grid grid-cols-2 gap-8">
            <div class="flex flex-col items-center gap-8">
                <img src="{{ asset('assets/images/hero2.jpg') }}" class=" w-96 rounded-lg shadow-2xl" />
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley</p>
            </div>
            <div class="flex flex-col items-center gap-8">
                <img src="{{ asset('assets/images/hero2.jpg') }}" class=" w-96 rounded-lg shadow-2xl" />
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley</p>
            </div>
            <div class="flex flex-col items-center gap-8">
                <img src="{{ asset('assets/images/hero2.jpg') }}" class=" w-96 rounded-lg shadow-2xl" />
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley</p>
            </div>
            <div class="flex flex-col items-center gap-8">
                <img src="{{ asset('assets/images/hero2.jpg') }}" class=" w-96 rounded-lg shadow-2xl" />
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley</p>
            </div>
        </div>
    </section>

    <section class=" max-w-screen-md lg:mx-auto md:px-14 lg:px-0 lg:py-20 ">
        <div class="flex flex-col item-center justify-center gap-10">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold ">Drop Us a Line - We're Here to Help</h1>
                <p>I'm here to listen, advise, and help you</p>
            </div>
            <form action="">
                <div class="grid grid-cols-1 gap-8">
                    <div class="flex flex-col gap-4">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="input input-bordered"
                            placeholder="Name" />
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="input input-bordered"
                            placeholder="Email" />
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" class="textarea textarea-bordered" placeholder="Message" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>

        </div>
    </section>
@endsection
