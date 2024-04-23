@extends('layouts.auth')

@section('title')
    Login Page
@endsection

@section('content')
    <div class="card lg:card-side bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="px-6 py-8">
                <a href="{{ route('index') }}" class="flex justify-center mb-8">
                    <img class="h-20" src="{{ asset('assets/images/logo.png') }}" alt="">
                </a>

                <form action="{{ route('login.store') }}" method="POST">
                    @csrf
                    <div class="mb-4 w-full">
                        <label class="form-control w-full max-w-xs" for="LoggingEmailAddress">
                            <div class="label">
                                <span class="label-text">Email</span>
                            </div>
                        </label>
                        <input id="LoggingEmailAddress" class="input input-bordered w-full text-xs md:text-base"
                            type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email">
                        @error('email')
                            <p class="mt-2 text-error text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4 w-full">
                        <label class="form-control w-full " for="loggingPassword">
                            <div class="label">
                                <span class="label-text">Password</span>
                            </div>

                            <input type="password" name="password" value="{{ old('password') }}"
                                class="input input-bordered w-full text-xs md:text-base mb-1"
                                placeholder="Enter your password" />
                            @error('password')
                                <p class="mt-2 text-error text-xs">{{ $message }}</p>
                            @enderror

                            <div class="label">
                                <span class="label-text-alt"></span>
                                <span class="label-text-alt text-primary"><a href="{{ route('password.request') }}">Forgot
                                        password?</a></span>
                            </div>
                        </label>

                        </label>
                    </div>

                    <div class="flex justify-center mb-5">
                        <button type="submit" class="btn w-full text-white bg-primary"> Sign In </button>
                    </div>
                </form>

                <div class="flex mb-3">
                    <div class="flex-1">
                        <p class="text-xs">Don't Have a Acoount? <a href="{{ route('register') }}" class="text-primary">Sign
                                Up!</a></p>
                    </div>
                </div>

                <div class="relative flex py-5 items-center">
                    <div class="flex-grow border-t border-gray-400"></div>
                    <span class="flex-shrink mx-4 text-gray-400 text-sm">Or</span>
                    <div class="flex-grow border-t border-gray-400"></div>
                </div>

                <div class="flex flex-col justify-center gap-4">
                    <a href="{{ route('socialite.redirect', 'google') }}" class="btn bg-white">
                        <img src="{{ asset('assets/images/google.png') }}" width="35px" alt="">
                        Login with Google
                    </a>
                    {{-- <button class="btn bg-white">
                        <i class=" fa-brands fa-facebook"></i>
                        Login With Facebook
                    </button> --}}
                </div>
            </div>
        </div>
        <figure><img src="{{ asset('assets/images/hero2.jpg') }}" alt="Album" class="w-80 h-full" />
        </figure>
    </div>
@endsection
