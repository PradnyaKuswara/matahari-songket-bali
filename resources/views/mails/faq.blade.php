@extends('layouts.mail')

@section('title')
    Faq
@endsection

@section('content')
    <div class="card md:max-w-screen-md mx-auto my-auto p-6 bg-white">
        <section class="px-6 py-8">
            <header>
                <a href="javascript:void(0)">
                    <img class="w-auto h-16 " src="{{ asset('assets/images/logo.png') }}" alt="">
                </a>
            </header>

            <main class="mt-8">
                <p class="mt-2 leading-loose text-gray-600 text-justify">
                    You have a question from {{ $content['name'] }} - {{ $content['email'] }} . Here is the question:
                </p>
                <p class="text-md text-justify">{{ $content['question'] }}</p>

            </main>
        </section>
    </div>
@endsection
