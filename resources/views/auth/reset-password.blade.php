@extends('layouts.auth')

@section('title')
    Reset Password
@endsection

@section('content')
    <div class="card lg:card-side bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="px-6 py-8">
                <a href="{{ route('index') }}" class="flex justify-center mb-8">
                    <img class="h-20" src="{{ asset('assets/images/logo.png') }}" alt="">
                </a>

                <form action="">
                    <div class="mb-4 w-full">
                        <label class="form-control w-full max-w-xs" for="LoggingEmailAddress">
                            <div class="label">
                                <span class="label-text
                                ">Email</span>
                            </div>
                        </label>
                        <input id="LoggingEmailAddress" class="input input-bordered w-full text-xs md:text-base"
                            type="email" name="email" placeholder="Enter your email">
                    </div>

                    <div class="mb-4 w-full">
                        <label class="form-control w-full max-w-xs" for="loggingPassword">
                            <div class="label">
                                <span class="label-text">Password</span>
                            </div>
                        </label>

                        <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                            <input id="loggingPassword" type="password" class="grow" name="password" placeholder="Enter your password" />
                        </label>


                    </div>

                    <div class="mb-4 w-full">
                        <label class="form-control w-full max-w-xs" for="loggingRePassword">
                            <div class="label">
                                <span class="label-text">Re Password</span>
                            </div>
                        </label>

                        <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                            <input id="loggingRePassword" type="password" class="grow" name="password" placeholder="Enter your re password" />
                        </label>
                    </div>

                    <div class="flex justify-center mb-5">
                        <button type="submit" class="btn w-full text-white bg-primary"> Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

