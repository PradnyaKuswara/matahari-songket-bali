@extends('layouts.auth')

@section('title')
    Forgot Password
@endsection

@section('content')
    <div class="card lg:card-side bg-base-100 lg:shadow-xl">
        <div class="card-body">
            <div class="px-6 py-8">
                <a href="{{ route('index') }}" class="flex justify-center mb-8">
                    <img class="h-20" src="{{ asset('assets/images/logo.png') }}" alt="">
                </a>

                <p class="text-base mb-5">Forgot your password? No problem. Just let us know your email address and we will
                    email you a password
                    reset link that will allow you to choose a new one.</p>
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="mb-4 w-full">
                        <label class="form-control w-full max-w-xs" for="LoggingEmailAddress">
                            <div class="label">
                                <span class="label-text">Email</span>
                            </div>
                        </label>

                        <input id="LoggingEmailAddress" class="input input-bordered w-full text-xs md:text-base"
                            type="email" name="email" placeholder="Enter your email">
                        <div class="mt-1 font-medium text-sm text-green-600">{{ session('status') }}</div>
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-center mb-5">
                        <button type="submit" class="btn w-full text-white bg-primary"> Send Email </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
