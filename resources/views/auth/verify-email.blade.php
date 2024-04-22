@extends('layouts.auth')

@section('title')
    Verify Email
@endsection

@section('content')
    <div class="relative flex min-h-screen flex-col items-center justify-center overflow-hidden py-6 sm:py-12 bg-white">
        <div class="max-w-xl px-5 text-center">
            <h2 class="mb-2 text-[42px] font-bold text-zinc-800">Check your inbox</h2>
            <p class="mb-2 text-lg text-zinc-500">We are glad, that you’re with us ? We’ve sent you a verification link to
                the email address <span class="font-medium text-indigo-500">{{ auth()->user()->email }}</span>.</p>
            <a href="{{ route('index') }}"
                class="btn btn-primary mt-3  w-96 rounded  px-5 py-3 font-medium text-white shadow-md shadow-indigo-500/20 ">Open
                the App →</a>
        </div>
    </div>
@endsection
