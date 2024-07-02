@extends('layouts.auth')

@section('title')
    Reset Password
@endsection

@section('content')
    <div class="card lg:card-side lg:w-6/12 w-full bg-base-100 h-full lg:shadow-xl">
        <div class="card-body">
            <div class="px-6 py-8">
                <a href="javascript:void(0)" class="flex justify-center mb-8">
                    <img class="h-20" src="{{ asset('assets/images/logo.png') }}" alt="">
                </a>

                <form action="{{ route('password.store') }}" method="POST">
                    @csrf
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="mb-4 w-full">
                        <label class="form-control w-full max-w-xs" for="LoggingEmailAddress">
                            <div class="label">
                                <span class="label-text
                                ">Email</span>
                            </div>
                        </label>
                        <input id="LoggingEmailAddress" class="input input-bordered w-full text-xs md:text-base"
                            type="email" name="email" value="{{ $request->email }}" placeholder="Enter your email"
                            readonly>

                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4 w-full">
                        <label class="form-control w-full max-w-xs" for="loggingPassword">
                            <div class="label">
                                <span class="label-text">Password</span>
                            </div>
                        </label>

                        <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                            <input id="loggingPassword" type="password" class="grow" name="password"
                                placeholder="Enter your password" />
                        </label>

                        @error('password')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="mb-4 w-full">
                        <label class="form-control w-full max-w-xs" for="loggingRePassword">
                            <div class="label">
                                <span class="label-text">Re Password</span>
                            </div>
                        </label>

                        <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                            <input id="loggingRePassword" type="password" class="grow" name="password_confirmation"
                                placeholder="Enter your re password" />
                        </label>

                        @error('password_confirmation')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-center mb-5">
                        <button type="submit" class="btn w-full text-white bg-primary"> Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
