@extends('layouts.dashboard')


@section('title')
    Profile | Matahari Songket Bali
@endsection

@section('content')
    <div class="grid lg:grid-cols-6 gap-4">
        <div class="lg:col-span-2">
            <div class="card bg-white shadow-md rounded-sm text-center">
                <div class="card-body">
                    <div class="flex justify-center">
                        <div class="avatar">
                            <div class="w-24 rounded-full">
                                <img src="{{ auth()->user()->avatar ? '' : 'https://eu.ui-avatars.com/api/?name=' . auth()->user()->username . '&size=150' }}"
                                    alt="profile-image">
                            </div>
                        </div>
                    </div>

                    <div class="text-start mt-3">
                        <h4 class="fs-13 text-uppercase">About Me :</h4>
                        <p class="text-muted mb-3">
                            Hi I'm Tosha Minner,has been the industry's standard dummy text ever since the
                            1500s, when an unknown printer took a galley of type.
                        </p>

                        <p class="text-muted mb-2"><strong>Full Name :</strong> <span
                                class="ms-2">{{ $user->name }}</span>
                        </p>

                        <p class="text-muted mb-2"><strong>User Name :</strong> <span
                                class="ms-2">{{ $user->username }}</span>
                        </p>

                        <p class="text-muted mb-2"><strong>Email :</strong> <span class="ms-2 ">{{ $user->email }}</span>
                        </p>

                        <p class="text-muted mb-2"><strong>Mobile :</strong><span
                                class="ms-2">{{ $user->phone_number ?? '-' }}</span></p>

                        <p class="text-muted mb-1"><strong>Location :</strong> <span
                                class="ms-2">{{ $user->country ?? '-' }}</span></p>
                    </div>

                    <ul class="social-list list-inline mt-3 mb-0">
                        <li class="list-inline-item">
                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i
                                    class="ri-facebook-circle-fill"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i
                                    class="ri-google-fill"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i
                                    class="ri-twitter-fill"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i
                                    class="ri-github-fill"></i></a>
                        </li>
                    </ul>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col-->

        <div class="lg:col-span-4">
            <div class="card w-full bg-white shadow-md rounded-sm">
                <div class="card-body">
                    <form>
                        <h2 class="text-xl mb-4 "><i class="ph-duotone ph-info"></i> Personal Info
                        </h2>

                        <div class="flex flex-col lg:flex-row gap-4 mb-4">
                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="LoggingName">
                                    <div class="label">
                                        <span class="label-text">Name</span>
                                    </div>
                                </label>

                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="LoggingName" class="form-input grow border-none outline-none" type="text"
                                        name="name" value="{{ old('name') }}" placeholder="Enter your name">
                                </label>

                                @error('name')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="LoggingUsername">
                                    <div class="label">
                                        <span class="label-text">UserName</span>
                                    </div>
                                </label>
                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="LoggingUsername" class="form-input grow border-none outline-none"
                                        type="text" name="username" value="{{ old('username') }}"
                                        placeholder="Enter your username">
                                </label>

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
                                    <option value="women" {{ old('gender') == 'women' ? 'selected' : null }}>Women
                                    </option>
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
                                    <input id="loggingDateOfBirth" type="date"
                                        class="form-input grow border-none outline-none " name="date_of_birth"
                                        value="{{ old('date_of_birth') }}" placeholder="Enter your date" />
                                </label>

                                @error('date_of_birth')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col lg:flex-row gap-4 mb-4">
                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="LoggingEmailAddress">
                                    <div class="label">
                                        <span class="label-text">Email</span>
                                    </div>
                                </label>

                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="LoggingEmailAddress" class="form-input grow border-none outline-none "
                                        type="email" name="email" value="{{ old('email') }}"
                                        placeholder="Enter your email">
                                </label>

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
                                    <input id="loggingPassword" type="password"
                                        class="form-input grow border-none outline-none " name="password"
                                        value="{{ old('password') }}" placeholder="Enter your password" />
                                </label>

                                @error('password')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex gap-4 mb-8">
                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="LoggingUsername">
                                    <div class="label">
                                        <span class="label-text">Avatar</span>
                                    </div>
                                </label>
                                <input type="file" class="file-input file-input-bordered w-full" />

                                @error('avatar')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-center mb-5">
                            <button type="submit" class="btn w-full text-white bg-primary"> Update Profile </button>
                        </div>
                    </form>
                </div> <!-- end card body -->
            </div> <!-- end card -->

            <div class="card w-full bg-white shadow-md rounded-sm mt-4">
                <div class="card-body">
                    <h2 class="text-xl mb-4 "><i class="ph-duotone ph-info"></i> Address
                    </h2>

                    <div class="flex flex-col lg:flex-row gap-4 mb-4">
                        <div class=" w-full">
                            <label class="form-control w-full max-w-xs" for="LoggingName">
                                <div class="label">
                                    <span class="label-text">Country</span>
                                </div>
                            </label>

                            <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                <input id="LoggingName" class="form-input grow border-none outline-none" type="text"
                                    name="country" value="{{ old('country') }}" placeholder="Enter your country">
                            </label>

                            @error('country')
                                <p class="mt-2 text-error text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class=" w-full">
                            <label class="form-control w-full max-w-xs" for="LoggingUsername">
                                <div class="label">
                                    <span class="label-text">Province</span>
                                </div>
                            </label>
                            <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                <input id="LoggingUsername" class="form-input grow border-none outline-none"
                                    type="text" name="province" value="{{ old('province') }}"
                                    placeholder="Enter your province">
                            </label>

                            @error('province')
                                <p class="mt-2 text-error text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-4 mb-4">
                        <div class=" w-full">
                            <label class="form-control w-full max-w-xs" for="LoggingName">
                                <div class="label">
                                    <span class="label-text">City</span>
                                </div>
                            </label>

                            <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                <input id="LoggingName" class="form-input grow border-none outline-none" type="text"
                                    name="city" value="{{ old('city') }}" placeholder="Enter your city">
                            </label>

                            @error('city')
                                <p class="mt-2 text-error text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class=" w-full">
                            <label class="form-control w-full max-w-xs" for="LoggingUsername">
                                <div class="label">
                                    <span class="label-text">Postal Code</span>
                                </div>
                            </label>
                            <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                <input id="LoggingUsername" class="form-input grow border-none outline-none"
                                    type="text" name="postal_code" value="{{ old('postal_code') }}"
                                    placeholder="Enter your postal code">
                            </label>

                            @error('postal_code')
                                <p class="mt-2 text-error text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex gap-4 mb-4">
                        <div class=" w-full">
                            <label class="form-control w-full max-w-xs" for="LoggingUsername">
                                <div class="label">
                                    <span class="label-text">Address</span>
                                </div>
                            </label>
                            <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                <input id="LoggingUsername" class="form-input grow border-none outline-none"
                                    type="text" name="address" value="{{ old('address') }}"
                                    placeholder="Enter your address">
                            </label>

                            @error('address')
                                <p class="mt-2 text-error text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex gap-4 mb-4">
                        <div class=" w-full">
                            <label class="form-control w-full max-w-xs" for="LoggingUsername">
                                <div class="label">
                                    <span class="label-text">Additional information</span>
                                </div>
                            </label>
                            <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                <input id="LoggingUsername" class="form-input grow border-none outline-none"
                                    type="text" name="additional_information"
                                    value="{{ old('additional_information') }}"
                                    placeholder="Enter your additional information">
                            </label>

                            @error('additional_information')
                                <p class="mt-2 text-error text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-center mb-5">
                        <button type="submit" class="btn w-full text-white bg-primary"> Update Address </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
