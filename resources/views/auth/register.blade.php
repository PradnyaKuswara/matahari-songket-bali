@extends('layouts.auth')

@section('title')
    Register Page
@endsection

@section('content')
    <div class="card bg-base-100 shadow-xl md:w-10/12 mx-auto">
        <div class="card-body">
            <div class="px-6 py-8">
                <a href="{{ route('index') }}" class="flex justify-center mb-8">
                    <img class="h-20" src="{{ asset('assets/images/logo.png') }}" alt="">
                </a>

                <form action="{{ route('register.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-col lg:flex-row gap-4 mb-4">
                        <div class=" w-full">
                            <label class="form-control w-full max-w-xs" for="LoggingName">
                                <div class="label">
                                    <span class="label-text">Name</span>
                                </div>
                            </label>
                            <input id="LoggingName" class="input input-bordered input-md w-full text-xs md:text-base "
                                type="text" name="name" value="{{ old('name') }}" placeholder="Enter your name">

                            @error('name')
                                <p class="mt-2 text-error text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class=" w-full">
                            <label class="form-control w-full max-w-xs" for="LoggingUsername">
                                <div class="label">
                                    <span class="label-text">User Name</span>
                                </div>
                            </label>
                            <input id="LoggingUsername" class="input input-bordered w-full text-xs md:text-base "
                                type="text" name="username" value="{{ old('username') }}"
                                placeholder="Enter your username">
                            @error('username')
                                <p class="mt-2 text-error text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-4 mb-4">
                        <div class=" w-full">
                            <label class="form-control w-full max-w-xs" for="LoggingGender">
                                <div class="label">
                                    <span class="label-text">Gender</span>
                                </div>
                            </label>
                            <select id="LoggingGender" name="gender" class="select w-full select-bordered">
                                <option disabled selected>Pick one</option>
                                <option value="men" {{ old('gender') == 'men' ? 'selected' : null }}>Men</option>
                                <option value="women" {{ old('gender') == 'women' ? 'selected' : null }}>Women</option>
                            </select>

                            @error('gender')
                                <p class="mt-2 text-error text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class=" w-full">
                            <label class="form-control w-full max-w-xs" for="loggingDateOfBirth">
                                <div class="label">
                                    <span class="label-text">Date Of Birth</span>
                                </div>
                            </label>

                            <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                <input id="loggingDateOfBirth" type="date" class="grow" name="date_of_birth"
                                    value="{{ old('date_of_birth') }}" placeholder="Enter your date" />
                            </label>

                            @error('date_of_birth')
                                <p class="mt-2 text-error text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-4 mb-9">
                        <div class=" w-full">
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

                        <div class=" w-full">
                            <label class="form-control w-full max-w-xs" for="loggingPassword">
                                <div class="label">
                                    <span class="label-text">Password</span>
                                </div>
                            </label>

                            <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                <input id="loggingPassword" type="password" class="grow" name="password"
                                    value="{{ old('password') }}" placeholder="Enter your password" />
                            </label>

                            @error('password')
                                <p class="mt-2 text-error text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-center mb-5">
                        <button type="submit" class="btn w-full text-white bg-primary"> Sign Up Free </button>
                    </div>

                </form>

                <div class="flex mb-3">
                    <div class="flex-1">
                        <p class="text-xs">Already have an account? <a href="{{ route('login') }}"
                                class="text-primary">Sign
                                in</a></p>
                    </div>
                </div>

                <div class="relative flex py-5 items-center">
                    <div class="flex-grow border-t border-gray-400"></div>
                    <span class="flex-shrink mx-4 text-gray-400 text-sm">Or</span>
                    <div class="flex-grow border-t border-gray-400"></div>
                </div>

                <div class="flex flex-col justify-center gap-4">
                    <a href="{{ route('socialite.redirect', 'google') }}" class="btn bg-white">
                        <i class=" fa-brands fa-google"></i>
                        Start with Google
                    </a>
                    {{-- <button class="btn bg-white">
                        <i class=" fa-brands fa-facebook"></i>
                        Star With Facebook
                    </button> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript"></script>
@endpush
