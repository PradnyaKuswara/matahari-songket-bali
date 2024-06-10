@extends('layouts.error')

@section('page-title')
    Not Found
@endsection

@section('content')

    <body class="bg- h-screen w-screen flex justify-center items-center">
        <div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
            <div class="card bg-white overflow-hidden sm:rounded-md rounded-none">
                <div class="px-6 py-8">
                    <a href="{{ route('index') }}" class="flex justify-center mb-8">
                        <img class="h-10" src="{{ asset('assets/images/logo.png') }}" alt="">
                    </a>

                    <h3 class="text-dark mb-4 mt-6 text-center text-3xl">Page Not Found</h3>

                    <p class="text-dark/75 mb-8 mx-auto text-base text-center">It's looking like you may have taken a wrong
                        turn. Don't worry... it happens to the best of us. You might want to check your internet connection.
                    </p>

                    <div class="flex justify-center">
                        <a href="{{ route('index') }}" class="btn text-white bg-primary"> Back To Home </a>
                    </div>

                </div>
            </div>
        </div>
    </body>
@endsection
