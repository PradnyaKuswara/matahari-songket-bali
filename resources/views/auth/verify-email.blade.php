@extends('layouts.auth')

@section('title')
    Verify Email
@endsection

@section('content')
    <div class="relative flex min-h-screen flex-col items-center justify-center overflow-hidden py-6 sm:py-12 ">
        <div class="max-w-xl px-5 text-center">
            <h2 class="mb-2 text-[42px] font-bold text-zinc-800">Check your email inbox</h2>
            <p class="mb-2 text-lg text-zinc-500">We are glad, that you’re with us ? We’ve sent you a verification link to
                the email address <span class="font-medium text-indigo-500">{{ auth()->user()->email }}</span>.</p>
            <div class="flex justify-center gap-4 mt-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="btn  btn-neutral font-medium text-white shadow-md shadow-indigo-500/20">Resend
                        Verification</button>
                </form>

                <a href="{{ route('index') }}"
                    class="btn btn-primary  font-medium text-white shadow-md shadow-indigo-500/20 ">Open
                    the App →</a>
            </div>

        </div>
    </div>
@endsection
