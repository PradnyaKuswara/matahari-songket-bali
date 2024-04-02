@extends('layouts.auth')

@section('title')
    Register Page
@endsection

@section('content')
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="px-6 py-8">
                <a href="{{ route('index') }}" class="flex justify-center mb-8">
                    <img class="h-20" src="{{ asset('assets/images/logo.png') }}" alt="">
                </a>

                <form action=" ">
                    <div class="flex flex-col lg:flex-row gap-4 mb-4">
                        <div class=" w-full">
                            <label class="form-control w-full max-w-xs" for="LoggingFirstName">
                                <div class="label">
                                    <span class="label-text">First Name</span>
                                </div>
                            </label>
                            <input id="LoggingFirstName" class="input input-bordered input-md w-full text-xs md:text-base "
                                type="text" name="first_name" placeholder="Enter your first name">
                        </div>

                        <div class=" w-full">
                            <label class="form-control w-full max-w-xs" for="LoggingLastName">
                                <div class="label">
                                    <span class="label-text">Last Name</span>
                                </div>
                            </label>
                            <input id="LoggingLastName" class="input input-bordered w-full text-xs md:text-base "
                                type="text" name="last_name" placeholder="Enter your last name">
                        </div>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-4 mb-8">
                        <div class=" w-full">
                            <label class="form-control w-full max-w-xs" for="LoggingEmailAddress">
                                <div class="label">
                                    <span class="label-text">Email</span>
                                </div>
                            </label>
                            <input id="LoggingEmailAddress" class="input input-bordered w-full text-xs md:text-base"
                                type="email" name="email" placeholder="Enter your email">
                        </div>

                        <div class=" w-full">
                            <label class="form-control w-full max-w-xs" for="loggingPassword">
                                <div class="label">
                                    <span class="label-text">Password</span>
                                </div>
                            </label>

                            <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                <input type="password" class="grow" name="password" placeholder="Enter your password" />
                            </label>
                        </div>
                    </div>


                    <div class="flex justify-center mb-5">
                        <button type="submit" class="btn w-full text-white bg-primary"> Sign Up Free </button>
                    </div>

                </form>

                <div class="flex mb-3">
                    <div class="flex-1">
                        <p class="text-xs">Already have an account? <a href="{{ route('login') }}" class="text-primary">Sign
                                in</a></p>
                    </div>
                </div>

                <div class="relative flex py-5 items-center">
                    <div class="flex-grow border-t border-gray-400"></div>
                    <span class="flex-shrink mx-4 text-gray-400 text-sm">Or</span>
                    <div class="flex-grow border-t border-gray-400"></div>
                </div>

                <div class="flex flex-col justify-center gap-4">
                    <button class="btn bg-white">
                        <i class=" fa-brands fa-google"></i>
                        Start with Google
                    </button>
                    <button class="btn bg-white">
                        <i class=" fa-brands fa-facebook"></i>
                        Star With Facebook
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript"></script>
@endpush
